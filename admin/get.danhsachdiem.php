<?php
require_once('header_none.php');
$danhsachdiem = new DanhSachDiem();
$nguoichoi = new NguoiChoi();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] :'';
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] :'';
if($act == 'del'){
	$nguoichoi->id_user = $id_user;
	$danhsachdiem->id = $id;
	if($danhsachdiem->delete()){
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