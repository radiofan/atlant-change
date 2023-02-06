<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-help-spoiler', 'atlant__help_spoiler__block_render');
function atlant__help_spoiler__block_render($args, $content){
	
	$ret = '
<div class="spoiler spoiler--left-border" data-auto-hide="true">
	<a href="javascript:void(0)" class="spoiler__header">'.(!empty($args['header']) ? esc_html($args['header']) : '').'</a>
	<div class="spoiler__content">
		'.do_shortcode($content).'
	</div>
</div>';
	
	
	return $ret;
}
