jQuery('.map-container')
	.click(function(){
		jQuery(this).find('iframe').addClass('clicked')})
	.mouseleave(function(){
		jQuery(this).find('iframe').removeClass('clicked')});
