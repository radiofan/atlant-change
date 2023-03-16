<?php
if(!defined('ABSPATH')) die();

$date_format = get_option('date_format', 'd.m.y');
?>

<section class="news-article-block container" id="post-<?= $post->ID ?>">
	<div class="news-article-block__news-container">
		<div class="news-article-block__above-header">
			<div class="news-article-block__date"><?php the_time($date_format); ?></div>
			<?= get_share_button() ?>
		</div>
		<div class="news-article-block__header">
			<?php
			if($args['need_link'] ?? false):
			?>
			<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
			<?php
			else:
				the_title();
			endif;
			?>
		</div>

		<?php
		if(has_post_thumbnail()){
			?>
			<div class="news-article-block__picture">
				<?php the_post_thumbnail('full'); ?>
				<span class="news-article-block__picture__title"><?php the_post_thumbnail_caption(); ?></span>
			</div>
			<?php
		}
		?>

		<div class="news-article-block__description">
			<?php the_content(); ?>
		</div>
		<div class="news-article-block__footer">
			<?= get_share_button() ?>
		</div>
	</div>
</section>