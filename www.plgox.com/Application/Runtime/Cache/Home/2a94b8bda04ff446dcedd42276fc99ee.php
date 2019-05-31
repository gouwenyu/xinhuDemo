<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/header');?>
<title>魄力共享-上魄力，低价格，大优惠</title>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css" />

<style>
  body{
    background-color:#FAFAFA;
  }
  .header_middle_center_cz{
    display: inline-block;
    float: left;
    width:60px;
    height:45px;
    cursor: pointer;
    margin-left: -60px;
    font-size:14px;
    line-height:45px;
    margin-top:0px;
    text-align:center;
    color:white;
    background-color:#1F61C3;
  }
  .header_middle_center1{
    width:505px;
    overflow:hidden;
  }
  #header_middle_center_bd1{
    border-radius: 0px;
  }
</style>
 <div class="container" id="container">
  <div id="list">
    
           <img alt="5" src="" />
       <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$banner_): $mod = ($i % 2 );++$i;?><img onclick="javascript:window.location.href='<?php echo ($banner_['banner_link']); ?>'" src="/Uploads/admin/<?php echo ($banner_['banner_pic']); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
            <img alt="1" src="" />
        </div>
      <div class="zytz">
       <div class="zytz1">
          <a href="javascript:void(0)" class="arrow" id="left" >
            <img src="/Public/Home/image/header_top8.png"/>
          </a>
          <a href="javascript:void(0)" class="arrow" id="right" >
            <img src="/Public/Home/image/header_top7.png"/>
          </a>
        </div>
      </div>
        <div class="btns1">
          <div class="btns">
            <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$banner_): $mod = ($i % 2 );++$i;?><span index=""></span><?php endforeach; endif; else: echo "" ;endif; ?>
           </div>
        </div>
    </div>
  </div>

 <script type="text/javascript">
  $(".header_box").removeClass("header_box_empty");
  $(".header_box").addClass("header_box_sy");
 </script>  
 <div class="index_add">
  <div class="index_add1">
    
    <div class="header_middle_center1" style="margin-left:350px;">
          <input type="text" name="share_product_search" id="header_middle_center_bd1" class="header_middle_center_bd" placeholder=" 请输入关键字" value="<?php echo ($share_product_search); ?>"/>
          <div class="header_middle_center_cz" onclick="ImgSubmit();">
            <!-- <img src="/Public/Home/image/header_top2.png"/> -->搜索
          </div>
    </div>

  
  </div>
  
  <div class="index_add2">
    <?php if(($loguser['plgox_id'] == '' )): ?><div class="index_add21" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('Tourist/login');?>'">
            租赁账单
             <a href="#" class="index_add220"></a> 
            </div> 
        <?php elseif(($sjrz_renzheng['plgox_usertype'] == 4 )): ?>
           <div class="index_add21" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('User/my_zhangdan');?>'">
            租赁账单
             <a href="<?php echo U('User/my_zhangdan');?>" class="index_add220"></a> 
            </div> 
        <?php else: ?>
          <div class="index_add21" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('User/my_zhangdan');?>'" >
            租赁账单
            <a href="<?php echo U('User/my_zhangdan');?>" class="index_add220"></a> 
          </div><?php endif; ?>

    <div class="index_add22"  style="cursor:pointer;"   onclick="javascript:window.location.href='<?php echo U('Zulin/shaixuan');?>'">
      租赁产品
      <a href="<?php echo U('Zulin/shaixuan');?>" class="index_add220"></a>
    </div>
    <?php if(($loguser['plgox_id'] == '' )): ?><div class="index_add22" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('Tourist/login');?>'">
            买卖订单
             <a href="#" class="index_add220"></a> 
            </div> 
        <?php elseif(($sjrz_renzheng['plgox_usertype'] == 4 )): ?>
           <div class="index_add22" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('User/my_mm_dingdan');?>'">
            买卖订单
             <a href="<?php echo U('User/my_mm_dingdan');?>" class="index_add220"></a> 
            </div> 
        <?php else: ?>
          <div class="index_add22" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('User/my_mm_dingdan');?>'" >
            买卖订单
            <a href="<?php echo U('User/my_mm_dingdan');?>" class="index_add220"></a> 
          </div><?php endif; ?>
     <?php if(($loguser['plgox_id'] == '' )): ?><div class="index_add21" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('Tourist/login');?>'">
              租赁订单
               <a href="#" class="index_add220"></a> 
              </div> 
          <?php elseif(($sjrz_renzheng['plgox_usertype'] == 4 )): ?>
             <div class="index_add21" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('User/my_dingdan');?>'">
              租赁订单
               <a href="<?php echo U('User/my_dingdan');?>" class="index_add220"></a> 
              </div> 
          <?php else: ?>
            <div class="index_add21" style="cursor:pointer;" onclick="javascript:window.location.href='<?php echo U('User/my_dingdan');?>'" >
              租赁订单
              <a href="<?php echo U('User/my_dingdan');?>" class="index_add220"></a> 
            </div><?php endif; ?>
  </div>
 </div>   
 <script type="text/javascript">

   $(".index_add232").click(function(){
    if( "<?php echo ($user_info); ?>" == "" ){
      alert("您还未登录,请先登录!");
    }else{
      var tel = /^1\d{10}$/;
      if( !tel.test($(".index_add231").val()) ){
        alert("手机号不正确!");
        return false;
      }
      $.post("<?php echo U('Index/weituo');?>",{ 'weituo_tel':$(".index_add231").val() },function(data){
        if( data.status == 2000 ){
            alert(data.message);
            $(".index_add231").val("");
        }else if( data.status == -2001 ){
            alert(data.message);
            $(".index_add231").val("");
        }
      });      
    }
   });
 </script>


  <div class="in_center">

<?php if(is_array($module)): $i = 0; $__LIST__ = $module;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$module_): $mod = ($i % 2 );++$i; if(($module_['module_id']) != ""): ?><div class="in_center1">
      <div class="in_center10">
        <div class="in_center11">
          <?php echo ($module_['module_title']); ?>
        </div>
        <ul class="in_center12">
          <?php if(is_array($shares_)): $i = 0; $__LIST__ = $shares_;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shares_list): $mod = ($i % 2 );++$i; if(($module_['module_id']) == $shares_list['share_module_id']): if(($shares_list['share_recommend']) == "1"): if(($shares_list['share_status']) == "0"): ?><li class="in_center121" style="">
                    <div class="in_center1210">
                      爆款产品
                    </div>
                    <div class="in_center1211">
                      <div class="share_name"><?php echo ($shares_list['share_name']); ?></div>
                      <div>一天可租/使用方便/超低租金</div>
                      <a href="<?php echo U('Cart/shop_detil',array('id'=>$shares_list['share_id']));?>">
                        <p class="pdcolor"><span class="pdcolor_jc">￥</span>
                          <span class="pdcolor_jc1">
                            <!-- <?php echo ($shares_list['share_rent']); ?> -->
                            <?php  $specifications = D("specifications")->where(array("specifications_id"=>array("in",$shares_list['share_product_type_id'])))->select(); foreach( $specifications as $key => $val ) { $specifications_[$key] = explode(",",$val['specifications_rent']); } ?>
                              <?php echo ($specifications_['0']['0']); ?>
                          </span><span class="pdcolor_jc">/天</span></p>
                      </a>
                    </div>
                    <div class="in_center1212">
                      <a href="<?php echo U('Cart/shop_detil',array('id'=>$shares_list['share_id']));?>"><img src="/Uploads/admin/<?php echo ($shares_list['share_home_img']); ?>" class="in_center1226 in_center1226_big"/></a>
                    </div>
                  </li><?php endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
          <li class="in_center122">
            <ul >
              <?php if(is_array($share)): $i = 0; $__LIST__ = $share;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$share_): $mod = ($i % 2 );++$i; if(($share_['share_recommend'] == 0 )): if(($module_['module_id']) == $share_['share_module_id']): if(($share_['share_recommend'] != 1) OR ($share_['share_recommend'] != 2) OR ($share_['share_recommend'] != 3) ): if(($share_['share_status'] == 0) and ($share_['share_recommend'] == 0)): ?><li class="in_center1221">
                               <div class="in_center1222">
                            <a >
                              <img src="/Uploads/admin/<?php echo ($share_['share_home_img']); ?>" onclick="location='<?php echo U('Cart/shop_detil',array('id'=>$share_['share_id']));?>'" class="in_center1226" />
                             </a>
                               </div>
                               <div class="in_center1223">
                          <?php echo ($share_['share_name']); ?>
                               </div>
                                <div class="in_center1225">
                                  <?php  $specifications = D("specifications")->where(array("specifications_id"=>array("in",$share_['share_product_type_id'])))->select(); foreach( $specifications as $key => $val ) { $specifications_[$key] = explode(",",$val['specifications_rent']); } ?>
                                  ￥<?php echo ($specifications_['0']['0']); ?>/天
                                    <!-- ￥<?php echo ($share_['share_rent']); ?>/天 -->
                               </div>
                            </li><?php endif; endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>


            <?php if(is_array($shares_home)): $i = 0; $__LIST__ = $shares_home;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$share_): $mod = ($i % 2 );++$i; if(($share_['share_recommend'] == 4 )): if(($module_['module_id']) == $share_['share_module_id']): if(($share_['share_recommend'] != 1) OR ($share_['share_recommend'] != 2) OR ($share_['share_recommend'] != 3) ): if(($share_['share_status'] == 0) and ($share_['share_recommend'] == 4)): ?><li class="in_center1221">
                               <div class="in_center1222">
                            <a >
                              <img src="/Uploads/admin/<?php echo ($share_['share_home_img']); ?>" onclick="location='<?php echo U('Cart/shop_detil',array('id'=>$share_['share_id']));?>'" class="in_center1226" />
                             </a>
                               </div>
                               <div class="in_center1223">
                          <?php echo ($share_['share_name']); ?>
                               </div>
                                <div class="in_center1225">
                                  <?php  $specifications = D("specifications")->where(array("specifications_id"=>array("in",$share_['share_product_type_id'])))->select(); foreach( $specifications as $key => $val ) { $specifications_[$key] = explode(",",$val['specifications_rent']); } ?>
                                  ￥<?php echo ($specifications_['0']['0']); ?>/天
                               </div>
                            </li><?php endif; endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </li>
        </ul>
      </div>
    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>  

    
    <div class="index_add6">
      <img src="/Public/Home/image/index_new6.jpg" />
    </div>
 
    <div class="in_center1">
      <div class="in_center10">
        <div class="in_center11">
          合作伙伴
        </div>
        <ul class="in_center51">
        <?php if(is_array($cooperation)): $i = 0; $__LIST__ = $cooperation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cooperation_): $mod = ($i % 2 );++$i;?><li>
            <img src="/Uploads/admin/<?php echo ($cooperation_['cooperation_img']); ?>" />
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>  
    <br/><br/><br/><br/>
    
   
    
 
</div>


    
  </div>
  
<div class="zhezhao" style="display:none;">   
  
  <div class="zz_nr_fbcg" style="display:none;">
      <div class="zdsc">
       删除成功
      </div>
       
      <div class="zz_gbtk" >
        关闭
      </div> 
    </div>

</div>
    <br/><br/>
  <?php echo W('Common/header1_search');?>
  <script src="/Public/Home/js/syrztk.js"></script> 
<script src="/Public/Home/js/index_lbt.js"></script> 
<script type="text/javascript">
   $(".bhqd").css("color","white"); 
   //企业认证
   qyrenzhe("<?php echo ($is_sjrz); ?>");
 //自动消失(弹框)
 function qkgwc(){
    $(".zhezhao").click(function(){
  
         $(".zhezhao").css("display","none");
           $(".zz_nr_fbcg").css("display","none"); 
           window.location.href="<?php echo U('User/my_qyrz');?>";

       
       $(".zz_nr_scdz").css("display","none");
        return false;
    });
} 

 function tkcx(message){
        $(".zhezhao").css("display","block");  
    $(".zz_nr_fbcg").css("display","block");

    $(".zdsc").text(message);
    var ss=$(".dd_js1110").length;
    qkgwc();
    
  }
$(".tjdxdk").css("margin-top","-68px");
  $(".in_center121").each(function(index){
    if(index%2==0){
      $(this).css("background","#4998A1");
      $(".in_center1210").eq(index).css("color","#02686A");
      $(".pdcolor").eq(index).css("color","#226677");
    }
    else{
      $(this).css("background","#D16142");
      $(".in_center1210").eq(index).css("color","#771000");
      $(".pdcolor").eq(index).css("color","#771000");
    }
  })
  
  $(".in_center1226").each(function(index){
    $(this).mouseover(function(){
      $(this).stop(true).animate({"marginLeft":"-10px"},300);
    });
    $(this).mouseout(function(){
      $(this).stop(true).animate({"marginLeft":"0px"},300);
    });
  });

  $(".tsdlg").attr("src","http://www.plgox.com/Public/Home/image/tsdlogo.png");


 $(".header_bottom1_middle li").eq(0).siblings().removeClass("header_dj");
 $(".header_bottom1_middle li").eq(0).addClass("header_dj");
</script>
<?php echo W('Common/footer');?>