<?php
require_once('header.php');
$id_user = $users->get_userid();
$nguoichoi = new NguoiChoi();
$nguoichoi->id_user = $id_user;
$nguoichoi_list = $nguoichoi->get_list_by_user();
?>
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<?php if($users->isLoggedIn()): ?>
<div class="grid-row site-content">
    <div class="grid-column">
        <div class="grid-row">
            <div class="grid-column">
                <div class="primary-site-content">
                    <div class="nexo-screen-decoration-top"></div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                          <div class="grid-content ranking-status" style="margin:auto;">
                          <table class="table">
                          	<thead>
                          		<tr>
                          			<th>Ngày giờ cập nhật</th>
                          			<th>Loại cập nhật</th>
                          			<th>Nội dung xử lý</th>
                          		</tr>
                          	</thead>
                          	<tbody>
                          	<?php
                          	if($nguoichoi_list){
                          		foreach($nguoichoi_list as $nc){
                          			$tinhtrang = isset($nc['tinhtrang']['t']) ? $nc['tinhtrang']['t'] : 0;
                          			$noidung = isset($nc['tinhtrang']['noidung']) ? $nc['tinhtrang']['noidung'] : '';
                          			echo '<tr>';
                          			echo '<td>'.date("d/m/Y H:i", $nc['date_post']->sec).'</td>';
                          			echo '<td>'.$arr_loaidiem[$nc['loaidiem']].'</td>';
                          			echo '<td>['.$arr_tinhtrang[$tinhtrang].'] '.$noidung.'</td>';
                          			echo '</tr>';
                          		}
                          	}
                          	?>
                          	</tbody>
                          </table>
                          </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
	<h3>BẠN PHẢI ĐĂNG NHẬP!</h3>
<?php endif; ?>

<?php require_once('footer.php'); ?>
<script async="async">
    (function() {
        if (typeof MediaPlayerAPILoaded === 'undefined') {
            var body = document.body;
            var el = document.createElement('script');
            el.setAttribute('src', 'js/mediaplayerapi.ashx');
            el.setAttribute('type', 'text/javascript');
            body.appendChild(el);
            var MediaPlayerAPILoaded = true;
        }
    }());
</script>