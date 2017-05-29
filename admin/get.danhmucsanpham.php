<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$danhmucsanpham = new DanhMucSanPham();$sanpham = new SanPham();
if($act == 'del' && $id){
	$danhmucsanpham->id = $id; $dm = $danhmucsanpham->get_one();
	if($sanpham->check_dmsanpham($id)){
		transfers_to('danhmucsanpham.html?msg=Không thể xoá, ràng buộc trường dữ liệu các thông tin Sản phẩm!');
	} else {
		if($danhmucsanpham->delete()) transfers_to('danhmucsanpham.html?msg=Xóa thành công!');
		else transfers_to('danhmucsanpham.html?msg=Không thể xóa, ràng buộc Sản phẩm');
	}	
}

if($act == 'edit'){
	$danhmucsanpham->id = $id; $dm = $danhmucsanpham->get_one();
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $dm['ten']	);
	echo json_encode($arr);
}
?>