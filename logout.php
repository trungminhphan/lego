<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
require_once('admin/inc/functions.inc.php');
$session = new SessionManager();
$users = new Users();
$users->push_logs_out();
$users->logout();
transfers_to('./login.html');
exit;

?>