<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header');?>
<title><?php echo ($share['share_name']); ?></title>
 <link rel="stylesheet" type="text/css" href="/Public/Home/css/shop_detil.css"> 
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/css.css"> 
<SCRIPT src="/Public/Home/js/jquery-1.2.6.pack.js" type='text/javascript'></SCRIPT>
<SCRIPT src="/Public/Home/js/base.js" type='text/javascript'></SCRIPT>
<style type="text/css">
.shop_d521:hover{
	background-color:#F0C4BE;
}
</style>
<div class="shop_detil_box">

<div class="shop_d1">	
 <div id='preview'>
	<div class='jqzoom' id='spec-n1'>
	<IMG id="bhtp"
	src="/Uploads/admin/<?php echo ($share_many_img['0']); ?>" jqimg="/Uploads/admin/<?php echo ($share_many_img['0']); ?>">
  </div>
</div>

<SCRIPT type=text/javascript>
	$(function(){			
	   $(".jqzoom").jqueryzoom({
			xzoom:382,
			yzoom:382,
			offset:20,
			position:"right",
			preload:1,
			lens:1
		});
						
	})
</SCRIPT>
<SCRIPT src="/Public/Home/js/lib.js" type=text/javascript></SCRIPT>
<SCRIPT src="/Public/Home/js/zzsc.js" type=text/javascript></SCRIPT> 
   <div class="shop_d11">
   	  <div class="shop_d110 share_keys"><?php echo ($share['share_name']); ?></div>
   	  <div class="shop_d111"><?php echo ($share['share_key']); ?></div>
   	  
   	  <div class="shop_d112_bj">
   	  	<div class="shop_top_s">
	   	  	<div class="shop_d1120_bj">
	   	  		<span class="shop_d1150">日&nbsp;租&nbsp;金&nbsp;：</span>
	   	  		<span class="shop_d11301"></span>
	   	  	</div>
	   	  	<div class="in_center12281" style="margin-top:1px;">
         		<span class="incenter_12_hs">满意度：</span>
         		<span class="incenter_12_zs manyidu"></span>
	        </div>
        </div>
        <div class="shop_top_s">
	   	  	<div class="shop_d1120_bj">
	   	  		<span class="shop_d1150">押&nbsp;&nbsp;&nbsp;&nbsp;金&nbsp;&nbsp;：
	   	  		</span>
	   	  		<span class="shop_yaj"></span>
   	  	    </div>
	   	  	<div class="in_center12281">
	             		<span class="incenter_12_hs">出租量：</span>
	             		<span class="incenter_12_zs chuzulv"></span>
	        </div>
        </div>
   	  </div>

   	 <div class="shop_d112">
   	  	<!-- <div class="shop_d1120">
   	  		<span>市场参考价：</span><span class="shop_scck"></span>
   	  	</div> -->
   	  	<div class="shop_d1120">
   	  		<span>出售价：</span><font style="font-size: 15px;font-weight: bold;">¥ </font><span class="shop_prices" style="font-size: 15px;font-weight: bold;"></span>
   	  	</div>
   	  	<div class="shop_d1121" >
   	  		<span>产地：</span><?php echo ($share['share_chandi']); ?>
   	  	</div>
   	  </div>
   	  
   	  <div class="shop_d112">
   	  	<div class="shop_d1120">
   	  		<span>起租天数：</span>
   	  		<a href="#1" class="shop_d11201 shop_d11201_dj zulin_day_number"></a>
<!--    	  		<a href="#1" class="shop_d11201">7天</a>
   	  		<a href="#1" class="shop_d11201">30天</a> -->
   	  	</div>
   	  </div>
   	  <div class="shop_d2 shop_zmjs" style="display: none">租满<span class="number_day"></span>后，设备将归租赁方所有，日租金将自动停止</div>
   	  
   	  <div class="shop_d112">
   	  	<div class="shop_d1120">
   	  		<span>选&nbsp;&nbsp;&nbsp;&nbsp;择&nbsp;&nbsp;&nbsp;：</span>
   	  		<?php if(is_array($specifications)): $i = 0; $__LIST__ = $specifications;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$specifications_): $mod = ($i % 2 );++$i;?><a href="#1" class="shop_d11202 specifications_id" value="<?php echo ($specifications_['specifications_id']); ?>"><?php echo ($specifications_['specifications_name']); ?></a>
   	  			<!-- <a href="#1" class="shop_d11202">分体炉心</a> --><?php endforeach; endif; else: echo "" ;endif; ?>
   	  	</div>
   	  </div>
   	  
   	   <div class="shop_d112">
   	  	<div class="shop_d1120">
   	  		<span class="gouw_sl">租赁数量：</span>
   	  		<span class="gouw_10">
                  <!-- <span class="gouw_js"></span>
                  <input type="text" class="gouw_xsk" value="1" name="gouw_xsk" />
                  <span class="gouw_zd"></span> -->                
           </span>
           <span class="shop_d1130">库存：
		        <span class="shop_kcgs"></span>
		   </span>
   	  	</div>
   	  </div>
   	  
   	  <div class="shop_d112" >
   	  	<div class="shop_d1120">
   	  		由于<span style="color:#D81E06;"><?php echo ($share_pq); ?></span>发货并提供售后服务预计两日内送达
   	  	</div>
   	  	<div style="clear:both;"></div>
   	  	<div class="shop_d1120" style="margin-top:-2px;">
   	  		服务承诺:免费安装，免费培训和指导
   	  	</div>
   	  </div>
   	  
   	  
   	  
   </div>
 
<div class="shop_d5" style="margin-top:30px;">
	<div class="shop_d51">
		<div class="shop_d51_le_box">
			<div class="shop_d51_le"></div>
		</div>
		<div class="shop_d51_m">
		<ul class="shop_d51_mi">
		<?php if(($share_many_img['0']) != ""): ?><li>
				<a href="#1">
					<img src="/Uploads/admin/<?php echo ($share_many_img['0']); ?>" />
				</a>
			</li><?php endif; ?>
		<?php if(($share_many_img['1']) != ""): ?><li>
				<a href="#1">
					<img src="/Uploads/admin/<?php echo ($share_many_img['1']); ?>" />
				</a>
			</li><?php endif; ?>
		<?php if(($share_many_img['2']) != ""): ?><li>
				<a href="#1">
					<img src="/Uploads/admin/<?php echo ($share_many_img['2']); ?>" />
				</a>
			</li><?php endif; ?>
		<?php if(($share_many_img['3']) != ""): ?><li>
				<a href="#1">
				<?php if(($share_many_img['3']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['3']); ?>" /><?php endif; ?>
				</a>
			</li><?php endif; ?>
		<?php if(($share_many_img['4']) != ""): ?><li>
				<a href="#1">
				<?php if(($share_many_img['4']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['4']); ?>" /><?php endif; ?>
				</a>
			</li><?php endif; ?>
		<?php if(($share_many_img['5']) != ""): ?><li>
				<a href="#1" class="on">
					<img src="/Uploads/admin/<?php echo ($share_many_img['5']); ?>" />
				</a>
			</li><?php endif; ?>
		</ul>
		</div>
		<div class="shop_d51_ri_box">
			<div class="shop_d51_ri">
			
		   </div>
		</div>
	</div>
	<div class="shop_d52">
		<a href="#1" class="shop_d521" onclick="zulin(<?php echo ($share['share_id']); ?>);" style="display: none" shareid="<?php echo ($share['share_id']); ?>">
			立即租赁
		</a>



		<a href="javascript:void(0);" class="shop_d522" value="<?php echo ($share['share_id']); ?>">
			立即租赁
		</a>
		<a href="javascript:void(0);" class="shop_d522_" value="<?php echo ($share['share_id']); ?>">
			立即购买
		</a>
	</div>
  </div>
  
</div>

</div>



<div class="shop_d6">
	<div class="shop_d61">
		<div class="shop_d610">同款商品挑选</div>
		<?php if(is_array($product_lists)): $i = 0; $__LIST__ = $product_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product_lists_): $mod = ($i % 2 );++$i; if(is_array($product_lists_)): $i = 0; $__LIST__ = $product_lists_;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product_lists_is): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Cart/shop_detil',array('id'=>$product_lists_is['share_id']));?>"><div class="shop_d611">
					<div class="shop_d612">
						<img src="/Uploads/admin/<?php echo ($product_lists_is['share_home_img']); ?>" >
					</div>
					<div class="shop_d613"><?php echo ($product_lists_is['share_name']); ?></div>
					<div class="shop_d614">￥<?php echo ($product_lists_is['share_rent']); ?></div>
				</div></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
		
	</div>
	<div class="shop_d62">
	   <div class="shop_d621">
	   	 <div class="shop_d6210 shop_d6210_dj" >商品描述</div>
	   	 <div style="margin-left:10px;" class="shop_d6210">累计评价<?php echo ($pingjia_count); ?></div>
	   	 <div class="shop_d6211">联系客服</div>
	   </div>
	   <div class="shop_d62_spms">
	   
	     
	   	  <ul class="shop_spms1" style="display:none;">
	   	  	<li class="shop_spms11">
	   	  	<?php if(($share['share_name']) != ""): ?><div style="font-size:13px;">产品名称：<font title="<?php echo ($share['share_name']); ?>" class="product_name"><?php echo ($share['share_name']); ?></font></div><?php endif; ?>
	   	  	<?php if(($share['brand_name']) != ""): ?><div style="font-size:13px;">产品品牌：<font title="<?php echo ($share['brand_name']); ?>"><?php echo ($share['brand_name']); ?></font></div><?php endif; ?>
	   	    </li>
	   	    <li class="shop_spms11">
			<?php if(($share['classify_title']) != ""): ?><div style="font-size:13px;">产品分类：<font title="<?php echo ($share['classify_title']); ?>"><?php echo ($share['classify_title']); ?></font></div><?php endif; ?>
			<?php if(($share['share_rent']) != ""): ?><div style="font-size:13px;">参考价格：<font title="<?php echo ($share['share_rent']); ?>元/天"><?php echo ($share['share_rent']); ?></font>元/天</div><?php endif; ?>
	   	    </li>
	   	    <li class="shop_spms11">
			<?php if(($share['share_sheng']) != ""): ?><div style="font-size:13px;">生产产地：<font title="<?php echo (get_field_by_id($share['share_sheng'],'City','city_name','city_id')); ?>/<?php echo (get_field_by_id($share['share_shi'],'City','city_name','city_id')); ?>" class="address"><?php echo (get_field_by_id($share['share_sheng'],"City","city_name","city_id")); ?>/<?php echo (get_field_by_id($share['share_shi'],"City","city_name","city_id")); ?></font></div><?php endif; ?>
			<?php if(($share['share_weight']) != ""): ?><div style="font-size:13px;">产品重量：<font title="<?php echo ($share['share_weight']); ?>"><?php echo ($share['share_weight']); ?></font></div><?php endif; ?>
	   	    </li>
	   	    <li class="shop_spms11">
			<?php if(($share['share_production_date']) != ""): ?><div>生产日期：<font title="<?php echo ($share['share_production_date']); ?>"><?php echo ($share['share_production_date']); ?></font></div><?php endif; ?>
			<?php if(($share['share_caizhi']) != ""): ?><div style="font-size:13px;">产品材质：<font title="<?php echo ($share['share_caizhi']); ?>"><?php echo ($share['share_caizhi']); ?></font></div><?php endif; ?>
	   	    </li>
	   	   
	   	  </ul>
	   	  
	   	  </br>
	   	  <script type="text/javascript">
	   	  		// product_name = $(".product_name").text().length;
	   	  		$(document).ready(function(){
		   	  		var fontsize = 18;
		   	  		if( $(".product_name").text().length > fontsize){
		   	  			$(".product_name").text($(".product_name").text().substring(0,fontsize)+'....');
		   	  			return false;
		   	  		}
		   	  		var fontsize = 8;
		   	  		if( $(".address").text().length > fontsize){
	   	  				$(".address").text($(".address").text().substring(0,fontsize)+'....');
	   	  			}
	   	  		});
	   	  </script>
	   	  
	      <div class="shop_spms2">
	      	<?php echo ($share['share_descriptions']); ?>
	      </div>
	      
	   </div>
	   <?php if(is_array($pingjia_data)): $i = 0; $__LIST__ = $pingjia_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pingjia_data_): $mod = ($i % 2 );++$i;?><div class="shop_d62_ljpj">
	   	  <div class="shop_ljpj1">
	   	  	<div class="shop_ljpj2"><?php echo ($pingjia_data_['plgox_tel']); ?></div>
	   	  	<div class="shop_ljpj3">
	   	  		<div class="shop_ljpj31">
	   	  			<?php echo ($pingjia_data_['pingjia_content']); ?>
	   	  		</div>
	   	  		<ul class="shop_ljpj33">
	   	  			<?php if(( $images[$key]['0'] != null ) OR ( $images[$key]['0'] != '' ) ): ?><li><img src="/Uploads/home_pingjia_img/<?php echo ($images[$key]['0']); ?>" style="width:50px;height:50px;" class="pic_1"></li><?php endif; ?>
					<?php if(( $images[$key]['1'] != null ) OR ( $images[$key]['1'] != '' ) ): ?><li><img src="/Uploads/home_pingjia_img/<?php echo ($images[$key]['1']); ?>" style="width:50px;height:50px;" class="pic_2"></li><?php endif; ?>
					<?php if(( $images[$key]['2'] != null ) OR ( $images[$key]['2'] != '' ) ): ?><li><img src="/Uploads/home_pingjia_img/<?php echo ($images[$key]['2']); ?>" style="width:50px;height:50px;" class="pic_3"></li><?php endif; ?>
					<?php if(( $images[$key]['3'] != null ) OR ( $images[$key]['3'] != '' ) ): ?><li><img src="/Uploads/home_pingjia_img/<?php echo ($images[$key]['3']); ?>" style="width:50px;height:50px;" class="pic_4"></li><?php endif; ?>
					<?php if(( $images[$key]['4'] != null ) OR ( $images[$key]['4'] != '' ) ): ?><li><img src="/Uploads/home_pingjia_img/<?php echo ($images[$key]['4']); ?>" style="width:50px;height:50px;" class="pic_5"></li><?php endif; ?>
	   	  		</ul>
	   	  		<img src="" class="pic_size_" style="width:400px;height:400px;position: relative;bottom:20px;display: none">
	   	  		<div class="shop_ljpj32">
	   	  			<?php echo (date("Y-m-d H:i:s",$pingjia_data_['pingjia_createtime'])); ?>
	   	  		</div>
	   	  	</div>
	   	  </div><?php endforeach; endif; else: echo "" ;endif; ?>
	   </div>
	</div>
	<script type="text/javascript">
		var arr = [1,2,3,4,5,6];
		$.each(arr,function(index){
			if( index != 0 ){
				$('.pic_'+index).click(function(){
					/*if( $(".pic_size_").eq(0).css("display","none") ){
						$(".pic_size_").eq(0).css("display","block");
						$(".pic_size_").attr("src",$(this).attr("src"));
					}else{
						$(".pic_size_").eq(0).css("display","none");
					}*/
				});
			}
		});
	</script>
</div>
  <?php echo W('Common/header1_search');?> 

<!--遮罩-->
<div class="zhezhao"  style="display:none;">
  <!--加入购物车-->
	<div class="zz_nr" style="width:365px;height:270px;display:none;">
	  <div class="shop_63"></div>
	  <div class="shop_65">
	  	<div class="shop_651" attr-status></div>
	  	<div class="shop_652">再逛逛</div>
	  </div>
	</div>
	<!--立即取货-->
	<div class="zz_nr" style="width:365px;height:270px;display:none;">
	  <div class="shop_73">尊敬的用户，由于您是我公司首次租赁用户，在确认后将由我公司工作人员上门与您签署《租赁协议》，是否确认继续操作？</div>
	  <div class="shop_75">
	  	<div class="shop_751">取消</div>
	  	<div class="shop_751" style="margin-left:30px;">确认</div>
	  </div>
	</div>
	
	<div class="zz_nr_fbcg" style="display:none;">
	  <div class="zdsc">
	  	提交成功，商家1-3个工作日内处理
	  </div>
	   
	  <div class="zz_gbtk" >
			关闭
	  </div> 
	</div>
	

</div>

<br/><br/>
 <!--加入购物车-->
<script type="text/javascript">
				$(".shop_d522").click(function(){ // 加入租售车
					var share_id = $(this).attr("value");
			   		$.ajax({
						type: "post",
					dataType: "json",
						 url: "<?php echo U('Cart/renzheng_check');?>",
						 success: function(data){
						 	
						 	if(data==null){
						 			//alert("当前未登录，请登录后进行操作！");
						 			zstk("当前未登录，请登录后进行操作！","");
						 			
						 	}
						 	else if( data['plgox_is_renzheng'] == 0 ){
						 	  $(".zhezhao").css("display","block");
						   	  $(".shop_73").text("亲，因为你是首次注册的用户，需要你完成企业认证之后才可以加入租赁车额!");
						   	  $(".zz_nr").eq(1).css("display","block");
						 	}else{
						 		// 加入购物车						 		
						 		$.post("<?php echo U('Cart/ajaxCart');?>",{ 'share_id':share_id , 'cart_product_id':$(".shop_d11202_dj").attr("value") , 'catr_number':$(".gouw_xsk").val() , 'ctar_type': 1 },function( data ){
						 			if( data.status == 2000 ){
						 				$(".shop_63").text("商品已成功加入租赁车！");
						 				$(".shop_651").text("去租赁车结算");
						 				$(".shop_651").attr("attr-status",1);//设置跳转属性值
						 				$(".zhezhao").css("display","block");
			   	  						$(".zz_nr").eq(0).css("display","block");
						 				return false;
						 			}else if( data.status == -2000 ){
						 				zstk("出现错误， 错误位置在：" + status,"");
						 				return false;
						 			}
						 		},"json");
						 	}
						 },
						 error: function( XMLHttpRequest ,status , error ){
						 	zstk("出现错误， 错误位置在：" + status,"");
						 }
					});
		  	 });
			$(".shop_d522_").click(function(){ // 加入购物车
				var share_id = $(this).attr("value");
				$.ajax({
						type: "post",
					dataType: "json",
						 url: "<?php echo U('Cart/renzheng_check');?>",
						 success: function(data){
						 	
						 	if(data==null){
						 			//alert("当前未登录，请登录后进行操作！");
						 			zstk("当前未登录，请登录后进行操作！","");
						 			
						 	}
						 	else if( data['plgox_is_renzheng'] == 0 ){
						 	  $(".zhezhao").css("display","block");
						   	  $(".shop_73").text("亲，因为你是首次注册的用户，需要你完成企业认证之后才可以加入租赁车额!");
						   	  $(".zz_nr").eq(1).css("display","block");
						 	}else{
						 		// 加入购物车						 		
						 		$.post("<?php echo U('Cart/ajaxCart_');?>",{ 'share_id':share_id , 'cart_product_id':$(".shop_d11202_dj").attr("value") , 'catr_number':$(".gouw_xsk").val() , 'ctar_type': 1 },function( data ){
						 			if( data.status == 2000 ){
						 				$(".shop_63").text("商品已成功加入购物车！");
						 				$(".shop_651").text("去购物车结算");
						 				$(".shop_651").attr("attr-status",2);//设置跳转属性值
						 				$(".zhezhao").css("display","block");
			   	  						$(".zz_nr").eq(0).css("display","block");
						 				return false;
						 			}else if( data.status == -2000 ){
						 				zstk("出现错误， 错误位置在：" + status,"");
						 				return false;
						 			}
						 		},"json");
						 	}
						 },
						 error: function( XMLHttpRequest ,status , error ){
						 	zstk("出现错误， 错误位置在：" + status,"");
						 }
					});
			});
		</script>
<!--租赁-->
		<script type="text/javascript">
   //展示弹框
   function zstk(message,zznr){
   	 
   	 $(".zhezhao").css("display","block");
	 $(zznr).css("display","none");
	 $(".zz_nr_fbcg").css("display","block");
	 $(".zdsc").text(message);
	 
	  tkxslb();
   }
   
      	//点击消失(弹框)
function tkxslb(){
  $(".zhezhao").click(function(){
  	 if($(".zdsc").text()=="当前未登录，请登录后进行操作！当前未登录，请登录后进行操作！"){

  	 	location.href="<?php echo U('Tourist/login');?>";
  	 }
  	 else{
  	  //location.reload();
  	  $(".zhezhao").css("display","none");
  	  $(".zz_nr_fbcg").css("display","none");
  	  return false;
  	 }
  	 
  	 $(".zz_nr").css("display","none");
  });
  
}  
			function zulin( val ){
				// 判断是否完成企业认证
				$.ajax({
					type: "post",
				dataType: "json",
				   async: true,
					 url: "<?php echo U('Cart/renzheng_check');?>",
					 success: function(data){
					 	if( data == null ){
					 		zstk("当前未登录，请登录后进行操作！","");
					 	}
					 	if( data['plgox_is_renzheng'] == 0 ){
                            $(".zhezhao").css("display","block");
						   	  $(".shop_73").text("亲，因为你是首次注册的用户，需要你完成企业认证之后才可以租赁额!");
						   	  $(".zz_nr").eq(1).css("display","block");
						   	  return false;
					 	}
					 	if( data['plgox_zulin_xiey'] == 0  ){
							  // 判断是否首次租赁
						   	  /*$(".zhezhao").css("display","block");
						   	  $(".shop_73").text("尊敬的用户，由于您是我公司首次租赁用户，在确认后将由我公司工作人员上门与您签署《租赁协议》，是否确认继续操作？");
						   	  $(".zz_nr").eq(1).css("display","block");
						   	  return false;*/
					 	}else{
					 		// 首次租赁协议确认之后执行立即租赁
					 		$.ajax({
					 			type: "post",
					 		dataType: "json",
					 		   async: true,
					 		   	 url: "<?php echo U('Cart/ajaxCart');?>",
								data: { 'share_id':val , 'cart_product_id':$(".shop_d11202_dj").attr("value") , 'catr_number':$(".gouw_xsk").val() , 'ctar_type': 1 },
					 		 success: function( data ){
					 		 	if( data.status == 2000 ){
					 				window.location.href="<?php echo U('Cart/gouwu_che');?>";
					 				return false;
					 			}else if( data.status == -2000 ){
					 				zstk("出现错误， 错误位置在：" + status,"");
				

					 			}
					 		 },
					 		 error: function( XMLHttpRequest ,status , error ){
					 		 	zstk("出现错误， 错误位置在：" + status);
					 	
					 		 }
					 		});
					 	}
					 },
					 error: function( XMLHttpRequest ,status , error ){
					 	zstk("出现错误， 错误位置在：" + status);
					 }
				});
				// 判断是否首次租赁
				/*$.ajax({
					type: "post",
				dataType: "json",
					 url: "<?php echo U('Cart/renzheng_check');?>",
					 success: function(data){
					 	
					 },
					 error: function( XMLHttpRequest ,status , error ){
					 	zstk("出现错误， 错误位置在：" + status);
					 }
				});*/
			}
		</script>
   <script type="text/javascript">
   	//问号hover效果
   $(".shop_d1132").each(function(index){
   	 $(this).mouseover(function(){
   	 	$(".shop_d2").eq(index).css("display","block");
   	 });
   	 $(this).mouseout(function(){
   	 	$(".shop_d2").eq(index).css("display","none");
   	 });
   	 $(".shop_d2").eq(index).mouseover(function(){
   	 	$(".shop_d2").eq(index).css("display","block");
   	 });
   	 $(".shop_d2").eq(index).mouseout(function(){
   	 	$(".shop_d2").eq(index).css("display","none");
   	 });
   })
    $(".shop_651").click(function(){
      if( $(this).attr("attr-status") == 1 ){ // 租赁车
      	$(".zhezhao").css("display","none");
   	    $(".zz_nr").eq(0).css("display","none");
   	    window.location.href="<?php echo U('Cart/gouwu_che');?>";
      }else if( $(this).attr("attr-status") == 2 ){ // 购物车
      	$(".zhezhao").css("display","none");
   	    $(".zz_nr").eq(0).css("display","none");
   	    window.location.href="<?php echo U('Cart/gouwu_cart');?>";
      }
   });
   $(".shop_652").click(function(){
      window.location.href="<?php echo U('Zulin/shaixuan');?>";//刷新当前页面.
   	  $(".zhezhao").css("display","none");
   	  $(".zz_nr").eq(0).css("display","none");
   });
   $(".shop_751").eq(0).click(function(){
   	  $(".zhezhao").css("display","none");
   	  $(".zz_nr").eq(1).css("display","none");
   });
   $(".shop_751").eq(1).click(function(){
   	 if($(".shop_73").text()=="亲，因为你是首次注册的用户，需要你完成企业认证之后才可以租赁额!" || $(".shop_73").text()=="亲，因为你是首次注册的用户，需要你完成企业认证之后才可以加入租赁车额!"){
   	 	location.href="<?php echo U('User/my_qyrz_sy');?>";
   	 }else{
   	 	$.ajax({
   	 		type: "post",
   	 	dataType: "json",
   	 		 url: "<?php echo U('Cart/Ajaxzujin');?>",
   	 	 success: function(data){
   	 	 	if( data.status == 2000 ){
   	 			zstk(data.message);
   	 		}else if( data.status == -2000 ){
   	 			zstk(data.message);
   	 		}
   	 	 },
   	 	 error: function(XMLHttpRequest , error , status ){
   	 	 	zstk("出现错误， 错误位置在：" + status,"");
   	 	 }
   	 	});
   	 	$(".zhezhao").css("display","none");
   	    $(".zz_nr").eq(1).css("display","none");
   	 }
   });
  </script>
   
<script type="text/javascript">
//轮播图	
$(function(){
        var oList = $(".shop_d51_mi");
        var oListcd = $(".shop_d51_mi li");
        var oRight = $(".shop_d51_ri");
        var oLeft = $(".shop_d51_le");
        var zcd=oListcd.length;
        var kd=zcd*70+"px";
        oList.css("width",kd);
        var oWidth = parseInt(oList.css('width')) / zcd; 
        //计算图片的宽度从而达到自适应屏幕宽度
        var oSpan = $(".shop_d51_mi li a");
        var index = 1;
        var interval = 200;
        var timer = null;
        oList.css('left',0);              //图片加载完成时将图片向左偏移一张图片
 
        function animate(offset){                               //过渡效果
            var newLeft = parseInt(oList.css('left')) + offset;         //点击后的图片偏移量
            oList.animate({'left':newLeft + 'px'},interval);
        }
      oSpan.each(function(index){
      
      	$(this).mouseover(function(){
      	  var tpp=$(".shop_d51_mi li a img").eq(index).attr("src");
      	   for(var i=0;i<20;i++){
      	   	 if(index==i){
      	   	 	oSpan.eq(i).addClass('on');
      	   	 	$("#bhtp").attr("src",tpp);
      	   	 	$("#bhtp").attr("jqimg",tpp);
      	   	 }
      	   	 else{
      	   	 	oSpan.eq(i).attr('class','');
      	   	 }
      	   }
       });
      })
      
      if(zcd>5){
 
        oRight.click(function(){
        	oLeft.css("display","block");
            if(oList.is(':animated')){
                return;
            }
            index += 1;    
            if(index == zcd-4){         //向右点击 index索引+1
               $(this).css("display","none");
            }               
            animate(-oWidth);
           
        });
 
        oLeft.click(function(){
        	oRight.css("display","block");
        	 index -= 1;
            if(oList.is(':animated')){
                return;
            }
            animate(oWidth);
            if(index == 1){  
               $(this).css("display","none");
            } 
              
            
        });
 
      }
    });
</script>
<script type="text/javascript">
	//起租天数
	/*$(".shop_d11201").each(function(index){
		$(this).click(function(){
           $(this).addClass('shop_d11201_dj'); 
			$(this).siblings().removeClass('shop_d11201_dj');
			
		})
	});*/
	


</script>

<script type="text/javascript">
	
	//商品描述  累计评价
	$(".shop_d6210").each(function(index){
		$(".shop_d62_ljpj").css('display','none');
		$(this).click(function(){
			$(this).addClass('shop_d6210_dj'); 
			$(this).siblings().removeClass('shop_d6210_dj');
			if(index==0){
				$(".shop_d62_spms").css('display','block');
				$(".shop_d62_ljpj").css('display','none');
			}
			else{
				$(".shop_d62_spms").css('display','none');
				$(".shop_d62_ljpj").css('display','block');
			}
		})
	});
//选择
$(".shop_d11202").each(function(index){
	$(".shop_d11202").eq(0).addClass('shop_d11202_dj'); 
	$(this).click(function(){
		$(this).addClass('shop_d11202_dj'); 
		$(this).siblings().removeClass('shop_d11202_dj');
	})
});
</script>
<script type="text/javascript">
// 进入页面之后默认选中的
$(document).ready(function(){
	$.ajax({
		type: "post",
	dataType: "json",
		 url: "<?php echo U('Cart/ajaxFcuntion');?>",
		data: {'specifications_id':$(".specifications_id").attr("value")},
		success: function( data ){
			$.each(data,function( index , value ){
				// 满意度
				$('.manyidu').eq(0).text(value['specifications_satisfaction']+"%");
				// 出租率
				$(".chuzulv").eq(0).text(value['specifications_chuzu']+"%");
				// 起租天数
				$(".zulin_day_number").html(value['zulin_day_number']+value['zulin_name']);
				$(".zulin_day_number").attr("value",value['zulin_day_number']);
				// 共享租金价格
				var prices = value['specifications_rent'];
				var today = $(".zulin_day_number").attr("value");
				var count = (parseFloat(prices));
				$(".shop_d11301").eq(0).text('¥ '+count);
				// 租满即送
				if(value['specifications_give']=="租满即送"){
				  $(".number_day").eq(0).text(value['specifications_day_number']+value['specifications_day_type']);
				  $(".shop_zmjs").eq(0).css("display","");
				}
				//市场参考价
		 		$(".shop_scck").eq(0).text('¥ '+value['specifications_market']);
		 		//押金
				$(".shop_yaj").eq(0).text('¥ '+value['specifications_deposit']);
				// 出售价
				$(".shop_prices").eq(0).text(value['specifications_prices']);
				//库存
				$(".shop_kcgs").eq(0).text(value['specifications_stock']);
				// 租赁数量
				$(".gouw_10").html('<span class="gouw_js"></span><input type="text" class="gouw_xsk" value="1" name="gouw_xsk" /><span class="gouw_zd"></span>');
				$(".gouw_js").click(function(){
					var gwz=$(".gouw_xsk").val();
					if($(".gouw_xsk").val()<2){
						$(".gouw_xsk").val(1);
					}
					else{
						var zhz=parseInt(gwz);
						var jg=--zhz;
						$(".gouw_xsk").val(jg);
					}
				});
				$(".gouw_zd").click(function(){
					var gwz=$(".gouw_xsk").val();
					if( $(".gouw_xsk").val() >= parseInt(value['specifications_stock']) ){
						$(".gouw_xsk").val( parseInt(value['specifications_stock']) );
					}else{
						var zhz=parseInt(gwz);
						var jg=++zhz;
						$(".gouw_xsk").val(jg);
					}
				});
			});
		},
		error: function( XMLHttpRequest , error , status ){
  			 zstk("出现错误， 错误位置在：" + status,"");

  		}
	});
});
// 点击后生成的效果
$(".specifications_id").click(function(){
	$.ajax({
		type: "post",
  dataType: "json",
  		  url: "<?php echo U('Cart/ajaxFcuntion');?>",
  		data: {'specifications_id':$(this).attr("value")},
  		success: function( data ){
  			$.each(data,function( index , value ){
  				// 满意度
				$('.manyidu').eq(0).text(value['specifications_satisfaction']+"%");
				// 出租率
				$(".chuzulv").eq(0).text(value['specifications_chuzu']+"%");
  				// 套餐名称
  				$(".share_keys").text(value['specifications_keys']);
  				// 起租天数
  				$(".zulin_day_number").html(value['zulin_day_number']+value['zulin_name']);
  				$(".zulin_day_number").attr("value",value['zulin_day_number']);
  				 //租金
  				 var prices = value['specifications_rent'];
  				 //起租天数
  				 var day_num = $(".zulin_day_number").attr("value");
  				 // 总价
  				 var count = (parseFloat(prices));
  				 //租金
  				 $(".shop_d11301").eq(0).text('¥ '+count);
  				 //押金
			     $(".shop_yaj").text('¥ '+value['specifications_deposit']);
			     // 市场参考价
			     $(".shop_scck").text('¥ '+value['specifications_market']);
			     // 出售价
				$(".shop_prices").eq(0).text(value['specifications_prices']);
			     // 产品图
			     $("#bhtp").attr("src","/Uploads/admin/"+value['specifications_img']);
			     $("#bhtp").attr("jqimg","/Uploads/admin/"+value['specifications_img']);
			     //租满即送
			     if( value['specifications_give']=="租满即送" ){
				  	$(".number_day").eq(0).text(value['specifications_day_number']+value['specifications_day_type']);
				  	$(".shop_zmjs").eq(0).css("display","");
				}else{
					// $(".shop_zmjs").eq(0).text("");
					$(".shop_zmjs").eq(0).css("display","none");
				}
			     //库存
				 $(".shop_kcgs").text(value['specifications_stock']);
				 // 租赁数量
				 $(".gouw_10").html('<span class="gouw_js"></span><input type="text" class="gouw_xsk" value="1" name="gouw_xsk" /><span class="gouw_zd"></span>');
				 $(".gouw_js").click(function(){
					var gwz=$(".gouw_xsk").val();
					if($(".gouw_xsk").val()<2){
						$(".gouw_xsk").val(1);
					}
					else{
						var zhz=parseInt(gwz);
						var jg=--zhz;
						$(".gouw_xsk").val(jg);
					}
				});
				$(".gouw_zd").click(function(){
					var gwz=$(".gouw_xsk").val();
					if( $(".gouw_xsk").val() >= parseInt(value['specifications_stock']) ){
						$(".gouw_xsk").val( parseInt(value['specifications_stock']) );
					}else{
						var zhz=parseInt(gwz);
						var jg=++zhz;
						$(".gouw_xsk").val(jg);
					}
				});
  			});
  		},
  		error: function( XMLHttpRequest , error , status ){
  			 zstk("出现错误， 错误位置在：" + status,"");

  		}
	});
});
 $(".header_bottom1_middle li").eq(1).addClass("header_dj");
 $(".header_bottom1_middle li").eq(1).siblings().removeClass("header_dj");
</script>
<?php echo W('Common/footer');?>