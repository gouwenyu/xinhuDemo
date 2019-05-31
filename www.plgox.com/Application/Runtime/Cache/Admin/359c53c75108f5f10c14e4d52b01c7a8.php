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
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">评价方：</td>
		<td style="border:none">
			<input type="text" class="form-control plgox_user_vip" style="width:470px;height: 40px" name="plgox_user_vip" readonly="readonly" value="<?php echo ($pingjia['plgox_user']); ?>">	
		</td>
	</tr>
 	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">被平方：</td>
		<td style="border:none">
			<input type="text" class="form-control plgox_user_uid" style="width:470px;height: 40px" name="plgox_user_uid" readonly="readonly" value="<?php echo (get_shanjia_by_id($pingjia['cart_shangjia_id'],'Member','plgox_user','plgox_id')); ?>">	
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">评价内容：</td>
		<td style="border:none">
		<textarea class="form-control" rows="6" style="width:470px;resize: none" readonly="readonly" class="pingjia_content"><?php echo ($pingjia['pingjia_content']); ?></textarea>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">买家晒图：</td>
		<td style="border:none">
			<?php if(( $images['0'] != null ) OR ( $images['0'] != '' ) ): ?><img src="/Uploads/home_pingjia_img/<?php echo ($images['0']); ?>" style="width:70px;height:70px;"><?php endif; ?>
			<?php if(( $images['1'] != null ) OR ( $images['1'] != '' ) ): ?><img src="/Uploads/home_pingjia_img/<?php echo ($images['1']); ?>" style="width:70px;height:70px;"><?php endif; ?>
			<?php if(( $images['2'] != null ) OR ( $images['2'] != '' ) ): ?><img src="/Uploads/home_pingjia_img/<?php echo ($images['2']); ?>" style="width:70px;height:70px;"><?php endif; ?>
			<?php if(( $images['3'] != null ) OR ( $images['3'] != '' ) ): ?><img src="/Uploads/home_pingjia_img/<?php echo ($images['3']); ?>" style="width:70px;height:70px;"><?php endif; ?>
			<?php if(( $images['4'] != null ) OR ( $images['4'] != '' ) ): ?><img src="/Uploads/home_pingjia_img/<?php echo ($images['4']); ?>" style="width:70px;height:70px;"><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">描述相符星级：</td>
		<td style="border:none">
			<?php if(($pingjia['pingjia_descriptions_pingjia']) != "0"): ?><div style="border:1px solid #ccc;width: 470px;height: 40px;border-radius: 6px;" >
				<?php $__FOR_START_626028453__=0;$__FOR_END_626028453__=$pingjia['pingjia_descriptions_pingjia'];for($i=$__FOR_START_626028453__;$i < $__FOR_END_626028453__;$i+=1){ ?><img src="/Public/Home/image/my_top3.jpg" style="position: relative;top:6px;"><?php } ?>
				</div><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">卖家服务星级：</td>
		<td style="border:none">
			<?php if(($pingjia['pingjia_maijia_pingjia']) != "0"): ?><div style="border:1px solid #ccc;width: 470px;height: 40px;border-radius: 6px">
				<?php $__FOR_START_1987856112__=0;$__FOR_END_1987856112__=$pingjia['pingjia_maijia_pingjia'];for($i=$__FOR_START_1987856112__;$i < $__FOR_END_1987856112__;$i+=1){ ?><img src="/Public/Home/image/my_top3.jpg" style="position: relative;top:6px;"><?php } ?>
				</div><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">运送服务星级：</td>
		<td style="border:none">
			<?php if(($pingjia['pingjia_yunsong_pingjia']) != "0"): ?><div style="border:1px solid #ccc;width: 470px;height: 40px;border-radius: 6px">
				<?php $__FOR_START_1962141837__=0;$__FOR_END_1962141837__=$pingjia['pingjia_yunsong_pingjia'];for($i=$__FOR_START_1962141837__;$i < $__FOR_END_1962141837__;$i+=1){ ?><img src="/Public/Home/image/my_top3.jpg" style="position: relative;top:6px;"><?php } ?>
				</div><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">评价时间：</td>
		<td style="border:none">
			<input type="text" class="form-control pingjia_createtime" style="width:470px;height: 40px" name="pingjia_createtime" readonly="readonly" value="<?php echo (date('Y-m-d H:i:s',$pingjia['pingjia_createtime'])); ?>">	
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">
			
		</td>
		<td style="border:none">
			<!-- <button type="button" class="btn btn-success" value="<?php echo ($repair['repair_id']); ?>">确认修改</button> -->
			<button type="button" class="btn btn-info">返回上页</button>
			<button type="button" class="btn btn-primary">刷新</button>
		</td>
	</tr>
  </table>
</div>
</div>
</body>
<script type="text/javascript">
	$(".btn-info").click(function(){
		window.location.href="<?php echo U('Orderdetails/order_pingjia');?>";
	});
	$(".btn-primary").click(function(){
		location.reload();
	});
/*	$(".btn-success").click(function(){
		repair_id = $(this).val();
		$.ajax({
			type: "POST",
		dataType: "JSON",
			 url: "<?php echo U('Orderdetails/AjaxBaoxiuChuli');?>",
			data: { 'repair_id':repair_id , 'repair_status':$("#repair_status:checked").val() },
			success: function( data ){
				if(data.status == 2000 ){
					alert(data.message);
					window.location.href="<?php echo U('Orderdetails/order_baoxiu');?>";
					return false;
				}else if( data.status == -2000 ){
					alert(data.message);
					return false;
				}
			},
			error: function(XMLHttpRequest , error , status ){
				alert("网络错误，请稍后再尝试" + status );
				return false;
			}
		});
		return false;
	});*/
</script>
</html>