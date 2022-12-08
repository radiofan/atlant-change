<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-large-section', 'atlant__large_section__block_render');
function atlant__large_section__block_render($args, $content){
	return '<section class="atlant-large-section">'.do_shortcode($content).'</section>';
}
