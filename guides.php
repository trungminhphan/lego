<?php
require_once('header.php');
$huongdan = new HuongDan();
$list = $huongdan->get_all_list();
?>
<link rel="stylesheet" type="text/css" href="css/universh/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/default.css">
<link rel="stylesheet" type="text/css" href="css/universh/theme.css">
<link rel="stylesheet" type="text/css" href="css/universh/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/universh/univershicon.css">
<link rel="stylesheet" href="css/ranking/footer.css" media="all" type="text/css" />
<div class="page-default bg-none typo-dark pad-tb-30">
        <!-- Container -->
        <div class="container">
            <ul class="row" style="list-style-type: none;">
            <div class="title-container text-left sm">
                <div class="title-wrap">
                    <h3 class="title">HƯỚNG DẪN</h3>
                    <span class="separator line-separator"></span>
                </div>                          
            </div>
            <?php if($list): ?>
            <?php foreach($list as $l): ?>
                <li class="col-xs-12 blog-list-wrap">
                    <!-- Blog Wrapper -->
                    <div class="row blog-wrap">
                        <div class="col-sm-5">
                            <div class="blog-img-wrap">
                            <?php
                                if(isset($l['hinhanh'][0]['aliasname'])){
                                    echo '<img width="600" height="220" src="'.$target_images.$l['hinhanh'][0]['aliasname'].'" class="img-responsive" alt="'.$l['tieude'].'">';
                                } else {
                                    echo '<img width="600" height="220" src="images/70348_17_LancesTwinJouster_L_8col.jpg" class="img-responsive" alt="'.$l['tieude'].'">';
                                }
                            ?>
                            </div><!-- Blog Image  Wrapper -->
                        </div><!-- Blog Wrapper -->
                        <!-- Blog Detail Wrapper -->
                        <div class="col-sm-7">
                            <div class="blog-details">
                                <h4><a href="guides_detail.html?id=<?php echo $l['_id']; ?>"><?php echo $l['tieude']; ?></a></h4>
                                <ul class="blog-meta" style="padding:0px;">
                                    <li><i class="fa fa-calendar-o"></i> Ngày đăng: <?php echo date("d/m/Y", $l['date_post']->sec); ?></li>
                                </ul><!-- Blog Meta -->
                                
                                    <?php echo preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $l['mota']); ?>
                            
                                <div class="text-right">
                                    <a class="btn" href="guides_detail.html?id=<?php echo $l['_id']; ?>">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="md">
                </li>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul><!-- Row -->
        </div><!-- Container -->

        <!-- Pagination -->
        <!--<div class="row">
            <div class="col-sm-12">
                <nav class="text-center">
                    <ul class="pagination">
                        <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div> Row -->
    </div><!-- Page Default -->
<?php require_once('footer.php'); ?>