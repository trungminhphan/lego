<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
$session = new SessionManager();
$users = new Users();
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
$instancename = isset($_GET['instancename']) ? $_GET['instancename'] : ''; 
$a = explode("__", $instancename);
$id = end($a);
$video = new Video();
$video->id = $id; $v = $video->get_one();
?>
<!doctype html>
<html>
<head>
    <title>Video</title>
    <style type="text/css" media="screen">
        #videoplayer{
            width: 555px;
            height: 315px;
        }
    
    </style>
</head>
<body>
<?php if($v && isset($v['link']) && $v['link']): ?>
    <iframe width="560" height="315" src="<?php echo $v['link']; ?>" frameborder="0" allowfullscreen></iframe>
<?php else: ?>
    <video poster="<?php echo isset($v['hinhanh'][0]['aliasname']) ? $target_images . $v['hinhanh'][0]['aliasname'] : 'images/default_video.png';?>" controls crossorigin id="videoplayer">
        <source src="<?php echo $target_videos . $v['dinhkem'][0]['aliasname']; ?>" type="video/mp4">
        <source src="<?php echo $target_videos . $v['dinhkem'][0]['aliasname']; ?>" type="video/webm">
    </video>
<?php endif; ?>
</body>
</html>