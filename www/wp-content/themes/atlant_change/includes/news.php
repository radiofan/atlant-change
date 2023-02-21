<?php
if(!defined('ABSPATH')) die();

// обработчик подзагрузки новостей
add_action('wp_ajax_atlant_loadmore', 'atlant_loadmore_ajax');
add_action('wp_ajax_nopriv_atlant_loadmore', 'atlant_loadmore_ajax');
function atlant_loadmore_ajax(){
	$paged = $_POST['paged'] ?? 1;
	$paged = absint($paged) + 1;

	$args = [
		'paged' => $paged,
		'post_status' => 'publish'
	];
	
	global $post;

	$need_posts = get_posts($args);

	foreach($need_posts as $post){
		setup_postdata($post);
		get_template_part('news-template', null, ['need_link' => true]);
	}
	wp_reset_postdata();

	die();
}

add_shortcode('atlant-more-news', 'atlant__more_news__block_render');
function atlant__more_news__block_render($args, $content){
	$post_c = !empty($args['max']) ? absint($args['max']) : 1;
	if($post_c < 1){
		$post_c = 1;
	}
	
	$excluded_id = '';
	global $post;
	if($post){
		$excluded_id = $post->ID;
	}

	$args = [
		'paged' => 1,
		'post_status' => 'publish',
		'exclude' => $excluded_id,
		'posts_per_page' => $post_c,
	];

	$need_posts = get_posts($args);


	$html = '<section class="news-more-block container">
	<h2 class="news-more-block__header">Еще новости</h2>
	<div class="news-more-block__container">';
	
	
	foreach($need_posts as $post){
		setup_postdata($post);
		$html .= '
		<div class="news-more-block__news-preview">
			<div class="news-more-block__news-preview__img">';
		if(has_post_thumbnail()){
			$html .= get_the_post_thumbnail($post, 'large');
		}else{
			$html .= '<img src="'.get_template_directory_uri().'/assets/stub.png" alt="Заглушка">';
		}
		$html .= '
			</div>
			<div class="news-more-block__news-preview__link h4">
				<a href="'.get_the_permalink().'">'.get_the_title().'</a>
			</div>
		</div>';
		
	}
	wp_reset_postdata();
	
	
	$html .= '
	</div>
</section>';
	
	return $html;
}