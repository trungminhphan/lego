<?php
require_once('header.php');
check_permis($users->is_admin());
$users_list = $users->get_list();
?>
<div class="row">
    <div class="col-md-12">
    <?php
    foreach($users_list as $u){
    	if(isset($u['sodienthoai']) && $u['sodienthoai'] && $u['username'] != 'admin'){
    		$users->id = $u['_id']; $users->username = $u['sodienthoai'];
    		if($users->set_username()){
    			echo $u['sodienthoai'] . '=====>'. $u['username'];
    			echo '<hr />';
    		}
    	}
    }
    ?>
    </div>
</div>
<?php require_once('footer.php'); ?>
<script src="assets/js/apps.min.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>