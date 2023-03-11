<?php
if(!defined('ABSPATH')) die();
get_header();
?>
<section class="feedback-reviews-block container">
	<h2>Отзывы</h2>
	<div class="feedback-slider feedback-reviews-block__slider-block">
		<button class="btn-empty feedback-slider__button feedback-slider__left-arrow icon icon-left-arrow"></button>
		<div class="feedback-slider__content feedback-reviews-block__feedback-container">

			<div class="feedback-card">
				<div class="feedback-card__content">
					<div class="feedback-card__header">
						<span>Виктор Миллер</span>
						<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
					</div>
					<div class="feedback-card__description">
						За пару лет обменял более 70.000$ и ни одного минуса. Операторы всегда идут на встречу были промохи с моей стороны но повторюсь операторы и администрация всегда идут на встречу и казалось бы что всё....... А нет всё по красоте! А так держать приятно с вами работать!
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
						<span>Александр</span>
						<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
					</div>
					<div class="feedback-card__description">
						Как обычно, все четко и быстро. Чат реагирует быстро и своевременно.
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

			<div class="feedback-card">
				<div class="feedback-card__content">
					<div class="feedback-card__header">
						<span>Ростик</span>
						<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
					</div>
					<div class="feedback-card__description">
						<p>Спасибо, ребята!</p>
						<p>Я в первый раз и все прошло доступно, мобильно, четко!</p>
						<p>Молодцы!</p>
					</div>
				</div>
				<div class="feedback-card__date">08.06.22</div>
			</div>

			<div class="feedback-card">
				<div class="feedback-card__content">
					<div class="feedback-card__header">
						<span>Алексей</span>
						<span class="feedback-card__rating"><span class="color--yellow">5</span>/5</span>
					</div>
					<div class="feedback-card__description">
						Воспользовался сервисом впервые. Интуитивно понятный интерфейс! Курс не самый выгодный, но вполне устроил. Транзакция прошла очень быстро. Доволен!
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
						Спасибо! Быстро, качественнол!
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
						Хороший обменный пункт. провели сделки очень быстро в оговоренные сроки. Благодарствую. рекомендую другим.
					</div>
				</div>
				<div class="feedback-card__date">08.06.22</div>
			</div>

		</div>
		<button class="btn-empty feedback-slider__button feedback-slider__right-arrow icon icon-right-arrow"></button>
	</div>
	<div class="feedback-reviews-block__pagination">
		<button class="feedback-reviews-block__arrow btn-empty">
			<svg class="feedback-reviews-block__arrow-icon">
				<use xlink:href="#left-arrow"></use>
			</svg>
		</button>
		<button class="btn-empty active">1</button>
		<button class="btn-empty">2</button>
		<button class="btn-empty">3</button>
		<button class="feedback-reviews-block__arrow btn-empty">
			<svg class="feedback-reviews-block__arrow-icon">
				<use xlink:href="#right-arrow"></use>
			</svg>
		</button>
	</div>
</section>
<section class="feedback-review-form container">
	<?= do_shortcode('[atlant-review-form header="Оставить отзыв"]Нажимая кнопку, вы соглашаетесь с<br>правилами обработки персональных данных[/atlant-review-form]') ?>
</section>
<?php
get_footer();
?>