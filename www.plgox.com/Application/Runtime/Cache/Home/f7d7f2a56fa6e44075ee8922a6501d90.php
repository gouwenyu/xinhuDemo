<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header');?>
<title><?php echo ($setTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/dingdan_jiesuan.css">
<br/><br/>
<div class="dd_js">
	<div class="dd_js_box">
        
          <div class="gouw_1">
            所在位置：    首页  > <span>租赁车</span>
           </div>
           <br />
           <br />
			<table class="dd_js11" style="margin-top:0px;">
			  <thead>
			    <tr>
			      <th>选择</th>
			      <th>商品信息</th>
			      <th>起租天数</th>
			      <th>单价</th>
			      <!--<th>押金</th-->
			      <th>数量</th>
			      <th>小结</th>
			      <th>结算操作</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php if(is_array($cart)): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart_): $mod = ($i % 2 );++$i; if(( $cart_['cart_radio_status'] == 1 ) or ( $cart_['cart_id']) == null ): ?><tr class="remove_data_<?php echo ($cart_['cart_id']); ?>">
			      <td>
					<input type="checkbox" value="<?php echo ($cart_['cart_id']); ?>" name="choose[]" class="input_checked_ xztp" />
			      </td>
			      <td class="dd_js1110" style="width:395px;cursor:pointer;">
			      	<a href="<?php echo U('Cart/shop_detil',array('id'=>$cart_['share_id']));?>"><img src="/Uploads/admin/<?php echo ($cart_['specifications_img']); ?>" style="width:130px;height:120px;" /></a>
			      	<div class="dd_js11101">
			      		<span>
			      			<?php echo ($cart_['share_name']); ?>-<?php echo ($cart_['specifications_name']); ?><br />
			      			<?php echo ($cart_['share_key']); ?>
			      		</span>
			      	</div>	
			      </td>
			       <td ><?php echo ($cart_['zulin_day_number']); ?>天</td>
			     <!-- <td><?php echo ($cart_['specifications_name']); ?></td>-->
			      <td style="text-align:left;padding-left:50px;">
			      	  <div>
			      	  	<span class="qmkdz" >日租金：</span>
			      	  	<span>¥</span>
			      	  	<span class="gwx_yj"><?php echo ($cart_['specifications_rent']); ?></span>
			      	  </div>
			      	  <div style="margin-top:10px;">
			      	  	<span  class="qmkdz" >信用金：</span>
			      	  	<span>¥</span>
			      	  	<span class="gwx_yj sfxyj"></span>
			      	  	<span style="color:red;margin-left:5px;">(即押金的10%)</span>
			      	  </div>
			      	  	
			      	  <div style="margin-top:10px;">
			      	  	<span  class="qmkdz" >押金：</span>
			      	  	<span>¥</span>
			      	  	<span class="gwx_yj zdxyj" ><?php echo ($cart_['specifications_deposit']); ?></span>
			      	  </div>
			      </td>
			     
			       <td >
			         <div class="gouw_10">
                      <span class="gouw_js" value="<?php echo ($cart_['cart_id']); ?>"></span>
                      <input type="text" class="gouw_xsk" value="<?php echo ($cart_['cart_number']); ?>" name="gouw_xsk" />
                      <span class="gouw_zd" value="<?php echo ($cart_['cart_id']); ?>"></span>
                     </div>
			      </td>
			        <td style="text-align:left;padding-left:50px;">
			        		
			          <div>
			      	  	<span  class="qmkdz" >日租金：</span>
			      	  	<span>¥</span>
			      	  	<span class="rent"></span>
			      	  </div>
			      	  <div style="margin-top:10px;">
			      	  	<span class="qmkdz" >信用金：</span>
			      	  	<span>¥</span>
			      	  	<span class="sfzdxyj"></span>
			      	  	<span style="color:red;margin-left:5px;">(即押金的10%)</span>
			      	  </div>
			      	  <div style="margin-top:10px;">
			      	  	<span class="qmkdz" >押金：</span>
			      	  	<span>¥</span>
			      	  	<span class="xjxyj"></span>
			      	  </div>
			      	</td>
			      	<td class="caozuo" style="width:80px;">
			      	  <a href="javascript:void(0);" style="font-weight: bold;color:black;">租赁</a><br /><br />
					  <a href="javascript:void(0);" class="product_cart" value="<?php echo ($cart_['cart_id']); ?>" attr-status="2" style="font-weight:bold;color:red;">添加到购买</a><br />
					  <br />
					  <a href="javascript:void(0);" class="cart_del scbjt" value="<?php echo ($cart_['cart_id']); ?>">删除</a>
			      	</td>
			    </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			    <?php if(( $cart_['cart_radio_status'] == 2 ) or ( $cart_['cart_id']) == null ): ?><tr>
		    			<td colspan="7">租赁车空空如也～～～！</td>
					</tr><?php endif; ?>
			  </tbody>
			</table>
		<script type="text/javascript">
			// $.post("<?php echo U('AjaxXyj');?>",{ "get_xyj_status": 1 },function( data ){
				$(".sfxyj").each(function(index){

					$(this).text((parseFloat($(".zdxyj").eq(index).text())*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2));
				});
			// },"json");
		</script>	
     <div class="gouw2">
        <div class="zhuce_jsxy1">
        <div id="checkbox">
        		<label>
		    		  <input type="checkbox"  class="quanxuan_box"/>
		      		   <span class="xzan" style="font-weight:normal;">全选</span>            			
        		</label>
        </div>
      	</div>
      	<div class="zhuce_jsxy1">
      		<div id="checkbox">
      			<label>
	     		   <input type="checkbox"  class="fanxuan_box"/>
	      		   <span  class="xzan" style="font-weight:normal;">反选</span>      				
      			</label>
      		</div>
      	</div>
  		<div class="zhuce_jsxy2">
  		 <span class="gouw21 caozuo">删除选中商品</span>
  		 <span class="gouw21 caozuo">清空租赁车</span>
  		</div>
     </div>
     <br />
     <br />
     <div style="height:90px;background-color:#4B0082">
	     <div style="float:left;margin-top:10px;color:#FFFFFF;margin-left:2%;">已选择商品 <span style="color:#FFFFFF;" class="spjs"><?php echo ($cart_count); ?></span> 件</div> 
	     <div style="float:left;margin-left:5%;margin-top:10px;color:#FFFFFF;">日租金&nbsp;&nbsp;&nbsp;： <span>¥</span><span  class="mrzj">0</span></div> 
	     <div style="float:left;margin-left:5%;margin-top:10px;color:#FFFFFF;">信用金： <span>¥</span><span  class="sfdxdzd">0</span><span style="color:#1F61C3;">&nbsp;&nbsp;</span></div>
	     <div style="float:left;margin-left:5%;margin-top:10px;color:#FFFFFF;">未付押金： <span>¥</span><span  class="gjyj">0</span></div>
	     <div style="float:right;color:#FFFFFF;margin-top:10px;position: relative;right:4%;">总支付信用金： <span>¥</span><span  class="sfdxdzd">0</span></div> 
	     <br />
	     <div style="border:3px solid #FFFFFF;float:right;position: relative;left:8%;width:200px;height:40px;line-height:35px;background-color:#4B0082;font-size:16px;text-align: center;color:#FFFFFF;" class="gouw310">租赁结算</div>
     </div>
   <script type="text/javascript">
   </script>
        
	</div> 
</div>
  <?php echo W('Common/header1_search');?> 
<!--遮罩-->
<div class="zhezhao" style="display:none;">
	<div class="zz_nr_scdz" style="display:none;">
	  <div class="zz_nr1">
		<span class="wxts">温馨提示<span>
		<span class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:146px;height:146px;display:block;font-size:18px;"></div>
	 
	  <div class="zz_nr3" >
			<a href="#wss" class="qrsc">确认</a>
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
<br/><br/>
<script type="text/javascript">
$(".product_cart").click(function(){
	var cart_id = $(this).attr("value");
	var font_content = $(this).text();
	var a = "您确定要将该商品"+font_content+"车吗？";
	var status = $(this).attr("attr-status");
	// 您确定要将该商品
	if( confirm(a) ){
		$.post("<?php echo U('AjaxCart_status');?>",{ cart_id:cart_id , status:status },function( data ){
			console.log(data);
			if( data.status == 2000 ){
				alert(data.message);
				location.reload();
				return false;
			}else if( data.status == -2000 ){
				alert(data.message);
				return false;
			}
		},"json");
	}
});
$(function(){	
  var dsq="";
  $(document).ready(function(){
  	// 租赁
	  $(".input_checked_").each(function( index ){
	  	$.post("<?php echo U('Cart/ajaxData');?>",{'cart_ids':$(this).val()},function( data ){
	  		var cou_sl=$(".gouw_xsk").eq(index).val();
	  		$(".rent").eq(index).html(data['cart_rent']);
	  		$(".xjxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl).toFixed(2));
	  		$(".sfzdxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2));
	  		// $(".csj_").eq(index).html(data['cart_prices']);
	  			//共计押金
 			  var zyj=0;
			  for(var j=0;j<$(".xjxyj").length;j++){
			  	 zyj+=parseFloat($(".xjxyj").eq(j).text());

			  }
			  zyj=zyj;
			  var yzzyj=(zyj*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
			  $(".gjyj").text(parseFloat(zyj*0.9).toFixed(2));
              $(".sfdxdzd").text(yzzyj);

              var zdqs=parseFloat($(".mrzj").text())+parseFloat(yzzyj);
              var qtqs=zdqs.toFixed(2);
              $(".xyzfdq").text(qtqs);
	  	},"json");
	  });
	 //共计押金 
	  //默认全选
	$(".quanxuan_box").prop("checked", true);
	$(".fanxuan_box").prop("checked", false);
   $(".xztp:checkbox").prop("checked", true);  
	var cart_id = "";
	$(".input_checked_").each(function( index ){
		if( $(this).is(":checked")){
			cart_id += ','+$(this).val();
		}
	});
	
	var cart_id = cart_id.substring(1);
	$.ajax({
		type: "post",
	dateType: "json",
	   async: false,
		 url: "<?php echo U('Cart/AjaxCount');?>",
		data: {'cart_id':cart_id},
	 success: function( data ){
	 	var sum = "";
	 	var count ="";
	 	$.each(data,function( index , value ){
	 		sum +=','+value['cart_rent'];
	 		count+= ','+value['cart_id'];
	 	});
	 	sum_rent = sum.substring(1);
	 	var str_arr = sum_rent.split(",");
	 	var arr1 = new Array();
		$.each(str_arr,function(k,v){
		    arr1.push(v);
		});
		var jgz=parseFloat(0);
	 	for(var i=0;i<arr1.length;i++){
	 		jgz+=parseFloat(arr1[i]);
	 	}
	 	$(".mrzj").text(jgz.toFixed(2));

	 },
	 error: function( XMLHttpRequest , status , error ){
	 	tkcx("出现错误,错误原因是："+status);
	 	return false;
	 }
	});
  });
  // 改变数量文本框的值 change
  $(".gouw_xsk").each(function(index){
  	 $(this).change(function(){
  	 	$(".input_checked_").eq(index).each(function(){
  	 		// 内容
  	 	  	var text_number = $(".gouw_xsk").eq(index).val();
  	 	  	// id
  	 	  	var carts_ids = $(this).val();
  	 	  	$.post("<?php echo U('Cart/cart_numer');?>",{'carts_ids':carts_ids , 'text_number':text_number , 'text_number1':text_number },function( data ){
  	 	  		var before_zj=$(".rent").eq(index).html();
  	 	  		
  	 	  		$(".rent").eq(index).html(data['cart_rent']);

  	 	  		var cou_sl=$(".gouw_xsk").eq(index).val();
			  	$(".rent").eq(index).html(data['cart_rent']);
			  	$(".xjxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl).toFixed(2));
			  	$(".sfzdxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2));
 			  	// $(".csj_").eq(index).html(data['cart_prices']);

  	 	  		var after_zj=$(".rent").eq(index).html();
  	 	  		var cj=after_zj-before_zj;
  	 	  		var zzj=parseFloat($(".mrzj").text());
  	 	  		if($(".xztp").eq(index).is(":checked")){
  	 	  			var zjg=parseFloat(zzj+cj).toFixed(2);
		            $(".mrzj").text(zjg);
		            
		         }


  	 	  				//共计押金
  	 	  		var zyj=0;
 			  var zyjjs=0;
 			  var mrzuj=0;
	   for(var j=0;j<$(".xztp").length;j++){
	   	   if($(".xztp").eq(j).is(":checked")){
			  	 zyj+=parseFloat($(".sfzdxyj").eq(j).text());
			  	 zyjjs+=parseFloat($(".xjxyj").eq(j).text());
			  	 mrzuj+=parseFloat($(".rent").eq(j).text());
            }
	    }
        $(".sfdxdzd").text(zyj.toFixed(2));
        $(".gjyj").text((zyjjs-zyj).toFixed(2));
        //每日租金
	    $(".mrzj").text(mrzuj.toFixed(2));




  	 	  		if( $(".gouw_xsk").eq(index).val() <= 0 ){
  	 	  			$(".gouw_xsk").eq(index).val("1");
  	 	  			return false;
  	 	  		}else if($(".gouw_xsk").eq(index).val() >= parseFloat(data['specifications_stock']) ){
  	 	  			$(".gouw_xsk").eq(index).val(parseFloat(data['specifications_stock']));
  	 	  			return false;
  	 	  		}
  	 	  	},"json");
  	 	  
  	 	  	
  	 	  	
  		});
  	 });
  });
  // 租赁购物车减少和增大
$(".gouw_js").each(function(index){
	$(this).click(function(){
		var cart_ids = $(this).attr("value");
		$.post("<?php echo U('Cart/cart_numer');?>",{'cart_ids':cart_ids},function( data ){
			  $(".input_checked_").each(function( index ){
			  	$.post("<?php echo U('Cart/ajaxData');?>",{'cart_ids':$(this).val()},function( data ){
			  		$(".rent").eq(index).text(data['cart_rent']);
			  	    var cou_sl=$(".gouw_xsk").eq(index).val();
			  		$(".rent").eq(index).html(data['cart_rent']);
			  		$(".xjxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl).toFixed(2));
			  		$(".sfzdxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2));
			  		// $(".csj_").eq(index).html(data['cart_prices']);

			  	  	//共计押金

 			  var zyj=0;
 			  var zyjjs=0;
 			  var mrzuj=0;
	   for(var j=0;j<$(".xztp").length;j++){
	   	   if($(".xztp").eq(j).is(":checked")){
			  	 zyj+=parseFloat($(".sfzdxyj").eq(j).text());
			  	 zyjjs+=parseFloat($(".xjxyj").eq(j).text());
			  	 mrzuj+=parseFloat($(".rent").eq(j).text());
            }
	    }
        $(".sfdxdzd").text(zyj.toFixed(2));
        $(".gjyj").text((zyjjs-zyj).toFixed(2));
        //每日租金
	    $(".mrzj").text(mrzuj.toFixed(2));
			  /*zyj=zyj.toFixed(2);
	          zfzf=zfzf.toFixed(2);
			  var yzzyj=(zyj*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
			  //未付押金
			  $(".gjyj").text(zyj);
			  
			  //信用金
              $(".sfdxdzd").text(yzzyj);
              var zdqs=parseFloat($(".mrzj").text())+parseFloat(yzzyj);
              var qtqs=zdqs.toFixed(2);
              $(".xyzfdq").text(qtqs);
*/



					
			  	},"json");
			  });
			var gwz=$(".gouw_xsk").eq(index).val();
			if($(".gouw_xsk").eq(index).val()< 2){
				$(".gouw_xsk").eq(index).val(1);
			}
			else{
				var zhz=parseFloat(gwz);
				var jg=--zhz;
				$(".gouw_xsk").eq(index).val(jg);
				
				
			}


		      
				
				
			
		},"json");
		
		
	});
});
$(".gouw_zd").each(function(index){
	$(this).click(function(){		
		var cart_id = $(this).attr("value");
		$.post("<?php echo U('Cart/cart_numer');?>",{'cart_id':cart_id },function( data ){
			$(".input_checked_").each(function( index ){
			  	$.post("<?php echo U('Cart/ajaxData');?>",{'cart_ids':$(this).val()},function( data ){
			  		$(".rent").eq(index).html(data['cart_rent']);
			  		var cou_sl=$(".gouw_xsk").eq(index).val();
				  	$(".rent").eq(index).html(data['cart_rent']);
				  	$(".xjxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl).toFixed(2));
				  	$(".sfzdxyj").eq(index).html(parseFloat(data['cart_deposit']*cou_sl*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2));
				  	// $(".csj_").eq(index).html(data['cart_prices']);

				  		  	//共计押金

 			  /*var zyj=0;
 			  var zfzf=0;
			  for(var j=0;j<$(".xjxyj").length;j++){
			  	 zyj+=parseFloat($(".xjxyj").eq(j).text());
			  	 zfzf+=parseFloat($(".rent").eq(j).text());

			  }
			  zyj=zyj.toFixed(2);
	          zfzf=zfzf.toFixed(2);
			  var yzzyj=(zyj*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
			  $(".gjyj").text(zyj);
			  $(".mrzj").text(zfzf);
              $(".sfdxdzd").text(yzzyj);
              var zdqs=parseFloat($(".mrzj").text())+parseFloat(yzzyj);
              var qtqs=zdqs.toFixed(2);
              $(".xyzfdq").text(qtqs);
 			*/


 			 var zyj=0;
 			  var zyjjs=0;
 			  var mrzuj=0;
	   for(var j=0;j<$(".xztp").length;j++){
	   	   if($(".xztp").eq(j).is(":checked")){
			  	 zyj+=parseFloat($(".sfzdxyj").eq(j).text());
			  	 zyjjs+=parseFloat($(".xjxyj").eq(j).text());
			  	 mrzuj+=parseFloat($(".rent").eq(j).text());
            }
	    }
        $(".sfdxdzd").text(zyj.toFixed(2));
        $(".gjyj").text((zyjjs-zyj).toFixed(2));
        //每日租金
	    $(".mrzj").text(mrzuj.toFixed(2));



			  	},"json");
			  });

       


              

			var gwz=$(".gouw_xsk").eq(index).val();
			if($(".gouw_xsk").eq(index).val()>= parseFloat(data['specifications_stock'])){
				$(".gouw_xsk").eq(index).val(parseFloat(data['specifications_stock']));
			
				tkcx("当前数量已经是最大库存量了!");
				return false;
			}
			else{
				var zhz=parseFloat(gwz);
				var jg=++zhz;
				$(".gouw_xsk").eq(index).val(jg);	
			}
			
		
			   
			
			
			
			
		},"json");
		
		
        
        
	});	
})	
// 租赁
$(".gouw310").click(function(){
	var id_ = "";
	$(".input_checked_").each(function( index ){
		if( $(this).is(":checked") ){
			id_+=","+$(this).val();
		}
	});
	var_id_ = id_.substring(1);
	cart_id_ = var_id_.split(",");
	var cart_id ="";
	$(".input_checked_").each(function( index ){
		if( $(this).is(":checked")){
			cart_id += ','+$(this).val();
		}
	});
	var cart_id = cart_id.substring(1);
	if( cart_id.length == 0){
		tkcx("请勾选您的商品!");
		return false;
	}else{
		window.location.href="<?php echo U('Cart/dingdan_jiesuan');?>&shop_status=1&shop_id="+cart_id_+"&shop_pay_status=4";
	}
});
// 选中

$(".xztp").each(function(index){
	 $(this).click(function(){
	 		xzgs();
		var rzj=parseFloat($(".rent").eq(index).text());
		 var zzj=parseFloat($(".mrzj").text());
		 var zyj_money=parseFloat($(".gjyj").text());
		var yj=parseFloat($(".xjxyj").eq(index).text()*0.9);
	
        var zyj=0;
        var zyjjs=0;
	   for(var j=0;j<$(".xztp").length;j++){
	   	   if($(".xztp").eq(j).is(":checked")){
			  	 zyj+=parseFloat($(".sfzdxyj").eq(j).text());
			  	 zyjjs+=parseFloat($(".xjxyj").eq(j).text());
            }
	   }
        $(".sfdxdzd").text(zyj.toFixed(2));
        $(".gjyj").text((zyjjs-zyj).toFixed(2));

		if($(this).is(":checked")){
		
		  //租金
		  $(".mrzj").text((zzj+rzj).toFixed(2));
		  //押金
		 
		 /* var yzzyj=(parseFloat($(".gjyj").text())*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
		   $(".gjyj").text((zyj_money+yj-yzzyj).toFixed(2));*/
           
		   
		}
		else{
			 //租金
			$(".mrzj").text((zzj-rzj).toFixed(2));
			//押金
		   
		    /*var yzzyj=(parseFloat($(".gjyj").text())*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
		     $(".gjyj").text((zyj_money-yj-yzzyj).toFixed(2));
              $(".sfdxdzd").text(yzzyj);*/
		}  

		$(".xyzfdq").text((parseFloat($(".sfdxdzd").text())+parseFloat($(".mrzj").text())).toFixed(2));
	})
		
})
//全选 租赁全选
$(".quanxuan_box").click(function () {
	$(this).prop("checked", true);
	$(".fanxuan_box").prop("checked", false);
    $(".xztp:checkbox").prop("checked", true);  
	var cart_id = "";
	$(".input_checked_").each(function( index ){
		if( $(this).is(":checked")){
			cart_id += ','+$(this).val();
			
		}
	});
	xzgs();
	var cart_id = cart_id.substring(1);
	$.ajax({
		type: "post",
	dateType: "json",
	   async: true,
		 url: "<?php echo U('Cart/AjaxCount');?>",
		data: {'cart_id':cart_id},
	 success: function( data ){
	 	var sum = "";
	 	$.each(data,function( index , value ){
	 		sum +=','+value['cart_rent'];
	 	});
	 	sum_rent = sum.substring(1);
	 	var str_arr = sum_rent.split(",");
	 	var arr1 = new Array();
		$.each(str_arr,function(k,v){
		    arr1.push(v);
		});
		var jgz=parseFloat(0);
	 	for(var i=0;i<arr1.length;i++){
	 		jgz+=parseFloat(arr1[i]);
	 	}
	 	$(".mrzj").text(jgz.toFixed(2));
	 },
	 error: function( XMLHttpRequest , status , error ){
	 	tkcx("出现错误,错误原因是："+status);
	 	return false;
	 }
	});
      var zyj=parseFloat(0);
	  for(var j=0;j<$(".xztp").length;j++){
	  	 zyj+=parseFloat($(".xjxyj").eq(j).text());
	  }
	  zyj=zyj;
	  $(".gjyj").text((zyj*0.9).toFixed(2));
	  var yzzyj=(zyj*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
      $(".sfdxdzd").text(yzzyj);
});
//反选 租赁反选
$(".fanxuan_box").click(function () { 
	$(this).prop("checked", true);
	$(".quanxuan_box").prop("checked", false);
    $(".xztp:checkbox").each(function () {  
        $(this).prop("checked", !$(this).prop("checked"));  
    });
    xzgs();
   //if($(this).is(":checked")){

   	$(".xztp").each(function(index){
   	 	var rzj=parseFloat($(".rent").eq(index).text());
		var zzj=parseFloat($(".mrzj").text());
		 
		var zxyj=parseFloat($(".gjyj").text());
		var yj=parseFloat($(".xjxyj").eq(index).text()*0.9);


		 var zyj=0;
        var zyjjs=0;
	   for(var j=0;j<$(".xztp").length;j++){
	   	   if($(".xztp").eq(j).is(":checked")){
			  	 zyj+=parseFloat($(".sfzdxyj").eq(j).text());
			  	 zyjjs+=parseFloat($(".xjxyj").eq(j).text());
            }
	   }
        $(".sfdxdzd").text(zyj.toFixed(2));
        $(".gjyj").text((zyjjs-zyj).toFixed(2));
		if($(this).is(":checked")){
		  xzgs();
		  $(".mrzj").text((zzj+rzj).toFixed(2));
		/*  $(".gjyj").text((zxyj+yj).toFixed(2));
		  var yzzyj=(parseFloat($(".gjyj").text())*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
          $(".sfdxdzd").text(yzzyj);*/

		}
		else{
			$(".mrzj").text((zzj-rzj).toFixed(2));
			/*$(".gjyj").text((zxyj-yj).toFixed(2));
			var yzzyj=(parseFloat($(".gjyj").text())*"<?php echo ($get_xyj['xyj_prices']); ?>").toFixed(2);
            $(".sfdxdzd").text(yzzyj);*/

		}
		$(".xyzfdq").text((parseFloat($(".sfdxdzd").text())+parseFloat($(".mrzj").text())).toFixed(2));
   	 })
   //}
});
// 单个删除
$(".cart_del").each(function(index){
	$(this).click(function(){
		$(".zhezhao").css("display","block");
		$(".zz_nr_scdz").css("display","block");
		$(".zz_nr2").text("确认删除该条信息吗？");
		window.scdz=index;
	});
});
// 确定删除
$(".qrsc").click(function(){
	$(".zhezhao").css("display","none");
	$(".zz_nr_scdz").css("display","none");
	
    if($(".zz_nr2").text()=="确认删除该条信息吗？"){
		$.post("<?php echo U('Cart/cart_del');?>",{'cart_id':$(".cart_del").eq(scdz).attr("value")},function( data ){
			if( data.status == 2000 ){
				tkcx(data.message);
				$(".remove_data_"+$(".cart_del").eq(scdz).attr("value")).remove();
				return false;
			}else{
				tkcx("删除失败");

			}
		},"json");
	}
    else if($(".zz_nr2").text()=="确定要全部删除购物车商品!"){
	
	    $.post("<?php echo U('Cart/cart_del');?>",{'cart_ids':cart_ids},function( data ){
				if( data.status == 2001 ){
					tkcx(data.message);
					//location.reload();
				}else{
					tkcx("删除失败");
				}
			},"json");
	
	}
    else if($(".zz_nr2").text()=="确定清空购物车所有商品吗?"){
		$.post("<?php echo U('Cart/cart_del');?>",{'carts_id':carts_idy},function( data ){
			if( data.status == 2002 ){
				tkcx(data.message);
				//location.reload();
			}else{
				tkcx("清空失败");
				return false;
			}
		},"json");	
    }
});




$(".tyjs").click(function(){
	$(".zhezhao").css("display","none");
	$(".zz_nr_scdz").css("display","none");
});
$(".scqr").click(function(){
	$(".zhezhao").css("display","none");
	$(".zz_nr_scdz").css("display","none");
});
// 全选删除
$(".gouw21").eq(0).click(function(){
	var cart_ids = "";
	$(".input_checked_").each(function(){
		if( $(this).is(":checked") ){
			cart_ids+= ','+$(this).val();
		}
	});
	window.cart_ids = cart_ids.substring(1);
	if( cart_ids.length == 0 ){
		//alert("全选删除不能为空!");
		tkcx("全选删除不能为空!");
		return false;
	}else{
		//删除弹框显示
		$(".zhezhao").css("display","block");
		$(".zz_nr_scdz").css("display","block");
		$(".zz_nr2").text("确定要全部删除购物车商品!");

	}
});
// 清空购物车
$(".gouw21").eq(1).click(function(){
	var carts_id =  "";
	$(".input_checked_").each(function(){
		carts_id += ','+$(this).val();
	});
	window.carts_idy = carts_id.substring(1);
	//删除弹框显示
		$(".zhezhao").css("display","block");
		$(".zz_nr_scdz").css("display","block");
		$(".zz_nr2").text("确定清空购物车所有商品吗?");
});


	
 //自动消失(弹框)
 function qkgwc(){
	  $(".zhezhao").click(function(){
	  	
	  	 var ss=$(".dd_js1110").length;
	  	 	  
	  	 	 $(".zhezhao").css("display","none");
	  	     $(".zz_nr_fbcg").css("display","none"); 
	  	      location.reload();

	  	
	  	 
	  	 $(".zz_nr_scdz").css("display","none");
		 return false;
	  });
} 

 function tkcx(message){
  	    $(".zhezhao").css("display","block");  
		$(".zz_nr_fbcg").css("display","block");

		$(".zdsc").text(message);

		
	
		
    qkgwc();
		
  }
 
 $(".header_bottom1_middle li").eq(3).addClass("header_dj");
 $(".header_bottom1_middle li").eq(3).siblings().removeClass("header_dj");
 
 //选中个数
function xzgs(){
	var j=0;
	for(var i=0;i<$(".xztp").length;i++){
		if($(".xztp").eq(i).is(":checked")){
			j++;
		}
	}
	$(".spjs").text(j);
}



 $(".header_bottom1_middle li").eq(4).addClass("header_dj");
 $(".header_bottom1_middle li").eq(4).siblings().removeClass("header_dj");
  
})
</script>
<?php echo W('Common/footer');?>