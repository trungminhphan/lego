<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$danhmucvideo = new DanhMucVideo();$video = new Video();
if($act == 'del' && $id){
	$danhmucvideo->id = $id; $dm = $danhmucvideo->get_one();
	if($tintuc->check_dmvideo($id)){
		transfers_to('danhmucvideo.html?msg=Không thể xoá, ràng buộc trường dữ liệu các thông tin Tin tức!');
	} else {
		if($danhmucvideo->delete()) transfers_to('danhmucvideo.html?msg=Xóa thành công!');
		else transfers_to('danhmucvideo.html?msg=Không thể xóa, ràng buộc tin tức');
	}	
}

if($act == 'edit'){
	$danhmucvideo->id = $id; $dm = $danhmucvideo->get_one();
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $dm['ten'],
		'orders' => isset($dm['orders']) ? $dm['orders'] : 0
	);
	echo json_encode($arr);
}
?>