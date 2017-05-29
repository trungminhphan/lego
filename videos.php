<?php
require_once('header.php');
$arr_videos = array(
	'MINI VIDEOS','TV SERIES',' PRODUCTS VIDEOS', 'GAMES VIDEOS', 'CHARACTER VIDEOS'
	);
$danhmucvideo = new DanhMucVideo();
$danhmucvideo_list = $danhmucvideo->get_all_list();
$video = new Video();
?>
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<?php if($danhmucvideo_list): ?>
<?php
foreach($danhmucvideo_list as $key => $value) : 
$list = $video->get_list_condition(array('id_danhmucvideo' => strval($value['_id'])));
?>
<div class="grid-row site-content">
	<div class="grid-column">
		<div class="grid-row videos-carousel-list" data-list-id="<?php echo $key; ?>">
    	<div class="grid-column">
        	<div class="grid-content">
            	<a href="#" class="hgroup">
					<i class="icon icon-big icon-mini-movies"></i>
					<h2><?php echo $value['ten']; ?></h2>
	            	<!--<span class="view-all">Xem tất cả</span>-->
				</a>
				<?php if($list && $list->count() > 0): ?>
            	<ul class="list list-grid list-horizontal"
	                lego-carousel
	                lego-element-size
	                data-size="3"
	                data-format="landscape"
	                data-uitest="list-carousel">
	                <?php foreach($list as $k => $v): ?>
                    <li>
						<div lego-video-modal="<?php echo $v['tieude']; ?>" data-lego-video-modal-mediaplayer="modalvideo__<?php echo $value['_id']; ?>__<?php echo $v['_id']; ?>" data-lego-video-modal-mediaplayer-id="../video.html" class="video list-item">
						    <div class="primary-content video-modal-cover-image">
						    <?php if(isset($v['hinhanh'][0]['aliasname'])): ?>
						    	<img src="<?php echo $target_images . $v['hinhanh'][0]['aliasname']; ?>" alt="<?php echo $v['tieude']; ?>" />
						    <?php else: ?>
						        <img src="images/default_video.png" alt="<?php echo $v['tieude']; ?>" />
						    <?php endif; ?>
						    </div>
						    <div class="secondary-content">
						        <h5><?php echo $v['tieude']; ?></h5>
						    </div>
						</div>
					</li>
					<?php endforeach; ?>
            	</ul>
            	<?php else: ?>
            		<h3 style="color:#ffff00;">ĐANG CẬP NHẬT</h3>
            	<?php endif; ?>
        	</div>
    	</div>
		</div>
	</div>
</div>
<?php endforeach; ?>
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