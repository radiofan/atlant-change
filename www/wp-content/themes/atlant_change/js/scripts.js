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
	
	$('body').on('submit.login', 'form.form-login', function(e){
		
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

	$('body').on('submit.signin', 'form.form-signin', function(e){

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
	
});