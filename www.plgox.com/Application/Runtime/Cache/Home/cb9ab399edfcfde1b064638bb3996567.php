<?php if (!defined('THINK_PATH')) exit(); echo W('Common/htsy_top');?>
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/my_bx_ts_pj.css">  
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/zhezhao.css"> 
<style type="text/css">
 .error_font1{

     display: inline-block;
     color: red;
     overflow:hidden;
   margin-left:20px;
   margin-top:10px;
     width:600px;

	}
.tousu_select{
	font-size: 12px;
    color: #666666;
    height: 35px;
    width: 300px;
    margin-left: 16px;
    padding-left: 8px;
    border: 1px solid #D7D7D7;
}
.mypj68:hover{
   box-shadow: 0 3px 10px #ccc;
}
</style>

<div class="ht_in1">

	 <div class="ht_in10">
		<span >
			店铺管理
		</span>
	</div>

     <div class="ht_content">

          <div class="mypj61">
            <div class="mypj62">
              <span><span class="hszt">*</span>&nbsp;店铺名称：</span>
            </div>
            <div class="mypj63">
	            <div class="my_bx1">
	            	<input type="text" placeholder="请输入" class="tousu_select" />
	            
	            </div>
	            	<font class="error_font1"></font>
			      </div>
          </div>
  
<div style="clear:both;"></div>

<div class="mypj61">
            <div class="mypj62">
              <span><span class="hszt">*</span>&nbsp;店铺介绍：</span>
            </div>
            <div class="mypj63">
             <textarea   style="height:140px;" onfocus="this.value=''; this.onfocus=null;" placeholder="请简单描述店铺(140字以内)" class="tousu_content"></textarea> 
            </div>
            <font class="error_font1" style="margin-left:85px;"></font>
          </div>
<div style="clear:both;"></div>

          <div class="mypj61">
            <div class="mypj62">
              <span>店铺标志：</span>
            </div>
            <div class="mypj63 sctp">
               <img class="pjtp_sc" src="/Public/Home/image/my_top2.jpg" id="gbtpl"/>
               <input type="file" name="my_img[]" id="DoumentInputFile" style="display: none;" />
            </div>  
            <font class="error_font1" style="margin-left:25px;margin-top:60px;"></font>
            <div style="clear:both;"></div>
            <div class="my_baox">请上传店铺LOGO。支持格式JPG、PNG、BMP，最大支持3M。</div>  
          </div>
          
<div style="clear:both;"></div>

   <div class="mypj68" style="background-color:#6CA0EC;color:white;">提交</div>

     </div>
   </div>
 </div>


 
<!--遮罩-->
<div class="zhezhao"  style="display:none;">
  
  
  <div class="zz_nr_fbcg" style="display:none;">
	  <div class="zdsc">
	  	提交成功，平台会核实处理
	  </div>
	   
	  <div class="zz_gbtk" >
			关闭
	  </div> 
	</div>
  
  
  
  
</div> 
<script src="/Public/Home/js/szgd.js"></script>

<script type="text/javascript">
$(window).load(function() {

	$(".htsy_top_yd").css("top","138px");



	$(".htsy_2 li").eq(3).css("background","#3E4F65");

	$(".htsy_2 li").eq(3).siblings().css("background","none");
	$(".htsy_2 li div").eq(3).css("background","url('/Public/Home/image/htsy_2.png') no-repeat 0px 0px");
	$(".htsy_2 li div").eq(3).siblings().css("background","none");
	
	});
</script>

</body>
</html>