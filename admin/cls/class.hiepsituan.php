<?php
class HiepSiTuan {
	const COLLECTION = 'hiepsituan';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $nam = 0;
	public $tuan = '';
	public $tungay = '';
	public $denngay = '';
	public $hiepsi = array(); // array(_id, id_user, diem)
	public $date_post = '';
	public $id_user = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(HiepSiTuan::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('date_post'=> -1));
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('date_post'=> -1));
	}

	public function insert(){
		$query = array(
			'nam' => intval(date("Y")),
			'tuan' => $this->tuan,
			'tungay' => $this->tungay,
			'denngay' => $this->denngay,
			'hiepsi' => $this->hiepsi,
			'date_post' => new MongoDate(),
			'id_user' => new MongoId($this->id_user)
		);
		return $this->_collection->insert($query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}

	public function check_exists(){
		$query = array('tuan' => new MongoId($this->tuan));
		$field = array('_id' => true);
		$result = $this->_collection->fineOne($query, $field);
		if(isset($result['_id']) && $result['_id']) return true;
		else return false;
	}

	public function get_all_id_user(){
		$arr_user = array();
		$result = $this->get_all_list();
		if($result){
			foreach ($result as $hs) {
				if($hs['hiepsi']){
					foreach($hs['hiepsi'] as $h){
						$arr_user[] = new MongoId($h['id_user']);
					}
				}
			}
		}
		return $arr_user;
	}

}
?>