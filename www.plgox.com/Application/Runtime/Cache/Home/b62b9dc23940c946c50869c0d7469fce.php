<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header');?>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/dl_zc_zh.css">
<style type="text/css">
	.find_mm{
		background:url("/Public/Home/image/findpass.jpg") no-repeat center center;
		
	}
	.find_box1{
		height:490px;
		margin-top:60px;
	}
	.find_box1_b{
		margin-top:45px;
	}
  .find_box106{
    margin-top:45px;
  }
</style>
<!--<div class="header_box1">
		<div class="header_middle">
			<div class="header_middle_left">
				<img src="/Public/Home/image/logo.jpg" />
				
			</div>
			<div class="header_middle_center1" >找回密码</div>
		</div>
</div>-->
	
	
<div class="find_mm">
  <div class="login_box">
  	<div class="find_box1" >
    <div class="find_box1_b">
    	
    	
    	<!--  <div class="find_box10">
              <div class="find_box101">
      	  用户名：
      	  </div>	   
              <div class="find_box102">
                  <input type="text" name="username" class="username"/>
              </div>
              <div class="find_box10_false"></div>
           </div> -->
           
           
      	<div class="find_box10" >
      	  <div class="find_box101">
      	  	手机号码：
      	  </div>	
  
      	  <div class="find_box102" >
      	  	<input type="text" name="telephone" class="tel_phone"/>
      	  </div>
      	    <div class="find_box10_false"></div>
      	</div>
      	<div class="find_box10">
      	  <div class="find_box101">
      	  	图片验证码：
      	  </div>	
      	  <div class="find_box103" style="margin-right:20px;">
      	  	<input type="text" name="imgCode" class="imgCode"/>
      	  </div>
      	   <div class="YzmCode" style="width:120px;height:40.5px;overflow:hidden;float:left;">
      	     <img src="<?php echo U('App/Checkcode/checkcode');?>" style="width:165px;margin-left:-20px;height:50px;overflow:hidden;"  class="find_box105" onclick="yzmCode();" id="yzmCode1">
           </div>
      	     <div class="find_box10_false"></div>
      	</div>
      	<div class="find_box10">
      	  <div class="find_box101">
      	  验证码：
      	  </div>	
      	  <div class="find_box103">
      	  	<input type="text" name="telCode" class="telCode"/>
      	  </div>
      	  <div class="find_box105 telCode1">
      	     <a href="javascript:void(0);"  style="color:#FFFFFF;" onclick="time_down();">获取验证码</a>
      	  </div>
      	  <div class="find_box10_false"></div>
      	</div>
      	
      	<div class="find_box10">
      	  <div class="find_box101">
      	 设置新密码：
      	  </div>	
      	  <div class="find_box102 password1">
      	  	<input type="password" name="password" class="password" />
      	  	<img class="find_xsmm findmm1"  src="/Public/Home/image/findpass1.png" onClick="show_pass();" style="cursor:pointer;" />
      	  </div>
      	  <div class="find_box10_false"></div>
      	</div>
      	<div class="find_box10">
      	  <div class="find_box101">
      	重复新密码：
      	  </div>	
      	  <div class="find_box102 repassword1">
      	  	<input type="password" name="repassword" class="repassword" />
            <img class="find_xsmm findmm2"  src="/Public/Home/image/findpass1.png" onClick="show_repass();" style="cursor:pointer;" />
      	  </div>
      	  <div class="find_box10_false"></div>
      	</div>
      	<input  type="button" value="立即修改"  class="find_box106"/>
      </div>
    </div> 
  </div> 
</div>
<script type="text/javascript">
function yzmCode() {
     var time = new  Date().getTime();
     $("#yzmCode1").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzm=" + time );
}
function show_pass() {
   if($(".password").attr("type")=="password"){
		$(".password").attr("type","text");
		$(".findmm1").attr("src","/Public/Home/image/reginster.png");
	}
	else{
		$(".password").attr("type","password");
		$(".findmm1").attr("src","/Public/Home/image/findpass1.png");
	}
}
function show_repass() {
  if($(".repassword").attr("type")=="password"){
		$(".repassword").attr("type","text");
		$(".findmm2").attr("src","/Public/Home/image/reginster.png");
	}
	else{
		$(".repassword").attr("type","password");
		$(".findmm2").attr("src","/Public/Home/image/findpass1.png");
	}
}

$(function(){
	var jgj=""; 
	function sjh(){
           var re = /^[1][3,4,5,7,8][0-9]{9}$/;
            if( !re.test($(".tel_phone").val()) || $(".tel_phone").val()==""){
              $(".find_box10_false").eq(0).html("请输入正确的手机号码");
              $(".tel_phone").css("border","1px solid #cf1a1a");
              jgj="false";
            }
            else{
              $(".find_box10_false").eq(0).html("");
              $(".tel_phone").css("border","1px solid #D6D6D6");
              jgj="true";
            }
    }
	
	function sjyz(){
          if( $(".telCode").val() == "" ){
            $(".find_box10_false").eq(2).html("手机验证码错误!");
            jgj="false";
            $(".telCode").css("border","1px solid #cf1a1a");
          }
          else{
            $(".find_box10_false").eq(2).html("");
            $(".telCode").css("border","1px solid #D6D6D6");
            jgj="true";
          }
        }

        function tpyz(){
           if($(".imgCode").val() =="" ){
              //alert("请输入图形验证码!");
              $(".find_box10_false").eq(1).html("请输入正确的图形验证码");
              $(".imgCode").css("border","1px solid #cf1a1a");
              jgj="false";
            
            }
            else{
              $(".find_box10_false").eq(1).html("");
              $(".imgCode").css("border","1px solid #D6D6D6");
               jgj="true"; 
               
            }
        }


        function mm(){
           if( $(".password").val() == "" ){
              $(".find_box10_false").eq(3).html("密码不能为空!");
              $(".password").css("border","1px solid #cf1a1a");
             jgj="false";
            }
            else{
              $(".find_box10_false").eq(3).html("");
              $(".password").css("border","1px solid #D6D6D6");
              jgj="true";
            }
        }

        function zcmm(){
          if($(".repassword").val()==""){
               $(".find_box10_false").eq(4).html("确认密码不能为空");
                $(".repassword").css("border","1px solid #cf1a1a");
               jgj="false";
          }
            else if( $(".password").val() !== $(".repassword").val()  ){
              //alert("两次输入的密码不一致，请重新输入!");
               $(".find_box10_false").eq(4).html("两次输入的密码不一致，请重新输入!");
                $(".repassword").css("border","1px solid #cf1a1a");
               jgj="false";
              yzmCode();
            }
            else{
              $(".find_box10_false").eq(4).html("");
              $(".repassword").css("border","1px solid #D6D6D6");
               jgj="true";
            }
       }
        
        
$("input").each(function(index){
  $(this).focus(function(){
    $(".find_box10_false").eq(index).css("color","#CCCCCC");
     if(index==0){
      $(".find_box10_false").eq(index).html("手机号码如：13099073632");
         
     }
     else if(index==1){
       $(".find_box10_false").eq(index).html("请输入正确的图形验证码");

     }
     else if(index==2){
       $(".find_box10_false").eq(index).html("请输入正确的手机验证码");
     }
     else if(index==3){
       $(".find_box10_false").eq(index).html("有被盗风险,建议使用字母、数字和符号两种及以上组合");
     }
     else if(index==4){
       $(".find_box10_false").eq(index).html("必须与上面的密码一致");
     }
  });
  
  $(this).blur(function(){
       $(".find_box10_false").eq(index).css("color","#CF1A1A"); 
      if(index==0){
            sjh();
     }
     else if(index==1){
         tpyz();
     }
     else if(index==2){
        sjyz();
     }
     else if(index==3){
           mm();
     }
     else if(index==4){
         zcmm();
     }

   });
});

	
	
      $(".find_box106").on("click",function(){
      	
            /*var font_phone = /^[1][3,4,5,7,8][0-9]{9}$/;
            if( $(".tel_phone").val() == "" ){
                  alert("手机号是不可以为空的额!");
                  return false;
            }else if( !font_phone.test( $(".tel_phone").val() ) ){
                  alert("请输入正确的手机号码!");
                  return false;
            }
            if( $(".imgCode").val() == "" ){
                  alert("图形验证码不可为空的额!");
                  return false;
            }
            if( $(".telCode").val() == "" ){
                  alert("手机验证码不可为空的额!");
                  return false;
            }
            if( $(".password").val() == "" ){
                  alert("密码不可为空的额!");
                  return false;
            }else if( $(".password").val() != $(".repassword").val() ){
                  alert("密码和确认密码必须要保持一致!");
                  return false;
            }
            if( $(".repassword").val() == "" ){
                  alert("确认密码不可为空的额!");
                  return false;
            }
            if( $(".password").val().length < 6 || $(".repassword").val().length < 6 ){
                  alert("密码和确认密码的长度不能低于六位");
                  return false;
            }*/
            // 
                sjh();
                tpyz();
                sjyz();               
                mm();
                zcmm();
            
             if(jgj=="true"){
             	$.ajax({
                type: "POST",
            dataType: "JSON",
                 url: "<?php echo U('Tourist/eidt_dofindpass');?>",
                 //  "imgCode":$(".imgCode").val() ,
                data: { "telephone":$(".tel_phone").val() ,  "telCode":$(".telCode").val() , "password":$(".password").val() },
                success: function( data ){
                   if( data.status == 2000 ){
                       alert(data.message);
                       window.location.href = "<?php echo U('Index/index');?>";
                       return false;
                   }else if( data.status == -2002 ){
                       $(".find_box10_false").eq(3).html(data.message);
                       $(".password").css("border","1px solid #cf1a1a");
                        yzmCode();
                   /*}else if( data.status == -2001 ){
                       $(".find_box10_false").eq(1).html(data.message);
                       $(".imgCode").css("border","1px solid #cf1a1a");
                        yzmCode();*/
                   }else if( data.status == -2003 ){
                       alert(data.message);
                        yzmCode();
                   }else if( data.status == -2004 ){
                       $(".find_box10_false").eq(2).html(data.message);
                       $(".telCode").css("border","1px solid #cf1a1a");
                        yzmCode();
                   }
                }
          });
         }
      });
});
// 发送验证码
function time_down(){
    var font_phone = /^[1][3,4,5,7,8][0-9]{9}$/;
    if( $(".tel_phone").val() == "" ){
          $(".find_box10_false").eq(0).html("手机号是不可以为空的额!");
          $(".tel_phone").css("border","1px solid #cf1a1a");
          yzmCode();
    }else if( !font_phone.test( $(".tel_phone").val() ) ){
          $(".find_box10_false").eq(0).html("手机号格式不正确");
          $(".tel_phone").css("border","1px solid #cf1a1a");
         yzmCode();
    }
    if( $(".imgCode").val() == "" ){
          $(".find_box10_false").eq(1).html("图形验证码不可为空的额!");
          $(".imgCode").css("border","1px solid #cf1a1a");
         yzmCode();
    }
   $.ajax({
      type: "post",
    dataType: "json",
      url: "<?php echo U('Tourist/send_code1');?>",
     data: { "tel_phone":$(".tel_phone").val() , "imgCode":$(".imgCode").val() , "telCode":$(".telCode").val() },
     success: function( data ){
          if( data.status == 2000 ){
             alert(data.message);
             timess = 120;
             times = self.setInterval("daojishi()",1000);
             return false;
          }else if( data.status = -2000 ){
             console.log(data.message+"34434");
             if(data.message=="手机号不存在!"){
                $(".find_box10_false").eq(0).html(data.message);
                 $(".tel_phone").css("border","1px solid #cf1a1a");
             }
             else if(data.message="图形验证码错误!"){
             	$(".find_box10_false").eq(1).html(data.message);
                $(".imgCode").css("border","1px solid #cf1a1a");
             }
         
             yzmCode();
          }
     }
   });
}
var timess;
function daojishi(){
  $(".telCode1").html('<a href="javascript:void(0);" style="color:#FFFFFF;">剩余('+timess+')秒</a>');
  timess--;
  if( timess < 0 ){
    clearInterval(times);
    times=0;
    $(".telCode1").html('<a href="javascript:void(0);"  style="color:#FFFFFF;" onclick="time_down();">获取验证码</a>');
  }
}

$(".header_bottom1_middle li").eq(0).removeClass("header_dj");
</script>
<?php echo W('Common/footer');?>