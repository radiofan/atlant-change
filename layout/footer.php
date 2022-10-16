<footer>
	<nav class="navbar navbar-bottom container">
		<div class="navbar-bottom__container">
			<div class="navbar-bottom__menu-double">
				<div class="navbar-bottom__menu">
					<h5>Меню</h5>
					<a href="javascript:void(0)">Главная</a>
					<a href="javascript:void(0)">Отзывы</a>
					<a href="javascript:void(0)">Помощь</a>
					<a href="javascript:void(0)">Партнерам</a>
				</div>
				<div class="navbar-bottom__menu">
					<h5>&#8203;</h5>
					<a href="javascript:void(0)" class="disabled">Новости</a>
					<a href="javascript:void(0)">О сервисе</a>
					<a href="javascript:void(0)">Наш бот</a>
					<a href="javascript:void(0)">Личный кабинет</a>
				</div>
				
			</div>
			<div class="navbar-bottom__menu">
				<h5>Связь</h5>
				<span>Оператор</span>
				<a href="javascript:void(0)">@atl_support</a>
				<span>Бот для обмена</span>
				<a href="javascript:void(0)">@atlantch_bot</a>
			</div>
			<div class="navbar-bottom__menu">
				<h5>О правилах</h5>
				<a href="javascript:void(0)">Политика конфиденциальности</a>
				<a href="javascript:void(0)">Пользовательское соглашение</a>
				<a href="javascript:void(0)">Договор оферта</a>
			</div>
			
			
			<?php $args = array( // опции для вывода нижнего меню, чтобы они работали, меню должно быть создано в админке
				'theme_location' => 'bottom', // идентификатор меню, определен в register_nav_menus() в function.php
				'container'=> false, // обертка списка, false - это ничего
				'menu_class' => 'nav nav-pills bottom-menu', // класс для ul
				'menu_id' => 'bottom-nav', // id для ul
				'fallback_cb' => false
			);
			//wp_nav_menu($args);
			?>
		</div>
	</nav>
</footer>
<?php echo file_get_contents('./assets/sprites.svg'); ?>
<?php //wp_footer(); ?>
</body>
</html>