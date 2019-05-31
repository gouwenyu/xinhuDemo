<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        background-position: center;
        background-size: cover;
    }
  .current{
    background-color:#F35224 !important; 
    border:1px solid #F35224 !important;
    color:#FFFFFF;padding:8px 12px 8px 12px;
  }
</style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="toTop" content="true">
    <link href="/Public/home/css/base.css" rel="stylesheet" type="text/css" />

        </if>    <!-------------bootstrap框架↓------------------->
   <!-- <link href="/Public/home/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/Public/home/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />-->
    <!-------------本页面CSS↓------------------->
     <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_index.css"> 
     <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css"> 
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css">
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_index.css" />
    <!-------------bootstrap框架↓------------------->
    <script type="text/javascript" src="/Public/home/js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="/Public/home/js/jquery.tabslet.min.js"></script>
    <script type="text/javascript" src="/Public/home/bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/home/js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="/Public/home/js/cityData.js"></script>
    <script type="text/javascript" src="/Public/home/js/cityPicker.js"></script>
    <script type="text/javascript" src="/Public/home/js/index.js"></script>
    <title><?php echo ($pagetitle); ?></title>
</head>

<div class="body">
    <div class="shangcheng-list" style="background-color:white;padding: 0px 20px">
        <if condition="empty($list)">
            <!--搜索不存在~~~-->
       <!--  <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list): $mod = ($i % 2 );++$i;?><div class="es_sy21_1">
          <a href="<?php echo U('Esxz/esxz_detil',array('id'=>$goods_list['goods_id']));?>" target="_blank">
  	  			<div class="es_sy21_le"  >
  	  				<img src="/Uploads/admin/<?php echo ($goods_list['goods_first_pic']); ?>" class="esxz_sy21_img" />
  	  			</div>
  	  	  </a>	
  	  			<div class="es_sy21_mi">
  	  				<div class="es_sy21_mi1"><?php echo ($goods_list["goods_name"]); ?>
  	  				<?php if($goods_list['goods_is_business'] == 1): ?><span >企</span><?php endif; ?>	
  	  				</div>
  	  				<div class="es_sy21_mi2">
  	  				<?php echo ($goods_list["goods_description"]); ?>
  	  				</div>
  	  				<div class="es_sy21_mi3">
  	  					<?php echo ($goods_list["goods_province"]); ?>&nbsp;&nbsp;<?php echo ($goods_list["goods_city"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($goods_list["goods_publish_time"]); ?>
  	  				</div>
  	  			</div>
  	  			<div class="es_sy21_ri">
  	  				￥<?php echo ($goods_list["goods_deal_price"]); ?>
  	  			</div>
  	  		</div><?php endforeach; endif; else: echo "" ;endif; ?> -->



 <ul class="zulin8" >
   <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list): $mod = ($i % 2 );++$i;?><li class="zulin81" >
       <a href="<?php echo U('Esxz/esxz_detil',array('id'=>$goods_list['goods_id']));?>" target="_top">
        <div  class="zulin82">
         <img src="/Uploads/admin/<?php echo ($goods_list['goods_first_pic']); ?>" class="esxz_sy21_img" />
        </div>
         </a>
        <div  class="zulin83">
          <div class="zulin831"><?php echo ($goods_list["goods_name"]); ?></div>
          <?php if($goods_list['goods_is_business'] == 1): ?><span class="zulin852">企</span><?php endif; ?> 
        </div>
        <div  class="zulin85">
          <span class="zulin851">￥<?php echo ($goods_list["goods_deal_price"]); ?></span>
        </div>
        
        <div class="in_center1228">
                <div class="in_center12281">
                  <span class="incenter_12_hs"><?php echo ($goods_list["goods_province"]); ?>&nbsp;&nbsp;<?php echo ($goods_list["goods_city"]); ?></span>
                 <!--  <span class="incenter_12_zs"><?php echo ($share_['share_satisfaction']); ?>%</span> -->
                </div>
                <div class="in_center12282">
                  <span class="incenter_12_hs"><?php echo ($goods_list["goods_publish_time"]); ?></span>
                  <!-- <span class="incenter_12_zs"><?php echo ($share_['share_chuzhu']); ?>次</span> -->
                </div>
                </div>
        
        
       
      <li><?php endforeach; endif; else: echo "" ;endif; ?> 
    </ul> 




    </div>
    <div class="es_sy216">
  	  			<div class="message">
                 <?php echo ($show); ?>
                 </div>
  	  		</div>
</div>