<?php 
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$hiepsituan = new HiepSiTuan();
$list = $hiepsituan->get_all_list();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
<div class="col-md-12">
	<div class="panel panel-danger">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-gears"></i> Danh sách HIỆP SĨ THEO TUẦN</h4>
        </div>
        <div class="panel-body">
            <a href="#modal-hiepsituan" data-toggle="modal" class="btn btn-primary m-b-10" id="themmoi"><i class="fa fa-plus"></i> Chốt danh sách tuần</a>
            <table id="data-table" class="table table-striped table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tuần</th>
                        <th class="text-center">Từ ngày</th>
                        <th class="text-center">Đến ngày</th>
                        <th class="text-center"><i class="fa fa-users"></i></th>
                        <th class="text-center"><i class="fa fa-trash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($list){
                        $i = 1;
                        foreach($list as $l){
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$l['tuan'].'</td>';
                            echo '<td class="text-center">'.date("d/m/Y", $l['tungay']->sec).'</td>';
                            echo '<td class="text-center">'.date("d/m/Y", $l['denngay']->sec).'</td>';
                            echo '<td class="text-center"><a href="get.hiepsituan.html?id='.$l['_id'].'&act=list#modal-danhsachhiepsi" data-toggle="modal" class="danhsachhiepsi"><i class="fa fa-users"></i></a></td>';
                            echo '<td class="text-center"><a href="get.hiepsituan.html?id='.$l['_id'].'&act=del" onclick="return confirm(\'Chắc chắn muốn xóa\')"><i class="fa fa-trash"></i></a></td>';
                            echo '</tr>';$i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-danhsachhiepsi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">DANH SÁCH HIỆP SĨ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group" id="danhsachhiepsi">
                    
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-white" data-dismiss="modal">Đóng</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-hiepsituan">
<form action="post.hiepsituan.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="congtyform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">CHỐT DANH SÁCH HIỆP SĨ TUẦN</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">TUẦN</label>
                    <div class="col-md-9">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="act" id="act" />
                        <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="text" name="tuan" id="tuan" value="" class="form-control" data-parsley-required="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">TỪ NGÀY</label>
                    <div class="col-md-3">
                        <input type="text" name="tungay" id="tungay" value="" class="form-control ngaythangnam" data-date-format="dd/mm/yyyys" data-inputmask="'alias': 'date'" data-parsley-required="true"/>
                    </div>
                    <label class="col-md-3 control-label">ĐẾN NGÀY</label>
                    <div class="col-md-3">
                        <input type="text" name="denngay" id="denngay" value="" class="form-control ngaythangnam" data-date-format="dd/mm/yyyys" data-inputmask="'alias': 'date'" data-parsley-required="true"/>
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
<!--<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>-->
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/table-manage-default.demo.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        $(".danhsachhiepsi").click(function(){
            var _link = $(this).attr("href");
            $.get(_link, function(data){
                $("#danhsachhiepsi").html(data);
                $("#data-table-1").DataTable({
                    responsive:!0,
                    "pageLength": 20,
                    dom:"Bfrtip",
                    buttons:[
                        {extend:"excel",className:"btn-sm"},
                        {extend:"pdf",className:"btn-sm"},
                        {extend:"print",className:"btn-sm"}
                    ],
                });
            });
        });
        $(".ngaythangnam").datepicker({todayHighlight:!0});
        $(".ngaythangnam").inputmask();
        <?php if(isset($msg) && $msg) : ?>
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