<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Zulin/shaixuan');?>" id="search" method="get">
		<input type="hidden" name="fenlei" id="fenlei" value="<?php echo ($fenlei); ?>"> <!-- 分类 -->
		<input type="hidden" name="zujin" id="zujin" value="<?php echo ($zujin); ?>"><!-- 租金 -->
		<input type="hidden" name="share_product_search" id="header_middle_center_bds" value=""><!-- 搜索 -->
		<input type="hidden" name="share_shaixuan_" value="<?php echo ($share_shaixuan_); ?>" id="share_shaixuan_"><!-- 筛选值 -->
</form>
<script type="text/javascript">
	// 异步请求
	function fenlei(id){
		$("#fenlei").val(id);
		$("#search").submit();
	}
	function zujin(id){
		$("#zujin").val(id);
		$("#search").submit();
  	}
  	function orders(id){
		$("#share_shaixuan_").val(id);
		$("#search").submit();
	}
  	function ImgSubmit(){
    	var search_content=$(".header_middle_center_bd").val();
    	$("#header_middle_center_bds").val(search_content);
		$("#search").submit();
		$("#search").reset(fenlei(),zujin());
    }
/*    
    function orders(id) {
    	// 排序
    	// 1 = 租金低到高 2 = 租金高到低 3 = 满意度高低 4 = 出租率高低
		$("#search").submit();
    }*/
</script>