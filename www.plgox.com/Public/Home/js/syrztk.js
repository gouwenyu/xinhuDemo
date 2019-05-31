		$(".qgbym").click(function(){

			$(".zhezhao1").css("display","none");
		    $(".zz_nr_fbcg_tc").css("display","none"); 
		    $(".zz_nr_scdz").css("display","none");
		    $(".qrzym").css("display","none");
		    return false;
		})

		 function tkcx6(message){

		  	    $(".zhezhao1").css("display","block");  

				$(".zz_nr_fbcg_tc").css("display","block");
		       $(".qrzym").css("display","inline-block");
				$(".zdsc").text(message);
				var ss=$(".dd_js1110").length;

				
		  }
    function qyrenzhe(qyrenz){
		$(".sjzx_rz").click(function(){
                
					if( qyrenz == 1 ){
						tkcx6("你尚未进行企业认证,请先认证后再进行商家入驻!");
					}else if( qyrenz == 2 ){
						window.location.href="http://www.plgox.com/Homeuser/dingdan_guanli.html";
						return false;
					}
			});
	}
		$(".qrzym").click(function(){	     
			 window.location.href="http://www.plgox.com/User/my_qyrz_sy.html";
        })
