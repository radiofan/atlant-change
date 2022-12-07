<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-section', 'atlant_section_block_render');
function atlant_section_block_render($args, $content){
	return '<section class="atlant-section container">'.do_shortcode($content).'</section>';
}
