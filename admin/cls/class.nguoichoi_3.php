<?php
class NguoiChoi_3{
	const COLLECTION = 'nguoichoi';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $loaidiem = '';
	public $id_user = '';
	public $hinhanh = '';
	public $sotien = 0;
	public $date_post = '';
	public $tinhtrang = array(); //array(t, noidung, date_post, id_user)
	public $diem = 0;

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(NguoiChoi_3::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find(array('loaidiem' => 3))->sort(array('date_post'=>-1));
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('date_post'=>-1));
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function insert(){
		$query = array(
			'loaidiem' => intval($this->loaidiem),
			'id_user' => new MongoId($this->id_user),
			'hinhanh' => $this->hinhanh,
			'sotien' => intval($this->sotien),
			'diem' => intval($this->diem),
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function check(){
		$query = array('$set' => array(
			'hinhanh' => $this->hinhanh,
			'sotien' => $this->sotien,
			'tinhtrang' => $this->tinhtrang,
			'diem' => intval($this->diem)
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}
}
?>