jQuery(document).ready(function($){
	
	let $body = $('body');

	$body.on('click.spoiler', '.spoiler__header', function(e){
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

	$body.on('click.collapse','*[data-toggle="collapse"]', function(e){
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
	
	//перекрашивает звезды
	function star_rating_draw($star_rating, rating){
		if(rating < 0){
			rating = 0;
		}
		if(rating > 5){
			rating = 5;
		}
		
		if(rating == 0){
			$star_rating.children('.star-rating__container').children('.star-rating__star').removeClass('star-rating__star--active');
		}else if(rating == 5){
			$star_rating.children('.star-rating__container').children('.star-rating__star').addClass('star-rating__star--active');
		}else{
			let $border = $star_rating.children('.star-rating__container').children('.star-rating__star').eq(rating);
			$border.prevAll().addClass('star-rating__star--active');
			$border.removeClass('star-rating__star--active');
			$border.nextAll().removeClass('star-rating__star--active');
		}
	}
	$('.star-rating').each(function(ind, elem){
		let $this = $(this);
		let rating = +$this.children('input[name="meta-rating"]').val();
		if(rating < 0){
			rating = 0;
			$this.children('input[name="meta-rating"]').val(rating);
		}
		if(rating > 5){
			rating = 5;
			$this.children('input[name="meta-rating"]').val(rating);
		}

		star_rating_draw($this, rating);
	});
	$body.on('click.star_rating', '.star-rating:not(.disabled) .star-rating__star', function(e){
		let $star = $(this);
		let ind = $star.index();
		let $star_rating = $star.closest('.star-rating');
		$star_rating.children('input[name="meta-rating"]').val(ind+1);

		star_rating_draw($star_rating, ind+1);
	});
	$body.on('mouseenter.star_rating', '.star-rating:not(.disabled) .star-rating__star', function(e){
		let $star = $(this);
		let ind = $star.index();
		let $star_rating = $star.closest('.star-rating');

		star_rating_draw($star_rating, ind+1);
	});
	$body.on('mouseleave.star_rating', '.star-rating:not(.disabled) .star-rating__star', function(e){
		let $star_rating = $(this).closest('.star-rating');
		let rating = $star_rating.children('input[name="meta-rating"]').val();

		star_rating_draw($star_rating, rating);
	});
	
	$body.on('click.slider', '.feedback-slider .feedback-slider__button', function(e){
		let $this = $(this);
		if($this.hasClass('disabled') || $this.prop('disabled')){
			return;
		}
		
		let $slider = $this.closest('.feedback-slider');
		let $container = $slider.children('.feedback-slider__content');
		let $slides = $container.children('.feedback-card');
		let $current_slide = $slides.filter('.feedback-card:visible');
		let current_slide_index = $current_slide.index();
		let current_page = +$slider.data('commentPage');
		
		if($this.hasClass('feedback-slider__left-arrow')){
			if(current_slide_index > 0){
				$current_slide.fadeOut(150, function(){
					$slides.eq(current_slide_index-1).fadeIn(150);
				});
			}
		}else{
			if(current_slide_index+1 < $slides.length){
				$current_slide.fadeOut(150, function(){
					$slides.eq(current_slide_index+1).fadeIn(150);
				});
			}
		}
	});

	$body.on('submit.login', 'form.form-login', function(e){
		
		e.preventDefault();
		let $form = $(this);
		if($form.data('isProcessed')){
			return;
		}

		$form.data('isProcessed', true);

		$form.find('.form-error').remove();
		let $submit = $form.find('input[type=submit]');
		$submit.data('text', $submit.val());
		$submit.val($submit.val() + '...');
		
		let form_data = {
			action: 'atlant_login',
			user_login: $form.find('*[name="user_login"]').val().trim(),
			user_pass: $form.find('*[name="user_pass"]').val()
		}
		
		let $remeber = $form.find('*[name="rememberme"]');
		if($remeber.prop('checked')){
			form_data.rememberme = $remeber.val();
		}
		
		let redirect = $form.find('*[name="redirect_to"]');
		if(redirect){
			redirect = redirect.val();
		}else{
			redirect = '';
		}

		$.ajax({
			type : 'POST',
			url : atlant_ajax_url,
			dataType:'json',
			data : form_data,
			cache: false,

			success:function(data){
				if(data.hasOwnProperty('success')){
					if(data.success){
						if(data.hasOwnProperty('redirect') && data.redirect){
							window.location.replace(response.redirect);
						}else{
							window.location.reload();
						}
						return;
					}else{
						$form.find('.modal__login__links').before('<p class="form-error" style="display:none;">'+data.error+'</p>');
						$form.find('.form-error').slideDown(200);
					}
				}
				$form.data('isProcessed', null);
				$submit.val($submit.data('text'));
			},
			error: function(jqXHR, exception){
				$form.data('isProcessed', null);
				$submit.val($submit.data('text'));
				alert('Не удалось связаться с сервером.\nПопробуйте позже');
			}
		});

	});

	$body.on('submit.signin', 'form.form-signin', function(e){

		e.preventDefault();
		let $form = $(this);
		if($form.data('isProcessed')){
			return;
		}

		$form.data('isProcessed', true);

		$form.find('.form-error').remove();
		let $submit = $form.find('input[type=submit]');
		$submit.data('text', $submit.val());
		$submit.val($submit.val() + '...');

		let form_data = {
			action: 'atlant_registration',
			user_login: $form.find('*[name="user_login"]').val().trim(),
			user_email: $form.find('*[name="user_email"]').val().trim()
		}
		
		let $captcha = $form.find('.c4wp_captcha_field');
		if($captcha){
			let id = $captcha.children().attr('id');
			id = +id.replace('c4wp_captcha_field_', '') - 1;
			form_data['g-recaptcha-response'] = grecaptcha.getResponse(id);
		}

		$.ajax({
			type : 'POST',
			url : atlant_ajax_url,
			dataType:'json',
			data : form_data,
			cache: false,

			success:function(data){
				if(data.hasOwnProperty('success')){
					$submit.before('<p class="form-error" style="display:none;">'+data.error+'</p>');
					$form.find('.form-error').slideDown(200);
				}
				if(data.hasOwnProperty('success') && data.success){
					$submit.val('Вы зарегистрировались!');
				}else{
					$form.data('isProcessed', null);
					$submit.val($submit.data('text'));
				}
			},
			error: function(jqXHR, exception){
				$form.data('isProcessed', null);
				$submit.val($submit.data('text'));
				alert('Не удалось связаться с сервером.\nПопробуйте позже');
			}
		});

	});

	$body.on('submit.review', 'form.form-review', function(e){
		let $form = $(this);
		$form.find('.form-error').remove();
		let data = {
			'author': $form.find('*[name="author"]').val().trim(),
			'meta-rating': +$form.find('*[name="meta-rating"]').val(),
			'comment': $form.find('*[name="comment"]').val().trim()
		};
		
		let error = '';
		
		if(!error && !data.author){
			error = 'Поле Имя должно быть заполнено';
		}

		if(!error && (+data['meta-rating'] <= 0 || +data['meta-rating'] > 5)){
			error = 'Требуется установить рейтинг отзыва';
		}

		if(!error && !data['comment']){
			error = 'Поле Комментарий должно быть заполнено';
		}

		let $captcha = $form.find('.c4wp_captcha_field');
		if($captcha){
			let id = $captcha.children().attr('id');
			id = +id.replace('c4wp_captcha_field_', '') - 1;
			data['g-recaptcha-response'] = grecaptcha.getResponse(id);
			
			if(!error && !data['g-recaptcha-response']){
				error = 'Требуется пройти капчу';
			}
		}
		
		if(error){
			e.preventDefault();
			
			$form.find('.feedback-review-form__submit-block').before('<p class="form-error" style="display:none">'+error+'</p>');
			$form.find('.form-error').slideDown(200);
		}
		
	});
	
});