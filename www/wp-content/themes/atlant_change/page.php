<?php
get_header();

if(have_posts()):
	while(have_posts()) :
		the_post();
?>

	<section id="post-<?php the_ID(); ?>" <?php post_class('article-description-block container'); ?>>
		<div class="article-description-block__data-block">
			<h2 class="article-description-block__data-block__header">TODO Как вступить в команду АТЛАНТА?!</h2>
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