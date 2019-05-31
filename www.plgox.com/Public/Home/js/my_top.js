
if(parseInt($(".my_t5").css("height"))>parseInt($(".mypj2").css("height"))){
	$(".mypj2").css("height",parseInt($(".my_t5").css("height"))+40);
}
else{
	$(".my_t5").css("height",parseInt($(".mypj2").css("height"))-38);
}
function my_top(index,gd,wznr){
  $(".my_t5 li a").eq(index).css("background","url('http://www.plgox.shop/Public/Home/image/my_top1.png') no-repeat left top").css("backgroundColor","white");
  $(".my_t5 li a").eq(index).siblings().css("background","url('http://www.plgox.shop/Public/Home/image/my_top1.png') no-repeat left top").css("backgroundColor","none");
  
  //左边浮动滑块距离头部
$(".hdmk").css("top",gd);

$(".my_tbxd").html(wznr);
 }