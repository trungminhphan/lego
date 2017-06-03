<?php 
require_once('header.php');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$nguoichoi = new NguoiChoi();
//$sum_xephang = $nguoichoi->sum_xephang();
$list = $nguoichoi->get_distinct_user();
$arr_user = array();
if($list){
    foreach($list as $key => $value){
        $nguoichoi->id_user = $value;
        $diem_1 = $nguoichoi->get_maxdiem(1);
        $diem_2 = $nguoichoi->get_maxdiem(2);
        $diem_3 = $nguoichoi->get_sumdiem(3);
        $diem_4 = $nguoichoi->get_sumdiem(4);
        $diem_5 = $nguoichoi->get_sumdiem(5);
        $tongdiem = $diem_1 + $diem_2 + $diem_3 + $diem_4  + $diem_5;
        array_push($arr_user, array('id_user' => $value, 'diem' => $tongdiem));
    }
}
$arr_user = sort_array_1($arr_user, 'diem', SORT_DESC);
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<div class="col-md-12">
	<div class="panel panel-danger">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"><i class="fa fa-gears"></i> Danh sách HIỆP SĨ</h4>
        </div>
        <div class="panel-body">
        <table id="data-table" class="table table-striped table-bordered table-hovered">
            <thead>
                <tr>
                    <th>Hạng</th>
                    <th>Username</th>
                    <th>Họ tên</th>
                    <th>Điểm</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($arr_user){
                $i=1;
                foreach($arr_user as $k => $a){
                    if($a['diem'] > 0){
                        $users->id = $a['id_user'];$u = $users->get_one();
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$u['username'].'</td>';
                        echo '<td>'.$u['hoten'].'</td>';
                        echo '<td>'.format_number($a['diem']).'</td>';
                        echo '</tr>'; $i++;
                    }
                }
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        <?php if(isset($msg) && $msg) : ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>
        $("#data-table").DataTable({responsive:!0, "pageLength": 100, "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'});
        App.init();
    });
</script>