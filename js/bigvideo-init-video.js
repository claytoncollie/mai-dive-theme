jQuery(function( $ ){

	var BV = new $.BigVideo({container: $('body'), useFlashForFirefox:false, doLoop: true});
		BV.init();
	BV.show([
		{ type: "video/mp4", src: BigVideoLocalizeMp4 },
		{ type: "video/webm", src: BigVideoLocalizeWebm }
	]);

	// Fade in the video background after the video is fully loaded
	BV.getPlayer().on('durationchange',function(){
		$('#big-video-wrap').fadeIn();
	});

});