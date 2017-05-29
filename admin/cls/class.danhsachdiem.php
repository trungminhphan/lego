<?php
class DanhSachDiem {
	const COLLECTION = 'danhsachdiem';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $id_user = '';
	public $diem = '';
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(DanhSachDiem::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('date_post'=> -1));
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('date_post'=> -1));
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}

	public function insert(){
		$query = array(
			'id_user' => new MongoId($this->id_user),
			'diem' => intval($this->diem),
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function get_list_by_user(){
		$query = array('id_user' => new MongoId($this->id_user));
		return $this->_collection->find($query)->sort(array('date_post'=> -1));
	}

}
?>