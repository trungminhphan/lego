<?php
require_once('header_none.php');
$id_user = $users->get_userid();
$tuan = isset($_POST['tuan']) ? $_POST['tuan'] : '';
$tungay = isset($_POST['tungay']) ? $_POST['tungay'] : '';
$denngay = isset($_POST['denngay']) ? $_POST['denngay'] : '';
$start_date = convert_date_yyyy_mm_dd_3($tungay, 0, 0, 1);
$end_date = convert_date_yyyy_mm_dd_3($denngay, 23, 59, 59);

if($start_date > $end_date){
	echo 'Chọn sai ngày';
} else {
	$arr_hiepsi = array();
	$hiepsituan = new HiepSiTuan();
	$nguoichoi = new NguoiChoi();
	$hiepsituan->tuan = $tuan;
	$hiepsituan->tungay = new MongoDate($start_date);
	$hiepsituan->denngay = new MongoDate($end_date);
	$hiepsituan->id_user = $id_user;
	$arr_user = $hiepsituan->get_all_id_user();
	$list = $nguoichoi->get_distinct_user($arr_user);
	$arr_user_diem = array();
	foreach ($list as $k => $v) {
		if(!in_array($v, $arr_user)){
			$nguoichoi->id_user = $v;
			$diem_1 = $nguoichoi->get_maxdiem_date(1, new MongoDate($start_date), new MongoDate($end_date));
	        $diem_2 = $nguoichoi->get_maxdiem_date(2, new MongoDate($start_date), new MongoDate($end_date));
	        $diem_3 = $nguoichoi->get_sumdiem_date(3, new MongoDate($start_date), new MongoDate($end_date));
	        $diem_4 = $nguoichoi->get_sumdiem_date(4, new MongoDate($start_date), new MongoDate($end_date));
	        $diem_5 = $nguoichoi->get_sumdiem_date(5, new MongoDate($start_date), new MongoDate($end_date));
	        $tongdiem = $diem_1 + $diem_2 + $diem_3 + $diem_4  + $diem_5;
	        array_push($arr_user_diem, array('id_user' => $v, 'diem' => $tongdiem));
	    }
	}
	$arr_user_diem = sort_array_1($arr_user_diem, 'diem', SORT_DESC);

	//$list = $nguoichoi->get_hiepsituan(new MongoDate($start_date), new MongoDate($end_date), $arr_user);
	if($arr_user_diem){
		foreach($arr_user_diem as $key => $value){
			if($key<20 && $value['diem'] > 0){
				array_push($arr_hiepsi, array('_id' => new MongoId(), 'id_user' => new MongoId($value['id_user']), 'diem' => intval($value['diem'])));
			}
		}
	}
	$hiepsituan->hiepsi = $arr_hiepsi;
	if($hiepsituan->insert()) transfers_to('hiepsituan.html?msg=Cập nhật thành công');

}
//echo date("d/m/Y H:i:s", convert_date_yyyy_mm_dd_3($tungay, 0, 0, 1));
//echo date("d/m/Y H:i:s", convert_date_yyyy_mm_dd_3($denngay, 23, 59, 59));
?>