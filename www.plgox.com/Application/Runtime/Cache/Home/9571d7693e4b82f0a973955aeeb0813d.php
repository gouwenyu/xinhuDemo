<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/header');?>

<link rel="stylesheet" type="text/css" href="/Public/Home/css/my_top.css">
<div class="my_topzd">
  <div class="my_top_box">
    <div class="my_t1">
      所在位置：    首页  > 用户中心 > <span class="my_tbxd">我的订单</span>
     </div>
</div>
</div>
<div style="height:685px;">
	<div style="width:1192px;margin:0 auto;">
     <div class="my_t2">
         <div class="my_t3">用户中心</div> 
         <ul class="my_t5">
           <li><a href="<?php echo U('User/my_dingdan');?>">租赁订单</a></li>
           <li><a href="<?php echo U('User/my_mm_dingdan');?>">买卖订单</a></li>
           <li><a href="<?php echo U('User/my_zhangdan');?>">我的账单</a></li>
<!--   <li><a href="<?php echo U('User/my_xinyun');?>">我的信用</a></li>-->
           <li><a href="<?php echo U('User/my_qyrz');?>">企业认证</a></li>
           <li><a href="<?php echo U('User/my_shdz');?>">收货地址</a></li>
           <li><a href="<?php echo U('User/my_jbzl');?>">基本资料</a></li>
           <li >
		  	     <a  href="#" class="hdmk">
		  	     </a>
		        </li>
         </ul>   
     </div>
    </div> 
  </div>
  <?php echo W('Common/header1_search');?> 
<script type="text/javascript">

 $(".my_t5 li a").each(function(index){
		$(this).mouseover(function(){
			var pxs=index*50+"px";
			$(".hdmk").stop().animate({top:pxs},'fast');
		});
	
	});
 $(".my_t5").mouseover(function(){
 	 $(".hdmk").css("display","block");
 });
  $(".my_t5").mouseout(function(){
 	 $(".hdmk").css("display","none");
 });

$(".header_bottom1_middle li").eq(2).siblings().removeClass("header_dj");
 $(".header_bottom1_middle li").eq(2).addClass("header_dj");

 
</script>
<title><?php echo ($setTitle); ?></title>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/my_dingdan.css">
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/fen_ye.css">
  <style type="text/css">
 .my_dind10 td:nth-child(1) span, .my_dind10 td:nth-child(2) span:hover{
    color:#1C4D94;
  }
</style>

<div class="mypj">
  <div class="mypj1" >
   <div  class="mypj2" >
   	  <div class="my_dind_top">
        <form action="<?php echo U('User/option_sreach');?>" method="get">
     	  	选择：
     	  	<select name="order_select" class="order_select">
     	  		<option value="3">全部订单</option>
     	  		<option value="1" <?php if(($option_type) == "1"): ?>selected<?php endif; ?> >待发货</option>
     	  		<option value="2" <?php if(($option_type) == "2"): ?>selected<?php endif; ?> >未支付</option>
     	  	</select>
        </form>
   	  </div>
   	  	<script type="text/javascript">
         $(".order_select").change(function(){
            $("form").submit();
         }); 
        </script>
        <table class="my_dind_box">
       <thead>
          <tr class="my_dingd12">
            <th>产品名称</th>
            <th>押金</th>
            <th>信用金</th>
            <th>订单状态</th>
            <th>操作</th>
          </tr>
        </thead>
         <tbody>
          <?php if(is_array($order_detil)): $i = 0; $__LIST__ = $order_detil;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_detil_): $mod = ($i % 2 );++$i; if(($order_detil_['order_member_del_status']) != "1"): ?><tr class="my_dind10">
            <td colspan="4">下单日期：<?php echo (date("Y-m-d H:i:s",$order_detil_['order_createtime'])); ?>  &nbsp;&nbsp;&nbsp;&nbsp;订单号：<span><?php echo ($order_detil_['order_number']); ?></span></td>
            <?php if(($order_detil_['order_status']) == 0): ?><td>
	            	<a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>" style="margin-left:70px;"><span class="ckddxqd">查看订单详情</span></a>
	            </td>
	        <?php elseif(($order_detil_['order_status']) == 1): ?>
	        	<td>
	            	<a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
	            </td>
	        <?php elseif(($order_detil_['order_status']) == 2): ?>
	        	<td>
	            	<a href="<?php echo U('User/my_tousu',array('tousu_id'=>$order_detil_['order_id']));?>" style="margin-right:30px;">投诉</a><a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
	            </td>
          <?php elseif(($order_detil_['order_status']) == 3): ?>
              <td>
                <a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>" style="margin-left:70px;"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 4): ?>
              <td>
                <a href="<?php echo U('User/my_baoxiu',array('baoxiu_id'=>$order_detil_['order_id']));?>" style="margin-right:30px;">报修</a><a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 5): ?>
              <td>
                <a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 6): ?>
              <td>
                <a href="<?php echo U('User/my_tousu',array('tousu_id'=>$order_detil_['order_id']));?>" style="margin-right:30px;">投诉</a><a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 7): ?>
              <td>
                <a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 8): ?>
              <td>
                <a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 9): ?>
              <td>
                <a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td>
          <?php elseif(($order_detil_['order_status']) == 10): ?>
              <td>
                <a href="<?php echo U('User/my_dd_xiangqing',array('id'=>$order_detil_['order_id']));?>"><span  class="ckddxqd">查看订单详情</span></a>
              </td><?php endif; ?>
          </tr><?php endif; ?>
          <?php if(($order_detil_['order_member_del_status']) != "1"): ?><tr class="my_dind11">
            <td class="my_dingd15" onclick="location='<?php echo U('Cart/shop_detil',array('id'=>$order_detil_['share_id']));?>'" style="width:395px;cursor:pointer;">
              <img src="/Uploads/admin/<?php echo ($order_detil_['specifications_img']); ?>" style="width: 90px;height: 90px" />
              <div class="my_dingdan16">
                <span>
                  <?php echo ($order_detil_['share_name']); ?>-<?php echo ($order_detil_['specifications_name']); ?>
                </span>
              </div>  
            </td>
            <td>  
              ¥<?php echo ($order_detil_['order_deposit']); ?>
            </td>
            <td >
                ¥<?php echo ($order_detil_['order_rent']); ?>
            </td>
            <?php if(($order_detil_['order_status']) == 0): ?><td >待付信用金</td>
                  <td class="my_dd6">
                  <div class="qxdd"><a href="<?php echo U('Pay/pay',array('id'=>$order_detil_['order_id']));?>&type=3" class="pay_xyj" value="<?php echo ($order_detil_['order_id']); ?>"><div class="sykz"><font style="color:#ffffff">支付信用金</font></div></a></div>
              </td>
           <?php elseif(($order_detil_['order_status']) == 1): ?>
              <td >待发货</td>
                  <td class="my_dd6">
                  <div class="qxdd"></div>
                  <div class="qxdd"><a href="javascript:void(0);" class="cancel_order" value="<?php echo ($order_detil_['order_id']); ?>">取消订单</a></div>
              </td>
           <?php elseif(($order_detil_['order_status']) == 2): ?>
           		<td >待收货</td>
                <td class="my_dd6">
              	</td>
           <?php elseif(($order_detil_['order_status']) == 3): ?>
           		<td >待付押金</td>
                <td class="my_dd6">
                	<a href="<?php echo U('Pay/pay',array('id'=>$order_detil_['order_id']));?>&type=1"><div class="sykz" ><font style="color:#ffffff">支付押金</font></div></a>
                    <div class="liktimer" style="margin-left:-20px;">  
<!--         <strong class="RemainD"></strong>天  -->
                      
	   	               <br />
	   	               <img src="/Public/Home/image/clock.png" style="margin-right:10px;display:inline-block;margin-top:-3px;"/>
                      <a href="javascript:void(0);" value="<?php echo ($order_detil_['order_daojishi']); ?>" class="dateTimes"></a>
                      
                      <span class="RemainH"></span> :
                      <span class="RemainM"></span> :
                      <span class="RemainS"></span>
                    </div> 
                    <span class="daojishi"></span>
              	</td>
            <?php elseif(($order_detil_['order_status']) == 4): ?>
              <td >取消订单</td>
                  <td class="my_dd6">
                  <div class="qxdd"> <a href="javascript:void(0);"  order_del_id="<?php echo ($order_detil_['order_id']); ?>" class="order_del">删除订单</a></div>
              </td>
            <?php elseif(($order_detil_['order_status']) == 5): ?>
              <td >租赁中</td>
                <td class="my_dd6">
                  <a href="javascript:void(0);" orderid="<?php echo ($order_detil_['order_id']); ?>" class="retreat_rent"><div class="sykz"><font style="color:#ffffff">我要退租</font></div></a>
                </td>
            <?php elseif(($order_detil_['order_status']) == 6): ?>
              <td >等待收回</td>
                <td class="my_dd6">
                </td>
            <?php elseif(($order_detil_['order_status']) == 7): ?>
              <td >等待返还押金</td>
                <td class="my_dd6">
                  <a href="javascript:void(0);"><div class="sykz"><font style="color:#ffffff">退租完成</font></div></a>
                </td>
            <?php elseif(($order_detil_['order_status']) == 8): ?>
                <td >已完成</td>
                <td class="my_dd6">
                  <?php if(( $date_time >= $order_detil_['refund_createtime'] )): ?><a href="javascript:void(0);" order_del_id="<?php echo ($order_detil_['order_id']); ?>" class="order_del"><div class="sykz"><font style="color:#ffffff">删除</font></div></a>
                  <?php else: ?>
                    <a href="<?php echo U('User/my_pingjia',array('pingjia_id'=>$order_detil_['order_id']));?>"><div class="sykz"><font style="color:#ffffff">评价</font></div></a><?php endif; ?>
                </td>
            <?php elseif(($order_detil_['order_status']) == 9): ?>
              <td >已评价</td>
                <td class="my_dd6">
                    <a href="javascript:void(0);" order_del_id="<?php echo ($order_detil_['order_id']); ?>" class="order_del"><div class="sykz"><font style="color:#ffffff">删除</font></div></a>
                </td>
            <?php elseif(($order_detil_['order_status']) == 10): ?>
              <td >卖家已取货</td>
                <td class="my_dd6">
                    <a href="javascript:void(0);" orderid="<?php echo ($order_detil_['order_id']); ?>" class="retreat_rent1"><div class="sykz"><font style="color:#ffffff">确认已回收</font></div></a>
                </td><?php endif; ?>
          </tr><?php endif; ?>
          <?php if(($order_detil_['order_member_del_status']) != "1"): ?><tr>
            <td class="my_dingdan17" colspan="5">
    
              <?php if(($order_detil_['order_status']) == 0): ?>注：为了保证平台与商户之间的信任度首先支付10%的信用金。
              <?php elseif(($order_detil_['order_status']) == 1): ?>
                <!-- 注：收到货后24小时内需支付押金。订单将在1-3个工作日内送达。 -->
                注：商品正在出库发货中，请您耐心等待。
              <?php elseif(($order_detil_['order_status']) == 2): ?>
                注：商品将在2个工作日内送达。
              <?php elseif(($order_detil_['order_status']) == 3): ?>
                注：请在48小时内支付信用金，逾期将扣除10%首付信用金，且工作人员有权收回商品。
              <?php elseif(($order_detil_['order_status']) == 4): ?>
                注：取消订单之后，该笔订单是可以删除，删除时请谨慎操作，一旦删除无法复原。
              <?php elseif(($order_detil_['order_status']) == 5): ?>
                注：租赁中的商品，如果出现了产品质量问题的话，可以随时退租和更换，若属于人为损坏，由承租方负全权负责。
              <?php elseif(($order_detil_['order_status']) == 6): ?>
                注：如果卖家回收商品之后一直没有确认收货的话，您可以联系平台或者对卖家进行投诉。
              <?php elseif(($order_detil_['order_status']) == 7): ?>
                注：押金返还将在1-3个工作日当中完成处理，请您耐心等候，谢谢您的支持!。
              <?php elseif(($order_detil_['order_status']) == 8): ?>
                注：退租完成之后，您可以对该商品进行评价，以便告知商家的商品有那些不足之处。
              <?php elseif(($order_detil_['order_status']) == 9): ?>
                注：评价完成以后，您是可以删除订单的，删除时请谨慎操作，一旦删除无法复原。
              <?php elseif(($order_detil_['order_status']) == 10): ?>
                注：退租订单商家将会在1～3个工作日内处理,如果租赁方完成回收，请您点击确认已回收，避免造成额外的损失。<?php endif; ?>
            </td>
          </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        <tr>
          <td colspan="5">
            <div class="message" >
              <?php echo ($page); ?>
           </div>
          </td>
        </tr>
      </table>
     </div>
   </div>
 </div>





<script type="text/javascript" src="/Public/Home/js/my_top.js"></script>
<script type="text/javascript">
	$(function(){
		// 取消订单
		$(".cancel_order").click(function(){
			$(".zhezhao").css("display","block");
			$(".zz_nr").css("display","block");
			$(".zz_nr2").text("确定要取消该订单?");
			window.order_id=$(this).attr("value");
			  
		});
		
		// 删除订单
    $(".order_del").click(function(){
    	$(".zhezhao").css("display","block");
			$(".zz_nr").css("display","block");
			$(".zz_nr2").text("确定要删除该订单,删除后将无法恢复,请谨慎操作!");
			window.order_id=$(this).attr("order_del_id");
    });
    
    // 退租
    $(".retreat_rent").click(function(){
    	$(".zhezhao").css("display","block");
			$(".zz_nr").css("display","block");
			$(".zz_nr2").text("确定要退租吗?");
			window.order_id=$(this).attr("orderid");
    });
    
     // 商家确认已回收
    $(".retreat_rent1").click(function(){
	    	$(".zhezhao").css("display","block");
				$(".zz_nr").css("display","block");
				$(".zz_nr2").text("租赁方是否确定已回收物品?如果未回收，造成的一切损失由您本人承担!");
				window.order_id=$(this).attr("orderid");
       /*if( confirm("租赁方是否确定已回收物品?如果未回收，造成的一切损失由您本人承担!") ){
          $.post("<?php echo U('User/ajaxRetreat_rent');?>",{ 'order_ids':$(this).attr("orderid") },function( data ){
          if( data.status == 2000 ){
            alert("处理成功,感谢您的使用!");
            location.reload();
            return false;
          }else if( data.status == -2000 ){
            alert("处理失败,请重新处理一下!");
            return false;
          }
        },"json");
       }*/
    });
		$(".tyjs0").click(function(){
			 $(".zz_nr").css("display","block");
			  $(".zz_nr_fbcg").css("display","block"); 
			 if($(".zz_nr2").text()=="确定要取消该订单?"){
				 	$.post("<?php echo U('User/ajaxOrderCazuo');?>",{'cancel_order_id':order_id},function( data ){
            console.log(data);
						if( data.status == 2000 ){
							tkcx("取消订单成功");
						}else if( data.status == -2000 ){
							tkcx("取消订单失败!");

						}
					},"json");
					
					
			 }
			 else if($(".zz_nr2").text()=="确定要删除该订单,删除后将无法恢复,请谨慎操作!"){
			 	  $.post("<?php echo U('User/order_del_');?>",{'order_del_id':order_id},function(data){
            if( data.status ==2000 ){
              tkcx(data.message);
              //location.reload();
              //return false;
            }else if( data.status == -2000 ){
              tkcx(data.message);
            }
          },"json");
			 }
			 else if($(".zz_nr2").text()=="确定要退租吗?"){
			 	  $.post("<?php echo U('User/ajaxRetreat_rent');?>",{ 'order_id':order_id },function( data ){
          if( data.status == 2000 ){
            tkcx(data.message);
          }else if( data.status == -2000 ){
            tkcx("退租失败!");
          }
        },"json");
			 }
			 else if($(".zz_nr2").text()=="租赁方是否确定已回收物品?如果未回收，造成的一切损失由您本人承担!"){
			 	  $.post("<?php echo U('User/ajaxRetreat_rent');?>",{ 'order_ids':order_id },function( data ){
          if( data.status == 2000 ){
            //alert("处理成功,感谢您的使用!");
            tkcx("处理成功,感谢您的使用!");
          }else if( data.status == -2000 ){
            tkcx("处理失败,请重新处理一下!");
          }
        },"json");
			 }
			 $(".zhezhao").css("display","none");
			  $(".zz_nr").css("display","none");
		})
		//自动消失(弹框)
function tkgb(){
  $(".zhezhao").click(function(){
  	   $(".zhezhao").css("display","none");
  	     $(".zz_nr_fbcg").css("display","none"); 
  	     location.reload();
  });
}
		function tkcx(message){
	  	    $(".zhezhao").css("display","block");  
					$(".zz_nr_fbcg").css("display","block");

				  
				  $(".zdsc").text(message);
			
			    tkgb();
     }
		
   
    
	});
</script>
<!--遮罩-->
<div class="zhezhao" style="display:none;">
	<div class="zz_nr" style="display:none;">
	  <div class="zz_nr1">
		<span class="wxts">温馨提示<span>
		<span class="scqr">×</span>
	  </div>
	  <div class="zz_nr2" style="line-height:30px;padding-top:40px;height:134px;display:block;"></div>
	 
	  <div class="zz_nr3" >
			<a href="#wss" class="tyjs0">确认</a>
			<a href="#wss" class="tyjs">取消</a>	
	  </div>  
	</div>		
	
	
	<!--发布成功  3秒后自动消失-->
	<div class="zz_nr_fbcg" style="display:none;">
    <div class="zdsc">
     删除成功
    </div>
     
    <div class="zz_gbtk" >
      关闭
    </div> 
  </div>

	
	
</div>



<script type="text/javascript" src="/Public/Home/js/my_top.js"></script>
<script type="text/javascript">
   my_top(0,"0px","我的订单");
  
 /* $(".scdd").each(function(index){
		$(this).click(function(){
			$(".zz_nr2").text("确认删除订单吗?");
			$(".zhezhao").css("display","block");
			$(".zz_nr_fbcg").css("display","none");
			$(".zz_nr").css("display","block");
		});
	});
	$(".wytz").each(function(index){
		$(this).click(function(){
			$(".zz_nr2").text("确定要退租吗?");
			$(".zhezhao").css("display","block");
			$(".zz_nr_fbcg").css("display","none");
			$(".zz_nr").css("display","block");
		});
	});
	$(".qxdd").each(function(index){
		$(this).click(function(){
			$(".zz_nr2").text("确认取消订单吗?");
			$(".zz_nr").css("display","block");
			$(".zz_nr_fbcg").css("display","none");
			$(".zhezhao").css("display","block");
			
	
		});
	});*/
	/*$(".tyjs0").click(function(){
		
		if($(".zz_nr2").text()=="确定要退租吗?"){
			$(".zdsc").text("退租成功，商家会1~3个工作日内处理");
		}
		else if($(".zz_nr2").text()=="确认删除订单吗?"){
			$(".zdsc").text("删除成功");
		}
		else if($(".zz_nr2").text()=="确认取消订单吗?"){
			$(".zdsc").text("取消成功");
		}
		$(".zhezhao").css("display","block");
		$(".zz_nr").css("display","none");
		$(".zz_nr_fbcg").css("display","block");
		
			 setTimeout(function(){
	   	      $(".zhezhao").css("display","none");
	   	 },3000);
		
	});*/
	$(".tyjs").click(function(){
		$(".zhezhao").css("display","none");
	});
	$(".scqr").click(function(){
		$(".zhezhao").css("display","none");
	});
  
  
   //自动消失(弹框)
  $(".zdxs").click(function(){
  	 $(".zhezhao").css("display","none");
  });
</script>
<script type="text/javascript">
 window.onload=function(){  
 var timer=null;
 function Timeover(){  
 var oparenttime=$(".liktimer"); //获取对象  
 oparenttime.each(function(index){
     var times = $(".dateTimes").eq(index).attr("value");
     var time= times;
            var newtime=time*1000;//这里需要注意js时间戳精确到毫秒,所以要乘以1000后转换.           
                                //方法二(推荐):
            function gettime(t){
                var _time=new Date(t);
                var   year=_time.getFullYear();//2017
                var   month=_time.getMonth()+1;//7
                var date=_time.getDate();//10
                var   hour=_time.getHours();//10
                var   minute=_time.getMinutes();//56
                var   second=_time.getSeconds();//15
                return  month+"/"+date+"/"+year+" "+hour+":"+minute+":"+second;//这里自己按自己需要的格式拼接
            }
            var endtime=gettime(newtime);    
                  var endtimer=new Date(endtime).getTime();  
                  var startimer=new Date().getTime();     
                  var opactiontimer=endtimer-startimer;  
                  var second=opactiontimer/1000;//获取总的秒  
                  var Minute=Math.floor(second/60);//获取总的分  
                  var houre=Math.floor(Minute/60);//获取总的小时   
                  var day=Math.floor(houre/24);//获取总的天数  
                  var houres=Math.floor(houre%24);//获取显示的小时  
                  var Minutes=Math.floor(Minute%60);//获取显示的分  
                  var seconds=Math.floor(second%60);//获取显示的秒  
                  /*document.getElementsByClassName("RemainD")[0].innerHTML=day;  */
                  $(".RemainH").eq(index).html(houre);  
                  $(".RemainM").eq(index).html(Minutes);    
                  $(".RemainS").eq(index).html(seconds);  
                  if(startimer>endtimer){ //如果当下的时间大于了过期时间，关闭定时器  
	                  clearInterval(timer); 
                      if(timer==1){
                      	tkcx("48小时完毕");
                      	$(".RemainH").eq(index).html(0);  
	                      $(".RemainM").eq(index).html(0);  
	                      $(".RemainS").eq(index).html(0);  
                      	return false;
                      }
                      else{
                      	$(".RemainH").eq(index).html(0);  
	                      $(".RemainM").eq(index).html(0);  
	                      $(".RemainS").eq(index).html(0);  
                      }
	                  
	                  
	                  
                 }  
          })
        } 
      function loop(){  
        Timeover();  
        timer=setInterval(Timeover,1000);  
        //alert(timer);
     }  
    loop();//消除帅新等待1秒倒计时的bug  
} 
</script>
<?php echo W('Common/footer');?>
</body>
</html>