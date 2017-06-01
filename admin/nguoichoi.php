<?php
require_once('header.php');
check_permis($users->is_admin()); $nguoichoi = new NguoiChoi();$fs = new GridFS();
$danhsachdiem = new DanhSachDiem();
$act = isset($_GET['act']) ? $_GET['act'] : 0;
$id_show = isset($_GET['id_show']) ? $_GET['id_show'] : '';
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$list = $nguoichoi->get_distinct_user();
?>
<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
<div class="col-md-12">
    <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-success"><i class="fa fa-refresh"></i> Tải lại</a>
    <a href="nguoichoi.html?act=0" class="btn btn-danger"><i class="fa fa-exclamation-circle"></i> Chưa duyệt</a>
    <a href="nguoichoi.html?act=1" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Đã duyệt</a>
    <a href="nguoichoi.html?act=2" class="btn btn-info"><i class="fa fa-ban"></i> Không duyệt</a>
    <a href="get.nguoichoi.html?act=del_all" class="btn btn-default" onclick="return confirm('Chắc chắn xóa? Xóa sẽ mất hết dữ liệu!');"><i class="fa fa-trash"></i> Xoá tất cả điểm chưa duyệt</a>
    <hr />
    <div class="panel-group" id="accordion">
        <?php foreach($list as $k => $v): ?>
        <?php
        $nguoichoi->id_user = $v;
        if($nguoichoi->check_new($act)):
        $users->id = $v; $u = $users->get_one();
        $diem_1 = $nguoichoi->get_maxdiem(1);
        $diem_2 = $nguoichoi->get_maxdiem(2);
        $diem_3 = $nguoichoi->get_sumdiem(3);
        $diem_4 = $nguoichoi->get_sumdiem(4);
        $diem_5 = $nguoichoi->get_sumdiem(5);
        $tongdiem = $diem_1 + $diem_2 + $diem_3 + $diem_4 + $diem_5;
        $danhsachdiem->id_user = $v; $danhsachdiem_list = $danhsachdiem->get_list_by_user();
        ?>
        <div class="panel panel-primary overflow-hidden">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $k; ?>">
                        <i class="fa fa-plus-circle pull-right"></i> 
                        # <?php echo $k + 1 . '. ' .$u['username'] .' - '. $u['hoten']; ?>
                    </a>
                </h3>
            </div>
            <div id="collapse_<?php echo $k; ?>" class="panel-collapse collapse <?php echo $v==$id_show ? 'in' : ''; ?>">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ngày</th>
                                        <th>Điểm</th>
                                        <th class="text-center"><i class="fa fa-trash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($danhsachdiem_list && $danhsachdiem_list->count() > 0){
                                    $i=1;
                                    foreach($danhsachdiem_list as $ds){
                                        echo '<tr class="list-item">';
                                        echo '<td>'.$i.'</td>';
                                        echo '<td>'.date("d/m/Y", $ds['date_post']->sec).'</td>';
                                        echo '<td>'.format_number($ds['diem']).'</td>';
                                        echo '<td><a href="get.danhsachdiem.html?id='.$ds['_id'].'&id_user='.$v.'&act=del" class="xoadanhsachdiem" name="#diem_'.$v.'" onclick="return false;"><i class="fa fa-trash"></i></a></td>';
                                        echo '</tr>'; $i++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            <form action="post.danhsachdiem.html" method="POST" class="postdanhsachdiem">
                            <div class="row">
                                <div class="col-md-6"><h4><i class="fa fa-heart"></i> Tổng điểm:</h4></div>
                                <input type="hidden" name="id_user" id="user" value="<?php echo $v; ?>" />
                                <input type="hidden" name="collapse" id="collapse" value="<?php echo 'collapse_' . $k; ?>" />                                
                                <div class="col-md-4"><input type="text" name="diem" id="diem_<?php echo $v; ?>" value="<?php echo $tongdiem; ?>" class="form-control"/></div>
                                <div class="col-md-2 text-center">                               
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-9">
                        <div class="height-lg" data-scrollbar="true">
                        <?php
                        foreach($arr_loaidiem as $key => $value):
                            $nguoichoi->loaidiem = $key;
                            $list_diem = $nguoichoi->get_list_by_loaidiem_user($act);
                            if($list_diem && $list_diem->count() > 0):
                        ?>
                            <h1 class="page-header text-primary bold" style="clear:both;text-transform: uppercase;"><i class="fa fa-android"></i> <?php echo $value; ?></h1>
                            <hr />
                            <div class="gallery">
                            <?php foreach($list_diem as $diem): ?>
                                <div class="image">
                                    <div class="image-inner">
                                        <?php
                                        if($diem['hinhanh']):
                                        $fs->id = $diem['hinhanh']; $object = $fs->get_one_file();
                                        ?>
                                        <a href="<?php echo $target_images_home . 'medium-size/'.$diem['hinhanh'].'_'.$object->file['filename']; ?>" data-lightbox="gallery-group-1">
                                            <img src="<?php echo $target_images_home . 'thumb-size/'.$diem['hinhanh'].'_'.$object->file['filename']; ?>" alt="" />
                                        </a>
                                        <?php else: ?>
                                            <div style="font-size: 20px;height:100px;padding-top:60px;">
                                            Mã số: <?php echo isset($diem['maso']) ? $diem['maso'] : ''; ?>
                                            </div>
                                        <?php endif; ?>
                                        <p class="image-caption">
                                            <i class="fa fa-heart"></i> <?php echo $diem['diem']; ?> &nbsp;&nbsp;&nbsp;
                                            <a href="get.nguoichoi.html?id=<?php echo $diem['_id']; ?>&id_user=<?php echo $v; ?>&act=del#modal-xoanguoichoi" data-toggle="modal" class="xoanguoichoi" name="#diem_<?php echo $v;?>" onclick="return false;"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a href="get.nguoichoi.html?id=<?php echo $diem['_id']; ?>&id_user=<?php echo $v; ?>&act=xetduyet" class="duyetnguoichoi" name="#diem_<?php echo $v;?>" onclick="return false;"><i class="fa fa-check-square-o"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a href="get.nguoichoi.html?id=<?php echo $diem['_id']; ?>&id_user=<?php echo $v; ?>&act=khongxetduyet&collapse=<?php echo 'collapse_' . $k; ?>&k=<?php echo $act; ?>#modal-khongduyet" data-toggle="modal" class="khongduyetnguoichoi" name="#diem_<?php echo $v;?>" onclick="return false;"><i class="fa fa-ban"></i></a>
                                        </p>
                                    </div>
                                    <div class="image-info">
                                        <div class="desc text-center">Ngày đăng: <?php echo date("d/m/Y H:i", $diem['date_post']->sec); ?></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; endforeach; ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; endforeach; ?>
    </div>
</div>

<div class="modal fade" id="modal-xoanguoichoi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Chắc chắn xóa?</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h3>Xóa dữ liệu sẽ mất, không thể khôi phục</h3>
                </div>
            </div>
            <div class="modal-footer text-center">
                <a href="#" class="btn btn-white" data-dismiss="modal"><i class="fa fa-close"></i> Không xóa</a>
                <button type="submit" name="submit" data-dismiss="modal" id="xoanguoichoi_ok" class="btn btn-danger"><i class="fa fa-trash"></i> Đồng ý xóa</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-khongduyet">
<form action="post.nguoichoi.html" method="POST" class="form-horizontal" data-parsley-validate="true" name="duyetnguoichoiform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Nội dung không duyệt</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <label class="col-md-3 control-label">Nội dung không duyệt</label>
                <div class="col-md-9">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="k" id="k" />
                    <input type="hidden" name="id_user" id="id_user" />
                    <input type="hidden" name="act" id="act" value="khongxetduyet"/>
                    <input type="hidden" name="collapse" id="collapse_duyet" value="">
                    <input type="text" name="noidung" id="noidung" value="" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-white" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</a>
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Đồng ý</button>
            </div>
        </div>
    </div>
</form>
</div>
<div style="clear:both;"></div>
<?php require_once('footer.php'); ?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="assets/plugins/lightbox/js/lightbox.min.js"></script>
<script src="assets/js/apps.min.js"></script>
<!-- ====
============== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function(){
        $(".khongduyetnguoichoi").click(function(){
            var _this = $(this); var _link = $(this).attr("href");
            $.getJSON(_link, function(data){
                $("#id").val(data.id);
                $("#collapse_duyet").val(data.collapse);
                $("#id_user").val(data.id_user);
                $("#k").val(data.k);
                $("#noidung").val(data.noidung);
            });
        });
        $(".duyetnguoichoi").click(function(){
            var _this = $(this); var _link = $(this).attr("href");
            var form = $(this).attr("name");
            $.get(_link, function(diem){
                $(form).val(diem);
                _this.parents("div.image").fadeOut();
            });
        });
        $(".xoanguoichoi").click(function(){
            var _this = $(this); var _link = $(this).attr("href");
            var form = $(this).attr("name");
            $("#xoanguoichoi_ok").click(function(){
                $.get(_link, function(diem){
                    $(form).val(diem);
                    _this.parents("div.image").fadeOut();

                });
            });
            
        });

        $(".xoadanhsachdiem").click(function(){
            var _this = $(this);
            var _link = $(this).attr("href");
            var form = $(this).attr("name");
            $.get(_link, function(data){
                $(form).val(data);
                _this.parents(".list-item").fadeOut();
            });
        });
        <?php if(isset($msg) && $msg): ?>
        $.gritter.add({
            title:"Thông báo !",
            text:"<?php echo $msg; ?>",
            image:"assets/img/login.png",
            sticky:false,
            time:""
        });
        <?php endif; ?>  
        App.init();
    });
</script>