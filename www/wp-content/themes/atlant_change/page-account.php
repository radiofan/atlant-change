<?php
if(!defined('ABSPATH')) die();
get_header();

if(is_user_logged_in() && !is_feed()):
	$current_user = wp_get_current_user();
?>
	<section class="feedback-reviews-block container">
		<h2>Мои отзывы</h2>
		<?= do_shortcode('[atlant-my-reviews]') ?>
	</section>
	<section class="index-support-block container" id="change-name">
		<hr>
		<div class="index-support-block__data-block" style="align-items: flex-start;">
			<h4>Меня зовут</h4>
			<form name="lostpasswordform" action="<?= esc_url(home_url($_SERVER['REQUEST_URI'])) ?>" method="post">
				<input type="hidden" name="action" value="atlant_change_user_name"/>
				<input type="text" name="new_user_name" value="<?= esc_attr($current_user->display_name) ?>"/>
				<?php wp_nonce_field('nonce_atlant_change_user_name'); ?>
				<br>
				<br>
				<input type="submit" name="submit" class="btn btn-green" value="Сменить" />
			</form>
		</div>
	</section>
	<section class="feedback-reviews-block container" id="change-password">
		<hr>
		<h4>Сброс пароля</h4>
		<br>
		<p>
			На почту, привязанную к аккаунту придет сообщение, содержащее ссылку для сброса пароля.
		</p>
		<form name="lostpasswordform" action="<?= esc_url(network_site_url( 'wp-login.php?action=lostpassword', 'login_post' )); ?>" method="post">
			<input type="hidden" name="user_login" value="<?= esc_attr($current_user->user_login); ?>"/>
			<?php

			/**
			 * Fires inside the lostpassword form tags, before the hidden fields.
			 *
			 * @since 2.1.0
			 */
			do_action( 'lostpassword_form' );

			?>
			<input type="hidden" name="redirect_to" value="<?= esc_attr(home_url(explode('?', $_SERVER['REQUEST_URI'])[0].'#change-password')); ?>" />
			<input type="submit" name="wp-submit" class="btn btn-submit" value="<?php esc_attr_e( 'Get New Password' ); ?>" />
		</form>
	</section>


<?php
else:
	echo '<section class="index-about-block container">'.
	do_shortcode('[atlant-login]').
	'</section>';
endif;

get_footer();
?>