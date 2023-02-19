jQuery(function( $ ){
	
	wp.customize('atlant_logo', function(value){
		value.bind(function(newVal){
			let $img = $('img.navbar-top__logo__img--desktop');
			if(!$img.data('old-src')){
				$img.data('old-src', $img.attr('src'));
			}
			$img.attr('src', newVal === '' ? $img.data('old-src') : newVal);
		});
	});

	wp.customize('atlant_logo_mobile', function(value){
		value.bind(function(newVal){
			let $img = $('img.navbar-top__logo__img--mobile');
			if(!$img.data('old-src')){
				$img.data('old-src', $img.attr('src'));
			}
			$img.attr('src', newVal === '' ? $img.data('old-src') : newVal);
		});
	});

	wp.customize('we_online_text', function(value){
		value.bind(function(newVal){
			$('#menu-top .navbar-top__online-button a').text(newVal);
		});
	});
	wp.customize('we_online_href', function(value){
		value.bind(function(newVal){
			$('#menu-top .navbar-top__online-button a').attr('href', newVal === '' ? 'javascript:void(0)' : newVal);
		});
	});
	wp.customize('we_online_rel', function(value){
		value.bind(function(newVal){
			$('#menu-top .navbar-top__online-button a').attr('rel', newVal);
		});
	});

	wp.customize('connection_head_1', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection span').eq(0).text(newVal);
		});
	});

	wp.customize('connection_link_1_text', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection a').eq(0).text(newVal);
		});
	});
	wp.customize('connection_link_1_href', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection a').eq(0).attr('href', newVal === '' ? 'javascript:void(0)' : newVal);
		});
	});
	wp.customize('connection_link_1_rel', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection a').eq(0).attr('rel', newVal);
		});
	});

	wp.customize('connection_head_2', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection span').eq(1).text(newVal);
		});
	});

	wp.customize('connection_link_2_text', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection a').eq(1).text(newVal);
		});
	});
	wp.customize('connection_link_2_href', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection a').eq(1).attr('href', newVal === '' ? 'javascript:void(0)' : newVal);
		});
	});
	wp.customize('connection_link_2_rel', function(value){
		value.bind(function(newVal){
			$('.navbar-bottom__menu_connection a').eq(1).attr('rel', newVal);
		});
	});
});