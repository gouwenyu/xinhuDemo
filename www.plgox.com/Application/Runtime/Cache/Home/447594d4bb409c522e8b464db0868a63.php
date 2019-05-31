<?php if (!defined('THINK_PATH')) exit();?>	<link rel="stylesheet" type="text/css" href="/Public/Home/css/zhezhao.css">
<style type="text/css">
  .header_box1{
  	height:80px;
  }
</style>
 <div class="header_box1" >
		<div class="header_middle">
				 <div class="" style="float:left;line-height:60px;">
			    	魄力餐厨&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;北京租赁&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<span style="color:#a5abb2;"><?php echo ($class_ify['juezhi_brand_name']); ?>
			    	
			    	</span>
			    </div> 
			<?php if(strpos($_SERVER['REQUEST_URI'],"index")!== false){ echo '
			<div class="header_middle_center" style="margin-left:470px;">
				<input type="text" class="header_middle_center_bd" placeholder=" 请输入商品关键字" style="border:1px solid #F35225;"/>
				<div class="header_middle_center_cz1">
					<img src="/Public/Home/image/esxz1.png" />
				</div>
			</div>'; } ?>
	        
            <?php if(($loguser['plgox_id'] == '' )): ?><div  class="header_middle_right1" style="height:42px;line-height:42px;margin-top:10px;">
					<span onclick="javascript:window.location.href='<?php echo U('Tourist/login');?>'" style="display:inline-block;color:#d16142;width:100%;height:100%;" class="free_push_message">免费发布信息</span>
		          </div>
			    <?php elseif(($sjrz_renzheng['plgox_usertype'] == 4 )): ?>
			     <div  class="header_middle_right1" style="height:42px;line-height:42px;margin-top:10px;">
					<span onclick="javascript:window.location.href='<?php echo U('Homeuser/esxz_choose_fl');?>'" style="display:inline-block;color:#d16142;width:100%;height:100%;" class="free_push_message">免费发布信息</span>
		          </div>
			    <?php else: ?>
			      <div class="header_middle_right1" style="height:42px;line-height:42px;margin-top:10px;">
					<span onclick="javascript:window.location.href='<?php echo U('Homeuser/esxz_choose_fl');?>'"  style="display:inline-block;color:#d16142;width:100%;height:100%;" class="free_push_message">免费发布信息</span>
		    	  </div><?php endif; ?>

		</div>
	</div>

<script type="text/javascript">

   esqyrz("<?php echo ($is_sjrz); ?>");


function tyxs(message){
	     $(".zhezhao_sy").css("display","block");
		 $(".zz_nr_fbcg11").css("display","block");
		 $(".zdsc_20").text(message);
		 
		 
	    var dsq=setInterval(function(){
                $(".zhezhao_sy").css("display","none");
			    $(".zz_nr_fbcg11").css("display","none");
			     location.href="<?php echo U('Tourist/login');?>";
		  
         },3000);
         
         
         djxs();
}
 function djxs(){
	     $(".zhezhao_sy").click(function(){
		 $(".zhezhao_sy").css("display","none");
  	     $(".zz_nr_fbcg11").css("display","none"); 
  	      location.href="<?php echo U('Tourist/login');?>";
	})
}
 
 

</script>