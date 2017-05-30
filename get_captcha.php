<?php
require_once('header_none.php');
$captcha = $users->generate_capcha();
echo $captcha;
?>