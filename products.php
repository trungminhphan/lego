<?php
require_once('header.php');
$sanpham = new SanPham();
$sanpham_list = $sanpham->get_all_list();
?>
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<div class="grid-row site-content">
	<div class="grid-column">
		<div class="primary-site-content">
			<div class="nexo-screen-decoration-top"></div>
			<div class="grid-row teaser-list" data-list-id="d17206ad-5a1d-455a-9ba9-bcc85d23d3b8">
				<div class="grid-column">
					<div class="grid-content">
						<div class="hgroup">
							<h2>Sản phẩm</h2>
						</div>
						<ul class="list list-grid" data-format="sixteen-nine" data-size="3" data-uitest="list-simple">
						<?php if($sanpham_list) : ?>
							<?php foreach($sanpham_list as $sp): ?>
								<li>
									<a class="product list-item" data-theme="theme-nexoknights" data-type="product" href="product_detail.html?id=<?php echo $sp['_id']; ?>">
									<section class="primary-content">
										<img alt="<?php echo $sp['ten']; ?>" src="<?php echo isset($sp['hinhanh'][0]['aliasname']) ? $target_images . $sp['hinhanh'][0]['aliasname'] : 'images/default_video.png'; ?>">
										<i></i>
									</section>
									<section class="secondary-content">
										<h5><span itemprop="name"><?php echo $sp['ten']; ?></span></h5>
									</section></a>
								</li>
							<?php endforeach; ?>
						<?php endif;?>
						</ul>
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
	<div class="grid-column grid-fixed-column grid-sidebar"></div>
		
</div>
<?php require_once('footer.php'); ?>