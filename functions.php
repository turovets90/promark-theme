<?php
/**
 * Exprinto — тема интернет-магазина адресных табличек.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

define( 'EXPRINTO_VERSION', '1.0.0' );
define( 'EXPRINTO_DIR', get_template_directory() );
define( 'EXPRINTO_URI', get_template_directory_uri() );

require EXPRINTO_DIR . '/inc/catalog-data.php';
require EXPRINTO_DIR . '/inc/setup.php';
require EXPRINTO_DIR . '/inc/template-tags.php';
require EXPRINTO_DIR . '/inc/customizer.php';
require EXPRINTO_DIR . '/inc/seo.php';
require EXPRINTO_DIR . '/inc/leads.php';

if ( class_exists( 'WooCommerce' ) ) {
	require EXPRINTO_DIR . '/inc/demo-content.php';
	require EXPRINTO_DIR . '/inc/catalog-v2.php';
}

if ( class_exists( 'WooCommerce' ) ) {
	require EXPRINTO_DIR . '/inc/woocommerce.php';
}
