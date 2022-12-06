<?php

if(!defined('ABSPATH')) die();

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


add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('admin-bar', ['callback' => '__return_false']);
add_theme_support('menus');
add_theme_support('post-thumbnails', ['post', 'page']);
set_post_thumbnail_size(520, 520);
add_post_type_support('page', 'excerpt');

register_nav_menus(['top' => 'Верхнее меню', 'bottom_l' => 'Нижнее меню, левая часть', 'bottom_r' => 'Нижнее меню, правая часть', 'bottom_rules' => 'Нижнее меню, правила',]);

add_action('wp_enqueue_scripts', 'atlant_change_scripts');
function atlant_change_scripts(){
	wp_enqueue_style('dashicons');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-modal', get_template_directory_uri().'/js/jquery.modal.js', ['jquery']);
	wp_enqueue_script('atlant-change-scripts', get_template_directory_uri().'/js/scripts.js', ['jquery'], filemtime(get_template_directory().'/js/scripts.js'), 1);
}

add_filter('block_categories_all', 'atlant_register_block_category');
function atlant_register_block_category($block_categories){

	array_unshift($block_categories, ['slug' => 'atlant', 'title' => 'Виджеты Атланта', 'icon' => null]);
	
	return $block_categories;
}

add_action('init', 'atlant_register_blocks');
function atlant_register_blocks(){
	if(!function_exists('register_block_type')){
		// Gutenberg is not active.
		return;
	}

	register_block_type(get_template_directory().'/blocks/atlant/large-section/', [
		'render_callback' => 'atlant_large_section_block_render',

	]);
}

function atlant_large_section_block_render($args, $content){
	return do_shortcode($content);
}