<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php echo ($setTitle); ?></title>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap-common.css">
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap.css">
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/bootstrap.js"></script>
</head>
<style type="text/css">
	.page{text-align: center;height:40px;}
	.page :hover{text-decoration: none}
	.num{border:1px solid #C0D9D9;border-radius: 10px;line-height: 40px;padding:5px 10px 5px 10px;margin: 0px 4px 0px 0px;}
	.current{border: 1px solid #C0D9D9;border-radius: 10px;padding:5px 10px 5px 10px;margin: 0px 4px 0px 0px;background: #007FFF;color:#FFFFFF;}
	.next{border:1px solid #C0D9D9;border-radius: 10px;padding:5px 10px 5px 10px;}
	.prev{border:1px solid #C0D9D9;border-radius: 10px;padding:5px 10px 5px 10px;margin-right:4px;}
	.first{border:1px solid #C0D9D9;border-radius: 10px;padding:5px 10px 5px 10px;margin-right:4px;}
	.end{border:1px solid #C0D9D9;border-radius: 10px;padding:5px 10px 5px 10px;margin-left:4px;}
	.page_style{color:#007FFF;font-size:15px;}
</style>
<body>
<ol class="breadcrumb">
	<li>当前位置</li>
	<li><?php echo ($setTitle); ?></li>
</ol>
<div class="container-fluid">
<form class="bs-example bs-example-form" role="form" action="<?php echo U('Orderdetails/order_search');?>" method="get">
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group" style="width:400px;">
				  <select class="form-control search_ziying" name="search_ziying" style="width:100px;margin-right:10px;height:30px;">
				  	<option value="0">--订单筛选--</option>
			        <option value="1" >自营订单</option>
			        <option value="2" >商家订单</option>
			      </select>
			      <select class="form-control search_play" name="search_play" style="width:100px;height:30px;">
			        <option value="0">--选择状态--</option>
			        <option value="2" >已支付</option>
			        <option value="1" >未支付</option>
			      </select>
			      <input type="text" class="form-control search_order" style="height:30px;position: absolute;width: 150px;left: 230px;outline: none;" name="search_ordernumber" value="<?php echo ($search_ordernumber); ?>" placeholder="请输入查询的订单号">
					  <input type="submit" class="btn btn-default" value="搜索" style="height: 30px;position: relative;left:160px;outline: none;">
			</div><!-- /input-group -->
			<br>
		</div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	<script type="text/javascript">
		$(".search_ziying").change(function(){
			if( $(this).val() == '0' ){
				alert("请注意筛选词!");
				return false;
			}else{
				$("form").submit();
				return false;
			}
		});
		$(".search_play").change(function(){
			if( $(this).val() == '0' ){
				alert("请选择正确的支付状态!");
				return false;
			}else{
				$("form").submit();
				return false;
			}
		});
	</script>
</form>
</div>
<div class="table-responsive">
	<table style="border: 1px solid #DDDDDD;" class="table">
		<tr style="border:1px solid #FFFFFF;width: 100%;">
			<td>
				<button type="button" class="btn btn-info">全选</button>
				<button type="button" class="btn btn-danger">一键删除</button>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr style="background:#F5F5F5;">
			<th style="text-align: center;">全选</th>
			<th style="text-align: center;">编号</th>
			<th style="text-align: center;">承租方</th>
			<th style="text-align: center;">出租方</th>
			<th style="text-align: center;">商品图</th>
			<th style="text-align: center;">商品名</th>
			<th style="text-align: center;">订单号</th>
			<th style="text-align: center;">支付押金</th>
			<th style="text-align: center;">支付租金</th>
			<th style="text-align: center;">收货地址</th>
			<th style="text-align: center;">购买数量</th>
			<th style="text-align: center;">下单时间</th>
			<th style="text-align: center;">商品状态</th>
			<th style="text-align: center;">支付状态</th>
			<th style="text-align: center;">操作</th>
		</tr>
	<?php if(is_array($order_detil)): $i = 0; $__LIST__ = $order_detil;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_): $mod = ($i % 2 );++$i;?><tr class="table_tr_<?php echo ($order_['order_id']); ?>">
			<td style="text-align: center;line-height:50px;"><input type="checkbox" name="" value="<?php echo ($order_['order_id']); ?>" class="check"></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['order_id']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['plgox_user']); ?></td>
			<td style="text-align: center;line-height:50px;">
				<?php echo (get_shanjia_by_id($order_['cart_shangjia_id'],"Member","plgox_user","plgox_id")); ?>
			</td>
			<td style="text-align: center;line-height:50px;"><img src="/Uploads/admin/<?php echo ($order_['share_home_img']); ?>" style="width:50px;height:50px;"></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['share_name']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['order_number']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['order_deposit']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['order_rent']); ?></td>
			<td style="text-align: center;line-height:50px;">
				<?php echo (get_field_by_id($order_['address_city_sheng'],"City","city_name","city_id")); ?>-
				<?php echo (get_field_by_id($order_['address_city_shi'],"City","city_name","city_id")); ?>-
				<?php echo (get_field_by_id($order_['address_city_xian'],"City","city_name","city_id")); ?>-
				<?php echo ($order_['address_default']); ?>
			</td>
			<td style="text-align: center;line-height:50px;"><?php echo ($order_['cart_number']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo (date("Y-m-d H:i:s",$order_['order_createtime'])); ?></td>
			<!-- 商品状态 -->
			<?php if(($order_['order_status']) == 0 ): ?><td style="text-align: center;line-height:50px;"><font color="red">待支付信用金</font></td>
			<?php elseif(($order_['order_status']) == 1): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">待发货</font></td>
			<?php elseif(($order_['order_status']) == 2): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">待收货</font></td>
			<?php elseif(($order_['order_status']) == 3): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">待付押金</font></td>
			<?php elseif(($order_['order_status']) == 4): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">取消订单</font></td>
			<?php elseif(($order_['order_status']) == 5): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">租赁中</font></td>
			<?php elseif(($order_['order_status']) == 6): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">退租中,等待回收</font></td>
			<?php elseif(($order_['order_status']) == 7): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">已回收，待返押金</font></td>
			<?php elseif(($order_['order_status']) == 8): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">退租完成</font></td>
			<?php elseif(($order_['order_status']) == 9): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">已评价</font></td>
			<?php elseif(($order_['order_status']) == 10): ?>
				<td style="text-align: center;line-height:50px;"><font color="red">等待买家确认回收</font></td><?php endif; ?>
			<!-- 支付状态 -->
			<?php if(($order_['order_pay_status']) == "1"): ?><td style="text-align: center;line-height:50px;">未支付</td>
			<?php else: ?>
				<td style="text-align: center;line-height:50px;">已支付</td><?php endif; ?>
			<td style="text-align: center;line-height:50px;">
				<a href="<?php echo U('Orderdetails/order_details_data');?>&order_id=<?php echo base64_encode($order_['order_id'])?>" title="订单查看" class="">查看详情</a>&nbsp;&nbsp;
				<?php if(($order_['order_status']) == "7"): ?><a href="javascript:void(0);" title="删除" class="del" value="<?php echo ($order_['order_id']); ?>">删除订单</a>&nbsp;&nbsp;<?php endif; ?>
				<a href="javascript:void(0);" title="租金列表" class="del" value="<?php echo ($share_list_['module_id']); ?>">租金列表</a>&nbsp;&nbsp;
				<?php if(($order_['order_status']) == "7"): ?><a href="<?php echo U('Orderdetails/order_fhyj');?>&order_fhyj_id=<?php echo base64_encode($order_['order_id'])?>" title="租金列表" class="fhyj">返还押金</a>&nbsp;&nbsp;<?php endif; ?>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
</div>
<div class="container-fluid">
	  <div class="col-xs-12 col-md-8 page" style="width: 100%"><?php echo ($page); ?></div>
</div>
</body>
<script type="text/javascript">
	function showHide(sunid){
		sunid = document.getElementById(sunid);
		if( sunid.style.display == "none" ){
			sunid.style.display = "";
		}else{
			sunid.style.display = "none";
		}
	}
	// 添加新板块
	$(".btn-success").click(function(){
		window.location.href="<?php echo U('Share/share_classify_data');?>";
	});
	// 单个删除
	$(".del").click(function(){
		classify_id = $(this).attr("value");
		if( confirm( "确定要删除该本条数据吗？" ) ){
			$.ajax({
				type: "POST",
			dataType: "JSON",
				 url: "<?php echo U('Share/classify_del');?>",
				data: { 'classify_id':classify_id },
				success: function( data ){
					if( data.status == 2000 ){
						alert(data.message);
						$(".table_tr_"+classify_id).remove();
						return false;
					}else if( data.status == -2001){
						alert( data.message );
						return false;
					}else{
						alert("删除失败");
    					return false;
					}
				},
				error: function( XMLHttpRequest , error , status ){
					alert("网络错误，请稍后再尝试" + status );
					return false;
				}
			});
		}
	});
	// 全选删除
    $(".btn-danger").click(function(){
    	var ids = "";
    	$("input[type='checkbox']").each(function(){
    		if( $(this).is(":checked") ){
    			ids+=','+$(this).val();
    		}
    	});
    	classify_ids = ids.substring(1);
    	if( ids.length == 0 ){
    		alert("请选择要删除的数据");
    	}else if( confirm("确定要全部删除所有数据") ){
    		$.ajax({
    			type: "POST",
    		dataType: "JSON",
    			 url: "<?php echo U('Share/classify_del');?>",
    			data: { 'classify_ids':classify_ids },
    			success: function( data ){
    				if( data.status == 2002 ){
    					alert(data.message);
    					location.reload();
    					return false;
    				}else if( data.status == -2001){
						alert( data.message );
						return false;
    				}else{
    					alert("删除失败");
    					return false;
    				}
    			},
    			error: function( XMLHttpRequest , error , status ){
    				alert("网络出现错误，请稍后再尝试!" + status );
    			}
    		});
    	}
    });
	// 全选
	$(".btn-info").click(function(){
		if( $("input[type='checkbox']").is(":checked") ){
			$("input[type='checkbox']").prop("checked",false);
		}else{
			$("input[type='checkbox']").prop("checked",true);
		}
	});
	// 点击tr选中checkbox
   $("table").find("tr").each(function(){
       $(this).click(function(){
			if( $(this).find('input').is(":checked") ){
				$(this).find("input").prop("checked",false);
			}else{
				$(this).find("input").prop("checked",true);
			}
       	});            
     });
   $(".btn-default").click(function(){
   		if( $(".search").val() == "" ){
   			alert("搜索框当中的内容是不能为空的");
   			return false;
   		}
   });
</script>
</html>