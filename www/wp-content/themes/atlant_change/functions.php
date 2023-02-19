<?php

if(!defined('ABSPATH')) die();

if(!function_exists('WP_Filesystem')){
	require_once(ABSPATH.'wp-admin/includes/file.php');
}

require_once get_template_directory().'/includes/rad-simple-walker-nav-class.php';

/**
 * Возвращает $href если $need_set true, иначе javascript:void(0)
 * @param bool $need_set - нужно ли установить ссылку
 * @param string $href - возвращаемый адрес ссылки
 * @return string
 */
function set_href(bool $need_set, string $href): string{
	return $need_set ? $href : 'javascript:void(0)';
}

/**
 * Возвращает html ссылку или пустоту, если $args не содержит текст ссылки
 * @param string $name - префикс аргуметов ссылки
 * @param string $class - класс ссылки
 * @param array $args - массив содержащий аргументы $name.'_text', $name.'_href', $name.'_rel' (или не содержащий)
 * @return string
 */
function get_link_html_or_empty(string $name, string $class, array $args=[]): string{
	if(empty($args[$name.'_text']))
		return '';
	
	$ret = '<a';
	if(!empty($class)){
		$ret .= ' class="'.esc_attr($class).'"';
	}

	$ret .= ' href="'.(empty($args[$name.'_href']) ? 'javascript:void(0)' : esc_attr($args[$name.'_href'])).'"';

	if(!empty($args[$name.'_rel'])){
		$ret .= ' rel="'.esc_attr($args[$name.'_rel']).'"';
	}

	$ret .= '>'.esc_html($args[$name.'_text']).'</a>';
	return $ret;
}


add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('admin-bar', ['callback' => '__return_false']);
add_theme_support('menus');
add_theme_support('post-thumbnails', ['post', 'page']);
set_post_thumbnail_size(520, 520);
add_post_type_support('page', ['excerpt', 'custom-fields']);

//портит шорткоды, пусть обрабатывает последней
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'wptexturize', 100);

register_nav_menus(['top' => 'Верхнее меню', 'bottom_l' => 'Нижнее меню, левая часть', 'bottom_r' => 'Нижнее меню, правая часть', 'bottom_rules' => 'Нижнее меню, правила',]);

add_action('wp_enqueue_scripts', 'atlant_change_scripts');
function atlant_change_scripts(){
	wp_enqueue_style('dashicons');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-modal', get_template_directory_uri().'/js/jquery.modal.js', ['jquery']);
	wp_enqueue_script('atlant-change-scripts', get_template_directory_uri().'/js/scripts.js', ['jquery'], filemtime(get_template_directory().'/js/scripts.js'), 1);
}

//добавлячем категорию блоков гуттенберга для сайта
add_filter('block_categories_all', 'atlant_register_block_category');
function atlant_register_block_category($block_categories){

	array_unshift($block_categories, ['slug' => 'atlant', 'title' => 'Виджеты Атланта', 'icon' => null]);
	
	return $block_categories;
}

//загружает блоки гуттенберга из /blocks/atlant/
add_action('init', 'atlant_register_blocks');
function atlant_register_blocks(){

	/** @var \WP_Filesystem_Base $wp_filesystem */
	global $wp_filesystem;
	if(empty($wp_filesystem)){
		WP_Filesystem();
	}
	
	$blocks_path = get_template_directory().'/blocks/atlant/';
	
	$blocks_name = [];

	$file_list = $wp_filesystem->dirlist($blocks_path, 0, 0);
	foreach($file_list as $file_name => &$file_data){
		if($file_data['type'] !== 'd'){
			continue;
		}
		if(
			file_exists($blocks_path.$file_name.'/shortcode.php')
			&& file_exists($blocks_path.$file_name.'/block.asset.php')
			&& file_exists($blocks_path.$file_name.'/block.json')
		){
			$blocks_name[] = $file_name;
			require_once $blocks_path.$file_name.'/shortcode.php';
		}
	}
	
	if(!function_exists('register_block_type')){
		return;
	}
	
	$len = sizeof($blocks_name);
	for($i=0; $i<$len; $i++){
		register_block_type($blocks_path.$blocks_name[$i]);
	}
}


add_action('customize_preview_init', 'atlant_customizer_js_file');
function atlant_customizer_js_file(){
	wp_enqueue_script('atlant-customizer', get_template_directory_uri().'/js/atlant-customizer.js', ['jquery','customize-preview'], '0.0', true);
}

add_action('customize_register', 'atlant_customize_register');
function atlant_customize_register(WP_Customize_Manager $wp_customize){
	
	function add_link_inputs(WP_Customize_Manager $wp_customize, string $setting, string $section, string $text, $transport='postMessage', $text_default='', $href_default='', $rel_default=''){

		$wp_customize->add_setting($setting.'_text', [
			'default' => $text_default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $transport
		]);
		$wp_customize->add_control($setting.'_text', [
			'section' => $section,
			'label' => $text.' - текст',
			'type' => 'text'
		]);
		
		$wp_customize->add_setting($setting.'_href', [
			'default' => $href_default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $transport
		]);
		$wp_customize->add_control($setting.'_href', [
			'section' => $section,
			'label' => $text.' - ссылка',
			'type' => 'text'
		]);

		$wp_customize->add_setting($setting.'_rel', [
			'default' => $rel_default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $transport
		]);
		$wp_customize->add_control($setting.'_rel', [
			'section' => $section,
			'label' => $text.' - отношение',
			'type' => 'text'
		]);
	}

	$transport = 'postMessage';
	
	if($section = 'atlant_options'){

		$wp_customize->add_section($section, [
			'title' => 'Настройки темы',
			'priority' => 200,
			'description' => 'Настройки лого, и ссылок в шапке и подвале',
		]);

		$setting = 'atlant_logo';
		$wp_customize->add_setting($setting, [
			'default' => 0/*get_template_directory().'/assets/logo.png'*/,
			'transport' => $transport
		]);
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, $setting, [
				'label' => 'Лого в шапке',
				'settings' => $setting,
				'section' => $section
			])
		);

		$setting = 'atlant_logo_mobile';
		$wp_customize->add_setting($setting, [
			'default' => 0/*get_template_directory().'/assets/logo-mobile.png'*/,
			'transport' => $transport
		]);
		$wp_customize->add_control(
			new WP_Customize_Image_Control($wp_customize, $setting, [
				'label' => 'Лого в шапке для моб',
				'settings' => $setting,
				'section' => $section
			])
		);

		add_link_inputs($wp_customize, 'we_online', $section, 'Мы онлайн', $transport, '@ATL_SUPPORT');

		$setting = 'connection_head_1';
		$wp_customize->add_setting($setting, [
			'default' => 'Оператор',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $transport
		]);
		$wp_customize->add_control($setting, [
			'section' => $section,
			'label' => 'Связь Заголовок 1',
			'type' => 'text'
		]);
		
		add_link_inputs($wp_customize, 'connection_link_1', $section, 'Связь ссылка 1', $transport, '@atl_support');

		$setting = 'connection_head_2';
		$wp_customize->add_setting($setting, [
			'default' => 'Бот для обмена',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $transport
		]);
		$wp_customize->add_control($setting, [
			'section' => $section,
			'label' => 'Связь Заголовок 2',
			'type' => 'text'
		]);

		add_link_inputs($wp_customize, 'connection_link_2', $section, 'Связь ссылка 2', $transport, '@atlantch_bot');
	}
}