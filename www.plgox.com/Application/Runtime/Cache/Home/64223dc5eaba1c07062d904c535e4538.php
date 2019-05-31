<?php if (!defined('THINK_PATH')) exit(); echo W('Common/header');?>
<title><?php echo ($setTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/dingdan_jiesuan.css">
<style>
.zz_nr2{
	width:998px;
	height:60px;
	line-height:60px;
	font-size:12px;
	color:#666666;
	margin-left:52px;
	
}
.zz_nr2 input,.shr_xtk{
	display:inline-block;
	width:338px;
	padding-left:10px;
	height:32px;
	line-height:32px;
	border:1px solid #d6d6d6;
}
.shr_xtk{
    width: 100px;
    margin-right:15px;
}
</style>
<div class="dd_js">
	<div class="dd_js_box">
		<!--确认订单信息
        -->
        <div class="dd_js1">
        	<div class="dd_js10" style="color:#fd3535;">
        		确认订单信息
        	</div>
        	<table class="dd_js11">
			  <thead>
			    <tr>
			      <th>商品详情</th>
			      <th>单价（元）</th>
			      <th>数量</th>
			      <th>小计（元）</th>
			      <th>备注</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php if(is_array($dingdan_jiesuan)): $i = 0; $__LIST__ = $dingdan_jiesuan;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dingdan_jiesuan_): $mod = ($i % 2 );++$i;?><tr class="dingdan_jiesuan_id_" cartid="<?php echo ($dingdan_jiesuan_['cart_id']); ?>">
				      <td class="dd_js1110" style="cursor:pointer;width:400px;">
				      	<img src="/Uploads/admin/<?php echo ($dingdan_jiesuan_['specifications_img']); ?>" style="width:90px ;height:90px ;" />
				      	<div class="dd_js11101">
				      		<span>
				      			<?php echo ($dingdan_jiesuan_['share_name']); ?>-<?php echo ($dingdan_jiesuan_['specifications_name']); ?>
				      		</span>
				      	</div>	
				      </td>
				      <?php if(( $dingdan_jiesuan_['cart_radio_status'] == 1 )): ?><td style="line-height:30px;">
					      		<div>日租金：¥<?php echo ($dingdan_jiesuan_['specifications_rent']); ?>	</div>
					      		<div>信用金：¥<span class="shop_xyj_"></span></div>
					      		<span style="color:red">（即押金的10%）</span>
					      		<div>押金：¥<span class="shop_yajin"><?php echo ($dingdan_jiesuan_['specifications_deposit']); ?></span></div>
					      </td>
					      <td style="line-height:108px;"><?php echo ($dingdan_jiesuan_['cart_number']); ?></td>
					       <td style="line-height:30px;">
					       	<div>日租金：¥<span class="rent"><?php echo ($dingdan_jiesuan_['cart_rent']); ?></span></div>
					       	<div>信用金：¥<span class="shop_xyj"></span></div>
					       	<span style="color:red">（即押金的10%）</span>
					      	<div>押金：¥<span class="deposit"><?php echo $dingdan_jiesuan_['specifications_deposit']*$dingdan_jiesuan_['cart_number'] ?></span></div>
					      		</td>
					        <td style="line-height:30px;">
					          <?php if(($dingdan_jiesuan_['specifications_give']) != "undefined"): ?><div>租买即送</div>
					           <?php else: ?>
					           	<div>暂无备注</div><?php endif; ?>
					      	</td>
					    <?php elseif(( $dingdan_jiesuan_['cart_radio_status'] == 2 )): ?>
					    	 <td style="line-height:30px;text-align: center;">
					    	 	<div>¥<span class="danjia_"><?php echo ($dingdan_jiesuan_['specifications_prices']); ?></span></div>
					    	 </td>
					    	 <td style="line-height:108px;text-align: center;"><span class="shuliang_"><?php echo ($dingdan_jiesuan_['cart_number']); ?></span></td>
					    	 <td style="text-align: center;">¥ <span class="shop_prices"><?php echo $dingdan_jiesuan_['specifications_prices']*$dingdan_jiesuan_['cart_number'] ?></span></td>
					    	 <td style="line-height:30px;">
					           	<div>暂无备注</div>
					      	</td><?php endif; ?>
				    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php if(empty($dingdan_jiesuan_['cart_status'])): ?><tr>
						<td colspan="5" class="null_value">当前订单详情页面数据为空~~~!</td>
					</tr><?php endif; ?>
			    <tr style="height:35px;background-color:#D3E3FB;color:#FD3535;text-align:left;overflow:hidden;">
			      <td colspan="5" style="text-align:left;padding-left:15px;">
			      提示：商品发货时间在 "早上九点-晚上八点" ；如非工作日购买的商品或者超过正常上下班时间购买的商品将于次日或者正常工作日进行发货！</td>
			    </tr>
			  </tbody>
			</table>
        </div>
        <script type="text/javascript">
        	$(document).ready(function(){
        		var xyj_count = parseFloat(0);
        		$(".shop_yajin").each(function( index ){
        			xyj_count=parseFloat($(this).text())*parseFloat("<?php echo ($xyj_['xyj_prices']); ?>");
        			$(".shop_xyj_").eq(index).text(xyj_count.toFixed(2));
        		});

        		$(".deposit").each(function( index ){
        			xyj_count=parseFloat($(this).text())*parseFloat("<?php echo ($xyj_['xyj_prices']); ?>");
        			$(".shop_xyj").eq(index).text(xyj_count.toFixed(2));
        		});

        		$(".shop_prices").each(function(index){
        			shop_prices = parseFloat($(this).text()).toFixed(2);
        			$(this).text(shop_prices);
        		});
        	});
        </script>
       <div class="dd_js1">
        	<div class="dd_js10">
        		配送地址
        	</div>
        	<div class="dd_js21">
        	  <?php if(is_array($address_id)): $i = 0; $__LIST__ = $address_id;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address_id_): $mod = ($i % 2 );++$i;?><div class="dd_js210 address_ids_<?php echo ($address_id_['address_id']); ?>" id="ddjsm_0" addressid="<?php echo ($address_id_['address_id']); ?>">
        			<?php if(($address_id_['address_default_type']) == "1"): ?><div class="dd_js211_11 dd_js211" style="border: 1px solid #6EA3F2;">
        					<?php echo ($address_id_['address_name']); ?>
        				</div>
        			<?php else: ?>
        				<div class="dd_js211_11">
        					<?php echo ($address_id_['address_name']); ?>
        				</div><?php endif; ?>
        	  <div class="dd_js212">
        				
        		<div class="dd_js2120">
        					<span class="dd_js_name" value="<?php echo ($address_id_['address_name']); ?>">
        						<?php echo ($address_id_['address_name']); ?>
        					</span>
        					<span class="dd_js_address" data-title1="<?php echo (get_field_by_id($address_id_['address_city_sheng'],'City','city_name','city_id')); ?>" data-title2="<?php echo (get_field_by_id($address_id_['address_city_shi'],'City','city_name','city_id')); ?>" data-title3="<?php echo (get_field_by_id($address_id_['address_city_xian'],'City','city_name','city_id')); ?>">
        						<?php echo (get_field_by_id($address_id_['address_city_sheng'],'City','city_name','city_id')); ?>-
        						<?php echo (get_field_by_id($address_id_['address_city_shi'],'City','city_name','city_id')); ?>-
        						<?php echo (get_field_by_id($address_id_['address_city_xian'],'City','city_name','city_id')); ?>
        					</span>
        					<span class="dd_js_address1" value="<?php echo ($address_id_['address_default']); ?>">
        						<?php echo ($address_id_['address_default']); ?>
        					</span>
        					<span class="dd_js_telephone" value="<?php echo ($address_id_['address_tel']); ?>">
        						 <?php echo ($address_id_['address_tel']); ?>
        					</span>
        				<?php if(($address_id_['address_default_type']) == "1"): ?><span class="dd_js_mrdz1">
        						默认地址
        					</span><?php endif; ?>
        				<div class="dd_js2121">
        					<?php if(($address_id_['address_default_type']) == "0"): ?><span class="dd_js_mrdz">
        							<a href="javascript:void(0)" value="<?php echo ($address_id_['address_id']); ?>" style="outline: none;text-decoration: none;color:#1f61c3 ;">设为默认地址</a>
        						</span><?php endif; ?>
        					<span class="dd_js_xg">
        						<a href="javascript:void(0);" class="address_update" value="<?php echo ($address_id_['address_id']); ?>">修改</a>
        					</span>
        					<span class="dd_js_sc">
        						 <a href="javascript:void(0);" class="address_del" value="<?php echo ($address_id_['address_id']); ?>">删除</a>
        					</span>
        				</div>
        				
        				
        			</div>
        			
        			
        			
        		</div>
        		
        	 </div><?php endforeach; endif; else: echo "" ;endif; ?>
        		  <div class="dd_js220">添加新地址</div>
        		
        	</div>
        	
        	<div class="dd_js230">商品将在1-3个工作日送，具体以商家发货为准。</div>
        	
        </div> 
        
      </div> 
  
 <script type="text/javascript">
 	//修改地址
	$(".address_update").each(function(index){
		$(this).click(function(){
			window.hdgid=$(this).attr("value");
			$(".zz_nr1").text("修改收获地址");
			window.xxx=index;
			//获得收货人的值
			var sjr_name=$(".dd_js_name").eq(index).attr('value');
			//获得分栏地址的值
			var shr_address=$(".dd_js_address1").eq(index).attr('value');
			//获得分栏地址的值市
			var shr_dz_sheng=$(".dd_js_address").eq(index).attr('data-title1');
			//获得分栏地址的乡
			window.shr_dz_shi=$(".dd_js_address").eq(index).attr('data-title2');
			//获得分栏地址的值省
			window.shr_dz_xiang=$(".dd_js_address").eq(index).attr('data-title3');
			//获得电话号
			var shr_dz_telephone=$(".dd_js_telephone").eq(index).attr('value');
			
			$(".address_name").val(sjr_name);
            
            for(var i=0;i<$("#exampleInputSheng option").length;i++){
            	if($("#exampleInputSheng option").eq(i).text()==shr_dz_sheng){
            		var sfz=$("#exampleInputSheng option").eq(i).attr("value");
            		$("#exampleInputSheng option[value='"+sfz+"']").attr("selected", true);
            		loadAreaa(sfz,"sheng");	
            	}
            }
            
            
			$(".address_default").val(shr_address);
			$(".address_tel").val(shr_dz_telephone);
				
			$(".zhezhao").css("display","block");
			$(".zz_nr").css("display","block");
			$(".tyjs0").eq(0).attr("value","xgsy");
			$(".zz_nr_qrsc").css("display","none");
		})
	})
	
	function loadAreaa( cityId , CityType){
  	 	$.post("<?php echo U('Cart/AjaxAddress');?>",{'city_id':cityId},function( data ){
  	 	
  	 		if( CityType == "sheng" ){
  	 			$("#"+CityType).html('<option value="0">--市--</option>');
  	 			$("#shi").html('<option value="0">--县/区/镇--</option>');
  	 			$.each(data,function(index,value){
					opt = $("<option/>").text(value['city_name']).attr("value",value['city_id']);
					$("#"+CityType).append(opt);
				});
  	 			for(var j=0;j<$("#sheng option").length;j++){
		            	if($("#sheng option").eq(j).text()==$(".dd_js_address").eq(xxx).attr('data-title2')){
		            		var sfzt=$("#sheng option").eq(j).attr("value");
		            		$("#sheng option[value='"+sfzt+"']").attr("selected", true);
                             loadAreaa( sfzt , "shi");
		            	   
		            	}
		       }

  	 		}else if( CityType == 'shi' ){
				$("#"+CityType).html('<option value="0">--县/区/镇--</option>');
				$.each(data,function(index,value){
					opt = $("<option/>").text(value['city_name']).attr("value",value['city_id']);
					$("#"+CityType).append(opt);
				});
				if($("#shi option").length!=1){
					for(var k=0;k<$("#shi option").length;k++){
		            	if($("#shi option").eq(k).text()==$(".dd_js_address").eq(xxx).attr('data-title3')){
		            		var sfzt1=$("#shi option").eq(k).attr("value");
		            		$("#shi option[value='"+sfzt1+"']").attr("selected", true);
		            	   
		            	}
		            }
				}
				
  	 		}
  	 		
  	 		 
  	 		
		         

  	 		
  	 	},'json');
  	}
 </script> 
  
  <div style="width:1192px;margin:0 auto;overflow:hidden;">     
       <?php if(( $order_detil_status == 1 )): ?><div class="dd_js1">
        	<div class="dd_js10">
        		还款日期
        	</div>
        	
        	<div class="dd_js230">每月1号生成上月租金账单，每月5号为账单最后还款日期。</div>
        </div><?php endif; ?>
       
       <div class="dd_js1">
        	<div class="dd_js10">
        		发票申请
        	</div>
        	
        	<div class="dd_js230">
        		<div class="dd_js_fpkq">不开取</div>
        		<div class="dd_js_fpkq1">修改</div>
        	</div>
        </div> 
       
       <div class="dd_js1">
        	<div class="dd_js10">
        		买家留言
        	</div>
        	
        	<div class="dd_js3">
        		<textarea name="order_detil_liuyan" class="dd_js31 order_content">此处可以填写您对于订单的其他说明要求</textarea>
        	</div>
        	<div class="dd_js230" style="margin-top:5px;">选填，少于200字。提醒：如果备注信息和订单内容有冲突，除非您已和客服确定，否则以订单内容为准。</div>
        	
       </div>
       
   
        	
	<div class="dd_js6">
		<?php if(( $order_detil_status == 1 )): ?><div class="dd_js61">
             日租金：<span class="day_rent">¥ 0.00</span> <span>(收货后第2天结算) </span> 
        	</div>
        	<div class="dd_js61">
             <span style="margin-left: 15px"></span>押&nbsp;&nbsp;&nbsp;金：<span class="count_deposit">¥ 00.00</span> <span></span> 
        	</div>
        	<div class="dd_js61">
             <span style="margin-left: 26px"></span>信用金：<span >¥ </span> <span class="count_xyj" style="color: red">00.00</span> <span style="color:red">（即押金的10%） </span> 
        	</div>
        <div class="zhuce_jsxy">
      		<div class="zhuce_jsxy1">
      		  <input type="checkbox" name="jsxy1" id="jsxy1" />
      		</div>
      		<div class="zhuce_jsxy2">
      		 <span>我已阅读并接受</span>
      		 <span style="color:#1f61c3;cursor:pointer;" onclick="javascript:window.location.href='http://www.plgox.com/Help/RuZhuXieYi.html'"><font class="xy_font">《租赁协议》</font></span>
      		</div>
      	</div>
      	<?php elseif(( $order_detil_status == 2 )): ?>
        	<div class="dd_js61" style="text-align: center;margin-left:42px">
            	<font style="position: relative;right: 13px">总&nbsp;&nbsp;&nbsp;量：</font><span  style="color: red;position: relative;right: 14px;font-weight: bold" class="shuliang"></span><span style="position: relative;right: 12px;color: red;font-weight: bold">件</span>
        	</div>
        	<div class="dd_js61" style="text-align: center;margin-left:42px">
            实付款：<span class="day_rent_" style="color: red">¥ <font class="shifukuan">0.00</font></span>
        	</div>
        	<br />
        	<div class="zhuce_jsxy1" style="margin-left: 150px">
      		  <input type="checkbox" name="jsxy1" id="jsxy1" />
      		</div>
        	<div class="zhuce_jsxy2" >
      		 <span>我已阅读并接受</span>
      		 <span style="color:#1f61c3;cursor:pointer;" onclick="javascript:window.location.href='http://www.plgox.com/Help/RuZhuXieYi.html'"><font class="xy_font">《购买协议》</font></span>
      		</div><?php endif; ?>
      	<div class="dd_js66">
      		<input type="submit" name="tj" class="tjdd"  value="去结算" />
      	</div>
       </div>
 </div>      
       <script type="text/javascript">
       	$(document).ready(function(){
       		//小计押金
       		var count_xyj = parseFloat(0);
       		var arr1 = new Array();
			$(".shop_xyj").each(function(index){
				var xjyj=parseFloat($(this).text()).toFixed(2);
				arr1.push(xjyj)
			});
			for( var i = 0; i<arr1.length;i++ ){
				count_xyj+=parseFloat(arr1[i]);
			}
			$(".count_xyj").text(count_xyj.toFixed(2));
			// 实付款
			var count_prices = parseFloat(0);
			$(".shop_prices").each(function(index){
				sum_prices = parseFloat($(this).text()).toFixed(2);
				arr1.push(sum_prices);
			});
			for( var i = 0; i < arr1.length; i++ ){
				count_prices+=parseFloat(arr1[i]);
			}
			$(".shifukuan").text(count_prices.toFixed(2));
			// 总数量
			var shuliang_ = parseInt(0);
			var arr2 = new Array();
			$(".shuliang_").each(function( index ){
				sl_ = parseInt($(this).text());
				arr2.push(sl_);
			});
			for ( var i = 0; i < arr2.length; i++ ) {
				shuliang_+= parseInt(arr2[i]);
			}
			$(".shuliang").text(shuliang_);
       	});
       </script>
	</div>
</div>
<!--遮罩-->
  <?php echo W('Common/header1_search');?> 
<div class="zhezhao" style="display:none;">
   <div class="zz_nr" style="height:420px;display:none;">
	  <div class="zz_nr1">
		添加收货地址			
	  </div>
	  <div class="zz_nr2" style="margin-top:30px;">
		<span>
			*&nbsp;收货人&nbsp;&nbsp;&nbsp;：
		</span>
		<input type="text" class="address_name" name="address_name"  style="margin-left:2px;"/>
		<font class="error_font" ></font>
	  </div>
	  <div class="zz_nr2">
		<span>
			*&nbsp;选填地址：
		</span>
		<select class="shr_xtk" id="exampleInputSheng" onchange="loadArea(this.value,'sheng')">
			<option value="0">--省--</option>
			<?php if(is_array($city_id)): $i = 0; $__LIST__ = $city_id;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city_id_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($city_id_['city_id']); ?>"><?php echo ($city_id_['city_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<select class="shr_xtk shr_dz" id="sheng" onchange="loadArea(this.value,'shi')">
			<option value="0">--市--</option>
		</select>
		<select class="shr_xtk shr_dz" id="shi" onchange="loadArea(this.value,'qu')">
			<option value="0">--县/区/镇--</option>
		</select>
		<font class="error_font" style="font-size:13px;" class="address_level"></font>
	  </div>
	  <div class="zz_nr2">
		<span>
			*&nbsp;详细地址：
		</span>
		<input type="text" class="address_default" name="address_default" />
		<font class="error_font" ></font>
	  </div>
	   <div class="zz_nr2">
		<span>
			*&nbsp;联系电话：
		</span>
		<input type="text" class="address_tel"  name="address_tel" />		
		<font class="error_font" ></font>
	  </div>
	  <div class="zz_nr3" style="margin-top:25px;">
			<a href="#" value="" class="tyjs0">保存收货人信息</a>
			<a href="#" class="tyjs">取消</a>	
	  </div>
	</div>
	
	<div class="zz_nr_fp" style="height:420px;display:none;">
		
	  
	  <div class="zz_nr1">
		<span class="wxts">发票信息<span>
		<span class="scqr">×</span>
	  </div>
	  
	  <div class="zzfpsz">
	  	<span class="zzfpsz1 zzfpsz1_dj">普通发票</span>
	  	<span class="zzfpsz1">增值税专用发票</span>
	  </div>
		
	  <div class="zz_nr2" style="height:65px;">
		<span>
			*&nbsp;发票抬头：
		</span>
		<input type="text" class="invoid_tt" placeholder="个人" name="invoid_tt"  style="margin-left:2px;"/>
		<font class="error_font" ></font>
		
		<font style="color:red;"></font>
	  </div>
	  <div class="fpsz">新增单位发票</div>
	  <div class="zz_nr2" style="height:65px;">
		<span style="margin-left:-20px;">
			*纳税人识别号：
		</span>
		<input type="text" class="invoid_sbh" name="invoid_sbh"  style="margin-left:2px;"/>
		<font class="error_font" ></font>
	  </div>
	  <div class="fpsz">（发票内容由第三方制定，如有疑问可自行沟通）</div>
	  
	  <div class="zz_nr3" style="margin-top:50px;">
			<a href="#" class="fpsz11">保存</a>
			<a href="#" class="tyjs">取消</a>	
	  </div>
	</div>

<script type="text/javascript">
	//发票弹框改变
	$(".zzfpsz1").each(function(index){
		$(this).click(function(){
			$(this).addClass("zzfpsz1_dj");
			$(this).siblings().removeClass("zzfpsz1_dj");
		})
	})
	
	//发票弹框出现
	$(".dd_js_fpkq1").click(function(){
		$(".zhezhao").css("display","block");
		$(".zz_nr_fp").css("display","block");	
		
	})
	//发票弹框消失
	$(".fpsz11").click(function(){
		if( $(".invoid_tt").val() == ""  ){
			$(".invoid_tt").css("border","1px solid red");
			$(".invoid_tt").next().html('发票抬头是必填的!');
			return false;
		}else{
			$(".invoid_tt").css("border","1px solid green");
			$(".invoid_tt").next().html('');
		}
		
		if( $(".invoid_sbh").val() == ""  ){
			$(".invoid_sbh").css("border","1px solid red");
			$(".invoid_sbh").next().html('发票抬头是必填的!');
			return false;
		}else{
			$(".invoid_sbh").css("border","1px solid green");
			$(".invoid_sbh").next().html('');
		}
		if($(".zzfpsz1_dj").text()=='普通发票'){
			var	invoice_type=1;
		}
		else{
			var	invoice_type=2;
		}
		if( $(".invoid_sbh").val() != "" && $(".invoid_tt").val() != ""){
					$.ajax({
						type: "post",
					dataType: "json",
					   async: true,
						data: {
							    'invoice_type':invoice_type,
								'invoice_title':$(".invoid_tt").val(), 
								'invoice_shibiehao':$(".invoid_sbh").val()
							},
						 url: "<?php echo U('Cart/invoice_add');?>",
						success: function( data ){
							if( data.status == 2000 ){
								$(".zhezhao").css("display","none");
		                        $(".zz_nr_fp").css("display","none");
								location.reload();
								return false;
							}else if( data.status == -2000 ){
								tkcx(data.message);
								return false;
							}
						},
						error: function( XMLHttpRequest , status ,error ){
							tkcx("出现问题，问题位置在："+status);
							return false;
						}
					});
				}
		
		
		
		
		
	})
	$(".scqr").click(function(){
		$(".zhezhao").css("display","none");
		$(".zz_nr_fp").css("display","none");
	})
</script>


	<div class="zz_nr_fbcg" style="display:none;">
	  <div class="zdsc">
	  	提交成功，平台会核实处理
	  </div>
	   
	  <div class="zz_gbtk" >
			关闭
	  </div> 
	</div>
	
	
	
	<div class="zz_nr_qrsc"  style="display:none;">
	  <div class="zz_nr1">
		<span class="wxts">温馨提示<span>
		<span class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:146px;height:146px;display:block;">
		确认删除收货地址吗？		
	  </div>
	 
	  <div class="zz_nr3" >
			<a href="#wss" class="tyjs0">确认</a>
			<a href="#wss" class="tyjs">取消</a>	
	  </div>  
	</div>		
</div>
  <script type="text/javascript" src="/Public/Common/bootstrap/js/base_64.js"></script>
  <script type="text/javascript">
  	  $(".dd_js212").each(function(index){
    		$(this).mouseover(function(){
    			$(".dd_js2121").eq(index).css("display","inline-block");
    			$(".dd_js212").eq(index).css('backgroundColor','#D3E3FB');
    		});
    	   $(this).mouseout(function(){
    			$(".dd_js2121").eq(index).css("display","none");
    			$(".dd_js212").eq(index).css('backgroundColor','white');
    		});
    	})
    	$(".dd_js211_11").each(function(index){
    		$(this).click(function(){
    			for(var i=0;i<$(".dd_js211_11").length;i++){
    				if(index==i){
    			         $(this).addClass("dd_js211");
    			         $(this).css("border","1px solid #6EA3F2");
    				}
    				else{
    					$(".dd_js211_11").eq(i).removeClass("dd_js211");
    					$(".dd_js211_11").eq(i).css("border","1px solid #EBEBEB");
    				}
    			}	
    		});
    		$(this).mouseover(function(){
    			$(".dd_js212").eq(index).css('backgroundColor','#D3E3FB');
    			$(".dd_js2121").eq(index).css("display","inline-block");
    		});
    	   $(this).mouseout(function(){
    			$(".dd_js212").eq(index).css('backgroundColor','white');
    			$(".dd_js2121").eq(index).css("display","none");
    		});
    	
    	})
    	
    </script>  
  	<script type="text/javascript">
	$(document).ready(function(){
       //小计押金
		$(".deposit").each(function(index){
			var xjyj=parseFloat($(this).text()).toFixed(2);
			$(this).text(xjyj);
		});
		// 租金
		var sum = "";
		$(".rent").each(function( index ){
			sum +=','+ $(this).text();
		});
		sum_rent = sum.substring(1);
		sum_rents = sum_rent.split(",");
		arr1 = new Array();
		$(sum_rents).each(function( key , value){
			arr1.push(value);
		});
		var sum_count=parseFloat(0);
		for( var i = 0 ;i < arr1.length; i++ ){
			sum_count += parseFloat(arr1[i]);
		}
		if(sum_count.toFixed(2)!="NaN"){
		  $(".day_rent").text("¥ "+sum_count.toFixed(2));
		  
		}
		else{
			$(".day_rent").text("¥ 0.00");
		}
		// 押金
		var deposit = ""
		$(".deposit").each(function(){
			deposit +=','+ $(this).text();
		});
		deposit_prices = deposit.substring(1);
		deposit_jiage = deposit_prices.split(",");
		var arr2 = new Array();
		$(deposit_jiage).each(function( key , value ){
			arr2.push(value);
		});
		var deposits = parseFloat(0);
		for( var i = 0 ;i < arr2.length ; i++ ){
			deposits += parseFloat(arr2[i]);
		}
		if(deposits.toFixed(2)!="NaN"){
		  var price_coutn = deposits-$(".count_xyj").text();
		  $(".count_deposit").text("¥ "+price_coutn.toFixed(2));
		  
		}
		else{
			$(".count_deposit").text("¥ 0.00");
		}
		
	});
	$(".dd_js31").each(function(index){
		$(this).focus(function(){
			$(this).val(null);
		})
	})
	$("#jsxy1").click(function(){
		
	  if($('#jsxy1').is(':checked')){
		$(".dd_js66 input").css("background","#6ea3f2");
	  }
	  else{
	  	$(".dd_js66 input").css("background","#BFBFBF");
	  }
	})
	//提交订单
	$(".tjdd").click(function(){
		var null_value = $(".null_value").text();
		// 购物车id
		var cart_id = "";
		$(".dingdan_jiesuan_id_").each(function( index ){
			cart_id += ','+$(this).attr("cartid");
		});
		var cartid = cart_id.substring(1);
		cartids = cartid.split(",");
		// 收货地址
		var addressid = $(".dd_js210").attr("addressid");
		// 留言
		var order_content = $(".order_content").val();
		// 状态 1 = 租赁 2 = 购买
		var order_detil_status = "<?php echo ($order_detil_status); ?>";
		// 总计信用金
		var count_xyj = $(".count_xyj").text();
		if( $("#jsxy1").is(":checked") ){
			if( $(".null_value").text() == "当前订单详情页面数据为空~~~!" ){
				alert(null_value);
			}else{
				$.ajax({
					type: "post",
				dataType: "json",
					 url: "<?php echo U('Cart/Ajaxdodingdan');?>",
					data: {
						'order_detil_status':order_detil_status,
						'order_cart_id':cartids,
						'order_addressid':addressid,
						'order_detil_liuyan':order_content,
					},
				 success: function( data ){
				 	if( data.status == 2000 ){
				 		// tkcx(data.message);
						// base64 加密
						var base64_encode = new Base64();
						var shop_id = base64_encode.encode(""+cartids+"");
				 		window.location.href="<?php echo U('Pay/pay');?>&shop_id="+shop_id+"&type=<?php echo ($shop_pay_status); ?>"; // 支付页面入口
						return false;
				 	}else if( data.status == -2000 ){
				 		tkcx(data.message);
				 		return false;
				 	}
				 },
				 error: function( XMLHttpRequest , status , error ){
				 	tkcx("网络错误,错误位置在："+status);
				 	return false;
				 }
				});
				return false;				
			}
		}else{
			tkcx("请勾选"+$(".xy_font").text()+"协议之后，方可进行结算");
			return false;
		}
	});

function tkcx(message){
  	    $(".zhezhao").css("display","block");  
		$(".zz_nr_fbcg").css("display","block");

		$(".zdsc").text(message);

		
	dd_hidden();	
  }	
	
	
	//自动消失(弹框)
function dd_hidden(){

  $(".zhezhao").click(function(){
 	//alert($(".zdsc").text());
  	 if($(".zdsc").text()=="下单成功,已加入到订单中心!下单成功,已加入到订单中心!"){
  	 	 
  	 	window.location.href="<?php echo U('User/my_dingdan');?>";
  	 	 $(".zhezhao").css("display","none");
  	     $(".zz_nr_fbcg").css("display","none");
		//alert("sdsd");	
		      //return false;
	 }
  	 else{	  
  	 	 $(".zhezhao").css("display","none");
  	     $(".zz_nr_fbcg").css("display","none"); 

  	    //
  	 } 
	 return false;
  });
}	
	
	//是否确认删除地址
	$(".dd_js_sc").click(function(){
		$(".zhezhao").css("display","block");
		$(".zz_nr").css("display","none");
		$(".zz_nr_qrsc").css("display","block");
	})
	//添加地址
	$(".dd_js220").click(function(){
		$(".zhezhao").css("display","block");
		$(".zz_nr").css("display","block");
		$(".tyjs0").eq(0).attr("value","tjdzl");
		$(".zz_nr1").text("添加收货地址");
		$(".zz_nr_qrsc").css("display","none");
	})
	$(".tyjs").click(function(){
		$(".zhezhao").css("display","none");
		$(".zz_nr_qrsc").css("display","none");
		$(".zz_nr").css("display","none");
		$(".zz_nr_fp").css("display","none");
	});
	
	
	
	
	$(".tyjs0").eq(0).click(function(){
		      if( $(".address_name").val() == "" ){
					$(".address_name").css("border","1px solid red");
					$(".address_name").next().html('收货人姓名是不可以为空的!');
					return false;
				}else{
					$(".address_name").css("border","1px solid green");
					$(".address_name").next().html('');
				}
				if( $("#exampleInputSheng").val() == '0' && $("#sheng").val() == '0' && $("#shi").val() == '0' ){
					$(".address_level").html('收货地址是必填的!');
					return false;
				}else{
					$(".address_level").html('');
				}
				
				
				
				if( $(".address_default").val() == ""  ){
					$(".address_default").css("border","1px solid red");
					$(".address_default").next().html('配送的地址是必填的!');
					return false;
				}else{
					$(".address_default").css("border","1px solid green");
					$(".address_default").next().html('');
				}
				 
				 var tel = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/ ;
				if( !tel.test($('.address_tel').val()) ){
					$(".address_tel").css("border","1px solid red");
					$(".address_tel").next().html('手机号不正确,请输入正确的手机号');
					return false;
				}else{
					$(".address_tel").css("border","1px solid green");
					$(".address_tel").next().html('');
				}
				
				
       if($(this).attr('value')=="tjdzl"){ 
				if( $(".address_name").val() != "" && $(".address_default").val() != "" && $('.address_tel').val() != "" && $("#exampleInputSheng").val() != '0' && $("#sheng").val() != '0' && $("#shi").val() != '0'){
					$.ajax({
						type: "post",
					dataType: "json",
					   async: true,
						data: {
								'address_name':$(".address_name").val() , 
								'address_city_sheng':$("#exampleInputSheng").val() , 
								'address_city_shi':$("#sheng").val() , 
								'address_city_xian':$("#shi").val() , 
								'address_default':$(".address_default").val() , 
								'address_tel':$('.address_tel').val() 
							},
						 url: "<?php echo U('Cart/AjaxAddress_add');?>",
						success: function( data ){
							if( data.status == 2000 ){
								$(".zhezhao").css("display","none");
								$(".zz_nr").css("display","none")
								location.reload();
								return false;
							}else if( data.status == -2000 ){
								tkcx(data.message);
								return false;
							}
						},
						error: function( XMLHttpRequest , status ,error ){
							tkcx("出现问题，问题位置在："+status);
							return false;
						}
					});
				}
		
		}
       else if($(this).attr('value')=="xgsy"){
       	    $.ajax({
						type: "post",
					dataType: "json",
					   async: true,
						data: {
							    'address_id':hdgid,
								'address_name':$(".address_name").val() , 
								'address_city_sheng':$("#exampleInputSheng").val() , 
								'address_city_shi':$("#sheng").val() , 
								'address_city_xian':$("#shi").val() , 
								'address_default':$(".address_default").val() , 
								'address_tel':$('.address_tel').val() 
							},
						 url: "<?php echo U('Cart/AjaxAddress_update');?>",
						success: function( data ){
							if( data.status == 2000 ){
								$(".zhezhao").css("display","none");
								$(".zz_nr").css("display","none");
								location.reload();
								return false;
							}else if( data.status == -2000 ){
								tkcx(data.message);
								return false;
							}
						},
						error: function( XMLHttpRequest , status ,error ){
							tkcx("出现问题，问题位置在："+status);
							return false;
						}
					});
       	   
       }
       
       
		
	})
	
	
	
	
	$(".address_del").click(function(){
		$(".tyjs0").eq(1).attr("value",$(this).attr("value"));
	});
	$(".tyjs0").eq(1).click(function(){
		$.post("<?php echo U('Cart/AjaxAddressDel');?>",{'address_id':$(this).attr("value")},function(data ){
			if( data.status == 2000 ){
				//tkcx(data.message);
				location.reload();
				return false;
			}else if( data.status == -2000 ){
				tkcx(data.message);
				return false;
			}
		},'json');
	});
	
	$(".scqr").click(function(){
		$(".zhezhao").css("display","none");
	});
	$(".dd_js_mrdz > a").click(function(){
		$.post("<?php echo U('Cart/address_default');?>",{'address_id':$(this).attr("value") , 'address_default_type':1},function( data ){
			if( data.status == 2000 ){
				// 成功后默认
				location.reload();
			}else if( data.status == -2000 ){
				alert(data.message);
				return false;
			}
			
		});
	});
	// 城市级联
	function loadArea( cityId , CityType){
  	 	$.post("<?php echo U('Cart/AjaxAddress');?>",{'city_id':cityId},function( data ){
  	 		if( CityType == "sheng" ){
  	 			$("#"+CityType).html('<option value="0">--市--</option>');
  	 			$("#shi").html('<option value="0">--县/区/镇--</option>');
  	 		}else if( CityType == 'shi' ){
				$("#"+CityType).html('<option value="0">--县/区/镇--</option>');
  	 		}
  	 		if( CityType != 'qu' ){
  	 			$.each(data,function(index,value){
					opt = $("<option/>").text(value['city_name']).attr("value",value['city_id']);
					$("#"+CityType).append(opt);
				});
  	 		}
  	 	},'json');
  	}
	
	
	
	
	
	</script>
<?php echo W('Common/footer');?>