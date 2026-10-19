<?php
/**
 * Страница 404.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="section notfound">
	<div class="container notfound__in">
		<div class="wall wall--sm"><div class="plate-preview" data-plate-static='{"layout":"line","w":900,"h":270,"scheme":"yellow-black","type":"ошибка","street":"Не найдено","number":"404"}'></div></div>
		<h1 class="page-title">Такого адреса у нас нет</h1>
		<p>Страница переехала или никогда не существовала. Зато табличку с правильным адресом мы сделаем за 1–2 дня.</p>
		<p class="notfound__actions">
			<a class="btn btn--accent btn--lg" href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a>
			<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>">В каталог</a>
		</p>
	</div>
</section>
<?php
get_footer();
