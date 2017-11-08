jQuery(document).ready(function($) {
  "use strict";
	
	var divs = $('.nxr_tweetfeed .nxr_tweet'),interval, current = jQuery(divs[0]);

	var cycle = function(){
		var prev = current;   
		current = current.next();
		if (current.length == 0){
			 current = jQuery(divs[0]);
		}    
		prev.fadeOut(function(){
			current.fadeIn(); 
		});
	}
	
	$('.nxr_tweetfeed').appear(function() {
	   interval = window.setInterval(cycle, 3500);    
	}, function(){
		window.clearInterval(interval);
	});

});