<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header');?>
<style type="text/css">
	.header_middle_center_cz1{
		width:60px;
        height:32px;
        background-color:#1F61C3;
        text-align: center;
        line-height:32px;
        margin-left:-60px;
        margin-top:0px;
        color:white;
	}
	.header_middle_center{
      width:325px;
      overflow:hidden;
      float:left;
      /*margin-left:553px;*/
      position: absolute;
      left:68.8%;
	}
	.header_middle_center_bd{
      border-radius: 0px;
	}
	.fbxi{
		width:100px;
		height:35px;
		font-size:14px;
		text-align:center;
		line-height:35px;
		margin-top:20px;
		margin-left:40px; 
		background-color:#1F61C3;
		float:left;
	}
	.fbxi a{
		color:white;
	}
	.dyjfl_:hover{
		color:#1F61C3;
	}
</style>
<title><?php echo ($setTitle); ?></title>
  <div class="header_box1" style="background-color:#FAFAFA;top:0px;">
		<div class="header_middle">
			    <div class="header_zulin_left">
			    	魄力共享&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<?php echo ($city); ?>租赁&nbsp;&nbsp;&nbsp;
			    		<?php if(empty($share_product_search)): ?><span style="color:#a5abb2;"></span>
			    		<?php else: ?>
			    			>&nbsp;&nbsp;&nbsp;<span style="color:#a5abb2;"><?php echo ($share_product_search); ?></span><?php endif; ?>
			    		<?php if(empty($classify_font)): ?><span style="color:#a5abb2;"></span>
			    		<?php else: ?>
			    			>&nbsp;&nbsp;&nbsp;<span style="color:#a5abb2;"><?php echo ($classify_font); ?></span><?php endif; ?>
			    </div>
				<div class="header_middle_center">
					<input type="text" name="share_product_search" class="header_middle_center_bd" placeholder=" 请输入关键字" value="<?php echo ($share_product_search); ?>"/>
					<div class="header_middle_center_cz1" onclick="ImgSubmit();">
						<!-- <img src="/Public/Home/image/header_top27.png"/> -->搜索
					</div>
				</div>
 
   
				<div class="fbxi" style="display: none;">
					<?php if(($loguser['plgox_id'] == '' )): ?><a href="<?php echo U('Tourist/login');?>" >
                            租赁发布
                      </a>
					 <?php elseif(($sjrz_renzheng['plgox_usertype'] == 4 )): ?>
					  <a href='<?php echo U('Homeuser/fabu_zuling');?>'">
                     租赁发布</a>

					<?php else: ?>
					 <a class="sjzx_rz" href="#"  >
                       租赁发布 
                     </a><?php endif; ?>
				</div>

		</div>
	</div>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/base_64.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/zulin.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css">

<style>

</style>
<!---->
<input type="hidden" id="fenlei_ts" value="<?php echo ($fenlei); ?>" />
<input type="hidden" id="zujin_ts"  value="<?php echo ($zujin); ?>" />
<div class="dd_js" style="background-color:#FAFAFA;">
	<div class="dd_js_box">
		
	  	<div class="zulin1">
	  		<img src="/Public/Home/image/zulin.jpg" />
	  	</div>
	</div>

	
	<div class="zulin2">
	  <div class="zulin3">
		<div class="zulin5">
			商品筛选
		</div>
		
  	   <div class="es_sy10 es_lb">
  		 <div class="zulin50">
  			<b>供选分类：</b>
  			<!-- onclick="fenlei(<?php echo ($yijifenlei_['classify_id']); ?>)"  -->
  		</div>
  		 <div class="zulin51">
  		 	<span  onclick="fenlei(0);">不限</span>
  		 	<?php if(is_array($yijifenlei)): $i = 0; $__LIST__ = $yijifenlei;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$yijifenlei_): $mod = ($i % 2 );++$i;?><span  class="dyjfl" value="<?php echo ($yijifenlei_['classify_id']); ?>"><a  class="dyjfl_" href="#"><?php echo ($yijifenlei_['classify_title']); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
  		  </div>
  		</div>
  		
<script type="text/javascript">
 function djydxg(djsl,index){
       
		   for(var j=0;j<$(djsl).length;j++){
		           	  if(j==index){
		           	  	$(djsl).eq(index).css("color","#1f61c3");
		           	  }
		           	  else{
		           	  	$(djsl).eq(j).css("color","#333");
		           	  }
		        }
		}


$(".dyjfl_").each(function(index){
       
		$(this).mouseenter(function(){
			//djydxg(".dyjfl_",index);
             var idz=$(".dyjfl").eq(index).attr("value");
                         for(var i=0;i<$(".dyjfl_").length;i++){
			           	  if(i==index){
			                  $(this).css("height","31px").css("border","1px solid #DDDDDD").css("border-bottom","1px solid white");
			           	  }
			           	  else{
			           	  	 $(".dyjfl_").eq(i).css("height","30px").css("border","1px solid #DDDDDD").css("border-bottom","1px solid #DDDDDD");
			           	  }
			           }
                $.post("<?php echo U('Homeuser/fu_zfl');?>",{'id':idz , 'type':1 },
                  function( data ){

			            var opt='';
			            $.each(data.list_two,function(index,value){
			      	  	  opt+='<span class="dejdj"   value='+value.classify_id+'><a  class="dejdj_" href="#">'+value.classify_title+'</a></span>';

						});

                      $(".eszds").remove();
			          if(data.list_two!=""){
			             var  opt1='<div class="eszds">'+opt+'</div>';
			              $(".dyjfl").eq(index).append(opt1);

			              var jjz=112;
				              jjz=-(index*110+jjz)+"px";
				              $(".eszds").css("left",jjz);

			          }

                      sxej();

						
                  
                  },"json"); 
        })

			
      $(".dyjfl").eq(index).mouseleave(function(){
                 
		       $(".eszds").remove();
		       $(".dyjfl_").css("border","1px solid #DDDDDD");
		   })
        $(this).click(function(){

        	var idz=$(".dyjfl").eq(index).attr("value");
        	$("#fenlei").val(idz);
		    $("#search").submit();
            $(".zulin511").eq(0).text($(this).html());

        })
   
})




function sxej(){
	$(".dejdj_").each(function(index){
		$(this).mouseenter(function(){
			djydxg(".dejdj_",index);
    	     var idz=$(".dejdj").eq(index).attr("value");
			$.post("<?php echo U('Homeuser/fu_zfl');?>",{'id':idz , 'type':2 },
		 function( data ){
				  	 //二级分类 
             var opt="";
			$.each(data.list_three,function(index,value){
	      	  	  opt+='<span class="sjfld"  value='+value.classify_id+'>'+value.classify_title+'</span>';

			});
		 $(".sszds").remove();
          if(data.list_three!=""){
             var  opt1='<div class="sszds">'+opt+'</div>';
              $(".dejdj").eq(index).append(opt1);
          }
              	sxsj();
  	 	  		
  	 },"json");
  	 	  	     
  	 	  	     
  	 	  
  	 	  	  
  	 	  	     
  	 	  	     
		})

        $(this).click(function(){
        	var idz=$(".dejdj").eq(index).attr("value");
        	$("#fenlei").val(idz);
		    $("#search").submit();
            $(".zulin511").eq(0).text($(this).html());

        })




		 // $(".dejdj").eq(index).mouseleave(function(){

		 //       $(".eszds").remove();
		 //    })



 })	
	
}

function sxsj(){

    $(".sjfld").each(function(index){
    	$(this).click(function(){
    		var idz=$(".sjfld").eq(index).attr("value");
        	$("#fenlei").val(idz);
		    $("#search").submit();
            

    	})
    	
    })
	
}

sxsj();
 </script> 
  		 
  		<div class="es_sy10 es_jg">
  		  <div class="zulin50">
  			<b>日租金：</b>
  			
  		 </div>
  		 <div class="zulin51">
  		 	<span  onclick="zujin(0);">不限</span>
  		 	<?php if(is_array($filter)): $i = 0; $__LIST__ = $filter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$filter_): $mod = ($i % 2 );++$i;?><span value="<?php echo ($filter_['filter_id']); ?>" class="zjy" onclick="zujin(<?php echo ($filter_['filter_id']); ?>);"><?php echo ($filter_['filter_content']); ?>元</span><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
  		</div>
  		
		<div class="es_sy10">
  		  <div class="zulin50 zulin_50">
  			<b style="float:left;">当前筛选:</b>
  			<!-- <span class="zulin_cz">重置</span> -->
  		 </div>
  		 
  		 <div class="zulin51 zulin5_1">
  
  			<div class="zulin510">
  				<div class="zulin511"><?php echo ($classify_font); ?></div>
  				<div class="zulin512">×</div>
  			</div>
  			
  			<div class="zulin510">
  				<div class="zulin511"></div>
  				<div class="zulin512">×</div>
  			</div>
  			
			<div  class="zilin_zdsp">
  				 <span>共为您找到<a class="zulin_gs"><?php echo ($share_count); ?></a>个商品</span>
            </div>
               
                
          </div>
  		</div>
		
		
		<div class="zulin7" id="001">
  		  <div class="zulin70">
  			<span class="zulin701" style="color:#1f61c3;margin-left:15px;" onclick="defaults();">默认排序&nbsp;</span>
  			<img class="zulin702" src="/Public/Home/image/zulin3.png" />
  			<img class="zulin703" src="/Public/Home/image/zulin4.png" />
          </div>
          
           <div class="zulin70">
  			<span class="zulin701" onclick="orders(1);">租金低到高&nbsp;</span>
  			<img class="zulin702" src="/Public/Home/image/zulin1.png" />
          </div>
          
          <div class="zulin70">
  			<span class="zulin701" onclick="orders(2);">租金高到低&nbsp;</span>
  			<img class="zulin702" src="/Public/Home/image/zulin.png" />
          </div>
          
          <div class="zulin70">
  			<span class="zulin701" onclick="orders(3);">满意度高低</span>
          </div>
           <div class="zulin70">
  			<span class="zulin701" onclick="orders(4);">出租率高低</span>
          </div>
          
  		</div>
		
		
  		<div class="zulin_box_big">
		<ul class="zulin8" >
			<?php echo ($shop_info); ?>
<!-- 		<@volist name="share" id="share_">
			<li class="zulin81" >
			  <a href="<?php echo U('Cart/shop_detil',array('id'=>$share_['share_id']));?>">
				<div  class="zulin82">
					<img src="/Uploads/admin/<?php echo ($share_['share_home_img']); ?>" />
				</div>
				<div  class="zulin83">
					<div class="zulin831"><?php echo ($share_['share_name']); ?></div>
				</div>
				<div  class="zulin85">
							<span class="zulin851">
								¥<?php echo ($specifications_rent); ?>/天
							</span>
				</div>
				<div class="in_center1228">
	             	<div class="in_center12281">
	             		<span class="incenter_12_hs">满意度：</span>
	             		<span class="incenter_12_zs"><?php echo ($share_['share_satisfaction']); ?>%</span>
	             	</div>
	             	<div class="in_center12282">
	             		<span class="incenter_12_hs">出租率：</span>
	             		<span class="incenter_12_zs"><?php echo ($share_['share_chuzhu']); ?>次</span>
	             	</div>
                </div>
			  </a>
			<li>
		<@/volist>	 -->
		</ul>
	<div class="message" >
      <?php echo ($page); ?>
     </div>
  </div>
		<!--<iframe frameborder="0" name="iframe" id="dkz_box" style="width:1192px;height:100%;overflow:hidden;" scrolling="no" src="<?php echo U('Zulin/iframe');?>"></iframe>-->
	  </div>
	</div>

	
<!--	<form action="<?php echo U('Zulin/shaixuan');?>" id="search" method="get">
		<input type="hidden" name="fenlei" id="fenlei" value="<?php echo ($fenlei); ?>">
		<input type="hidden" name="zujin" id="zujin" value="<?php echo ($zujin); ?>">
		<input type="hidden" name="share_product_search" id="share_product_search">
	</form>	-->
	<input type="hidden" id="ordersw" value="<?php echo ($ordersy); ?>" />
</div>
  <?php echo W('Common/header1_search');?> 	
   <script src="/Public/Home/js/syrztk.js"></script> 
<script type="text/javascript">
/*	$(window).scrollTop(188);*/
 //企业认证
   qyrenzhe("<?php echo ($is_sjrz); ?>");
//让iframe自适应
$("#dkz_box").load(function () {
    var mainheight = $(this).contents().find("body").height() + 30;
    $(this).height(mainheight);
});


	
 $(".zulin510").css("display","inline-bolck");
	$(".es_lb span").each(function(index){
		  if($(this).attr('value')==$("#fenlei_ts").val()){
		  	 $(this).addClass("es_sy10_dj");
		  	 $(".zulin510").eq(0).css("display","inline-block");
		  	// $(".zulin511").eq(0).text($(this).text());
		  }
		  if($("#fenlei_ts").val()=='' || $("#fenlei_ts").val()==0){
		  	$(".es_lb span").eq(0).addClass("es_sy10_dj");
		  	 $(".zulin510").eq(0).css("display","none");
		  }
		  	 
		  
	});
	$(".es_jg span").each(function(index){
		  if($(this).attr('value')==$("#zujin_ts").val()){
		  	 $(this).addClass("es_sy10_dj");
		  	 $(".zulin510").eq(1).css("display","inline-block");
		  	 $(".zulin511").eq(1).text($(this).text());
		  }
		  if($("#zujin_ts").val()=='' || $("#zujin_ts").val()==0){
		  	$(".es_jg span").eq(0).addClass("es_sy10_dj");
		  	 $(".zulin510").eq(1).css("display","none");
		  }
	});
	
	//点击删除
	$(".zulin512").each(function(index){
		$(this).click(function(){
			$(".zulin510").eq(index).css("display","none");
		})
	})
	
	//重置
	$(".zulin_cz").click(function(){
		window.location.href="/Zulin/zulin.html";
		/*$(".zulin510").css("display","none");
		//让第一个为选中状态
		//分类
		$(".es_lb span").eq(1).addClass("es_sy10_dj");
		$(".es_lb span").eq(1).siblings().removeClass("es_sy10_dj");
		                     
		//租金范围
		$(".es_jg span").eq(1).addClass("es_sy10_dj");
		$(".es_jg span").eq(1).siblings().removeClass("es_sy10_dj");*/
	})

	if($("#ordersw").val()==1){
			$(".zulin702").eq(1).attr("src","/Public/Home/image/zulin3.png");
				$(".zulin701").eq(1).css("color","#1f61c3");
				$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
	}
	else if(($("#ordersw").val()==2)){
		$(".zulin702").eq(2).attr("src","/Public/Home/image/zulin4.png");
		$(".zulin701").eq(2).css("color","#1f61c3");
		$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
	}
	//点击下面默认从低到高。。。
	$(".zulin70").each(function(index){
		$(this).click(function(){
			if(index==0){
				$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin3.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin4.png");
				$(".zulin701").eq(0).css("color","#1f61c3");
				
				$(".zulin702").eq(1).attr("src","/Public/Home/image/zulin1.png");
	           $(".zulin701").eq(1).css("color","#666666");
	           
	           $(".zulin702").eq(2).attr("src","/Public/Home/image/zulin.png");
	           $(".zulin701").eq(2).css("color","#666666");
	           $(".zulin701").eq(3).css("color","#666666");
	           $(".zulin701").eq(4).css("color","#666666");
				
			}
			else if(index==1){

			}
			else if(index==2){
				
				
				$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
				
				$(".zulin702").eq(1).attr("src","/Public/Home/image/zulin1.png");
	           $(".zulin701").eq(1).css("color","#666666");
	           $(".zulin701").eq(3).css("color","#666666");
	           $(".zulin701").eq(4).css("color","#666666");
			}
			else if(index==3){
				$(".zulin701").eq(3).css("color","#1f61c3");
				
				$(".zulin702").eq(2).attr("src","/Public/Home/image/zulin.png");
	           $(".zulin701").eq(2).css("color","#666666");
				$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
				
				$(".zulin702").eq(1).attr("src","/Public/Home/image/zulin1.png");
	           $(".zulin701").eq(1).css("color","#666666");
	           $(".zulin701").eq(4).css("color","#666666");
			}
			else if(index==4){
				$(".zulin701").eq(4).css("color","#1f61c3");
				
				$(".zulin702").eq(2).attr("src","/Public/Home/image/zulin.png");
	           $(".zulin701").eq(2).css("color","#666666");
				$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
				
				$(".zulin702").eq(1).attr("src","/Public/Home/image/zulin1.png");
	           $(".zulin701").eq(1).css("color","#666666");
	           $(".zulin701").eq(3).css("color","#666666");
			}
		})
	});
	// 异步请求
	function fenlei(id){
		$("#fenlei").val(id);
		$("#search").submit();
	}
	function zujin(id){
		$("#zujin").val(id);
		$("#search").submit();
	
	}
	/*$(".header_middle_center_cz").click(function(){
		alert($(".header_middle_center_bd").val());
	});*/
	
	
/*	function orders(id){
		if( id == 1 ){
			window.location.href="/Zulin/share_list?order1=1"+Math.random();
			$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
		}else if( id == 2 ){
			window.location.href="/Zulin/share_list?order2=2"+Math.random();
			$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
		}else if( id == 3 ){

			$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
		}else if( id == 4 ){

			$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin1.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin.png");
				$(".zulin701").eq(0).css("color","#666666");
		}
	}*/
	function defaults(){
		$(".zulin702").eq(0).attr("src","/Public/Home/image/zulin3.png");
				$(".zulin703").eq(0).attr("src","/Public/Home/image/zulin4.png");
				$(".zulin701").eq(0).css("color","#1f61c3");
		window.location.href="/Zulin/shaixuan?defaults=3"+Math.random();
	}




$(".header_bottom1_middle li").eq(1).siblings().removeClass("header_dj");
 $(".header_bottom1_middle li").eq(1).addClass("header_dj");
</script>

<br/><br/>
<?php echo W('Common/footer');?>