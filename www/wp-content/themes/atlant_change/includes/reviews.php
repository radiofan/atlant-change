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

	$commentdata['comment_content'] = esc_html($commentdata['comment_content']);
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