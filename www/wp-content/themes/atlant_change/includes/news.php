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

// обработчик подзагрузки новостей
add_action('wp_ajax_atlant_news__get_page', 'atlant_news__get_page_ajax');
add_action('wp_ajax_nopriv_atlant_news__get_page', 'atlant_news__get_page_ajax');
function atlant_news__get_page_ajax(){
	$paged = !empty($_POST['paged']) ? absint($_POST['paged']) : 1;
	if($paged < 1)
		$paged = 1;
	$posts_per_page = !empty($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : 1;
	if($posts_per_page < 1){
		$posts_per_page = 1;
	}

	global $post;

	$args = [
		'paged' => $paged,
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'post_type' => 'post',
	];

	$query = new WP_Query($args);
	
	$ret = [];

	while($query->have_posts()){
		$query->the_post();
		
		$html = '
		<div class="news-card__data-block">
			<div class="news-card__data">
				<div class="news-card__header"><a href="'.get_the_permalink().'">'.get_the_title().'</a></div>
				<div class="news-card__description">
					'.get_the_excerpt().'
				</div>
			</div>
			<div class="news-card__links">
				<div class="news-card__date">'.get_the_date('j M. Y').' г.</div>
				<div class="news-card__link">
					<a href="'.get_the_permalink().'" class="link">Подробнее</a>
				</div>
			</div>
		</div>
		<div class="news-card__img-block">
			'.(has_post_thumbnail() ? get_the_post_thumbnail($post, 'large', ['class' => 'news-card__img']) : '<img src="'.get_template_directory_uri().'/assets/stub.png" alt="Заглушка" class="news-card__img">').'
		</div>';

		$ret[] = ['id' => $post->ID, 'html' => $html];
	}
	
	wp_reset_postdata();

	die(json_encode($ret));
}

add_shortcode('atlant-more-news', 'atlant__more_news__block_render');
function atlant__more_news__block_render($args, $content){
	$post_c = !empty($args['max']) ? absint($args['max']) : 1;
	if($post_c < 1){
		$post_c = 1;
	}
	
	$excluded_id = '';
	global $post;
	if($post && $post->post_type == 'post'){
		$excluded_id = $post->ID;
	}

	$args = [
		'paged' => 1,
		'post_status' => 'publish',
		'exclude' => $excluded_id,
		'posts_per_page' => $post_c,
		'post_type' => 'post',
	];

	$need_posts = get_posts($args);


	$html = '
<section class="news-more-block container">
	<h2 class="news-more-block__header">Еще новости</h2>
	<div class="news-more-block__container">';
	
	
	foreach($need_posts as $post){
		setup_postdata($post);
		$html .= '
		<div class="news-more-block__news-preview" data-post-id="'.$post->ID.'">
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

add_shortcode('atlant-news', 'atlant__news__block_render');
function atlant__news__block_render($args, $content){
	wp_enqueue_script('atlant-news');
	
	$post_c = !empty($args['max']) ? absint($args['max']) : 1;
	if($post_c < 1){
		$post_c = 1;
	}

	global $post;

	$args = [
		'paged' => 1,
		'post_status' => 'publish',
		'posts_per_page' => $post_c,
		'post_type' => 'post',
	];

	$query = new WP_Query($args);


	$html = '
<div class="index-news-block__news-block" data-post-per-page="'.$post_c.'" data-paged="1" data-pages-count="'.$query->max_num_pages.'">';
	
	$post_i = 0;
	while($query->have_posts()){
		$query->the_post();

		$html .= '
	<div class="news-card'.($post_i % 2 == 0 ? ' news-card--right' : '').'" data-post-id="'.$post->ID.'">
		<div class="news-card__data-block">
			<div class="news-card__data">
				<div class="news-card__header"><a href="'.get_the_permalink().'">'.get_the_title().'</a></div>
				<div class="news-card__description">
					'.get_the_excerpt().'
				</div>
			</div>
			<div class="news-card__links">
				<div class="news-card__date">'.get_the_date('j M. Y').' г.</div>
				<div class="news-card__link">
					<a href="'.get_the_permalink().'" class="link">Подробнее</a>
				</div>
			</div>
		</div>
		<div class="news-card__img-block">
			'.(has_post_thumbnail() ? get_the_post_thumbnail($post, 'large', ['class' => 'news-card__img']) : '<img src="'.get_template_directory_uri().'/assets/stub.png" alt="Заглушка" class="news-card__img">').'
		</div>
	</div>';
		$post_i++;
	}
	
	$html .= '
</div>
<div class="index-news-block__pagination">';
	
	$pages_b = [];
	if($query->max_num_pages < 6){
		for($i=1; $i<=$query->max_num_pages; $i++)
			$pages_b[] = $i;
	}else{
		$pages_b = [1, 2, '...', $query->max_num_pages - 1, $query->max_num_pages];
	}
	
	for($i=0; $i<sizeof($pages_b); $i++){
		$html .= '
	<button class="btn-empty'.($pages_b[$i] == 1 ? ' active' : '').($pages_b[$i] == '...' ? ' disabled' : '').'" '.($pages_b[$i] == '...' ? ' disabled="disabled"' : '').'>'.$pages_b[$i].'</button>';
	}
	
	$html .= '
</div>';

	wp_reset_postdata();
	
	return $html;
}