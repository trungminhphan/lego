<?php
class NguoiChoi_5{
	const COLLECTION = 'nguoichoi';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $loaidiem = '';
	public $id_user = '';
	public $hinhanh = '';
	public $maso = '';
	public $date_post = '';
	public $tinhtrang = array(); //array(t, noidung, date_post, id_user)
	public $diem = 0;

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(NguoiChoi_5::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find(array('loaidiem' => 5))->sort(array('date_post'=>-1));
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
			'maso' => $this->maso,
			'diem' => intval($this->diem),
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function check(){
		$query = array('$set' => array(
			'hinhanh' => $this->hinhanh,
			'maso' => $this->maso,
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

	public function check_maso(){
		$query = array('maso' => $this->maso, 'id_user' => new MongoId($this->id_user), 'loaidiem' => intval($this->loaidiem));
		$field = array('_id' => true);
		$result = $this->_collection->findOne($query, $field);
		if(isset($result['_id']) && $result['_id']) return true;
		else return false;
	}
}
?>