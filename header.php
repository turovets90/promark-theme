<?php
/**
 * Шапка сайта.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
$phone = exprinto_opt( 'phone' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo esc_url( EXPRINTO_URI . '/assets/img/favicon.svg' ); ?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?php echo esc_url( EXPRINTO_URI . '/assets/img/apple-touch-icon.png' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Перейти к содержимому</a>

<div class="topbar">
	<div class="container topbar__in">
		<p class="topbar__msg"><?php echo exprinto_icon( 'truck', 16 ); // phpcs:ignore ?> Доставка по всей Беларуси · бесплатно от 100 руб.</p>
		<ul class="topbar__links">
			<li><?php echo exprinto_icon( 'clock', 16 ); // phpcs:ignore ?> <?php echo esc_html( exprinto_opt( 'hours' ) ); ?></li>
			<li><a href="mailto:<?php echo esc_attr( exprinto_opt( 'email' ) ); ?>"><?php echo exprinto_icon( 'mail', 16 ); // phpcs:ignore ?> <?php echo esc_html( exprinto_opt( 'email' ) ); ?></a></li>
			<li><a href="<?php echo esc_url( exprinto_opt( 'telegram' ) ); ?>" rel="nofollow noopener" target="_blank"><?php echo exprinto_icon( 'telegram', 16 ); // phpcs:ignore ?> Telegram</a></li>
			<li><a href="<?php echo esc_url( exprinto_opt( 'viber' ), array( 'viber', 'http', 'https' ) ); ?>" rel="nofollow"><?php echo exprinto_icon( 'viber', 16 ); // phpcs:ignore ?> Viber</a></li>
		</ul>
	</div>
</div>

<header class="site-header" id="top">
	<div class="container site-header__in">
		<?php exprinto_logo(); ?>

		<nav class="nav" id="site-nav" aria-label="Главное меню">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'menu',
				'fallback_cb'    => 'exprinto_menu_fallback',
				'depth'          => 2,
			) );
			?>
			<a class="nav__phone" href="<?php echo esc_attr( exprinto_tel( $phone ) ); ?>"><?php echo exprinto_icon( 'phone', 18 ); // phpcs:ignore ?> <?php echo esc_html( $phone ); ?></a>
			<a class="nav__phone nav__mail" href="mailto:<?php echo esc_attr( exprinto_opt( 'email' ) ); ?>"><?php echo exprinto_icon( 'mail', 18 ); // phpcs:ignore ?> <?php echo esc_html( exprinto_opt( 'email' ) ); ?></a>
		</nav>

		<div class="site-header__actions">
			<a class="header-phone" href="<?php echo esc_attr( exprinto_tel( $phone ) ); ?>">
				<span class="header-phone__num"><?php echo esc_html( $phone ); ?></span>
				<span class="header-phone__hint">Перезвоним за 15 минут</span>
			</a>
			<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
				<a class="cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="Корзина">
					<?php echo exprinto_icon( 'cart', 24 ); // phpcs:ignore ?>
					<?php echo exprinto_cart_count_html(); // phpcs:ignore ?>
				</a>
			<?php endif; ?>
			<button class="burger" type="button" aria-controls="site-nav" aria-expanded="false" aria-label="Открыть меню">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>

<main id="main" class="site-main">
