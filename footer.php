</div>
<script src="js/jquery-1.10.2.min.js?l.r2=1.0.0.9"></script>
<script src="js/app.min.js?l.r2=1.0.0.9"></script>
<footer style="margin-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-9 copyright" itemscope itemtype="http://schema.org/Organization">
                <img itemprop="logo" src="images/logo.png" height="56" alt="LEGO NEXO KNIGHTS" />
                <div  style="font-family:Segoe UI, Roboto;">
                <span itemprop="name"><b>&copy; Công Ty Cổ Phần Việt Tinh Anh</b></span><br />
                Địa chỉ: 33-35 Đường D4, Khu Đô Thị Mới Him Lam, P.Tân Hưng, Q.7, HCM. <br />
                Điện thoại: (84-8) 54 31 8717/492 <br />
                Email: legomarketingteam@gmail.com </div>
            </div>
            <!--<div class="col-3">
                <ul class="link-footer">
                    <li><a title="Giới thiệu" rel="nofollow" href="#">Giới thiệu</a></li>
                    <li><a title="Liên hệ" rel="nofollow" href="#">Liên hệ</a></li>
                </ul>
            </div>-->
        </div>
    </div>
</footer>
<script type="text/javascript" src="js/nexoknights.js"></script>

<!--[if IE 8]>
<script src="js/lego-deprecatedwarning.min.js?l.r2=1.0.0.9"></script>
<script type="text/javascript">
    window.attachEvent("onload", function(){return LEGO.deprecatedBrowser.showWarning('You are using Internet Explorer 8, this browser is very old and not supported by this part of www.hiepsiNEXO.com. Please update your browser for a better experience browsing www.hiepsiNEXO.com');});
</script>
<![endif]-->
<!--[if IE 9]>
<script src="js/lego-deprecatedwarning.min.js?l.r2=1.0.0.9"></script>
<script type="text/javascript">
    window.addEventListener("load", function () { return LEGO.deprecatedBrowser.showNotification('You are using Internet Explorer 9, consider upgrading your browser for a better experience'); });
</script>
<![endif]-->
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        var width = $(window).width();      
        if(parseInt(width) > 768){
            $(".logo").click(function(){
                var _link = $(this).attr("href");
                $(".collapse-wrapper").hide();
                window.location.href = _link;

            });
        }
    });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-100617613-1', 'auto');
  ga('send', 'pageview');
</script>