<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-index-tech', 'atlant__index_tech__block_render');
function atlant__index_tech__block_render($args, $content){
	return '
<section class="index-support-block container">
	<div class="index-support-block__data-block">
		'.(!empty($args['header']) ? '
		<h2 class="index-support-block__header">'.esc_html($args['header']).'</h2>
		' : '').'
		'.(!empty($content) ? '
		<div class="index-support-block__description">'.do_shortcode($content).'</div>
		' : '').'
		'.(!empty($args['button_text']) ? '
		<a class="btn btn-submit"
			href="'.(empty($args['button_href']) ? 'javascript:void(0)' : esc_attr($args['button_href'])).'"'
			.(!empty($args['button_rel']) ? ' rel="'.esc_attr($args['button_rel']).'"' : '')
			.'>'.esc_html($args['button_text']).'</a>
		' : '').'
	</div>
	<div class="index-support-block__figures-block">
		<div class="index-support-block__figures-container">
			<svg viewBox="0 0 253 253" fill="none" class="index-support-block__figure-tor" xmlns="http://www.w3.org/2000/svg">
				<circle class="figure-shadow" cx="122.5" cy="122.5" r="97.5" stroke-width="50"/>
			</svg>

			<svg viewBox="0 0 221 192" fill="none" class="index-support-block__figure-triangle" xmlns="http://www.w3.org/2000/svg">
				<path class="figure-shadow" d="M106.5 0L212.588 183.75H0.411888L106.5 0Z"/>
			</svg>

			<svg viewBox="0 0 350 350" fill="none" class="index-support-block__figure-message" xmlns="http://www.w3.org/2000/svg">
				<path d="M349 233C349 243.255 344.926 253.09 337.675 260.341C330.423 267.593 320.588 271.667 310.333 271.667H78.3333L1 349V39.6667C1 29.4116 5.0738 19.5766 12.3252 12.3252C19.5766 5.0738 29.4116 1 39.6667 1H310.333C320.588 1 330.423 5.0738 337.675 12.3252C344.926 19.5766 349 29.4116 349 39.6667V233Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
	</div>
</section>';
}
