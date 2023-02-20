<?php
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		get_template_part('news-template', null, ['need_link' => false]);
	}
}
//todo шорткод смотрите еще
get_footer();
?>