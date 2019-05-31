<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/htsy_top');?>
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_jb.css">
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_fbmessage.css">
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/esxz_choose_fl.css">
<style>
  
</style>
<div class="esxz_big_box ht_in1">      
  <div class="ht_in10">
    <span >
      发布租赁 / 选择分类
    </span>
   </div>
<div style="width:95%;
padding:0px 50px;"> 
    <div class="esxz_fbme32" style="margin-bottom:30px;margin-top:30px;">
      <div class="esxz_fbme321" >
        <span style="font-size:16px;">选择发布类型：</span>
        <b >*</b>
      </div>
      <div class="esxz_fbme322">
        <div class="esxz_fbme3221">
        <input type="radio" name="goods_type" checked value="1" class="goods_type"/> <span style="font-size:14px;">餐厅二手</span> 
        </div>
        <div class="esxz_fbme3221">
          <input type="radio" name="goods_type" value="2" class="goods_type"/> <span style="font-size:14px;">酒店二手</span>
        </div>
        <div class="esxz_fbme3221">
          <input type="radio" name="goods_type" value="3" class="goods_type"/> <span style="font-size:14px;">求购</span>
        </div>
        <div class="esxz_fbme3221">
          <input type="radio" name="goods_type" value="4" class="goods_type"/> <span style="font-size:14px;">店铺转让</span>
        </div>
      </div>
    </div>
    
<div class="fbzl_dbox">
       <ul class="fbzl first_fl">
         <?php if(is_array($choose1)): $i = 0; $__LIST__ = $choose1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list1): $mod = ($i % 2 );++$i;?><li>
              <a href="#" class="fbzl1_a yijifenlei" id="<?php echo ($goods_list1["juezhi_brand_id"]); ?>"><?php echo ($goods_list1["juezhi_brand_name"]); ?></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
           <li>
              <a href="#" class="fbzl1_a yijifenlei" id="qita">其他</a>
            </li>
      </ul>
      <ul class="fbzl_first second_fl">
        <?php if(is_array($choose2)): $i = 0; $__LIST__ = $choose2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_list2): $mod = ($i % 2 );++$i;?><li>
              <a href="#" class="fbzl1_b" id="<?php echo ($goods_list2["juezhi_brand_id"]); ?>">
              <span><?php echo ($goods_list2["juezhi_brand_name"]); ?></span>
          </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
  </div>

 </div>  


<!--      <div class="xyibu">下一步</div> -->
  </div>


<!--发布成功  3秒后自动消失-->
<div class="zhezhao" style="display:none;">
   <div class="zz_nr_fbcg" >
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
  $(".htsy_top_yd").css("top","356px");



  $(".htsy_2 li").eq(7).css("background","#3E4F65");

  $(".htsy_2 li").eq(7).siblings().css("background","none");
  $(".htsy_2 li div").eq(7).css("background","url('/Public/Home/image/htsy_2.png') no-repeat 0px 0px");
  $(".htsy_2 li div").eq(7).siblings().css("background","none");


  
$(".fbzl1_a").eq(0).addClass("fbzl1_dj");
$(".fbzl1_b").eq(0).addClass("fbzl1_dj");
  
//一级点击效果
   $(".fbzl1_a").each(function(index){
        $(this).mouseenter(function(){ 
           
           if($(this).attr("id")=="qita"){
             $(this).addClass("fbzl1_dj");
            $(".second_fl").text(null);
             for(var i=0;i<$(".yijifenlei").length-1;i++){
                $(".fbzl1_a").eq(i).removeClass("fbzl1_dj");
             }
           }
           else{
		           for(var i=0;i<$(".fbzl1_a").length;i++){
		            if(i==index){
		              $(this).addClass("fbzl1_dj");
		              var idz=$(this).attr("id");
		          $.post("<?php echo U('Esxz/esxz_choose_fl');?>",{'id':idz , 'type':1 },
		          function( data ){
		             //二级分类
		             var opt='';
		           $.each(data.list_two,function(index,value){
		                       opt+='<li><a href="#" class="fbzl1_b" id='+value.juezhi_brand_id+'><span>'+value.juezhi_brand_name+'</span></a></li>';
		                        
		          });
		          $(".second_fl").text(null);
		                    $(".second_fl").append(opt);
		        
		            
		            
		             sx_thir();
		              d_thid();
		            
		               },"json");
		              
		              
		              
		              
		            }
		            else{
		              $(".fbzl1_a").eq(i).removeClass("fbzl1_dj");
		            }
		           }
		       }
    });


       $(this).click(function(){
       id = $(this).attr("id");
        attr_checked = $('.goods_type:checked').val();
        if( attr_checked == 4 ){
            window.location.href="<?php echo U('esxz/esxz_fbmessage_zr');?>&share_id3="+id+"&flz="+attr_checked;
        }else{
            window.location.href="<?php echo U('esxz/esxz_fbmessage');?>&share_id3="+id+"&flz="+attr_checked;
        }
    })
  });
   //二级点击效果
function sx_thir(){
  //默认第一个为被选中的状态
  //$(".fbzl1_b").eq(0).addClass("fbzl1_dj");
  
   $(".fbzl1_b span").each(function(index){
        $(this).mouseenter(function(){  

           for(var i=0;i<$(".fbzl1_b span").length;i++){
            if(i==index){
             // $(this).addClass("fbzl1_dj1");
              $(this).css("color","#5F93E0");
              var idz=$(".fbzl1_b").eq(i).attr("id");
              $.post("<?php echo U('Esxz/esxz_choose_fl');?>",{'id':idz , 'type':2 },
                function( data ){
                  
                  $(".fbzl_second").remove();          
                          //三级分类
                          var opt1='';
                $.each(data.list_three,function(index,value){
                             opt1+='<li><a href="#" class="fbzl1_c" id='+value.juezhi_brand_id+'>'+value.juezhi_brand_name+'</a></li>';
                              
                });

                if(data.list_three!=""){
                  var tjxys='<ul class="third_fl fbzl_second">'+opt1+'</ul>';
                   $(".fbzl1_b").eq(index).append(tjxys);
                }
                
                  
                   d_thid();
                   
                
                   },"json");
                   
                   
                   
            }
            else{

              $(".fbzl1_b").eq(i).removeClass("fbzl1_dj1");
               $(".fbzl1_b span").eq(i).css("color","#555");
            }
           }
    });

    $(this).click(function(){
       id =$(".fbzl1_b").eq(index).attr("id");
        attr_checked = $('.goods_type:checked').val();
        if( attr_checked == 4 ){
            window.location.href="<?php echo U('esxz/esxz_fbmessage_zr');?>&share_id3="+id+"&flz="+attr_checked;
        }else{
            window.location.href="<?php echo U('esxz/esxz_fbmessage');?>&share_id3="+id+"&flz="+attr_checked;
        }
    })


   });

  


     
}

sx_thir();

function d_thid(){
   //三级
    $(".fbzl1_c").each(function(index){
        $(this).click(function(){   
           for(var i=0;i<$(".fbzl1_c").length;i++){
            if(i==index){
              $(this).addClass("fbzl1_dj1");
              $(this).css("color","#5F93E0");
            }
            else{
              $(".fbzl1_c").eq(i).removeClass("fbzl1_dj1");
              $(".fbzl1_c").eq(i).css("color","#555");
            }
           }

        id = $(this).attr("id");
        attr_checked = $('.goods_type:checked').val();
        if( attr_checked == 4 ){
          window.location.href="<?php echo U('esxz/esxz_fbmessage_zr');?>&share_id3="+id+"&flz="+attr_checked;
        }else{
          window.location.href="<?php echo U('esxz/esxz_fbmessage');?>&share_id3="+id+"&flz="+attr_checked;
        }

    });
   });
}
d_thid();



/*$(".xyibu").click(function(){
  //alert(+"----"+$(".fbzl1_dj").eq(2).attr("id"));
  if(!$('.goods_type').is(':checked')){
    tkcx("请选择发布类型");
  }
  else if($(".fbzl1_dj1").eq(0).attr("id")==null){
    tkcx("请选择三级分类中选择的分类")
  }
  else{
    var type= $('.goods_type:checked ').val();
    if(type==1){
      location.href="<?php echo U('esxz/esxz_fbmessage');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
    }
    else if(type==2){
      location.href="<?php echo U('esxz/esxz_fbmessage');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
    }
    else if(type==3){
      location.href="<?php echo U('esxz/esxz_fbmessage_qg');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val();
    }
    else if(type==4){
      location.href="<?php echo U('esxz/esxz_fbmessage_zr');?>?share_id1="+$(".fbzl1_dj").eq(0).attr("id")+"&share_id2="+$(".fbzl1_dj").eq(1).attr("id")+"&share_id3="+$(".fbzl1_dj").eq(2).attr("id")+"&flz="+$('.goods_type:checked ').val(); 
    }
    
    /*if(type=='1')else if(type==2)else if(type==3)else
  }
  
  
})*/


 //自动消失(弹框)
function tkxsds(){
  $(".zhezhao").click(function(){   
       $(".zhezhao").css("display","none");

      return false;
  });
}
 function tkcx(message){
        $(".zhezhao").css("display","block");
    $(".zdsc").text(message);
    tkxsds();
  }

  
</script>