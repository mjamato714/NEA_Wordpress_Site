jQuery(document).ready(function() {
  "use strict";
	var el = jQuery(".nxr_progressbar");
	jQuery(el).each(function() {
		jQuery(this).appear(function() {
			var percent = '0.'+jQuery(this).find(".nxr_progressbarfill").attr("data-value");
			var filltime = parseInt(jQuery(this).find(".nxr_progressbarfill").attr("data-time"));	
			var add_width = (percent*jQuery(".nxr_progressbarfill").parent().width())+'px';
			jQuery(this).find(".nxr_progressbarfill").animate({
				width: add_width
			}, { duration: filltime, queue: false });
		});
	});
});