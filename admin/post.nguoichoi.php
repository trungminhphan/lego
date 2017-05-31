<?php
require_once('header_none.php');
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$id_user_check = $users->get_userid();
$nguoichoi = new NguoiChoi();
$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
$collapse = isset($_POST['collapse']) ? $_POST['collapse'] : '';
$k = isset($_POST['k']) ? $_POST['k'] : '';
if($act == 'khongxetduyet'){
	$nguoichoi->id = $id;
	$arr_tinhtrang = array('t' => 2, 'noidung' => $noidung, 'date_post' => new MongoDate(), 'id_user' => new MongoId($id_user_check));
	$nguoichoi->tinhtrang = $arr_tinhtrang;
	if($nguoichoi->tinhtrang()){
		transfers_to('nguoichoi.html?act='.$k.'&id_show=' . $id_user .'#'.$collapse);
	}
}
?>