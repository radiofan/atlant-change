<?php
if(!defined('ABSPATH')) die();
get_header();
?>
<section class="feedback-reviews-block container">
	<h2>Отзывы</h2>
	<?= do_shortcode('[atlant-reviews-view max="8" pagination="1" class="feedback-reviews-block__slider-block"]') ?>
</section>
<section class="feedback-review-form container" id="review-form">
	<?= do_shortcode('[atlant-review-form header="Оставить отзыв"]Нажимая кнопку, вы соглашаетесь с<br>правилами обработки персональных данных[/atlant-review-form]') ?>
</section>
<?php
get_footer();
?>