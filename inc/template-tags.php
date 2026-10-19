<?php
/**
 * Вспомогательные функции вывода.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

/** Inline SVG-иконки (stroke). */
function exprinto_icon( $name, $size = 22 ) {
	$p = array(
		'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
		'cart'     => '<path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 8H6"/><circle cx="10" cy="20" r="1.3"/><circle cx="17" cy="20" r="1.3"/>',
		'truck'    => '<path d="M3 6h11v10H3zM14 9h4l3 3v4h-7"/><circle cx="7" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'shield'   => '<path d="M12 3l8 3v6c0 4.5-3.4 8.3-8 9-4.6-.7-8-4.5-8-9V6z"/><path d="M9 12l2 2 4-4"/>',
		'sun'      => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'palette'  => '<path d="M12 3a9 9 0 1 0 0 18c1.1 0 1.7-.9 1.4-1.9-.3-1 .4-2.1 1.5-2.1H17a4 4 0 0 0 4-4c0-5.5-4-10-9-10z"/><circle cx="7.5" cy="11" r="1.2"/><circle cx="10" cy="7" r="1.2"/><circle cx="15" cy="7.5" r="1.2"/>',
		'screw'    => '<circle cx="12" cy="12" r="8"/><path d="M9 9l6 6M15 9l-6 6"/>',
		'pen'      => '<path d="M4 20l4-1L19 8l-3-3L5 16z"/><path d="M14 7l3 3"/>',
		'check'    => '<path d="M5 12.5l4.2 4.2L19 7"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'pin'      => '<path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
		'telegram' => '<path d="M21 4L3 11l6 2 2 6 3-4 5 4z"/><path d="M9 13l9-7"/>',
		'viber'    => '<path d="M6 3h10a4 4 0 0 1 4 4v6a4 4 0 0 1-4 4h-5l-4 4v-4H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3z"/><path d="M9 8c.5 2.5 2.5 4.5 5 5"/>',
		'insta'    => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8"/>',
		'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'    => '<path d="M6 6l12 12M18 6L6 18"/>',
		'search'   => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
		'factory'  => '<path d="M3 21V10l6 3V10l6 3V6h6v15z"/><path d="M7 17h2M12 17h2M17 17h2"/>',
		'ruler'    => '<path d="M3 17L17 3l4 4L7 21z"/><path d="M7 13l2 2M10 10l2 2M13 7l2 2"/>',
		'layers'   => '<path d="M12 3l9 5-9 5-9-5z"/><path d="M3 13l9 5 9-5"/>',
		'card'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h4"/>',
		'doc'      => '<path d="M6 3h8l5 5v13H6z"/><path d="M14 3v5h5M9 13h6M9 17h6"/>',
	);
	if ( ! isset( $p[ $name ] ) ) {
		return '';
	}
	return sprintf(
		'<svg class="ex-icon ex-icon--%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		(int) $size,
		$p[ $name ]
	);
}

/** Логотип: табличка-знак + словесный знак. */
function exprinto_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	$tag = is_front_page() ? 'span' : 'span';
	printf(
		'<a class="brand" href="%1$s" rel="home" aria-label="%2$s — на главную">
			<svg class="brand__mark" viewBox="0 0 48 32" width="48" height="32" aria-hidden="true"><rect x="1" y="1" width="46" height="30" rx="4" fill="#FFB400"/><g fill="#101826"><circle cx="5" cy="5" r="1.3"/><circle cx="43" cy="5" r="1.3"/><circle cx="5" cy="27" r="1.3"/><circle cx="43" cy="27" r="1.3"/><path fill-rule="evenodd" d="M10 7h10.2a6.2 6.2 0 0 1 0 12.4h-4.8V25H10zm5.4 4.4v3.6h4.4a1.8 1.8 0 0 0 0-3.6z"/><rect x="29" y="9" width="11" height="4.4" rx=".6"/><rect x="29" y="16.4" width="12" height="1.7"/><rect x="29" y="20.6" width="8" height="1.7"/></g></svg>
			<%3$s class="brand__text"><span class="brand__name">%2$s<i class="brand__tld">.by</i></span><span class="brand__tag">адресные таблички</span></%3$s>
		</a>',
		esc_url( home_url( '/' ) ),
		esc_html( get_bloginfo( 'name' ) ),
		$tag
	);
}

/** Элементы хлебных крошек: массив [name, url]. */
function exprinto_breadcrumb_items() {
	$items = array( array( 'Главная', home_url( '/' ) ) );
	$shop  = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'shop' ) : 0;
	$shop_item = $shop > 0 ? array( get_the_title( $shop ), get_permalink( $shop ) ) : null;

	if ( is_front_page() ) {
		return array();
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$items[] = array( $shop_item ? $shop_item[0] : 'Каталог', '' );
	} elseif ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) {
		if ( $shop_item ) {
			$items[] = $shop_item;
		}
		$term = get_queried_object();
		if ( $term && ! is_wp_error( $term ) ) {
			foreach ( array_reverse( get_ancestors( $term->term_id, $term->taxonomy ) ) as $anc ) {
				$a       = get_term( $anc, $term->taxonomy );
				$items[] = array( $a->name, get_term_link( $a ) );
			}
			$items[] = array( $term->name, '' );
		}
	} elseif ( function_exists( 'is_product' ) && is_product() ) {
		if ( $shop_item ) {
			$items[] = $shop_item;
		}
		$terms = wc_get_product_terms( get_the_ID(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
		if ( $terms ) {
			$main = $terms[0];
			foreach ( array_reverse( get_ancestors( $main->term_id, 'product_cat' ) ) as $anc ) {
				$a       = get_term( $anc, 'product_cat' );
				$items[] = array( $a->name, get_term_link( $a ) );
			}
			$items[] = array( $main->name, get_term_link( $main ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $anc ) {
			$items[] = array( get_the_title( $anc ), get_permalink( $anc ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_singular( 'post' ) ) {
		$blog = (int) get_option( 'page_for_posts' );
		if ( $blog ) {
			$items[] = array( get_the_title( $blog ), get_permalink( $blog ) );
		}
		$items[] = array( get_the_title(), '' );
	} elseif ( is_search() ) {
		$items[] = array( 'Поиск: ' . get_search_query(), '' );
	} elseif ( is_404() ) {
		$items[] = array( 'Страница не найдена', '' );
	} elseif ( is_home() ) {
		$items[] = array( 'Статьи', '' );
	} elseif ( is_archive() ) {
		$items[] = array( wp_strip_all_tags( get_the_archive_title() ), '' );
	}
	return $items;
}

function exprinto_breadcrumbs() {
	$items = exprinto_breadcrumb_items();
	if ( count( $items ) < 2 ) {
		return;
	}
	echo '<nav class="crumbs" aria-label="Хлебные крошки"><ol>';
	$last = count( $items ) - 1;
	foreach ( $items as $i => $it ) {
		if ( $i === $last || '' === $it[1] ) {
			printf( '<li aria-current="page">%s</li>', esc_html( $it[0] ) );
		} else {
			printf( '<li><a href="%s">%s</a></li>', esc_url( $it[1] ), esc_html( $it[0] ) );
		}
	}
	echo '</ol></nav>';
}

/** Плашка-«ярлык» как на табличке. */
function exprinto_eyebrow( $text ) {
	return '<span class="eyebrow">' . esc_html( $text ) . '</span>';
}

/** Блок FAQ: массив [вопрос, ответ]. */
function exprinto_faq_items() {
	return array(
		array( 'Сколько времени занимает изготовление адресной таблички?', 'Таблички с УФ-печатью — 1–2 рабочих дня, с объёмными буквами из акрила — 2–3 рабочих дня после согласования макета. Срочные заказы по Минску изготавливаем в день обращения, если макет утверждён до 12:00.' ),
		array( 'Как доставляете по Беларуси и сколько это стоит?', 'Отправляем Европочтой и Белпочтой в любой населённый пункт РБ — 2–4 дня, от 4 руб. По Минску работает курьер, есть самовывоз с производства. При заказе от 100 руб. доставка бесплатная.' ),
		array( 'Сколько прослужит табличка на улице?', 'Основа наших табличек — алюминиевый композит 3 мм, надписи — объёмные буквы из зеркального акрила или УФ-печать. Изображение не выгорает и не боится мороза, дождя и мойки: гарантия на печать — 3 года, реальный срок службы — 10 лет и больше.' ),
		array( 'Можно ли увидеть макет до оплаты?', 'Да. После оформления заказа дизайнер присылает макет в Viber, Telegram или на e-mail. Вносим правки бесплатно, в работу запускаем только после вашего «Да, всё верно».' ),
		array( 'Соответствуют ли таблички требованиям исполкома?', 'Мы делаем таблички любого цвета, размера и шрифта. Если в вашем районе действуют требования к единому стилю адресных указателей — пришлите фото или ссылку, сделаем точно по образцу.' ),
		array( 'Как крепить табличку к фасаду?', 'В углах таблички есть отверстия, в комплекте — саморезы и дюбели. Для монтажа на утеплённый фасад, кирпич, дерево или забор из профнастила подберём подходящий крепёж бесплатно — просто укажите тип стены в комментарии.' ),
		array( 'Как оплатить заказ?', 'Наличными или картой при получении (наложенный платёж), через ЕРИП, банковским переводом по счёту для организаций. Для юрлиц и ИП предоставляем все закрывающие документы.' ),
		array( 'Делаете ли таблички по своему макету или для организаций?', 'Да: таблички на подъезды, номера квартир, указатели для садовых товариществ, вывески для офисов и партии для застройщиков и ЖЭС. Отправьте эскиз или техническое задание — посчитаем за 30 минут.' ),
	);
}

function exprinto_faq( $items = null ) {
	$items = $items ? $items : exprinto_faq_items();
	echo '<div class="faq">';
	foreach ( $items as $i => $it ) {
		printf(
			'<details class="faq__item"%s><summary><span>%s</span><i aria-hidden="true"></i></summary><div class="faq__a"><p>%s</p></div></details>',
			0 === $i ? ' open' : '',
			esc_html( $it[0] ),
			esc_html( $it[1] )
		);
	}
	echo '</div>';
}

/** Склонение: 1 модель, 2 модели, 5 моделей. */
function exprinto_plural( $n, $one, $few, $many ) {
	$n10  = $n % 10;
	$n100 = $n % 100;
	$form = ( 1 === $n10 && 11 !== $n100 ) ? $one : ( ( $n10 >= 2 && $n10 <= 4 && ( $n100 < 10 || $n100 >= 20 ) ) ? $few : $many );
	return $n . ' ' . $form;
}
