<?php
/**
 * Онлайн-конструктор адресной таблички (главная страница).
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_products' ) ) {
	return;
}

$products = wc_get_products( array(
	'status'       => 'publish',
	'limit'        => 100,
	'orderby'      => 'menu_order',
	'order'        => 'ASC',
	'meta_key'     => '_ex_layout', // phpcs:ignore WordPress.DB.SlowDBQuery
	'meta_compare' => 'EXISTS',
) );

$formats = array();
foreach ( $products as $p ) {
	$plate = exprinto_product_plate( $p );
	if ( ! $plate || ! exprinto_in_builder( $p->get_id() ) ) {
		continue;
	}
	$fields    = exprinto_layout_fields( $plate['layout'] );
	$formats[] = array_merge( $plate, array(
		'id'       => $p->get_id(),
		'name'     => $p->get_name(),
		'style'    => get_post_meta( $p->get_id(), '_ex_style', true ),
		'material' => $p->get_attribute( 'pa_material' ),
		'url'      => $p->get_permalink(),
		'labels'   => array(
			'type'   => $fields['type'][0],
			'street' => $fields['street'][0] . ( $fields['street'][1] ? ' *' : '' ),
			'number' => $fields['number'][0] . ' *',
		),
		'req'      => $fields['street'][1],
		'defaults' => exprinto_plate_defaults( $plate['layout'] ),
	) );
}
// Одинаковая форма и размер в двух технологиях — одна карточка (технология выбирается переключателем).
$seen = array();
$formats = array_values( array_filter( $formats, function ( $f ) use ( &$seen ) {
	$key = 'image' === $f['layout'] ? 'image-' . $f['id'] : $f['layout'] . '-' . $f['w'] . 'x' . $f['h'];
	if ( isset( $seen[ $key ] ) && $seen[ $key ] !== $f['finish'] ) {
		return false;
	}
	$seen[ $key ] = $f['finish'];
	return true;
} ) );
if ( ! $formats ) {
	return;
}
$first  = $formats[0];
?>
<section class="section constructor" id="konstruktor" aria-labelledby="constructor-title">
	<div class="container">
		<header class="section__head">
			<?php echo exprinto_eyebrow( 'онлайн-конструктор' ); // phpcs:ignore ?>
			<h2 id="constructor-title">Соберите табличку за&nbsp;1&nbsp;минуту — и&nbsp;сразу увидите результат</h2>
			<p class="section__lead">Выберите форму, впишите адрес, решите — объёмные буквы или печать, и подберите цвет основы и надписей. Размер — любой под ваш фасад, а цену назовём после расчёта: макет, крепёж и упаковка уже входят в стоимость.</p>
		</header>

		<form class="builder" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-builder data-quote-form novalidate data-formats="<?php echo esc_attr( wp_json_encode( $formats ) ); ?>">
			<div class="builder__stage">
				<div class="wall">
					<div class="plate-preview" data-plate-preview aria-live="polite"></div>
				</div>
				<div class="builder__meta">
					<span data-builder-material><?php echo esc_html( $first['material'] ); ?></span>
					<a data-builder-link href="<?php echo esc_url( $first['url'] ); ?>">Подробнее о модели →</a>
				</div>
			</div>

			<div class="builder__panel">
				<div class="builder__step"><b>1</b> Модель</div>
				<fieldset class="formats">
					<legend class="screen-reader-text">Модель</legend>
					<div class="formats__list">
						<?php foreach ( $formats as $i => $f ) : ?>
							<label class="format">
								<input type="radio" name="ex_format" value="<?php echo (int) $i; ?>" <?php checked( 0, $i ); ?>>
								<span class="format__body">
									<span class="format__thumb" data-format-thumb="<?php echo (int) $i; ?>"></span>
									<span class="format__name"><?php echo esc_html( $f['style'] ? $f['style'] : $f['name'] ); ?></span>
								</span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>

				<div class="builder__step"><b>2</b> Адрес и цвет</div>
				<?php exprinto_plate_fields( $first, array( 'street' => '' === $first['defaults']['street'] && in_array( $first['layout'], array( 'house', 'vertical' ), true ) ? '' : 'Солнечная', 'number' => '14' ) ); ?>

				<div class="builder__step"><b>3</b> Контакты для расчёта</div>
				<?php exprinto_quote_fields( $first['id'], 'Конструктор на главной' ); ?>
			</div>
		</form>
	</div>
</section>
