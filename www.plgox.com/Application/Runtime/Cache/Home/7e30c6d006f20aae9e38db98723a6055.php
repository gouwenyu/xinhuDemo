<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
		<META HTTP-EQUIV="expires" CONTENT="0">
		<link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css">
		<link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/Public/Home/css/header.css">
		<link rel="stylesheet" type="text/css" href="/Public/Home/css/zhezhao.css">
		<link rel="stylesheet" type="text/css" href="/Public/Home/css/cityPicker.css">
		<script src="/Public/Home/js/jquery.js"></script>
		<script src="/Public/Home/js/jquery.min.js"></script>
		<script src="/Public/Home/js/animate1.js"></script>	
		<script src="/Public/Home/js/jquery.form.js"></script>
		<script src="/Public/Home/js/cityData.js"></script>
		<script src="/Public/Home/js/cityPicker.js"></script>
   		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=C3nPIg4cyXgnwGV5IunKGqz02QwYINo2"></script>

	</head>
<style type="text/css">
</style>
<body>
  <div class="header_box header_box_empty">
	<div class="header_top">
		<div class="header_topz">
		  <div class="header_topz1">
		  	
		  	<a class="header_left_img" href="<?php echo U('Index/index');?>"><img   class="tsdlg" style="width:130px;height:44px;" src="/Public/Home/image/new_index1.png" /></a>
		  	<div class="header_left_wz">
			<span class="header_topz0" style="margin-left:26px;color:#1166CC;font-size:16px;"><?php echo ($_SESSION['city']); ?></span>
			<!-- <a class="header_topz01 bhqd" href="<?php echo U('Cart/qiehuan_city');?>">[切换城市]</a> -->
			<a class="header_topz01" id="cityChoice" href="javascript:void(0);">
				<img  src="/Public/Home/image/help_center2.png" style="width:12.6px;height:7.2px;"/>
			</a>
			
			</div>
			<div id="allmap" style="display:none;"></div>
			<script type="text/javascript">
			// 百度地图API功能
			    var map = new BMap.Map("allmap");
			    var point = new BMap.Point(116.331398,39.897445);
			    map.centerAndZoom(point,12);
			    var myCity = new BMap.LocalCity();
			    var ccity = $(".header_topz0").text();
			    //获取当前城市
			    if(!ccity){
			        myCity.get(myFun);
			        function myFun(result){            
			            var cityName = result.name;
			            map.setCenter(cityName);
			            $(".header_topz0").text(cityName);
			            fasong(cityName);
			        }
			    }
			    // 插件
		        var cityPicker = new IIInsomniaCityPicker({
			        data: cityData,
			        target: '#cityChoice',
			        valType: 'k-v',
			        hideCityInput: '#city',
			        hideProvinceInput: '#province',
			        callback: function(city_name){
			            fasong(city_name);
			        }
			    });
			    cityPicker.init();
			    // 发送数据给后台做储存
			    function fasong(city_name){
			    	// 获取当前经纬度
			    	var geolocation = new BMap.Geolocation();
			    	//  获取当前经纬度位置
			    	geolocation.getCurrentPosition(function(r){
			    		if(this.getStatus() == BMAP_STATUS_SUCCESS){
			    			var mk = new BMap.Marker(r.point);
							map.addOverlay(mk);
							map.panTo(r.point);
							var jingdu = r.point.lng;
                			var weidu = r.point.lat;
			                 $.ajax({
			                    type:'post',
			                    dataType:'json',
			                    url:'<?php echo U("Index/weizhi");?>',
			                    data:{'name':city_name,'jingdu':jingdu,'weidu':weidu},
			                    success:function(data){
			                        if(data.sta==1){
			                            //刷新当前页面
			                            window.location.reload();
			                        }else{
			                           alert(data.msg);
			                           window.location.reload();
			                           return false;
			                        }
			                    }
			                });
			    		}
			    	});
			    }
			</script>
		 </div>
		</div>
		<div class="header_topy" >
			
			<ul class="header_bottom1_middle">
				<li ><a class="bhqd" href="<?php echo U('Index/index');?>">首页</a></li>
				<li class=""><a class="bhqd" href="<?php echo U('Zulin/shaixuan');?>">共享租售</a></li> <!--<?php echo U('Zulin/zulin');?>-->
				<!-- <li><a class="bhqd" href="<?php echo U('Esxz/index');?>">掘值二手</a></li> -->
				<?php if(($loguser["plgox_id"]) == ""): ?><li><a href="<?php echo U('User/my_dingdan');?>" target="_blank" class="bhqd">用户中心</a></li>
				<?php else: ?>
					<li><a href="<?php echo U('User/my_dingdan');?>" class="bhqd">用户中心</a></li><?php endif; ?>
				<?php if(($loguser['plgox_id'] == '' )): ?><li style="display: none"><a href="<?php echo U('Tourist/login');?>" class="bhqd">商家中心</a></li>
			    <?php elseif(($sjrz_renzheng['plgox_usertype'] == 4 )): ?>
			       <li  style="display: none"><a href="<?php echo U('Homeuser/dingdan_guanli');?>" class="bhqd">商家中心</a></li>
			    <?php else: ?>
			       <li  style="display: none"><a href="#" class="sjzx_rz bhqd">商家中心</a><?php endif; ?>
				<?php if(($loguser["plgox_id"]) == ""): ?><li><a href="<?php echo U('Cart/gouwu_che');?>" class="bhqd" target="_blank">租赁车</a></li>
				<?php else: ?>
					<li><a href="<?php echo U('Cart/gouwu_che');?>" class="bhqd">租赁车</a><span class="gwc_kz"><?php echo ($cart); ?></span></li><?php endif; ?>

				<?php if(($loguser["plgox_id"]) == ""): ?><li><a href="<?php echo U('Cart/gouwu_cart');?>" class="bhqd" target="_blank">购物车</a></li>
				<?php else: ?>
					<li><a href="<?php echo U('Cart/gouwu_cart');?>" class="bhqd">购物车</a><span class="gwc_kz"><?php echo ($shop_cart); ?></span></li><?php endif; ?>

				<?php if(($loguser["plgox_id"]) == ""): ?><li><a href="<?php echo U('User/my_zhangdan');?>" class="bhqd" target="_blank" >我的账单</a></li>
				<?php else: ?>
					<li><a href="<?php echo U('User/my_zhangdan');?>" class="bhqd">我的账单</a></li><?php endif; ?>
			</ul>
			<div class="header_bottom1_right">
				<?php if(($loguser["plgox_id"]) == ""): ?><a class="sbdjh bhqd mfzc" style="height:70px;
	                line-height:85px;" href="<?php echo U('Tourist/register');?>">
	                     免费注册
	                </a>
	                <a class="sbdjh bhqd mfdl"  style="margin-left:40px;height:70px;
	                line-height:85px;" href="<?php echo U('Tourist/login');?>">
	                       登录
	                </a><?php endif; ?>
				<?php if(($loguser["plgox_id"]) != ""): ?><a class="header_topz02 bhqd">您好，<?php echo ($loguser["plgox_user"]); ?>！</a>
	             <div class="loginout sbdjh">退出</div><?php endif; ?>
			</div>
		</div>
		
		<div class="tjdxdk" style="margin-top:-80px;width:120px;height:15px;" class=""><img style="width:120px;height:15px;" src="/Public/Home/image/zheng.png" /></div> 
	</div>
</div>
 
<div class="zhezhao1" style="display:none;">
<!--弹框-->	
<div class="zz_nr_fbcg_tc" >
	  <div class="zdsc">
您已成功举报，您已成功举报，
	  </div>
	   
	  <div class="zz_gbtk" >
			<span class="qrzym" style="display:none;">去认证</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="qgbym">关闭</span>
	  </div> 
	</div>	
	


</div> 
<script src="/Public/Home/js/syrztk.js"></script>
<script type="text/javascript">
$(".header_topz02").mouseover(function(){
	$(".loginout").css("display","inline-block");
})
$(".header_topz02").mouseout(function(){
	$(".loginout").css("display","none");
})
$(".loginout").mouseover(function(){
	$(".loginout").css("display","inline-block");
})
$(".loginout").mouseout(function(){
	$(".loginout").css("display","none");
})
$(".loginout").click(function(){
		$.ajax({
				type: "post",
			dataType: "JSON",
				url: "<?php echo U('Tourist/loginout');?>",
			  success: function( data ){
			  		if( data.status == 200 ){
			  			tyxs1(data.message);
			  			
			  		}else{
			  			tyxs1("退出成功");
			  		}
			  }
		});
	});
function tyxs1(message){
	     $(".zhezhao1").css("display","block");
		 $(".zz_nr_fbcg_tc").css("display","block");
		 $(".zdsc").text(message);	 
		 
         
         djxs1();
}
 function djxs1(){
 	       $(".qgbym").attr("class","cxnt");
	   $(".cxnt").click(function(){
		 $(".zhezhao1").css("display","none");
  	     $(".zz_nr_fbcg_tc").css("display","none"); 
  	      location.href="<?php echo U('Tourist/login');?>";
	});

} 
   
   //企业认证
   qyrenzhe("<?php echo ($is_sjrz); ?>");


$(window).resize(function() {
   var kd=$(window).width();
   if(kd<1230){
      $(".header_top").css("margin","auto auto auto 30px");
   }
   else{
   	  $(".header_top").css("margin","0 auto");
   }
   //var kd=1500;
			  
});


</script>