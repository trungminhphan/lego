<?php
require_once('header.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sanpham = new SanPham();$sanpham->id = $id; $sp = $sanpham->get_one();
$add_cart = isset($_GET['add_cart']) ? $_GET['add_cart'] : '';
if($add_cart == 'ok') $msg = 'Đã thêm sản phẩm vào giỏ hàng thành công';
?>
<?php if($sp): ?>
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
    <div class="grid-row site-content">
        <div class="grid-column">
<div class="grid-row">
    <div class="grid-column">
        
<div class="grid-row">
    <div class="grid-column">
        <div class="grid-content" data-format="sixteen-nine" style="max-width:840px;margin:auto;">
<article class="media product product-full-details" lego-element-size itemscope itemtype="http://schema.org/Product">
        <?php if(isset($msg) && $msg): ?>
        <div class="alert alert-red alert-dismissible" role="alert" style="background:#ffff00;color:#ff0000;">
            <h5><strong><?php echo $msg; ?></strong></h5>
        </div>
        <?php endif; ?>
        <header class="media-heading">
            <h1>
                <span itemprop="name"><?php echo $sp['ten']; ?></span>
            </h1>
        </header>


    <ul lego-slider lego-element-size data-format="sixteen-nine">
    <?php if(isset($sp['hinhanh'][0]['aliasname'])): ?>
    	<?php foreach($sp['hinhanh'] as $key => $value): ?>
    		<li>
                <div class="list-item">
                    <div class="primary-content">
                            <img src="<?php echo $target_images.$value['aliasname']; ?>" alt="<?php echo $value['mota']; ?>" />
                    </div>
                </div>
            </li>
    	<?php endforeach; ?>
    <?php else: ?>
            <li>
                <div class="list-item">
                    <div class="primary-content">
                            <img src="images/products/LEGO_70372_Box1_V29_1488.png?l.r2=44838136" alt="Combo NEXO Powers Wave 1" />
                    </div>
                </div>
            </li>
            <li>
                <div class="list-item">
                    <div class="primary-content">
                            <img src="images/products/LEGO_70372_WEB_PRI_720.jpg" alt="Combo NEXO Powers Wave 1" />
                    </div>
                </div>
            </li>
    <?php endif;?>
    </ul>

<div class="media">
<form action="add_cart.html" method="POST">
    <input type="hidden" name="id_sanpham" id="id_sanpham" value="<?php echo $sp['_id']; ?>" />
    <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
    <button type="submit" name="submit" class="btn-shopping"><i class=" icon icon-shopping-cart-filled"></i> Mua sản phẩm</button>
</form>
<h3 style="color:#ffff00;">Giá: <?php echo format_number($sp['gia']); ?> VNĐ</h3>
    <!--<a class="btn-shopping" href="<?php //echo $sp['link'] ? $sp['link'] : 'http://www.mykingdom.com.vn'; ?>"><i class=" icon icon-shopping-cart-filled"></i> Mua sản phẩm</a>-->
    <!--<section class="media-body description">
        <section class="links media-item">
            <ul class="list list-inline">
                    <li>
                        <a class="btn shop-button" href="<?php echo $sp['link'] ? $sp['link'] : 'http://www.mykingdom.com.vn'; ?>" lego-shopxlink-handler data-event-prefix="shopcheckprice"><i class=" icon icon-shopping-cart-filled"></i> Mua sản phẩm</a>   
                    </li>
            </ul>
        </section>-->
        <div itemprop="description">
            <section class="paragraphs">
				<?php echo preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $sp['mota']); ?>
			</section>
        </div>
    </section>
</div>


</article>

        </div>
    </div>
</div>
    </div>
    <!--<div class="grid-column grid-fixed-column grid-sidebar">
		<div class="grid-row nexo-coolstuff-cta" data-list-id="5c8045b4-18e1-435a-8d9e-2927b47d9db1">
		    <div class="grid-column">
		        <div class="grid-content">
		            <ul class="list list-grid" data-format="sixteen-nine" data-size="4" data-uitest="list-simple">
						<li>
							<a class="call-to-action list-item" data-xlink-handler="" href="https://community.lego.com/t5/NEXO-KNIGHTS/bd-p/NEXO_KNIGHTS">
							<section class="primary-content">
								<img alt="Messageboard" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="> <i></i>
							</section>
							<section class="secondary-content">
								<h5 class="cta-headline">Message Board</h5>
								<h5 class="cta-subheadline"></h5>
							</section></a>
						</li>
						<li>
							<a class="call-to-action list-item" data-xlink-handler="" href="https://www.lego.com/en-us/nexoknights/games/nexoknights-app">
							<section class="primary-content">
								<img alt="NEXO KNIGHTS Recommended Image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="> <i></i>
							</section>
							<section class="secondary-content">
								<h5 class="cta-headline">Fight the monsters!</h5>
								<h5 class="cta-subheadline"></h5>
							</section></a>
						</li>
						<li>
							<a class="call-to-action list-item" data-xlink-handler="" href="https://www.lego.com/en-us/nexoknights/franchises/nexoknights/home/explorepage/explore%20entertainment%20room">
							<section class="primary-content">
								<img alt="Watch videos in the LEGO NEXO KNIGHTS entertainment room" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="> <i></i>
							</section>
							<section class="secondary-content">
								<h5 class="cta-headline">Entertainment Room</h5>
								<h5 class="cta-subheadline"></h5>
								<p class="cta-text">Let Merlok entertain you</p>
							</section></a>
						</li>
						<li>
							<a class="call-to-action list-item" data-xlink-handler="" href="https://www.lego.com/en-us/lifestyle/products">
							<section class="primary-content">
								<img alt="NEXO KNIGHTS Recommended image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="> <i></i>
							</section>
							<section class="secondary-content">
								<h5 class="cta-headline">Book of Monsters</h5>
								<h5 class="cta-subheadline"></h5>
							</section></a>
						</li>
					</ul>           
		        </div>
		    </div>
		</div>
    </div>-->
</div>
</div>
</div>
<?php endif; ?>
<?php require_once('footer.php'); ?>