<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$nguoichoi = new NguoiChoi_5();$gridfs = new GridFS();

if($act == 'check'){
	$nguoichoi->id = $id; $nc = $nguoichoi->get_one();
	$users->id = $nc['id_user'];$us = $users->get_one();
	$arr = array(
		'id' => $id,
		'act' => $act,
		'hotennguoichoi' => $us['hoten'],
		'old_hinhanh' => $nc['hinhanh'] ? strval($nc['hinhanh']) : '',
		'hinhanh' => $nc['hinhanh'] ? '<a href="image.html?id='.$nc['hinhanh'].'" data-lightbox="gallery-group-1"><img src="image.html?id='.$nc['hinhanh'].'" height="50"/></a>' : '',
		'maso' => $nc['maso'],
		'id_tinhtrang' => isset($nc['tinhtrang']['t']) ? $nc['tinhtrang']['t'] : 0,
		'noidung' => isset($nc['tinhtrang']['noidung']) ? $nc['tinhtrang']['noidung'] : '',
		'diem' => isset($nc['diem']) ? $nc['diem'] : ''
	);
	echo json_encode($arr);
}

if($act == 'del'){
	$nguoichoi->id = $id; $nc = $nguoichoi->get_one();
	if(isset($nc['hinhanh']) && $nc['hinhanh']) {
		$gridfs->id = $nc['hinhanh']; $gridfs->delete();
	}
	if($nguoichoi->delete()) transfers_to('nguoichoi_5.html?msg=Xoá thành công');
}
?>