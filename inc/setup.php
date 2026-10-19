<?php
/**
 * Настройка темы, подключение ресурсов, оптимизация.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'exprinto', EXPRINTO_DIR . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 200, 'flex-width' => true, 'flex-height' => true ) );
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 900,
			'product_grid'          => array( 'default_columns' => 3, 'default_rows' => 4, 'min_columns' => 2, 'max_columns' => 4 ),
		) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		register_nav_menus( array(
			'primary' => 'Главное меню',
			'footer'  => 'Меню в подвале',
			'catalog' => 'Каталог в подвале',
		) );
	}
);

/** Шрифты, стили, скрипты. */
add_action(
	'wp_enqueue_scripts',
	function () {
		$ver = EXPRINTO_VERSION . '.' . filemtime( EXPRINTO_DIR . '/style.css' );
		wp_enqueue_style( 'exprinto', get_stylesheet_uri(), array(), $ver );

		wp_register_script( 'exprinto-plate', EXPRINTO_URI . '/assets/js/plate.js', array(), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
		wp_enqueue_script( 'exprinto', EXPRINTO_URI . '/assets/js/theme.js', array( 'exprinto-plate' ), $ver, array( 'strategy' => 'defer', 'in_footer' => true ) );
		wp_localize_script( 'exprinto', 'exprintoData', array(
			'ajax'     => admin_url( 'admin-ajax.php' ),
			'currency' => function_exists( 'get_woocommerce_currency_symbol' ) ? html_entity_decode( get_woocommerce_currency_symbol() ) : 'руб.',
		) );

		// Блочные стили не нужны на страницах без блоков.
		if ( ! is_singular( 'post' ) ) {
			wp_dequeue_style( 'wp-block-library-theme' );
			wp_dequeue_style( 'global-styles' );
			wp_dequeue_style( 'classic-theme-styles' );
		}
	},
	20
);

/** Предзагрузка ключевых шрифтов. */
add_action(
	'wp_head',
	function () {
		$fonts = array( 'onest.woff', 'unbounded.woff' );
		if ( is_front_page() || ( function_exists( 'is_product' ) && is_product() ) ) {
			$fonts[] = 'roboto-condensed.woff';
		}
		foreach ( $fonts as $f ) {
			printf( '<link rel="preload" href="%s" as="font" type="font/woff" crossorigin>' . "\n", esc_url( EXPRINTO_URI . '/assets/fonts/' . $f ) );
		}
		printf( '<meta name="theme-color" content="#101826">' . "\n" );
	},
	2
);

/** Чистка лишнего из <head>. */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'emoji_svg_url', '__return_false' );

/** Отключаем XML-RPC (безопасность) */
add_filter( 'xmlrpc_enabled', '__return_false' );

/** Размеры изображений. */
add_action(
	'after_setup_theme',
	function () {
		add_image_size( 'exprinto-card', 600, 600, true );
	}
);

/** Длина отрывка. */
add_filter( 'excerpt_length', function () { return 24; } );
add_filter( 'excerpt_more', function () { return '…'; } );

/** Фолбэк меню, если меню ещё не назначено. */
function exprinto_menu_fallback() {
	$items = array(
		'Каталог'          => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ),
		'Конструктор'      => home_url( '/#konstruktor' ),
		'Доставка и оплата' => home_url( '/dostavka-i-oplata/' ),
		'Производство'     => home_url( '/o-proizvodstve/' ),
		'Контакты'         => home_url( '/kontakty/' ),
	);
	echo '<ul class="menu">';
	foreach ( $items as $label => $url ) {
		printf( '<li class="menu-item"><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/** Класс body для страниц с тёмной шапкой и т.п. */
add_filter(
	'body_class',
	function ( $classes ) {
		if ( is_front_page() ) {
			$classes[] = 'is-home';
		}
		return $classes;
	}
);
