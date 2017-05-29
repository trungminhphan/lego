<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$danhmucthanhpho = new DanhMucThanhPho();
if($act == 'del' && $id){
	$danhmucthanhpho->id = $id; $dm = $danhmucthanhpho->get_one();
	if($users->check_dmthanhpho($id)){
		transfers_to('danhmucthanhpho.html?msg=Không thể xoá, ràng buộc trường dữ liệu các thông tin Tài khoản người dùng!');
	} else {
		if($danhmucthanhpho->delete()) transfers_to('danhmucthanhpho.html?msg=Xóa thành công!');
		else transfers_to('danhmucthanhpho.html?msg=Không thể xóa, ràng buộc tài khoản người dùng');
	}	
}

if($act == 'edit'){
	$danhmucthanhpho->id = $id; $dm = $danhmucthanhpho->get_one();
	$arr = array(
		'id' => $id,
		'act' => $act,
		'ten' => $dm['ten']	);
	echo json_encode($arr);
}
?>