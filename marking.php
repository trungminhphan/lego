<?php
require_once('header.php');
if(!$users->isLoggedIn()){
    transfers_to('./login.html?url=' . $_SERVER['REQUEST_URI']);
}
$gridfs = new GridFS();
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id_user = $users->get_userid();
if(isset($_POST['submit'])){
    $loaidiem = isset($_POST['loaidiem']) ? $_POST['loaidiem'] : 0;
    $hinhanh_file = strtolower($_FILES["hinhanh"]["name"]);
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
    if($loaidiem == 1){
        $nguoichoi = new NguoiChoi_1();
        if($hinhanh_file){
            $hinhanh = $gridfs->insert_files();
            $gridfs->id = $hinhanh; $object = $gridfs->get_one_file();
            $file = 'data:image/jpg;base64,' . base64_encode($object->getBytes());
            $medium = $target_images . 'medium-size/' . $hinhanh . '_' . $object->file['filename'];
            $thumb = $target_images . 'thumb-size/' . $hinhanh . '_' . $object->file['filename'];
            resize_image($file , null, 800 , 645 , false , $medium , false , false ,100 );
            resize_image($file , null, 100 , 100 , false , $thumb , false , false ,100 );
        }
        $capdo = isset($_POST['capdo']) ? $_POST['capdo'] : 0;
        $diem = $capdo;
        $nguoichoi->loaidiem = $loaidiem;
        $nguoichoi->id_user = $id_user;
        $nguoichoi->hinhanh = $hinhanh;
        $nguoichoi->capdo = $capdo;
        $nguoichoi->diem = $diem;
        if($nguoichoi->insert()) transfers_to('marking.html?msg=Thao tác hoàn tất. Điểm sức mạnh của bạn sẽ được cập nhật trong vòng 24 giờ');
    }

    if($loaidiem == 2){
        $nguoichoi = new NguoiChoi_2();
        if($hinhanh_file){
            $hinhanh = $gridfs->insert_files();
            $gridfs->id = $hinhanh; $object = $gridfs->get_one_file();
            $file = 'data:image/jpg;base64,' . base64_encode($object->getBytes());
            $medium = $target_images . 'medium-size/' . $hinhanh . '_' . $object->file['filename'];
            $thumb = $target_images . 'thumb-size/' . $hinhanh . '_' . $object->file['filename'];
            resize_image($file , null, 800 , 645 , false , $medium , false , false ,100 );
            resize_image($file , null, 100 , 100 , false , $thumb , false , false ,100 );
        }
        $capdo = isset($_POST['capdo']) ? $_POST['capdo'] : 0;
        $diem = $capdo;
        $nguoichoi->loaidiem = $loaidiem;
        $nguoichoi->id_user = $id_user;
        $nguoichoi->hinhanh = $hinhanh;
        $nguoichoi->capdo = $capdo;
        $nguoichoi->diem = $diem;
        if($nguoichoi->insert()) transfers_to('marking.html?msg=Thao tác hoàn tất. Điểm sức mạnh của bạn sẽ được cập nhật trong vòng 24 giờ');
    }
    if($loaidiem == 3){
        $nguoichoi = new NguoiChoi_3();
        if($hinhanh_file){
            $hinhanh = $gridfs->insert_files();
            $gridfs->id = $hinhanh; $object = $gridfs->get_one_file();
            $file = 'data:image/jpg;base64,' . base64_encode($object->getBytes());
            $medium = $target_images . 'medium-size/' . $hinhanh . '_' . $object->file['filename'];
            $thumb = $target_images . 'thumb-size/' . $hinhanh . '_' . $object->file['filename'];
            resize_image($file , null, 800 , 645 , false , $medium , false , false ,100 );
            resize_image($file , null, 100 , 100 , false , $thumb , false , false ,100 );
        }
        $sotien = isset($_POST['sotien']) ? $_POST['sotien'] : 0;
        $diem = intval($sotien/10000);
        $nguoichoi->loaidiem = $loaidiem;
        $nguoichoi->id_user = $id_user;
        $nguoichoi->hinhanh = $hinhanh;
        $nguoichoi->sotien = $sotien;
        $nguoichoi->diem = $diem;
        if($nguoichoi->insert()) transfers_to('marking.html?msg=Thao tác hoàn tất. Điểm sức mạnh của bạn sẽ được cập nhật trong vòng 24 giờ');
    }

    if($loaidiem == 4){
        $nguoichoi = new NguoiChoi_4();
        //if($hinhanh_file) $hinhanh = $gridfs->insert_files();
        $maso = isset($_POST['maso']) ? $_POST['maso'] : 0;
        $diem = 50;
        $nguoichoi->loaidiem = $loaidiem;
        $nguoichoi->id_user = $id_user;
        $nguoichoi->hinhanh = $hinhanh;
        $nguoichoi->maso = $maso;
        $nguoichoi->diem = $diem;
        if($nguoichoi->insert()) transfers_to('marking.html?msg=Thao tác hoàn tất. Điểm sức mạnh của bạn sẽ được cập nhật trong vòng 24 giờ');
    }

    if($loaidiem == 5){
        $nguoichoi->loaidiem = $loaidiem;
        $nguoichoi = new NguoiChoi_5();
        //if($hinhanh_file) $hinhanh = $gridfs->insert_files();
        $maso = isset($_POST['maso']) ? $_POST['maso'] : 0;
        $diem = 100;
        $nguoichoi->loaidiem = $loaidiem;
        $nguoichoi->id_user = $id_user;
        $nguoichoi->hinhanh = $hinhanh;
        $nguoichoi->maso = $maso;
        $nguoichoi->diem = $diem;
        if($nguoichoi->insert()) transfers_to('marking.html?msg=Thao tác hoàn tất. Điểm sức mạnh của bạn sẽ được cập nhật trong vòng 24 giờ');
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
                        <h4 class="title">NHẬP ĐIỂM</h4>
                        <span class="separator line-separator"></span>
                    </div>                          
                </div>
                <?php if(isset($msg) && $msg): ?>
                <div class="alert alert-red alert-dismissible" role="alert" style="background:#ffff00;color:#ffff00;">
                    <h5><strong><?php echo $msg; ?></strong></h5>
                </div>
                <?php endif; ?>
                <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                    <div class="input-text form-group">
                        <select name="loaidiem" id="loaidiem" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" class="form-control" style="font-size: 30px;">
                        <option value="">Chọn loại điểm</option>
                        <?php
                        foreach ($arr_loaidiem as $key => $value) {
                        	echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div id="form_nhapdiem"></div>
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
		$("#loaidiem").change(function(){
			var k = $(this).val();
			$.get('get.marking.html?k='+k, function(data){
				$("#form_nhapdiem").html(data);
			});
		});
	});
</script>