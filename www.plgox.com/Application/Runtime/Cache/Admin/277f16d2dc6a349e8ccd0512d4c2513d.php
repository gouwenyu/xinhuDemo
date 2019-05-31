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
<form class="bs-example bs-example-form" role="form" action="<?php echo U('User/user_address_list');?>" method="get">
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group" style="width:400px;">
				<input type="text" class="form-control search" style="height:30px;" name="search_fields" value="<?php echo ($search_name); ?>">
				<span class="input-group-btn">
					<input type="submit" class="btn btn-default" value="搜索" style="height: 30px;">
				</span>
			</div><!-- /input-group -->
			<br>
		</div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
</form>
</div>
<div class="table-responsive">
	<table style="border: 1px solid #DDDDDD;" class="table">
		<tr>
			<td>
				<button type="button" class="btn btn-success">添加板块</button>
				<button type="button" class="btn btn-info">全选</button>
				<button type="button" class="btn btn-danger">一键删除</button>
			</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr></tr>
		<tr style="background:#F5F5F5;">
			<th style="text-align: center;">全选</th>
			<th style="text-align: center;">ID</th>
			<th style="text-align: center;">板块名</th>
			<th style="text-align: center;">板块描述</th>
			<th style="text-align: center;">板块添加时间</th>
			<th style="text-align: center;">板块更改时间</th>
			<th style="text-align: center;">操作</th>
		</tr>
	<?php if(is_array($share_list)): $i = 0; $__LIST__ = $share_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$share_list_): $mod = ($i % 2 );++$i;?><tr class="table_tr_<?php echo ($share_list_['module_id']); ?>">
			<td style="text-align: center;line-height:50px;"><input type="checkbox" name="" value="<?php echo ($share_list_['module_id']); ?>" class="check"></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($share_list_['module_id']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($share_list_['module_title']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo ($share_list_['module_descriptions']); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo (date("Y-m-d H:i:s",$share_list_['module_createtime'])); ?></td>
			<td style="text-align: center;line-height:50px;"><?php echo (date("Y-m-d H:i:s",$share_list_['module_updatetime'])); ?></td>
			<td style="text-align: center;line-height:50px;">
				<a href="<?php echo U('Share/share_module_data');?>&module_edit_id=<?php echo base64_encode($share_list_['module_id'])?>" title="编辑板块" class=""><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
				<a href="javascript:void(0);" title="删除" class="del" value="<?php echo ($share_list_['module_id']); ?>"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;
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
		window.location.href="<?php echo U('Share/share_module_data');?>";
	});
	// 单个删除
	$(".del").click(function(){
		module_id = $(this).attr("value");
		if( confirm( "确定要删除该用户吗？" ) ){
			$.ajax({
				type: "POST",
			dataType: "JSON",
				 url: "<?php echo U('Share/module_del');?>",
				data: { 'module_id':module_id },
				success: function( data ){
					if( data.status == 2000 ){
						alert(data.message);
						$(".table_tr_"+module_id).remove();
						return false;
					}else if(data.status == 2003 ){
    					alert(data.message);
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
    	module_ids = ids.substring(1);
    	if( module_ids.length == 0 ){
    		alert("请选择要删除的数据");
    	}else if( confirm("确定要全部删除所有数据") ){
    		$.ajax({
    			type: "POST",
    		dataType: "JSON",
    			 url: "<?php echo U('Share/module_del');?>",
    			data: { 'module_ids':module_ids },
    			success: function( data ){
    				if( data.status == 2002 ){
    					alert(data.message);
    					location.reload();
    					return false;
    				}else if(data.status == 2003 ){
    					alert(data.message);
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