<?php
require_once('header.php');
$sanpham = new SanPham();
if(isset($_POST['update_cart_action'])){
  if($_POST['update_cart_action'] == 'update_qty'){
    $id_sanpham = isset($_POST['id_sanpham']) ? $_POST['id_sanpham'] : '';
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
    if($id_sanpham){
      $_SESSION['cart_items'] = array();
      foreach ($id_sanpham as $key => $value) {
        $_SESSION['cart_items'][] = array('id_sanpham' => $value, 'soluong' => $soluong[$key]);
      }
    }
  }
  if($_POST['update_cart_action'] =='empty_cart'){
    $_SESSION['cart_items'] = null;
  }
}
?>
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<div class="grid-row">
    <div class="grid-column">
        <div class="grid-content" data-format="sixteen-nine" style="max-width:960px;margin:auto;">
        	<!-- Page Main -->
			<table class="table">
				<thead>
					<tr>
						<th>Hình</th>
						<th>Tên sản phẩm</th>
						<th>Đơn giá</th>
						<th>Số lượng</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$tongthanhtien = 0;
				if(isset($_SESSION['cart_items']) && $_SESSION['cart_items']){
					foreach($_SESSION['cart_items'] as $key => $item){
						$sanpham->id = $item['id_sanpham'];$isp = $sanpham->get_one();
        				$thanhtien = $isp['gia'] * $item['soluong'];$tongthanhtien += $thanhtien;
        				echo '<tr class="cart_table_item">
							<td>
								<a href="product_detail.html?id='.$isp['_id'].'">
									<img alt="" class="img-responsive" src="'.(isset($isp['hinhanh'][0]['aliasname']) ? 'uploads/images/'.$isp['hinhanh'][0]['aliasname'] : 'images/default_video.png').'" style="height:30px;">
								</a>
							</td>
							<td>
								<a href="product_detail.html?id='.$isp['_id'].'">'.$isp['ten'].'</a>
							</td>
							<td>
								<span class="amount">'.format_number($isp['gia']).' VNĐ</span>
							</td>
							<td>
							<input type="hidden" name="id_sanpham[]" value="'.$item['id_sanpham'].'">
            				<input type="number" name="soluong[]" value="'.$item['soluong'].'" title="Số lượng" class="input-text text-center" style="width:75px;color:#000;" min="1">
							</td>
							<td>
								<span class="amount">'.format_number($thanhtien).' VNĐ</span>
							</td>
							<td><a href="del_cart.html?id='.$item['id_sanpham'].'&key='.$key.'&url='.$_SERVER['PHP_SELF'].'"><i class="glyphicon glyphicon-trash"  style="font-size: 15px !important;"></i></a></td>
						</tr>';
					}
				}
				?>
				</tbody>
				<tfoot>
					<tr class="cart_table_item">
						<th colspan="2" class="text-center">TỔNG CỘNG</th>
						<th colspan="4"><?php echo format_number($tongthanhtien); ?> VNĐ</th>
					</tr>
				</tfoot>
			</table>
			<a href="products.html" class="btn-shopping"><i class="glyphicon glyphicon-shopping-cart"></i> Tiếp tục mua hàng</a>
			<button type="submit" name="update_cart_action" value="update_qty" class="btn-shopping"><i class="glyphicon glyphicon-check"></i> Cập nhật đơn hàng</button>
			<a href="checkout.html" class="btn-shopping" style="margin-left:10px;"><i class="icon icon-shopping-cart-filled"></i> Thanh toán</a>
        </div>
    </div>
</div>
</form>
<?php require_once('footer.php'); ?>