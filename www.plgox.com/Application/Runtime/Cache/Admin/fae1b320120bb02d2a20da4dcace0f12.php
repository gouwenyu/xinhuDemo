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
    /*****************************  分类div表格样式  *************************************/
	ul{margin:0;padding:0;list-style:none;}  
	.table{display:table;border-collapse:collapse;border:1px solid #ccc;}  
	.table-caption{display:table-caption;margin:0;padding:0;font-size:16px;}  
	.table-column-group{display:table-column-group;}  
	.table-column{display:table-column;width:100px;}  
	.table-row-group{display:table-row-group;}  
	/*.table-row{border:1px solid red;}  */
	.table-row-group .table-row:hover,.table-footer-group .table-row:hover{background:#f6f6f6;}  
	.table-cell{display:table-cell;padding:0 5px;height: 50px;line-height: 50px;width:200px}  /*#ccc*/
	.table-cell_{padding:0 5px;height: 50px;line-height: 50px;}  
	.table-header-group{display:table-header-group;background:#eee;font-weight:bold;}  
	.table-footer-group{display:table-footer-group;} 
</style>
<body>
<ol class="breadcrumb">
	<li>当前位置</li>
	<li><?php echo ($setTitle); ?></li>
</ol>
<div class="container-fluid">
<form class="bs-example bs-example-form" role="form" action="<?php echo U('User/classify_select_search');?>" method="get">
	<div class="row">
		<div class="col-lg-6">
			<div class="input-group" style="width:400px;">
				<input type="text" class="form-control search" style="height:30px;" name="search_fields">
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
				<button type="button" class="btn btn-success">添加新分类</button>
				<button type="button" class="btn btn-info">全选</button>
				<button type="button" class="btn btn-danger">一键删除</button>
			</td>
		</tr>
	</table>
<!-- 	<table class="table">
		<tr style="background:#F5F5F5;">
			<th style="text-align: center;">全选</th>
			<th style="text-align: center;">编号</th>
			<th style="text-align: center;">分类名</th>
			<th style="text-align: center;">创建时间</th>
			<th style="text-align: center;">排序</th>
			<th style="text-align: center;">状态</th>
			<th style="text-align: center;">操作</th>
		</tr>
		<?php echo ($classify_select); ?>
	</table> -->
	<div class="table">
		<div class="table-header-group">  
            <ul class="table-row">  
                <li class="table-cell" style="position: relative;left:25px;">分类管理</li>  
                <!-- <li class="table-cell">编号</li>  
                <li class="table-cell">分类名</li>  
                <li class="table-cell">时间</li>  
                <li class="table-cell">排序</li>  
                <li class="table-cell">状态</li>  
                <li class="table-cell">操作</li>   -->
            </ul>  
        </div> 
        <div class="table-row-group">  
        	<?php echo ($classify_select); ?>
            <!-- <ul class="table-row">   -->
                <!-- <li class="table-cell_" style="text-align:center;border-bottom: 1px solid red;">1</li> -->
              <!--   
                <li class="table-cell_">John</li>  
                <li class="table-cell_">19</li>  
                <li class="table-cell_">19</li>  
                <li class="table-cell_">19</li>  
                <li class="table-cell_">19</li>  
                <li class="table-cell_">19</li>   -->
            <!-- </ul>   -->
            <!-- <ul class="table-row">  
                <li class="table-cell">2</li>  
                <li class="table-cell">Mark</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">21</li>  
            </ul>  
            <ul class="table-row">  
                <li class="table-cell">3</li>  
                <li class="table-cell">Kate</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">19</li>  
                <li class="table-cell">26</li>  
            </ul>   -->
        </div>  
	</div>
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