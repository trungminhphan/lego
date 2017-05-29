 <?php
require_once('header_none.php');
$donhang = new DonHang();$sanpham = new SanPham();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$donhang->id = $id; $dh = $donhang->get_one();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Thông tin đơn hàng</h4>
            </div>
            <div class="panel-body" style="border:1px blue solid;">
            	<div class="row">
            		<label class="col-md-3 control-label">Mã đơn hàng</label>
            		<div class="col-md-9"><b><?php echo $dh['madonhang']; ?></b></div>
            	</div>
            	<div class="row">
            		<label class="col-md-3 control-label">Tên khách hàng</label>
            		<div class="col-md-9"><?php echo $dh['thongtingiaohang']['hoten']; ?></div>
            	</div>
            	<div class="row">
            		<label class="col-md-3 control-label">Địa chỉ</label>
            		<div class="col-md-9"><?php echo $dh['thongtingiaohang']['diachi']; ?></div>
            	</div>
            	<div class="row">
            		<label class="col-md-3 control-label">Điện thoại</label>
            		<div class="col-md-9"><?php echo $dh['thongtingiaohang']['sodienthoai']; ?></div>
            	</div>
            	<div class="row">
            		<label class="col-md-3 control-label">Email</label>
            		<div class="col-md-9"><?php echo $dh['thongtingiaohang']['email']; ?></div>
            	</div>
            	<div class="row">
            		<label class="col-md-3 control-label">Ngày đặt hàng</label>
            		<div class="col-md-9"><?php echo date("d/m/Y H:i",$dh['ngaydathang']->sec); ?></div>
            	</div>
            	<div class="row">
            		<label class="col-md-3 control-label">Ghi chú</label>
            		<div class="col-md-9"><?php echo $dh['thongtingiaohang']['ghichu']; ?></div>
            	</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title"><i class="fa fa-list"></i> Sản phẩm đơn hàng</h4>
            </div>
            <div class="panel-body" style="border:1px blue solid;">
            <?php if($dh['sanpham']) : ?>
            	<table id="data-table" class="table table-striped table-bordered table-hovered">
            		<thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Đơn giá</th>
                        <th class="text-center">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;$tongthanhtien=0;
                    foreach($dh['sanpham'] as $item){
                    	$sanpham->id = $item['id_sanpham']; $sp = $sanpham->get_one();
	                   	$tongthanhtien += $item['thanhtien'];
                    	echo '<tr>';
                    	echo '<td class="text-right">'.$i.'</td>';
                    	echo '<td>'.$sp['ten'].'</td>';
                    	echo '<td class="text-right">'.$item['soluong'].'</td>';
                    	echo '<td class="text-right">'.format_number($item['dongia']).' VNĐ</td>';
                    	echo '<td class="text-right">'.format_number($item['thanhtien']).' VNĐ</td>';
                    	echo '</tr>';$i++;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                    		<th colspan="4" class="text-center">TỔNG CỘNG</th>
                    		<th class="text-right"><?php echo format_number($tongthanhtien);?> VNĐ</th>
                    	</tr>
                    </tfoot>
            	</table>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>