<?php
require_once('header.php');
/*if(!$users->isLoggedIn()){
    transfers_to('login.html?url=' . $_SERVER['REQUEST_URI']);
}*/
$nguoichoi = new NguoiChoi();
//$id_user = $users->get_userid();
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : $users->get_userid();
$nguoichoi->id_user = $id_user;$nguoichoi_list = $nguoichoi->get_list_by_user();
$diem_1_cn = $nguoichoi->sum_diem_canhan(1);
$diem_2_cn = $nguoichoi->sum_diem_canhan(2);
$diem_3_cn = $nguoichoi->sum_diem_canhan(3);
$diem_4_cn = $nguoichoi->sum_diem_canhan(4);
$diem_5_cn = $nguoichoi->sum_diem_canhan(5);
$tongdiem_cn = $diem_1_cn + $diem_2_cn + $diem_3_cn + $diem_4_cn + $diem_5_cn;
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
$xephang_cn = 0;
if($arr_user){
    foreach ($arr_user as $key => $value) {
        if($id_user == $value['id_user']) $xephang_cn = $key+1;
    }
}

$users->id = $id_user; $u = $users->get_one();
/*if(isset($u['id_dmthanhpho']) && $u['id_dmthanhpho']){
    $danhmucthanhpho = new DanhMucThanhPho();
    $danhmucthanhpho->id = $u['id_dmthanhpho']; $tp = $danhmucthanhpho->get_one();
    $tenthanhpho = $tp['ten'];
} else { $tenthanhpho = '';}*/
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
                          <div class="grid-content ranking-canhan" style="margin:auto;">
                            <h3>Điểm sức mạnh cá nhân</h3>
                            <ul>
                                <li>Level game Merlok 2.0 <span><?php echo format_number($diem_1_cn);?> điểm</span></li>
                                <li>Số khiên sức mạnh<span><?php echo format_number($diem_2_cn);?> điểm</span></li>
                                <li>Điểm mua hàng<span><?php echo format_number($diem_3_cn);?> điểm</span></li>
                                <li>Điểm tham gia “Đấu trường Hiệp sĩ”<span><?php echo format_number($diem_4_cn);?> điểm</span></li>  
                                <li>Điểm tham gia “Đại hội Hiệp sĩ”<span><?php echo format_number($diem_5_cn);?> điểm</span></li>
                                <li>Tổng điểm<span><?php echo format_number($tongdiem_cn);?> điểm</span></li>
                                <li>Thứ hạng<span><?php echo $xephang_cn; ?></span></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="grid-row nexo-frontpage-ranking">
                        <div class="grid-column">
                          <div class="grid-content ranking-canhan" style="margin:auto;">
                            <h3>THÔNG TIN TÀI KHOẢN</h3>
                            <ul>
                                <li>Tên tài khoản: <?php echo $u['username']; ?></li>
                                <li>Họ tên: <?php echo $u['hoten']; ?></li>
                                <li>Năm sinh: <?php echo $u['namsinh']; ?></li>
                                <li>Điện thoại: <?php echo $u['sodienthoai']; ?></li>
                                <li>Địa chỉ: <?php echo $u['diachi']; ?></li>  
                                <!--<li>Thành phố: <?php //echo $tenthanhpho; ?></li>-->
                                <li>Email: <?php echo $u['email']; ?></li>
                            </ul>
                            <a href="users_edit.html"><h4>Chỉnh sửa</h4></a>
                            <div style="clear:both"></div>
                        </div>
                        </div>
                    </div>
                    <h3 style="text-align:center;">TRẠNG THÁI CẬP NHẬT ĐIỂM</h3>
                    <div class="text-right" style="max-width: 960px;margin:auto;">
                        <a href="marking.html" class="btn-shopping"><i class="icon icon-favourite"></i> NHẬP ĐIỂM</a>
                    </div>
                    <table class="table" style="max-width: 960px;margin:auto;">
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