<?php
/**
 * Архивы, блог, поиск.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="page-head page-head--compact">
	<div class="container">
		<?php exprinto_breadcrumbs(); ?>
		<h1 class="page-title">
			<?php
			if ( is_search() ) {
				printf( 'Результаты поиска: «%s»', esc_html( get_search_query() ) );
			} elseif ( is_home() ) {
				echo esc_html( get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : 'Статьи' );
			} else {
				echo wp_kses_post( get_the_archive_title() );
			}
			?>
		</h1>
	</div>
</div>
<div class="container">
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'post-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="post-card__img" href="<?php the_permalink(); ?>" tabindex="-1"><?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?></a>
					<?php endif; ?>
					<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
	<?php else : ?>
		<div class="empty prose">
			<p>Ничего не найдено. Попробуйте другой запрос или загляните в <a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>">каталог</a>.</p>
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</div>
<?php
get_footer();
