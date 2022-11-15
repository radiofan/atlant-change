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

	$('body').on('click.collapse','*[data-toggle="collapse"]', function(e){
		let $this = $(this);
		let $toggle_e = $($this.data('target'));
		
		if(!$toggle_e){
			return;
		}
		
		if($toggle_e.data('is-toggle'))
			return;

		$toggle_e.data('is-toggle', true);
		if($toggle_e.is(':hidden')){
			$toggle_e.css('right', -$toggle_e.outerWidth(true)+'px');
			$toggle_e.css('display', 'flex');
			$this.attr('aria-expanded', true).addClass('navbar-top__toggle--close');
			$toggle_e.animate({right: 0}, 300, function(){
				$toggle_e.data('is-toggle', false);
			});
			
		}else{
			$this.attr('aria-expanded', false).removeClass('navbar-top__toggle--close');
			$toggle_e.animate({right: -$toggle_e.outerWidth(true)+'px'}, 300, function(){
				$toggle_e.css('display', '');
				$toggle_e.css('right', '');
				$toggle_e.data('is-toggle', false);
			});
			
		}
	});
	
});