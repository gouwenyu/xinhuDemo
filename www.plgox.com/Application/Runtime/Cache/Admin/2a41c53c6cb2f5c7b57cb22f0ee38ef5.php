<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>后台登录</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="/Public/Admin/css/login-reset.css">
        <link rel="stylesheet" href="/Public/Admin/css/login-supersized.css">
        <link rel="stylesheet" href="/Public/Admin/css/login-style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="page-container">
            <div class="container" style="width:300px;margin-left:40%;">
                <h1>后台登录页面</h1>
                <!-- <form method="post"> -->
                    <input type="text" name="username" class="username" placeholder="Username" value=""><br>
                    <input type="password" name="password" class="password" placeholder="Password" value=""><br>
                    <input type="text" name="VerCode" class="VerCode" placeholder="Verification Code" value="" style="width:115px;float:left;"><img src="<?php echo U('App/Checkcode/checkcode');?>" style="width:145px;height: 40px;margin-top:27px;cursor:pointer;" class="img-responsive" onclick="yzmCode();" id="yzmCodes"><br>
                    <button type="submit" class="submit">Sign me in</button>
                    <div class="error"><span>+</span></div>
                <!-- </form> -->
                <div class="connect">
                    <p>Or connect with:</p>
                    <p>
                        <a class="facebook" href=""></a>
                        <a class="twitter" href=""></a>
                    </p>
                </div>                
            </div>
        </div>
        <!-- Javascript -->
        <script src="/Public/Admin/js/jquery-1.8.2.min.js"></script>
        <script src="/Public/Admin/js/login-supersized.3.2.7.min.js"></script>
        <script src="/Public/Admin/js/login-scripts.js"></script>
    </body>
<script type="text/javascript">
function yzmCode(){
    var time = new Date().getTime();
    $("#yzmCodes").attr('src',"<?php echo U('App/Checkcode/checkcode');?>?yzmRand=" + time);
}
jQuery(function($){
    // 背景换色
    $.supersized({

        // Functionality
        slide_interval     : 4000,    // Length between transitions
        transition         : 1,    // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
        transition_speed   : 1000,    // Speed of transition
        performance        : 1,    // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)

        // Size & Position
        min_width          : 0,    // Min width allowed (in pixels)
        min_height         : 0,    // Min height allowed (in pixels)
        vertical_center    : 1,    // Vertically center background
        horizontal_center  : 1,    // Horizontally center background
        fit_always         : 0,    // Image will never exceed browser width or height (Ignores min. dimensions)
        fit_portrait       : 1,    // Portrait images will not exceed browser height
        fit_landscape      : 0,    // Landscape images will not exceed browser width

        // Components
        slide_links        : 'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
        slides             : [    // Slideshow Images
                                 {image : '/Public/Admin/image/backgrounds/1.jpg'},
                                 {image : '/Public/Admin/image/backgrounds/2.jpg'},
                                 {image : '/Public/Admin/image/backgrounds/3.jpg'}
                             ]
    });
    // 检测帐号登录机制
    $(".submit").click(function(){
        var time  = new Date().getTime();
        if( $(".VerCode").val() == "" ){
            alert("验证码不能为空");
            $("#yzmCodes").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzmRand" + time );
        }else{
            if( $(".username").val() == "" && $(".password").val() == "" ){
                alert("帐号或者密码不能为空");
                $("#yzmCodes").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzmRand" + time );
            }else{
                $.ajax({
                    type: "POST",
                dataType: "JSON",
                     url: "<?php echo U('Tourist/check');?>",
                    data: { username:$(".username").val() , password:$(".password").val() , VerCode:$(".VerCode").val() },
                    success: function( data ){
                        if( data.status == 201 ){
                            alert(data.message);
                            $("#yzmCodes").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzmRand" + time );
                        }else if( data.status == 200 ){
                            alert(data.message);
                            window.location.href="<?php echo U('Index/index');?>";
                        }else if( data.status == 301 ){
                            alert(data.message);
                            $("#yzmCodes").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzmRand" + time );
                        }else if( data.status == 305 ){
                            alert(data.message);
                            $("#yzmCodes").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzmRand" + time );
                        }                           
                    },
                    error: function( XMLHttpRequest , error , status ){
                        alert("Ajax错误或者网络错误," + XMLHttpRequest +","+ error + ","+ status );
                    }
                });
            }
        }
    });
});
</script>
</html>