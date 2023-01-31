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
				' : '').
				get_link_html_or_empty('button', 'index-o-block__data-block__btn btn btn-green', $args).'
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
