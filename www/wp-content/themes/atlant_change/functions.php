<?php

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

register_nav_menus(['top' => 'Верхнее меню', 'bottom_l' => 'Нижнее меню, левая часть', 'bottom_r' => 'Нижнее меню, правая часть', 'bottom_rules' => 'Нижнее меню, правила',]);

add_action('wp_enqueue_scripts', 'atlant_change_scripts');
function atlant_change_scripts(){
	wp_enqueue_style('dashicons');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-modal', get_template_directory_uri().'/js/jquery.modal.js', ['jquery']);
	wp_enqueue_script('atlant-change-scripts', get_template_directory_uri().'/js/scripts.js', ['jquery'], filemtime(get_template_directory().'/js/scripts.js'), 1);
}


/**
 * Class rad_simple_walker_nav
 * класс для генерации ссылок меню без оберток
 * использовать с настройками
 *
 * 'items_wrap' => '%3$s',
 * 'container' => '',
 * 'depth' => 1,
 * 'walker' => new rad_simple_walker_nav()
 */
class rad_simple_walker_nav extends Walker_Nav_Menu{

	public function start_lvl(&$output, $depth = 0, $args = null){
		$output .= '';
	}

	public function end_lvl(&$output, $depth = 0, $args = null){
		$output .= '';
	}

	public function end_el(&$output, $data_object, $depth = 0, $args = null){
		$output .= '';
	}

	public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0){

		// Restores the more descriptive, specific name for use within this method.
		$menu_item = $data_object;

		// passed classes
		$classes = empty($menu_item->classes) ? [] : (array)$menu_item->classes;
		if($menu_item->current){
			$classes[] = 'active';
		}
		if(empty($menu_item->url))
			$classes[] = 'disabled';


		$args = apply_filters('nav_menu_item_args', $args, $menu_item, $depth);


		$atts = [];

		$class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
		if($class_names)
			$atts['class'] = esc_attr($class_names);

		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$menu_item->ID, $menu_item, $args, $depth);
		if($id)
			$atts['id'] = esc_attr($id);


		$atts['title'] = !empty($menu_item->attr_title) ? $menu_item->attr_title : '';
		$atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
		if('_blank' === $menu_item->target && empty($menu_item->xfn)){
			$atts['rel'] = 'noopener';
		}else{
			$atts['rel'] = $menu_item->xfn;
		}
		$atts['href'] = !empty($menu_item->url) && !$menu_item->current ? $menu_item->url : '';
		$atts['aria-current'] = $menu_item->current ? 'page' : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);

		$attributes = '';
		foreach($atts as $attr => $value){
			if(is_scalar($value) && ('' !== $value || 'href' === $attr) && false !== $value){
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				if('href' === $attr && $value === ''){
					$value = 'javascript:void(0)';
				}
				if('rel' === $attr && $value === 'modalopen'){
					$value = 'modal:open';
				}
				$attributes .= ' '.$attr.'="'.$value.'"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters('the_title', $menu_item->title, $menu_item->ID);

		$title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);

		$item_output = $args->before;
		$item_output .= '<a'.$attributes.'>';
		$item_output .= $args->link_before.$title.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
	}

}