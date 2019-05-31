$(".my_t2").css("height","700px");
var zbgd=$(".my_t2").css("height");
var ybgd=$(".mypj2").css("height");

if(parseInt(zbgd)<parseInt(ybgd)){
	$(".my_t2").css("height",ybgd);
}
else{
	$(".mypj2").css("height",zbgd-20);
}

//点击箭头出现隐藏显示
  $(window).load(function() {

function qhzt(index,jtlxz){

		 	 	  	if($(".help_topjt").eq(index).css('opacity')==0.99){
		 	 	  		$(jtlxz).parent().removeClass("dywe");
		 	 	  		blxbj();
		 	 	  	  $(jtlxz).parent().css("display","none"); 	 	$(".help_topjt").eq(index).css("background","url(http://localhost/www.plgox.shop/Public/Home/image/help_center1.png) no-repeat 115px 20px");
		 	 	  	  $(".help_topjt").eq(index).css('opacity',1);
		 	 	  	  
		 	 	  	}
		 	 	  	else{
		 	 	  		$(jtlxz).parent().addClass("dywe");
		 	 	  		blxbj();
		 	 	  		$(jtlxz).parent().css("display","list-item");$(".help_topjt").eq(index).css("background","url(http://localhost/www.plgox.shop/Public/Home/image/help_center2.png) no-repeat 115px 20px");
		 	 	  		$(".help_topjt").eq(index).css('opacity',0.99);
		 	 	  		
		 	 	  	}
	
  }	 
	

 $(".help_topjt").each(function(index){
 	 $(this).click(function(){
 	 	  if(index==0){	 	  	
 	 	  	 qhzt(index,".help_zl"); 
 	 	  }
 	 	  else if(index==1){
 	 	  	qhzt(index,".help_sh");
 	 	  	
 	 	  }
 	 	  else{
 	 	  	qhzt(index,".help_wt");
 	 	  
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