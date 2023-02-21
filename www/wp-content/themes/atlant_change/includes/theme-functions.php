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
	return '
	<button class="news-article-block__btn-share">Поделиться
		<svg class="news-article-block__btn-share__icon">
			<use xlink:href="#share"></use>
		</svg>
	</button>
	';
}