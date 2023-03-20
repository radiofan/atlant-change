<?php
if(!defined('ABSPATH')) die();

add_filter('nav_menu_link_attributes', 'atlant_account_link_in_menu', 10, 4);
function atlant_account_link_in_menu($atts, $menu_item, $args, $depth){
	global $pagename;
	if($atts['href'] === '#modal__login'){
		if(is_user_logged_in()){
			$atts['href'] = $pagename === 'account' ? '' : '/account/';
			$atts['rel'] = false;
		}
	}
	return $atts;
}

add_filter('nav_menu_css_class', 'atlant_account_link_in_menu_class', 10, 4);
function atlant_account_link_in_menu_class($classes, $menu_item, $args, $depth){
	global $pagename;
	if($menu_item->url === '#modal__login' && $pagename === 'account'){
		$classes[] = 'active';
	}
	return $classes;
}

add_shortcode('atlant-account-link', 'atlant__account_link__block_render');
function atlant__account_link__block_render($args, $content){
	global $pagename;
	//[atlant-account-link account-link="/account" class="navbar-top__addition-item navbar-top__account-button"]Личный кабинет[/atlant-account-link]
	$html = '<a';
	if(is_user_logged_in()){
		$html .= ' href="'.($pagename === 'account' ? 'javascript:void(0)' : '/account/').'"';
	}else{
		$html .= ' href="#modal__login" rel="modal:open"';
	}
	
	if($pagename === 'account'){
		if(empty($args['class'])){
			$args['class'] = 'active';
		}else{
			$args['class'] .= ' active';
		}
	}
	
	if(!empty($args['class'])){
		$html .= ' class="'.esc_attr($args['class']).'"';
	}

	$html .= '>'.$content.'</a>';
	return $html;
}


add_action('init', 'atlant_action__atlant_delete_my_comment');
function atlant_action__atlant_delete_my_comment(){
	if(!is_user_logged_in())
		return;
	
	if(!isset($_REQUEST['action'], $_REQUEST['c'], $_REQUEST['_wpnonce']))
		return;
	
	if($_REQUEST['action'] !== 'atlant_delete_my_comment')
		return;
	
	$comment_id = absint($_REQUEST['c']);
	if(!wp_verify_nonce($_REQUEST['_wpnonce'], 'nonce_atlant_delete_my_comment_'.$comment_id)){
		wp_nonce_ays('');
		return;
	}
	
	$comment = get_comment($comment_id);
	if(!$comment){
		wp_nonce_ays('');
		return;
	}
	if((int)$comment->user_id !== get_current_user_id()){
		wp_nonce_ays('');
		return;
	}

	wp_delete_comment($comment);
	if(!defined('DOING_AJAX')){
		$redir = home_url($_SERVER['REQUEST_URI']);
		$redir = remove_query_arg(['action', 'c', '_wpnonce'], $redir);
		wp_safe_redirect($redir);
	}
	die();
}

add_action('init', 'atlant_action__atlant_change_user_name');
function atlant_action__atlant_change_user_name(){
	if(!is_user_logged_in())
		return;

	if(!isset($_REQUEST['action'], $_REQUEST['new_user_name'], $_REQUEST['_wpnonce']))
		return;

	if($_REQUEST['action'] !== 'atlant_change_user_name')
		return;

	if(!wp_verify_nonce($_REQUEST['_wpnonce'], 'nonce_atlant_change_user_name')){
		wp_nonce_ays('');
		return;
	}
	
	$nickname = (string) $_REQUEST['new_user_name'];
	$nickname = esc_html(trim($nickname));

	$user_id = wp_update_user([
		'ID' => get_current_user_id(),
		'display_name' => $nickname,
		'nickname' => $nickname,
	]);

	if(!defined('DOING_AJAX')){
		$redir = home_url(explode('?', $_SERVER['REQUEST_URI'])[0].'#change-name');
		wp_safe_redirect($redir);
	}
	die();
}

add_filter('allow_password_reset', 'atlant_protect_administartor_password', 10, 2);
function atlant_protect_administartor_password($allow, $user_id){
	$user = new WP_User($user_id);
	return !in_array('administrator', $user->roles);
}