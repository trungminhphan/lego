<?php require_once('header.php');
$nguoichoi = new NguoiChoi();$banner = new Banner();$hiepsituan = new HiepSiTuan();
$list = $nguoichoi->get_distinct_user();$arr_user = array();
$hst = $hiepsituan->get_newest();$list_tuan = $hiepsituan->get_all_list();
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
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<div class="grid-row site-content">
    <div class="grid-column">
        <div class="grid-row">
            <div class="grid-column grid-fixed-column grid-sidebar">
                <div class="grid-row Sidebar-navigation" data-list-id="62b94d87-d7c9-4e78-bd18-d10951a9865e">
                    <div class="grid-column">
                        <div class="grid-content">
                            <div class="nhapdiem">
                                <a href="marking.html" class="list-item">
                                    <img src="images/nhapdiem-1.png" alt="" style="width:100%;"/>                               
                                </a>
                                <a href="marking.html" class="btn-shopping" style="font-size:33px;padding:20px;font-style:normal;width:100%;"><i class="glyphicon glyphicon-star"></i> NHẬP ĐIỂM</a>
                            </div>
                            <ul class="list list-grid" lego-list lego-element-size data-size="2" data-format="square" data-uitest="list-simple" lego-element-size="">
                                <li>
                                    <a href="ranking.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                        <section class="primary-content">
                                            <img src="images/menu_combomissions.jpeg?l.r2=685437489" alt="" />
                                        </section>
                                        <section class="secondary-content">
                                            <h5 class="cta-headline">BẢNG XẾP HẠNG</h5>
                                            <h5 class="cta-subheadline"></h5>
                                        </section>
                                    </a>
                                </li>
                                <li>
                                    <a href="guides.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                        <section class="primary-content">
                                            <img src="images/menu_merlokgame_05.jpeg?l.r2=-1099987258" alt="" />
                                        </section>
                                        <section class="secondary-content">
                                            <h5 class="cta-headline">HƯỚNG DẪN</h5>
                                            <h5 class="cta-subheadline"></h5>
                                        </section>
                                    </a>
                                </li>
                                <li>
                                    <a href="products.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                        <section class="primary-content">
                                            <img src="images/menu_products_05.jpeg?l.r2=-598739537" alt="" />
                                        </section>
                                        <section class="secondary-content">
                                            <h5 class="cta-headline">SẢN PHẨM</h5>
                                            <h5 class="cta-subheadline"></h5>
                                        </section>
                                    </a>
                                </li>
                                <li>
                                    <a href="videos.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                        <section class="primary-content">
                                            <img src="images/menu_videos.jpeg?l.r2=2090274471" alt="" />
                                        </section>
                                        <section class="secondary-content">
                                            <h5 class="cta-headline">XEM PHIM</h5>
                                            <h5 class="cta-subheadline"></h5>
                                        </section>
                                    </a>
                                </li>
                                <li>
                                    <a href="news.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                        <section class="primary-content">
                                            <img src="images/menu_nexopowers_05.jpeg?l.r2=-515281291" alt="" />
                                        </section>
                                        <section class="secondary-content">
                                            <h5 class="cta-headline">LỊCH ĐẤU TRƯỜNG</h5>
                                            <h5 class="cta-subheadline"></h5>
                                        </section>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-column">
                <div class="primary-site-content">
                    <div class="nexo-screen-decoration-top"></div>
                    <div class="grid-row">
                        <div class="grid-column">
                            <div class="grid-content" id="banner">
                                <ul lego-slider data-format="sixteen-nine" data-expand-on-mobile="" data-lego-out="" lego-element-size data-uitest="slider-slider" data-slider-config='{"autoAdvance": { "active": "", "delay": "", "interim": "" } }'>
                                <?php
                                $t = $banner->get_one();
                                if($t && isset($t['banner']) && $t['banner']){
                                    foreach ($t['banner'] as $b) {
                                        echo '<li>';
                                        echo $b['link'] ? '<a href="'.$b['link'].'" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>' :'<a href="#" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>';
                                        echo '<section class="primary-content">
                                                <img src="'.$target_banner.$b['aliasname'].'" alt="" />
                                                <i class="icon icon-explore is-top-right "></i>
                                            </section>';
                                        if(isset($b['mota']) && $b['mota']){
                                            echo '<section class="secondary-content">
                                                <h5 class="cta-headline">'.$b['mota'].'</h5>
                                            </section>';
                                        }
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                } else {
                                ?>
                                    <li>
                                        <a href="guides.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                            <section class="primary-content">
                                                <img src="images/slide_guides.png" alt="" />
                                                <i class="icon icon-explore is-top-right "></i>
                                            </section>
                                            <!--<section class="secondary-content">
                                                <h5 class="cta-headline">BẠN ĐÃ ĐƯỢC PHONG TƯỚC HIỆP SĨ?</h5>
                                                <h5 class="cta-subheadline">Xem hướng dẫn tại đây</h5>
                                            </section>-->
                                        </a>
                                    </li>
                                    <li>
                                        <a href="videos.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                            <section class="primary-content">
                                                <img src="images/slide_video.png" alt="" />
                                                <i class="icon icon-app is-top-right "></i>
                                            </section>
                                            <!--<section class="secondary-content">
                                                <h5 class="cta-headline">PHẦN 3 HIỆP SĨ NEXO – ĐÁM MÂY QUÁI GỠ</h5>
                                                <h5 class="cta-subheadline">Xem tại đây</h5>
                                            </section>-->
                                        </a>
                                    </li>
                                    <li>
                                        <a href="products.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                            <section class="primary-content">
                                                <img src="images/slide_products.png" alt="" />
                                                <i class="icon icon-products is-top-right "></i>
                                                <i></i>
                                            </section>
                                            <!--<section class="secondary-content">
                                                <h5 class="cta-headline">SẢN PHẨM LEGO NEXO KNIGHTS</h5>
                                                <h5 class="cta-subheadline">MUA NGAY</h5>
                                            </section>-->
                                        </a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-regis text-center">
                    <a href="marking.html" class="btn-shopping"><i class="glyphicon glyphicon-heart"></i> Nhập điểm</a>
                    <a href="users.html" class="btn-shopping"><i class="glyphicon glyphicon-user"></i> Đăng ký</a>
                    </div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content home-ranking-content">
                                <h3>TOP 100 XẾP HẠNG HIỆP SĨ</h3>
                                <div class="content">
                                <ul>
                                <?php
                                if($arr_user){
                                    foreach($arr_user as $k => $a){
                                        if($k < 100 && $a['diem'] > 0){
                                            $users->id = $a['id_user'];$u = $users->get_one();
                                            echo '<li>'.($k+1).'. <a href="profiles.html?id_user='.$a['id_user'].'" style="float:none;">'.$u['hoten'].'</a> <span>'.format_number($a['diem']).' điểm</span></li>';    
                                        }
                                    }
                                }
                                ?>
                                </ul>
                                </div>
                                <a href="ranking.html"><h4>Xem danh sách đầy đủ</h4></a>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content home-ranking-content" style="margin:auto;">
                                <h3>BẢNG VINH DANH HIỆP SĨ</h3>
                                <?php if($hst): ?>
                                <?php
                                    foreach ($hst as $hs) {
                                        echo '<h3>TUẦN '.$hs['tuan'] .' ('.date("d/m/Y", $hs['tungay']->sec).' - '.date("d/m/Y", $hs['denngay']->sec).')</h3>';
                                        //echo '<h3>TUẦN '.$hs['tuan'] .'</h3>';
                                    }
                                ?>
                                <ul>
                                <?php
                                    foreach($hst as $hs){
                                        if($hs['hiepsi']){
                                            foreach ($hs['hiepsi'] as $key => $value) {
                                                $users->id = $value['id_user']; $us = $users->get_one();
                                                echo '<li>'.($key+1).'. <a href="profiles.html?id_user='.$value['id_user'].'" style="float:none;">'.$us['hoten'].'</a> <span>'.format_number($value['diem']).' điểm</span></li>';
                                            }
                                        }
                                    }                                
                                endif;
                                ?>
                                </ul>
                                <a href="ranking.html#cactuankhac"><h4>Xem các tuần trước</h4></a>
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
        var interval;
        interval =  setInterval(function(){ $(".next").click(); }, 3000);
        $("#banner").on({
            mouseenter: function(){
                clearInterval(interval);  
            },
            mouseleave: function(){
                interval =  setInterval(function(){ $(".next").click(); }, 3000);
            }
        });
    }());
</script>