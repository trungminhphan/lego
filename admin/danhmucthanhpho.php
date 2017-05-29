<?php
require_once('header.php');
check_permis($users->is_admin());
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$danhmucthanhpho = new DanhMucThanhPho();
$danhmucthanhpho_list = $danhmucthanhpho->get_all_list();
?>
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Danh mục Thành phố</h4>
            </div>
            <div class="panel-body">
                <a href="#modal-dmcongty" data-toggle="modal" class="btn btn-primary m-10 themdmcongty"><i class="fa fa-plus"></i> Thêm mới</a>
                <table id="data-table" class="table table-striped table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Thành phố</th>
                            <th class="text-center"><i class="fa fa-trash"></i></th>
                            <th class="text-center"><i class="fa fa-pencil"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($danhmucthanhpho_list){
                        $i = 1;
                        foreach ($danhmucthanhpho_list as $dm) {
                            echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.$dm['ten'].'</td>
                                <td class="text-center"><a href="get.danhmucthanhpho.html?id='.$dm['_id'].'&act=del" onclick="return confirm(\'Chắc chắn muốn xoá?\');"><i class="fa fa-trash"></i></a></td>
                                <td class="text-center"><a href="get.danhmucthanhpho.html?id='.$dm['_id'].'&act=edit#modal-dmcongty" data-toggle="modal" class="suadmcongty"><i class="fa fa-pencil"></i></a></td>
                            </tr>';$i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-dmcongty">
<form action="post.danhmucthanhpho.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="congtyform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Thông tin Thành phố</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Tên Thành phố</label>
                    <div class="col-md-9">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="act" id="act" />
                        <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="text" name="ten" id="ten" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-success">Lưu</button>
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
<script src="assets/js/table-manage-default.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        $("#themdmcongty").click(function(){
            $("#id").val();$("#act").val();
        });
        
        $(".suadmcongty").click(function(){
            var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                $("#id").val(data.id); $("#act").val(data.act);
                $("#ten").val(data.ten);
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
        App.init();TableManageDefault.init();
    });
</script>