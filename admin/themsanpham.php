<?php 
require_once('header.php'); 
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$sanpham = new sanpham();
if($id && $act=='del'){
    $sanpham->id = $id; $t = $sanpham->get_one();
    if($t['hinhanh']){
        foreach($t['hinhanh'] as $h){
            if(file_exists($target_images_home . $h['aliasname'])){
                @unlink($target_images_home . $h['aliasname']);
            }
        }
    }
    if($sanpham->delete()) transfers_to('sanpham.html?msg=Xóa thành công!');
}
$loaisanpham = new DanhMucSanPham();
$list = $sanpham->get_all_list();
$loaisanpham_list = $loaisanpham->get_all_list();
$id_loaisanpham='';
if($id && $act == 'edit'){
    $sanpham->id = $id; $t = $sanpham->get_one();
    $id_loaisanpham = $t['id_loaisanpham'];
    $ten = $t['ten'];
    $mota = $t['mota'];
    $orders = isset($t['orders']) ? $t['orders'] : 0;
    $hinhanh = $t['hinhanh']; $hienthi = $t['hienthi'];
    $gia = $t['gia']; $link = $t['link'];
}

if(isset($_POST['submit'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $id_loaisanpham = isset($_POST['id_loaisanpham']) ? $_POST['id_loaisanpham'] : '';
    $act = isset($_POST['act']) ? $_POST['act'] : '';
    $ten = isset($_POST['ten']) ? $_POST['ten'] : '';
    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
    $hienthi = isset($_POST['hienthi']) ? $_POST['hienthi'] : '';
    $orders = isset($_POST['orders']) ? $_POST['orders'] : '';
    $gia = isset($_POST['gia']) ? $_POST['gia'] : '';
    $link = isset($_POST['link']) ? $_POST['link'] : '';
    $arr_hinhanh = array();
    $hinhanh_aliasname = isset($_POST['hinhanh_aliasname']) ? $_POST['hinhanh_aliasname'] : '';
    $hinhanh_filename = isset($_POST['hinhanh_filename']) ? $_POST['hinhanh_filename'] : '';
    $hinhanh_mota = isset($_POST['hinhanh_mota']) ? $_POST['hinhanh_mota'] : '';
    if($hinhanh_aliasname){
        foreach ($hinhanh_aliasname as $key => $value) {
            array_push($arr_hinhanh, array('filename' => $hinhanh_filename[$key], 'aliasname' => $value, 'mota' => $hinhanh_mota[$key]));
        }
    }
    $sanpham->id_loaisanpham = $id_loaisanpham;
    $sanpham->ten = $ten;
    $sanpham->mota = $mota;
    $sanpham->hinhanh = $arr_hinhanh;
    $sanpham->gia = intval($gia);
    $sanpham->link = $link;
    $sanpham->hienthi = $hienthi;
    $sanpham->orders = $orders;
    if($act == 'edit'){
        $sanpham->id = $id;
        if($sanpham->edit()) transfers_to('sanpham.html?msg=Chỉnh sửa thành công');
    } else {
        if($sanpham->insert()) transfers_to('sanpham.html?msg=Thêm thành công');
    }
}
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form-horizontal" data-parsley-validate="true" name="bannerform" id="tintucform" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> Nhập thông tin sản phẩm</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Loại sản phẩm</label>
                    <div class="col-md-9">
                    <select name="id_loaisanpham[]" id="id_loaisanpham" class="form-control select2" style="width:100%" multiple="multiple">
                    <?php
                    if($loaisanpham_list){
                        foreach($loaisanpham_list as $lsp){
                            echo '<option value="'.$lsp['_id'].'"'.(in_array($lsp['_id'], $id_loaisanpham) ? ' selected' : '').'>'.$lsp['ten'].'</option>';
                        }
                    }
                    ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tên sản phẩm</label>
                    <div class="col-md-3">
                        <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : '';?>">
                        <input type="hidden" name="act" id="act" value="<?php echo isset($act) ? $act : ''; ?>">
                        <input class="form-control" type="text" id="ten" name="ten" placeholder="Tên sản phẩm" data-parsley-required="true" value="<?php echo isset($ten) ? $ten : ''; ?>" />
                    </div>
                    <label class="col-md-3 control-label">Giá</label>
                    <div class="col-md-3">
                        <input class="form-control" type="number" id="gia" name="gia" placeholder="Giá" data-parsley-required="true" value="<?php echo isset($gia) ? $gia : ''; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Liên kết MyKingdom</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" id="link" name="link" placeholder="link" data-parsley-required="true" value="<?php echo isset($link) ? $link : ''; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Mô tả sản phẩm</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="mota" id="mota" placeholder="Mô tả" rows="5" data-parsley-required="true"><?php echo isset($mota) ? $mota : ''; ?></textarea>
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
                            <span>Chọn hình ảnh tốt nhất (500px x 500px)...</span>
                            <input type="file" name="hinhanh_files[]" accept="image/*" multiple class="hinhanh_dinhkem">
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
           	</div>
            <div class="panel-footer">
                <a href="sanpham.html" class="btn btn-white"><i class="fa fa-reply-all"></i> Trở về</a>
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>
</form>

<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="assets/js/trangchu.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/js/form-slider-switcher.demo.min.js"></script>
<script src="assets/plugins/ckeditor/ckeditor.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        upload_hinhanh();delete_file();
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
         CKEDITOR.replace( 'mota', {
            filebrowserBrowseUrl: 'assets/plugins/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });
        App.init();FormSliderSwitcher.init();TableManageDefault.init();
    });
</script>