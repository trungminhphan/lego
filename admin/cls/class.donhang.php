<?php
class DonHang{
	const COLLECTION = 'donhang';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $id_user = '';
	public $madonhang = '';
	public $sanpham = array(); //array(id_sanpham, id_seller, soluong, dongia, thanhtien, tinhtrang = //array(id_user, tinhtrang, ngaythang, noidung) chua giao hang, dang giao hang, huy don hang, da giao hang.);
	public $ngaydathang = '';
	public $tinhtrang = 0; //0 chưa giải quyết, 1 - giải quyết xong 
	public $thongtingiaohang = array();// fullname, address, phone, email.

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(DonHang::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find();
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_once_to_customer(){
		$query = array('_id' => new MongoId($this->id), 'id_user' => new MongoId($this->id_user));
		return $this->_collection->findOne($query);
	}

	public function get_list_recent(){
		$query = array('id_user' => new MongoId($this->id_user));
		return $this->_collection->find($query)->limit(10)->sort(array('ngaydathang' => -1));
	}
	public function get_list_to_customer(){
		$query = array('id_user' => new MongoId($this->id_user));
		return $this->_collection->find($query);
	}

	public function toggle_tinhtrang(){
		$query = array('$set' => array('tinhtrang' => $this->tinhtrang));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function insert(){
		$query = array(
			'id_user' => $this->id_user ? new MongoId($this->id_user) : '',
			'madonhang' => $this->madonhang,
			'sanpham' => $this->sanpham,
			'ngaydathang' => $this->ngaydathang,
			'thongtingiaohang' => $this->thongtingiaohang);
		return $this->_collection->insert($query);
	}

	public function insert_id(){
		$query = array(
			'_id' => new MongoId($this->id),
			'id_user' => $this->id_user ? new MongoId($this->id_user) : '',
			'madonhang' => $this->madonhang,
			'sanpham' => $this->sanpham,
			'ngaydathang' => $this->ngaydathang,
			'thongtingiaohang' => $this->thongtingiaohang);
		return $this->_collection->insert($query);
	}

	public function capnhattinhtrang($id_sanpham){
		$condition = array('_id' => new MongoId($this->id), 'sanpham.id_sanpham' => new MongoId($id_sanpham));
		$query = array('$push' => array('sanpham.$.tinhtrang' => array('$each'=>array($this->tinhtrang), '$position' => 0)));
		return $this->_collection->update($condition, $query);
	}
}