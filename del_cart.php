<?php 
require_once('header_none.php');
$id_sanpham = isset($_GET['id_sanpham']) ? $_GET['id_sanpham'] : '';
$key = isset($_GET['key']) ? $_GET['key'] : '';
$url = isset($_GET['url']) ? $_GET['url'] : '';

if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){
	unset($_SESSION['cart_items'][$key]);
}

transfers_to(str_replace(".php",".html",$url));
?>