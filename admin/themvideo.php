<?php 
require_once('header.php'); 
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$video = new Video();$danhmucvideo = new DanhMucVideo();
if($id && $act=='del'){
    $video->id = $id; $t = $video->get_one();
    if($t['hinhanh']){
        foreach($t['hinhanh'] as $h){
            if(file_exists($target_images_home . $h['aliasname'])){
                @unlink($target_images_home . $h['aliasname']);
            }
        }
    }
    if($t['dinhkem']){
        foreach($t['dinhkem'] as $d){
            if(file_exists($target_videos_home . $d['aliasname'])){
                @unlink($target_videos_home . $d['aliasname']);
            }
        }
    }
    if($video->delete()) transfers_to('video.html?msg=Xóa thành công!');
}
$list = $video->get_all_list();
$danhmucvideo_list = $danhmucvideo->get_all_list();
if($id && $act == 'edit'){
    $video->id = $id; $t = $video->get_one();
    $id_danhmucvideo = $t['id_danhmucvideo'];
    $tieude = $t['tieude'];
    $mota = $t['mota'];
    $link = isset($t['link']) ? $t['link'] : '';
    $hinhanh = $t['hinhanh'];
    $hienthi = $t['hienthi'];
    $orders = isset($t['orders']) ? $t['orders'] : 0;
    $arr_video = $t['dinhkem'];
}
if(isset($_POST['submit'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $id_danhmucvideo = isset($_POST['id_danhmucvideo']) ? $_POST['id_danhmucvideo'] : '';
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    $tieude = isset($_POST['tieude']) ? $_POST['tieude'] : '';
    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
    $link = isset($_POST['link']) ? $_POST['link'] : '';
    $hienthi = isset($_POST['hienthi']) ? $_POST['hienthi'] : '';
    $orders = isset($_POST['orders']) ? $_POST['orders'] : '';
    $arr_hinhanh = array();
    $hinhanh_aliasname = isset($_POST['hinhanh_aliasname']) ? $_POST['hinhanh_aliasname'] : '';
    $hinhanh_filename = isset($_POST['hinhanh_filename']) ? $_POST['hinhanh_filename'] : '';
    $hinhanh_mota = isset($_POST['hinhanh_mota']) ? $_POST['hinhanh_mota'] : '';
    if($hinhanh_aliasname){
        foreach ($hinhanh_aliasname as $key => $value) {
            array_push($arr_hinhanh, array('filename' => $hinhanh_filename[$key], 'aliasname' => $value, 'mota' => $hinhanh_mota[$key]));
        }
    }

    $arr_video = array();
    $video_aliasname = isset($_POST['video_aliasname']) ? $_POST['video_aliasname'] : '';
    $video_filename = isset($_POST['video_filename']) ? $_POST['video_filename'] : '';
    $video_type = isset($_POST['video_type']) ? $_POST['video_type'] : '';
    $video_size = isset($_POST['video_size']) ? $_POST['video_size'] : '';
    if($video_aliasname){
        foreach ($video_aliasname as $key => $value) {
            array_push($arr_video, array('filename' => $video_filename[$key], 'aliasname' => $value, 'type' => $video_type[$key], 'size' => $video_size[$key]));
        }
    }
    
    $video->id_danhmucvideo = $id_danhmucvideo;
    $video->tieude = $tieude;
    $video->mota = $mota;
    $video->link = $link;
    $video->hinhanh = $arr_hinhanh;
    $video->hienthi = $hienthi;
    $video->orders = $orders;
    $video->dinhkem = $arr_video;

    if($act == 'edit'){
        $video->id = $id;
        $msg = 'Chỉnh sửa thành công';
        if($video->edit())  transfers_to('video.html?msg='.$msg);
    } else {
        $msg = 'Thêm thành công';
        if($video->insert()) transfers_to('video.html?msg='.$msg);
    }
}
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" name="bannerform" id="tintucform" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> Nhập thông tin Videos</h4>
            </div>
            <div class="panel-body">
            <?php
            if(isset($_POST['submit'])){
                var_dump($_FILES);
                } ?>
                <div class="form-group">
                    <label class="col-md-3 control-label">Loại Videos</label>
                    <div class="col-md-9">
                    <select name="id_danhmucvideo[]" id="id_danhmucvideo" multiple="multiple" class="form-control select2" style="width:100%">
                    <?php
                    if($danhmucvideo_list){
                        foreach($danhmucvideo_list as $dm){
                            echo '<option value="'.$dm['_id'].'"'.(in_array($dm['_id'],$id_danhmucvideo) ? ' selected' : '').'>'.$dm['ten'].'</option>';
                        }
                    }
                    ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tiêu đề</label>
                    <div class="col-md-9">
                        <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '';?>">
                        <input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>">
                        <input class="form-control" type="text" id="tieude" name="tieude" placeholder="Tên Videos" data-parsley-required="true" value="<?php echo isset($tieude) ? $tieude : ''; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Mô tả</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="mota" id="mota" placeholder="Mô tả" rows="10" data-parsley-required="true"><?php echo isset($mota) ? $mota : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Link</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" id="link" name="link" placeholder="Embed Videos" value="<?php echo isset($link) ? $link : ''; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Hiển thị</label>
                    <div class="col-md-3" id="hienthi_html">
                        <input type="checkbox" name="hienthi" id="hienthi" value="1" data-render="switchery" data-theme="default" <?php echo ($id && $hienthi == 0) ? '' : 'checked';?> /> 
                    </div>
                    <label class="col-md-3 control-label">Sắp xếp</label>
                    <div class="col-md-3" id="hienthi_html">
                        <input type="number" name="orders" id="orders" value="<?php echo isset($orders) ? $orders : 0; ?>" class="form-control"/> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn hình ảnh</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn hình ảnh đại diện (500px x 500px)...</span>
                            <input type="file" name="hinhanh_files[]" multiple accept="image/*" class="hinhanh_dinhkem">
                        </span>
                    </div>
                </div>
                <div id="hinhanh_list">
                <?php
                if(isset($hinhanh) && $hinhanh){
                    foreach($hinhanh as $h){
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-6"><input type="text" name="hinhanh_mota[]" value="'.$h['mota'].'" class="form-control" placeholder="Mô tả hình ảnh"></div>';
                        echo '<div class="col-md-6">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="hinhanh_aliasname[]" value="'.$h['aliasname'].'" readonly/>
                                <input type="text" class="form-control" name="hinhanh_filename[]" value="'.$h['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoahinhanh.html?filename='.$h['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn Videos</label>
                    <div class="col-md-3">
                        <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-file-image-o"></i>
                            <span>Chọn Videos [mp4, ogg, webm] dung lượng < 1024M</span>
                            <input type="file" name="video_file[]" accept="video/*" id="video_file">
                        </span>
                    </div>
                </div>
                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width:0%">0%</div>
                </div>
                <div id="video_list">
                <?php
                if(isset($arr_video) && $arr_video){
                    foreach($arr_video as $v){
                        echo '<div class="items form-group">';
                        echo '<div class="col-md-12">';
                        echo '<div class="input-group">
                                <input type="hidden" class="form-control" name="video_aliasname[]" value="'.$v['aliasname'].'" readonly/>
                                <input type="hidden" class="form-control" name="video_type[]" value="'.$v['type'].'" readonly/>
                                <input type="hidden" class="form-control" name="video_size[]" value="'.$v['size'].'" readonly/>
                                <input type="text" class="form-control" name="video_filename[]" value="'.$v['filename'].'" readonly/>
                                <span class="input-group-addon"><a href="get.xoavideo.html?filename='.$v['aliasname'].'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
                            </div></div></div>';
                    }
                }
                ?>
                </div>
            </div>
            <div class="panel-footer">
                <a href="video.html" class="btn btn-white"><i class="fa fa-reply-all"></i> Trở về</a>
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>
</form>
<div class="modal fade" id="modal-video">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Xem video</h4>
            </div>
            <div class="modal-body">
            <?php if(isset($video_link) && $video_link) : ?>
                <video width="100%" controls id="videos">
                  <source src="<?php echo $video_link; ?>" type="video/mp4">
                  <source src="<?php echo $video_link; ?>" type="video/ogg">
                  Trình duyệt không hỗ trợ vui lòng cài trình duyệt mới nhất.
                </video>
            <?php else: ?>
                <h3>Không có Video</h3>
            <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="assets/js/trangchu.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/js/form-slider-switcher.demo.min.js"></script>
<script src="assets/plugins/summernote/summernote.min.js"></script>
<script src="assets/js/form-summernote.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        upload_hinhanh();upload_video();delete_file();
        $(".select2").select2();
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        $("#modal-video").on('hidden.bs.modal', function () {
            $('video').trigger('pause');
        })
        $(".xoavideo").click(function(){
            var _link = $(this).attr("href");
            var _this = $(this);
            $.get(_link, function(d){
                if(d == 'OK') {
                    _this.hide();$(".xemvideo").hide();
                } else {
                    alert('Không thể xóa');
                }
            });
        });
        App.init();FormSummernote.init();FormSliderSwitcher.init();
    });
</script>