<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/header_esxz');?>
<?php echo W('Common/header1_esxz');?>
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_jb.css">
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_fbmessage.css">
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_choose_fl.css">
<style>
	
</style>
<div class="esxz_big_box">
  <div class="esxz_small_box"> 			 	
	<div class="esxz_cho_fl">
		<span >
			发布租赁 / 选择分类
		</span>
	</div>
	
  	<div class="esxz_fbme32" style="margin-bottom:30px;margin-top:30px;">
	 		<div class="esxz_fbme321" >
	 			<span style="font-size:16px;">选择发布类型：</span>
	 			<b >*</b>
	 		</div>
	 		<div class="esxz_fbme322">
	 			<div class="esxz_fbme3221">
	 			<input type="radio" name="goods_type" value="1" class="goods_type"/> <span style="font-size:14px;">餐厅二手</span> 
	 			</div>
	 			<div class="esxz_fbme3221">
	 			  <input type="radio" name="goods_type" value="2" class="goods_type"/> <span style="font-size:14px;">酒店二手</span>
	 			</div>
	 			<div class="esxz_fbme3221">
	 			  <input type="radio" name="goods_type" value="3" class="goods_type"/> <span style="font-size:14px;">求购</span>
	 			</div>
	 			<div class="esxz_fbme3221">
	 			  <input type="radio" name="goods_type" value="4" class="goods_type"/> <span style="font-size:14px;">店铺转让</span>
	 			</div>
	 		</div>
	 	</div>
	 	
<div class="fbzl_dbox">
       <ul class="fbzl first_fl">
         <?php if(is_array($choose1)): $i = 0; $__LIST__ = $choose1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list1): $mod = ($i % 2 );++$i;?><li>
              <a href="#" class="fbzl1_a yijifenlei" id="<?php echo ($goods_list1["juezhi_brand_id"]); ?>"><?php echo ($goods_list1["juezhi_brand_name"]); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <ul class="fbzl_first second_fl">
        <?php if(is_array($choose2)): $i = 0; $__LIST__ = $choose2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list2): $mod = ($i % 2 );++$i;?><li>
              <a href="#" class="fbzl1_b" id="<?php echo ($goods_list2["juezhi_brand_id"]); ?>"><?php echo ($goods_list2["juezhi_brand_name"]); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
</div>
<!-- 	<div class="esxz_cho_fl1">
      <ul>
      	<li class="fbzl1_fir">
      	  <ul>
      	  	
		    <?php if(is_array($choose1)): $i = 0; $__LIST__ = $choose1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list1): $mod = ($i % 2 );++$i;?><li>
      	  		<a href="#" class="fbzl1_a" id="<?php echo ($goods_list1["juezhi_brand_id"]); ?>"><?php echo ($goods_list1["juezhi_brand_name"]); ?></a>
      	  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
      	  	
      	  </ul>
      	</li>
      	
      	
      	
      	<li class="fbzl2">
      		<img src="/Public/Home/image/esxz_xzfl.jpg" />
      	</li>
      	
      	
      	
      	<li class="fbzl1_sec">
      	  <ul>
      	  
		    <?php if(is_array($choose2)): $i = 0; $__LIST__ = $choose2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list2): $mod = ($i % 2 );++$i;?><li>
      	  		<a href="#" class="fbzl1_b" id="<?php echo ($goods_list2["juezhi_brand_id"]); ?>"><?php echo ($goods_list2["juezhi_brand_name"]); ?></a>
      	  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
      	  	
      	  </ul>
      	</li>
      	<li class="fbzl2">
      		<img src="/Public/Home/image/esxz_xzfl.jpg" />
      	</li>
      	
      	
      	
      	<li class="fbzl1_thi">
      	  <ul>
      	  	<?php if(is_array($choose3)): $i = 0; $__LIST__ = $choose3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list3): $mod = ($i % 2 );++$i;?><li>
      	  		<a href="#" class="fbzl1_c" id="<?php echo ($goods_list3["juezhi_brand_id"]); ?>"><?php echo ($goods_list3["juezhi_brand_name"]); ?></a>
      	  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
      	  </ul>
      	</li>
      </ul> 
   </div> -->
   
   <!-- <div class="xyibu">下一步</div> -->
  </div>
</div>

<!--发布成功  3秒后自动消失-->
<div class="zhezhao" style="display:none;">
	 <div class="zz_nr_fbcg" >
	  <div class="zdsc">
	  	提交成功，平台会核实处理
	  </div>
	   
	  <div class="zz_gbtk" >
			关闭
	  </div> 
	</div>
	
</div>
<script type="text/javascript">
$(".fbzl1_a").eq(0).addClass("fbzl1_dj");
$(".fbzl1_b").eq(0).addClass("fbzl1_dj");
	
//一级点击效果
   $(".fbzl1_a").each(function(index){
   	    $(this).click(function(){   
    	     for(var i=0;i<$(".fbzl1_a").length;i++){
    	     	if(i==index){
    	     		$(this).addClass("fbzl1_dj");
    	     		var idz=$(this).attr("id");
				  $.post("<?php echo U('Esxz/esxz_choose_fl');?>",{'id':idz , 'type':1 },
				  function( data ){
				  	 //二级分类
				  	 var opt='';
					 $.each(data.list_two,function(index,value){
      	  	           opt+='<li><a href="#" class="fbzl1_b" id='+value.juezhi_brand_id+'>'+value.juezhi_brand_name+'</a></li>';
      	  	            
					});
					$(".second_fl").text(null);
                    $(".second_fl").append(opt);
                    
                    
                    
                    //三级分类
                    var opt1='';
					 $.each(data.list_three,function(index,value){
      	  	           opt1+='<li><a href="#" class="fbzl1_c " id='+value.juezhi_brand_id+'>'+value.juezhi_brand_name+'</a></li>';
      	  	            
					});

					$(".fbzl1_thi ul").text(null);
                    $(".fbzl1_thi ul").append(opt1);
				  	
				  	
				  	 sx_thir();
				  	  d_thid();
  	 	  		
  	 	  	     },"json");
    	     		
    	     		
    	     		
    	     		
    	     	}
    	     	else{
    	     		$(".fbzl1_a").eq(i).removeClass("fbzl1_dj");
    	     	}
    	     }
		});
   });
   //二级点击效果
function sx_thir(){
	//默认第一个为被选中的状态
	$(".fbzl1_b").eq(0).addClass("fbzl1_dj");
	
   $(".fbzl1_b").each(function(index){
   	    $(this).mouseenter(function(){   
    	     //for(var i=0;i<$(".fbzl1_b").length;i++){
    	     //	if(i==index){
    	     		//$(this).addClass("fbzl1_dj1");
    	     		//$(this).siblings().removeClass("fbzl1_dj1");
    	     		var idz=$(this).attr("id");
    	     		
    	     		
						  $.post("<?php echo U('Esxz/esxz_choose_fl');?>",{'id':idz , 'type':2 },
							  function( data ){
							  	
			            $(".fbzl_second").remove();          
			                    //三级分类
			                    var opt1='';
								$.each(data.list_three,function(index,value){
			      	  	           opt1+='<li><a href="#" class="fbzl1_c" id='+value.juezhi_brand_id+'>'+value.juezhi_brand_name+'</a></li>';
			      	  	            
								});

                if(data.list_three!=""){
                  var tjxys='<ul class="third_fl fbzl_second">'+opt1+'</ul>';
                   $(".fbzl1_b").eq(index).append(tjxys);
                }
			          
							  	
							  	 d_thid();
							  	 
		  	 	  		
		  	 	  	     },"json");
		  	 	  	     
		  	 	 
		  	 	  	     
    	     	//}
    	     	//else{
                // $(".fbzl1_b").eq(index).css("color","#d16142");
    	     		//$(".fbzl1_b").eq(i).removeClass("fbzl1_dj1");
                  // $(".fbzl1_b").eq(i).css("color","#555");
    	     	//}
    	     }
		});

$(this).mouseleave(function(){
    $(".fbzl_second").remove();          
})


   });
     
}

sx_thir();

function d_thid(){
	 //三级
    $(".fbzl1_c").each(function(index){
   	    $(this).click(function(){   
    	     for(var i=0;i<$(".fbzl1_c").length;i++){
    	     	if(i==index){
    	     		$(this).addClass("fbzl1_dj1");
              $(this).css("color","#d16142");
    	     	}
    	     	else{
    	     		$(".fbzl1_c").eq(i).removeClass("fbzl1_dj1");
              $(".fbzl1_c").eq(i).css("color","#555");
    	     	}
    	     }
		});
   });
}
d_thid();



$(".xyibu").click(function(){
	//alert(+"----"+$(".fbzl1_dj").eq(2).attr("id"));
	if(!$('.goods_type').is(':checked')){
		tkcx("请选择发布类型");
	}
	/*else if($(".fbzl1_dj1").eq(0).attr("id")==null){
		tkcx("请选择三级分类中选择的分类")
	}*/
	else{
		var type= $('.goods_type:checked ').val();
		if(type==1){
			location.href="<?php echo U('esxz/esxz_fbmessage');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
		}
		else if(type==2){
			location.href="<?php echo U('esxz/esxz_fbmessage');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
		}
		else if(type==3){
			location.href="<?php echo U('esxz/esxz_fbmessage_qg');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
		}
		else if(type==4){
			location.href="<?php echo U('esxz/esxz_fbmessage_zr');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
		}
		
		/*if(type=='1')else if(type==2)else if(type==3)else*/
	}
	
	
})


 //自动消失(弹框)
function tkxsds(){
  $(".zhezhao").click(function(){	  
  	 	 $(".zhezhao").css("display","none");

	    return false;
  });
}
 function tkcx(message){
  	    $(".zhezhao").css("display","block");
		$(".zdsc").text(message);
		tkxsds();
  }

	
</script>
<?php echo W('Common/footer_esxz');?>