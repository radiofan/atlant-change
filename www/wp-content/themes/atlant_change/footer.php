<?php
if(!defined('ABSPATH')) die();
$theme_mods = get_theme_mods();
?>
</main>
<footer>
	<nav class="navbar navbar-bottom container">
		<div class="navbar-bottom__container">
			<div class="navbar-bottom__menu-double">
				<div class="navbar-bottom__menu">
					<h5>Меню</h5>
					<?php
					if(has_nav_menu('bottom_l')){
						wp_nav_menu([
							'items_wrap' => '%3$s',
							'container' => '',
							'echo' => true,
							'depth' => 1,
							'theme_location' => 'bottom_l',
							'walker' => new rad_simple_walker_nav()
						]);
					}
					?>
				</div>
				<div class="navbar-bottom__menu">
					<h5>&#8203;</h5>
					<?php
					if(has_nav_menu('bottom_r')){
						wp_nav_menu([
							'items_wrap' => '%3$s',
							'container' => '',
							'echo' => true,
							'depth' => 1,
							'theme_location' => 'bottom_r',
							'walker' => new rad_simple_walker_nav()
						]);
					}
					?>
				</div>
				
			</div>
			<div class="navbar-bottom__menu navbar-bottom__menu_connection">
				<h5>Связь</h5>
				<?php
				if(!empty($theme_mods['connection_head_1'])){
					echo '<span>'.esc_html($theme_mods['connection_head_1']).'</span>';
				}
				?>
				<?= get_link_html_or_empty('connection_link_1', '', $theme_mods) ?>
				<?php
				if(!empty($theme_mods['connection_head_2'])){
					echo '<span>'.esc_html($theme_mods['connection_head_2']).'</span>';
				}
				?>
				<?= get_link_html_or_empty('connection_link_2', '', $theme_mods) ?>
			</div>
			<div class="navbar-bottom__menu">
				<h5>О правилах</h5>
				<?php
				if(has_nav_menu('bottom_rules')){
					wp_nav_menu([
						'items_wrap' => '%3$s',
						'container' => '',
						'echo' => true,
						'depth' => 1,
						'theme_location' => 'bottom_rules',
						'walker' => new rad_simple_walker_nav()
					]);
				}
				?>
			</div>
		</div>
	</nav>
</footer>

<div id="modal__login" class="modal modal__login">
	<?= do_shortcode('[atlant-login]') ?>
</div>

<div id="modal__signin" class="modal modal__signin">
	<?= do_shortcode('[atlant-registration]') ?>
</div>

<div id="modal__to-bot" class="modal modal__to-bot">
	<div class="modal__to-bot__container">
		<div class="modal__to-bot__content">
			<?php
			if(!empty($theme_mods['modal_to_bot_content'])){
				echo do_shortcode($theme_mods['modal_to_bot_content']);
			}
			?>
		</div>
		<?= get_link_html_or_empty('modal_to_bot_link', 'btn btn-green', $theme_mods) ?>
	</div>
</div>

<?php
echo file_get_contents(get_template_directory().'/assets/sprites.svg');

wp_footer();

//todo ссылки на личный кабинет
?>
</body>
</html>