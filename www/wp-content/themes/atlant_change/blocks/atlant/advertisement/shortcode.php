<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-advertisement', 'atlant__advertisement__block_render');
function atlant__advertisement__block_render($args, $content){
	return '
<section class="index-ad-block container atlant-advertisement">
	<div class="index-ad-block__ad">'.do_shortcode($content).'</div>
</section>';
}
