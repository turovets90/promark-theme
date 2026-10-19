<?php
/**
 * Обычная страница.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
$is_wc_page = function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() );
while ( have_posts() ) :
	the_post();
	?>
	<div class="page-head page-head--compact">
		<div class="container">
			<?php exprinto_breadcrumbs(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="container<?php echo $is_wc_page ? ' wc-area wc-area--flow' : ' container--narrow'; ?>">
		<article <?php post_class( $is_wc_page ? '' : 'prose page-content' ); ?>>
			<?php the_content(); ?>
		</article>
	</div>
	<?php
	if ( is_page( 'voprosy-i-otvety' ) ) {
		echo '<div class="container container--narrow section--tight">';
		exprinto_faq();
		echo '</div>';
	}
	if ( is_page( array( 'o-proizvodstve', 'dostavka-i-oplata', 'voprosy-i-otvety' ) ) ) {
		get_template_part( 'template-parts/cta' );
	}
endwhile;
get_footer();
