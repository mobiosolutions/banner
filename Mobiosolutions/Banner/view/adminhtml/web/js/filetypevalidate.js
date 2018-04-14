require([
'jquery' // jquery Library
], function (){	
	jQuery(window).load(function (){
		if(jQuery("#page_banner_image_delete").length <= 0) {
			jQuery.globalEval(jQuery('.input-file').addClass('required-entry rquired-file'));
		}else{
			jQuery("#page_banner_image").next("span.delete-image").attr("style","visibility:hidden");
		}
	});
});