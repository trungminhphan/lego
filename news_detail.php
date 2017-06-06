<?php
require_once('header.php');
$tintuc = new TinTuc();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tintuc->id = $id; $tt = $tintuc->get_one();
$list = $tintuc->get_all_list();
?>
<link rel="stylesheet" type="text/css" href="css/universh/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/default.css">
<link rel="stylesheet" type="text/css" href="css/universh/theme.css">
<link rel="stylesheet" type="text/css" href="css/universh/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/univershicon.css">
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<?php if($tt): ?>
<div class="page-default bg-none typo-dark pad-tb-30" style="color:#fff;">
	<!-- Container -->
	<div class="container">
		<div class="row">
			<!-- Blog Column -->
			<div class="col-xs-12 blog-single">
				<div class="blog-single-wrap">
					<!-- Blog Detail Wrapper -->
					<div class="blog-single-details">
						<h4><a href="#" style="color:#fff;"><?php echo $tt['tieude']; ?></a></h4>
						<ul class="blog-meta" style="padding:0px;">
							<li><i class="fa fa-calendar-o"></i> Ngày đăng: <?php echo date("d/m/Y", $tt['date_post']->sec); ?></li>								
						</ul><!-- Blog Meta -->
						<?php echo $tt['mota']; ?>
						<?php echo $tt['noidung']; ?>
					
					</div><!-- Blog Detail Wrapper -->
				</div><!-- Blog Wrapper -->
				<?php if($tt['hinhanh'] && count($tt['hinhanh']) > 1): ?>
				<ul lego-slider lego-element-size data-format="sixteen-nine">
				<?php
				foreach($tt['hinhanh'] as $k => $h):
					if($k > 0): 
				?>
					<li>
		                <div class="list-item">
		                    <div class="primary-content">
		                        <img src="<?php echo $target_images.$h['aliasname']; ?>" alt="<?php echo $h['mota']; ?>" />
		                    </div>
		                </div>
		            </li>
		        <?php endif; endforeach; ?>
				</ul>	
				<?php endif; ?>				
			</div><!-- Column -->
		</div><!-- Row -->
	</div><!-- Container -->
</div><!-- Page Default -->
<?php endif; ?>
<?php if($list): ?>
<div class="grid-row site-content">
	<div class="grid-column">
		<div class="grid-row videos-carousel-list" data-list-id="tinlienquan">
    	<div class="grid-column">
        	<div class="grid-content" style="max-width: 1200px; margin:auto;">
            	<a href="#" class="hgroup">
					<i class="icon icon-big icon-mini-movies"></i>
					<h2>Tin liên quan</h2>
				</a>
            	<ul class="list list-grid list-horizontal"
	                lego-carousel
	                lego-element-size
	                data-size="3"
	                data-format="landscape"
	                data-uitest="list-carousel">
	                <?php foreach($list as $l): ?>
                    <li>
						<a href="news_detail.html?id=<?php echo $l['_id']; ?>" class="video list-item">
						    <div class="primary-content video-modal-cover-image">
						    <?php
							    if(isset($l['hinhanh'][0]['aliasname'])){
							    	echo '<img src="'.$target_images.$l['hinhanh'][0]['aliasname'].'" alt="'.$l['tieude'].'" />';
							    } else {
							    	echo '<img src="images/Vid_CombineNPlay_L_12col.jpg" alt="'.$l['tieude'].'" />';
							    }
						    ?>
						    </div>
						    <div class="secondary-content">
						        <h5><?php echo $l['tieude']; ?></h5>
						    </div>
						</a>
					</li>
					<?php endforeach; ?>
            	</ul>
        	</div>
    	</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php require_once('footer.php'); ?>

