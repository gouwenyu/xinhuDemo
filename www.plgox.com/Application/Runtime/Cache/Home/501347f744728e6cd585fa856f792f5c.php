<?php if (!defined('THINK_PATH')) exit(); echo W('Common/htsy_top');?>

<link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/juezhi_fb.css">
 <style>
.current{
		background-color:#1B53A6 !important; 
		border:1px solid #1B53A6 !important;
		color:#FFFFFF;padding:8px 12px 8px 12px;
	}
.jzfb22 span{
	line-height:30px;
}		
</style> 
<div class="ht_in1">

	 <div class="ht_in10">
		<span >
			我的二手
		</span>
	</div>

     <div class="ht_content">		      
   	      
   	      <div  class="mypj2 jzfb">
             	
             	<div class="jzfb1">
             	  <div class="jzfb11">
             		<select class="jzfb10" onchange="window.location=this.value">
             			<option>排序规则</option>
             			<option value="<?php echo U('Homeuser/JueZhi_fbgl',array('type'=>1));?>">按发布时间</option>
             			<option value="<?php echo U('Homeuser/JueZhi_fbgl',array('type'=>2));?>">按修改时间</option>
             		</select>
             	  </div>
             	  <div class="jzfb12">
             		发布中的信息<span><?php echo ($count); ?></span>条
             	  </div>
             	</div>
              <div class="jzfb2">
	               <table class="myxy32">
		    		<tr>
		    			<td width="35%">基本信息</td>
		    			<td width="20%">发布时间</td>
		    			<td width="20%">发布类型</td>
		    			<td width="20%" >最后更新时间</td>
		    			<td width="15%">浏览量</td>
		    			<td width="10%">操作</td>
		    		</tr>
		    		<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list): $mod = ($i % 2 );++$i;?><tr>
			    			<td>
			    			  <div class="jzfbbox">
				    			  <div class="jzfb21" >
				    			    <input type="checkbox" class="choose_all"  value="<?php echo ($goods_list["goods_id"]); ?>"  name="jzfb21"/>
				    			  </div>
				    			  <div class="jzfb22" >
				    			    <span>
  	  									<?php echo ($goods_list["goods_name"]); ?>
  	  								</span>
				    			  </div>
				    		  </div>
			    			</td>
			    			<td>
  	  							<?php echo ($goods_list["goods_publish_time"]); ?>
  	  						</td>
  	  						<td>
  	  							<?php if( ($goods_list["goods_sell_type"] == 1) ): ?>餐厅二手
  	  							<?php elseif( ($goods_list["goods_sell_type"] == 2) ): ?>
  	  								酒店二手
  	  							<?php elseif( ($goods_list["goods_sell_type"] == 3) ): ?>
  	  								求购
  	  							<?php elseif( ($goods_list["goods_sell_type"] == 4) ): ?>
  	  								店铺转让<?php endif; ?>
  	  						</td>
			    			<td>
			    				<?php echo ($goods_list["goods_edit_time"]); ?>
			    			</td>
			    			<td>
			    				<?php echo ($goods_list["goods_is_watched"]); ?>
			    			</td>
			    			<td>
			    				<!-- 暂时再 【求购】 上面不明确 -->
			    				<?php if( ($goods_list["goods_sell_type"] == 1) OR ($goods_list["goods_sell_type"] == 2) OR ($goods_list["goods_sell_type"] == 3) ): ?><a class="jzfb_bj_sc" href="<?php echo U('esxz/esxz_fbmessage');?>&edit_id=<?php echo ($goods_list['goods_id']); ?>&flz=<?php echo ($goods_list['goods_sell_type']); ?>">编辑</a>
  	  							<?php elseif( ($goods_list["goods_sell_type"] == 4) ): ?>
  	  								<a class="jzfb_bj_sc" href="<?php echo U('esxz/esxz_fbmessage_zr');?>&edit_id=<?php echo ($goods_list['goods_id']); ?>&flz=<?php echo ($goods_list['goods_sell_type']); ?>">编辑</a><?php endif; ?>
			    				<!-- <span class="jzfb_bj_sc" onclick="javascript:window.location.href='<?php echo U('esxz/esxz_fbmessage_zr');?>'">编辑</span> -->
			    				<span class="jzfb_bj_sc delete_goods" onclick="delete_goods(<?php echo ($goods_list["goods_id"]); ?>)" >删除</span>
			    			</td>
			    			<input type="hidden" class="check_id" value="<?php echo ($goods_list["goods_id"]); ?>">
			    		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		    		
		    	</table>
             </div>
             
             <input type="hidden" id="all_check_id" value="">
             
             <div class="jzfb3">
             	<div class="jzfb31">
         		  <div class="jzfb21 jzfb310" >
	    			 <input type="checkbox"  name="jzfb21" class="qx_button"/>
	    		   </div>
	    	      <div class="jzfb2_xm" >
	    			  <span>全选</span>
	    	      </div>
             	</div>
             	
             	<div class="jzfb31">
         		  <div class="jzfb21 jzfb310" >
	    			 <input type="checkbox"  name="jzfb21" class="sc_button"/>
	    		   </div>
	    	      <div class="jzfb2_xm" >
	    			  <span>删除已选项</span>
	    	      </div>
             	</div>
             </div>
             

              <div class="message" style="height:120px;padding:50px 0px;">
             	<?php echo ($page); ?>
             	</div>
        
             
             
           </div>   
          </div>

 </div>
 
 
<!--遮罩-->
<div class="zhezhao" style="display:none;">

	<div class="zz_nr_scdz" style="display:none;">
	  <div class="zz_nr1" >
		<span class="wxts">温馨提示<span>
		<span class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:146px;height:146px;display:block;font-size:18px;"></div>
	 
	  <div class="zz_nr3" >
			<a href="#wss" class="qrsc">确认</a>
			<a href="#wss" class="tyjs">取消</a>	
	  </div>  
	</div>	

<div class="zz_nr_fbcg11" style="display:none;">
	  <div class="zdsc">
	  	提交成功，平台会核实处理
	  </div>
	   
	  <div class="zz_gbtk" >
			关闭
	  </div> 
	</div>


</div>
<script src="/Public/Home/js/szgd.js"></script>
<script type="text/javascript">
$(".htsy_top_yd").css("top","270px");


	$(".htsy_2 li").eq(6).css("background","#3E4F65");

	$(".htsy_2 li").eq(6).siblings().css("background","none");
	$(".htsy_2 li div").eq(6).css("background","url('/Public/Home/image/htsy_2.png') no-repeat 0px 0px");
	$(".htsy_2 li div").eq(6).siblings().css("background","none");



 $(".tyjs").click(function(){
	$(".zhezhao").css("display","none");
	$(".zz_nr_scdz").css("display","none");
});
$(".scqr").click(function(){
	$(".zhezhao").css("display","none");
	$(".zz_nr_scdz").css("display","none");
});
</script>
<script type="text/javascript" src="/Public/Home/js/hkhd1.js"></script>
<script type="text/javascript" src="/Public/Common/bootstrap/js/ajaxfileupload.js"></script>
<script type="text/javascript">
function delete_goods(goods_id){
   $(".zhezhao").css("display","block");
	$(".zz_nr_scdz").css("display","block");
  $(".zz_nr2").text("确认删除该选项吗？");
  window.goods_id=goods_id;
}
//删除选中项目
$(".sc_button").click(function(){
	$(".zhezhao").css("display","block");
	$(".zz_nr_scdz").css("display","block");
	$(".zz_nr2").text("确认删除所选项吗？");
	/**/
})

$(".qrsc").click(function(){
	$(".zz_nr_scdz").css("display","none");
	if($(".zz_nr2").text()=="确认删除所选项吗？"){
		var k=0;
		var arra2=new Array();
		for(var j=0;j<$(".choose_all").length;j++){
			if($(".choose_all").eq(j).is(":checked")){
				arra2[k]=$(".choose_all").eq(j).attr("value");
				k++;
			}
		}
		$("#all_check_id").val(arra2);
		$.ajaxFileUpload({
			dataType: "json",
			url:"<?php echo U('JueZhi/delete_goods');?>",
	        type:'post',
	        data:{
	        	type:2,
	        	id:arra2
	        }, 
	        success:function(data){
	        	tyxs("删除成功");
	        	
	        }
	        
	
	    });
	}
	else if($(".zz_nr2").text()=="确认删除该选项吗？"){
		   $.ajaxFileUpload({
			dataType: "json",
			url:"<?php echo U('JueZhi/delete_goods');?>",
	        type:'post',
	        data:{
	        	type:1,
	        	id:goods_id
	        }, 
	        success:function(data){
	        	tyxs("删除成功");
	        }
	        
	
	        });
	}
})

function tyxs(message){
	     $(".zhezhao").css("display","block");
		 $(".zz_nr_fbcg11").css("display","block");
		 $(".zdsc").text(message);
         
         
         djxs();
}
 function djxs(){
	 $(".zhezhao").click(function(){
		 $(".zhezhao").css("display","none");
  	     $(".zz_nr_fbcg11").css("display","none"); 
  	      location.reload();
	})
}



//全选
$(".qx_button").click(function(){

	if($(this).is(':checked')){
		$(".choose_all").prop("checked", true);
		var arra1=new Array();
		for(var i=0;i<$(".choose_all").length;i++){
			arra1[i]=$(".choose_all").eq(i).attr("value");
		}
		$("#all_check_id").val(arra1);
	}
	else{
		$(".choose_all").prop("checked", false);
		$("#all_check_id").val(null);
	}
})

</script>


</body>
</html>