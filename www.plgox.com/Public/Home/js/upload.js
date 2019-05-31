	
  //上传图片
 $(window).load(function() {
  $(".wdzl_tp1").click(function(){
  	 $(".zhezhao").css("display","block");
  	  $(".container").css("display","block");
  	  $(".zz_nr_cy").css("display","none");
  	  $(".zz_nr").css("display","none");
  })
	var options =
	{
		thumbBox: '.thumbBox',
		spinner: '.spinner',
		imgSrc: '../image/index_lb5.jpg'
	}
	var cropper = $('.imageBox').cropbox(options);
	$('#file').change(function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			options.imgSrc = e.target.result;
			cropper = $('.imageBox').cropbox(options);
		}
		reader.readAsDataURL(this.files[0]);
		
		
	})
	$('#btnCrop').click(function(){
		var img = cropper.getDataURL();
		$('.cropped').html('');
		   $.ajax({
			type: "POST",
		dataType: "json",
   			 url: "{:U('Homeuser/uplads_tp')}",
   			data: {'data':img},
   		 success: function(data){
   		 	var dj=9-$(".gbqk").length;
   		 	$(".wdzl_tp").eq(dj).removeClass('gbqk');
   		 	var tplj="__ROOT__/"+data.message;
   		 	$(".wdzl_tp").eq(dj).css("display","block");
   		 	$(".wdzl_tp img").eq(dj).attr("src",tplj);
   		 	 $(".zhezhao").css("display","none");
   		 	  $(".container").css("display","none");
   		}
   		 
   		 });
	});
	
	$('#btnZoomIn').click(function(){
		cropper.zoomIn();
	})
	$('#btnZoomOut').click(function(){
		cropper.zoomOut();
	})
	
	$(".wdzl_tp60").each(function(index){
		$(this).click(function(){
			$(".wdzl_tp").eq(index).css("display","none");
		});
	})

	
	
});
