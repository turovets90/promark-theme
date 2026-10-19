<?php
/**
 * Подвал сайта.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
$phone  = exprinto_opt( 'phone' );
$phone2 = exprinto_opt( 'phone2' );
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="site-footer__cta">
			<div>
				<p class="site-footer__cta-title">Нужна табличка уже завтра?</p>
				<p>Позвоните или напишите — согласуем макет за 15 минут и отправим в работу сегодня.</p>
			</div>
			<div class="site-footer__cta-actions">
				<a class="btn btn--accent btn--lg" href="<?php echo esc_attr( exprinto_tel( $phone ) ); ?>"><?php echo exprinto_icon( 'phone', 18 ); // phpcs:ignore ?> <?php echo esc_html( $phone ); ?></a>
				<a class="btn btn--light btn--lg" href="<?php echo esc_url( exprinto_opt( 'telegram' ) ); ?>" rel="nofollow noopener" target="_blank"><?php echo exprinto_icon( 'telegram', 18 ); // phpcs:ignore ?> Написать в Telegram</a>
			</div>
		</div>

		<div class="site-footer__grid">
			<div class="site-footer__about">
				<?php exprinto_logo(); ?>
				<p>Собственное производство адресных табличек, номерных знаков и указателей. Объёмные буквы из зеркального акрила и УФ-печать на алюминиевом композите, доставка по всей Беларуси.</p>
				<ul class="social">
					<li><a href="<?php echo esc_url( exprinto_opt( 'telegram' ) ); ?>" rel="nofollow noopener" target="_blank" aria-label="Telegram"><?php echo exprinto_icon( 'telegram', 20 ); // phpcs:ignore ?></a></li>
					<li><a href="<?php echo esc_url( exprinto_opt( 'viber' ), array( 'viber', 'http', 'https' ) ); ?>" rel="nofollow" aria-label="Viber"><?php echo exprinto_icon( 'viber', 20 ); // phpcs:ignore ?></a></li>
					<li><a href="<?php echo esc_url( exprinto_opt( 'instagram' ) ); ?>" rel="nofollow noopener" target="_blank" aria-label="Instagram"><?php echo exprinto_icon( 'insta', 20 ); // phpcs:ignore ?></a></li>
				</ul>
			</div>

			<nav class="site-footer__col" aria-label="Каталог">
				<p class="site-footer__title">Каталог</p>
				<?php
				if ( has_nav_menu( 'catalog' ) ) {
					wp_nav_menu( array( 'theme_location' => 'catalog', 'container' => false, 'depth' => 1 ) );
				} elseif ( taxonomy_exists( 'product_cat' ) ) {
					echo '<ul>';
					foreach ( get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'exclude' => array( (int) get_option( 'default_product_cat' ) ) ) ) as $t ) {
						printf( '<li><a href="%s">%s</a></li>', esc_url( get_term_link( $t ) ), esc_html( $t->name ) );
					}
					echo '</ul>';
				}
				?>
			</nav>

			<nav class="site-footer__col" aria-label="Покупателям">
				<p class="site-footer__title">Покупателям</p>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'depth' => 1, 'fallback_cb' => 'exprinto_menu_fallback' ) ); ?>
			</nav>

			<div class="site-footer__col site-footer__contacts">
				<p class="site-footer__title">Контакты</p>
				<ul>
					<li><?php echo exprinto_icon( 'phone', 18 ); // phpcs:ignore ?><a href="<?php echo esc_attr( exprinto_tel( $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php if ( $phone2 ) : ?>
						<li><?php echo exprinto_icon( 'phone', 18 ); // phpcs:ignore ?><a href="<?php echo esc_attr( exprinto_tel( $phone2 ) ); ?>"><?php echo esc_html( $phone2 ); ?></a></li>
					<?php endif; ?>
					<li><?php echo exprinto_icon( 'mail', 18 ); // phpcs:ignore ?><a href="mailto:<?php echo esc_attr( exprinto_opt( 'email' ) ); ?>"><?php echo esc_html( exprinto_opt( 'email' ) ); ?></a></li>
					<li><?php echo exprinto_icon( 'pin', 18 ); // phpcs:ignore ?><span><?php echo esc_html( exprinto_opt( 'address' ) ); ?></span></li>
					<li><?php echo exprinto_icon( 'clock', 18 ); // phpcs:ignore ?><span><?php echo esc_html( exprinto_opt( 'hours' ) ); ?></span></li>
				</ul>
			</div>
		</div>

		<div class="site-footer__bottom">
			<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — адресные таблички с доставкой по Беларуси.</p>
			<p class="site-footer__legal"><?php echo esc_html( exprinto_opt( 'legal' ) ); ?></p>
			<p class="pay-methods" aria-label="Способы оплаты"><span>Наличные</span><span>Карта</span><span>ЕРИП</span><span>Безнал для юрлиц</span></p>
		</div>
	</div>
</footer>

<a class="float-call" href="<?php echo esc_attr( exprinto_tel( $phone ) ); ?>" aria-label="Позвонить"><?php echo exprinto_icon( 'phone', 24 ); // phpcs:ignore ?></a>

<?php wp_footer(); ?>
</body>
</html>
