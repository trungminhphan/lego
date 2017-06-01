<?php
require_once('header.php');
$url = isset($_GET['url']) ? $_GET['url'] : '';
if($users->isLoggedIn()){
    transfers_to('./index.html');   
}
if(isset($_POST['submit'])){
    $username = $_POST['username'] ? $_POST['username'] : '';
    $password = $_POST['password'] ? $_POST['password'] : '';
    $url = $_POST['url'] ? $_POST['url'] : '';
    if($username && $password){
        if ($users->authenticate($username, $password)) {
        $users->push_logs_in();
        if($url) transfers_to($url);
            else transfers_to('profiles.html');
        } else {
            $msg = 'Lỗi đăng nhập, vui lòng kiểm tra tài khoản và mật khẩu';
        }    
    } else {
        $msg = 'Hãy nhập tài khoản đăng nhập và mật khẩu';
    }
    
}
?>
<link rel="stylesheet" type="text/css" href="css/universh/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/default.css">
<link rel="stylesheet" type="text/css" href="css/universh/theme.css">
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<script type="text/javascript" src="js/html5.messages.js"></script>
<section class="bg-none pad-tb-30">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="title-container text-left sm">
                    <div class="title-wrap">
                        <h4 class="title">ĐĂNG NHẬP</h4>
                        <span class="separator line-separator"></span>
                    </div>                          
                </div>
                <?php if(isset($msg) && $msg): ?>
                <div class="alert alert-red alert-dismissible" role="alert" style="background:#ffff00;color:#ffff00;">
                    <h5><strong><?php echo $msg; ?></strong></h5>
                </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="loginform">
                    <input type="hidden" name="url" id="url" value="<?php echo isset($url) ? $url : ''; ?>">
                    <div class="input-text form-group">
                        <input type="text" name="username" id="username" required value="<?php echo isset($username) ? $username: ''; ?>" class="input-name form-control" placeholder="Tên tài khoản" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                    </div>
                    <div class="input-email form-group">
                        <input type="password" name="password" id="password" required value="<?php echo isset($password) ? $password: ''; ?>" class="form-control" placeholder="Mật khẩu" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                    </div>
                    <div class="text-center">
                        <button class="btn-shopping" name="submit" type="submit"><i class="glyphicon glyphicon-log-in"></i> Đăng nhập</button>
                        <a href="users.html" class="btn-shopping"><i class="glyphicon glyphicon-user"></i> Đăng ký tài khoản</a>
                    </div>

                </form>
            </div>
            <div class="col-md-6 col-sm-6 text-center hide_mobile">
            	<img src="images/AvatarGenerator2.png" />
            </div>
        </div>
    </div>
</section>
<?php require_once('footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#username").on("keypress", function(e) {
            if(e.which == 32) return false;
        });
        $("#username").keyup(function(){
            var text = $(this).val();
            var newtext;
            newtext = text.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a").replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A").replace(/\ /g, '-').replace(/đ/g, "d").replace(/Đ/g, "D").replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y").replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g,"Y").replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u").replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g,"U").replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ.+/g,"o").replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ.+/g,"O").replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ.+/g, "e").replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ.+/g, "E").replace(/ì|í|ị|ỉ|ĩ/g,"i").replace(/Ì|Í|Ị|Ỉ|Ĩ/g,"I");
            $("#username").val(newtext);
        });
    });
</script>