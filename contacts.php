<?php
require_once('header.php');
if(isset($_POST['submit'])){
	require('phpmailer/PHPMailerAutoload.php');
	$mail = new PHPMailer;
  //$mail->SMTPDebug = 3;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'legomarketingteam@gmail.com';             // SMTP username
	$mail->Password = 'qyohhytkzlfrapos';                        // SMTP password
	$mail->SMTPSecure = 'ssl';                          // SMTP password
	$mail->Port = 465;                                   // TCP port to connect to
	$mail->CharSet = 'UTF-8';
	$mail->setFrom('legomarketingteam@gmail.com', 'HIEPSINEXO.COM - LIÊN HỆ');
	$mail->addAddress('legomarketingteam@gmail.com', 'HIEPSINEXO.COM - LIÊN HỆ');
	$mail->isHTML(true);

	$hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
	$dienthoai = isset($_POST['dienthoai']) ? $_POST['dienthoai'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
	$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';

	$mail->Subject = $hoten . ' - LIÊN HỆ';
	$html = '
		<h3>HỌ TÊN: '.$hoten.'</h3>
    <h3>ĐIỆN THOẠI: '.$dienthoai.'</h3>
		<h3>EMAIL: '.$email.'</h3>
		<h3>NỘI DUNG: </h3>
		<p>'.$noidung.'</p>
	';
	$htmlAlt = '
		HỌ TÊN: '.$hoten.' <br />
    ĐIỆN THOẠI: '.$dienthoai.' <br />
		EMAIL: '.$email.' <br />
		'.$noidung.'
	';
	$mail->Body    = $html;
    $mail->AltBody = $htmlAlt;
    $mail->send();

    $mail->ClearAddresses();
    $mail->addAddress($email, 'HIEPSINEXO.COM - LIÊN HỆ');
    $mail->Subject = 'HIEPSINEXO.COM';
    $html = '
    	<h3>Cám ơn Anh/Chị đã liên hệ, chúng tôi sẽ phản hồi email sớm nhất có thể.</h3>
    	<hr />
    	<h3>THÔNG TIN LIÊN HỆ</h3>
    	<p><b>Công Ty Cổ Phần Việt Tinh Anh</b></p>
    	<p><b>Địa chỉ: 33-35 Đường D4, Khu Đô Thị Mới Him Lam, P.Tân Hưng, Q.7, HCM. </b></p>
    	<p><b>Email: legomarketingteam@gmail.com</b></p>
    	<p><b>Điện thoại: (84-8) 54 31 8717 – 18</b></p>
    ';
    $mail->Body    = $html;
    $mail->send();
	$msg = 'Cám ơn Anh/Chị đã liên hệ, chúng tôi sẽ phản hồi email sớm nhất có thể.';
}
?>
<link rel="stylesheet" type="text/css" href="css/universh/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/default.css">
<link rel="stylesheet" type="text/css" href="css/universh/theme.css">
<link rel="stylesheet" type="text/css" href="css/universh/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/univershicon.css">
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<script type="text/javascript" src="js/html5.messages.js"></script>
<section class="bg-none pad-tb-30">
    <div class="container" style="font-family:Tahoma !important;">
        <div class="row">
        	<div class="col-md-6 col-sm-6">
        		<div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title" style="font-family:Tahoma !important;font-style:normal;">THÔNG TIN LIÊN HỆ</h4>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
                <div class="row">
               		<div class="col-md-12">
                    <p  style="color:#ffff00;font-weight:bold;font-family:Tahoma !important;font-style: normal;font-size: 20px;">Bộ phận Marketing thương hiệu LEGO<br /> Công Ty Cổ Phần Việt Tinh Anh</p>
               			<h5 style="color:#fff;font-style: normal;font-family:Tahoma !important;"">Địa chỉ:</h5>
               			<p style="color:#ffff00;font-weight:bold;font-family:Tahoma !important;font-style:normal;font-size: 20px;"> Số 33-35 Đường D4, Khu Đô Thị Mới Him Lam, P.Tân Hưng, Quận 7, Tp. Hồ Chí Minh</p>
               		</div>
               	</div>
               	<div class="row">
               		<div class="col-md-12">
               			<h5 style="color:#fff;font-style: normal;font-family:Tahoma !important;"">Email:</h5>
               			<p style="color:#ffff00;font-weight:bold;font-family:Tahoma !important;font-style: normal;font-size: 20px;">legomarketingteam@gmail.com</p>
               		</div>
               	</div>
               	<div class="row">
               		<div class="col-md-12">
               			<h5 style="color:#fff;font-style: normal;font-family:Tahoma !important;">Điện thoại:</h5>
               			<p style="color:#ffff00;font-weight:bold;font-family:Tahoma !important;font-style: normal;font-size: 20px;"> (84-8) 54 31 8717/18, số nội bộ 440 <br />
                    Giờ làm việc: 09:00 – 18:00 <br/>
                    Từ Thứ Hai đến Thứ Sáu hàng tuần.
                    </p>                    
               		</div>
               	</div>
        	</div>
        	<div class="col-md-6 col-sm-6">
        		<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" id="contacts">
        		<div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title" style="font-family:Tahoma !important;font-style:normal;">Viết nhận xét</h4>
                        <span class="separator line-separator"></span>
                    </div>
                </div>
                <?php if(isset($msg) && $msg): ?>
                <div class="alert alert-red alert-dismissible" role="alert" style="background:#ffff00;">
                    <h5 style="color:#ff0000;"><strong><?php echo $msg; ?></strong></h5>
                </div>
                <?php endif; ?>
                <div class="row">
                	<div class="col-md-12 input-text form-group">
                		<input type="text" value="<?php echo isset($hoten) ? $hoten: ''; ?>" required name="hoten" id="hoten" class="form-control" placeholder="Họ tên" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" style="font-family: Tahoma !important; font-weight:bold;font-size:15px;"/>
                	</div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" value="<?php echo isset($dienthoai) ? $dienthoai: ''; ?>" required name="dienthoai" id="dienthoai" class="form-control" placeholder="Điện thoại" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" style="font-family: Tahoma !important; font-weight:bold;font-size:15px;"/>
                  </div>
                	<div class="col-md-6 form-group">
                		<input type="email" value="<?php echo isset($email) ? $email: ''; ?>" required name="email" id="email" class="form-control" placeholder="Email" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" style="font-family: Tahoma !important; font-weight:bold;font-size:15px;"/>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12 textarea-message form-group">
                		<textarea class="textarea-message form-control" name="noidung" id="noidung" rows="8" placeholder="Nội dung" style="font-family: Tahoma  !important; font-weight:bold;font-size:15px;"><?php echo isset($noidung) ? $noidung : ''; ?></textarea>
                	</div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                            <button class="btn-shopping" name="submit" type="submit"><i class="glyphicon glyphicon-send"></i> Gởi liên hệ</button>
                        </div>
                    </div>
                </form>
        	</div>
        </div>
    </div>
</section>
<?php require_once('footer.php'); ?>