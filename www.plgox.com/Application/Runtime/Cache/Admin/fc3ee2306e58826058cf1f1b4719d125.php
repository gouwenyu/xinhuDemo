<?php if (!defined('THINK_PATH')) exit();?><html>
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
<form class="bs-example bs-example-form" role="form" action="<?php echo U('Qiye/renzheng_shaixuan');?>" method="get">
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group" style="width:400px;">
				<select class="form-control renzheng_shaixuan_1" style="width: 120px;margin-left: 10px" name="renzheng_shaixuan_1">
					  <option value="0">--筛选状态--</option>
					  <option value="1" <?php if(($renzheng_shaixuan_1) == "1"): ?>selected<?php endif; ?> >提交认证</option>
					  <option value="2" <?php if(($renzheng_shaixuan_1) == "2"): ?>selected<?php endif; ?> >审核中</option>
					  <option value="3" <?php if(($renzheng_shaixuan_1) == "3"): ?>selected<?php endif; ?> >审核通过</option>
					  <option value="4" <?php if(($renzheng_shaixuan_1) == "4"): ?>selected<?php endif; ?> >审核未通过</option>
				</select>
				<input type="text" name="search_bianhao" value="<?php echo ($search_bianhao); ?>" placeholder="请输入唯一的认证编号" style="margin-left: 10px;height: 33px;outline: none" >
				<input type="submit" class="btn btn-default" value='🔍' style="margin-left: 10px;" >
			</div><!-- /input-group -->
			<br>
		</div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	<script type="text/javascript">
		$(".btn-default").click(function(){
			if( $(".renzheng_shaixuan_1").val() == '0' ){
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
				<button type="button" class="btn btn-success">添加信息参数</button>
				<button type="button" class="btn btn-info">全选</button>
				<button type="button" class="btn btn-danger">一键删除</button>
			</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr></tr>
		<tr style="background:#F5F5F5;">
			<th style="text-align: center;font-size:14px;">全选</th>
			<th style="text-align: center;font-size:14px;">编号</th>
			<th style="text-align: center;font-size:14px;">用户昵称</th>
			<th style="text-align: center;font-size:14px;">公司名称</th>
			<th style="text-align: center;font-size:14px;">联系电话</th>
			<th style="text-align: center;font-size:14px;">营业执照</th>
			<th style="text-align: center;font-size:14px;">认证状态</th>
			<th style="text-align: center;font-size:14px;">认证编号</th>
			<th style="text-align: center;font-size:14px;">认证时间</th>
			<th style="text-align: center;font-size:14px;">操作</th>
		</tr>
	<?php if(is_array($renzheng)): $i = 0; $__LIST__ = $renzheng;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$renzheng_): $mod = ($i % 2 );++$i;?><tr class="table_tr_<?php echo ($renzheng_['renzheng_id']); ?>">
			<td style="text-align: center;line-height:50px;font-size:14px;"><input type="checkbox" name="" value="<?php echo ($renzheng_['renzheng_id']); ?>" class="check"></td>
			<td style="text-align: center;line-height:50px;font-size:14px;"><?php echo ($renzheng_['renzheng_id']); ?></td>
			<td style="text-align: center;line-height:50px;font-size:14px;"><?php echo ($renzheng_['plgox_user']); ?></td>
			<td style="text-align: center;line-height:50px;font-size:14px;"><?php echo ($renzheng_['renzheng_commpany']); ?></td>
			<td style="text-align: center;line-height:50px;font-size:14px;"><?php echo ($renzheng_['renzheng_tel']); ?></td>
			<td style="text-align: center;line-height:50px;font-size:14px;"><img src="/Uploads/home_renzheng_img/<?php echo ($renzheng_['renzheng_zhizhao_img']); ?>" style="width: 50px;height: 50px"></td>
			<td style="text-align: center;line-height:50px;font-size:14px;">
				<?php if(($renzheng_['renzheng_status'] == 1)): ?>提交认证
				<?php elseif(($renzheng_['renzheng_status'] == 2)): ?>
					审核中
				<?php elseif(($renzheng_['renzheng_status'] == 3)): ?>
					审核通过
				<?php elseif(($renzheng_['renzheng_status'] == 4)): ?>
					审核未通过<?php endif; ?>
			</td>
			<td style="text-align: center;line-height:50px;font-size:14px;">
				<?php echo ($renzheng_['renzheng_bianhao']); ?>
			</td>
			<td style="text-align: center;line-height:50px;font-size:14px;">
				<?php echo (date("Y-m-d H:i:s",$renzheng_['renzheng_createtime'])); ?>
			</td>
			<td style="text-align: center;line-height:50px;font-size:14px;">
				<a href="<?php echo U('Qiye/qiye_rensheng_data');?>&qiye_rensheng_id=<?php echo base64_encode($renzheng_['renzheng_id'])?>" title="编辑板块" class="">查看</a>&nbsp;&nbsp;
				<a href="javascript:void(0);" title="删除" class="del" value="<?php echo ($renzheng_['renzheng_id']); ?>">删除</a>&nbsp;&nbsp;
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
</div>
<div class="container-fluid">
	  <div class="col-xs-12 col-md-8 page" style="width: 100%"><?php echo ($page); ?></div>
</div>
</body>
<script type="text/javascript">
	// 添加新板块
	$(".btn-success").click(function(){
		window.location.href="<?php echo U('Qiye/qiye_info');?>";
	});
	// 单个删除
	$(".del").click(function(){
		renzheng_id = $(this).attr("value");
		if( confirm( "确定要删除本条数据吗？" ) ){
			$.ajax({
				type: "POST",
			dataType: "JSON",
				 url: "<?php echo U('Qiye/renzheng_del');?>",
				data: { 'renzheng_id':renzheng_id },
				success: function( data ){
					if( data.status == 2000 ){
						alert(data.message);
						$(".table_tr_"+renzheng_id).remove();
						return false;
					}else if( data.status == -2001 ){
						alert(data.message);
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
    	renzheng_ids = ids.substring(1);
    	if( renzheng_ids.length == 0 ){
    		alert("请选择要删除的数据");
    	}else if( confirm("确定要全部删除所有数据") ){
    		$.ajax({
    			type: "POST",
    		dataType: "JSON",
    			 url: "<?php echo U('Qiye/renzheng_del');?>",
    			data: { 'renzheng_ids':renzheng_ids },
    			success: function( data ){
    				if( data.status == 2000 ){
    					alert(data.message);
    					location.reload();
    					return false;
    				}else if( data.status == -2001 ){
    					alert(data.message);
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