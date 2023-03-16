<?php
add_shortcode('atlant-review-form', 'atlant__review_form__block_render');
function atlant__review_form__block_render($args, $content){

	$html = '';
	if(!empty($args['header'])){
		$html = '<h2>'.esc_html($args['header']).'</h2>';
	}

	if(!is_user_logged_in()){
		$html .= '<p>Только зарегистрированные пользователи могут оставлять отзывы.</p>';
		return $html;
	}

	if(!comments_open()){
		$html .= '<p>Отзывы отключены</p>';
		return $html;
	}

	$privacy = '';
	if(!empty($content)){
		$privacy = '
		<div class="feedback-review-form__privacy">
			'.do_shortcode($content).'
		</div>';
	}

	$user = wp_get_current_user();

	global $post;
	$id = empty($post) ? 0 : $post->ID;

	$html .= '
	<form class="feedback-review-form__container form-review" action="'.site_url('/wp-comments-post.php').'" method="post">
		<div class="feedback-review-form__input-block">
			<input type="text" name="author" class="feedback-review-form__input" placeholder="Имя" value="'.esc_attr($user->display_name).'">
			<div class="star-rating">
				<input type="hidden" name="meta-rating" value="0">
				<div class="star-rating__container">
					<span class="star-rating__star dashicons dashicons-star-filled"></span>
					<span class="star-rating__star dashicons dashicons-star-filled"></span>
					<span class="star-rating__star dashicons dashicons-star-filled"></span>
					<span class="star-rating__star dashicons dashicons-star-filled"></span>
					<span class="star-rating__star dashicons dashicons-star-filled"></span>
				</div>
			</div>
		</div>
		<div class="feedback-review-form__textarea-block">
			<textarea class="feedback-review-form__textarea" name="comment" placeholder="Ваш отзыв"></textarea>';

	if(class_exists('C4wp_Captcha_Class') && c4wp_is_form_enabled('comment')){
		$html .= '<div class="feedback-review-form__captcha">'.c4wp_captcha_form_field().'</div>';
	}

	$html .= '
		</div>
		<div class="feedback-review-form__submit-block">
			<input type="hidden" name="comment_post_ID" value="'.$id.'">
			<input type="hidden" name="comment_parent" value="0">
			<input type="submit" value="Отправить" class="btn btn-submit">
			'.$privacy.'
		</div>
	</form>';

	return $html;
}

add_filter('preprocess_comment', 'atlant_validate_comment_data');
function atlant_validate_comment_data($commentdata){
	
	$meta_rating = isset($_POST['meta-rating']) ? absint($_POST['meta-rating']) : 0;
	
	if($meta_rating <= 0 || $meta_rating > 5){
		wp_die(
			'<p>Рейтинг отзыва не установлен</p>',
			esc_html__('Comment Submission Failure'),
			['response' => 403, 'back_link' => true]
		);
	}

	$commentdata['comment_content'] = htmlspecialchars($commentdata['comment_content'], ENT_NOQUOTES | ENT_HTML401);
	$commentdata['comment_parent'] = 0;
	
	return $commentdata;
}

add_filter('comment_post', 'atlant_save_meta_comment_data');
function atlant_save_meta_comment_data($comment_id){
	$meta_rating = isset($_POST['meta-rating']) ? absint($_POST['meta-rating']) : 0;
	
	add_comment_meta($comment_id, 'rating', $meta_rating);
}

add_action('current_screen', 'atlant_view_comment_rating_admin');
function atlant_view_comment_rating_admin(){
	$screen = get_current_screen();
	if('edit-comments' === $screen->id){
		add_filter('comment_text', 'atlant_add_comment_rating_to_text');
	}
}

function atlant_add_comment_rating_to_text($text){
	return $text.'<br>'.wp_star_rating([
		'rating' => get_comment_meta(get_comment_ID(), 'rating', true),
		'echo' => false,
	]);
}

//atlant-reviews-view max="4" pagination="0" yellow-ring="1" class="feedback-reviews-block__slider-block"
add_shortcode('atlant-reviews-view', 'atlant__reviews_view__block_render');
function atlant__reviews_view__block_render($args, $content){
	$pagination = empty($args['pagination']) ? 0 : 1;
	
	$page = 0;
	if($pagination){
		$page = empty($_GET['comment-page']) ? 0 : absint($_GET['comment-page']);
	}
	
	$per_page = empty($args['max']) ? 4 : absint($args['max']);
	if(!$per_page){
		$per_page = 4;
	}
	
	$class = '';
	if(!empty($args['class'])){
		$class = ' '.esc_attr($args['class']);
	}
	
	$yellow_ring = '';
	if(!empty($args['yellow-ring'])){
		$yellow_ring = ' feedback-reviews-block__feedback-container--yellow-ring';
	}

	$comments_c = get_comments([
		'post_status' => 'publish',
		'status' => 'approve',
		'count' => true,
	]);
	
	$pages_c = (int)($comments_c / $per_page);
	if($comments_c % $per_page){
		$pages_c += 1;
	}

	if($page >= $pages_c){
		if($pages_c > 0){
			$page = $pages_c-1;
		}else{
			$page = 0;
		}
	}
	
	
	$comments = get_comments([
		'post_status' => 'publish',
		'status' => 'approve',
		'number' => $per_page,
		'offset' => $page*$per_page,
	]);


	$html = '
	<div class="feedback-slider'.$class.'" data-post-per-page="'.$per_page.'" data-comment-page="'.$page.'" data-pages-count="'.$pages_c.'" data-has-pagination="'.$pagination.'">
		<button class="btn-empty feedback-slider__button feedback-slider__left-arrow icon icon-left-arrow"></button>
		<div class="feedback-slider__content feedback-reviews-block__feedback-container'.$yellow_ring.'">';
	
	$len = sizeof($comments);
	$date_format = get_option('date_format', 'd.m.y');
	for($i=0; $i<$len; $i++){
		$rating = absint(get_comment_meta($comments[$i]->comment_ID, 'rating', 1));
		$html .= '
			<div class="feedback-card" id="comment-'.$comments[$i]->comment_ID.'">
				<div class="feedback-card__content">
					<div class="feedback-card__header">
						<span>'.esc_html($comments[$i]->comment_author).'</span>
						<span class="feedback-card__rating"><span class="color--yellow">'.$rating.'</span>/5</span>
					</div>
					<div class="feedback-card__description">
						'.esc_html($comments[$i]->comment_content).'
					</div>
				</div>
				<div class="feedback-card__date">'.get_comment_date($date_format, $comments[$i]).'</div>
			</div>'; 
	}

	$html .= '

		</div>
		<button class="btn-empty feedback-slider__button feedback-slider__right-arrow icon icon-right-arrow"></button>
	</div>';
	
	if($pagination && $pages_c > 1){
		$curret_link = explode('?', get_pagenum_link());
		$curret_link = $curret_link[0].'?comment-page=';
		
		$html .= '
	<div class="feedback-reviews-block__pagination">';
		if($page > 0){
			$html .= '
		<a class="feedback-reviews-block__arrow btn-empty" href="'.$curret_link.($page-1).'">
			<svg class="feedback-reviews-block__arrow-icon">
				<use xlink:href="#left-arrow"></use>
			</svg>
		</a>';
		}
		
		$pages_b = [];
		if($pages_c < 6){
			for($i=1; $i<=$pages_c; $i++)
				$pages_b[] = $i;
		}else{
			$pages_b = [1, $page < 1 ? 1 : $page, $page+1, $page+1 >= $pages_c ? $page+1 : $page+2, $pages_c];
			$pages_b = array_values(array_unique($pages_b));
		}

		for($i = 0; $i<sizeof($pages_b)-1; $i++){
			if($pages_b[$i] + 1 != $pages_b[$i+1]){
				array_splice($pages_b, $i+1, 0, '...');
				$i++;
			}
		}

		for($i=0; $i<sizeof($pages_b); $i++){
			$href = $pages_b[$i] == '...' || $pages_b[$i] == $page+1 ? 'javascript:void(0)' : $curret_link.($pages_b[$i]-1);
			$html .= '
	<a class="btn-empty'.($pages_b[$i] == $page+1 ? ' active' : '').($pages_b[$i] == '...' ? ' disabled' : '').'" href="'.$href.'">'.$pages_b[$i].'</a>';
		}


		if($page+1 < $pages_c){
			$html .= '
		<a class="feedback-reviews-block__arrow btn-empty" href="'.$curret_link.($page+1).'">
			<svg class="feedback-reviews-block__arrow-icon">
				<use xlink:href="#right-arrow"></use>
			</svg>
		</a>';
		}
		$html .= '
	</div>';
	}

	return $html;
}