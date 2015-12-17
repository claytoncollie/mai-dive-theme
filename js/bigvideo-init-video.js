jQuery(function( $ ){

	var BV = new $.BigVideo({container: $('body'), useFlashForFirefox:false, doLoop: true});
	BV.init();
	BV.show([
		
		//{ type: "video/mp4", src: "http://bobosburn.wpengine.com/wp-content/themes/osburn-law/vids/omni-final.mp4" },
		//{ type: "video/webm", src: "http://bobosburn.wpengine.com/wp-content/themes/osburn-law/vids/omni-final-web.webm" }
		
		{ type: "video/mp4", src: BigVideo.src }
		
	]);

	// Fade in the video background after the video is fully loaded
	BV.getPlayer().on('durationchange',function(){
		$('#big-video-wrap').fadeIn();
	});

});