<?php
/**
 * Призыв к действию внизу информационных страниц.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="section section--tight">
	<div class="container">
		<div class="cta-band">
			<div>
				<p class="cta-band__title">Готовы заказать табличку?</p>
				<p>Соберите её в конструкторе — превью и цена появятся сразу.</p>
			</div>
			<a class="btn btn--accent btn--lg" href="<?php echo esc_url( home_url( '/#konstruktor' ) ); ?>">Открыть конструктор <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></a>
		</div>
	</div>
</section>
