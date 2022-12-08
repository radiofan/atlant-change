<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-atlant-block', 'atlant__atlant_block__block_render');
function atlant__atlant_block__block_render($args, $content){
	return '
<section class="index-about-block container">
	<div class="index-about-block__atlant-img">
		<img src="'.get_template_directory_uri().'/assets/atlant.png" alt="Маскот">
	</div>
	<div class="index-about-block__data-block">
		'.(!empty($args['header']) ? '
		<h2>'.esc_html($args['header']).'</h2>
		' : '').'
		'.(!empty($content) ? $content : '').'
	</div>
</section>';
}
