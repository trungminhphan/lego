<?php
$k = isset($_GET['k']) ? $_GET['k'] : 0;
?>
<?php if($k == 1): ?>
<div class="input-email form-group">
    <input type="number" name="capdo" id="capdo" class="form-control" placeholder="Cấp độ" required min="1" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"/>
</div>
<div class="form-group" style="color:#fff;">
    <p>Level game Merlok 2.0: Chụp hình level trên màn hình máy tính bảng hoặc điện thoại di động. Hình phải rõ số level và được chụp cùng với người chơi.</p>
    <p>Hướng dẫn chi tiết: <a href="http://hiepsinexo.com/guides_detail.html?id=59157cc27247ae2015000034" target="_blank" style="color:#ffff00;">tại đây</a></p>
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
    <p>Số khiên năng lượng: Chụp hình số khiên trên màn hình máy tính bảng hoặc điện thoại di động. Hình phải rõ số khiên và được chụp cùng với người chơi</p>
    <p>Hướng dẫn chi tiết: <a href="http://hiepsinexo.com/guides_detail.html?id=59157cc27247ae2015000034" target="_blank" style="color:#ffff00;">tại đây</a></p>
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
        <p> Điểm mua hàng: Chụp hình hóa đơn mua hàng LEGO Nexo Knights. Hình phải rõ số tiền và được chụp cùng với người chơi.</p>
        <p>Hướng dẫn chi tiết: <a href="http://hiepsinexo.com/guides_detail.html?id=59157cc27247ae2015000034" target="_blank" style="color:#ffff00;">tại đây</a></p>
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
        <p>Điểm tham gia “Đấu trường hiệp sĩ”: Nhập mã tích điểm Đấu trường Hiệp sĩ có tại các địa điểm tổ chức Đấu trường Hiệp sĩ.</p>
        <p>Hướng dẫn chi tiết: <a href="http://hiepsinexo.com/guides_detail.html?id=59157cc27247ae2015000034" target="_blank" style="color:#ffff00;">tại đây</a></p>
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
        <p>Điểm tham gia “Đại hội hiệp sĩ”: Nhập mã tích điểm Đại hội Hiệp sĩ có tại các địa điểm tổ chức Đại hội Hiệp sĩ. </p>
        <p>Hướng dẫn chi tiết: <a href="http://hiepsinexo.com/guides_detail.html?id=59157cc27247ae2015000034" target="_blank" style="color:#ffff00;">tại đây</a></p>
    </div>
    <div class="form-group">
        <button class="btn-shopping pull-right" name="submit" type="submit"><i class="icon icon-favourite"></i> Nhập điểm <i class="fa fa-sign-in"></i></button>
    </div>
<?php endif; ?>