<?php
/**
 * Главная страница.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>

<section class="hero">
	<div class="container hero__in">
		<div class="hero__copy">
			<?php echo exprinto_eyebrow( 'собственное производство · Беларусь' ); // phpcs:ignore ?>
			<h1 class="hero__title">Адресные таблички на&nbsp;дом <span>с&nbsp;доставкой по&nbsp;всей Беларуси</span></h1>
			<p class="hero__lead">Изготовим табличку с&nbsp;вашим адресом за&nbsp;1–3&nbsp;дня: объёмные буквы из&nbsp;зеркального акрила или УФ-печать, которая не&nbsp;выгорает. Основа — алюминиевый композит, крепёж в&nbsp;комплекте. Макет — бесплатно, оплата — при получении.</p>
			<div class="hero__actions">
				<a class="btn btn--accent btn--lg" href="#konstruktor">Собрать свою табличку <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></a>
				<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( $shop_url ); ?>">Смотреть каталог</a>
			</div>
			<ul class="hero__facts">
				<li><b>от 37,75</b><span>руб. за табличку</span></li>
				<li><b>1–2 дня</b><span>изготовление</span></li>
				<li><b>3 года</b><span>гарантия на печать</span></li>
			</ul>
		</div>
		<div class="hero__visual" aria-hidden="true">
			<div class="wall wall--hero">
				<div class="plate-preview plate-preview--hero" data-plate-demo></div>
				<div class="hero__lamp"></div>
			</div>
			<div class="hero__badge">
				<span class="hero__badge-top">Готово</span>
				<span class="hero__badge-main">за 24 часа</span>
				<span class="hero__badge-sub">для заказов по Минску</span>
			</div>
		</div>
	</div>
</section>

<section class="trust" aria-label="Почему нам доверяют">
	<div class="container trust__in">
		<div class="trust__item"><?php echo exprinto_icon( 'factory' ); // phpcs:ignore ?><p><b>Своё производство</b><span>без посредников и наценок</span></p></div>
		<div class="trust__item"><?php echo exprinto_icon( 'sun' ); // phpcs:ignore ?><p><b>УФ-печать</b><span>не выгорает на солнце</span></p></div>
		<div class="trust__item"><?php echo exprinto_icon( 'palette' ); // phpcs:ignore ?><p><b>12 цветов</b><span>и любые размеры под заказ</span></p></div>
		<div class="trust__item"><?php echo exprinto_icon( 'truck' ); // phpcs:ignore ?><p><b>Вся Беларусь</b><span>Европочта, Белпочта, курьер</span></p></div>
	</div>
</section>

<?php get_template_part( 'template-parts/constructor' ); ?>

<section class="section section--paper" aria-labelledby="cat-title">
	<div class="container">
		<header class="section__head section__head--row">
			<div>
				<?php echo exprinto_eyebrow( 'каталог' ); // phpcs:ignore ?>
				<h2 id="cat-title">Популярные таблички</h2>
			</div>
			<a class="link-arrow" href="<?php echo esc_url( $shop_url ); ?>">Весь каталог <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></a>
		</header>
		<?php
		if ( taxonomy_exists( 'product_cat' ) ) {
			$cats = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'exclude' => array( (int) get_option( 'default_product_cat' ) ) ) );
			if ( $cats && ! is_wp_error( $cats ) ) {
				echo '<ul class="cat-tiles">';
				foreach ( $cats as $c ) {
					$thumb = get_term_meta( $c->term_id, 'thumbnail_id', true );
					printf(
						'<li><a class="cat-tile" href="%s">%s<span class="cat-tile__name">%s</span><span class="cat-tile__count">%s</span></a></li>',
						esc_url( get_term_link( $c ) ),
						$thumb ? wp_get_attachment_image( $thumb, 'woocommerce_thumbnail', false, array( 'class' => 'cat-tile__img', 'loading' => 'lazy' ) ) : '',
						esc_html( $c->name ),
						esc_html( exprinto_plural( $c->count, 'модель', 'модели', 'моделей' ) )
					);
				}
				echo '</ul>';
			}
		}
		echo do_shortcode( '[products limit="6" columns="3" orderby="menu_order" order="ASC" visibility="featured"]' );
		?>
	</div>
</section>

<section class="section" aria-labelledby="why-title">
	<div class="container">
		<header class="section__head">
			<?php echo exprinto_eyebrow( 'почему мы' ); // phpcs:ignore ?>
			<h2 id="why-title">Табличка, которая переживёт фасад</h2>
			<p class="section__lead">Адресная табличка висит на улице круглый год: солнце, мороз до −30°, дождь и снег. Поэтому мы не экономим на материалах и печати.</p>
		</header>
		<div class="features">
			<article class="feature">
				<?php echo exprinto_icon( 'sun', 28 ); // phpcs:ignore ?>
				<h3>Не выгорает 10+ лет</h3>
				<p>Печатаем УФ-отверждаемыми чернилами промышленного класса. Краска полимеризуется прямо на материале и не боится ультрафиолета.</p>
			</article>
			<article class="feature">
				<?php echo exprinto_icon( 'layers', 28 ); // phpcs:ignore ?>
				<h3>Жёсткая основа</h3>
				<p>Алюминиевый композит 3 мм: два листа алюминия с наполнителем. Не гнётся, не ржавеет и не боится мороза.</p>
			</article>
			<article class="feature">
				<?php echo exprinto_icon( 'pen', 28 ); // phpcs:ignore ?>
				<h3>Бесплатный макет</h3>
				<p>Дизайнер проверит написание адреса, выровняет текст и пришлёт макет на согласование. Правки — сколько нужно.</p>
			</article>
			<article class="feature">
				<?php echo exprinto_icon( 'ruler', 28 ); // phpcs:ignore ?>
				<h3>Читается с дороги</h3>
				<p>Крупный контрастный номер и строгий шрифт: адрес видно курьеру, такси и скорой с 25–30 метров.</p>
			</article>
			<article class="feature">
				<?php echo exprinto_icon( 'screw', 28 ); // phpcs:ignore ?>
				<h3>Готова к монтажу</h3>
				<p>Отверстия уже просверлены, саморезы и дюбели — в комплекте. Повесить табличку можно за 10 минут.</p>
			</article>
			<article class="feature">
				<?php echo exprinto_icon( 'card', 28 ); // phpcs:ignore ?>
				<h3>Оплата при получении</h3>
				<p>Наличными или картой на почте, через ЕРИП или по счёту для организаций. Никаких предоплат для частных клиентов.</p>
			</article>
		</div>
	</div>
</section>

<section class="section section--ink" aria-labelledby="steps-title">
	<div class="container">
		<header class="section__head">
			<?php echo exprinto_eyebrow( 'как заказать' ); // phpcs:ignore ?>
			<h2 id="steps-title">От заявки до таблички на фасаде — 4 шага</h2>
		</header>
		<ol class="steps">
			<li class="step"><span class="step__n">01</span><h3>Выберите табличку</h3><p>В конструкторе или каталоге: формат, цвет, ваш адрес.</p></li>
			<li class="step"><span class="step__n">02</span><h3>Согласуйте макет</h3><p>В течение часа пришлём макет в Viber, Telegram или на e-mail.</p></li>
			<li class="step"><span class="step__n">03</span><h3>Мы изготовим</h3><p>Печать и резка на своём оборудовании — 1–2 рабочих дня.</p></li>
			<li class="step"><span class="step__n">04</span><h3>Получите и оплатите</h3><p>Курьером, в Европочте или Белпочте — в любой точке Беларуси.</p></li>
		</ol>
	</div>
</section>

<section class="section" aria-labelledby="mat-title">
	<div class="container">
		<header class="section__head">
			<?php echo exprinto_eyebrow( 'технологии' ); // phpcs:ignore ?>
			<h2 id="mat-title">Объёмные буквы или УФ-печать?</h2>
			<p class="section__lead">Обе технологии рассчитаны на улицу и годы службы. Разница — во внешнем виде и бюджете.</p>
		</header>
		<div class="compare">
			<article class="compare__card">
				<h3>УФ-печать на композите</h3>
				<p class="compare__price">от 117,16 руб.</p>
				<ul class="ticks">
					<li>Изображение не выгорает и не смывается</li>
					<li>Прямоугольные и фигурные формы, 12 цветов</li>
					<li>Изготовление за 1–2 дня</li>
					<li>Номерной знак из пластика — от 37,75 руб.</li>
				</ul>
			</article>
			<article class="compare__card compare__card--pro">
				<span class="badge">Выбор для красивого фасада</span>
				<h3>Объёмные буквы из зеркального акрила</h3>
				<p class="compare__price">от 156,92 руб.</p>
				<ul class="ticks">
					<li>Буквы зеркального серебра или золота с тенью</li>
					<li>Отражают свет фар — адрес видно ночью</li>
					<li>Основа из алюминиевого композита любого цвета</li>
					<li>Фигурные формы: «Волна», «Купол», «Герб»</li>
				</ul>
			</article>
		</div>
	</div>
</section>

<section class="section section--paper" aria-labelledby="geo-title">
	<div class="container geo">
		<div class="geo__copy">
			<?php echo exprinto_eyebrow( 'доставка' ); // phpcs:ignore ?>
			<h2 id="geo-title">Доставляем в любой город и деревню Беларуси</h2>
			<p>Отправляем заказы ежедневно. Табличку упаковываем в защитную плёнку и жёсткий картон — она приедет без единой царапины.</p>
			<a class="link-arrow" href="<?php echo esc_url( home_url( '/dostavka-i-oplata/' ) ); ?>">Условия доставки и оплаты <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></a>
		</div>
		<ul class="geo__list">
			<li><b>Минск</b><span>курьер в день готовности</span></li>
			<li><b>Брест</b><span>1–2 дня</span></li>
			<li><b>Гродно</b><span>1–2 дня</span></li>
			<li><b>Гомель</b><span>1–2 дня</span></li>
			<li><b>Могилёв</b><span>1–2 дня</span></li>
			<li><b>Витебск</b><span>1–2 дня</span></li>
			<li><b>Районы и деревни</b><span>2–4 дня, Белпочта</span></li>
			<li><b>Бесплатно</b><span>при заказе от 100 руб.</span></li>
		</ul>
	</div>
</section>

<section class="section b2b" aria-labelledby="b2b-title">
	<div class="container b2b__in">
		<div class="b2b__copy">
			<?php echo exprinto_eyebrow( 'для организаций' ); // phpcs:ignore ?>
			<h2 id="b2b-title">Таблички партиями — для ЖЭС, застройщиков и садовых товариществ</h2>
			<p>Изготавливаем указатели улиц, таблички на подъезды, номера квартир, навигацию для коттеджных посёлков и СТ. Работаем по договору, с безналичной оплатой и полным пакетом документов.</p>
			<ul class="ticks">
				<li>Скидки от 10 штук — до 25%</li>
				<li>Изготовление по вашему ТЗ или образцу</li>
				<li>Расчёт стоимости — за 30 минут</li>
			</ul>
		</div>
		<div class="b2b__form card-plate">
			<p class="b2b__form-title">Рассчитать заказ</p>
			<?php exprinto_lead_form( 'Главная: оптовый расчёт' ); ?>
		</div>
	</div>
</section>

<section class="section" aria-labelledby="faq-title">
	<div class="container container--narrow">
		<header class="section__head">
			<?php echo exprinto_eyebrow( 'вопросы и ответы' ); // phpcs:ignore ?>
			<h2 id="faq-title">Частые вопросы</h2>
		</header>
		<?php exprinto_faq(); ?>
	</div>
</section>

<?php
while ( have_posts() ) :
	the_post();
	if ( trim( get_the_content() ) ) :
		?>
		<section class="section section--paper seo-block" aria-label="О магазине">
			<div class="container container--narrow prose">
				<?php the_content(); ?>
			</div>
		</section>
		<?php
	endif;
endwhile;

get_footer();
