jQuery(document).ready(function(){
	jQuery('.carousel').each(function(index, element) {
		var maxHeight = 0;
		jQuery(element).find('.carousel-item').each(function(index, element) {
			var h = jQuery(element).height();
		    if (h > maxHeight) {
		        maxHeight = h;
		    }
		});
		var h = maxHeight +
			(jQuery(element).find('.carousel-indicators').length == 0 ? 0 : jQuery(element).find('.carousel-indicators').height());
		if (h > jQuery(element).find('.carousel-inner').height()) {
			jQuery(element).find('.carousel-inner').height(h);
		}
	});
	jQuery('.carousel[data-ride=="carousel"]').carousel('cycle');
});


// Mootools-more.js conflicting with Bootstrap Carousel
var mHide = Element.prototype.hide;
var mShow = Element.prototype.show;
var mSlide = Element.prototype.slide;

if (typeof Element.implement == 'function'){
	Element.implement({
	
	    /*
	     * These are needed to get some of the JQuery bootstrap built in effects working,
	     * like the carousel, and require you to add the 'mootools-noconflict' class to
	     * containers you want to use those effect with, like ...
	     * <div class="carousel slide mootools-noconflict">
	     */
	
	    hide: function () {
	        if (this.hasClass("mootools-noconflict")) {
	            return this;
	        }
	        mHide.apply(this, arguments);
	    },
	
	    show: function (v) {
	        if (this.hasClass("mootools-noconflict")) {
	            return this;
	        }
	        mShow.apply(this, v);
	    },
	
	    slide: function (v) {
	        if (this.hasClass("mootools-noconflict")) {
	            return this;
	        }
	        mSlide.apply(this, v);
	    }
	});
}
