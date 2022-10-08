<?php //get_header(); ?>
<?php require_once 'header.php'; ?>
	<section class="index-calculator-block">
		
		<div class="index-calculator-block__container container">
			<div class="index-calculator-block__header-block">
				<div class="index-calculator-block__header">
					<h1>Мультивалютный обменый сервис</h1>
				</div>
				<div class="index-calculator-block__description">
					Быстрый, защищенный и анонимный
				</div>
			</div>
			<div class="index-calculator-block__wrap">

				<svg class="index-calculator-block__figure-triangle" viewBox="0 0 221 192" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="figure" d="M106.5 0L212.588 183.75H0.411888L106.5 0Z"/>
				</svg>

				<svg class="index-calculator-block__figure-tor" viewBox="0 0 390 390" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="figure" d="M346 190.933C346 276.488 276.616 345.865 191 345.865C105.384 345.865 36 276.488 36 190.933C36 105.378 105.384 36 191 36C276.616 36 346 105.378 346 190.933Z" stroke-width="72"/>
				</svg>
				
				<div class="index-calculator-block__calcultor-block">
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
							<div class="calculator-form__result">Вы заплатите: <span class="color--yellow">0 ₽</span></div>
							<input type="submit" name="currency-exchange" value="Обменять" class="btn btn-submit">
						</div>
					</form>
					<div class="index-calculator-block__table-block">
						<table>
							<thead>
								<tr>
									<th>Валюта</th>
									<th>Покупка</th>
									<th>Продажа</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Bitcoin</td>
									<td>1308953.47 ₽</td>
									<td>1186621.37 ₽</td>
								</tr>
								<tr>
									<td>Ethereum</td>
									<td>66768.66 ₽</td>
									<td>66768.66 ₽</td>
								</tr>
								<tr>
									<td>Tether (USDT)</td>
									<td>67.9302 ₽</td>
									<td>62.1242 ₽</td>
								</tr>
							</tbody>
						</table>
						<div class="index-calculator-block__table-addition">Обновлено 08.02.22</div>
					</div>
				</div>
			</div>
			
		</div>
		
		
		<svg class="index-calculator-block__wave" viewBox="0 0 1920 266" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path class="wave" fill-rule="evenodd" clip-rule="evenodd" d="M1920 179.803L1840 203.68C1760 227.558 1600 275.313 1440 263.375C1280 251.436 1120 179.803 960 173.833C800 167.864 640 227.558 480 251.436C320 275.313 160 263.375 80.0005 257.405L0.000488281 251.436V0.720215H80.0005C160 0.720215 320 0.720215 480 0.720215C640 0.720215 800 0.720215 960 0.720215C1120 0.720215 1280 0.720215 1440 0.720215C1600 0.720215 1760 0.720215 1840 0.720215H1920V179.803Z"/>
		</svg>
		<svg class="index-calculator-block__wave-shadow" viewBox="0 20 1920 370" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M0 345.617L80 354.607C160 364.596 320 383.575 480 354.607C640 325.639 800 249.723 960 239.734C1120 229.745 1280 287.681 1440 287.681C1600 287.681 1760 229.745 1840 201.776L1920 172.808V0H1840C1760 0 1600 0 1440 0C1280 0 1120 0 960 0C800 0 640 0 480 0C320 0 160 0 80 0H0V345.617Z" fill="#767676" fill-opacity="0.6"/>
		</svg>

	</section>
	<section class="index-o-block">
		<div class="container">
			<div class="index-o-block__container">
				<div class="index-o-block__data-block">
					<h2 class="index-o-block__data-block__header">Совершайте обмен  криптовалют в Телеграм</h2>
					<div class="index-o-block__data-block__description">
						<p>Добавьте в месенджер нашего бота и  совершайте обмен совершенно анонимно.</p>
						<p>Наш бот работает быстро, качественно и надежно. Он поможет вам без лишних вопросов совершить обмен.</p>
					</div>
					<a class="btn btn-green" href="javascript:void(0)">К боту</a>
				</div>
				<div class="index-o-block__phone-block">
					<div class="index-o-block__phone-block__shadow"></div>
					<div class="index-o-block__phone-block__background"></div>
				</div>
			</div>
		</div>
		
		<div class="index-o-block__tor"></div>
	</section>
	<section style="height:800px;background-color:red;"></section>
<?php //get_footer(); ?>
<?php require_once 'footer.php'; ?>