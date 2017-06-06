<?php
require_once('header.php');
$nguoichoi = new NguoiChoi();
$hiepsituan = new HiepSiTuan();

/*$id_tuan = isset($_GET['id_tuan']) ? $_GET['id_tuan'] : '';
if($id_tuan){
    $hst = $hiepsituan->get_list_condition(array('_id' => new MongoId($id_tuan)));
} else {
    $hst = $hiepsituan->get_newest();
}
$hst = $hiepsituan->get_all_list();*/
$list_tuan = $hiepsituan->get_all_list();
$xephang_cn = 0;
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
            <div class="grid-column">
                <div class="primary-site-content">
                    <div class="nexo-screen-decoration-top"></div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content home-ranking-content" style="margin:auto;">
                                <h3>BẢNG XẾP HẠNG HIỆP SĨ</h3>
                                <div class="content">
                                <ul>
                                <?php
                                if($arr_user){
                                    foreach($arr_user as $k => $a){
                                        if($a['diem'] > 0){
                                            $users->id = $a['id_user'];$u = $users->get_one();
                                            echo '<li>'.($k+1).'. <a href="profiles.html?id_user='.$a['id_user'].'" style="float:none;">'.$u['hoten'].'</a> <span>'.format_number($a['diem']).' điểm</span></li>';    
                                        }
                                    }
                                }
                                ?>
                                </ul>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                    <?php if($list_tuan): ?>
                        <?php foreach($list_tuan as $hst): ?>
                        <div class="grid-row nexo-frontpage-ranking">
                            <div class="grid-column">
                                <div class="grid-content home-ranking-content" style="margin:auto;">
                                    <h3>BẢNG VINH DANH HIỆP SĨ</h3>
                                    <?php echo '<h3>TUẦN '.$hst['tuan'] .' ('.date("d/m/Y", $hst['tungay']->sec).' - '.date("d/m/Y", $hst['denngay']->sec).')</h3>'; ?>
                                    <ul>
                                    <?php
                                        if($hst['hiepsi']){
                                            foreach ($hst['hiepsi'] as $key => $value) {
                                                $users->id = $value['id_user']; $us = $users->get_one();
                                                echo '<li>'.($key+1).'. <a href="profiles.html?id_user='.$value['id_user'].'" style="float:none;">'.$us['hoten'].'</a> <span>'.format_number($value['diem']).' điểm</span></li>';
                                            }
                                        }
                                                                
                                    ?>
                                    </ul>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <!--<a name="cactuankhac"></a>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                            <div class="grid-content ranking-content" style="margin:auto; border: 3px solid #ffff00; border-radius: 20px;background-color:#262626;">
                                <h3 style="color:#ffff00;">XEM BẢNG VINH DANH CÁC TUẦN KHÁC</h3>
                                <ul style="padding:0px 20px 20px 20px;">
                                <?php
                                /*if($list_tuan){
                                    foreach($list_tuan as $tuan){
                                        echo '<li><a href="ranking.html?id_tuan='.$tuan['_id'].'">Tuần '.$tuan['tuan'].'</a></li>';
                                    }
                                }*/
                                ?>
                                </ul>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>-->
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