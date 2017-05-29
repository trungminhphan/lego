<?php
require_once('header.php');
if(!$users->isLoggedIn()){
    transfers_to('login.html?url=' . $_SERVER['REQUEST_URI']);
}
$gridfs = new GridFS();$danhmucthanhpho = new DanhMucThanhPho();
$thanhpho_list = $danhmucthanhpho->get_all_list();
$id_dmthanhpho = '';
$id_user = $users->get_userid();$users->id = $id_user; 
if(isset($_POST['submit'])){
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
    $namsinh = isset($_POST['namsinh']) ? $_POST['namsinh'] : '';
    $sodienthoai = isset($_POST['sodienthoai']) ? $_POST['sodienthoai'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $id_dmthanhpho = isset($_POST['id_dmthanhpho']) ? $_POST['id_dmthanhpho'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $hinhanh_file = $_FILES["hinhanh"]["name"];
    $hinhanh_size = $_FILES["hinhanh"]["size"];
    $hinhanh_type = $_FILES["hinhanh"]["type"];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $old_hinhanh = isset($_POST['old_hinhanh']) ? $_POST['old_hinhanh'] : '';
    $temp = explode(".", $hinhanh_file);
    if($hinhanh_file){
        $ext = end($temp);
        if($hinhanh_size < $max_file_size && in_array($ext, $images_extension)){
            $gridfs->filename = $hinhanh_file;
            $gridfs->filetype = $hinhanh_type;
            $gridfs->tmpfilepath = $hinhanh_tmp;
            $gridfs->caption = $hinhanh_file;
        } else {
            $msg = 'Dung lượng hình ảnh quá lớn hoặc không đúng định dạng';
        }
    } else {
        $hinhanh = $old_hinhanh;
    }
    $users->password = $password;
    $users->roles = 4;
    $users->hoten = $hoten;
    $users->namsinh = $namsinh;
    $users->sodienthoai = $sodienthoai;
    $users->diachi = $diachi;
    $users->id_dmthanhpho = $id_dmthanhpho;
    $users->email = $email;
    if($hinhanh_file) $hinhanh = $gridfs->insert_files();
    $users->hinhanh = $hinhanh;
    if($old_hinhanh && $hinhanh_file){
        $gridfs->id = $old_hinhanh; $gridfs->delete();
    }
    if($users->edit()) $msg = 'Chỉnh sửa thành công';
    else $msg = 'Không thể Chỉnh sửa';
    
}
$u = $users->get_one();
$username = $u['username']; $hoten = $u['hoten'];
$namsinh = $u['namsinh']; $sodienthoai = $u['sodienthoai'];
$diachi = $u['diachi']; $id_dmthanhpho = $u['id_dmthanhpho'];
$email = $u['email']; $hinhanh = $u['hinhanh'];
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
                        <h4 class="title">CHỈNH SỬA THÔNG TIN TÀI KHOẢN</h4>
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
                        <div class="form-group col-md-12" style="font-size: 18px;color:#fff;">
                            (*) Bắt buộc nhập dữ liệu
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" value="<?php echo isset($username) ? $username: ''; ?>" required name="username" id="username" class="form-control" placeholder="Tên tài khoản (*)" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" required name="password" id="password" class="form-control" value="<?php echo isset($password) ? $password: ''; ?>" placeholder="Mật khẩu (*)" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" required name="hoten" id="hoten" class="form-control" placeholder="Họ tên (*)" value="<?php echo isset($hoten) ? $hoten: ''; ?>" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="namsinh" id="namsinh" required class="form-control" placeholder="Năm sinh (*)" value="<?php echo isset($namsinh) ? $namsinh: ''; ?>" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="sodienthoai" id="sodienthoai" required class="form-control" value="<?php echo isset($sodienthoai) ? $sodienthoai: ''; ?>" placeholder="Số điện thoại bố/mẹ (*)" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" name="diachi" id="diachi" class="form-control" placeholder="Địa chỉ" value="<?php echo isset($diachi) ? $diachi: ''; ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <select name="id_dmthanhpho" id="id_dmthanhpho" class="form-control" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);">
                                <option value="">Chọn thành phố (*)</option>
                                <?php
                                foreach($thanhpho_list as $tp){
                                    echo '<option value="'.$tp['_id'].'"'.($tp['_id'] == $id_dmthanhpho ? ' selected' : '').'>'.$tp['ten'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" value="<?php echo isset($email) ? $email: ''; ?>" class="form-control" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <?php if(isset($hinhanh) && $hinhanh): ?>
                            <img src="image.html?id=<?php echo $hinhanh; ?>" height="100" align="left" style="margin-right:5px;"/>
                        <?php endif; ?>
                        <input type="hidden" name="old_hinhanh" id="old_hinhanh" value="<?php echo isset($hinhanh) ? $hinhanh : ''; ?>"/>
                        <div style="position:relative;">
                            <a class='btn btn-primary' href='javascript:;'>
                                Chọn hình ảnh...
                                <input type="file" name="hinhanh" id="hinhanh" accept="image/*" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val().replace("C:\\fakepath\\", ""));'>
                            </a>
                            &nbsp;
                            <span class='label label-info' id="upload-file-info"></span>
                        </div>
                        <button class="btn-shopping pull-right" name="submit" type="submit"><i class="glyphicon glyphicon-user"></i> CHỈNH SỬA</button>
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