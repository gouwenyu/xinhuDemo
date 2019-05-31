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
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/Public/Common/bootstrap/css/zebra_datepicker.min.css" type="text/css">
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/zebra_datepicker.min.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/examples.js"></script>
</head>
<body>
<div class="container-fluid">
<ol class="breadcrumb">
<li>当前位置</li>
<li><?php echo ($setTitle); ?></li>
</ol>
<div class="table-responsive">
  <table class="table table-bordered">
  	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">订单号：</td>
		<td style="border:none">
			<input type="text" class="form-control order_number"  value="<?php echo ($orders['order_number']); ?>" style="width:470px;height: 40px" name="order_number" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">购买方：</td>
		<td style="border:none">
			<input type="text" class="form-control plgox_user"  value="<?php echo ($orders['plgox_user']); ?>" style="width:470px;height: 40px" name="plgox_user" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">出售方：</td>
		<td style="border:none">
			<input type="text" class="form-control cart_shangjia_id"  value="<?php echo (get_shanjia_by_id($orders['cart_shangjia_id'],'Member','plgox_user','plgox_id')); ?>" style="width:470px;height: 40px" name="cart_shangjia_id" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">下单商品：</td>
		<td style="border:none">
			<input type="text" class="form-control share_name"  value="<?php echo ($orders['share_name']); ?>" style="width:470px;height: 40px" name="share_name" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">商品规格：</td>
		<td style="border:none">
			<input type="text" class="form-control specifications_name"  value="<?php echo ($orders['specifications_name']); ?>" style="width:470px;height: 40px" name="specifications_name" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">租赁天数：</td>
		<td style="border:none">
			<input type="text" class="form-control zulin_day_number"  value="<?php echo ($orders['zulin_day_number']); echo ($orders['zulin_name']); ?>" style="width:470px;height: 40px" name="zulin_day_number" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">收货地址：</td>
		<td style="border:none">
			<input type="text" class="form-control order_addressid"  value="<?php echo (get_field_by_id($orders['address_city_sheng'],'City','city_name','city_id')); ?>-<?php echo (get_field_by_id($orders['address_city_shi'],'City','city_name','city_id')); ?>-<?php echo (get_field_by_id($orders['address_city_xian'],'City','city_name','city_id')); ?>-<?php echo ($orders['address_default']); ?>" style="width:470px;height: 40px" name="order_addressid" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">价格区间：</td>
		<td style="border:none">
			<input type="text" class="form-control filter_content"  value="<?php echo ($orders['filter_content']); ?>" style="width:470px;height: 40px" name="filter_content" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">所付金额：</td>
		<td style="border:none">
			<input type="text" class="form-control order_mm_prices"  value="<?php echo ($orders['order_mm_prices']); ?>" style="width:470px;height: 40px" name="order_mm_prices" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">订单状态：</td>
		<td style="border:none">
			<div class="radio">
				
				<label>
					<input type="radio" name="order_status" class="order_status" disabled="disabled" value="0" <?php if(($orders['order_status']) == "0"): ?>checked<?php endif; ?> >等待买家付款&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" disabled="disabled" value="1" <?php if(($orders['order_status']) == "1"): ?>checked<?php endif; ?> >待发货&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" value="2" <?php if(($orders['order_status']) == "2"): ?>checked<?php endif; ?> ><font style="color:red">配送发货</font>&nbsp;&nbsp;
				</label>
				<!-- <label>
					<input type="radio" name="order_status" class="order_status" disabled="disabled" value="7" <?php if(($orders['order_status']) == "7"): ?>checked<?php endif; ?> >买家确认收货&nbsp;&nbsp;
				</label> -->
				<label>
					<input type="radio" name="order_status" class="order_status order_pay_colse" value="11" <?php if(($orders['order_status']) == "11"): ?>checked<?php endif; ?> ><font style="color: red">取消订单</font>&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" disabled="disabled" value="4" <?php if(($orders['order_status']) == "4"): ?>checked<?php endif; ?> >交易关闭&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status order_pay_success" disabled="disabled" value="5" <?php if(($orders['order_status']) == "5"): ?>checked<?php endif; ?> >交易成功&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status order_pay_success" disabled="disabled" value="9" <?php if(($orders['order_status']) == "9"): ?>checked<?php endif; ?> >已评价&nbsp;&nbsp;
				</label>
				<!-- <label>
					<input type="radio" name="order_status" class="order_status" value="1" <?php if(($orders['order_status']) == "1"): ?>checked<?php endif; ?> >待发货&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" value="2" <?php if(($orders['order_status']) == "2"): ?>checked<?php endif; ?> >配送发货&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" value="3" <?php if(($orders['order_status']) == "3"): ?>checked<?php endif; ?>>确认送达&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status"  disabled="disabled" <?php if(($orders['order_status']) == "5"): ?>checked<?php endif; ?>>租赁中&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" value="6" <?php if(($orders['order_status']) == "6"): ?>checked<?php endif; ?>>待取货&nbsp;&nbsp;
				</label><br /><br />
				<label>
					<input type="radio" name="order_status" class="order_status" value="10" <?php if(($orders['order_status']) == "10"): ?>checked<?php endif; ?>>已取货&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" disabled="disabled" <?php if(($orders['order_status']) == "7"): ?>checked<?php endif; ?>>待返押金&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" value="8" <?php if(($orders['order_status']) == "8"): ?>checked<?php endif; ?>>退租完成&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" value="4" <?php if(($orders['order_status']) == "4"): ?>checked<?php endif; ?>>已取消&nbsp;&nbsp;
				</label>
				<label>
					<input type="radio" name="order_status" class="order_status" disabled="disabled" <?php if(($orders['order_status']) == "9"): ?>checked<?php endif; ?>>已评价&nbsp;&nbsp;
				</label> -->
			</div>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">用户留言：</td>
		<td style="border:none">
			<textarea class="form-control" rows="5" style="width: 470px;resize: none" name="order_detil_liuyan" readonly="readonly"><?php echo ($orders['order_detil_liuyan']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">
			
		</td>
		<td style="border:none">
			<button type="button" class="btn btn-success" value="<?php echo ($orders['order_id']); ?>">确认修改</button>
			<button type="button" class="btn btn-danger">返回上页</button>
			<button type="button" class="btn btn-info">刷新</button>
		</td>
	</tr>
  </table>
</div>
</div>
</body>
<script type="text/javascript">
	$(".btn-info").click(function(){
		location.reload();
	});
	$(".btn-danger").click(function(){
		window.location.href="<?php echo U('Orderdetails/order_details_shop');?>";
	});
	$(".btn-success").click(function(){
		if( $(".order_pay_colse").is(":checked") ){
			if( confirm("确定取消买家的订单，一旦操作将无法撤回！") ){
				get_data($(this).val());
			}
		}else{
			get_data($(this).val());
		}
	});
	function get_data($val){
		// 订单状态
		$.post("<?php echo U('Orderdetails/order_shop_status');?>",{'order_1':$val,'order_status':$(".order_status:checked").val()},function( data ){
			if( data.status == 2000 ){
				alert("修改订单状态成功");
				window.location.href="<?php echo U('Orderdetails/order_details_shop');?>";
				return false;
			}else if( data.status == -2000 ){
				alert("修改订单状态失败或者已经修改!");
				return false;
			}else if( data.status == -2001 ){
				alert(data.message);
				return false;
			}
		},"json");	
	}
</script>
</html>