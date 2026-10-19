<?php
/**
 * Страница «Контакты».
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
$phone = exprinto_opt( 'phone' );
while ( have_posts() ) :
	the_post();
	?>
	<div class="page-head page-head--compact">
		<div class="container">
			<?php exprinto_breadcrumbs(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="container contacts">
		<div class="contacts__info">
			<div class="prose"><?php the_content(); ?></div>
			<ul class="contact-cards">
				<li class="card-plate"><?php echo exprinto_icon( 'phone' ); // phpcs:ignore ?><span>Телефон</span><a href="<?php echo esc_attr( exprinto_tel( $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a><?php if ( exprinto_opt( 'phone2' ) ) : ?><a href="<?php echo esc_attr( exprinto_tel( exprinto_opt( 'phone2' ) ) ); ?>"><?php echo esc_html( exprinto_opt( 'phone2' ) ); ?></a><?php endif; ?></li>
				<li class="card-plate"><?php echo exprinto_icon( 'mail' ); // phpcs:ignore ?><span>E-mail</span><a href="mailto:<?php echo esc_attr( exprinto_opt( 'email' ) ); ?>"><?php echo esc_html( exprinto_opt( 'email' ) ); ?></a></li>
<?php if ( exprinto_opt( 'address' ) ) : ?>
				<li class="card-plate"><?php echo exprinto_icon( 'pin' ); // phpcs:ignore ?><span>Адрес производства</span><b><?php echo esc_html( exprinto_opt( 'address' ) ); ?></b></li>
<?php endif; ?>
				<li class="card-plate"><?php echo exprinto_icon( 'clock' ); // phpcs:ignore ?><span>Режим работы</span><b><?php echo esc_html( exprinto_opt( 'hours' ) ); ?></b></li>
			</ul>
			<p class="contacts__legal"><?php echo esc_html( exprinto_opt( 'legal' ) ); ?></p>
		</div>
		<aside class="contacts__form card-plate">
			<p class="b2b__form-title">Напишите нам</p>
			<p>Оставьте телефон — перезвоним, ответим на вопросы и посчитаем заказ.</p>
			<?php exprinto_lead_form( 'Страница контактов' ); ?>
		</aside>
	</div>
	<?php
endwhile;
get_footer();
