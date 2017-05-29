<?php
require_once('header_none.php');
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_FILES['video_file']['name']) && $_FILES['video_file']['name']){
		// Loop $_FILES to exeicute all files
		foreach ($_FILES['video_file']['name'] as $f => $name) {   
		    if ($_FILES['video_file']['error'][$f] == 4) {
		        echo 'Failed';
		        continue; // Skip file if any error found
		    }
		    if ($_FILES['video_file']['error'][$f] == 0) {	           
		        if ($_FILES['video_file']['size'][$f] > $max_file_size) {
		        	echo '<div class="note note-success"> <h4>'.$nam.' quá lớn</h4></div>';
		            continue; // Skip large files
		        } elseif(!in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $videos_extension) ){
		        	echo '<div class="note note-success"> <h4>'.$name.' Không được phép</h4></div>';
					continue; // Skip invalid file formats
				} else{ // No error found! Move uploaded files 
					$type = $_FILES['video_file']['type'][$f];
					$size = $_FILES['video_file']['size'][$f];
					$extension = pathinfo($name, PATHINFO_EXTENSION);
					$alias = md5($name);
					$alias_name =  $alias . '_'. date("Ymdhms") . '.' . $extension;
		            if(move_uploaded_file($_FILES["video_file"]["tmp_name"][$f], $target_videos_home.$alias_name)) {
			            echo '<div class="items form-group">';
			        	echo '<div class="col-md-12">';
			            echo '<div class="input-group">
	                            <input type="hidden" class="form-control" name="video_aliasname[]" value="'.$alias_name.'" readonly/>
	                            <input type="hidden" class="form-control" name="video_type[]" value="'.$type.'" readonly/>
	                            <input type="hidden" class="form-control" name="video_size[]" value="'.$size.'" readonly/>
	                        	<input type="text" class="form-control" name="video_filename[]" value="'.$name.'" readonly/>
	                            <span class="input-group-addon"><a href="get.xoavideo.html?filename='.$alias_name.'" onclick="return false;" class="delete_file"><i class="fa fa-trash"></i></a></span>
	                        </div></div></div>';
	                } else {
	    				echo '<div class="alert alert-danger fade in m-b-15">
							<strong>Lỗi xảy ra!</strong>
							Không đủ bộ nhớ để upload, vui lòng chọn lại ít tập tin hơn
							<span class="close" data-dismiss="alert">&times;</span>
						</div>';            	
	                }
		        }
		    }
		}
	} else {
		echo '<div class="alert alert-danger fade in m-b-15">
			<strong>Lỗi xảy ra!</strong>
			Không đủ bộ nhớ để upload, vui lòng chọn lại ít tập tin hơn
			<span class="close" data-dismiss="alert">&times;</span>
		</div>';
	}
}
?>