<?php
if(!defined('ABSPATH')) die();

add_shortcode('atlant-login', 'atlant__login__block_render');
function atlant__login__block_render($args, $content){
	if(is_user_logged_in()){
		return '';
	}
	
	$redirect = '';
	$current_url = home_url($_SERVER['REQUEST_URI']);
	
	if(isset($args['redirect_back'])){
		$redirect = $current_url;
	}else if(isset($args['redirect'])){
		$redirect = esc_url($args['redirect']);
	}
	
	$html = '
	<form class="modal__login__container form-login" action="'.esc_url(wp_login_url($redirect)).'" method="post">
		<h3>Авторизация</h3>
		<input type="text" name="user_login" placeholder="Логин">
		<input type="password" name="user_pass" placeholder="Пароль">
		<label><input type="checkbox" name="rememberme" value="forever"> Запомнить меня </label>
		<div class="modal__login__links">
			<a href="'.wp_lostpassword_url($current_url).'">Забыли пароль</a>
			<a href="#modal__signin" rel="modal:open">Регистрация</a>
		</div>
		<input type="submit" value="Вход" class="btn btn-green">
		<input type="hidden" name="redirect_to" value="'.$redirect.'">
	</form>';
	
	return $html;
}

// обработчик входа пользователя
add_action('wp_ajax_atlant_login', 'atlant_login_ajax');
add_action('wp_ajax_nopriv_atlant_login', 'atlant_login_ajax');
function atlant_login_ajax(){
	
	if(is_user_logged_in()){
		wp_send_json(array(
			'success' => 0,
			'redirect' => false,
			'error' => 'Пользователь уже выполнил вход',
		));
		die();
	}
	
	$credentials = [
		'user_login' => isset($_POST['user_login']) ? trim(wp_unslash($_POST['user_login'])) : '',
		'user_password' => isset($_POST['user_pass']) ? $_POST['user_pass'] : '',
		'remember' => isset($_POST['rememberme']) ? sanitize_text_field(wp_unslash($_POST['rememberme'])) : '',
	];
	$redirect_to = isset($_POST['redirect_to']) ? esc_url_raw(trim(wp_unslash($_POST['redirect_to']))) : '';
	$secure_cookie = null;

	if(!force_ssl_admin()){
		$user = is_email($credentials['user_login']) ? get_user_by('email', $credentials['user_login']) : get_user_by('login', sanitize_user($credentials['user_login']));

		if($user && get_user_option('use_ssl', $user->ID)){
			$secure_cookie = true;
			force_ssl_admin(true);
		}
	}else{
		$secure_cookie = true;
	}

	$user = wp_signon($credentials, $secure_cookie);

	if($secure_cookie && strstr($redirect_to, 'wp-admin')){
		$redirect_to = str_replace('http:', 'https:', $redirect_to);
	}

	wp_send_json([
		'success' => is_wp_error($user) ? 0 : 1,
		'redirect' => $redirect_to,
		'error' => is_wp_error($user) ? $user->get_error_message() : '',
	]);
	die();
}

add_shortcode('atlant-registration', 'atlant__registration__block_render');
function atlant__registration__block_render($args, $content){
	if(is_user_logged_in()){
		return '';
	}

	$redirect = '';
	$current_url = home_url($_SERVER['REQUEST_URI']);

	$html = '
	<form class="modal__signin__container form-signin" action="'.esc_url(wp_registration_url()).'" method="post">
		<h3>Регистрация</h3>
		<input type="text" name="user_login" placeholder="Логин">
		<input type="email" name="user_email" placeholder="E-mail">';
	
	if(class_exists('C4wp_Captcha_Class') && c4wp_is_form_enabled('registration')){
		$html .= c4wp_captcha_form_field();
	}

	$html .= '
		<input type="submit" value="Зарегистрироваться" class="btn btn-submit">
	</form>';

	return $html;
}


// обработчик регистрации пользователя
add_action('wp_ajax_atlant_registration', 'atlant_registration_ajax');
add_action('wp_ajax_nopriv_atlant_registration', 'atlant_registration_ajax');
function atlant_registration_ajax(){
	if(is_user_logged_in()){
		wp_send_json(array(
			'success' => 0,
			'redirect' => false,
			'error' => 'Пользователь уже выполнил вход',
		));
		die();
	}
	
	if(!get_option('users_can_register')){
		wp_send_json(array(
			'success' => 0,
			'redirect' => false,
			'error' => 'Регистрация закрыта',
		));
		die();
	}


	$user_login = isset($_POST['user_login']) ? trim(wp_unslash($_POST['user_login'])) : '';
	$user_email = isset($_POST['user_email']) ? trim(wp_unslash($_POST['user_email'])) : '';

	$errors = register_new_user($user_login, $user_email);
	
	wp_send_json([
		'success' => is_wp_error($errors) ? 0 : 1,
		'error' => is_wp_error($errors) ? $errors->get_error_message() : 'Подтверждение регистрации отправлено на ваш email.',
	]);
	die();
}

add_action('admin_init', 'atlant_close_admin_for_users');
function atlant_close_admin_for_users(){
	if(!current_user_can('edit_posts') && !defined('DOING_AJAX')){
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
		show_admin_bar(false);
		add_filter('show_admin_bar', '__return_false');
		wp_add_inline_style('dashicons', '#wpadminbar {display: none !important;}');
		require get_404_template();
		exit();
	}
}

add_action('init', 'atlant_hide_bar_for_users');
function atlant_hide_bar_for_users(){
	if(!current_user_can('edit_posts')){
		show_admin_bar(false);
		add_filter('show_admin_bar', '__return_false');
	}
}

add_filter('login_redirect', 'atlant_redirect_login', 10, 3);
/**
 * @param $redirect_to
 * @param $requested_redirect_to
 * @param WP_User|WP_Error $user
 */
function atlant_redirect_login($redirect_to, $requested_redirect_to, $user){
	if(strpos($redirect_to, 'wp-admin') !== false){
		if(!is_wp_error($user) && $user->has_cap('edit_posts')){
			return $redirect_to;
		}
		return '/';
	}
	return $redirect_to;
}