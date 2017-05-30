<?php require_once('header.php');
$nguoichoi = new NguoiChoi();
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
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<div class="grid-row site-content">
    <div class="grid-column">
        <div class="grid-row">
            <div class="grid-column grid-fixed-column grid-sidebar">
                <div class="grid-row Sidebar-navigation" data-list-id="62b94d87-d7c9-4e78-bd18-d10951a9865e">
                    <div class="grid-column">
                        <div class="grid-content">
                            <a href="marking.html" class="call-to-action list-item">
                                <img src="images/nhapdiem.png" alt=""  style="width:100%;"/>                               
                            </a>
                            <ul class="list list-grid" lego-list lego-element-size data-size="2" data-format="square" data-uitest="list-simple" lego-element-size="">
                                <li>
                                    <a href="ranking.html" class="call-to-action list-item" data-xlink-handler lego-shopxlink-handler>
                                        <section class="primary-content">
                                            <img src="images/menu_combomissions.jpeg?l.r2=685437489" alt="" />
                                        </section>
                                        <section class="secondary-content">
                                            <h5 class="cta-headline">XẾP HẠNG</h5>
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
                                            <h5 class="cta-headline">TIN TỨC</h5>
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
                            <div class="grid-content">
                                <ul lego-slider data-format="sixteen-nine" data-expand-on-mobile="False" data-lego-out="" lego-element-size data-uitest="slider-slider" data-slider-config='{ "autoAdvance": { "active": false, "delay": 0, "interim": 0 } }'>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content home-ranking-content">
                                <h3>BẢNG VINH DANH HIỆP SĨ</h3>
                                <ul>
                                <?php
                                if($arr_user){
                                    foreach($arr_user as $k => $a){
                                        if($k < 20 && $a['diem'] > 0){
                                            $users->id = $a['id_user'];$u = $users->get_one();
                                            echo '<li>'.($k+1).'. '.$u['username'].' <span>'.format_number($a['diem']).' điểm</span></li>';    
                                        }
                                    }
                                }
                                ?>
                                </ul>
                                <!--<a href="ranking.html"><h4>Xem chi tiết</h4></a>-->
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