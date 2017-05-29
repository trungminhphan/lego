<?php
require_once('header_none.php');
$danhmucthanhpho = new DanhMucThanhPho();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

$ten = isset($_POST['ten']) ? $_POST['ten'] : '';

$danhmucthanhpho->ten = $ten;

if($act == 'edit'){
	$danhmucthanhpho->id = $id;
	if($danhmucthanhpho->edit()) {
		if($url) transfers_to($url);
		else transfers_to('danhmucthanhpho.html?msg=Chỉnh sửa thành công!');
	}
} else {
	if($danhmucthanhpho->insert()){
		if($url) transfers_to($url);
		else transfers_to('danhmucthanhpho.html?msg=Thêm nơi thành công!');
	}
}
?>
