<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-gray-section', 'atlant__gray_section__block_render');
function atlant__gray_section__block_render($args, $content){
	
	return '
<section class="help-text-block container">
	'.do_shortcode($content).'
</section>';
}
