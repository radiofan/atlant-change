<?php
if(!defined('ABSPATH')) die();
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		the_content();
	}
}

get_footer();

//todo
//global $shortcode_tags;
//error_log(print_r($shortcode_tags, 1));
?>