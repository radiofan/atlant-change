jQuery(document).ready(function($){
	
	$('body').on('click.spoiler', '.spoiler__header', function(e){
		let $spoiler = $(this).parent('.spoiler');
		
		if(!$spoiler)
			return;
		
		if($spoiler.hasClass('active'))
			return;

		$spoiler.siblings('.spoiler.active[data-auto-hide="true"]').children('.spoiler__content').slideUp(200, function(){
			$(this).parent('.spoiler').removeClass('active');
		});

		$spoiler.children('.spoiler__content').slideDown(200, function(){
			$spoiler.addClass('active');
		});
	});
	
});