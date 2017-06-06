<?php
$k = isset($_GET['k']) ? $_GET['k'] : 0;
?>
<?php if($k == 1): ?>
<div class="input-email form-group">
    <input type="number" name="capdo" id="capdo" class="form-control" placeholder="Cấp độ" required min="1" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"/>
</div>
<div class="form-group" style="color:#fff;">
    <p><b><u>LƯU Ý:</u></b> Chụp hình NGƯỜI CHƠI cùng với màn hình có LEVEL GAME trên thiết bị di động. Hình không rõ số level hoặc không được chụp cùng người chơi sẽ không hợp lệ..</p>
    <p>Hình mẫu:  <img src="images/ngoctrai_level.png"></p>
</div>
<div class="form-group">
    <div style="position:relative;">
        <a class='btn btn-primary' href='javascript:;'>
            Chọn hình ảnh...
            <input type="file" name="hinhanh" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" required id="hinhanh" accept="image/*" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40"  onchange='$("#upload-file-info").html($(this).val().replace("C:\\fakepath\\", ""));'>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>
    </div>
    <button class="btn-shopping pull-right" name="submit" type="submit"><i class="icon icon-favourite"></i> Nhập điểm <i class="fa fa-sign-in"></i></button>
</div>
<!--<div class="input-email form-group col-md-6">
    <input type="text" name="diem" id="diem" class="form-control" placeholder="Điểm" required/>
</div>-->
<?php endif; ?>
<?php if($k == 2): ?>
<div class="input-email form-group">
    <input type="number" name="capdo" id="capdo" class="form-control" placeholder="Số khiên năng lượng" required min="1" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"/>
</div>
<div class="form-group" style="color:#fff;">
    <p><b><u>LƯU Ý:</u></b> Chụp hình NGƯỜI CHƠI cùng với màn hình có SỐ KHIÊN NĂNG LƯỢNG trên thiết bị di động. Hình không rõ số khiên hoặc không được chụp cùng người chơi sẽ không hợp lệ.</p>
    <p>Hình mẫu:  <img src="images/ngoctrai_sokhien.png"></p>
</div>
<div class="form-group">
    <div style="position:relative;">
        <a class='btn btn-primary' href='javascript:;'>
            Chọn hình ảnh...
            <input type="file" name="hinhanh" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" required id="hinhanh" accept="image/*" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40"  onchange='$("#upload-file-info").html($(this).val().replace("C:\\fakepath\\", ""));'>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>
    </div>
    <button class="btn-shopping pull-right" name="submit" type="submit"><i class="icon icon-favourite"></i> Nhập điểm <i class="fa fa-sign-in"></i></button>
</div>
<?php endif; ?>
<?php if($k == 3): ?>
	<div class="input-email form-group">
	    <input type="number" name="sotien" id="sotien" class="form-control" placeholder="Số tiền" required min="1" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"/>
	</div>
    <div class="form-group" style="color:#fff;">
        <p><b><u>LƯU Ý:</u></b> Chụp hình NGƯỜI CHƠI cùng HOÁ ĐƠN MUA HÀNG LEGO Nexo Knights. Hình phải rõ TÊN SẢN PHẨM, SỐ TIỀN, NGÀY MUA HÀNG, và được CHỤP CÙNG NGƯỜI CHƠI mới được tính hợp lệ.</p>
    </div>
    <div class="form-group">
        <div style="position:relative;">
            <a class='btn btn-primary' href='javascript:;'>
                Chọn hình ảnh...
                <input type="file" name="hinhanh" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);" required id="hinhanh" accept="image/*" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40"  onchange='$("#upload-file-info").html($(this).val().replace("C:\\fakepath\\", ""));'>
            </a>
            &nbsp;
            <span class='label label-info' id="upload-file-info"></span>
        </div>
        <button class="btn-shopping pull-right" name="submit" type="submit"><i class="icon icon-favourite"></i> Nhập điểm <i class="fa fa-sign-in"></i></button>
    </div>
<?php endif; ?>
<?php if($k == 4): ?>
	<div class="input-email form-group">
	    <input type="text" name="maso" id="maso" class="form-control" placeholder="Mã tích điểm" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"/>
	</div>
    <div class="form-group" style="color:#fff;">
        <p>Nhập mã tích điểm được trưng tại các địa điểm tổ chức Đấu Trường Hiệp Sĩ.</p>
    </div>
    <div class="form-group">
        <button class="btn-shopping pull-right" name="submit" type="submit"><i class="icon icon-favourite"></i> Nhập điểm <i class="fa fa-sign-in"></i></button>
    </div>
<?php endif; ?>
<?php if($k == 5): ?>
    <div class="input-email form-group">
        <input type="text" name="maso" id="maso" class="form-control" placeholder="Mã tích điểm" required oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"/>
    </div>
    <div class="form-group" style="color:#fff;">
        <p>Nhập mã tích điểm được trưng tại các địa điểm tổ chức Đại Hội Hiệp Sĩ.</p>
    </div>
    <div class="form-group">
        <button class="btn-shopping pull-right" name="submit" type="submit"><i class="icon icon-favourite"></i> Nhập điểm <i class="fa fa-sign-in"></i></button>
    </div>
<?php endif; ?>