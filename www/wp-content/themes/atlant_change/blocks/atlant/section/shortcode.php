<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-section', 'atlant__section__block_render');
function atlant__section__block_render($args, $content){
	return '<section class="atlant-section container">'.do_shortcode($content).'</section>';
}
