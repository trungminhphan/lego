<?php
class NguoiChoi{
	const COLLECTION = 'nguoichoi';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $loaidiem = '';
	public $id_user = '';
	public $hinhanh = '';
	public $capdo = 0;
	public $date_post = '';
	public $tinhtrang = array(); //array(t, noidung, date_post, id_user)
	public $diem = 0;

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(NguoiChoi::COLLECTION);
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function sum_diem_canhan($l){
		$condition = array('$match' => array(
				'loaidiem' => $l,
				'tinhtrang.t' => 1,
				'id_user' => new MongoId($this->id_user)));
		$query = array('$group' => array(
			'_id' => array('id1'=> '$id_user', 'id2' => '$loaidiem'),
			'sumdiem' => array('$sum' => '$diem')
		));
		$result = $this->_collection->aggregate($condition, $query);
		if($result && isset($result['result'][0]['sumdiem'])) return $result['result'][0]['sumdiem'];
		return 0;
	}

	public function sum_xephang(){
		$condition = array(
			'$match' => array( 'tinhtrang.t' => 1)
		);
		$sort = array(
			'$sort' => array('sumdiem' => -1)
		);
		$query = array(
			'$group' => array(
				'_id' => '$id_user',
				'sumdiem' => array('$sum' => '$diem')
			)
		);
		$result = $this->_collection->aggregate($condition, $query, $sort);
		if($result && isset($result['result'])) return $result['result'];
		return 0;
	}
	public function get_hiepsituan($start_date, $end_date, $arr_user){
		$condition = array(
			'$match' => array('$and' => array(
							array('tinhtrang.t' => 1),
							array('date_post' => array('$gte' => $start_date)),
							array('date_post' => array('$lte' => $end_date)),
							array('id_user' => array('$nin' => $arr_user))
						))
		);
		$sort = array(
			'$sort' => array('sumdiem' => -1)
		);
		$limit = array('$limit' => 20);
		$query = array(
			'$group' => array(
				'_id' => '$id_user',
				'sumdiem' => array('$sum' => '$diem')
			)
		);
		return $this->_collection->aggregate($condition, $query, $sort, $limit);
	}

	public function get_list_by_user(){
		$query = array('id_user' => new MongoId($this->id_user));
		return $this->_collection->find($query)->sort(array('date_post' => -1));
	}

	public function get_distinct_user(){
		return $this->_collection->distinct("id_user");
	}

	public function get_list_by_loaidiem_user($act){
		if($act==0){
			$query = array('$and' => array(
				array('id_user' => new MongoId($this->id_user)),
				array('loaidiem' => intval($this->loaidiem)),
				array('$or' => array(
					array('tinhtrang.t' => 0),
					array('tinhtrang.t' => array('$exists' => false))
				))
			));
		} else {
			$query = array(
				'id_user' => new MongoId($this->id_user),
				'loaidiem' => intval($this->loaidiem),
				'tinhtrang.t' => intval($act)
			);
		}
		return $this->_collection->find($query)->sort(array('date_post' => -1));
	}

	public function get_list_uncheck(){
		$query = array('$or' => array(
					array('tinhtrang.t' => 0),
					array('tinhtrang.t' => array('$exists' => false))
				));
		return $this->_collection->find($query);
	}

	public function delete_uncheck(){
		$query = array('$or' => array(
					array('tinhtrang.t' => 0),
					array('tinhtrang.t' => array('$exists' => false))
				));
		return $this->_collection->remove($query);	
	}

	public function check_new($act){
		if($act == 0){
			$query = array('$and' => array(
				array('id_user' => new MongoId($this->id_user)),
				array('$or' => array(
					array('tinhtrang.t' => 0),
					array('tinhtrang.t' => array('$exists' => false))
				))
			));
		} else {
			$query = array(
				'id_user' => new MongoId($this->id_user),
				'tinhtrang.t' => intval($act)
			);
		}

		$field = array('_id' => true);
		$result = $this->_collection->findOne($query, $field);
		if(isset($result['_id']) && $result['_id']) return true;
		else return false;
	}

	public function tinhtrang(){
		$query = array('$set' => array(
			'tinhtrang' => $this->tinhtrang
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}

	public function get_maxdiem($loaidiem){
		$condition = array(
			'$match' => array('$and' => array(
							array('loaidiem' => intval($loaidiem)),
							array('id_user' => new MongoId($this->id_user)),
							array('tinhtrang.t' => 1)
						))
		);
		$query = array('$group' => array( '_id' => '', 'maxDiem' => array('$max' => '$diem')));
		$result = $this->_collection->aggregate($condition, $query);
		if(isset($result['result'][0]['maxDiem']) && $result['result'][0]['maxDiem']) return $result['result'][0]['maxDiem'];
		else return 0;
	}

	public function get_maxdiem_date($loaidiem,$start_date,$end_date){
		$condition = array(
			'$match' => array('$and' => array(
							array('loaidiem' => intval($loaidiem)),
							array('id_user' => new MongoId($this->id_user)),
							array('date_post' => array('$gte' => $start_date)),
							array('date_post' => array('$lte' => $end_date)),
							array('tinhtrang.t' => 1)
						))
		);
		$query = array('$group' => array( '_id' => '', 'maxDiem' => array('$max' => '$diem')));
		$result = $this->_collection->aggregate($condition, $query);
		if(isset($result['result'][0]['maxDiem']) && $result['result'][0]['maxDiem']) return $result['result'][0]['maxDiem'];
		else return 0;
	}

	public function get_sumdiem($loaidiem){
		$condition = array('$match' => array(
				'loaidiem' => $loaidiem,
				'tinhtrang.t' => 1,
				'id_user' => new MongoId($this->id_user)));
		$query = array('$group' => array(
			'_id' => array('id1'=> '$id_user', 'id2' => '$loaidiem'),
			'sumdiem' => array('$sum' => '$diem')
		));
		$result = $this->_collection->aggregate($condition, $query);

		if($result && isset($result['result'][0]['sumdiem'])) return $result['result'][0]['sumdiem'];
		return 0;
	}

	public function get_sumdiem_date($loaidiem, $start_date, $end_date){
		$condition = array('$match' => array(
				'loaidiem' => $loaidiem,
				'tinhtrang.t' => 1,
				'date_post' => array('$gte' => $start_date),
				'date_post' => array('$lte' => $end_date),
				'id_user' => new MongoId($this->id_user)));
		$query = array('$group' => array(
			'_id' => array('id1'=> '$id_user', 'id2' => '$loaidiem'),
			'sumdiem' => array('$sum' => '$diem')
		));
		$result = $this->_collection->aggregate($condition, $query);
		if($result && isset($result['result'][0]['sumdiem'])) return $result['result'][0]['sumdiem'];
		return 0;
	}
}