<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-for-partners-feedback', 'atlant__for_partners_feedback__block_render');
function atlant__for_partners_feedback__block_render($args, $content){
	return '
<section class="for-partners-feedback-block">
	<div class="for-partners-feedback-block__feedback-block">
		'.(!empty($args['header']) ? '
		<h2>'.esc_html($args['header']).'</h2>
		' : '').'
		
		<div class="for-partners-feedback-block__content">
			<div class="for-partners-feedback-block__links">'.
				(!empty($args['sub_header_1']) ? '
				<h4>'.esc_html($args['sub_header_1']).'</h4>
				' : '').
				get_link_html_or_empty('link_1', '', $args).
		
				(!empty($args['sub_header_2']) ? '
				<h4>'.esc_html($args['sub_header_2']).'</h4>
				' : '').
				get_link_html_or_empty('link_2', '', $args).
			'</div>
			
			<div class="for-partners-feedback-block__links">'.
				(!empty($args['sub_header_3']) ? '
				<h4>'.esc_html($args['sub_header_3']).'</h4>
				' : '').
				get_link_html_or_empty('link_3', '', $args).
		
				(!empty($args['sub_header_4']) ? '
				<h4>'.esc_html($args['sub_header_4']).'</h4>
				' : '').
				get_link_html_or_empty('link_4', '', $args).
			'</div>
		</div>
	</div>
	<div class="for-partners-feedback-block__description">'.do_shortcode($content).'</div>
</section>';
}
