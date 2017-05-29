<?php
require_once('header.php');
if($users->isLoggedIn()){
    $nguoichoi = new NguoiChoi();
    $id_user = $users->get_userid();
    $nguoichoi->id_user = $id_user;
    $diem_1 = $nguoichoi->sum_diem_canhan(1);
    $diem_2 = $nguoichoi->sum_diem_canhan(2);
    $diem_3 = $nguoichoi->sum_diem_canhan(3);
    $diem_4 = $nguoichoi->sum_diem_canhan(4);
    $diem_5 = $nguoichoi->sum_diem_canhan(5);
    $tongdiem = $diem_1 + $diem_2 + $diem_3 + $diem_4 + $diem_5;
    $sum_xephang = $nguoichoi->sum_xephang();
    $xephang = 0;
    if($sum_xephang){
        foreach ($sum_xephang as $key => $value) {
            if($id_user == $value['_id']) $xephang = $key+1;
        }
    }
}
?>
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<div class="grid-row site-content">
    <div class="grid-column">
        <div class="grid-row">
            <div class="grid-column">
                <div class="primary-site-content">
                    <div class="nexo-screen-decoration-top"></div>
                    <?php if($users->isLoggedIn()): ?>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                          <div class="grid-content ranking-canhan" style="margin:auto;">
                            <h3>Điểm sức mạnh cá nhân</h3>
                            <ul>
                                <li>Level game Merlok 2.0 <span><?php echo format_number($diem_1);?> điểm</span></li>
                                <li>Số khiên sức mạnh<span><?php echo format_number($diem_2);?> điểm</span></li>
                                <li>Điểm mua hàng<span><?php echo format_number($diem_3);?> điểm</span></li>
                                <li>Điểm tham gia “Đấu trường Hiệp sĩ”<span><?php echo format_number($diem_4);?> điểm</span></li>  
                                <li>Điểm tham gia “Đại hội Hiệp sĩ”<span><?php echo format_number($diem_5);?> điểm</span></li>
                                <li>Tổng điểm<span><?php echo format_number($tongdiem);?> điểm</span></li>
                                <li>Thứ hạng<span><?php echo $xephang; ?></span></li>
                            </ul>
                            <a href="status.html"><h4>Xem trạng thái cập nhật</h4></a>
                            <div style="clear:both"></div>
                        </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content home-ranking-content" style="margin:auto;">
                                <h3>BẢNG XẾP HẠNG HIỆP SĨ</h3>
                                <ul>
                                    <li style="font-size:30px;">Đang cập nhật</li>
                                <?php
                                /*    for($i=1; $i<=20; $i++){
                                        echo '<li>'.$i.'. Họ tên hiệp sĩ <span>1.000 điểm</span></li>';
                                    }*/
                                ?>
                                </ul>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content home-ranking-content" style="margin:auto;">
                                <h3>BẢNG VINH DANH HIỆP SĨ</h3>
                                <ul>
                                <li style="font-size:30px;">Đang cập nhật</li>
                                <?php
                                    /*for($i=1; $i<=20; $i++){
                                        echo '<li>'.$i.'. Họ tên hiệp sĩ <span>1.000 điểm</span></li>';
                                    }*/
                                ?>
                                </ul>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content ranking-content" style="margin:auto;">
                                <h3>XEM BẢNG VINH DANH CÁC TUẦN KHÁC</h3>
                                <ul>
                                <?php
                                    for($i=1; $i<=7; $i++){
                                        echo '<li><a href="ranking.html?t='.$i.'">Tuần '.$i.'</a></li>';
                                    }
                                ?>
                                </ul>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="nexo-screen-decoration-bottom"></div>
                </div>
                <div class="secondary-site-content">
                    <div class="nexo-screen-decoration-top"></div>
                    <div class="nexo-screen-decoration-bottom"></div>
                </div>
            </div>
        </div>
    </div>
</div>
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