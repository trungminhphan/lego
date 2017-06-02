<?php
require_once('header_none.php');
$nguoichoi = new NguoiChoi_5();$gridfs = new GridFS();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$act = isset($_POST['act']) ? $_POST['act'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';

$id_user = $users->get_userid();$hinhanh = '';
$hinhanh_file = isset($_FILES["hinhanh"]["name"]) ? $_FILES["hinhanh"]["name"] : '';
$hinhanh_size = isset($_FILES["hinhanh"]["size"]) ? $_FILES["hinhanh"]["size"] : 0;
$hinhanh_type = isset($_FILES["hinhanh"]["type"]) ? $_FILES["hinhanh"]["type"] : '';
$hinhanh_tmp  = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : '';
$old_hinhanh  = isset($_POST['old_hinhanh']) ? $_POST['old_hinhanh'] : '';
$temp = explode(".", $hinhanh_file);
if($hinhanh_file){
    $ext = end($temp);
    if($hinhanh_size < $max_file_size && in_array($ext, $images_extension)){
        $gridfs->filename = $hinhanh_file;
        $gridfs->filetype = $hinhanh_type;
        $gridfs->tmpfilepath = $hinhanh_tmp;
        $gridfs->caption = $hinhanh_file;
        echo $hinhanh_file;
    } else {
        $msg = 'Dung lượng hình ảnh quá lớn hoặc không đúng định dạng';
        transfers_to('nguoichoi_1.html?msg=' . $msg);
    }
} else {
    $hinhanh = $old_hinhanh;
}
$maso = isset($_POST['maso']) ? $_POST['maso'] : 0;
$diem = isset($_POST['diem']) ? $_POST['diem'] : 0;
if($act == 'check'){
    if($old_hinhanh && $hinhanh_file){
        $gridfs->id = $old_hinhanh; $gridfs->delete();
    }
    if($hinhanh_file) { $hinhanh = $gridfs->insert_files(); }
    $nguoichoi->id = $id;
    $noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
    $id_tinhtrang = isset($_POST['id_tinhtrang']) ? $_POST['id_tinhtrang'] : 0;
    $arr_tt = array('t' => intval($id_tinhtrang), 'noidung' => $noidung, 'date_post' => new MongoDate(), 'id_user' => new MongoId($id_user));
    $nguoichoi->hinhanh = $hinhanh;
    $nguoichoi->maso = $maso;
    $nguoichoi->tinhtrang = $arr_tt;
    $nguoichoi->diem = $diem;
    if($nguoichoi->check()) echo $arr_tinhtrang[$id_tinhtrang];
    //transfers_to('nguoichoi_5.html?msg=Cập nhật tình trạng thành công');
} else {
	if($hinhanh_file) $hinhanh = $gridfs->insert_files();      
	$nguoichoi->id_user = $id_user;
	$nguoichoi->hinhanh = $hinhanh;
    $nguoichoi->diem = $diem;
	$nguoichoi->maso = $maso;
	if($nguoichoi->insert()) transfers_to('nguoichoi_5.html?msg=Thêm thành công');
}
?>