// Mootools-more.js conflicting with Bootstrap Carousel
(function(){
    var tId = setInterval(function() {
        if (document.readyState == "complete") onComplete()
    }, 11);
    function onComplete(){
        clearInterval(tId);    
		if ((typeof jQuery != 'undefined') && (typeof MooTools != 'undefined')) {
			// kill jquery slide for carousel class
			jQuery('.carousel').each(function(index, element) {
				jQuery(this)[index].slide = null;
			});
		}
    };
})()