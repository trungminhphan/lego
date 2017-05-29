<?php
require_once('header_none.php');
$danhmucvideo = new DanhMucVideo();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

$ten = isset($_POST['ten']) ? $_POST['ten'] : '';

$danhmucvideo->ten = $ten;

if($act == 'edit'){
	$danhmucvideo->id = $id;
	if($danhmucvideo->edit()) {
		if($url) transfers_to($url);
		else transfers_to('danhmucvideo.html?msg=Chỉnh sửa thành công!');
	}
} else {
	if($danhmucvideo->insert()){
		if($url) transfers_to($url);
		else transfers_to('danhmucvideo.html?msg=Thêm nơi thành công!');
	}
}
?>
