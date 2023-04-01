<?php //get_header(); ?>
<?php
define('PAGE', 'modals');
require_once 'header.php';
?>

<div class="container">

<p><a href="#modal__to-bot" rel="modal:open">К боту</a></p>
<p><a href="#modal__login" rel="modal:open">Авторизация</a></p>
<p><a href="#modal__signin" rel="modal:open">Регистрация</a></p>

</div>


<div id="modal__to-bot" class="modal modal__to-bot">
	<div class="modal__to-bot__container">
		<div class="modal__to-bot__content">Для того чтобы завершить обмен прейдите в Телеграм-бота</div>
		<a href="javascript:void(0)" class="btn btn-green">К&nbsp;боту</a>
	</div>
</div>

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
		<input type="submit" value="Зарегистрироваться" class="btn btn-submit">
	</form>
</div>

<?php //get_footer(); ?>
<?php require_once 'footer.php'; ?>