<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-index-o-block', 'atlant__index_o_block__block_render');
function atlant__index_o_block__block_render($args, $content){
	return '
<section class="index-o-block">
	<div class="container">
		<div class="index-o-block__container">
			<div class="index-o-block__data-block">
				'.(!empty($args['header']) ? '
				<h2 class="index-o-block__data-block__header">'.esc_html($args['header']).'</h2>
				' : '').'
				'.(!empty($content) ? '
				<div class="index-o-block__data-block__description">'.do_shortcode($content).'</div>
				' : '').'
				'.(!empty($args['button_text']) ? '
				<a class="index-o-block__data-block__btn btn btn-green"
					href="'.(empty($args['button_href']) ? 'javascript:void(0)' : esc_attr($args['button_href'])).'"'
					.(!empty($args['button_rel']) ? ' rel="'.esc_attr($args['button_rel']).'"' : '')
					.'>'.esc_html($args['button_text']).'</a>
				' : '').'
			</div>
			<div class="index-o-block__phone-block">
				<div class="index-o-block__phone-block__shadow"></div>
				<div class="index-o-block__phone-block__background"></div>
			</div>
		</div>
	</div>
	<div class="index-o-block__tor"></div>
	<div class="index-o-block__shadow"></div>
</section>';
}
