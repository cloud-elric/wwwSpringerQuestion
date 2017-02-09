(function($) {

	$.fn.uploadFile = function(options) {

		// Establish our default settings
		var opts = $.extend({}, $.fn.uploadFile.defaults, options);

		
			$(this).on('click', $.fn.uploadFile.setPreview);
		

	}

	$.fn.uploadFile.defaults = {
		type : 'image',
	};
	
	$.fn.uploadFile.setPreview = function() {
		alert($.fn.uploadFile.defaults.type);
	}
	

}(jQuery));