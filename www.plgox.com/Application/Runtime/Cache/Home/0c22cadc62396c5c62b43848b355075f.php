<?php if (!defined('THINK_PATH')) exit(); echo W('Common/htsy_top');?>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/htsy_index.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/zhezhao.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/wode_zulin.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css">
<style>

</style>
<div class="ht_in1">
	<div class="ht_in10">
		<span >
			我的租赁
		</span>
	</div>
	
	
   <div class="ht_content">

	 <div class="wdzl">
		<div class="wdzl_bj25" onclick="javascript:window.location.href='<?php echo U('Homeuser/taocan_guanli');?>'">
	      	<span class="wdzl_bj_tjtc_jh">＋</span>
	      	<span class="wdzl_bj_tjtc">添加规格</span>
	      </div>
	 </div>

	
	 <div class="wdz2">
	 	 <br/>
	 <table >
	 	<thead>
	 		<tr class="wdz21">
	 			<td>
	 				规格型号
	 			</td>
	 			<td>
	 				押金
	 			</td>
	 			<td>
	 				市场参考价
	 			</td>
	 			<td>
	 				库存量
	 			</td>
	 			<td>
	 				租金
	 			</td>
	 			<td>
	 				最低起租期(天数)
	 			</td>
	 			<td>
	 				所属分类
	 			</td>
	 			<td>
	 				租满即送
	 			</td>
	 			<td>
	 				操作
	 			</td>
	 		</tr>
	 	</thead>
	 	<tbody class="wdz22">
	 	<?php if(is_array($specifications)): $i = 0; $__LIST__ = $specifications;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$specifications_): $mod = ($i % 2 );++$i;?><tr class="taocan_tr_<?php echo ($specifications_['specifications_id']); ?>">
	 			<td >
	 			  <?php echo ($specifications_['specifications_name']); ?>
	 			</td>
	 			<td>
	 				¥<?php echo ($specifications_['specifications_deposit']); ?>
	 			</td>
	 			<td>
	 				¥<?php echo ($specifications_['specifications_market']); ?>
	 			</td>
	 			<td>
	 				<?php echo ($specifications_['specifications_stock']); ?>件
	 			</td>
	 			<td>
	 				¥<?php echo ($specifications_['specifications_rent']); ?>
	 			</td>
	 			<td>
	 				<?php echo ($specifications_['zulin_day_number']); echo ($specifications_['zulin_name']); ?>

	 			</td>
	 			<td>
	 				<?php echo ($specifications_['classify_title']); ?>
	 			</td>
	 			<td>
	 				满<?php echo ($specifications_['specifications_day_number']); echo ($specifications_['specifications_day_type']); ?>,<?php echo ($specifications_['specifications_give']); ?>
	 			</td>
	 			<td>
	 				<a href="<?php echo U('Homeuser/taocan_guanli');?>&edit_id=<?php echo base64_encode($specifications_['specifications_id']) ?>" class="wdz23">编辑</a>
	 				<a class="wdz25 share_del" href="javascript:void(0);" attr_del_id="<?php echo ($specifications_['specifications_id']); ?>">删除</a>
	 			</td>
	 		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	 	</tbody>
	 </table>
	 </div>
	 <div class="message" >
        <?php echo ($page); ?>
     </div>
   </div>
</div>
<script type="text/javascript">

/*	$(".share_del").click(function(){
			
	});*/
</script>
<!--遮罩-->
<div class="zhezhao" style="display:none;">
	<div class="zz_nr" style="display:none;">
	  <div class="zz_nr1">
		<span style="display:block;float:left;font-size:18px;margin-left:30px;">温馨提示<span>
		<span style="display:block;float:right;margin-left:460px;font-size:33px;color:white;cursor:pointer;" class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:30px;height:146px;">
		确认删除这个任务吗?			
	  </div>
	  <div class="zz_nr3" >
			<a href="#wss" class="tyjs0">确认</a>
			<a href="#wss" class="tyjs">取消</a>	
	  </div>
	  
	  
	</div>	


  <div class="zz_nr_fbcg" style="display:none;">
	  <div class="zdsc">
	  	提交成功，平台会核实处理
	  </div>
	   
	  <div class="zz_gbtk" >
			关闭
	  </div> 
	</div>


</div>
<script type="text/javascript" src="/Public/Home/js/fen_ye.js"></script>
<script src="/Public/Home/js/szgd.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		alert("由于国家政策原因，该功能暂时不对外开放，请见谅！");
		window.opener=null;
		window.open('','_self');
		window.close();
		return false;
	});

	$(".htsy_top_yd").css("top","138px");



  $(".htsy_2 li").eq(3).css("background","#3E4F65");

  $(".htsy_2 li").eq(3).siblings().css("background","none");
  $(".htsy_2 li div").eq(3).css("background","url('/Public/Home/image/htsy_2.png') no-repeat 0px 0px");
  $(".htsy_2 li div").eq(3).siblings().css("background","none");
	
	
	//删除
	$(".wdz25").each(function(index){
		$(this).click(function(){
			var specifications_id = $(this).attr('attr_del_id');
			share_del(specifications_id);
			$(".zhezhao").css("display","block");
			$(".zz_nr").css("display","block");
		})
	});
	function share_del( id ){
		$(".tyjs0").off("click");
		$(".tyjs0").on("click",function(){
			$.post("<?php echo U('Homeuser/AjaxShare_del');?>",{ 'specifications_id':id },function(data){
				if( data.status == 2000 ){
					$(".taocan_tr_"+id).remove();
					tkcx(data.message);
				}else if( data.status == -2001 ){
					tkcx(data.message);
				}
			});
			$(".zhezhao").css("display","none");
		});
	}
	$(".tyjs").click(function(){
		$(".zhezhao").css("display","none");
		$(".zz_nr").css("display","none");
	});
	$(".scqr").click(function(){
		$(".zhezhao").css("display","none");
		$(".zz_nr").css("display","none");
	});



	 function tkcx(message){
  	    $(".zhezhao").css("display","block");  
		$(".zz_nr_fbcg").css("display","block");
		$(".zz_nr").css("display","none");
		$(".zdsc").text(message);
		
         tkgb();
		
		
  }	
	
	
		 //自动消失(弹框)
	function tkgb(){
	  $(".zhezhao").click(function(){
		  
	  	 	 $(".zhezhao").css("display","none");

	  	     $(".zz_nr_fbcg").css("display","none"); 
	  	  
	  	     return false;
	  });
	}	
	
</script>
</body>
</html>