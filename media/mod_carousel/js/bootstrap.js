// Mootools-more.js conflicting with Bootstrap Carousel
var mHide = Element.prototype.hide;
var mShow = Element.prototype.show;
var mSlide = Element.prototype.slide;

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

jQuery(document).ready(function(){
	jQuery('.carousel[data-interval!="false"]').carousel('cycle');
});
