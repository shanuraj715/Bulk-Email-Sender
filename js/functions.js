$(document).ready(function(){
	$(function(){
		// below function is for tooltip.
		/*
		tooltip means all the title attributes of any html element will show in another UI.
		the tootip function is available because we are using jquery UI plugin.
		*/
		$(document).tooltip({
			show: null,
			position: {
				my: "left top",
				at: "left bottom"
			},
			open: function( event, ui ) {
				ui.tooltip.animate({
					top: ui.tooltip.position().top + 10
				}, "fast" );
			}
		});

	});
});