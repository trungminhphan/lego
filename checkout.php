<?php
require_once('header.php');
$id_user = ''; $sanpham = new SanPham();$donhang = new DonHang();
require('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'legomarketingteam@gmail.com';             // SMTP username
$mail->Password = 'qyohhytkzlfrapos';                        // SMTP password
$mail->SMTPSecure = 'ssl';                          // SMTP password
$mail->Port = 465;                                   // TCP port to connect to
$mail->CharSet = 'UTF-8';
$mail->setFrom('legomarketingteam@gmail.com', 'HIEPSINEXO.COM');
$mail->addAddress('legomarketingteam@gmail.com', 'THÔNG TIN ĐƠN HÀNG');
$mail->isHTML(true);
$mail->Subject = 'HIEPSINEXO.COM - THÔNG TIN ĐƠN HÀNG';
if(!isset($_SESSION['cart_items'])){ $msg = 'Hãy chọn sản phẩm đưa vào giỏ hàng'; }
if($users->isLoggedIn()){
	$id_user = $users->get_userid();
    $users->id = $id_user; $u = $users->get_one();
    $email = isset($u['email']) ? $u['email'] : '';
    $hoten = isset($u['hoten']) ? $u['hoten'] : '';
    $sodienthoai = isset($u['sodienthoai']) ? $u['sodienthoai'] : '';
    $diachi = isset($u['diachi']) ? $u['diachi'] : '';
}
if(isset($_POST['submit']) && isset($_SESSION['cart_items'])){
	$hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
    $sodienthoai = isset($_POST['sodienthoai']) ? $_POST['sodienthoai'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';   
    $ghichu = isset($_POST['ghichu']) ? $_POST['ghichu'] : ''; 

    $madonhang = strtoupper(uniqid());
    $tinhtrang = array(array('id_user' => $id_user ? new MongoId($id_user) : '', 'tinhtrang' => 0, 'ngaycapnhat' => new MongoDate(), 'noidung' => ''));
    $arr_sanpham = array();
    foreach ($_SESSION['cart_items'] as $key => $item) {
        $sanpham->id = $item['id_sanpham']; $csp = $sanpham->get_one();
        $thanhtien = $item['soluong'] * $csp['gia'];
        $arr = array(
            'id_sanpham' => new MongoId($item['id_sanpham']),
            'soluong' => intval($item['soluong']),
            'dongia' => $csp['gia'],
            'thanhtien' => $thanhtien,
            'tinhtrang' => $tinhtrang);
        array_push($arr_sanpham, $arr);
    }
    $_id = new MongoId();
    $ngaydathang = new MongoDate();
    $thongtingiaohang = array('hoten' => $hoten, 'diachi' => $diachi, 'sodienthoai' => $sodienthoai, 'email' => $email, 'ghichu' => $ghichu);
    $donhang->id = $_id;
    $donhang->id_user = $id_user ? $id_user : '';
    $donhang->madonhang = $madonhang;
    $donhang->sanpham = $arr_sanpham;
    $donhang->ngaydathang = $ngaydathang;
    $donhang->thongtingiaohang = $thongtingiaohang;
    if($donhang->insert_id()){
        $mail->addAddress($email, $hoten);
        $html = get_remote_data('http://hiepsinexo.com/get.chitietdonhang_email.php?id='.$_id);
        $mail->Body    = $html;
        $mail->AltBody = $html;
        $mail->send();
        unset($_SESSION['cart_items']);
        $msg = 'Đặt hàng thành công. Cám ơn quí khách đã mua sản phẩm.';
    }

}
?>
<link rel="stylesheet" type="text/css" href="css/universh/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/default.css">
<link rel="stylesheet" type="text/css" href="css/universh/theme.css">
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<script type="text/javascript" src="js/html5.messages.js"></script>
<div class="grid-row">
    <div class="grid-column">
        <div class="grid-content" data-format="sixteen-nine" style="max-width:960px;margin:auto;">
        <section class="bg-none pad-tb-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">ĐIỀN THÔNG TIN NGƯỜI ĐẶT HÀNG</h4>
                        <span class="separator line-separator"></span>
                    </div>                          
                </div>
                <?php if(isset($msg) && $msg): ?>
                <div class="alert alert-red alert-dismissible" role="alert" style="background:#ffff00;color:#ffff00;">
                    <h5><strong><?php echo $msg; ?></strong></h5>
                </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" id="register">                    
                    <div class="row">
                    	<div class="form-group col-md-6">
	                        <input type="text" required name="hoten" id="hoten" class="form-control" placeholder="Họ tên" value="<?php echo isset($hoten) ? $hoten: ''; ?>" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
	                    </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="sodienthoai" id="sodienthoai" required class="form-control" value="<?php echo isset($sodienthoai) ? $sodienthoai: ''; ?>" placeholder="Số điện thoại" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                        </div>
                    </div>
                    <div class="row">
                    	<div class="form-group col-md-6">
	                        <input type="email" name="email" id="email" value="<?php echo isset($email) ? $email: ''; ?>" required class="form-control" placeholder="Email" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
	                    </div>
	                    <div class="form-group col-md-6">
	                        <input type="text" name="diachi" id="diachi" required class="form-control" placeholder="Địa chỉ" value="<?php echo isset($diachi) ? $diachi: ''; ?>" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
	                    </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="ghichu" id="ghichu" class="form-control" placeholder="Ghi chú" value="<?php echo isset($ghichu) ? $ghichu: ''; ?>" />
                    </div>
                    <button class="btn-shopping pull-right" name="submit" type="submit"><i class="glyphicon glyphicon-check"></i>  ĐỒNG Ý</button>
                    <a href="products.html" class="pull-right btn-shopping"><i class="icon icon-shopping-cart-filled"></i> Tiếp tục mua hàng</a>
                </form>
            </div>
        </div>
    </div>
</section>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>