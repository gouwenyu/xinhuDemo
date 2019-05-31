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
<form class="bs-example bs-example-form" role="form" action="<?php echo U('Orderdetails/order_pingjia_shaixuan');?>" method="get">
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group" style="width:400px;">
				<select class="form-control pingjia_shaixuan" style="width: 120px" name="pingjia_shaixuan">
					  <option value="0">--筛选条件--</option>
					  <option value="1" <?php if(($pingjia_shaixuan) == "1"): ?>selected<?php endif; ?> >自营评价数据</option>
					  <option value="2" <?php if(($pingjia_shaixuan) == "2"): ?>selected<?php endif; ?> >商家评价数据</option>
				</select>
				<input type="submit" class="btn btn-default" value='🔍' style="margin-left: 10px" >
			</div><!-- /input-group -->
			<br>
		</div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	<script type="text/javascript">
		$(".btn-default").click(function(){
			if( $(".pingjia_shaixuan").val() == '0' ){
				alert("筛选条件是必选的!");
				return false;
			}
		});
	</script>
</form>
</div>
<div class="table-responsive">
	<table style="border: 1px solid #DDDDDD;" class="table">
		<tr>
			<td>
				<button type="button" class="btn btn-info">全选</button>
				<button type="button" class="btn btn-danger">一键删除</button>
			</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr></tr>
		<tr style="background:#F5F5F5;">
			<th style="text-align: center;">全选</th>
			<th style="text-align: center;">编号</th>
			<th style="text-align: center;">评价方</th>
			<th style="text-align: center;">被评方</th>
			<th style="text-align: center;">内容</th>
			<th style="text-align: center;">图片</th>
			<th style="text-align: center;">描述相符评价</th>
			<th style="text-align: center;">卖家服务评价</th>
			<th style="text-align: center;">运送服务评价</th>
			<th style="text-align: center;">评价时间</th>
			<th style="text-align: center;">操作</th>
		</tr>
	<?php if(is_array($pingjia)): $i = 0; $__LIST__ = $pingjia;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pingjia_): $mod = ($i % 2 );++$i;?><tr class="table_tr_<?php echo ($pingjia_['pingjia_id']); ?>">
			<td style="text-align: center;line-height:50px;"><input type="checkbox" name="" value="<?php echo ($pingjia_['pingjia_id']); ?>" class="check"></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($pingjia_['pingjia_id']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($pingjia_['plgox_user']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo (get_shanjia_by_id($pingjia_['cart_shangjia_id'],"Member","plgox_user","plgox_id")); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($pingjia_['pingjia_content']); ?></td>
			<td style="text-align: center;line-height:50px;"><img src="/Uploads/home_pingjia_img/<?php echo ($images[$key]['0']); ?>" style="width: 50px;height: 50px"></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($pingjia_['pingjia_descriptions_pingjia']); ?>星</td>
			<td style="text-align: center;line-height:50px;"><?php echo ($pingjia_['pingjia_maijia_pingjia']); ?>星</td>
			<td style="text-align: center;line-height:50px;"><?php echo ($pingjia_['pingjia_yunsong_pingjia']); ?>星</td>
			<td style="text-align: center;line-height:50px;"><?php echo (date("Y-m-d H:i:s",$pingjia_['pingjia_createtime'])); ?></td>
			<td style="text-align: center;line-height:50px;">
				<a href="<?php echo U('Orderdetails/order_pingjia_look');?>&order_pingjia_id=<?php echo base64_encode($pingjia_['pingjia_id'])?>" title="编辑板块" class="">查看</a>&nbsp;&nbsp;
				<a href="javascript:void(0);" title="删除" class="del" value="<?php echo ($pingjia_['pingjia_id']); ?>">删除</a>&nbsp;&nbsp;
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
</div>
<div class="container-fluid">
	  <div class="col-xs-12 col-md-8 page" style="width: 100%"><?php echo ($page); ?></div>
</div>
</body>
<script type="text/javascript">
	// 单个删除
	$(".del").click(function(){
		pingjia_id = $(this).attr("value");
		if( confirm( "确定要删除本条数据吗？" ) ){
			$.ajax({
				type: "POST",
			dataType: "JSON",
				 url: "<?php echo U('Orderdetails/pingjia_del');?>",
				data: { 'pingjia_id':pingjia_id },
				success: function( data ){
					if( data.status == 2000 ){
						alert(data.message);
						$(".table_tr_"+pingjia_id).remove();
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
    	pingjia_ids = ids.substring(1);
    	if( pingjia_ids.length == 0 ){
    		alert("请选择要删除的数据");
    	}else if( confirm("确定要全部删除所有数据") ){
    		$.ajax({
    			type: "POST",
    		dataType: "JSON",
    			 url: "<?php echo U('Orderdetails/pingjia_del');?>",
    			data: { 'pingjia_ids':pingjia_ids },
    			success: function( data ){
					console.log(data);
    				if( data.status == 2002 ){
    					alert(data.message);
    					location.reload();
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
</script>
</html>