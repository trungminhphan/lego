<?php
require_once('header_none.php');
$danhmucsanpham = new DanhMucSanPham();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

$ten = isset($_POST['ten']) ? $_POST['ten'] : '';
$orders = isset($_POST['orders']) ? $_POST['orders'] : 0;
$danhmucsanpham->ten = $ten;
$danhmucsanpham->orders = $orders;
if($act == 'edit'){
	$danhmucsanpham->id = $id;
	if($danhmucsanpham->edit()) {
		if($url) transfers_to($url);
		else transfers_to('danhmucsanpham.html?msg=Chỉnh sửa thành công!');
	}
} else {
	if($danhmucsanpham->insert()){
		if($url) transfers_to($url);
		else transfers_to('danhmucsanpham.html?msg=Thêm thành công!');
	}
}
?>
