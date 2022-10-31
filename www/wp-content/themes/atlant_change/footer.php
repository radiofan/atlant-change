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
			<div class="navbar-bottom__menu">
				<h5>Связь</h5>
				<span>Оператор</span>
				<a href="javascript:void(0)">@atl_support</a>
				<span>Бот для обмена</span>
				<a href="javascript:void(0)">@atlantch_bot</a>
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
	<form class="modal__login__container">
		<h3>Авторизация</h3>
		<input type="text" name="login" placeholder="Логин">
		<input type="password" name="password" placeholder="Пароль">
		<input type="text" name="code" placeholder="Кодовое слово">
		<div class="modal__login__links">
			<a href="javascript:void(0)">Забыли пароль</a>
			<a href="#modal__signin" rel="modal:open">Регистрация</a>
		</div>
		<input type="submit" value="Вход" class="btn btn-green">
	</form>
</div>

<div id="modal__signin" class="modal modal__signin">
	<form class="modal__signin__container">
		<h3>Регистрация</h3>
		<input type="text" name="login" placeholder="Логин">
		<input type="password" name="password" placeholder="Пароль">
		<input type="password" name="password_check" placeholder="Подтвердите пароль">
		<input type="text" name="code" placeholder="Кодовое слово">
		<input type="submit" value="Зарегистрироватся" class="btn btn-submit">
	</form>
</div>

<?php
echo file_get_contents(get_template_directory().'/assets/sprites.svg');

wp_footer();
?>
</body>
</html>