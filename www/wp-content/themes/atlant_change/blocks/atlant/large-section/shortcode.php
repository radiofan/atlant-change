<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-large-section', 'atlant_large_section_block_render');
function atlant_large_section_block_render($args, $content){
	return '<section class="atlant-large-section">'.do_shortcode($content).'</section>';
}
