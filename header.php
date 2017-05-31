<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
$session = new SessionManager();
$users = new Users();
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
if($users->isLoggedIn()) $user_default = $users->get_one_default();
$url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : 'index.html'; $a = explode("/", $url); $l = end($a);
?>
<!DOCTYPE html>
<html lang="en"
    ng-app="LEGO.Web.NexoKnights.Site">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" value="notranslate">
    <title>Phong Tước Hiệp Sĩ Nexo</title>
    <meta name="description" content="Description để tăng hạng SEO. Thay bằng tiếng Việt: Trang web chính thức để Phong Tước Hiệp Sĩ Nexo tại Việt Nam (LEGO® NEXO KNIGHTS™). Tham gia ngay để mua sắm, cập nhật điểm, cập nhật các sự kiện, tin tức nóng hổi cùng các video hấp dẫn về hiệp sĩ Nexo." />
    <meta name="keywords" content="Description để tăng hạng SEO. Thay bằng tiếng Việt: Trang web chính thức để Phong Tước Hiệp Sĩ Nexo tại Việt Nam (LEGO® NEXO KNIGHTS™). Tham gia ngay để mua sắm, cập nhật điểm, cập nhật các sự kiện, tin tức nóng hổi cùng các video hấp dẫn về hiệp sĩ Nexo.">
    <link href="css/nexoknights.css" rel="stylesheet" />
    <link rel="shortcut icon" href="images/favicon.png">
    <!--[if gt IE 9]><!-->
    <link href="css/skin1-main.css?l.r2=1.0.0.9" rel="stylesheet">
    <!--<![endif]-->
    <!--[if lte IE 9]>
        <link href="css/skin1-legacy-base.css?l.r2=1.0.0.9" rel="stylesheet">
        <link href="css/skin1-legacy-custom.css?l.r2=1.0.0.9" rel="stylesheet">
    <![endif]-->
    <script src="js/modernizr.min.js?l.r2=1.0.0.9" type="text/javascript"></script>
</head>
<?php
if(isset($arr_body[$l])) echo $arr_body[$l]; else echo $arr_body['videos.html'];

if(isset($_SESSION['cart_items']) && $_SESSION['cart_items']){
    $count_cart = count($_SESSION['cart_items']);
} else $count_cart =0;
?>  
<div class="lego-global-header-outer-wrap">
    <div class="lego-global-header">
        <i class="hidden-breakpoint-observer"></i>
        <div class="lego-global-header-wrap">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="lego-brand">
                <a href="http://www.hiepsinexo.com" class="logo"></a>
            </div>
            <!-- Shroud for drop down navigation -->
            <div class="shroud"></div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse-wrapper">
                <div class="lego-global-navigation">
                    <ul class="global-links">
                        <li  class="priority">
                            <a class="gn-icon gn-icon-home"  href="index.html" target="">Trang chủ</a>
                        </li>
                    </ul>
                </div>
               <div class="legoid">
                    <div class="legoid-box">
                     <i class="glyphicon glyphicon-shopping-cart"></i>
                        <a href="cart.html">Giỏ hàng <?php echo $count_cart > 0 ? '<sup>'.$count_cart.'</sup>' : ''; ?></a>
                        &nbsp;&nbsp;&nbsp;
                    <?php if($users->isLoggedIn()): ?>
                        <i class="glyphicon glyphicon-user"></i>
                        <a href="profiles.html">Tài khoản</a>
                        &nbsp;&nbsp;&nbsp;
                        <i class="glyphicon glyphicon-log-in"></i>
                        <a href="logout.html">Đăng xuất</a>
                    <?php else: ?>
                        <a href="login.html"><i class="glyphicon glyphicon-log-in"></i> Đăng nhập</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="users.html" class="btn-shopping"><i class="glyphicon glyphicon-user"></i> Đăng ký</a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lego-brand-mobile">
            <a href="http://www.hiepsinexo.com" class="logo-mobile"></a>
        </div>
    </div>
    
</div>

<div class="grid-row site-branding">
    <div class="grid-column">
        <div class="grid-content">
            <div class="lego-responsive-images" lego-element-size lego-responsive-images>
                <a href="index.html" title="Home">
                    <img src="images/nexo-branding-logo-new.png?l.r2=-1806736046" alt="" class="branding-logo" />
                </a>
                <img src="" alt="" data-source={&quot;desktop&quot;:{&quot;retina&quot;:&quot;&quot;,&quot;nonretina&quot;:&quot;&quot;},&quot;tablet&quot;:{&quot;retina&quot;:&quot;&quot;,&quot;nonretina&quot;:&quot;&quot;},&quot;mobile&quot;:{&quot;retina&quot;:&quot;&quot;,&quot;nonretina&quot;:&quot;&quot;}} class="branding-image" />
            </div>
        </div>
    </div>
</div>
<div class="grid-row navigation site-navigation">
    <div class="grid-column">
        <div class="grid-content">
            <nav role="navigation" class="navbar" style="background:none;">
                <ul class="nav navbar-nav">
                    <li class="<?php echo $l =='index.html' ? 'active' : ''; ?> has-icon has-title" id="home-homepage">
                        <a href="index.html">
                            <i class="icon icon-home"></i> <span class="item-title"> Trang chủ</span>
                        </a>
                    </li>
                    <li class="<?php echo $l =='ranking.html' ? 'active' : ''; ?> has-icon has-title">
                        <a href="ranking.html">
                            <i class="icon icon-characters"></i>
                            <span class="item-title"> Xếp hạng</span>
                        </a>
                    </li>
                     <li class="<?php echo $l =='marking.html' ? 'active' : ''; ?> has-icon has-title">
                        <a href="marking.html">
                            <i class="icon icon-favourite"></i>
                            <span class="item-title"> Nhập điểm</span>
                        </a>
                    </li>
                    <li class="<?php echo $l =='videos.html' ? 'active' : ''; ?> has-icon has-title">
                        <a href="videos.html">
                            <i class="icon icon-play-sign"></i>
                            <span class="item-title"> Phim</span>
                        </a>
                    </li>
                    <li class="<?php echo ($l =='products.html' || $l=='product_detail.html') ? 'active' : ''; ?> has-icon has-title">
                        <a href="products.html">
                            <i class="icon icon-themes-filled"></i>
                            <span class="item-title">Sản phẩm</span>
                        </a>
                    </li>
                    <li class="<?php echo $l =='guides.html' ? 'active' : ''; ?> has-icon has-title">
                        <a href="guides.html">
                            <i class="icon icon-nexo-knights"></i><span class="item-title"> Hướng dẫn</span>
                        </a>
                    </li>
                    <li class="<?php echo ($l =='news.html' || $l=='news_detail.html') ? 'active' : ''; ?> has-icon has-title">
                        <a href="news.html">
                            <i class="icon icon-devices"></i>
                            <span class="item-title"> Tin tức</span>
                        </a>
                    </li>
                    <li class="has-icon has-title" id="home-cart">
                        <a href="cart.html">
                            <i class="icon icon-shopping-cart"></i>
                            <span class="item-title"> Giỏ hàng</span>
                        </a>
                    </li>
                    <?php if($users->isLoggedIn()): ?>
                        <li class="has-icon has-title" id="home-user">
                            <a href="profiles.html">
                                <i class="icon icon-construction-instructions-filled"></i>
                                <span class="item-title"> Tài khoản</span>
                            </a>
                        </li>
                        <li class="has-icon has-title" id="home-login">
                        <a href="logout.html">
                            <i class="icon icon-characters-filled"></i>
                            <span class="item-title"> Đăng xuất</span>
                        </a>
                    </li>
                    <?php else: ?>
                        <li class="has-icon has-title" id="home-user">
                            <a href="users.html">
                                <i class="icon icon-construction-instructions-filled"></i>
                                <span class="item-title"> Đăng ký</span>
                            </a>
                        </li>
                        <li class="has-icon has-title" id="home-login">
                            <a href="login.html">
                                <i class="icon icon-characters-filled"></i>
                                <span class="item-title"> Đăng nhập</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>