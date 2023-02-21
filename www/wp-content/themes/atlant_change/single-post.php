<?php
if(!defined('ABSPATH')) die();
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		get_template_part('news-template', null, ['need_link' => false]);
	}
}
echo do_shortcode('[atlant-more-news max="3"]');
get_footer();
?>