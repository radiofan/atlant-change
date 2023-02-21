<?php
/*
Template Name: Страница с круглой картинкой
Template Post Type: page
*/
if(!defined('ABSPATH')) die();

get_header();

if(have_posts()):
	while(have_posts()) :
		the_post();

		$another_title = get_post_meta($post->ID, 'title', true);
		if(empty($another_title))
			$another_title = $post->post_title;
		?>

		<section id="post-<?php the_ID(); ?>" <?php post_class('article-description-block container'); ?>>
			<div class="article-description-block__data-block">
				<h2 class="article-description-block__data-block__header"><?= esc_html($another_title) ?></h2>
				<div class="article-description-block__data-block__description">
					<?= $post->post_excerpt; ?>
				</div>
			</div>
			<?php
			if(has_post_thumbnail()):
				?>
				<div class="article-description-block__img-block">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php
			endif;
			?>
		</section>

		<?php the_content(); ?>

	<?php
	endwhile;
endif;

get_footer();
?>