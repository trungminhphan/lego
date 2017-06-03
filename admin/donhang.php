<?php
require_once('header.php'); 
$donhang = new DonHang();$sanpham = new SanPham();
$donhang_list = $donhang->get_all_list();
$id_user = $users->get_userid();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-gears"></i> Danh sách ĐƠN HÀNG</h4>
            </div>
            <div class="panel-body">
            <table id="data-table" class="table table-striped table-bordered table-hovered">
            <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Tổng cộng</th>
                <th>Ngày đặt</th>
                <th class="text-center">Xem</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($donhang_list){
                foreach($donhang_list as $dh){
                    $tongthanhtien = 0;
                    if($dh['sanpham']){
                        foreach($dh['sanpham'] as $sp){
                            $tongthanhtien += $sp['thanhtien'];
                        }
                    }
                    echo '<tr>
                            <td>'.$dh['madonhang'].'</td>
                            <td>'.$dh['thongtingiaohang']['hoten'].'</td>
                            <td>'.format_number($tongthanhtien).' VND</td>
                            <td>'.date("d/m/Y H:i", $dh['ngaydathang']->sec).'</td>';
                    
                    echo        '
                            <td class="text-center">
                            <a href="get.chitietdonhang.html?id='.$dh['_id'].'#modal-donhang" data-toggle="modal" class="chitietdonhang btn-white btn btn-xs btn-primary">Xem</a>
                            </td>
                        </tr>';
                }
            }
            ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-donhang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">CHI TIẾT ĐƠN HÀNG</h4>
            </div>
            <div class="modal-body" id="noidungdonhang">
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
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        $(".chitietdonhang").click(function(){
            var _link = $(this).attr("href");
            $.get(_link, function(data){
                $("#noidungdonhang").html(data);
            })
        });
        $("#data-table").DataTable({responsive:!0, "pageLength": 100,  "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'});
        App.init();
    });
</script>
