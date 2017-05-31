<?php
require_once('header_none.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : '';
$id_user_check = $users->get_userid();
$nguoichoi = new NguoiChoi();$gridfs = new GridFS();
if($act == 'khongxetduyet'){
	$nguoichoi->id = $id; $nc = $nguoichoi->get_one();
	$collapse = isset($_GET['collapse']) ? $_GET['collapse'] : '';
	$k = isset($_GET['k']) ? $_GET['k'] : '';
	$arr = array(
		'id' => $id,
		'act' => $act,
		'id_user' => $id_user,
		'collapse' => $collapse,
		'k' => $k,
		'noidung' => isset($nc['tinhtrang']['noidung']) ? $nc['tinhtrang']['noidung'] : ''
	);
	echo json_encode($arr);
}

if($act == 'xetduyet'){
	$nguoichoi->id = $id;
	$arr_tinhtrang = array('t' => 1, 'noidung' => 'Đồng ý', 'date_post' => new MongoDate(), 'id_user' => new MongoId($id_user_check));
	$nguoichoi->tinhtrang = $arr_tinhtrang;
	if($nguoichoi->tinhtrang()){
		$nguoichoi->id_user = $id_user;
		$diem_1 = $nguoichoi->get_maxdiem(1);
        $diem_2 = $nguoichoi->get_maxdiem(2);
        $diem_3 = $nguoichoi->get_sumdiem(3);
        $diem_4 = $nguoichoi->get_sumdiem(4);
        $diem_5 = $nguoichoi->get_sumdiem(5);
        $tongdiem = $diem_1 + $diem_2 + $diem_3 + $diem_4 + $diem_5;
        echo $tongdiem;
	}
}
if($act == 'del_all'){
	$list = $nguoichoi->get_list_uncheck();
	if($list){
		foreach($list as $l){
			if(isset($l['hinhanh']) && $l['hinhanh']){
				$gridfs->id = $l['hinhanh']; $object = $gridfs->get_one_file();
				if(file_exists($target_images_home . 'medium-size/' . $l['hinhanh'] . '_' . $object->file['filename'])){
					@unlink($target_images_home . 'medium-size/' . $l['hinhanh'] . '_' . $object->file['filename']);
				}
				if(file_exists($target_images_home . 'thumb-size/' . $l['hinhanh'] . '_' . $object->file['filename'])){
					@unlink($target_images_home . 'thumb-size/' . $l['hinhanh'] . '_' . $object->file['filename']);
				}
				$gridfs->delete();
			}
		}
	}
	if($nguoichoi->delete_uncheck()) transfers_to('nguoichoi.html?msg=Xoá thành công');
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
	if($nguoichoi->delete()){
		$nguoichoi->id_user = $id_user;
		$diem_1 = $nguoichoi->get_maxdiem(1);
        $diem_2 = $nguoichoi->get_maxdiem(2);
        $diem_3 = $nguoichoi->get_sumdiem(3);
        $diem_4 = $nguoichoi->get_sumdiem(4);
        $diem_5 = $nguoichoi->get_sumdiem(5);
        $tongdiem = $diem_1 + $diem_2 + $diem_3 + $diem_4 + $diem_5;
        echo $tongdiem;
	}
}
?>