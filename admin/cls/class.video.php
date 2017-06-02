<?php
class Video {
	const COLLECTION = 'video';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $tieude = '';
	public $mota = '';
	public $hienthi = 0;
	public $orders = 0;
	public $id_danhmucvideo = '';
	public $hinhanh = '';
	public $dinhkem = '';
	public $link = '';
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Video::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('orders' => 1,'date_post'=>-1));
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('orders' => 1,'date_post'=>-1));
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function insert(){
		$query = array(
			'tieude' => $this->tieude,
			'mota' => $this->mota,
			'dinhkem' => $this->dinhkem,
			'link' => $this->link,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'orders' => intval($this->orders),
			'id_danhmucvideo' => $this->id_danhmucvideo,
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function edit(){
		$query = array('$set' => array(
			'tieude' => $this->tieude,
			'mota' => $this->mota,
			'dinhkem' => $this->dinhkem,
			'link' => $this->link,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'orders' => intval($this->orders),
			'id_danhmucvideo' => $this->id_danhmucvideo,
			'date_post' => new MongoDate()
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}

	public function delete_video(){
		$query = array('$set' => array('dinhkem' => ''));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function check_dmvideo($id_dmvideo){
		$query = array('id_dmvideo' => $id_dmvideo);
		$field = array('_id' => true);
		$result = $this->_collection->findOne($query, $field);
		if(isset($result['_id']) && $result['_id']) return true;
		else return false;
	}
}
?>