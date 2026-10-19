<?php
/**
 * Форма поиска.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s-<?php echo esc_attr( wp_unique_id() ); ?>">Поиск</label>
	<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Например: табличка на подъезд">
	<input type="hidden" name="post_type" value="product">
	<button type="submit" class="btn btn--accent"><?php echo exprinto_icon( 'search', 18 ); // phpcs:ignore ?> Найти</button>
</form>
