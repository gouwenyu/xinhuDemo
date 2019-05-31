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
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/zebra_datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Common/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/Public/Common/bootstrap/css/zebra_datepicker.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/loading-style.css">
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/zebra_datepicker.min.js"></script>
	<script type="text/javascript" src="/Public/Common/bootstrap/js/examples.js"></script>
	<!-- 编辑器引入文件 -->
	<script type="text/javascript" charset="utf-8" src="/Public/Common/bootstrap/UEditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Common/bootstrap/UEditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/Public/Common/bootstrap/UEditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="/Public/Common/bootstrap/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="/Public/Common/bootstrap/js/base_64.js"></script>
</head>
<style type="text/css">
	#hideShow{opacity: 0.2;background-color:#000;position: fixed;width:100%;height: 100%;z-index: 9999;display: none;}
	.loading{border:1px solid #AEDEF4;background:#FFFFFF;width:512px;height:367px;border-radius:10px;position:fixed;left:32%;top:200px;z-index: 99999;display: none;}
	.font-style{position:relative;left:110px;font-size:35px;font-family:楷体;top:100px;font-weight:bold;}
	.font-styles{position: relative;left:90px;top:200px;font-family:楷体;}
	/*.add_sp_{width:55%;height: 400px;position: fixed;z-index: 9999;background:#fff;margin-left:23%;margin-top:15%;}*/
	.add_sp_1{border: 1px solid #CDCDCD;width:55%;height: 400px;position: fixed;z-index: 99999999;background:#fff;overflow:scroll;margin-top:15%;margin-left:23%;}
	.cosle_win{border: 1px solid #CDCDCD;width:55%;position: fixed;z-index: 99999999;background:#fff;height:40px;margin-top:12%;margin-left:23%;}
	.zzc{height:100%;width:100%;position: fixed;background:black;z-index: 9999999;opacity: 0.3}
</style>
<body>
<?php if(($share['share_id']) == ""): ?><div id="hideShow"></div>
	<div class="loading">
	<span class="font-style">正在添加，请稍后......</span>
	<div class="loader">
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
	</div>
	<span class="font-styles">注：添加过慢,可能是上传的图片或者文件过大,请稍等几秒!</span>
	</div>
<?php else: ?>
	<div id="hideShow"></div>
	<div class="loading">
	<span class="font-style">正在修改，请稍后......</span>
	<div class="loader">
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
		  <div class="dot"></div>
	</div>
	<span class="font-styles">注：添加过慢,可能是上传的图片或者文件过大,请稍等几秒!</span>
	</div><?php endif; ?>
<!-- 遮罩层 -->
<div class="zzc" style="display: none;"></div>
<!-- 规格样式 -->
<div class="cosle_win" style="display: none;">
	<span style="line-height: 40px;margin-left:7%;color: red">添加商品规格</span><span style="cursor: pointer;float: right;padding: 10px" class="glyphicon glyphicon-remove cosle_win_"></span>
</div>
<div class="add_sp_" style="display: none;">
	<div class="add_sp_1">
		<div class="table-responsive">
<!-- <form action="<?php echo U('Share/share_specifications_add');?>" method="post"> -->
  <table class="table table-bordered">
  	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">套餐名称：</td>
		<td>
			<input type="text" class="form-control specifications_keys" style="width:470px;" name="specifications_keys">
		</td>
	</tr>
  	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品界面图<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td style="border:none">
			<?php if(($specifications['specifications_img']) != ""): ?><img src="/Uploads/admin/<?php echo ($specifications['specifications_img']); ?>" alt="" style="width:150px;height:150px;cursor:pointer;" class="images1">&nbsp;&nbsp;&nbsp;
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" alt="" style="width:150px;height:150px;cursor:pointer" class="images1">&nbsp;&nbsp;&nbsp;<?php endif; ?>
			<input type="file" id="exampleInputFile1_" value="" style="display:none" name="pic_img[]">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">所属分类：</td>
		<td>
			<!-- <select class="form-control specifications_classify_id" style="width:470px" name="specifications_classify_id">
				<option value="0">--请选择所属分类--</option>
				<?php echo ($classify); ?>
			</select> -->
			<input type="text" class="form-control specifications_classid" style="width:470px;" name="specifications_classid" disabled="disabled" value="<?php echo ($classify_name['classify_title']); ?>">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">规格名称：</td>
		<td>
			<input type="text" class="form-control specifications_name" style="width:470px;" name="specifications_name">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">租金价格：</td>
		<td>
			<input type="text" class="form-control specifications_rent" style="width:470px;" name="specifications_rent">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">市场价格：</td>
		<td>
			<input type="text" class="form-control specifications_market" style="width:470px;" name="specifications_market">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">出售价格：</td>
		<td>
			<input type="text" class="form-control specifications_prices" style="width:470px;" name="specifications_prices">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">起租天数：</td>
		<td>
			<div class="radio">
				<?php if(is_array($zulin_day)): $i = 0; $__LIST__ = $zulin_day;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zulin_): $mod = ($i % 2 );++$i;?><label>
						<input type="radio" name="specifications_day_number_id" id="specifications_day_number_id" value="<?php echo ($zulin_['zulin_id']); ?>" <?php if(($zulin_['zulin_id']) == $specifications['specifications_day_number_id']): ?>checked<?php endif; ?> ><?php echo ($zulin_['zulin_day_number']); ?>天&nbsp;&nbsp;
					</label><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">押金价格：</td>
		<td>
			<input type="text" class="form-control specifications_deposit" style="width:470px;" name="specifications_deposit">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">商品库存：</td>
		<td>
			<input type="text" class="form-control specifications_stock" style="width:470px;" name="specifications_stock">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">租满特权：</td>
		<td>
		<div class="checkbox">
			    <label>
			      <input type="checkbox" value="租满即送" name="specifications_give" class="specifications_give">租满即送
			    </label>&nbsp;&nbsp;
			    <input type="number" value="<?php echo ($specifications['specifications_day_number']); ?>" style="width:40px;outline:none;text-align:center;" name="specifications_day_number" class="specifications_day_number">
			    <select style="width:90px;height:26px;float: right;position:relative;right:57.3%;outline:none" name="specifications_day_type" class="form-control specifications_day_type">
			    		<option value="">--请选择--</option>
			    		<option value="月" <?php if(($specifications['specifications_day_type']) == "月"): ?>selected<?php endif; ?> >月</option>
			    		<option value="天" <?php if(($specifications['specifications_day_type']) == "天"): ?>selected<?php endif; ?> >天</option>
			    		<option value="年" <?php if(($specifications['specifications_day_type']) == "年"): ?>selected<?php endif; ?> >年</option>
			    </select>
			</div>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">满意度：</td>
		<td>
			<input type="number" class="form-control specifications_satisfaction" style="width:470px;" name="specifications_satisfaction">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">出租率：</td>
		<td>
			<input type="number" class="form-control specifications_chuzu" style="width:470px;" name="specifications_chuzu">
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品状态：</td>
		<td style="border:none;line-height: 40px">
			  <label>
			    <input type="radio" name="specifications_status" id="optionsRadios2" value="0" checked>&nbsp;开启
			  </label>
			  <label>
			    <input type="radio" name="specifications_status" id="optionsRadios2" value="1" >&nbsp;关闭
			  </label>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">
			
		</td>
		<td style="border:none">
			<button type="button" class="btn qrxt">确认新增</button>
		</td>
	</tr>
  </table>
</div>
<script type="text/javascript">
	$(".images1").click(function(){
		$("#exampleInputFile1_").click();
		$("#exampleInputFile1_").off("change");
		$("#exampleInputFile1_").on('change',function(){
			// 判断上传的限制
			if( $(this)[0].files[0].size > 10485760){
				alert("上传文件超出了特定的上传限制!");
				return false;
			}else{
				var objUrl = getUploads(this.files[0]);
				if( objUrl ){
					$(".images1").attr("src",objUrl);
				}
			}
		});
	});
	function getUploads(files){
	url = null;
	if( window.createObjectURL !== undefined ){
		url = window.createObjectURL(files);
	}else if( window.URL !== undefined ){
		url = window.URL.createObjectURL(files);
	}else if( window.webkitURL != undefined ){
		url = window.webkitURL.createObjectURL(files);
	}
	return url;
	}
	$(".btn-danger").click(function(){
		window.location.href="<?php echo U('Share/share_specifications_list');?>";
	});
	$(".btn-primary").click(function(){
		location.reload();
	});
	$(".qrxt").click(function(){
		/**
		 * 判断金额是否出错
		 */
		// 判断分类是否选择
		if( $('.specifications_keys').val() == "" ){
			alert("套餐名称是不能够为空的");
			return false;
		}
		// 判断市场价格  
		var prices = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
		if( !prices.test( $(".specifications_market").val()  ) ){
			alert("您输入的市场金额字符有问题!");
			return false;
		}
		// 租金
		if( !prices.test($(".specifications_rent").val()) ){
			alert("您输入的租金金额字符有问题!");
			return false;
		}
		// 押金
		if( !prices.test( $(".specifications_deposit").val() ) ){
			alert("您输入的押金金额字符有问题!");
			return false;
		}
		// 出售价
		if( !prices.test( $(".specifications_prices").val() ) ){
			alert("您输入的出售金额字符有问题!");
			return false;
		}
		// 租赁天数
		if( $("#specifications_day_number_id:checked").val() == "undefined"  ){
			alert("请选择租赁的天数!");
			return false;
		}
		// 判断库存
		var stock = /^[0-9]\d*$/;
		if( !stock.test( $(".specifications_stock").val() ) ){
			alert("您输入的库存字符有问题!");
			return false;
		}
		if( $('.specifications_name').val() == "" ){
			alert("产品名称是不能够为空的");
			return false;
		}
		specifications_id = $(this).val();
		$.ajaxFileUpload({
			type: "POST",
	  dataType: "JSON",
	  fileElementId:["exampleInputFile1_"],
	  		  url: "<?php echo U('Share/share_specifications_add');?>",
	  		data: {
	  				'specifications_id':specifications_id ,  
	  				'specifications_keys':$(".specifications_keys").val(),
	  				'specifications_classify_id':"<?php echo ($classify); ?>",
	  				'specifications_satisfaction':$(".specifications_satisfaction").val(),
	  				'specifications_chuzu':$(".specifications_chuzu").val(),
					'specifications_name':$(".specifications_name").val(),
					'specifications_prices':$(".specifications_prices").val(),
					'specifications_day_number':$(".specifications_day_number").val(),
					'specifications_day_type':$(".specifications_day_type").val(),
					'specifications_day_number_id':$("#specifications_day_number_id:checked").val(),
					'specifications_rent':$('.specifications_rent').val(),
					'specifications_give':$(".specifications_give:checked").val(),
					'specifications_market':$(".specifications_market").val() ,  
					'specifications_deposit':$(".specifications_deposit").val() ,
					'specifications_stock':$(".specifications_stock").val() ,
					'specifications_status':$("#optionsRadios2:checked").val()
	  			 },
	  		success: function( data ){
				var reg = /<pre.+?>(.+)<\/pre>/g;
				var result = data.match(reg);
				data = RegExp.$1;
				var obj  = eval('('+data+')');
				if( obj.status == 2000){
					alert(obj.message);
					location.reload();
					return false;
				}else if( obj.status == -2000 ){
					alert(obj.message);
					return false;
				}else if( obj.status == -2002 ){
					alert(obj.message);
					return false;
				}
	  		},
	  		error: function( XMLHttpRequest , error , status ){
	  			alert("出现错误，错误位置在：" + status );
	  			return false;
	  		}
		});

/*		$.ajax({
			type: "POST",
		dataType: "JSON",
			 url: "<?php echo U('Share/share_specifications_add');?>",
			data: { 
						'specifications_id':specifications_id ,  
						'specifications_name':$(".specifications_name").val(),
						'specifications_rent':$('.specifications_rent').val(),
						'specifications_give':$(".specifications_give:checked").val(),
						'specifications_market':$(".specifications_market").val() ,  
						'specifications_deposit':$(".specifications_deposit").val() ,
						'specifications_stock':$(".specifications_stock").val() ,
						'specifications_status':$("input[type='radio']:checked").val() 
					},
			success: function( data ){
				if(data.status == 2000 ){
					alert(data.message);
					window.location.href="<?php echo U('Share/share_specifications_list');?>";
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
		});*/
		return false;
	});
</script>
	</div>	
</div>	


<div class="container-fluid">
<ol class="breadcrumb">
<li>当前位置</li>
<li><?php echo ($setTitle); ?></li>
</ol>
<div class="table-responsive">
  <table class="table table-bordered">
  	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">所属板块<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td style="border:none">
				<select class="form-control share_module_id" style="width:470px" name="share_module_id">
				  <option value="0">--请选择所属板块--</option>
				  <!-- <?php echo ($classify); ?> -->
				  <?php if(is_array($module)): $i = 0; $__LIST__ = $module;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$module_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($module_['module_id']); ?>" <?php if(($module_['module_id']) == $module_id): ?>selected<?php endif; ?> ><?php echo ($module_['module_title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品规格<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td>
		<div class="checkbox">
		<?php if(is_array($specifications)): $i = 0; $__LIST__ = $specifications;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$specifications_): $mod = ($i % 2 );++$i;?><label>
			      <input type="checkbox" value="<?php echo ($specifications_['specifications_id']); ?>" name="share_product_type_id" class="share_product_type_id" <?php if(in_array(($specifications_['specifications_id']), is_array($share['share_product_type_id'])?$share['share_product_type_id']:explode(',',$share['share_product_type_id']))): ?>checked<?php endif; ?> ><?php echo ($specifications_['specifications_name']); ?>
			    </label>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
		<a href="javascript:void(0);" class="add_sp" style="text-decoration:none">添加规格</a>
		<!-- <button type="button" class="btn btn-primary">刷新</button> -->
		</div>
		</td>
	</tr>
  	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品界面图<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td style="border:none">
			<?php if(($share['share_home_img']) != ""): ?><img src="/Uploads/admin/<?php echo ($share['share_home_img']); ?>" alt="" style="width:150px;height:150px;cursor:pointer" class="image1">&nbsp;&nbsp;&nbsp;
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" alt="" style="width:150px;height:150px;cursor:pointer" class="image1">&nbsp;&nbsp;&nbsp;<?php endif; ?>
			<input type="file" id="exampleInputFile1" value="" style="display:none" name="pic_img[]">				
		</td>
	</tr>
	<tr>
	<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品多图<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
	<td style="border:none;line-height: 40px">
		<div id="Uplaods-many-img">
			<?php if(($share_many_img['0']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['0']); ?>" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image2">
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image2"><?php endif; ?>
			<input type="file" id="exampleInputFile2" value="" style="display:none" name="pic_img[]">
			<?php if(($share_many_img['1']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['1']); ?>" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image3">
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image3"><?php endif; ?>
			<input type="file" id="exampleInputFile3" value="" style="display:none" name="pic_img[]">
			<?php if(($share_many_img['2']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['2']); ?>" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image4">
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image4"><?php endif; ?>
			<input type="file" id="exampleInputFile4" value="" style="display:none" name="pic_img[]">
			<?php if(($share_many_img['3']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['3']); ?>" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image5">
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image5"><?php endif; ?>
			<input type="file" id="exampleInputFile5" value="" style="display:none" name="pic_img[]">
			<?php if(($share_many_img['4']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['4']); ?>" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image6">
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image6"><?php endif; ?>
			<input type="file" id="exampleInputFile6" value="" style="display:none" name="pic_img[]">
			<?php if(($share_many_img['5']) != ""): ?><img src="/Uploads/admin/<?php echo ($share_many_img['5']); ?>" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image7">
			<?php else: ?>
				<img src="/Public/Common/bootstrap/img/upload_img.jpg" style="width:150px;height:150px;margin-right:10px;cursor:pointer" class="image7"><?php endif; ?>
			<input type="file" id="exampleInputFile7" value="" style="display:none" name="pic_img[]"><a style="text-decoration:none;color:red">展示图：最多上传六张!</a>
		</div>
	</td>
</tr>


  	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品名称<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td style="border:none">
			<input type="text" class="form-control share_name" style="width:470px;height: 40px" name="share_name" value="<?php echo ($share['share_name']); ?>" maxlength="50"><font class="font-key"></font>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">副标题：</td>
		<td style="border:none">
			<input type="text" class="form-control share_key" style="width:470px;height: 40px" name="share_key" value="<?php echo ($share['share_key']); ?>" maxlength="100"><font class="font-keys"></font>	
		</td>
	</tr>
<!-- 	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">展示租金<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td style="border:none">
			<input type="text" class="form-control share_rent" style="width:470px;height: 40px" name="share_rent" value="<?php echo ($share['share_rent']); ?>"><a style="text-decoration:none;color:red;">注:该租金是该商品首页展示型租金,仅供参考!</a>
		</td>
	</tr> -->
<!-- 	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">所属分类<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td style="border:none">
				<select class="form-control share_classify_id" style="width:470px" name="share_classify_id">
				  <option value="0">--请选择所属分类--</option>
				  <?php echo ($classify); ?>
				</select>
		</td>
	</tr> -->
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">生产产地：</td>
		<td>
			<input type="text" class="form-control share_chandi" style="width:470px;" name="share_chandi" value="<?php echo ($share['share_chandi']); ?>">
		</td>
	</tr>
		<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">提供商：</td>
		<td>
			<input type="text" class="form-control share_cptgs" style="width:470px;" name="share_cptgs" value="<?php echo ($share['share_cptgs']); ?>">
		</td>
	</tr>
	<tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品重量：</td>
		<td>
			<input type="text" class="form-control 	share_weight" style="width:470px;" name="share_weight" value="<?php echo ($share['share_weight']); ?>">
		</td>
	</tr>
	<tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品材质：</td>
		<td>
			<input type="text" class="form-control share_caizhi" style="width:470px;" name="share_caizhi" value="<?php echo ($share['share_caizhi']); ?>">
		</td>
	</tr>
	<tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">生产日期：</td>
		<td>
			<input type="text" class="form-control share_production_date" style="width:470px;" name="share_production_date" value="<?php echo ($share['share_production_date']); ?>">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">是否承担运费：</td>
		<td>
		<div class="radio">
			  <label>
			    <input type="radio" name="share_freight" id="share_freight" value="0" checked <?php if(($share['share_freight']) == "0"): ?>checked<?php endif; ?> >买家承担运费&nbsp;&nbsp;
			  </label>
			  <label>
			    <input type="radio" name="share_freight" id="share_freight" value="1" <?php if(($share['share_freight']) == "1"): ?>checked<?php endif; ?> >卖家承担运费
			 </label>
			</div>
			<input type="text" class="form-control share_feright_prices" style="width:470px;" placeholder="运费价格" name="share_feright_prices" value="<?php echo ($share['share_freight_prices']); ?>">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">品牌/型号：</td>
		<td>
		<!-- <div class="radio">
		<@volist name="brand" id="brand_">
			    <label>
			      <input type="radio" value="<?php echo ($brand_['brand_id']); ?>" name="share_the_brand_id" id="share_the_brand_id" <?php if(($brand_['brand_id']) == $share['share_the_brand_id']): ?>checked<?php endif; ?> ><?php echo ($brand_['brand_name']); ?>
			    </label>&nbsp;&nbsp;
		<@/volist>
		</div> -->
			<input type="text" class="form-control share_sj_pq" placeholder="产品品牌" style="width:470px;" name="share_sj_pq" value="<?php echo ($share['share_sj_pq']); ?>">
			<br />
			<input type="text" class="form-control share_sj_xh" placeholder="产品型号" style="width:470px;" name="share_sj_xh" value="<?php echo ($share['share_sj_xh']); ?>">
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">发货地址<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td>
		<select class="form-control" style="width: 153px;height: 35px;float:left;margin-right:5px;" name="share_sheng" id="share_sheng" onchange="loadArea(this.value,'sheng');">
			<option vlaue="0">--发货省--</option>
			<?php if(($share['share_id']) != ""): if(is_array($sheng)): $i = 0; $__LIST__ = $sheng;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sheng_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sheng_['city_id']); ?>" <?php if(($share['share_sheng']) == $sheng_['city_id']): ?>selected<?php endif; ?> ><?php echo ($sheng_['city_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php else: ?>
				<?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($address_['city_id']); ?>"><?php echo ($address_['city_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</select>
		<select class="form-control" style="width: 153px;height: 35px;float:left;margin-right:5px" name="share_shi" id="sheng" onchange="loadArea(this.value,'shi');" >
			<option value="0">--发货市--</option>
			<?php if(($share['share_id']) != ""): if(is_array($shi)): $i = 0; $__LIST__ = $shi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shi_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($shi_['city_id']); ?>" <?php if(($share['share_shi']) == $shi_['city_id']): ?>selected<?php endif; ?> ><?php echo ($shi_['city_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</select>
		<select class="form-control" style="width: 153px;height: 35px;float:left;margin-right:5px" name="share_xian" id="shi" onchange="loadArea(this.value,'qu');" >
			<option value="0">--发货县/区/镇--</option>
			<?php if(($share['share_id']) != ""): if(is_array($xian)): $i = 0; $__LIST__ = $xian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xian_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($xian_['city_id']); ?>" <?php if(($share['share_xian']) == $xian_['city_id']): ?>selected<?php endif; ?> ><?php echo ($xian_['city_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</select>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">价格区间：</td>
		<td>
			<select class="form-control share_prices_qujian" style="width: 173px;height: 35px;float:left;margin-right:5px" name="share_prices_qujian">
				<option value="0">--请选择价格区间--</option>
				<?php if(is_array($filter)): $i = 0; $__LIST__ = $filter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$filter_): $mod = ($i % 2 );++$i;?><option value="<?php echo ($filter_['filter_id']); ?>" <?php if(($filter_['filter_id']) == $share['share_prices_qujian']): ?>selected<?php endif; ?> ><?php echo ($filter_['filter_content']); ?>元</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">是否自营：</td>
		<td>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="share_self_support" id="share_self_support" value="1" disabled="disabled" checked >自营
				</label>
			</div>
		</td>
	</tr>
	<!-- 百度编辑器 -->
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">商品描述<font style="color:red;font-size:17px;line-height:45px">*</font>：</td>
		<td>
			<script id="editor" type="text/plain" style="width:1024px;height:500px;" name="share_descriptions" class="share_descriptions"><?php echo ($share['share_descriptions']); ?></script>
		</td>
	</tr>
	<script type="text/javascript">
    		//实例化编辑器
    		//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    		var ue = UE.getEditor('editor');
	</script>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">位置推荐：</td>
		<td>
			<div class="radio">
				<label>
			   	 	<input type="radio" name="share_recommend" id="share_recommend" value="0" checked <?php if(($share['share_recommend']) == "0"): ?>checked<?php endif; ?> >不推荐&nbsp;&nbsp;
			  	</label>
				<label>
			   	 	<input type="radio" name="share_recommend" id="share_recommend" value="4" <?php if(($share['share_recommend']) == "4"): ?>checked<?php endif; ?> >首页&nbsp;&nbsp;
			  	</label>
			  	<label>
			   	 	<input type="radio" name="share_recommend" id="share_recommend" value="1" <?php if(($share['share_recommend']) == "1"): ?>checked<?php endif; ?> >商品板块内左侧&nbsp;&nbsp;
			  	</label>
			  	<label>
			   	 	<input type="radio" name="share_recommend" id="share_recommend" value="2" <?php if(($share['share_recommend']) == "2"): ?>checked<?php endif; ?> >推荐至banner&nbsp;&nbsp;
			  	</label>
			  	<label>
			   	 	<input type="radio" name="share_recommend" id="share_recommend" value="3" <?php if(($share['share_recommend']) == "3"): ?>checked<?php endif; ?> >共享详情左侧&nbsp;&nbsp;
			  	</label>
			</div>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">产品上下架：</td>
		<td>
			<div class="radio">
				<label>
			      <input type="radio" value="0" name="share_status" id="share_status" checked <?php if(($share['share_status']) == "0"): ?>checked<?php endif; ?> >上架
			    </label>&nbsp;&nbsp;
			    <label>
			      <input type="radio" value="1" name="share_status" id="share_status" <?php if(($share['share_status']) == "1"): ?>checked<?php endif; ?> >下架
			    </label>&nbsp;&nbsp;
			</div>
		</td>
	</tr>
	<tr>
		<td  style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px">上架时间：</td>
		<td>
			<?php if(($share['share_createtime']) == ""): ?><input type="text" class="form-control share_createtime" style="width:470px;" value="<?php echo (date('Y-m-d',$time)); ?>" name="share_createtime"  id="datepicker-example2">
			<?php else: ?>
				<input type="text" class="form-control share_createtime" style="width:470px;" value="<?php echo (date('Y-m-d',$share['share_createtime'])); ?>" name="share_createtime"  id="datepicker-example2"><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td style="width:130px;text-align: right;background: #EEEEEE;border-bottom:1px solid #FFFFFF;line-height: 40px"></td>
		<td style="border:none">
			<?php if(($share['share_id']) == ""): ?><button type="button" class="btn btn-success">确认新增</button>
			<?php else: ?>
				<button type="button" class="btn btn-success" value="<?php echo ($share['share_id']); ?>">确认修改</button><?php endif; ?>
			<button type="button" class="btn btn-danger">返回上页</button>
			<button type="button" class="btn btn-primary">刷新</button>
		</td>
	</tr>
  </table>
</div>
</div>
</body>
<script type="text/javascript" src="/Public/Common/bootstrap/js/zebra_datepicker.min.js"></script>
<script type="text/javascript" src="/Public/Common/bootstrap/js/examples.js"></script>
<script type="text/javascript">
	// 添加规格
	$(".add_sp").click(function(){
		$(".zzc").css("display","block");
		$(".cosle_win").css("display","block");
		$(".add_sp_").css("display","block");
	});
	$(".cosle_win_").click(function(){
		$(".zzc").css("display","none");
		$(".cosle_win").css("display","none");
		$(".add_sp_").css("display","none");
	});
	// 名称字体限制
	$(".share_name").keyup(function(){
	     var length = 50;
	     var content_len = $(".share_name").val().length;
	     var in_len = length-content_len;
	     if(in_len >= 0){
	        $(".font-key").html('您还可以输入'+in_len+'字');
	        // 可以继续执行其他操作
	     }else{
	        $(".font-key").html('您还可以输入'+in_len+'字');
	        return false;
	     }
	});
	$(".share_key").keyup(function(){
		var length = 100;
		var content_len = $(".share_key").val().length;
		var in_len = length-content_len;
		if( in_len >= 0 ){
			$(".font-keys").html('您还可以输入'+in_len+'字');
			return false;
		}else{
			$(".font-keys").html('您还可以输入'+in_len+'字');
			return false;
		}
	});
	// 标题字体限制
	$(".btn-danger").click(function(){
		window.location.href="<?php echo U('Share/share_select_classify_product');?>";
	});
	$(".btn-primary").click(function(){
		location.reload();
	});
	// 多图上传特效
	number = [0,1,2,3,4,5,6,7];
	$.each(number,function( index ){
		if( index != 0 ){
			$(".image"+index).click(function(){
				$("#exampleInputFile"+index).click();
				$("#exampleInputFile"+index).off("change");
				$("#exampleInputFile"+index).on('change',function(){
					// 判断上传的限制
					if( $(this)[0].files[0].size > 10485760){
						alert("上传文件超出了特定的上传限制!");
						return false;
					}else{
						var objUrl = getUploads(this.files[0]);
						if( objUrl ){
							$(".image"+index).attr("src",objUrl);
						}
					}
				});
			});
		}
	});
	// 数据
	$(".btn-success").click(function(){
		if( $(".share_module_id").val() == "0" ){
			alert("请选择所属的板块!");
			return false;
		}
/*		var prices = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
		if( !prices.test( $(".share_rent").val() ) ){
			alert("租金字符输入不正确!");
			return false;
		}*/
		if( $(".share_product_type_id:checked").val() == undefined ){
			alert('产品规格是必选的');
			return false;
		}
		if( $("#share_sheng").val() == "0" || $("#sheng").val() == "0" || $("#shi").val() == "0" ){
			alert("请选择发货地址!");
			return false;
		}
		if( $(".share_prices_qujian").val() == "0" ){
			alert("请选择所属价格区间!");
			return false;
		}
		var check_specifications_id = "";
		$(".share_product_type_id").each(function(){
			if( $(this).is(":checked") ){
				check_specifications_id+= ","+$(this).val();
			}
		});
		check_specifications_ids = check_specifications_id.substring(1);
		// 接受编辑器内容
		var base64 = new Base64();  
		share_descriptions = base64.encode(ue.getContent());
		share_id = $(this).val();
		$("#hideShow").show("slow");
		$(".loading").show("slow");
		$.ajaxFileUpload({
			type: "POST",
	  dataType: "JSON",
	  fileElementId:["exampleInputFile1","exampleInputFile2","exampleInputFile3","exampleInputFile4","exampleInputFile5","exampleInputFile6","exampleInputFile7"],
	  		  url: "<?php echo U('Share/share_product_add');?>",
	  		data: {
	  					'share_id':share_id,
	  					'share_name':$(".share_name").val(),
	  					'share_weight':$(".share_weight").val(),
	  					'share_caizhi':$(".share_caizhi").val(),
	  					'share_cptgs':$(".share_cptgs").val(),
	  					'share_sj_pq':$(".share_sj_pq").val(),
						'share_sj_xh':$(".share_sj_xh").val(),
	  					// 'share_rent':$(".share_rent").val(),
	  					'share_day_number':$("#share_day_number:checked").val(),
	  					'share_key':$(".share_key").val(),
	  					'share_prices_qujian':$(".share_prices_qujian").val(),
	  					'share_module_id':$(".share_module_id").val(),
	  					'share_classify_id':"<?php echo ($classify); ?>",
	  					'share_chandi':$(".share_chandi").val(),
	  					'share_production_date':$(".share_production_date").val(),
	  					'share_freight':$("#share_freight:checked").val(),
	  					'share_feright_prices':$(".share_feright_prices").val(),
	  					// 'share_the_brand_id':$("#share_the_brand_id:checked").val(),
	  					'share_product_type_id':check_specifications_ids,
	  					'share_sheng':$("#share_sheng").val(),
	  					'sheng':$("#sheng").val(),
	  					'shi':$("#shi").val(),
	  					'share_descriptions':share_descriptions,
	  					'share_recommend':$("#share_recommend:checked").val(),
	  					'share_status':$("#share_status:checked").val(),
	  					'share_self_support':$("#share_self_support:checked").val(),
	  					'share_createtime':$(".share_createtime").val()
	  			    },
	  		success: function( data ){
				var reg = /<pre.+?>(.+)<\/pre>/g;
				var result = data.match(reg);
				data = RegExp.$1;
				var obj  = eval('('+data+')');
				if( obj.status == 2000){
					alert(obj.message);
					window.location.href="<?php echo U('Share/share_product_list');?>";
					return false;
				}else if( obj.status == -2000 ){
					alert(obj.message);
					return false;
				}else if( obj.status == -2002 ){
					alert(obj.message);
					$("#hideShow").hide("slow");
					$(".loading").hide("slow");
					return false;
				}
	  		},
	  		error: function( XMLHttpRequest , error , status ){
	  			alert("出现错误，错误位置在：" + status );
	  			return false;
	  		}
		});
	});
function getUploads(files){
	url = null;
	if( window.createObjectURL !== undefined ){
		url = window.createObjectURL(files);
	}else if( window.URL !== undefined ){
		url = window.URL.createObjectURL(files);
	}else if( window.webkitURL != undefined ){
		url = window.webkitURL.createObjectURL(files);
	}
	return url;
}
// 城市及联
function loadArea( cityId,cityType ){
	$.post("<?php echo U('Share/getArea');?>",{ 'cityId':cityId },function(data){
		if( cityType == "sheng"){
			$("#"+cityType ).html('<option value="0">--发货市--</option>');
			$("#shi").html('<option vlaue="0">--发货县/区/镇--</option>');
		}else if( cityType == "shi" ){
			$("#"+cityType).html('<option vlaue="0">--发货县/区/镇--</option>');
		}
		if( cityType != "null" ){
			$.each(data,function(index,value){
					opt = $("<option/>").text(value['city_name']).attr("value",value['city_id']);
					$("#"+cityType).append(opt);
				});
		}
	},"JSON");
}
</script>
</html>