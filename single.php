<?php
/**
 * Запись блога.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) :
	the_post();
	?>
	<div class="page-head page-head--compact">
		<div class="container container--narrow">
			<?php exprinto_breadcrumbs(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<p class="post-meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
		</div>
	</div>
	<div class="container container--narrow">
		<article <?php post_class( 'prose page-content' ); ?>>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}
			the_content();
			?>
		</article>
	</div>
	<?php
	get_template_part( 'template-parts/cta' );
endwhile;
get_footer();
