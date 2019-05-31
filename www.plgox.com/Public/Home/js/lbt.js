
	function ggz(box,liz,rightz,leftz,zcd,kdz,jgz){
   
       window.oList = $(box);
       window.oListcd = $(liz);
        window.oRight = $(rightz);
        window.kd=kdz;
       window.oLeft = $(leftz);
         window.zcd=leftz;
        oList.css("width",kd);
        
       window.oWidth = parseInt(oList.css('width')) / zcd;
       
      window.index = 1;
       window.interval = 200;
         window.timer = null;
        oList.css('left',0); 
        
        function animate(offset){                               //过渡效果
            var newLeft = parseInt(oList.css('left')) + offset;         //点击后的图片偏移量
            oList.animate({'left':newLeft + 'px'},interval);

        }
      
 
        oRight.click(function(){
          if(oListcd.length<4){
          	return false;
          }
         if(oListcd.length-4<index){
         	return false;
         }
        	oLeft.css("display","block");
            if(oList.is(':animated')){
                return;
            }
            index += 1;    
            if(index == zcd-jgz){         //向右点击 index索引+1
               $(this).css("display","none");
            }               
            animate(-oWidth);
           
        });
     
 
        oLeft.click(function(){
        	oRight.css("display","block");
        	 index -= 1;
            if(oList.is(':animated')){
                return;
            }
            animate(oWidth);
            if(index == 1){  
               $(this).css("display","none");
            } 
              
            
        });
      
  }
	       
	 
