<?php //get_header(); ?>
<?php
define('PAGE', 'help');
require_once 'header.php';
?>
<section class="help-change-block container">
	<h2>Обмен фиатов на крипто-активы</h2>
	<div class="help-change-block__container">
		<div class="help-change-block__help-spoilers-block">
			
			<div class="spoiler spoiler--left-border active" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Выберите платежных средств</a>
				<div class="spoiler__content">
					С помощью информационной панели Вам потребуется выбрать, с каких платежных средств Вы хотите совершить обмен.
				</div>
			</div>

			<div class="spoiler spoiler--left-border" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Укажите сумму обмена</a>
				<div class="spoiler__content">
					Потребуется ввести сумму(в фиатах)
				</div>
			</div>

			<div class="spoiler spoiler--left-border" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Выбор криптоактивов</a>
				<div class="spoiler__content">
					Указать какую криптовалюту Вы хотите получить.
				</div>
			</div>

			<div class="spoiler spoiler--left-border" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Сбор данных</a>
				<div class="spoiler__content">
					Указать номер кошелька и ФИО держателя карты, с которой будет совершён перевод.
				</div>
			</div>

			<div class="spoiler spoiler--left-border" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Присвоение номер ордера</a>
				<div class="spoiler__content">
					После данного алгоритма, к вашей операции будет присвоен номер заявки(ордер),по которому Вы можете обратиться к оператору напрямую, чтобы произвести обмен/внести корректировки предоставленных данных/отказаться от заявки(закрыть ордер).
				</div>
			</div>

			<div class="spoiler spoiler--left-border" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Проверьте и подтвердите детали обмена</a>
				<div class="spoiler__content">
					Если все данные введены верно и Вы согласны с зафиксированным курсом, то вы можете приступить к совершению операции.
				</div>
			</div>

			<div class="spoiler spoiler--left-border" data-auto-hide="true">
				<a href="javascript:void(0)" class="spoiler__header">Обмен завершен</a>
				<div class="spoiler__content">
					Вы осуществляете перевод денежных средств с платёжного средства, которое Вы выбрали при заполнении ордера, на реквизиты, которые были предоставлены Вам после создания ордера.
				</div>
			</div>
			
		</div>
		<div class="help-change-block__calculator-block">
			<form class="calculator-form">
				<div class="select">
					<select name="type" class="calculator-form__type-select">
						<option value="sale">Продать</option>
					</select>
				</div>
				<div class="select">
					<select name="currency" class="calculator-form__currency-select">
						<option value="ethereum">Ethereum</option>
					</select>
				</div>
				<input type="text" name="value" class="calculator-form__value-input" value="100">
				<div class="calculator-form__submit-section h5">
					<div class="calculator-form__result">Вы заплатите: <span class="color--yellow">0&nbsp;₽</span></div>
					<input type="submit" name="currency-exchange" value="Обменять" class="btn btn-submit">
				</div>
			</form>
		</div>
	</div>
</section>
<section class="help-text-block container">
	<p>
		Данный сайт работает в ручном режиме, все операции осуществляются человеком, все заявки(ордера) переносятся либо заполняются(создаются) в чат боте в телеграмме, после уже исполняются оператором. Среднее время обработки заявки до 15 минут, перевод активов осуществляется только с РУ карт и только прямым переводом p2p.<br>
		Администрация сайта не облагает и не вводит лимитные ограничения, но так же и не несёт ответственности за блокировку ваших платежных средств.<br>
		Администрация ATLANT-CHANGE просит соблюдать правила и действовать согласно инструкциям данного сайта и чат-бота, так же она оставляет за собой право изменять, добавлять и удалять пункты правил в любое время.<br>
		В случае совершения или попытки совершения мошеннических действий со стороны клиента(возможно партнёра), нарушитель будет заблокирован и все возможные операции будут отменены.<br>
		Так же будет составлено обращение в правоохранительные органы. При правильном пользовании данным ресурсом вы обязательно добьётесь успеха ,а мы всегда будем рядом и поддержим вас в любой ситуации.
	</p>
	<p>
		<b>Регламент пользователя:</b><br>
		Данный сайт создан и используется для обработки заявок на обмен крипто-активов,<br>
		Данный сайт, как и его Администрация, не несёт финансовой ответственности и не является финансовой организацией, все операции производятся по собственной инициативе пользователей ,а значит и призвать к ответственности за свои ошибки(преднамеренные или ненамеренные) оные не могут.<br>
		Поэтому Администрация данного сайта просит Вас относиться к любым действиям с особой внимательностью, дабы избежать курьёзных ситуаций.
	</p>
</section>

<?php //get_footer(); ?>
<?php require_once 'footer.php'; ?>