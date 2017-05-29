<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
$session = new SessionManager();
$users = new Users();
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
if($users->isLoggedIn()) $user_default = $users->get_one_default();
$url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : 'index.html'; $a = explode("/", $url); $l = end($a);
?>