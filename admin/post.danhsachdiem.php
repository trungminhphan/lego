<?php
require_once('header_none.php');
check_permis($users->is_admin());
$danhsachdiem = new DanhSachDiem();
if(isset($_POST['submit'])){
	$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
	$diem = isset($_POST['diem']) ? $_POST['diem'] : '';
	$collapse = isset($_POST['collapse']) ? $_POST['collapse'] : '';
	$danhsachdiem->id_user = $id_user;
	$danhsachdiem->diem = $diem;
	if($danhsachdiem->insert()) transfers_to('nguoichoi.html?id_show=' . $id_user . '#' . $collapse);
}
?>