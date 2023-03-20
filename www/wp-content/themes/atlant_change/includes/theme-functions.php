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

function get_share_button(){
	global $post;
	$html = '
	<div
		class="ya-share2"
		data-curtain
		data-use-links
		data-limit="0"
		data-more-button-type="long"
		data-description="'.esc_attr(get_the_excerpt()).'"
		'.(has_post_thumbnail() ? 'data-image="'.get_the_post_thumbnail_url($post, 'medium').'"' : '').'
		data-title="'.esc_attr(get_the_title()).'"
		data-url="'.esc_attr(get_the_permalink()).'"
		data-services="vkontakte,odnoklassniki,telegram,twitter,whatsapp"
	></div>';
	return $html;
}