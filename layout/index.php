<?php //get_header(); ?>
<?php
define('PAGE', 'index');
require_once 'header.php';
?>
	<section class="index-calculator-block">
		
		<div class="index-calculator-block__container container">
			<div class="index-calculator-block__header-block">
				<div class="index-calculator-block__header">
					<h1>Мультивалютный обменый сервис</h1>
				</div>
				<div class="index-calculator-block__description">
					Быстрый, защищенный&nbsp;и анонимный
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
							<div class="calculator-form__result">Вы заплатите: <span class="color--yellow">0&nbsp;₽</span></div>
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
									<td>1308953.47&nbsp;₽</td>
									<td>1186621.37&nbsp;₽</td>
								</tr>
								<tr>
									<td>Ethereum</td>
									<td>66768.66&nbsp;₽</td>
									<td>66768.66&nbsp;₽</td>
								</tr>
								<tr>
									<td>Tether (USDT)</td>
									<td>67.9302&nbsp;₽</td>
									<td>62.1242&nbsp;₽</td>
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
					<h2 class="index-o-block__data-block__header">Совершайте обмен криптовалют в&nbsp;Телеграм</h2>
					<div class="index-o-block__data-block__description">
						<p>Добавьте в&nbsp;месенджер нашего бота&nbsp;и совершайте обмен совершенно анонимно.</p>
						<p>Наш&nbsp;бот работает быстро, качественно&nbsp;и надежно. Он поможет вам без&nbsp;лишних вопросов совершить обмен.</p>
					</div>
					<a class="index-o-block__data-block__btn btn btn-green" href="javascript:void(0)">К&nbsp;боту</a>
				</div>
				<div class="index-o-block__phone-block">
					<div class="index-o-block__phone-block__shadow"></div>
					<div class="index-o-block__phone-block__background"></div>
				</div>
			</div>
		</div>
		<div class="index-o-block__tor"></div>
		<div class="index-o-block__shadow"></div>
	</section>
	<section class="index-about-block container">
		<div class="index-about-block__atlant-img">
			<img src="/assets/atlant.png" alt="Маскот">
		</div>
		<div class="index-about-block__data-block">
			<h2>О&nbsp;сервисе</h2>
			<p>
				ATLANT-CHANGE это быстрый&nbsp;и анонимный сервис обмена криптовалют!
				Наша команда поможет&nbsp;вам качествено&nbsp;и выгодно совершить сделку по&nbsp;обмену криптовалюты.
				Мы обеспечиваем быстрые обмены, поразительный уровень работы техподдержки&nbsp;и практически полное отсутствие технических проблем.
				Среднее время обработки одной заявки 15&nbsp;минут.
			</p>
		</div>
	</section>
	<section class="index-how-work-block container">
		<h2>Как это работает</h2>
		<div class="index-how-work-block__steps-block">
			<div class="index-how-work-block__step__number">
				<svg class="index-how-work-block__step__digit">
					<use xlink:href="#one"></use>
				</svg>
				<svg class="index-how-work-block__step__icon">
					<use xlink:href="#server"></use>
				</svg>
			</div>
			<div class="index-how-work-block__step__text h5">Вы создаете заявку на&nbsp;обмен</div>
			<div class="index-how-work-block__step__arrow"></div>

			<div class="index-how-work-block__step__number">
				<svg class="index-how-work-block__step__digit">
					<use xlink:href="#two"></use>
				</svg>
				<svg class="index-how-work-block__step__icon">
					<use xlink:href="#headphones"></use>
				</svg>
			</div>
			<div class="index-how-work-block__step__text h5">Мы обрабатываем данные</div>
			<div class="index-how-work-block__step__arrow"></div>

			<div class="index-how-work-block__step__number">
				<svg class="index-how-work-block__step__digit">
					<use xlink:href="#three"></use>
				</svg>
				<svg class="index-how-work-block__step__icon">
					<use xlink:href="#repeat"></use>
				</svg>
			</div>
			<div class="index-how-work-block__step__text h5">Оператор переводит Вам кэш</div>
		</div>
	</section>
	<section class="index-feedback-block container">
		<h2>Отзывы о&nbsp;нас</h2>
		<div class="index-feedback-block__links-block">
			<a class="link" href="javascript:void(0)">Оставить отзыв</a>
			<a class="link" href="javascript:void(0)">Смотреть все</a>
		</div>
		<div class="feedback-slider">
			<button class="btn-empty feedback-slider__button feedback-slider__left-arrow icon icon-left-arrow"></button>
			<div class="feedback-slider__content index-feedback-block__feedback-container">
				<div class="feedback-card">
					<div class="feedback-card__content">
						<div class="feedback-card__header">
							<span>Кобеза Дмитрий</span>
							<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
						</div>
						<div class="feedback-card__description">
							Психологический клуб "Интерес к жизни" выражает благодарность Комитету социальной защиты, Директору МКУ СРЦН "Уютный дом" Левушкиной Катерине Владимировне, психологу ОППП Калабиной Марии Александровне и все психологам отеделения, которые принимали участие в работе и жизни клуба за предоставленную возможность в течении многих лет получать знания и психологическую помощь.
						</div>
					</div>
					<div class="feedback-card__date">08.06.22</div>
				</div>
				<div class="feedback-card">
					<div class="feedback-card__content">
						<div class="feedback-card__header">
							<span>Галина Семушина</span>
							<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
						</div>
						<div class="feedback-card__description">
							Спасибо за первоклассную работу. Необходимо было поставить оборудование на 18 автомобилей с отслеживанием всех показателей. Сотрудники Геоокей полностью рассказали про всю работу устройств и про саму систему онлайн-мониторинга. За систему отдельное спасибо. Пользуемся месяц. По сравнению с предыдущей намного проще и удобней. Теперь будем переводить весь парк на систему от Геоокей.
						</div>
					</div>
					<div class="feedback-card__date">08.06.22</div>
				</div>
				<div class="feedback-card">
					<div class="feedback-card__content">
						<div class="feedback-card__header">
							<span>Галина Семушина</span>
							<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
						</div>
						<div class="feedback-card__description">
							Спасибо за первоклассную работу. Необходимо было поставить оборудование на 18 автомобилей с отслеживанием всех показателей. Сотрудники Геоокей полностью рассказали про всю работу устройств и про саму систему онлайн-мониторинга. За систему отдельное спасибо. Пользуемся месяц. По сравнению с предыдущей намного проще и удобней. Теперь будем переводить весь парк на систему от Геоокей.
						</div>
					</div>
					<div class="feedback-card__date">08.06.22</div>
				</div>
				<div class="feedback-card">
					<div class="feedback-card__content">
						<div class="feedback-card__header">
							<span>Кобеза Дмитрий</span>
							<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
						</div>
						<div class="feedback-card__description">
							Психологический клуб "Интерес к жизни" выражает благодарность Комитету социальной защиты, Директору МКУ СРЦН "Уютный дом" Левушкиной Катерине Владимировне, психологу ОППП Калабиной Марии Александровне и все психологам отеделения, которые принимали участие в работе и жизни клуба за предоставленную возможность в течении многих лет получать знания и психологическую помощь.
						</div>
					</div>
					<div class="feedback-card__date">08.06.22</div>
				</div>
			</div>
			<button class="btn-empty feedback-slider__button feedback-slider__right-arrow icon icon-right-arrow"></button>
		</div>
	</section>
	<section class="index-news-block">
		
		<svg class="index-news-block__wave" viewBox="0 0 1920 240" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path class="wave" d="M1920,38c-183,21-550,56-960,1C783.221,15.286,522-17,0,39v180h1920V38z"/>
		</svg>
		
		<div class="index-news-block__container container">
			<h2 class="index-news-block__header">Новости</h2>
			
			<div class="index-news-block__news-block">

				<div class="news-card news-card--right">
					<div class="news-card__data-block">
						<div class="news-card__data">
							<div class="news-card__header"><a href="javascript:void(0)">В США криптовалюту хотят приравнять к инвестиционным активам</a></div>
							<div class="news-card__description">
								Сейчас Комиссия по ценным бумагам США проверяет криптобиржу Binance на возможные нарушения торговли ее собственной цифровой монетой, токеном BNB, в 2017 году. Регулятор полагает, что инвесторы приобретали токен BNB для финансирования компании и получения прибыли от вложений
							</div>
						</div>
						<div class="news-card__links">
							<div class="news-card__date">16 мар. 2022 г.</div>
							<div class="news-card__link">
								<a href="javascript:void(0)" class="link">Подробнее</a>
							</div>
						</div>
					</div>
					<div class="news-card__img-block">
						<img src="/assets/news_1.jpg" alt="Новость 1" class="news-card__img">
					</div>
				</div>
				
				<div class="news-card">
					<div class="news-card__data-block">
						<div class="news-card__data">
							<div class="news-card__header"><a href="javascript:void(0)">Легализация криптовалют в Украине</a></div>
							<div class="news-card__description">
								Президент страны подписал закон «О виртуальных активах». Теперь на Украине смогут зарегистрироваться криптобиржи, а банки начнут открывать счета для компаний, ориентированных на сферу криптовалют.
							</div>
						</div>
						<div class="news-card__links">
							<div class="news-card__date">25 апр. 2022 г.</div>
							<div class="news-card__link">
								<a href="javascript:void(0)" class="link">Подробнее</a>
							</div>
						</div>
					</div>
					<div class="news-card__img-block">
						<img src="/assets/news_2.jpg" alt="Новость 2" class="news-card__img">
					</div>
				</div>
			</div>
			<div class="index-news-block__pagination">
				<button class="index-news-block__pagination__page-btn btn-empty active">1</button>
				<button class="index-news-block__pagination__page-btn btn-empty">2</button>
				<button class="index-news-block__pagination__page-btn btn-empty">3</button>
			</div>
		</div>
		
	</section>
	<section class="index-support-block container">
		<div class="index-support-block__data-block">
			<h2 class="index-support-block__header">Техническая поддержка</h2>
			<div class="index-support-block__description">
				<p>Если у Вас возникли вопросы касательно нашей работы, воспользуйтесь чатом с нашим специалистом, он обязательно  даст разъяснение по любому возникшему вопросу.</p>
				<p>Профессионализм наших сотрудников, комплексный подход к решению поставленных задач и открытость для нестандартных решений помогают  качественно и развернуто давать ответы и комментарии на любые возникающие вопросы даже самым требовательным клиентам. Надеемся, что наше сотрудничество будет продуктивным. Всегда готовы помочь Вам.</p>
			</div>
			<a href="javascript:void(0)" class="btn btn-submit">В чат</a>
		</div>
		<div class="index-support-block__figures-block">
			<div class="index-support-block__figures-container">
				<svg viewBox="0 0 253 253" fill="none" class="index-support-block__figure-tor" xmlns="http://www.w3.org/2000/svg">
					<circle class="figure-shadow" cx="122.5" cy="122.5" r="97.5" stroke-width="50"/>
				</svg>
	
				<svg viewBox="0 0 221 192" fill="none" class="index-support-block__figure-triangle" xmlns="http://www.w3.org/2000/svg">
					<path class="figure-shadow" d="M106.5 0L212.588 183.75H0.411888L106.5 0Z"/>
				</svg>
	
				<svg viewBox="0 0 350 350" fill="none" class="index-support-block__figure-message" xmlns="http://www.w3.org/2000/svg">
					<path d="M349 233C349 243.255 344.926 253.09 337.675 260.341C330.423 267.593 320.588 271.667 310.333 271.667H78.3333L1 349V39.6667C1 29.4116 5.0738 19.5766 12.3252 12.3252C19.5766 5.0738 29.4116 1 39.6667 1H310.333C320.588 1 330.423 5.0738 337.675 12.3252C344.926 19.5766 349 29.4116 349 39.6667V233Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
		</div>
	</section>
	<section class="index-ad-block container">
		<div class="index-ad-block__ad"></div>
	</section>
<?php //get_footer(); ?>
<?php require_once 'footer.php'; ?>