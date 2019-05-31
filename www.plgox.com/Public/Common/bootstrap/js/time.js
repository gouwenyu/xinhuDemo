window.onload=function(){  
 function Timeover(){  
                var timer=null;//定义定时器对象   
                var oparenttime=$(".liktimer"); //获取对象  
 oparenttime.each(function(index){
     var time='1516172902';
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
                    //oparenttime.innerHTML="";  
                  /*document.getElementsByClassName("RemainD")[0].innerHTML=0; */ 
                  $(".RemainH").eq(index).html(0);  
                  $(".RemainM").eq(index).html(0);;  
                  $(".RemainS").eq(index).html(0);;  
              }  
          })
        } 
      function loop(){  
        Timeover();  
        timer=setInterval(Timeover,1000);  
     }  
    loop();//消除帅新等待1秒倒计时的bug  
} 
