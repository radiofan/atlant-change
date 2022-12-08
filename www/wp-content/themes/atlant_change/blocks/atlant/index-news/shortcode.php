<?php
if(!defined('ABSPATH')) die();
add_shortcode('atlant-index-news', 'atlant__index_news__block_render');
function atlant__index_news__block_render($args, $content){
	return '
<section class="index-news-block">

	<svg class="index-news-block__wave" viewBox="0 0 1920 240" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path class="wave" d="M1920,38c-183,21-550,56-960,1C783.221,15.286,522-17,0,39v180h1920V38z"/>
	</svg>

	<div class="index-news-block__container container">
		'.(!empty($args['header']) ? '
			<h2 class="index-news-block__header">'.esc_html($args['header']).'</h2>
			' : '').
		do_shortcode($content).'
	</div>
</section>';
}
