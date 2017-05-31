<?php
require_once('header.php');
check_permis($users->is_admin());
if(isset($_POST['submit'])){
	$username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = '123456';
    $hoten = $username;
    $users->username = $username;
    if($users->check_exist_username()){
        $msg = 'Tài khoản đã tồn tại';
    } else {
        $users->password = $password;
        $users->roles = 4;
        $users->hoten = $hoten;
        $users->namsinh = '';
        $users->sodienthoai = $username;
        $users->diachi = '';
        $users->id_dmthanhpho = '';
        $users->email = '';
        $users->hinhanh = '';
        if($users->insert()) $msg = 'Đăng ký thành công';
        else $msg = 'Không thể đăng ký';
    }
}
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="adduserform" class="form-horizontal" data-parsley-validate="true">
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-search"></i> Thông tin tài khoản người dùng</h4>
            </div>
            <div class="panel-body">
		    	<div class="form-group">
		            <div class="col-md-3">
		            	<div class="input-group">
	            			<input type="text" name="username" id="username" value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Số điện thoại" class="form-control input-lg" data-parsley-required="true" style="font-size: 20px;"/>
	            			<span class="input-group-addon p-0"><button name="submit" id="submit" value="OK" class="btn btn-primary btn-lg"><i class="fa fa-check-circle-o"></i> OK</button></span>
	            		</div>
		            </div>
		            <div class="col-md-3 col-sm-12 text-left">
		            	
		            </div>
		        </div>
		    </div>
		</div>
    </div>
</div>
</form>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/js/apps.min.js"></script>
<script>
    $(document).ready(function() {
    	<?php if(isset($msg) && $msg): ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        App.init();
    });
</script>