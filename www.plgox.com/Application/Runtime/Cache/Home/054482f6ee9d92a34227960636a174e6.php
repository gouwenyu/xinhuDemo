<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/header');?>

<link rel="stylesheet" type="text/css" href="/Public/Home/css/my_top.css">
<div class="my_topzd">
  <div class="my_top_box">
    <div class="my_t1">
      所在位置：    首页  > 用户中心 > <span class="my_tbxd">我的订单</span>
     </div>
</div>
</div>
<div style="height:685px;">
	<div style="width:1192px;margin:0 auto;">
     <div class="my_t2">
         <div class="my_t3">用户中心</div> 
         <ul class="my_t5">
           <li><a href="<?php echo U('User/my_dingdan');?>">租赁订单</a></li>
           <li><a href="<?php echo U('User/my_mm_dingdan');?>">买卖订单</a></li>
           <li><a href="<?php echo U('User/my_zhangdan');?>">我的账单</a></li>
<!--   <li><a href="<?php echo U('User/my_xinyun');?>">我的信用</a></li>-->
           <li><a href="<?php echo U('User/my_qyrz');?>">企业认证</a></li>
           <li><a href="<?php echo U('User/my_shdz');?>">收货地址</a></li>
           <li><a href="<?php echo U('User/my_jbzl');?>">基本资料</a></li>
           <li >
		  	     <a  href="#" class="hdmk">
		  	     </a>
		        </li>
         </ul>   
     </div>
    </div> 
  </div>
  <?php echo W('Common/header1_search');?> 
<script type="text/javascript">

 $(".my_t5 li a").each(function(index){
		$(this).mouseover(function(){
			var pxs=index*50+"px";
			$(".hdmk").stop().animate({top:pxs},'fast');
		});
	
	});
 $(".my_t5").mouseover(function(){
 	 $(".hdmk").css("display","block");
 });
  $(".my_t5").mouseout(function(){
 	 $(".hdmk").css("display","none");
 });

$(".header_bottom1_middle li").eq(2).siblings().removeClass("header_dj");
 $(".header_bottom1_middle li").eq(2).addClass("header_dj");

 
</script>
<title><?php echo ($setTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/my_qyrz.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/css/sj_center.css">
<style type="text/css">

</style>

<div class="mypj">
   <div class="mypj1">
      <div  class="mypj2" style="padding-bottom:35px;">
	      <div class="mypj6">
	                 企业认证
	      </div>   

         <!--  <div class="qyrz_tp">
          	<img src="/Public/Home/image/635627361043790595.jpg" />
          </div>
 -->
          <div class="myqyrz">
          		<?php if(($renzheng['renzheng_status'] == 1) OR ($renzheng['renzheng_status'] == 2)): ?>企业认证中<a href="javascript:void(0);" class="ljsq qyrz_div_css">立即申请</a>
          		<?php elseif(($renzheng['renzheng_status'] == 3)): ?>
          			 您已通过企业认证<!-- <a href="<?php echo U('User/my_qyrz_sy',array('renzheng_edit_id'=>$renzheng['renzheng_id']));?>" class="ljsq">修改资料</a> -->
	            <?php elseif(($renzheng['renzheng_status'] == 4)): ?>
	                 认证失败,请重新认证<a href="<?php echo U('User/my_qyrz_sy',array('renzheng_id'=>$renzheng['renzheng_id']));?>" class="ljsq">修改认证</a>
	            <?php else: ?>
	            	 您还未申请企业认证<a href="<?php echo U('User/my_qyrz_sy');?>" class="ljsq">立即申请</a><?php endif; ?>
	      </div> 
	      <div class="myqyrz1">
	                 申请进度
	      </div>   
          <ul class="myqyrz2">
          	<?php if(($renzheng['renzheng_status'] == 1) OR ($renzheng['renzheng_status'] == 2) OR ($renzheng['renzheng_status'] == 3) OR ($renzheng['renzheng_status'] == 4)): ?><li>
		         	<div class="myqyrz21">
		         		<div class="myqyrz210">
		         		</div>
		         		<div class="myqyrz211">
							√
		         		</div>         		
		         	</div>
		         	<div class="myqyrz22">
		         			提交已受理
		         	</div>  
		        </li>
          	<?php else: ?>
	          	<li>
		         	<div class="myqyrz21">
		         		<div class="myqyrz210" style="background-color:#EEEEEE;">
		         		</div>
		         		<div class="myqyrz211" style="background-color:#EEEEEE;">
		         		
		         		</div>         		
		         	</div>
		         	<div class="myqyrz22">
		         			提交已受理
		         	</div> 
		         </li><?php endif; ?>
          	<?php if(($renzheng['renzheng_status'] == 2) OR ($renzheng['renzheng_status'] == 3) OR ($renzheng['renzheng_status'] == 4)): ?><li>
		         	<div class="myqyrz21">
		         		<div class="myqyrz210">
		         		</div>
		         		<div class="myqyrz211">
		         			√
		         		</div>         		
		         	</div>
		         	<div class="myqyrz22">
		         			审核中
		         	</div>
		         </li>
          	<?php else: ?>
          		<li>
          			<div class="myqyrz21">
          				<div class="myqyrz210" style="background-color:#EEEEEE;">
		         		</div>
		         		<div class="myqyrz211" style="background-color:#EEEEEE;">
		         			
		         		</div>
		         		<div class="myqyrz22">
		         			审核中
		         		</div> 
          			</div>
          		</li><?php endif; ?>
          	<?php if(($renzheng['renzheng_status'] == 3)): ?><li>
		         	<div class="myqyrz21">
		         		<div class="myqyrz210">
		         		</div>
		         		<div class="myqyrz211">
		         			√
		         		</div>         		
		         	</div>
		         	<div class="myqyrz22">
		         			通过认证
		         	</div>  
		        </li>
          	<?php elseif(($renzheng['renzheng_status'] == 4)): ?>
		        <li>
		         	<div class="myqyrz21">
		         		<div class="myqyrz210">
		         		</div>
		         		<div class="myqyrz211">
		         			√
		         		</div>         		
		         	</div>
		         	<div class="myqyrz22">
		         			认证未通过
		         	</div>  
		        </li>
		   	<?php else: ?>
			   	<li>
		         	<div class="myqyrz21">
		         		<div class="myqyrz210" style="background-color:#EEEEEE;">
		         		</div>
		         		<div class="myqyrz211" style="background-color:#EEEEEE;">
		         			
		         		</div>         		
		         	</div>
		         	<div class="myqyrz22">
		         			通过认证
		         	</div> 
		         </li><?php endif; ?>
	      </ul> 
	      
	      <div class="myqyrz3">
	      	什么是企业认证？
	      </div>
	      <div class="myqyrz5">
	         	<p>魄力餐厨网站是定位于B2B（企业与企业）平台的商业模式，网站用全新的经营理念，致力于帮助客户企业极大的节省投入成本、降低前期投资、运营风险。</p>	
	         	<p class="myqyrz6000">基于此商业模式，共享租赁中租赁方和承租方都必须是企业用户，如果您想发布或承租设备，请先进行企业认证，以保证平台用户的专业性、真实性。企业认证必须为真实有效的信息，否则将不可享受租赁服务或成为租赁商，企业认证资料填写越详细，魄力餐厨网站才能更精确为您提供专属服务，匹配相对应的优质商品。</p>	
	      </div>  
	      
	      <br/><br/>

           <div class="sjzx1">
		
      <div class="sjzx6">
      	 <div class="sjzx61">
      	 	更多租赁商权益保证
      	 </div>
      	 <div class="sjzx62"> 	
      	 </div>
      </div>
		
	  <div class="sjzx10">
	  	入驻魄力餐厨平台，获取行内关注，标准化流程管理
	  </div>	
		
		
	  <ul class="sjzx11">
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center1.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		免费入驻，押金第一时间返还商家，平台不扣任何费用。
	  	  </div>
	  	</li>
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center2.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		在线交易，统一管理，流程标准透明，使用方便。
	  	  </div>
	  	</li>
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center3.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		专业的厨电行业租赁平台，定位明确，打造圈内市场经济。
	  	  </div>
	  	</li>
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center4.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		承租方均为企业用户，芝麻信用担保，最大程度避免无理纠纷。
	  	  </div>
	  	</li>
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center5.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		独特的后付押金制度，未来信誉趋势走向的引领者。
	  	  </div>
	  	</li>
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center6.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		按天计算租金制，每月定期出账单，每天都可提款，账目清晰。
	  	  </div>
	  	</li>
	  	<li>
	  	  <div class="sjzx110">
	  	  	<img src="/Public/Home/image/sc_center7.png" />
	  	  <div>
	  	  <div class="sjzx111">
	  	  		专属的客服对接人员，一切纠纷平台出面解决，保护租赁商利益。
	  	  </div>
	  	</li>
	  </ul>
	  	
	  	
		
	</div>




     </div>
   </div>
 </div>

<!--遮罩-->
<div class="zhezhao" style="display:none;">
	<div class="zz_nr" >
	  <div class="zz_nr1">
		<span class="wxts">温馨提示<span>
		<span class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:146px;height:146px;display:block;">
		您已提交申请，系统正正在审核中，请耐心等待。		
	  </div>
	 
	  <div class="zz_nr3" >
			<a href="#wss" class="tyjs0">确认</a>
			<a href="#wss" class="tyjs">取消</a>	
	  </div>  
	</div>		
	

	
	
</div>
 
<script type="text/javascript" src="/Public/Home/js/my_top.js"></script>
<script type="text/javascript">
 my_top(3,"100px","企业认证");
   
    $(".wodegb").html("企业认证");   
    //如果已经申请则会有该弹框
    $(".qyrz_div_css").click(function(){
		$(".zhezhao").css("display","block");
	});
    $(".tyjs0").click(function(){
		$(".zhezhao").css("display","none");
	});
	$(".tyjs").click(function(){
		$(".zhezhao").css("display","none");
	});
	$(".scqr").click(function(){
		$(".zhezhao").css("display","none");
	});
</script>
<?php echo W('Common/footer');?>
</body>
</html>