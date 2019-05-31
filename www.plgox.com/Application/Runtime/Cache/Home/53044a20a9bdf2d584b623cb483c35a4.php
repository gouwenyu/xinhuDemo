<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header_esxz');?>
<?php echo W('Common/header1_esxz');?>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/help_top.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/css/juezhi_fb.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css" />
 <style>
	.mypj1_box{
		padding-bottom:0px;
	}	
	.current{
		background-color:#E70052 !important; 
		border:1px solid #E70052 !important;
		color:#FFFFFF;padding:8px 12px 8px 12px;
	}	
</style> 
<div class="mypj juezhi">

     <div class="mypj1_box">

	   	<div class="my_t2" >
	         <ul class="my_t5">
	           <li><a href="#1" class="help_topjt">发布管理</a></li>
	           <li><a href="<?php echo U('JueZhi/JueZhi_fbgl');?>" class="help_zl">发布中</a></li>
	           <li><a href="<?php echo U('JueZhi/JueZhi_shz');?>" class="help_zl">审核中</a></li>
	           <li><a href="<?php echo U('JueZhi/JueZhi_wtg');?>" class="help_zl">未通过</a></li>
	           <li><a href="<?php echo U('JueZhi/JueZhi_wdsc');?>" class="help_sh">我的收藏</a></li>
	           <!-- <li><a href="<?php echo U('JueZhi/JueZhi_wdzj');?>" class="help_sh">我的足迹</a></li> -->
	           <li>
		  	     <a  href="#" class="hdmk">
		  	     </a>
			  </li>
	         </ul>
	      </div>

   	      
   	      
   	      <div  class="mypj2 jzfb">
             	
             	<div class="jzfb1">
             	  <div class="jzfb11">
             		<select class="jzfb10"  onchange="window.location=this.value">
             			<option>排序规则</option>
             			<option value="<?php echo U('JueZhi/JueZhi_wtg',array('type'=>1));?>">按发布时间</option>
             			<option value="<?php echo U('JueZhi/JueZhi_wtg',array('type'=>2));?>">按修改时间</option>
             		</select>
             	  </div>
             	  <div class="jzfb12">
             		发布中的信息<span> <?php echo ($count); ?> </span>条
             	  </div>
             	</div>
              <div class="jzfb2">
	               <table class="myxy32">
		    		<tr>
		    			<td style="width:350px;">基本信息</td>
		    			<td>审核未通过原因</td>
		    			<td>操作</td>
		    		</tr>
		    		
		    		<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list): $mod = ($i % 2 );++$i;?><tr>
		    			<td>
		    			   <div class="jzfbbox">
			    			  <div class="jzfb21" >
			    			    <input type="checkbox" class="choose_all"   value="<?php echo ($goods_list["goods_id"]); ?>"  name="jzfb21"/>
			    			  </div>
			    			  <div class="jzfb22" >
			    			    <span>
				    			   <?php echo ($goods_list["goods_name"]); ?>
			    			    </span>
			    			  </div>
			    		  </div>
		    			</td>
		    			<td><?php echo ($goods_list["goods_reason"]); ?></td>
		    			<td>
		    				<span class="jzfb_bj_sc" onclick="delete_goods(<?php echo ($goods_list["goods_id"]); ?>)">删除</span>
		    			</td>
		    			<input type="hidden" class="check_id" value="<?php echo ($goods_list["goods_id"]); ?>">
		    		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		    		
		    	</table>
             </div>
             
             <input type="hidden" id="all_check_id" value="">
            <div class="jzfb3">
             	<div class="jzfb31">
         		  <div class="jzfb21 jzfb310" >
	    			 <input type="checkbox"  class="qx_button" name="jzfb21"/>
	    		   </div>
	    	      <div class="jzfb2_xm" >
	    			  <span>全选</span>
	    	      </div>
             	</div>
             	
             	<div class="jzfb31">
         		  <div class="jzfb21 jzfb310" >
	    			 <input type="checkbox" class="sc_button"  name="jzfb21"/>
	    		   </div>
	    	      <div class="jzfb2_xm" >
	    			  <span>删除已选项</span>
	    	      </div>
             	</div>
             </div>
             
             <div class="message"  style="height:120px;padding:50px 0px;">
             	<?php echo ($page); ?>
             </div>
            
            
            
             
          </div>
   	
   	
   	
 
   	   
   </div>
 </div>
 
 
 <!--遮罩-->
<div class="zhezhao" style="display:none;">

	<div class="zz_nr_scdz" style="display:none;">
	  <div class="zz_nr1" style="background-color:#DE7696;">
		<span class="wxts">温馨提示<span>
		<span class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:146px;height:146px;display:block;font-size:18px;"></div>
	 
	  <div class="zz_nr3" >
			<a href="#wss" class="qrsc" style="background-color:#DE7696;">确认</a>
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
 
 
<script type="text/javascript">
/*	*/

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
//将下拉标签显示
 $(".help_zl").parent().css("display",'list-item');
//左边浮动滑块距离头部
$(".hdmk").css("top",'150px');

//二设置左边点击背景
  $(".my_t5 li a").eq(3).css("backgroundColor","white").css("color","#e40050");
  $(".my_t5 li a").eq(3).siblings().css("backgroundColor","none");



</script>

<?php echo W('Common/footer_esxz');?>
</body>
</html>