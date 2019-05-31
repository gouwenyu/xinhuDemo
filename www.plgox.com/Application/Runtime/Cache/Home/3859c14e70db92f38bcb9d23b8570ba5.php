<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/header_esxz');?>
<?php echo W('Common/header1_esxz');?>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css" />
 <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_index.css" /> 

 	
<style type="text/css" rel="stylesheet">

     
</style>

<div class="es_sy">
  <div class="es_sy_small">
  	
  	<div class="esxz_qbsy"><img src="/Public/Home/image/zyej.jpg" /></div>
  	<div class="es_sy1">
  	  <div class="es_sy1_box">
  	  	
  	  	
  		<div class="es_sy10 es_lb">
  			<b class="dyxyyd">类别：</b>
  			<div class="es_first">
  			    <span class="es_sy10_dj dyjdj1 "  id="sydy" style="margin-left:-5px;"><a class=" es_sy10_dj qubudi dyjdj_1" href="#">全部</a></span>
  			
	       		<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type_list): $mod = ($i % 2 );++$i;?><span class="dyjdj" id="<?php echo ($type_list["juezhi_brand_id"]); ?>" >
                <a href="#" class="dyjdj_"><?php echo ($type_list["juezhi_brand_name"]); ?></a> 
             </span><?php endforeach; endif; else: echo "" ;endif; ?>
  			</div>

  		</div>
 		
  		<div class="es_sy10 es_qydd">
  			<b class="xyyd"> </b>
  			
  		</div>
  		<div class="es_sy10 es_jg" >
  			<b class="">价格：</b>
  			<span class="es_sy10_dj" onclick="sou_price(0,this)">全部</span>
  			<span onclick="sou_price(1,this)">99元以下</span>
  			<span onclick="sou_price(2,this)">100-499元</span>
  			<span onclick="sou_price(3,this)">500-2999元</span>
  			<span onclick="sou_price(4,this)">3000-4999元</span>
  			<span onclick="sou_price(5,this)">5000-9999元</span>
  			<span onclick="sou_price(6,this)">10000元以上</span>
  		

  		</div>
  		<div class="es_sy10 es_qy">
  			<b class="xyyd">区域：</b>
  			<span class="es_sy10_dj" onclick="sou_address(0,this)">全北京</span>
  			<?php if(is_array($address_list)): $i = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a_list): $mod = ($i % 2 );++$i;?><span onclick="sou_address(<?php echo ($a_list["city_id"]); ?>,this)"><?php echo ($a_list["city_name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
  		</div>
       <div  style="margin-top:10px;">
          <span>当前筛选：</span>
          <span  class="wysbd" style="margin-left:20px;"></span>
       </div>

  </div>
 
  
  	<div class="es_sy2">
  	  <div class="es_sy21">
  	  <!--	<ul class="es_sy210">
  	  		<li class="es_sy2101 es_sy210_dj" onclick="sou_selltype(1,this)">转让</li>
  	  		<li class="es_sy2101" onclick="sou_selltype(2,this)">求购</li>
  	  		<li class="es_sy2101" onclick="sou_selltype(3,this)">餐厅转让</li>
  	  	</ul>-->
  	  	<ul class="es_sy210" style="width:1192px;background-color: #FAFAFA;">
  	  		<li class="es_sy2101 es_sy210_dj" onclick="sou_selltype(1,this)">餐厅二手</li>
  	  		<li class="es_sy2101" onclick="sou_selltype(2,this)">酒店二手</li>
  	  		<li class="es_sy2101" onclick="sou_selltype(3,this)">求购</li>
  	  		<li class="es_sy2101" onclick="sou_selltype(4,this)">餐厅转让</li>
  	  	</ul>
  	  	<ul class="es_sy21_xm">
  	  		<li class="es_sy2_xm es_sy2_xm_dj">默认排序</li>
  	  		<li class="es_sy2_xm" onclick="sou_order(1,this)">价格低到高</li>
  	  		<li class="es_sy2_xm" onclick="sou_order(2,this)">价格高到低</li>
  	  	</ul>
  	  	
  	  	<div class="es_sy211">
  	  	     <iframe id="iframe" name="iframe" style="width: 100%;height:1400px;border: 0 none;" src="<?php echo U('iframe');?>" frameborder="no" scrolling="no"></iframe>
<script type="text/javascript">
	$(".qubudi").click(function(){
		window.location.reload();
	})
//一级
function djydxg(djsl,index){

   for(var j=0;j<$(djsl).length;j++){
           	  if(j==index){
           	  	$(djsl).eq(index).css("color","#ff3800");
           	  }
           	  else{
           	  	$(djsl).eq(j).css("color","#333");
           	  }
        }
}
$(".dyjdj_").each(function(index){

		$(this).mouseenter(function(){
          //给定样式
           
           //djydxg(".dyjdj_",index);
           
           for(var i=0;i<$(".dyjdj_").length;i++){
           	  if(i==index){
                  $(this).css("height","31px").css("border","1px solid #DDDDDD").css("border-bottom","1px solid white");
           	  }
           	  else{
           	  	 $(".dyjdj_").eq(i).css("height","30px").css("border","1px solid #DDDDDD").css("border-bottom","1px solid #DDDDDD");
           	  }
           }




     var idz=$(".dyjdj").eq(index).attr("id");
    if(idz!="sydy"){
			$.post("<?php echo U('Esxz/esxz_choose_fl');?>",{'id':idz , 'type':1 },
				  function( data ){
				  	 //二级分类 
								  var opt='';
									$.each(data.list_two,function(index,value){
				      	  	  opt+='<span class="dejdj" id='+value.juezhi_brand_id+'><a class="dejdj_"  href="#">'+value.juezhi_brand_name+'</a></span>';        
									});
				          $(".eszds").remove();
				          if(data.list_two!=""){
				             var  opt1='<div class="eszds">'+opt+'</div>';
				              $(".dyjdj").eq(index).append(opt1);


				            var jjz=70;
				              jjz=-(index*95+jjz)+"px";
				              $(".eszds").css("left",jjz);
				          }

  	 	  		     sxej();
  	 	  		     
  	 	  		      
  	 	  	     },"json");
    }
   else{
       $(".eszds").remove();
    }
	 
  	 	  	

		})


   
		 $(".dyjdj").eq(index).mouseleave(function(){
                 
		       $(".eszds").remove();
		       $(".dyjdj_").css("border","1px solid #DDDDDD");
		   })
})

  $(".dyjdj_").each(function(index){
     $(this).click(function(){
         var idz=$(".dyjdj").eq(index).attr("id");
         $(".qubudi").css("color","#333");
         $("#typea").val(idz);
           $("#sou").submit();
           $(".wysbd").text($(this).text());
           djydxg(".dyjdj_",index);
           

     })
  })
//二级





function sxej(){

  


	$(".dejdj_").each(function(index){
		$(this).mouseenter(function(){
			djydxg(".dejdj_",index);
    	     var idz=$(".dejdj").eq(index).attr("id");
			$.post("<?php echo U('Esxz/esxz_choose_fl');?>",{'id':idz , 'type':2 },
				  function( data ){
				  	 //二级分类 
             var opt="";
					 $.each(data.list_three,function(index,value){
      	  	           opt+='<span class="sjfld" id='+value.juezhi_brand_id+'>'+value.juezhi_brand_name+'</span>';        
					});
					$(".sszds").remove();
          if(data.list_three!=""){
             var  opt1='<div class="sszds">'+opt+'</div>';
              $(".dejdj").eq(index).append(opt1);
          }
					//$(".es_third").text(null);

                    
                    sxsj();
  	 	  		
  	 	  	     },"json");
  	 	  	     
  	 	  	     
  	 	  	     
  	 	  	  
  	 	  	     
  	 	  	     
		})
		 $(".dyjdj").mouseleave(function(){

		       $(".eszds").remove();
		    })



			     $(this).click(function(){
                     $(".qubudi").css("color","#333");
			         var idz=$(".dejdj").eq(index).attr("id");
			         $("#typea").val(idz);
			           $("#sou").submit();
                  $(".wysbd").text($(this).text());
			           djydxg(".dejdj_",index);
			     })

 })


	
	
}

sxej();



//三级分类

function sxsj(){
	$(".sjfld").each(function(index){
		$(this).click(function(){
    	     var idz=$(this).attr("id");
    	     $("#typea").val(idz);
	         $("#sou").submit(); 
			djydxg(".sjfld",index);
       $(".wysbd").text($(this).text());
  	 	  	$(".qubudi").css("color","#333");
  	 	  	     
		})
		$(this).mouseover(function(){

			djydxg(".sjfld",index);
  	 	  
  	 	  	     
  	 	  	     
		})
	})
	
}

sxsj();


</script> 
  	  		
<script type="text/javascript">
    var txt = 42;//设置留下的字数
     var o = $(".es_sy21_mi2");//id   html 中设置
    var s = o.html();
    var p = document.createElement("span");
    var n = document.createElement("font");
    p.innerHTML = s.substring(0,txt);
    n.innerHTML = s.length > txt ? "..." : "";
    o.innerHTML = "";
    o.appendChild(p);
    o.appendChild(n);
</script>  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  		
  	  	</div>
  	  	
  	  	
  	  </div>
  	  <div class="es_sy22">
  	  	<div class="es_sy220">浏览量最多</div>
  	  	
  	  	<div class="es_sy221">
  	  	<?php if(is_array($watch_max_list)): $i = 0; $__LIST__ = $watch_max_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$w_list): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Esxz/esxz_detil',array('id'=>$w_list['goods_id']));?>" target="_top">
  	  		<div class="es_sy22_1">
  	  			<div>
  	  				<img src="/Public/Home/image/esxz7.jpg">
  	  			</div>
  	  			<div  class="es_sy22_10">
  	  				￥<?php echo ($w_list["goods_deal_price"]); ?>
  	  			</div>
  	  			<div  class="es_sy22_11">
  	  				<?php echo ($w_list["goods_description"]); ?>
  	  			</div>
  	  		</div>
  	  	  </a><?php endforeach; endif; else: echo "" ;endif; ?>
  	  		
  	  	</div>
  	  	
  	  </div>
  	</div>
  	

  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  </div>
</div>

<form method="get" name="sou" id="sou" action="<?php echo U('iframe');?>" target="iframe">
   <input type="hidden" id="leibie" name="leibie" value="0">
   <input type="hidden" id="price" name="price" value="0">
   <input type="hidden" id="area" name="area" value="0">
   <input type="hidden" id="typea" name="typea" value="0">
   <input type="hidden" id="typeb" name="typeb" value="0">
   <input type="hidden" id="typec" name="typec" value="0">
   <input type="hidden" id="search_name" name="search_name" value="0">
   <input type="hidden" id="selltype" name="selltype" value="0"><!-- 1.转让 2.求购 3.餐厅转让 -->
   <input type="hidden" id="price_order" name="price_order" value="0"><!-- 1.价格高到低  2.价格低到高 -->
</form>




<script type="text/javascript">
    $(".header_middle_center_cz1").click(function(){
    	var value=$(".header_middle_center_bd").val();
	    $("#search_name").val(value);
	    $("#sou").submit();
    });
	function sou_typeb(id,e){
		//触发form表单提交数据
	    $("#typeb").val(id);
	    $("#sou").submit();
	}
	function sou_typec(id,e){
		//触发form表单提交数据
	    $("#typec").val(id);
	    $("#sou").submit();
	}

	function sou_order(id,e){
		//触发form表单提交数据
	    $("#price_order").val(id);
	    $("#sou").submit();
	}
    function sou_selltype(id,e){
		//触发form表单提交数据
	    //$(e).addClass("shangchneng-head-listcona");
	    $("#selltype").val(id);
	    $("#sou").submit();
    }
	function sou_address(id,e){
		//触发form表单提交数据
	    //$(e).addClass("shangchneng-head-listcona");
	    $("#area").val(id);
	    $("#sou").submit();
	}
	function sou_price(id,e){
	    //触发form表单提交数据
	    //$(e).addClass("shangchneng-head-listcona");
	    $("#price").val(id);
	    $("#sou").submit();
	}

	
	$(".es_jg span").each(function(index){
		  $(this).click(function(){
		      $(this).addClass("es_sy10_dj");
    	     $(this).siblings().removeClass("es_sy10_dj");
		  });
	});
	$(".es_qy span").each(function(index){
		  $(this).click(function(){
		      $(this).addClass("es_sy10_dj");
    	     $(this).siblings().removeClass("es_sy10_dj");
		  });
	});
//默认排序。价格从高到底点击
$(".es_sy2101").each(function(index){
	
	$(this).mouseover(function(){
			if($(this).is('.es_sy210_dj')){
				$(this).css("color","white");
			}
			else{
				$(this).css("color","#F35224");
			}
	});
	$(this).click(function(){
			$(this).addClass("es_sy210_dj");
			$(this).css("color","white");
			$(this).siblings().removeClass("es_sy210_dj");
			$(this).siblings().css("color","#666666");
	});
	$(this).mouseout(function(){
			if($(this).is('.es_sy210_dj')){
				$(this).css("color","white");
				//alert(index+"--");
			}
			else{
				$(this).css("color","#666666");
			}
	});
});

$(".es_sy2_xm").each(function(index){
   $(this).click(function(){
   	$(this).addClass("es_sy2_xm_dj");
   	$(this).siblings().removeClass("es_sy2_xm_dj");
   })
})
if($(".es_sy21").height()>$(".es_sy22").height()){
	$(".es_sy22").css("height",$(".es_sy21").height()-40).css("background","white");
}
else{
	$(".es_sy21").css("height",parseInt($(".es_sy22").height())+40).css("background","white");
}
//alert($(".es_sy21").height()+"--"+$(".es_sy22").height())

</script>
<?php echo W('Common/footer_esxz');?>