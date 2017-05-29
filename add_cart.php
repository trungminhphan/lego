<?php 
require_once('header_none.php');
$id_sanpham = isset($_POST['id_sanpham']) ? $_POST['id_sanpham'] : '';
$soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 0;
$url = isset($_POST['url']) ? $_POST['url'] : '';
if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){
	$blnExists = false;
	foreach ($_SESSION['cart_items'] as $key => $value) {
		if($id_sanpham == $value['id_sanpham']){
			$new_soluong  = $soluong ? $soluong : $value['soluong'] + 1;
			$_SESSION['cart_items'][$key] = array('id_sanpham' => $id_sanpham, 'soluong' => $new_soluong);
			$blnExists = true;
		}
	}
	if($blnExists == false){
		$_SESSION['cart_items'][] = array('id_sanpham' => $id_sanpham, 'soluong' => $soluong ? $soluong : 1);	
	}
} else {
	$_SESSION['cart_items'][] = array('id_sanpham' => $id_sanpham, 'soluong' => $soluong ? $soluong : 1);
}

if($url){
	$arr_url = explode('?',$url);
	if(isset($arr_url[1]) && $arr_url[1]){
		if(!strpos($url, 'add_cart=ok'))
			$url .= '&add_cart=ok';
	} else {
		$url .= '?add_cart=ok';
	}
}
transfers_to(str_replace(".php",".html",$url));
?>