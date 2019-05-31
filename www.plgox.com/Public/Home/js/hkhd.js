
var zbgd=$(".my_t2").css("height");

var ybgd=$(".mypj2").css("height");
$(".my_t2").css("height",zbgd);
if(parseInt(zbgd)<parseInt(ybgd)){
	$(".my_t2").css("height",ybgd);
}
else{
	$(".mypj2").css("height",zbgd);
}



function gbys(arra1,arra2,third_3,fourth_4){
 
 //将看不到的隐藏
 for(var i=0;i<arra1.length;i++){
 	$(arra1[i]).parent().css("display",'none');
 }
 
 //给添加很箭头
 for(var j=0;j<arra2.length;j++){
 	$(".help_topjt").eq(arra2[j]).addClass("help_topjt_dj");
 }

//左边浮动滑块距离头部
$(".hdmk").css("top",third_3);

//二设置左边点击背景
   $(".my_t5 li a").eq(fourth_4).css("backgroundColor","white").css("color","#1f61c3");
  $(".my_t5 li a").eq(fourth_4).siblings().css("backgroundColor","none").css("color","#1f61c3");

}

//点击箭头出现隐藏显示
  $(window).load(function() {




function qhzt(index,jtlxz){

		 	 	  	if($(".help_topjt").eq(index).css('opacity')==0.99){
		 	 	  		$(jtlxz).parent().removeClass("dywe");
		 	 	  		blxbj();
		 	 	  	  $(jtlxz).parent().css("display","none"); 	 	$(".help_topjt").eq(index).css("background","url(http://www.plgox.shop/Public/Home/image/help_center1.png) no-repeat 125px 18px");
		 	 	  	  $(".help_topjt").eq(index).css('opacity',1);
		 	 	  	  
		 	 	  	}
		 	 	  	else{
		 	 	  		$(jtlxz).parent().addClass("dywe");
		 	 	  		blxbj();
		 	 	  		$(jtlxz).parent().css("display","list-item");$(".help_topjt").eq(index).css("background","url(http://www.plgox.com/Public/Home/image/help_center2.png) no-repeat 115px 20px");
		 	 	  		$(".help_topjt").eq(index).css('opacity',0.99);
		 	 	  		
		 	 	  	}
	
  }	 
	

 $(".help_topjt").each(function(index){
 	 $(this).click(function(){
 	 	  if(index==0){	
 	 	  	if($(".help_topjt").eq(index).css('opacity')!=0.99){
 	 	  		 qhzt(index,".help_wm"); 
 	 	  	}
 	 	  	
 	 	  }
 	 	  else if(index==1){
 	 	  	if($(".help_topjt").eq(index).css('opacity')!=0.99){
 	 	  		qhzt(index,".help_zl"); 
 	 	  	}
 	 	  		 	  	
 	 	  }
 	 	  else if(index==2){
 	 	  	if($(".help_topjt").eq(index).css('opacity')!=0.99){
 	 	  		qhzt(index,".help_sm"); 
 	 	  	}
 	 	  		 	  	
 	 	  }
 	 	  else if(index==3){
 	 	  	if($(".help_topjt").eq(index).css('opacity')!=0.99){
 	 	  		qhzt(index,".help_sh"); 
 	 	  	}
 	 	  		 	  	
 	 	  }
 	 	  else{
 	 	  	if($(".help_topjt").eq(index).css('opacity')!=0.99){
 	 	  		qhzt(index,".help_wt");	 	
 	 	  	}
 	 	  	  
 	 	  }
 	 	  
 	 });
 });
 
 
 
 
 //一      滑块


 $(".my_t5 li").each(function(index){
      if($(this).css('display')=='list-item'){
      	 $(this).addClass("dywe");
      }

 });
 //遍历新添加的类dywe标记
function blxbj(){
$(".dywe a").each(function(index){
	$(this).mouseover(function(){
			
			var pxs=index*50+"px";
			$(".hdmk").stop().animate({top:pxs},'fast');
	});
	
 });
 $(".hdmk").css("display","none");
  $(".dywe a").mouseover(function(){
 	 $(".hdmk").css("display","block");
 });
  $(".dywe a").mouseout(function(){
 	 $(".hdmk").css("display","none");
 });
 
 
}

blxbj();
});