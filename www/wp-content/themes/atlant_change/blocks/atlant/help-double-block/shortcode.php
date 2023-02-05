<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-help-double-block', 'atlant__help_double_block__block_render');
function atlant__help_double_block__block_render($args, $content){
	$right_column = !empty($args['right_column']) ? html_entity_decode($args['right_column']) : '';
	
	return '
<section class="help-change-block container">
	'.(!empty($args['header']) ? '
	<h2>'.esc_html($args['header']).'</h2>
	' : '').'
	<div class="help-change-block__container">
		<div class="help-change-block__help-spoilers-block">
			'.do_shortcode($right_column).'
		</div>
		<div class="help-change-block__calculator-block">
			'.do_shortcode($content).'
		</div>
	</div>
</section>';
}
