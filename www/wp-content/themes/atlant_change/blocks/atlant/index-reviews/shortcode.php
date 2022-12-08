<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-index-reviews', 'atlant__index_reviews__block_render');
function atlant__index_reviews__block_render($args, $content){
	return '
<section class="index-feedback-block container">
	'.(!empty($args['header']) ? '
	<h2>'.esc_html($args['header']).'</h2>
	' : '').'
	<div class="index-feedback-block__links-block">
		'.(!empty($args['review_set_text']) ? '
		<a class="link"
			href="'.(empty($args['review_set_href']) ? 'javascript:void(0)' : esc_attr($args['review_set_href'])).'"'
			.(!empty($args['review_set_rel']) ? ' rel="'.esc_attr($args['review_set_rel']).'"' : '')
			.'>'.esc_html($args['review_set_text']).'</a>
		' : '').'
		'.(!empty($args['reviews_text']) ? '
		<a class="link"
			href="'.(empty($args['reviews_href']) ? 'javascript:void(0)' : esc_attr($args['reviews_href'])).'"'
			.(!empty($args['reviews_rel']) ? ' rel="'.esc_attr($args['reviews_rel']).'"' : '')
			.'>'.esc_html($args['reviews_text']).'</a>
		' : '').'
	</div>
	'.do_shortcode($content).'
</section>
	';
}
