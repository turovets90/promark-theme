<?php
/**
 * Обёртка для страниц WooCommerce (каталог, категории, товар).
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
$is_list = ! is_product();
?>
<div class="page-head<?php echo $is_list ? '' : ' page-head--compact'; ?>">
	<div class="container">
		<?php exprinto_breadcrumbs(); ?>
		<?php if ( $is_list ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			<?php
			if ( is_product_category() ) {
				$desc = term_description();
				if ( $desc ) {
					echo '<div class="page-head__lead">' . wp_kses_post( $desc ) . '</div>';
				}
			} elseif ( is_shop() ) {
				echo '<div class="page-head__lead"><p>Адресные таблички с объёмными буквами из зеркального акрила и с УФ-печатью, номерные знаки на дом. Выберите модель — на странице товара вы сразу увидите превью со своим адресом.</p></div>';
			}
			echo '<div class="page-head__actions">';
			exprinto_custom_order_button( 'Нужна табличка по своему размеру?', 'btn btn--ghost' );
			echo '</div>';
			?>
		<?php endif; ?>
	</div>
</div>
<div class="container wc-area<?php echo $is_list ? ' wc-area--list' : ' wc-area--product'; ?>">
	<?php woocommerce_content(); ?>
</div>
<?php
get_footer();
