<!DOCTYPE html>
<html <?php //language_attributes(); ?>>
<head>
	<meta charset="<?php //bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php /* RSS и всякое */ ?>
	<link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php //bloginfo('rdf_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php //bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php //bloginfo('comments_rss2_url'); ?>">
	<link rel="pingback" href="<?php //bloginfo('pingback_url'); ?>" />

	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="/style.css?<?= filemtime('./style.css'); ?>">

	<?php //wp_head(); ?>
</head>
<body <?php //body_class(); ?>>
<header>
	<div class="container">
		<nav class="navbar navbar-top h6">
			<div class="navbar-top__logo">
				<a href="javascript:void(0)">
					<img src="/assets/logo.png" alt="Лого">
				</a>
			</div>
			<div class="collapse navbar-top__collapse" id="menu-top">
				<div class="navbar-top__items">
					<a class="navbar-top__item active" href="javascript:void(0)">Главная</a>
					<a class="navbar-top__item" href="javascript:void(0)">Отзывы</a>
					<a class="navbar-top__item" href="javascript:void(0)">Помощь</a>
					<a class="navbar-top__item disabled" href="javascript:void(0)">Партнерам</a>
					<?php $args = array( // опции для вывода верхнего меню, чтобы они работали, меню должно быть создано в админке
						'theme_location' => 'top', // идентификатор меню, определен в register_nav_menus() в functions.php
						'container'=> false, // обертка списка, тут не нужна
						'menu_id' => 'top-nav-ul', // id для ul
						'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
						'menu_class' => 'top-menu', // класс для ul, первые 2 обязательны
						//'walker' => new bootstrap_menu(true) // верхнее меню выводится по разметке бутсрапа, см класс в functions.php, если по наведению субменю не раскрывать то передайте false
					);
					//wp_nav_menu($args); // выводим верхнее меню
					?>
				</div>
				<div class="navbar-top__addition-items">
					<div class="navbar-top__addition-item navbar-top__online-button">
						<p>Мы онлайн <span class="icon-online"></span></p>
						<p><a href="javascript:void(0)">@ATL_SUPPORT</a></p>
					</div>
					<a href="javascript:void(0)" class="navbar-top__addition-item navbar-top__account-button">
						Личный кабинет
					</a>
				</div>
			</div>
			<button type="button" class="navbar-top__toggle collapsed" data-toggle="collapse" data-target="#topnav" aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</nav>
	</div>
</header>