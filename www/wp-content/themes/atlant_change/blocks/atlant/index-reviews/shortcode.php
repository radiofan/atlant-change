<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-index-reviews', 'atlant__index_reviews__block_render');
function atlant__index_reviews__block_render($args, $content){
	return '
<section class="index-feedback-block container">
	'.(!empty($args['header']) ? '
	<h2>'.esc_html($args['header']).'</h2>
	' : '').'
	<div class="index-feedback-block__links-block">'.
		get_link_html_or_empty('review_set', 'link', $args).
		get_link_html_or_empty('reviews', 'link', $args).'
	</div>
	'.do_shortcode($content).'
</section>';
}
