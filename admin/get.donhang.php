<?php
require_once('header_none.php');
$donhang = new DonHang();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$tinhtrang = isset($_GET['tinhtrang']) ? $_GET['tinhtrang'] : 0;

if($act == 'tinhtrang'){
	$donhang->id = $id; $donhang->tinhtrang = $tinhtrang;
	if($tinhtrang == 1) $t = 0;
	else $t = 1;
	if($donhang->set_tinhtrang()){
		echo '<a href="get.donhang.html?id='.$id.'&act=tinhtrang&tinhtrang='.$t.'" class="set_tinhtrang" onclick="return false;">'.$arr_donhang[$tinhtrang].'</a>';
	}
}
?>