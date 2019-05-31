<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header');?>
<!--<?php echo W('Common/header3');?>-->
<link rel="stylesheet" type="text/css" href="/Public/Home/css/Home-login.css">
<div class="login">
  <div class="login_box">
  	<div class="login_box1">
  	  <div class="login_box10">
  	    登录
      </div> 
      <div class="login_box11" style="margin-top:20px;margin-bottom:5px;">
      </div> 
      <form >
      	<input type="text"  class="login_box21" name="username" placeholder="请输入用户名/手机号"/>
      	<input style="margin-top:15px;" type="password" class="login_box21"  placeholder = "请输入用户密码"/>
      	<label class="login_box51">
      		<div class="login_box53"><input type="checkbox"/></div>
      		<div class="login_box53" style="margin-top:3px;">&nbsp;&nbsp;记住密码</div>
      	</label>
          <span  class="login_box31"><a href="<?php echo U('Tourist/findpass');?>">忘记密码 ?</a></span >
      	<input type="submit" value="登录"  class="login_box61" style="margin-top:32px;"/>
      	<a class="login_box62" href="<?php echo U('Tourist/register');?>">立即注册</a >
      </form>
    </div> 
  </div> 
</div>
<script type="text/javascript">
	$(".login_box21").each(function(index){
		$(this).focus(function(){
			$(this).val(null);
		});
	});
   $('.login_box61').on('click', function() {
        $("form").on("submit",function(){
            if( $(".login_box21").eq(0).val() ==  "" && $(".login_box21").eq(1).val() == "" ){
                $(".login_box11").html("帐号密码不能够为空");
                return false;
            }else{
              $(this).ajaxSubmit({
                  type: "POST",
                  dataType: "JSON",
                  url: "<?php echo U('Tourist/dologin');?>",
                  data: { username:$(".login_box21").eq(0).val() , password:$(".login_box21").eq(1).val() },
                  success: function( data ){
                      if( data.status == 200 ){
                         $(".login_box11").html(data.message);
                         window.location.href="<?php echo U('Index/index');?>";
                         return false;
                      }else if( data.status == 201 ){
                         $(".login_box11").html(data.message);
                         return false;
                      }
                  }
              }); 
              return false;
            }
        });
    });

   $(".header_bottom1_middle li").eq(0).removeClass("header_dj");
 $(".mfdl").css("border-bottom","3px solid #1f61c3");
</script>
<?php echo W('Common/footer');?>