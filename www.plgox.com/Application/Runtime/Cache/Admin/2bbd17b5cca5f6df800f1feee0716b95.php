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
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">信用金：</td>
		<td style="border:none">
			<input type="text" class="form-control xyj_steup"  value="<?php echo ($xyj_steup['xyj_prices']); ?>" placeholder="百分比的信用金请以小数为基准，如：10% = 0.1，就输入0.1" style="width:470px;height: 40px" name="xyj_prices" >
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">新增时间：</td>
		<td style="border:none">
			<div class="form-group">
				<?php if(($xyj_steup['xyj_id']) != ""): ?><input id="datepicker-example2" type="text" value="<?php echo (date('Y-m-d',$xyj_steup['xyj_createtime'])); ?>" class="form-control xyj_createtime" style="width:470px;height: 40px" name="xyj_createtime" >
				<?php else: ?>
					<input id="datepicker-example2" type="text" value="<?php echo (date('Y-m-d',$time)); ?>" class="form-control xyj_createtime" style="width:470px;height: 40px" name="xyj_createtime" ><?php endif; ?>
			</div>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">
			
		</td>
		<td style="border:none">
			<?php if(($xyj_steup['xyj_id']) != ""): ?><button type="button" class="btn btn-success" value="<?php echo ($xyj_steup['xyj_id']); ?>">确认修改</button>
			<?php else: ?>
				<button type="button" class="btn btn-success">确认新增</button><?php endif; ?>
			<button type="button" class="btn btn-danger">返回上页</button>
		</td>
	</tr>
  </table>
</div>
</div>
</body>
<script type="text/javascript">
	$(".btn-danger").click(function(){
		window.location.href="<?php echo U('Share/share_module_list');?>";
	});
	$(".btn-success").click(function(){
		var res = /^\d*?\.?\d*?$/;
		if( $(".xyj_steup").val() == "" ){
			alert("信用金不可为空");
			return false;
		}else if( !res.test( $(".xyj_steup").val() ) ){
			alert("信用金输入不可以是英文/字母/下划线");
			return false;
		}else if(  $(".xyj_steup").val()  == "." ){
			alert("信用金输入不可以只有一个小数点");
			return false;
		}else{
			xyj_id = $(this).val();
			$.ajax({
				type: "POST",
			dataType: "JSON",
				 url: "<?php echo U('Xyj/num_edit');?>",
				data: { 'xyj_id':xyj_id , 'xyj_prices':$(".xyj_steup").val() , 'xyj_createtime':$(".xyj_createtime").val() },
				success: function( data ){
					if(data.status == 2000 ){
						alert(data.message);
						window.location.reload();
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
		}
	});
</script>
</html>