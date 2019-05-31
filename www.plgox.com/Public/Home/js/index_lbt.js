  $(function(){
  	var kd=document.body.clientWidth;
   	var gd=kd/1920*600;
     $("#list").css("width",1920*$("#list img").length);
     $(".btns1").css("width",kd);
     $("#list img").css("width",1920);
     $(".zytz").css("bottom","280px");
        var oList = $("#list");
        var oRight = $("#right");
        var oLeft = $("#left");
        var oWidth = parseInt(oList.css('width')) / $("#list img").length;      
        //计算图片的宽度从而达到自适应屏幕宽度
        var oSpan = $(".btns span");
        var len = $("#list img").length-2;
        var index = 1;
        var interval = 3000;
        var timer = null;
        
    // 默认第一个元素为白色   
      oSpan.eq(0).addClass("on");
     //给btns设置宽度 
     var btnkd=oSpan.length*35;
     $(".btns").css("width",btnkd);
     
     //给index设置值
     oSpan.each(function(index){
     	$(this).attr("index",index+1);
     })
      
      
        //默认第一张banner图片为第二张图片
     //默认最后一张banner图片为倒数第二张图片
     var dez=$("#list img").eq(1).attr("src");
     var dsez=$("#list img").eq(len).attr("src");
     $("#list img").eq(0).attr("src",dsez);
     $("#list img").eq(len+1).attr("src",dez);
        
       //图片加载完成时将图片向左偏移一张图片 
       oList.css('left',-oWidth);  
       
         function animate(offset){                               //过渡效果
            var newLeft = parseInt(oList.css('left')) + offset; 
             
            //点击后的图片偏移量
            oList.animate({'left':newLeft + 'px'},function(){
                if(newLeft > -oWidth){                                 //判断图片是否已经循环一次
                    oList.css('left',-oWidth * len);
                }
                if(newLeft < -oWidth * len){
                    oList.css('left',-oWidth);
                }
    
                
            });
            
        }
         
        
 
        function showBtns(){                //按钮过渡
            oSpan.each(function(){                  //遍历每个按钮将其Class设置为空
                $(this).attr('class','');
            });
            $(".btns > span").eq(index - 1).addClass('on');          //将当前Span的索引Class设置为on
        }
 
        function autoplay(){                        //自动播放
            timer = setTimeout(function(){
                oRight.trigger('click');
                autoplay();
            },interval);
        }
 
        function stop(){
            clearInterval(timer);
        }
 
        oList.on('mouseover',function(){ 
        	//判断鼠标是否在容器上面
        	$("#left").css("display","block");
        	$("#right").css("display","block");
            stop();
        });
  $(".zytz").on('mouseover',function(){ 
        	//判断鼠标是否在容器上面
        	$("#left").css("display","block");
        	$("#right").css("display","block");
            stop();
        });
        oList.on('mouseout',function(){
            autoplay();
             $("#left").css("display","none");
        	 $("#right").css("display","none");
        });
       oRight.on('mouseover',function(){ 
       	   $("#left").css("display","block");
        	$("#right").css("display","block");
        	//判断鼠标是否在容器上面
            stop();
        });
  
       oRight.on('mouseout',function(){
             $("#left").css("display","none");
        	 $("#right").css("display","none");
            autoplay();
        });
        oLeft.on('mouseover',function(){
        	$("#left").css("display","block");
        	$("#right").css("display","block");
        	//判断鼠标是否在容器上面
            stop();
        });
  
       oLeft.on('mouseout',function(){
             $("#left").css("display","none");
        	 $("#right").css("display","none");
            autoplay();
        });
 
        oRight.on('click',function(){
            if(oList.is(':animated')){
                return;
            }
           
            /*if(index==2 || index==5){
              $(".bhqd").css("color","white");
            }
            else{
               $(".bhqd").css("color","#666666");
            }*/
            if(index == len){         //向右点击 index索引+1
                index = 1;
            }else{
                index += 1;
            }
              showBtns();
            animate(-oWidth);

       

        });
        pmkd();
        function pmkd(){
        	var kd=$(window).width();

				  //var kd=1500;
				  $(".btns1").css("width",kd);
				  $(".zytz").css("width",kd);
          if(kd<1500){
            $(".zytz1").css("width",kd-100);
          }
          else{
             $(".zytz1").css("width",1500);
          }
				  if(kd<1920){
				  	var xz=-(1920-kd)/2;
				    oList.css("margin-left",xz);
            oList.css("margin-right",xz);
				  }
				  else{
				  	$(".btns1").css("width",1920);
				    $(".zytz").css("width",1920);
				  }
        }

 $(window).resize(function() {
			  pmkd();
			  
		});
        oLeft.on('click',function(){
            if(oList.is(':animated')){
                return;
            }

           /*if(index==2 || index==4){
              $(".bhqd").css("color","white");
           }else{
              $(".bhqd").css("color","#666666");
           } */
            if(index == 1){         //向左点击 index索引-1
                index = len;
            }else{
                index -= 1;
            }
 
          showBtns();
            animate(oWidth);
       
        });
 
        oSpan.each(function(){                  //底部按钮点击切换图片
            $(this).on('click',function(){
                if(oList.is(":animated") || $(this).attr('class') == "on"){
                    return;
                }
                /* if(index==2 || index==5){
                    $(".bhqd").css("color","white");
                 }else{
                    $(".bhqd").css("color","#666666");
                 } */
                var myIndex = $(this).attr('index');
                var offset = (myIndex - index) * -oWidth;
                index = myIndex;
                animate(offset);
                showBtns();
            })
            $(this).on('mouseover',function(){
            	$("#left").css("display","block");
        	    $("#right").css("display","block");
               stop();
            })
            $(this).on('mouseout',function(){
            	$("#left").css("display","none");
        	    $("#right").css("display","none");
               autoplay();
            })
        })
 
        autoplay();
    });