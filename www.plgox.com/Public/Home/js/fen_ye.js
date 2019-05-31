	
  //上传图片
 $(window).load(function() {
  /* 分页*/	
	var mess_li=($(".message_fy li").length-2)*34+2*60+15;
	$(".message_fy").css("width",mess_li);
	
	 $(".message_fy li a").each(function(index){
    	$(this).click(function(){
    		$(this).addClass('xdbh_on');
    		var cd=$(".xdbh").length;
    		for(var j=0; j<cd;j++){
    			if(index!=j){
    				$(".message_fy li a").eq(j).removeClass('xdbh_on');
    			}
    		}
    	});
    	$(".message_fy li").eq(index).mouseover(function(){
    		$(this).css("background","#F2F2F2");
    	});
    	$(".message_fy li").eq(index).mouseout(function(){
    		$(this).css("background","none").css("color","black");
    	})
    });
	
});
