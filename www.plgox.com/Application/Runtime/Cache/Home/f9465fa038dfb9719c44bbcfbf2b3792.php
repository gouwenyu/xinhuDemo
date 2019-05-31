<?php if (!defined('THINK_PATH')) exit();?>
﻿<?php echo W('Common/header');?>

<link rel="stylesheet" type="text/css" href="/Public/Home/css/help_top.css">

<div class="my_topzd">
	<br/>
  <div class="my_top_box">
     <div class="my_t1">
      所在位置：    首页  ><span class="my_tbxd">帮助中心</span>
     </div>
</div>
</div>
  <?php echo W('Common/header1_search');?> 
<style>
	
	
</style>
 <link rel="stylesheet" type="text/css" href="/Public/Home/css/help_shfw.css"> 
  
<div class="mypj">
   <div class="mypj1">

     <div class="mypj1_box">

	   	<div class="my_t2">
            <div class="my_t3">帮助中心</div> 
	          <ul class="my_t5">
	          	
	          	<li><a href="#" class="help_topjt">关于我们</a></li>
	           <li><a href="<?php echo U('Help/GongSiGaiKuang');?>" class="help_wm">公司概况</a></li>
	           <li><a href="<?php echo U('Help/ShangWuHeZuo');?>" class="help_wm">商务合作</a></li>
	           <li><a href="<?php echo U('Help/JiaRuWoMen');?>" class="help_wm">加入我们</a></li>
	           <li><a href="<?php echo U('Help/LianXiWoMen');?>" class="help_wm">联系我们</a></li>
	          	
	          	
	           <li><a href="#" class="help_topjt">租户说明</a></li>
	           <li><a href="<?php echo U('Help/ZuLinLiuCheng');?>" class="help_zl">租机流程</a></li>
	           <li><a href="<?php echo U('Help/ZuJinZhiFu');?>" class="help_zl">租金支付</a></li>
	           
	           <li><a href="<?php echo U('Help/ZuLinXieYi');?>" class="help_zl">承租商协议</a></li>
	           
	           <li><a href="<?php echo U('Help/TuiHuanShuoMing');?>" class="help_zl">退还说明</a></li>
	           <li><a href="<?php echo U('Help/FuWuShiJian');?>" class="help_zl">服务时间</a></li>
	           
	           
	           <li><a href="#23" class="help_topjt">租赁商说明</a></li>
	           
	           
	           <li><a href="<?php echo U('Help/RuZhuTiaoJian');?>" class="help_sm">入驻条件</a></li>
	           <li><a href="<?php echo U('Help/RuZhuLiuCheng');?>" class="help_sm">入驻流程</a></li>
	           <li><a href="<?php echo U('Help/RuZhuXieYi');?>" class="hkhd help_sm">租赁商协议</a></li>
	           
	           
	           
	           <li><a href="#23" class="help_topjt">售后服务</a></li>
	           <li><a href="<?php echo U('Help/QianShouZhuYi');?>" class="help_sh">签收注意事项</a></li>
	           <li><a href="<?php echo U('Help/TuiJiLiuCheng');?>" class="help_sh">退机流程</a></li>
	           <li><a href="<?php echo U('Help/ShouHouFuWu');?>" class="hkhd help_sh">售后服务</a></li>
	           <li><a href="<?php echo U('Help/WeiYueChuLi');?>" class="help_sh">违约处理</a></li>
	           <li><a href="<?php echo U('Help/GuZhangBaoXiu');?>" class="help_sh">故障报修</a></li>
	           <li><a href="#22112" class="help_topjt">常见问题</a></li>
	           <li><a href="<?php echo U('Help/SheBeiGuZhang');?>" class="help_wt">设备故障怎么办</a></li>
	           <li><a href="<?php echo U('Help/MianQianZhunBei');?>" class="help_wt">面签准备什么</a></li>
	           <li><a href="<?php echo U('Help/SheBeiDiuShi');?>" class="help_wt">设备丢失和损坏</a></li>
	           <li>
			  	    <a  href="#" class="hdmk">
			  	    </a>
			   </li>
	         </ul>
	      </div>

   	      
   	      
   	      <div  class="mypj2">
		      <div class="mypj6">
		                  服务时间
		      </div>
          <div class="zjlc_box">       
             <div class="zjlc">
	              	<span></span>
	              	<span>服务时间为5个工作日8小时工作制，时间工作日为9：00-18：00；</span>
	         </div>
	         <div class="zjlc">
	              	<span></span>
	              	<span>在工作日内16:00点后提交的订单，从次日开始配送；</span>
	         </div>
              <div class="zjlc">
	              	<span></span>
	              	<span>休息日提交的订单，在下一个工作日时处理。</span>
	          </div>
         </div>
      </div>
   	
   	
   	
   	
     </div>
   	   
   </div>
 </div>
 <script type="text/javascript" src="/Public/Home/js/hkhd.js"></script>
<script type="text/javascript">
var arra1=new Array(".help_sh",".help_wt",".help_sm",".help_wm");
var arra2=new Array(0,2,3,4);
gbys(arra1,arra2,'300px',10);

</script>
</br>
<?php echo W('Common/footer');?>
</body>
</html>