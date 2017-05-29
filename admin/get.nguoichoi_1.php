<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$nguoichoi = new NguoiChoi_1();$gridfs = new GridFS();

if($act == 'check'){
	$nguoichoi->id = $id; $nc = $nguoichoi->get_one();
	$users->id = $nc['id_user'];$us = $users->get_one();
	if($nc['hinhanh']){
		$gridfs->id = $nc['hinhanh']; $object = $gridfs->get_one_file();
		$hinhanh = '<a href="'.$target_images_home . 'medium-size/' . $nc['hinhanh'] . '_' . $object->file['filename'].'" data-lightbox="gallery-group-1"><img src="'.$target_images_home . 'thumb-size/' . $nc['hinhanh'] . '_' . $object->file['filename'].'" height="50"/></a>';
	} else {
		$hinhanh = '';
	}
	$arr = array(
		'id' => $id,
		'act' => $act,
		'hotennguoichoi' => $us['hoten'],
		'old_hinhanh' => $nc['hinhanh'] ? strval($nc['hinhanh']) : '',
		'hinhanh' => $hinhanh,
		'capdo' => $nc['capdo'],
		'id_tinhtrang' => isset($nc['tinhtrang']['t']) ? $nc['tinhtrang']['t'] : 0,
		'noidung' => isset($nc['tinhtrang']['noidung']) ? $nc['tinhtrang']['noidung'] : '',
		'diem' => isset($nc['diem']) ? $nc['diem'] : ''
	);
	echo json_encode($arr);
}

if($act == 'del'){
	$nguoichoi->id = $id; $nc = $nguoichoi->get_one();
	if(isset($nc['hinhanh']) && $nc['hinhanh']) {
		$gridfs->id = $nc['hinhanh']; $object = $gridfs->get_one_file();
		if(file_exists($target_images_home . 'medium-size/' . $nc['hinhanh'] . '_' . $object->file['filename'])){
			@unlink($target_images_home . 'medium-size/' . $nc['hinhanh'] . '_' . $object->file['filename']);
		}
		if(file_exists($target_images_home . 'thumb-size/' . $nc['hinhanh'] . '_' . $object->file['filename'])){
			@unlink($target_images_home . 'thumb-size/' . $nc['hinhanh'] . '_' . $object->file['filename']);
		}
		$gridfs->delete();
	}
	if($nguoichoi->delete()) transfers_to('nguoichoi_1.html?msg=Xoá thành công');
}
?>