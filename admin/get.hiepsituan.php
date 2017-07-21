<?php
require_once('header_none.php');
$hiepsituan = new HiepSiTuan();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$hiepsituan->id = $id;
if($act == 'del'){
	if($hiepsituan->delete()) transfers_to('hiepsituan.html?msg=Xóa thành công');
}
?>
<?php
if($act == 'list'):
$hs = $hiepsituan->get_one();
?>
<?php if($hs['hiepsi']) : ?>
<table id="data-table-1" class="table table-striped table-bordered table-hovered">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên tài khoản</th>
			<th>Họ tên</th>
			<th>Điện thoại</th>
			<th>Điểm</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	foreach($hs['hiepsi'] as $key => $value){
		$users->id = $value['id_user']; $u = $users->get_one();
		echo '<tr>';
		echo '<td>'.$i.'</td>';
		echo '<td>'.$u['username'].'</td>';
		echo '<td>'.$u['hoten'].'</td>';
		echo '<td>'.$u['sodienthoai'].'</td>';
		echo '<td>'.format_number($value['diem']).'</td>';
		echo '</tr>'; $i++;
	}
	?>
	</tbody>
</table>
<?php else: ?>
 	Chưa có danh sách hiệp sĩ
<?php endif;?>
<?php endif; ?>
