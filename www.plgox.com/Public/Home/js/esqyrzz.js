function esqyrz(dyw){
   //$(".sjzx_rz").click(function(){
           
            if( dyw == 1 ){
                tkcx6("请选择个人发布或企业认证后再发布")
                //alert("你尚未进行企业认证,请先认证后再进行商家入驻!");
            }else if( dyw == 2 ){
                // window.location.href="http://www.plgox.com/Homeuser/dingdan_guanli.html";
               //return false;
            }
   // });

}
      
             
            
            

$(".qgbym").click(function(){
    $(".zhezhao_top").css("display","none");
    $(".zz_nr_fbcg").css("display","none"); 
    $(".zz_nr_scdz").css("display","none");
    $(".qrzym").css("display","none");
    return false;
})
 function tkcx6(message){
        $(".zhezhao_top").css("display","block");  
        $(".zz_nr_fbcg").css("display","block");
       
        $(".zdsc").text(message);

         $(".qrzym").css("display","inline-block");
        var ss=$(".dd_js1110").length;
   // qkgwc6();
        
  }
$(".qrzym").click(function(){
     
     window.location.href="http://www.plgox.com/User/my_qyrz_sy.html";
})