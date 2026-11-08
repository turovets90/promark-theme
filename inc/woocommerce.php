<?php
/**
 * Интеграция с WooCommerce: персонализация табличек, корзина, оформление, вывод каталога.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 * Общие настройки вывода
 * ---------------------------------------------------------------------- */

// Обёртки и хлебные крошки выводит тема.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Свои стили для элементов Woo вместо стандартных «layout» и «smallscreen».
add_filter(
	'woocommerce_enqueue_styles',
	function ( $styles ) {
		unset( $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'] );
		return $styles;
	}
);

/** Белорусский рубль: «руб.» вместо «Br». */
add_filter(
	'woocommerce_currency_symbol',
	function ( $symbol, $currency ) {
		return 'BYN' === $currency ? 'руб.' : $symbol;
	},
	10,
	2
);

/** Количество товаров в каталоге на странице. */
add_filter( 'loop_shop_per_page', function () { return 12; } );
add_filter( 'loop_shop_columns', function () { return 3; } );

/** Счётчик корзины в шапке обновляется по AJAX. */
add_filter(
	'woocommerce_add_to_cart_fragments',
	function ( $fragments ) {
		$fragments['span.cart-count'] = exprinto_cart_count_html();
		return $fragments;
	}
);

function exprinto_cart_count_html() {
	$n = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	return '<span class="cart-count' . ( $n ? '' : ' is-empty' ) . '">' . (int) $n . '</span>';
}

/* -------------------------------------------------------------------------
 * Параметры таблички у товара (макет, размер, цвет по умолчанию)
 * ---------------------------------------------------------------------- */

function exprinto_product_plate( $product ) {
	$id     = is_object( $product ) ? $product->get_id() : (int) $product;
	$layout = get_post_meta( $id, '_ex_layout', true );
	if ( ! $layout ) {
		return null;
	}
	$meta   = function ( $k, $def = '' ) use ( $id ) {
		$v = get_post_meta( $id, '_ex_' . $k, true );
		return '' === $v || null === $v ? $def : $v;
	};
	$finish = 'mirror' === $meta( 'finish' ) ? 'mirror' : 'print';
	$scheme = $meta( 'scheme', 'white-black' );
	$split  = exprinto_scheme_split( $scheme );
	return array(
		'layout' => $layout,
		'w'      => (int) $meta( 'w' ),
		'h'      => (int) $meta( 'h' ),
		'finish' => $finish,
		'scheme' => $scheme,
		'base'   => $meta( 'base', 'mirror' === $finish ? 'graphite' : $split[0] ),
		'text'   => $meta( 'text', $split[1] ),
		'metal'  => $meta( 'metal', 'silver' ),
		'font'   => (string) $meta( 'font' ),
	);
}

/** Схема «фон / текст» → [основа, цвет текста]. */
function exprinto_scheme_split( $scheme ) {
	$map = array(
		'white-black'    => array( 'white', 'black' ),
		'white-graphite' => array( 'white', 'graphite' ),
		'graphite-white' => array( 'graphite', 'white' ),
		'black-white'    => array( 'black', 'white' ),
		'white-green'    => array( 'white', 'green' ),
		'green-white'    => array( 'green', 'white' ),
		'blue-white'     => array( 'blue', 'white' ),
		'white-blue'     => array( 'white', 'blue' ),
		'burgundy-white' => array( 'burgundy', 'white' ),
		'brown-white'    => array( 'brown', 'white' ),
		'yellow-black'   => array( 'yellow', 'black' ),
		'ivory-black'    => array( 'ivory', 'black' ),
	);
	return $map[ $scheme ] ?? array( 'white', 'black' );
}

/** Макеты для админки. */
function exprinto_layout_names() {
	return array(
		''         => '— без персонализации —',
		'line'     => '«Модерн»: тип в плашке + номер справа',
		'wave'     => '«Волна»: название рукописным шрифтом, номер в щите',
		'arch'     => '«Купол»: номер в куполе, название в полосе',
		'crest'    => '«Герб»: «улица» сверху, номер в медальоне',
		'ornate'   => '«Ажур»: фигурная форма с завитками',
		'vertical' => '«Вертикаль»: цифры одна под другой',
		'house'    => '«Домовой знак»: номер дома в рамке',
		'quadro'   => 'Компактный: номер сверху',
		'classic'  => 'Классический с рамкой',
		'number'   => 'Номер дома (простой)',
		'entrance' => 'Подъезд / квартиры',
	);
}

/** Поля в админке товара. */
add_action(
	'woocommerce_product_options_general_product_data',
	function () {
		echo '<div class="options_group"><p class="form-field"><strong style="padding-left:12px">Табличка (онлайн-превью и персонализация)</strong></p>';
		woocommerce_wp_select( array( 'id' => '_ex_layout', 'label' => 'Макет', 'options' => exprinto_layout_names() ) );
		woocommerce_wp_text_input( array( 'id' => '_ex_w', 'label' => 'Пропорции превью: ширина', 'type' => 'number', 'desc_tip' => true, 'description' => 'Только для формы превью, покупателю не показывается.' ) );
		woocommerce_wp_text_input( array( 'id' => '_ex_h', 'label' => 'Пропорции превью: высота', 'type' => 'number' ) );
		woocommerce_wp_select( array(
			'id'      => '_ex_finish',
			'label'   => 'Технология',
			'options' => array( 'print' => 'УФ-печать', 'mirror' => 'Объёмные буквы из зеркального акрила' ),
		) );
		$opts = array();
		foreach ( exprinto_schemes() as $k => $s ) {
			$opts[ $k ] = $s[0];
		}
		woocommerce_wp_select( array( 'id' => '_ex_scheme', 'label' => 'Цвет (УФ-печать)', 'options' => $opts ) );
		$bases = array();
		foreach ( exprinto_bases() as $k => $b ) {
			$bases[ $k ] = $b[0];
		}
		woocommerce_wp_select( array( 'id' => '_ex_base', 'label' => 'Цвет основы (акрил)', 'options' => $bases ) );
		$metals = array();
		foreach ( exprinto_metals() as $k => $m ) {
			$metals[ $k ] = $m[0];
		}
		woocommerce_wp_select( array( 'id' => '_ex_metal', 'label' => 'Цвет букв (акрил)', 'options' => $metals ) );
		$texts = array( '' => '— по цветовой схеме —' );
		foreach ( exprinto_text_colors() as $k => $t ) {
			$texts[ $k ] = $t[0];
		}
		woocommerce_wp_select( array( 'id' => '_ex_text', 'label' => 'Цвет надписей (печать)', 'options' => $texts ) );
		woocommerce_wp_select( array(
			'id'      => '_ex_font',
			'label'   => 'Шрифт (для «Герба»)',
			'options' => array( '' => 'С засечками', 'cond' => 'Узкий без засечек' ),
		) );
		echo '</div>';
	}
);

add_action(
	'woocommerce_admin_process_product_object',
	function ( $product ) {
		// phpcs:disable WordPress.Security.NonceVerification -- проверяет WooCommerce.
		foreach ( array( '_ex_layout', '_ex_w', '_ex_h', '_ex_finish', '_ex_scheme', '_ex_base', '_ex_metal', '_ex_font', '_ex_text' ) as $k ) {
			if ( isset( $_POST[ $k ] ) ) {
				$product->update_meta_data( $k, sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) );
			}
		}
		// phpcs:enable
	}
);

/* -------------------------------------------------------------------------
 * Персонализация на странице товара
 * ---------------------------------------------------------------------- */

/** Значения полей по умолчанию для макета. */
function exprinto_plate_defaults( $layout ) {
	if ( in_array( $layout, array( 'house', 'vertical', 'number' ), true ) ) {
		return array( 'type' => '', 'street' => '' );
	}
	if ( 'entrance' === $layout ) {
		return array( 'type' => 'Подъезд', 'street' => 'кв. 1–36' );
	}
	return array( 'type' => 'улица', 'street' => '' );
}

/**
 * Поля персонализации — общий рендер для товара и конструктора.
 * Выводятся обе палитры (печать и акрил); неактивная скрыта и отключена.
 */
function exprinto_plate_fields( $plate, $values = array() ) {
	$fields  = exprinto_layout_fields( $plate['layout'] );
	$schemes = exprinto_schemes();
	$bases   = exprinto_bases();
	$metals  = exprinto_metals();
	$texts   = exprinto_text_colors();
	$v       = wp_parse_args( $values, array_merge( exprinto_plate_defaults( $plate['layout'] ), array(
		'number' => '',
		'base'   => $plate['base'],
		'metal'  => $plate['metal'],
		'text'   => $plate['text'] ?? 'white',
	) ) );
	$mirror  = 'mirror' === $plate['finish'];
	$types   = exprinto_street_types();
	?>
	<div class="plate-fields" data-layout="<?php echo esc_attr( $plate['layout'] ); ?>">
		<div class="plate-fields__grid">
			<label class="field field--type"><span data-label="type"><?php echo esc_html( $fields['type'][0] ); ?></span>
				<select name="ex_type" data-plate="type">
					<?php foreach ( $types as $t ) : ?>
						<option value="<?php echo esc_attr( $t ); ?>" <?php selected( $v['type'], $t ); ?>><?php echo esc_html( $t ); ?></option>
					<?php endforeach; ?>
					<option value="дом" <?php selected( $v['type'], 'дом' ); ?>>дом</option>
					<option value="" <?php selected( $v['type'], '' ); ?>>— без подписи —</option>
				</select>
			</label>
			<label class="field field--street"><span data-label="street"><?php echo esc_html( $fields['street'][0] ); ?><?php echo $fields['street'][1] ? ' <b>*</b>' : ''; ?></span>
				<input type="text" name="ex_street" data-plate="street" maxlength="40" value="<?php echo esc_attr( $v['street'] ); ?>" placeholder="Солнечная" <?php echo $fields['street'][1] ? 'required' : ''; ?>>
			</label>
			<label class="field field--number"><span data-label="number"><?php echo esc_html( $fields['number'][0] ); ?> <b>*</b></span>
				<input type="text" name="ex_number" data-plate="number" maxlength="8" value="<?php echo esc_attr( $v['number'] ); ?>" placeholder="14" required>
			</label>
		</div>

		<fieldset class="finish-toggle" data-finish-toggle>
			<legend>Надписи</legend>
			<div class="finish-toggle__list">
				<?php foreach ( exprinto_finishes() as $fk => $fname ) : ?>
					<label class="finish-opt">
						<input type="radio" name="ex_finish" value="<?php echo esc_attr( $fk ); ?>" data-plate="finish" <?php checked( $plate['finish'], $fk ); ?>>
						<span>
							<b><?php echo 'mirror' === $fk ? 'Объёмные буквы' : 'Печать'; ?></b>
							<small><?php echo 'mirror' === $fk ? 'зеркальный или цветной акрил' : 'плоская УФ-печать'; ?></small>
						</span>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>

		<fieldset class="swatches">
			<legend>Цвет основы: <b class="swatches__name"><?php echo esc_html( $bases[ $v['base'] ][0] ?? '' ); ?></b></legend>
			<div class="swatches__list">
				<?php foreach ( $bases as $key => $b ) : ?>
					<label class="swatch swatch--base" title="<?php echo esc_attr( $b[0] ); ?>">
						<input type="radio" name="ex_base" value="<?php echo esc_attr( $key ); ?>" data-plate="base" data-name="<?php echo esc_attr( $b[0] ); ?>" <?php checked( $v['base'], $key ); ?>>
						<span style="--bg:<?php echo esc_attr( $b[1] ); ?>"></span>
						<em class="screen-reader-text"><?php echo esc_html( $b[0] ); ?></em>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>

		<fieldset class="swatches" data-finish-group="mirror" <?php echo $mirror ? '' : 'hidden disabled'; ?>>
			<legend>Цвет объёмных букв: <b class="swatches__name"><?php echo esc_html( $metals[ $v['metal'] ][0] ?? '' ); ?></b></legend>
			<div class="metal-list">
				<?php foreach ( $metals as $key => $m ) : ?>
					<label class="metal">
						<input type="radio" name="ex_metal" value="<?php echo esc_attr( $key ); ?>" data-plate="metal" data-name="<?php echo esc_attr( $m[0] ); ?>" <?php checked( $v['metal'], $key ); ?>>
						<span><i style="background:<?php echo esc_attr( $m[1] ); ?>"></i><?php echo esc_html( $m[0] ); ?></span>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>

		<fieldset class="swatches" data-finish-group="print" <?php echo $mirror ? 'hidden disabled' : ''; ?>>
			<legend>Цвет надписей: <b class="swatches__name"><?php echo esc_html( $texts[ $v['text'] ][0] ?? '' ); ?></b></legend>
			<div class="swatches__list">
				<?php foreach ( $texts as $key => $t ) : ?>
					<label class="swatch swatch--text" title="<?php echo esc_attr( $t[0] ); ?>">
						<input type="radio" name="ex_text" value="<?php echo esc_attr( $key ); ?>" data-plate="text" data-name="<?php echo esc_attr( $t[0] ); ?>" <?php checked( $v['text'], $key ); ?>>
						<span style="--bg:<?php echo esc_attr( $t[1] ); ?>"><i>Аа</i></span>
						<em class="screen-reader-text"><?php echo esc_html( $t[0] ); ?></em>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>
	</div>
	<?php
}

// Цен нет: вместо «В корзину» — заявка на расчёт стоимости.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_filter( 'woocommerce_get_price_html', '__return_empty_string', 99 );
add_filter( 'woocommerce_is_purchasable', '__return_false' );

/** Форма заявки на странице товара: превью, адрес, цвета, контакты. */
add_action(
	'woocommerce_single_product_summary',
	function () {
		global $product;
		$plate = exprinto_product_plate( $product );
		echo '<form class="cart quote-form" method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '" data-quote-form novalidate>';
		if ( $plate ) {
			echo '<div class="configurator" data-plate-config="' . esc_attr( wp_json_encode( $plate ) ) . '">';
			echo '<div class="configurator__stage"><div class="wall wall--sm"><div class="plate-preview" data-plate-preview aria-live="polite"></div></div>';
			echo '<p class="configurator__note">' . exprinto_icon( 'pen', 16 ) . ' Превью обновляется по мере ввода. Точный макет дизайнер пришлёт на согласование.</p></div>'; // phpcs:ignore
			exprinto_plate_fields( $plate );
			echo '</div>';
		}
		exprinto_quote_fields( $product->get_id(), 'Страница товара' );
		echo '</form>';
		echo '<div class="custom-cta"><p class="custom-cta__text"><b>Нужна другая форма, текст или свой макет?</b> Изготовим табличку по индивидуальному заказу.</p>';
		exprinto_custom_order_button( 'Заказать индивидуальную табличку', 'btn btn--ghost btn--lg custom-cta__btn' );
		echo '</div>';
	},
	30
);

/** Корзина и оформление не используются — ведём в каталог. */
add_action(
	'template_redirect',
	function () {
		if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ) ) {
			wp_safe_redirect( wc_get_page_permalink( 'shop' ) );
			exit;
		}
	}
);

function exprinto_plate_labels( $product_id ) {
	$plate  = exprinto_product_plate( $product_id );
	$fields = exprinto_layout_fields( $plate ? $plate['layout'] : 'line' );
	return array(
		'type'    => in_array( $plate['layout'] ?? 'line', array( 'number', 'entrance', 'house' ), true ) ? 'Надпись' : 'Тип',
		'street'  => preg_replace( '/\s*\(.*\)$/u', '', $fields['street'][0] ),
		'number'  => $fields['number'][0],
		'scheme'  => 'Цвет',
		'finish'  => 'Надписи',
		'base'    => 'Цвет основы',
		'metal'   => 'Цвет букв',
		'text'    => 'Цвет надписей',
		'comment' => 'Комментарий',
	);
}

/** Человекочитаемое значение поля таблички. */
function exprinto_plate_value( $k, $v ) {
	if ( 'scheme' === $k ) {
		return exprinto_schemes()[ $v ][0] ?? $v;
	}
	if ( 'base' === $k ) {
		return exprinto_bases()[ $v ][0] ?? $v;
	}
	if ( 'metal' === $k ) {
		return exprinto_metals()[ $v ][0] ?? $v;
	}
	if ( 'text' === $k ) {
		return exprinto_text_colors()[ $v ][0] ?? $v;
	}
	if ( 'finish' === $k ) {
		return exprinto_finishes()[ $v ] ?? $v;
	}
	return $v;
}

/** Без страницы товара добавить в корзину нельзя: нужна персонализация. */
add_filter(
	'woocommerce_loop_add_to_cart_link',
	function ( $html, $product ) {
		return sprintf(
			'<a href="%s" class="button btn btn--ghost card__cta" aria-label="%s">Рассчитать стоимость %s</a>',
			esc_url( $product->get_permalink() ),
			esc_attr( 'Настроить табличку «' . $product->get_name() . '»' ),
			exprinto_icon( 'arrow', 16 )
		);
	},
	10,
	2
);


/** Материал под названием в карточке каталога. */
add_action(
	'woocommerce_after_shop_loop_item_title',
	function () {
		global $product;
		$specs = array_filter( array( $product->get_attribute( 'pa_material' ) ) );
		if ( $specs ) {
			echo '<p class="card__specs">' . esc_html( implode( ' · ', $specs ) ) . '</p>';
		}
	},
	4
);

/** Бейдж «Хит». */
add_action(
	'woocommerce_before_shop_loop_item_title',
	function () {
		global $product;
		if ( $product->is_featured() ) {
			echo '<span class="badge badge--hit">Хит продаж</span>';
		}
	},
	9
);

/** Чипсы категорий над каталогом. */
add_action(
	'woocommerce_before_shop_loop',
	function () {
		if ( ! ( is_shop() || is_product_category() ) ) {
			return;
		}
		$terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => 0, 'exclude' => array( (int) get_option( 'default_product_cat' ) ) ) );
		if ( ! $terms || is_wp_error( $terms ) ) {
			return;
		}
		$current = is_product_category() ? get_queried_object_id() : 0;
		echo '<nav class="chips" aria-label="Категории каталога"><a class="chip' . ( $current ? '' : ' is-active' ) . '" href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">Все таблички</a>';
		foreach ( $terms as $t ) {
			$children = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => $t->term_id ) );
			$list     = array_merge( array( $t ), is_array( $children ) ? $children : array() );
			foreach ( $list as $c ) {
				printf( '<a class="chip%s" href="%s">%s</a>', $current === $c->term_id ? ' is-active' : '', esc_url( get_term_link( $c ) ), esc_html( $c->name ) );
			}
		}
		echo '</nav>';
	},
	5
);

/** SEO-текст категории под товарами. */
add_action(
	'woocommerce_after_shop_loop',
	function () {
		if ( is_product_category() ) {
			$text = get_term_meta( get_queried_object_id(), 'ex_seo_text', true );
			if ( $text ) {
				echo '<section class="seo-text prose">' . wp_kses_post( wpautop( $text ) ) . '</section>';
			}
		}
	},
	20
);

/* -------------------------------------------------------------------------
 * Карточка товара
 * ---------------------------------------------------------------------- */

// Короткий блок преимуществ под кнопкой.
add_action(
	'woocommerce_single_product_summary',
	function () {
		?>
		<ul class="perks">
			<li><?php echo exprinto_icon( 'clock', 20 ); // phpcs:ignore ?><span><b>Изготовим за 1–2 дня</b> после согласования макета</span></li>
			<li><?php echo exprinto_icon( 'truck', 20 ); // phpcs:ignore ?><span><b>Доставка по всей Беларуси</b> Европочта, Белпочта, курьер по Минску</span></li>
			<li><?php echo exprinto_icon( 'screw', 20 ); // phpcs:ignore ?><span><b>Крепёж в комплекте</b> саморезы и дюбели</span></li>
			<li><?php echo exprinto_icon( 'shield', 20 ); // phpcs:ignore ?><span><b>Гарантия 3 года</b> на печать и материал</span></li>
		</ul>
		<?php
	},
	35
);

// Убираем дублирующий заголовок «Описание» во вкладке.
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );

add_filter(
	'woocommerce_product_tabs',
	function ( $tabs ) {
		if ( isset( $tabs['additional_information'] ) ) {
			$tabs['additional_information']['title'] = 'Характеристики';
		}
		$tabs['ex_delivery'] = array(
			'title'    => 'Доставка и оплата',
			'priority' => 30,
			'callback' => function () {
				get_template_part( 'template-parts/delivery-table' );
			},
		);
		return $tabs;
	}
);

add_filter(
	'woocommerce_output_related_products_args',
	function ( $args ) {
		$args['posts_per_page'] = 3;
		$args['columns']        = 3;
		return $args;
	}
);

/* -------------------------------------------------------------------------
 * Оформление заказа
 * ---------------------------------------------------------------------- */

add_filter(
	'woocommerce_checkout_fields',
	function ( $fields ) {
		unset( $fields['billing']['billing_company'], $fields['billing']['billing_address_2'], $fields['billing']['billing_state'] );
		$fields['billing']['billing_postcode']['required'] = false;
		$fields['billing']['billing_email']['required']    = false;
		$fields['billing']['billing_phone']['required']    = true;
		$fields['billing']['billing_last_name']['required'] = false;
		$fields['billing']['billing_first_name']['class']  = array( 'form-row-first' );
		$fields['billing']['billing_last_name']['class']   = array( 'form-row-last' );
		$fields['billing']['billing_phone']['priority']    = 25;
		$fields['billing']['billing_phone']['placeholder'] = '+375 (29) 123-45-67';
		$fields['billing']['billing_city']['placeholder']  = 'Минск';
		$fields['billing']['billing_address_1']['placeholder'] = 'Улица, дом, квартира или № отделения Европочты';
		$fields['order']['order_comments']['placeholder']  = 'Удобное время звонка, тип стены для крепежа, пожелания к макету';
		return $fields;
	}
);

add_filter( 'default_checkout_billing_country', function () { return 'BY'; } );

add_filter( 'woocommerce_product_related_products_heading', function () { return 'Похожие таблички'; } );

// Почтовый индекс в Беларуси — необязательный; отдельный адрес доставки не нужен.
add_filter(
	'woocommerce_get_country_locale',
	function ( $locale ) {
		$locale['BY']['postcode']['required'] = false;
		$locale['BY']['state']['required']    = false;
		$locale['BY']['state']['hidden']      = true;
		return $locale;
	}
);
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false' );

/** Письма о заказах — на все адреса из «Контакты магазина → E-mail для писем с сайта». */
foreach ( array( 'new_order', 'cancelled_order', 'failed_order' ) as $exprinto_email_id ) {
	add_filter(
		'woocommerce_email_recipient_' . $exprinto_email_id,
		function ( $recipient ) {
			$list = array_filter( array_map( 'trim', explode( ',', (string) $recipient ) ) );
			$list = array_unique( array_merge( $list, exprinto_notify_emails() ) );
			return implode( ',', $list );
		}
	);
}
