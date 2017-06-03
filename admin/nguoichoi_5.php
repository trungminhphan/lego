<?php
require_once('header.php');
check_permis($users->is_admin());
$nguoichoi = new NguoiChoi_5();
$nguoichoi_list = $nguoichoi->get_all_list();
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Duyệt điểm cho <?php echo $arr_loaidiem[5]; ?></h4>
            </div>
            <div class="panel-body">
            	<a href="#modal-kiemduyet" data-toggle="modal" class="btn btn-primary m-10"><i class="fa fa-plus"></i> Thêm mới</a>
	            <table id="data-table" class="table table-striped table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Thành viên</th>
                            <!--<th class="text-center">Hình ảnh</th>-->
                            <th class="text-center">Mã số</th>
                            <th class="text-center">Điểm</th>
                            <th class="text-center">Ngày nhập</th>
                            <th class="text-center">Tình trạng</th>
                            <th class="text-center"><i class="fa fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($nguoichoi_list){
                        $i=1;
                        foreach($nguoichoi_list as $nc){
                            $users->id = $nc['id_user'];$us = $users->get_one();
                            $tt = isset($nc['tinhtrang']['t']) ? $nc['tinhtrang']['t'] : 0;
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$us['username'].'</td>';
                           // echo '<td class="text-center">'. ($nc['hinhanh'] ? '<a href="image.html?id='.$nc['hinhanh'].'" data-lightbox="gallery-group-1"><img src="image.html?id='.$nc['hinhanh'].'" height="30" /></a>' : '').'</td>';
                            echo '<td class="text-center" width="150">'.$nc['maso'].'</td>';
                            echo '<td class="text-center" width="100">'.(isset($nc['diem']) ? $nc['diem'] : '').'</td>';
                            echo '<td class="text-center" width="150">'.date("d/m/Y H:i", $nc['date_post']->sec).'</td>';
                            echo '<td class="text-center" width="300"><a href="get.nguoichoi_5.html?id='.$nc['_id'].'&act=check#modal-kiemduyet" class="kiemduyet" data-toggle="modal" id="tinhtrang_'.$nc['_id'].'">'.$arr_tinhtrang[$tt].'</a></td>';
                            echo '<td class="text-center"><a href="get.nguoichoi_5.html?id='.$nc['_id'].'&act=del" onclick="return confirm(\'Chắc chắn muốn xoá\');"><i class="fa fa-trash"></i></a></td>';
                            echo '</tr>';$i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-kiemduyet">
<form action="post.nguoichoi_5.html" method="POST" class="form-horizontal" data-parsley-validate="true" id="nguoichoiform" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" />
<input type="hidden" name="act" id="act" />
<input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Thông tin điểm dành cho người chơi: <b><?php echo $arr_loaidiem[5]; ?></b></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Người chơi</label>
                    <div class="col-md-9 p-t-5" id="hotennguoichoi"></div>
                </div>
	            <div class="form-group">
	                <label class="col-md-3 control-label">Hình ảnh:</label>
	                <div class="col-md-3">
	                    <span class="btn btn-success fileinput-button">
	                        <i class="fa fa-plus"></i>
	                        <span>Chọn hình ảnh...</span>
	                        <input type="file" name="hinhanh" id="hinhanh" accept="*/image">
	                    </span>
	                    <input type="hidden" name="old_hinhanh" id="old_hinhanh" value="<?php echo isset($hinhanh) ? $hinhanh : ''; ?>"/>
	                </div>
                    <div class="col-md-3" id="old_hinhanh_show"></div>
	            </div>
	            <div class="form-group">
	                <label class="col-md-3 control-label">Mã số</label>
	                <div class="col-md-3">
	                    <input type="text" name="maso" id="maso" value="" class="form-control" data-parsley-required="true"/>
	                </div>
	                <label class="col-md-3 control-label">Tình trạng</label>
	                <div class="col-md-3">
		               	<select name="id_tinhtrang" id="id_tinhtrang" class="form-control select2" style="width:100%">
		               	<?php
		               	foreach ($arr_tinhtrang as $key => $value) {
		               		echo '<option value="'.$key.'">'.$value.'</option>';
		               	}
		               	?>
		               	</select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-md-3 control-label">Nội dung xử lý</label>
	                <div class="col-md-9">
	                    <input type="text" name="noidung" id="noidung" value="" class="form-control"/>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-md-3 control-label">Điểm</label>
	                <div class="col-md-3">
	                    <input type="diem" name="diem" id="diem" value="" class="form-control" data-parsley-required="true"/>
	                </div>
	            </div>
        	</div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
                <button name="submit" id="submit-kiemduyet" data-dismiss="modal" class="btn btn-sm btn-success">Lưu</button>
            </div>
        </div>
    </div>
</form>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/parsley/dist/parsley.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/lightbox/js/lightbox.min.js"></script>
<script src="assets/js/gallery.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        var _id, _link;
        $(".kiemduyet").click(function(){
            _link = $(this).attr("href");
            _id = $(this).attr("id");
            $.getJSON(_link, function(data){
                $("#id").val(data.id);$("#act").val(data.act);
                $("#hotennguoichoi").html(data.hotennguoichoi);
                $("#id_tinhtrang").val(data.id_tinhtrang);
            	$("#maso").val(data.maso);
                $("#old_hinhanh_show").html(data.hinhanh);
                $("#old_hinhanh").val(data.old_hinhanh);
                $("#noidung").val(data.noidung);
                $("#diem").val(data.diem);
                $("#submit-kiemduyet").click(function(){
                    var formData = new FormData($("#nguoichoiform")[0]);
                    $.ajax({
                        url: "post.nguoichoi_1.php", type: "POST",
                        data: formData, async: false,
                        success: function(datas) {
                            if(datas=='Failed'){
                                $.gritter.add({
                                    title:"Không thể duyệt",
                                    text:"Không thể không thể duyệt",
                                    image:"assets/img/login.png",
                                    sticky:false,
                                    time:""
                                });
                            } else {
                                $("#" + _id).text(datas);
                            }
                        },
                        cache: false, contentType: false, processData: false
                    }).fail(function() {
                        $.gritter.add({
                            title:"Không thể duyệt",
                            text:"Không thể duyệt",
                            image:"assets/img/login.png",
                            sticky:false,
                            time:""
                        });
                    });
                });
            });
        });
        <?php if(isset($msg) && $msg): ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>  
        $("#data-table").DataTable({responsive:!0, "pageLength": 100, "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'});
        App.init();Gallery.init();

    });
</script>