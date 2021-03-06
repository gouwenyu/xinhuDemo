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
	<link rel="stylesheet" href="/Public/Admin/css/style_.css" />
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/base_64.js"></script>
</head>
<style type="text/css">
	.classify_css{
		border:1px solid #00FF66;
		width:270px;
		float:left;
		padding:10px 40px 10px 0px;
		color:#33CC66;
		background: #CCFFFF;
		display: block;
	}
	.classify_css:hover{
		color:#33CC66;
	}
	.classify_1,.classify_2,.classify_3{
		width:270px;
		padding:10px 40px 10px 0px;
		float:left;
	}
	.classify_1:hover,.classify_2:hover,.classify_3:hover{
		color:#33CC66;
	}
</style>
<body>
<ol class="breadcrumb">
	<li>当前位置</li>
	<li><?php echo ($setTitle); ?></li>
</ol>
<div class="contains">
	<!--商品分类-->
    <div class="wareSort clearfix">
		<ul id="sort1">
			<?php if(is_array($classify)): $i = 0; $__LIST__ = $classify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$classify_): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);" class="classify_1" classify-id="<?php echo ($classify_['classify_id']); ?>" style="outline: none;text-decoration:none;"><?php echo ($classify_['classify_title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<ul id="sort2" style="display: none;"></ul>
		<ul id="sort3" style="display: none;"></ul>
	</div>
	<div class="selectedSort"><b>您当前选择的商品类别是：</b><i id="selectedSort"></i></div>
	<div class="wareSortBtn">
		<input id="releaseBtn" attr-id="<?php echo ($share_classify_pid); ?>" type="button" value="下一步"/>
		<input class="btn btn-primary" type="button" value="上一级" style="position: relative;top:-2px;" />
		<input class="btn btn-info" type="button" value="刷新" style="position: relative;top:-2px;" />
	</div>
	<!-- <script src="/Public/Admin/js/jquery.sort.js"></script> -->
</div>

</body>
<script type="text/javascript">
	/*$(document).ready(function(){
		if( "<?php echo ($classify_['classify_id']); ?>" ){
			$("#sort3").css("display","block");
			// $("#sort3").append(ejfl_content);
			sanjifenlei( false , false , "<?php echo ($classify_['classify_id']); ?>" );
		}
	});*/
	// 添加新板块
	$(".btn-success").click(function(){
		// <?php echo U('Share/share_product_data');?> //添加商品的页面
		window.location.href="<?php echo U('Share/share_select_classify_product');?>";
	});
	// 返回上一级
	$(".btn-primary").click(function(){
		// <?php echo U('Share/share_product_data');?> //添加商品的页面
		window.location.href="<?php echo U('Share/share_product_list');?>";
	});
	// 刷新
	$(".btn-info").click(function(){
		location.reload();
	});
	/******************************************* 分类 **********************************************/
	$(".classify_1").each(function( index ){ // 一级分类样式
		$(this).click(function(){
			$("#selectedSort").text($(this).text());
			$("#sort2").empty();
			$("#releaseBtn").attr("attr-id",$(this).attr("classify-id"));
			// .next().addClass("classify_css").prev().removeClass("classify_css")
			// $(this).addClass("classify_css").prev().removeClass("classify_css").next().addClass("classify_css");
			$(this).siblings().removeClass("classify_css");  
			$(this).toggleClass("classify_css");
			erjifenlei( $(this).text() , $(this).attr("classify-id") );
		});
	});
	function erjifenlei( val , id){
		$.post("share_classify_erji",{ erjifenlei:id },function( data ){ //获取二级分类
			$.each(data,function( index , value ){
				var ejfl_content = '<a href="javascript:void(0);" class="classify_2" classify-id="'+value['classify_id']+'" style="outline: none;text-decoration:none;">'+value['classify_title']+'</a><br /><br />';
					$("#sort2").css("display","block");
					$("#sort3").css("display","none");
					$("#sort2").append(ejfl_content);
				$(".classify_2").eq(index).on("click",function(){
					$("#selectedSort").text(val+">"+$(this).text());
					$("#sort3").empty();
					$("#releaseBtn").attr("attr-id",value['classify_id']);
					$(this).siblings().removeClass("classify_css");  
					$(this).toggleClass("classify_css");
					sanjifenlei( val , $(this).text() , value['classify_id'] );
				});
			});
		},"json");
	}
	function sanjifenlei( val_ , val , id ){
		$.post("share_classify_sanji",{ sanjifenlei:id },function( data ){ //获取二级分类
			$.each(data,function( index , value ){
				var ejfl_content = '<a href="javascript:void(0);" class="classify_3" classify-id="'+value['classify_id']+'" style="outline: none;text-decoration:none;">'+value['classify_title']+'</a><br /><br />';
				$("#sort3").css("display","block");
				$("#sort3").append(ejfl_content);
				$(".classify_3").eq(index).on("click",function(){
					$("#releaseBtn").attr("attr-id",value['classify_id']);
					$("#selectedSort").text( val_ +">"+ val +">"+ $(this).text() );
					$(this).siblings().removeClass("classify_css");  
					$(this).toggleClass("classify_css");
				});
			});
		},"json");
	}
	/******************************************* 进入商品页面 **********************************************/
	$("#releaseBtn").click(function(){
		 var base = new Base64();
		 var content = base.encode("<?php echo ($share_product_id); ?>");
		//添加商品的页面
		if( $(this).attr("attr-id") == 0 ){
			alert("请先选择分类，然后在进行商品添加!");
			return false;
		}else{
			window.location.href="<?php echo U('Share/share_product_data');?>&share_product_id="+content+"&product_classify_id="+$(this).attr("attr-id");
		}
	});
</script>
</html>