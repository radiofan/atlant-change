<?php
$theme_mods = get_theme_mods();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?= get_stylesheet_uri().'?v='.filemtime(get_stylesheet_directory().'/style.css'); ?>" type="text/css" />
	
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
	<nav class="navbar navbar-top container h6<?= (!is_front_page() ? ' bg-color--not-white' : ''); ?>">
		<div class="navbar-top__logo">
			<a href="<?= set_href(!is_front_page(), home_url('/')); ?>">
				<img class="navbar-top__logo__img navbar-top__logo__img--desktop" src="<?= esc_attr($theme_mods['atlant_logo'] ?? get_template_directory_uri().'/assets/logo.png') ?>" alt="Лого">
				<img class="navbar-top__logo__img navbar-top__logo__img--mobile" src="<?= esc_attr($theme_mods['atlant_logo_mobile'] ?? get_template_directory_uri().'/assets/logo-mobile.png') ?>" alt="Лого">
			</a>
		</div>
		<div class="collapse navbar-top__collapse" id="menu-top">
			<div class="navbar-top__items">
				<?php
				if(has_nav_menu('top')){
					wp_nav_menu([
						'items_wrap' => '%3$s',
						'container' => '',
						'echo' => true,
						'depth' => 1,
						'theme_location' => 'top',
						'walker' => new rad_simple_walker_nav()
					]);
				}
				?>
			</div>
			<div class="navbar-top__addition-items">
				<?php
				if(!empty($theme_mods['we_online_text'])):
				?>
				<div class="navbar-top__addition-item navbar-top__online-button">
					<p>Мы онлайн <span class="icon-online"></span></p>
					<p><?= get_link_html_or_empty('we_online', '', $theme_mods) ?></p>
				</div>
				<?php
				endif;
				?>
				<a href="#modal__login" rel="modal:open" class="navbar-top__addition-item navbar-top__account-button">
					Личный кабинет
				</a>
			</div>
		</div>
		<button type="button" class="navbar-top__toggle collapsed" data-toggle="collapse" data-target="#menu-top" aria-expanded="false">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</nav>
</header>

<main>
	
<?php
if(!is_front_page()):
?>
	
	<div class="page-header container">
		<h3><?= get_the_title() ?></h3>
	</div>

<?php
endif;
?>