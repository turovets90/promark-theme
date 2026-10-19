<?php
/**
 * SEO: заголовки, мета-описания, canonical, Open Graph, микроразметка Schema.org,
 * robots.txt, карта сайта, мета-поля SEO в админке.
 *
 * Если установлен Yoast SEO или Rank Math — модуль автоматически уступает им вывод мета-тегов.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

function exprinto_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'AIOSEO_VERSION' );
}

/* -------------------------------------------------------------------------
 * Заголовок <title>
 * ---------------------------------------------------------------------- */

function exprinto_brand() {
	return get_bloginfo( 'name' );
}

add_filter( 'document_title_separator', function () { return '|'; } );

add_filter(
	'pre_get_document_title',
	function ( $title ) {
		if ( exprinto_seo_plugin_active() ) {
			return $title;
		}
		$brand = exprinto_brand();
		$city  = 'Беларусь';

		if ( is_front_page() ) {
			$custom = get_post_meta( (int) get_option( 'page_on_front' ), '_ex_title', true );
			return $custom ? $custom : 'Адресные таблички на дом — купить в Минске с доставкой по Беларуси | ' . $brand;
		}
		if ( is_singular() ) {
			$custom = get_post_meta( get_queried_object_id(), '_ex_title', true );
			if ( $custom ) {
				return $custom;
			}
			if ( function_exists( 'is_product' ) && is_product() ) {
				$product = wc_get_product( get_queried_object_id() );
				$price   = $product ? wc_format_decimal( $product->get_price(), 2 ) : '';
				return get_the_title() . ( $price ? ' — цена ' . str_replace( '.', ',', $price ) . ' руб.' : '' ) . ', доставка по РБ | ' . $brand;
			}
		}
		if ( function_exists( 'is_shop' ) && is_shop() ) {
			$custom = get_post_meta( wc_get_page_id( 'shop' ), '_ex_title', true );
			return $custom ? $custom : 'Каталог адресных табличек и номерных знаков — цены в ' . $city . ' | ' . $brand;
		}
		if ( is_tax() || is_category() || is_tag() ) {
			$term   = get_queried_object();
			$custom = $term ? get_term_meta( $term->term_id, 'ex_title', true ) : '';
			if ( $custom ) {
				return $custom;
			}
			if ( $term && 'product_cat' === $term->taxonomy ) {
				return $term->name . ' — купить с изготовлением и доставкой по Беларуси | ' . $brand;
			}
		}
		return $title;
	}
);

/* -------------------------------------------------------------------------
 * Мета-описание
 * ---------------------------------------------------------------------- */

function exprinto_meta_description() {
	$desc = '';
	if ( is_front_page() ) {
		$desc = get_post_meta( (int) get_option( 'page_on_front' ), '_ex_desc', true );
		if ( ! $desc ) {
			$desc = 'Адресные таблички на дом с объёмными буквами из зеркального акрила и УФ-печатью. Алюминиевый композит, фигурные формы, любой цвет. Доставка по Минску и всей Беларуси.';
		}
	} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		$desc = get_post_meta( wc_get_page_id( 'shop' ), '_ex_desc', true );
		if ( ! $desc ) {
			$desc = 'Каталог адресных табличек с объёмными буквами из зеркального акрила и УФ-печатью. Цены от 37,75 руб., доставка по всей Беларуси.';
		}
	} elseif ( is_singular() ) {
		$id   = get_queried_object_id();
		$desc = get_post_meta( $id, '_ex_desc', true );
		if ( ! $desc && function_exists( 'is_product' ) && is_product() ) {
			$p = wc_get_product( $id );
			if ( $p ) {
				$short = wp_strip_all_tags( preg_replace( '/<\/(li|p|h\d)>/i', '. ', $p->get_short_description() ? $p->get_short_description() : $p->get_description() ) );
				$short = preg_replace( '/\.\s*\./u', '.', $short );
				$desc  = get_the_title( $id ) . ' за ' . str_replace( '.', ',', wc_format_decimal( $p->get_price(), 2 ) ) . ' руб. ' . $short;
			}
		}
		if ( ! $desc ) {
			$post = get_post( $id );
			$desc = $post->post_excerpt ? $post->post_excerpt : wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		}
	} elseif ( is_tax() || is_category() ) {
		$term = get_queried_object();
		$desc = get_term_meta( $term->term_id, 'ex_desc', true );
		if ( ! $desc ) {
			$desc = wp_strip_all_tags( term_description( $term ) );
		}
	}
	$desc = trim( preg_replace( '/\s+/u', ' ', (string) $desc ) );
	if ( mb_strlen( $desc ) > 165 ) {
		$desc = rtrim( mb_substr( $desc, 0, 160 ), " ,.;:-—" ) . '…';
	}
	return $desc;
}

/** Канонический URL для текущей страницы. */
function exprinto_canonical() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		return wp_get_canonical_url();
	}
	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$url = get_permalink( wc_get_page_id( 'shop' ) );
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$url = get_term_link( get_queried_object() );
	} else {
		return '';
	}
	$paged = (int) get_query_var( 'paged' );
	if ( $paged > 1 && ! is_wp_error( $url ) ) {
		$url = trailingslashit( $url ) . user_trailingslashit( 'page/' . $paged, 'paged' );
	}
	return is_wp_error( $url ) ? '' : $url;
}

/** Картинка для соцсетей. */
function exprinto_og_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		if ( $img ) {
			return $img;
		}
	}
	if ( is_tax( 'product_cat' ) ) {
		$thumb = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
		if ( $thumb ) {
			$img = wp_get_attachment_image_src( $thumb, 'large' );
			if ( $img ) {
				return $img;
			}
		}
	}
	return array( EXPRINTO_URI . '/assets/img/og-default.jpg', 1200, 630 );
}

add_action(
	'wp_head',
	function () {
		if ( exprinto_seo_plugin_active() ) {
			return;
		}
		$desc  = exprinto_meta_description();
		$canon = exprinto_canonical();
		$title = wp_get_document_title();
		$img   = exprinto_og_image();
		$type  = ( function_exists( 'is_product' ) && is_product() ) ? 'product' : ( is_singular( 'post' ) ? 'article' : 'website' );

		echo "\n<!-- Exprinto SEO -->\n";
		if ( $desc ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		if ( $canon && ! is_singular() ) { // для записей canonical выводит ядро WordPress.
			printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canon ) );
		}
		printf( '<meta property="og:locale" content="ru_RU">' . "\n" );
		printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $type ) );
		printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( exprinto_brand() ) );
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
		if ( $desc ) {
			printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		if ( $canon ) {
			printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $canon ) );
		}
		if ( $img ) {
			printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img[0] ) );
			printf( '<meta property="og:image:width" content="%d">' . "\n", (int) $img[1] );
			printf( '<meta property="og:image:height" content="%d">' . "\n", (int) $img[2] );
		}
		if ( 'product' === $type ) {
			$p = wc_get_product( get_queried_object_id() );
			if ( $p ) {
				printf( '<meta property="product:price:amount" content="%s">' . "\n", esc_attr( wc_format_decimal( $p->get_price(), 2 ) ) );
				printf( '<meta property="product:price:currency" content="%s">' . "\n", esc_attr( get_woocommerce_currency() ) );
			}
		}
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="geo.region" content="BY">' . "\n";
		echo '<meta name="geo.placename" content="' . esc_attr( exprinto_opt( 'city' ) ) . '">' . "\n";

		$ya = get_theme_mod( 'ex_yandex_verification' );
		$go = get_theme_mod( 'ex_google_verification' );
		if ( $ya ) {
			printf( '<meta name="yandex-verification" content="%s">' . "\n", esc_attr( $ya ) );
		}
		if ( $go ) {
			printf( '<meta name="google-site-verification" content="%s">' . "\n", esc_attr( $go ) );
		}
		echo "<!-- /Exprinto SEO -->\n";
	},
	1
);

/** Robots: закрываем служебные страницы от индексации. */
add_filter(
	'wp_robots',
	function ( $robots ) {
		$noindex = is_search() || is_404() || is_author() || is_date() || is_attachment();
		if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
			$noindex = true;
		}
		if ( isset( $_GET['orderby'] ) || isset( $_GET['filter_material'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			$noindex = true;
		}
		if ( $noindex ) {
			$robots['noindex'] = true;
			$robots['follow']  = true;
			unset( $robots['max-image-preview'] );
		} else {
			$robots['max-image-preview'] = 'large';
		}
		return $robots;
	}
);

/* -------------------------------------------------------------------------
 * Schema.org (JSON-LD)
 * ---------------------------------------------------------------------- */

function exprinto_schema_org() {
	$logo = EXPRINTO_URI . '/assets/img/logo.png';
	$same = array_values( array_filter( array( exprinto_opt( 'instagram' ), exprinto_opt( 'telegram' ) ), function ( $u ) { return $u && strlen( $u ) > 22; } ) );
	$org  = array(
		'@type'       => array( 'Store', 'LocalBusiness' ),
		'@id'         => home_url( '/#organization' ),
		'name'        => exprinto_brand(),
		'description' => 'Изготовление и продажа адресных табличек, номерных знаков и табличек на подъезд с доставкой по всей Беларуси.',
		'url'         => home_url( '/' ),
		'logo'        => $logo,
		'image'       => EXPRINTO_URI . '/assets/img/og-default.jpg',
		'telephone'   => exprinto_opt( 'phone' ),
		'email'       => exprinto_opt( 'email' ),
		'priceRange'  => '37–240 BYN',
		'currenciesAccepted' => 'BYN',
		'paymentAccepted'    => 'Наличные, банковская карта, ЕРИП, безналичный расчёт',
		'areaServed'  => array( '@type' => 'Country', 'name' => 'Беларусь' ),
		'openingHoursSpecification' => array(
			array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ), 'opens' => '09:00', 'closes' => '18:00' ),
		),
	);
	if ( $same ) {
		$org['sameAs'] = $same;
	}
	$addr = array( '@type' => 'PostalAddress', 'addressLocality' => exprinto_opt( 'city' ), 'addressCountry' => 'BY' );
	if ( exprinto_opt( 'address' ) ) {
		$addr['streetAddress'] = exprinto_opt( 'address' );
	}
	$org['address'] = $addr;
	return $org;
}

add_action(
	'wp_footer',
	function () {
		if ( exprinto_seo_plugin_active() ) {
			return;
		}
		$graph   = array();
		$graph[] = exprinto_schema_org();

		if ( is_front_page() ) {
			$search_target = home_url( '/?s={search_term_string}&post_type=product' );
			$graph[]       = array(
				'@type'           => 'WebSite',
				'@id'             => home_url( '/#website' ),
				'url'             => home_url( '/' ),
				'name'            => exprinto_brand(),
				'inLanguage'      => 'ru-BY',
				'publisher'       => array( '@id' => home_url( '/#organization' ) ),
				'potentialAction' => array(
					'@type'       => 'SearchAction',
					'target'      => array( '@type' => 'EntryPoint', 'urlTemplate' => $search_target ),
					'query-input' => 'required name=search_term_string',
				),
			);
		}

		// FAQ на главной и на странице «Вопросы и ответы».
		if ( is_front_page() || is_page( 'voprosy-i-otvety' ) ) {
			$faq = array();
			foreach ( exprinto_faq_items() as $it ) {
				$faq[] = array(
					'@type'          => 'Question',
					'name'           => $it[0],
					'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $it[1] ),
				);
			}
			$graph[] = array( '@type' => 'FAQPage', 'mainEntity' => $faq );
		}

		$crumbs = exprinto_breadcrumb_items();
		if ( count( $crumbs ) > 1 ) {
			$list = array();
			foreach ( $crumbs as $i => $c ) {
				$el = array( '@type' => 'ListItem', 'position' => $i + 1, 'name' => $c[0] );
				$url = $c[1] ? $c[1] : exprinto_canonical();
				if ( $url ) {
					$el['item'] = $url;
				}
				$list[] = $el;
			}
			$graph[] = array( '@type' => 'BreadcrumbList', 'itemListElement' => $list );
		}

		echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
	},
	5
);

/** Дополняем микроразметку товара WooCommerce: бренд, материал, доставка. */
add_filter(
	'woocommerce_structured_data_product',
	function ( $markup, $product ) {
		$markup['brand'] = array( '@type' => 'Brand', 'name' => exprinto_brand() );
		$material        = $product->get_attribute( 'pa_material' );
		if ( $material ) {
			$markup['material'] = $material;
		}
		$size = $product->get_attribute( 'pa_razmer' );
		if ( $size ) {
			$markup['size'] = $size;
		}
		if ( ! empty( $markup['offers'][0] ) ) {
			$markup['offers'][0]['seller']                    = array( '@id' => home_url( '/#organization' ) );
			$markup['offers'][0]['areaServed']                = 'BY';
			$markup['offers'][0]['shippingDetails']           = array(
				'@type'               => 'OfferShippingDetails',
				'shippingDestination' => array( '@type' => 'DefinedRegion', 'addressCountry' => 'BY' ),
				'shippingRate'        => array( '@type' => 'MonetaryAmount', 'value' => '4.00', 'currency' => 'BYN' ),
				'deliveryTime'        => array(
					'@type'        => 'ShippingDeliveryTime',
					'handlingTime' => array( '@type' => 'QuantitativeValue', 'minValue' => 1, 'maxValue' => 2, 'unitCode' => 'DAY' ),
					'transitTime'  => array( '@type' => 'QuantitativeValue', 'minValue' => 1, 'maxValue' => 4, 'unitCode' => 'DAY' ),
				),
			);
			$markup['offers'][0]['hasMerchantReturnPolicy'] = array(
				'@type'                => 'MerchantReturnPolicy',
				'applicableCountry'    => 'BY',
				'returnPolicyCategory' => 'https://schema.org/MerchantReturnNotPermitted',
			);
		}
		return $markup;
	},
	10,
	2
);

/** Woo не должен дублировать хлебные крошки в разметке — у темы свои. */
add_action(
	'init',
	function () {
		if ( function_exists( 'WC' ) && isset( WC()->structured_data ) ) {
			remove_action( 'woocommerce_breadcrumb', array( WC()->structured_data, 'generate_breadcrumblist_data' ), 10 );
		}
	}
);

/* -------------------------------------------------------------------------
 * robots.txt и карта сайта
 * ---------------------------------------------------------------------- */

add_filter(
	'robots_txt',
	function ( $output, $public ) {
		if ( ! $public ) {
			return $output;
		}
		$lines = array(
			'User-agent: *',
			'Disallow: /wp-admin/',
			'Allow: /wp-admin/admin-ajax.php',
			'Disallow: /cart/',
			'Disallow: /checkout/',
			'Disallow: /my-account/',
			'Disallow: /korzina/',
			'Disallow: /oformlenie-zakaza/',
			'Disallow: /moj-akkaunt/',
			'Disallow: /*?add-to-cart=',
			'Disallow: /*?orderby=',
			'Disallow: /*?s=',
			'Disallow: /*&s=',
			'Disallow: /wp-setup.php',
			'',
			'Sitemap: ' . home_url( '/wp-sitemap.xml' ),
		);
		return implode( "\n", $lines ) . "\n";
	},
	20,
	2
);

// Убираем пользователей из карты сайта.
add_filter(
	'wp_sitemaps_add_provider',
	function ( $provider, $name ) {
		return 'users' === $name ? false : $provider;
	},
	10,
	2
);

// Убираем служебные страницы из карты сайта.
add_filter(
	'wp_sitemaps_posts_query_args',
	function ( $args, $post_type ) {
		if ( 'page' === $post_type && function_exists( 'wc_get_page_id' ) ) {
			$args['post__not_in'] = array_filter( array( wc_get_page_id( 'cart' ), wc_get_page_id( 'checkout' ), wc_get_page_id( 'myaccount' ) ) );
		}
		return $args;
	},
	10,
	2
);

// Таксономия тегов товаров и атрибутов — не нужна в карте.
add_filter(
	'wp_sitemaps_taxonomies',
	function ( $taxonomies ) {
		unset( $taxonomies['product_tag'], $taxonomies['post_tag'], $taxonomies['post_format'] );
		foreach ( array_keys( $taxonomies ) as $t ) {
			if ( 0 === strpos( $t, 'pa_' ) ) {
				unset( $taxonomies[ $t ] );
			}
		}
		return $taxonomies;
	}
);

/** Alt по умолчанию для изображений без описания. */
add_filter(
	'wp_get_attachment_image_attributes',
	function ( $attr, $attachment ) {
		if ( empty( $attr['alt'] ) ) {
			$parent      = $attachment->post_parent ? get_the_title( $attachment->post_parent ) : '';
			$attr['alt'] = $parent ? $parent : get_the_title( $attachment );
		}
		return $attr;
	},
	10,
	2
);

/* -------------------------------------------------------------------------
 * Мета-поля SEO в админке (страницы, записи, товары, категории)
 * ---------------------------------------------------------------------- */

add_action(
	'add_meta_boxes',
	function () {
		if ( exprinto_seo_plugin_active() ) {
			return;
		}
		foreach ( array( 'page', 'post', 'product' ) as $pt ) {
			add_meta_box( 'exprinto_seo', 'SEO: заголовок и описание', 'exprinto_seo_metabox', $pt, 'normal', 'low' );
		}
	}
);

function exprinto_seo_metabox( $post ) {
	wp_nonce_field( 'exprinto_seo', 'exprinto_seo_nonce' );
	$t = get_post_meta( $post->ID, '_ex_title', true );
	$d = get_post_meta( $post->ID, '_ex_desc', true );
	echo '<p><label><strong>Title</strong> (до 70 символов, пусто — автоматически)<br><input type="text" name="ex_title" value="' . esc_attr( $t ) . '" style="width:100%" maxlength="120"></label></p>';
	echo '<p><label><strong>Meta description</strong> (до 160 символов)<br><textarea name="ex_desc" rows="3" style="width:100%" maxlength="300">' . esc_textarea( $d ) . '</textarea></label></p>';
}

add_action(
	'save_post',
	function ( $post_id ) {
		if ( ! isset( $_POST['exprinto_seo_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['exprinto_seo_nonce'] ), 'exprinto_seo' ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, '_ex_title', sanitize_text_field( wp_unslash( $_POST['ex_title'] ?? '' ) ) );
		update_post_meta( $post_id, '_ex_desc', sanitize_textarea_field( wp_unslash( $_POST['ex_desc'] ?? '' ) ) );
	}
);

foreach ( array( 'product_cat', 'category' ) as $exprinto_tax ) {
	add_action(
		$exprinto_tax . '_edit_form_fields',
		function ( $term ) {
			$t = get_term_meta( $term->term_id, 'ex_title', true );
			$d = get_term_meta( $term->term_id, 'ex_desc', true );
			$s = get_term_meta( $term->term_id, 'ex_seo_text', true );
			wp_nonce_field( 'exprinto_term_seo', 'exprinto_term_seo_nonce' );
			echo '<tr class="form-field"><th><label for="ex_title">SEO Title</label></th><td><input name="ex_title" id="ex_title" type="text" value="' . esc_attr( $t ) . '"></td></tr>';
			echo '<tr class="form-field"><th><label for="ex_desc">Meta description</label></th><td><textarea name="ex_desc" id="ex_desc" rows="3">' . esc_textarea( $d ) . '</textarea></td></tr>';
			echo '<tr class="form-field"><th><label for="ex_seo_text">SEO-текст под товарами</label></th><td><textarea name="ex_seo_text" id="ex_seo_text" rows="8">' . esc_textarea( $s ) . '</textarea><p class="description">Допускается HTML. Выводится под списком товаров категории.</p></td></tr>';
		}
	);
	add_action(
		'edited_' . $exprinto_tax,
		function ( $term_id ) {
			if ( ! isset( $_POST['exprinto_term_seo_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['exprinto_term_seo_nonce'] ), 'exprinto_term_seo' ) ) {
				return;
			}
			update_term_meta( $term_id, 'ex_title', sanitize_text_field( wp_unslash( $_POST['ex_title'] ?? '' ) ) );
			update_term_meta( $term_id, 'ex_desc', sanitize_textarea_field( wp_unslash( $_POST['ex_desc'] ?? '' ) ) );
			update_term_meta( $term_id, 'ex_seo_text', wp_kses_post( wp_unslash( $_POST['ex_seo_text'] ?? '' ) ) );
		}
	);
}

/** Коды верификации поисковиков — в «Настроить → Контакты магазина». */
add_action(
	'customize_register',
	function ( $wp_customize ) {
		$wp_customize->add_section( 'exprinto_seo', array( 'title' => 'SEO и вебмастера', 'priority' => 31 ) );
		foreach ( array( 'ex_yandex_verification' => 'Яндекс.Вебмастер: код подтверждения', 'ex_google_verification' => 'Google Search Console: код подтверждения' ) as $k => $l ) {
			$wp_customize->add_setting( $k, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( $k, array( 'label' => $l, 'section' => 'exprinto_seo', 'type' => 'text' ) );
		}
	}
);
