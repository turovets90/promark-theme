<?php
/**
 * Наполнение магазина: настройки WooCommerce, категории, товары, страницы, меню.
 * Вызывается установщиком один раз: exprinto_install_demo().
 *
 * @package Promark
 */

defined( 'ABSPATH' ) || exit;

/** Импорт картинки из папки темы в медиатеку. */
function exprinto_import_image( $file, $title, $alt = '' ) {
	$path = EXPRINTO_DIR . '/assets/img/products/' . $file;
	if ( ! file_exists( $path ) ) {
		return 0;
	}
	$existing = get_posts( array( 'post_type' => 'attachment', 'meta_key' => '_ex_source', 'meta_value' => $file, 'fields' => 'ids', 'numberposts' => 1 ) ); // phpcs:ignore
	if ( $existing ) {
		return (int) $existing[0];
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$upload = wp_upload_bits( $file, null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}
	$id = wp_insert_attachment( array(
		'post_mime_type' => wp_check_filetype( $upload['file'] )['type'],
		'post_title'     => $title,
		'post_status'    => 'inherit',
	), $upload['file'] );
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
	update_post_meta( $id, '_wp_attachment_image_alt', $alt ? $alt : $title );
	update_post_meta( $id, '_ex_source', $file );
	return $id;
}

/** Создать/обновить страницу по слагу. */
function exprinto_upsert_page( $slug, $title, $content, $extra = array() ) {
	$page = get_page_by_path( $slug );
	$data = array_merge( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_name'    => $slug,
		'post_title'   => $title,
		'post_content' => $content,
		'comment_status' => 'closed',
	), $extra );
	if ( $page ) {
		$data['ID'] = $page->ID;
		return wp_update_post( $data );
	}
	return wp_insert_post( $data );
}

function exprinto_catalog_categories() {
	return array(
		'adresnye-tablichki' => array(
			'name'   => 'Адресные таблички',
			'parent' => '',
			'image'  => 'modern-xl-white-black-1.jpg',
			'desc'   => 'Адресные таблички на дом с названием улицы и номером: ПВХ и алюминиевый композит, 12 цветов, изготовление за 1–2 дня и доставка по всей Беларуси.',
			'title'  => 'Адресные таблички на дом — купить в Минске и по Беларуси, цены от 42,90 руб.',
			'meta'   => 'Купить адресную табличку на дом с улицей и номером. УФ-печать, ПВХ и композит, 12 цветов. Изготовление 1–2 дня, доставка по всей РБ, оплата при получении.',
			'seo'    => '<h2>Как выбрать адресную табличку на дом</h2>
<p>Адресная табличка — это не только требование местных властей, но и способ быстро найти ваш дом курьеру, такси, гостям и экстренным службам. Чтобы табличка выполняла свою задачу, важны три параметра: <strong>размер</strong>, <strong>контраст</strong> и <strong>материал</strong>.</p>
<h3>Размер</h3>
<p>Для частного дома, который стоит у дороги, достаточно формата 450×270 или 590×220 мм. Если дом в глубине участка или табличка висит на высоте второго этажа — выбирайте 900×270 мм: номер высотой 20 см читается с 30 метров.</p>
<h3>Цвет</h3>
<p>Лучше всего читаются контрастные пары: белый с чёрным, белый с графитом, синий с белым. Тёмные таблички со светлыми буквами эффектно смотрятся на светлых фасадах, а светлые — на кирпиче и тёмном сайдинге.</p>
<h3>Материал</h3>
<p>Вспененный ПВХ 3–4 мм лёгкий и доступный, служит 7–10 лет. Алюминиевый композит дороже, но не боится перепадов температур и сохраняет вид 15 лет и больше. В обоих случаях мы печатаем УФ-чернилами, которые не выгорают на солнце.</p>',
		),
		'sovremennye-tablichki' => array(
			'name'   => 'Современные таблички',
			'parent' => 'adresnye-tablichki',
			'image'  => 'modern-m-graphite-white-1.jpg',
			'desc'   => 'Лаконичные адресные таблички в стиле минимализм: крупный номер, тонкая линия, строгий шрифт. Идеальны для современных фасадов.',
			'title'  => 'Современные адресные таблички в стиле минимализм — купить в Беларуси',
			'meta'   => 'Адресные таблички в современном стиле: крупный номер, строгий шрифт, 12 цветов. Размеры 450×270, 590×220, 900×270 мм. Доставка по РБ.',
			'seo'    => '<h2>Минимализм на фасаде</h2><p>Современная адресная табличка строится на контрасте: крупный номер дома справа, тип улицы в плашке и название под тонкой линией. Такой макет хорошо читается издалека и подходит к фасадам из клинкера, штукатурки, сайдинга и фиброцемента.</p><p>Все модели раздела можно заказать в любом из 12 цветов — просто выберите его на странице товара и сразу увидите превью со своим адресом.</p>',
		),
		'klassicheskie-tablichki' => array(
			'name'   => 'Классические таблички',
			'parent' => 'adresnye-tablichki',
			'image'  => 'classic-green-white-1.jpg',
			'desc'   => 'Адресные таблички в классическом стиле: рамка, шрифт с засечками, номер в контрастной плашке. Привычный вид городских указателей.',
			'title'  => 'Классические адресные таблички с рамкой — изготовление в Беларуси',
			'meta'   => 'Классические адресные таблички с рамкой и засечками из алюминиевого композита. 600×150 и 800×200 мм, любые цвета, доставка по Беларуси.',
			'seo'    => '<h2>Классика, которая не выходит из моды</h2><p>Табличка с рамкой и шрифтом с засечками повторяет стиль городских адресных указателей. Её выбирают для домов в историческом стиле, для дач и усадеб, а также там, где исполком рекомендует единый вид табличек.</p>',
		),
		'nomera-domov' => array(
			'name'   => 'Номерные знаки на дом',
			'parent' => '',
			'image'  => 'nomer-doma-blue-white-1.jpg',
			'desc'   => 'Квадратные таблички с номером дома: для ворот, калитки, второго фасада и почтового ящика.',
			'title'  => 'Номерные знаки и таблички с номером дома — купить в Минске',
			'meta'   => 'Таблички с номером дома 300×300 мм из алюминиевого композита. Для ворот, калитки и фасада. Изготовление 1–2 дня, доставка по Беларуси.',
			'seo'    => '<h2>Номер дома, который видно издалека</h2><p>Отдельный номерной знак удобно повесить на ворота или калитку, если основная адресная табличка висит на фасаде. Высота цифр — 18 см: номер читается с 25 метров даже в сумерках.</p>',
		),
		'tablichki-na-podezd' => array(
			'name'   => 'Таблички на подъезд',
			'parent' => '',
			'image'  => 'podezd-white-graphite-1.jpg',
			'desc'   => 'Таблички с номером подъезда и диапазоном квартир для многоквартирных домов, ЖЭС и товариществ собственников.',
			'title'  => 'Таблички на подъезд с номерами квартир — для ЖЭС и ТС',
			'meta'   => 'Таблички на подъезд с номером и диапазоном квартир. Скидки на партии, безналичная оплата, документы для ЖЭС и товариществ собственников.',
			'seo'    => '<h2>Таблички для многоквартирных домов</h2><p>Изготавливаем таблички на подъезды комплектами на весь дом или микрорайон. Работаем с ЖЭС, товариществами собственников и управляющими компаниями по договору, предоставляем акты и счета-фактуры.</p>',
		),
	);
}

function exprinto_catalog_products() {
	$common_desc_end = '
<h3>Что входит в заказ</h3>
<ul>
<li>Табличка с вашим адресом, напечатанная УФ-чернилами</li>
<li>Защитная плёнка и жёсткая упаковка для перевозки</li>
<li>Комплект крепежа: саморезы и дюбели по количеству отверстий</li>
<li>Бесплатный макет на согласование до запуска в печать</li>
</ul>
<h3>Как оформить</h3>
<p>Введите название улицы и номер дома, выберите цвет — превью обновится сразу. После заказа дизайнер пришлёт точный макет в Viber, Telegram или на e-mail. Изготовим за 1–2 рабочих дня и отправим в любой город Беларуси. Оплата — при получении.</p>';

	return array(
		array(
			'slug'   => 'adresnaya-tablichka-modern-900x270-belo-chernaya',
			'name'   => 'Адресная табличка «Модерн» 900×270 мм, бело-чёрная',
			'price'  => '76.90',
			'cats'   => array( 'sovremennye-tablichki' ),
			'layout' => 'line', 'w' => 900, 'h' => 270, 'scheme' => 'white-black',
			'material' => 'ПВХ 4 мм', 'size' => '900×270 мм',
			'featured' => true,
			'img'    => array( 'modern-xl-white-black-1.jpg', 'modern-xl-white-black-2.jpg' ),
			'short'  => '<ul><li>Самый заметный формат: номер высотой 21 см читается с 30 метров</li><li>Вспененный ПВХ 4 мм, УФ-печать — не выгорает 10+ лет</li><li>Крепёж в комплекте, изготовление 1–2 дня</li></ul>',
			'desc'   => '<p>Большая адресная табличка в современном стиле для домов, которые стоят в глубине участка или имеют высокий фасад. Крупный номер справа, тип улицы в контрастной плашке и название под тонкой линией — адрес считывается с одного взгляда, даже из окна проезжающего автомобиля.</p>
<p>Основа — вспененный ПВХ толщиной 4 мм: лёгкий, жёсткий, не впитывает влагу и не ржавеет. Изображение наносится УФ-печатью, которая полимеризуется прямо на поверхности и не боится солнца, мороза и мойки.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'adresnaya-tablichka-modern-900x270-belo-seraya',
			'name'   => 'Адресная табличка «Модерн» 900×270 мм, бело-графитовая',
			'price'  => '76.90',
			'cats'   => array( 'sovremennye-tablichki' ),
			'layout' => 'line', 'w' => 900, 'h' => 270, 'scheme' => 'white-graphite',
			'material' => 'ПВХ 4 мм', 'size' => '900×270 мм',
			'featured' => false,
			'img'    => array( 'modern-xl-white-graphite-1.jpg' ),
			'short'  => '<ul><li>Мягкий графитовый цвет вместо чёрного — элегантно на светлых фасадах</li><li>ПВХ 4 мм, УФ-печать, гарантия 3 года</li><li>Отверстия и крепёж в комплекте</li></ul>',
			'desc'   => '<p>Та же большая «Модерн», но в графитовом цвете: он выглядит мягче чёрного и прекрасно сочетается с серой кровлей, окнами цвета «антрацит» и штукатуркой светлых оттенков. Контраст остаётся высоким — номер дома хорошо виден днём и в сумерках.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'adresnaya-tablichka-modern-590x220-grafit',
			'name'   => 'Адресная табличка «Модерн» 590×220 мм, графит',
			'price'  => '42.90',
			'cats'   => array( 'sovremennye-tablichki' ),
			'layout' => 'line', 'w' => 590, 'h' => 220, 'scheme' => 'graphite-white',
			'material' => 'ПВХ 3 мм', 'size' => '590×220 мм',
			'featured' => true,
			'img'    => array( 'modern-m-graphite-white-1.jpg', 'modern-m-graphite-white-2.jpg' ),
			'short'  => '<ul><li>Оптимальный размер для частного дома у дороги</li><li>Тёмный фон и белые буквы — эффектно на светлом фасаде</li><li>Самая доступная современная модель</li></ul>',
			'desc'   => '<p>Компактная версия «Модерн» на тёмном графитовом фоне. Формат 590×220 мм — золотая середина: табличка заметна с дороги, но не перегружает фасад. Подходит для домов, коттеджей, дач и хозпостроек.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'adresnaya-tablichka-kvadro-450x270-belo-chernaya',
			'name'   => 'Адресная табличка «Квадро» 450×270 мм, бело-чёрная',
			'price'  => '45.70',
			'cats'   => array( 'sovremennye-tablichki' ),
			'layout' => 'quadro', 'w' => 450, 'h' => 270, 'scheme' => 'white-black',
			'material' => 'ПВХ 4 мм', 'size' => '450×270 мм',
			'featured' => true,
			'img'    => array( 'quadro-white-black-1.jpg', 'quadro-white-black-2.jpg' ),
			'short'  => '<ul><li>Компактный формат для узких простенков и столбов ворот</li><li>Номер крупно сверху, название улицы — во всю ширину</li><li>ПВХ 4 мм, УФ-печать</li></ul>',
			'desc'   => '<p>«Квадро» — для мест, где широкая табличка не помещается: простенок между окнами, кирпичный столб забора, узкий фронтон. Номер дома набран крупно в верхней части, а длинное название улицы занимает всю ширину нижней строки — даже «Набережная» или «Первомайская» поместятся без уменьшения шрифта.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'adresnaya-tablichka-kvadro-450x270-belo-zelenaya',
			'name'   => 'Адресная табличка «Квадро» 450×270 мм, бело-зелёная',
			'price'  => '45.70',
			'cats'   => array( 'sovremennye-tablichki' ),
			'layout' => 'quadro', 'w' => 450, 'h' => 270, 'scheme' => 'white-green',
			'material' => 'ПВХ 4 мм', 'size' => '450×270 мм',
			'featured' => false,
			'img'    => array( 'quadro-white-green-1.jpg' ),
			'short'  => '<ul><li>Глубокий зелёный цвет — классика адресных указателей</li><li>Компактный формат 450×270 мм</li><li>Изготовление 1–2 дня, доставка по РБ</li></ul>',
			'desc'   => '<p>Компактная «Квадро» в благородном тёмно-зелёном цвете. Отлично смотрится на деревянных домах, в окружении сада и рядом с зелёной кровлей. Во многих населённых пунктах Беларуси зелёный — традиционный цвет адресных табличек.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'adresnaya-tablichka-klassika-600x150-zelenaya',
			'name'   => 'Адресная табличка «Классика» 600×150 мм, алюминиевый композит',
			'price'  => '48.50',
			'cats'   => array( 'klassicheskie-tablichki' ),
			'layout' => 'classic', 'w' => 600, 'h' => 150, 'scheme' => 'green-white',
			'material' => 'Алюминиевый композит 3 мм', 'size' => '600×150 мм',
			'featured' => true,
			'img'    => array( 'classic-green-white-1.jpg', 'classic-green-white-2.jpg' ),
			'short'  => '<ul><li>Классический вид: рамка, шрифт с засечками, номер в плашке</li><li>Алюминиевый композит — срок службы 15+ лет</li><li>Не деформируется от жары и мороза</li></ul>',
			'desc'   => '<p>Табличка в стиле городских адресных указателей: аккуратная рамка со скруглёнными углами, название улицы шрифтом с засечками и номер дома в контрастной плашке. Такой дизайн уместен и на старом доме, и на новом коттедже в классическом стиле.</p>
<p>Основа — алюминиевый композит 3 мм: два листа алюминия с полимерным наполнителем. Материал не гнётся, не ржавеет и не меняет геометрию при перепадах температур от −40 до +80 °C.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'adresnaya-tablichka-klassika-800x200-sinyaya',
			'name'   => 'Адресная табличка «Классика XL» 800×200 мм, синяя',
			'price'  => '69.00',
			'cats'   => array( 'klassicheskie-tablichki' ),
			'layout' => 'classic', 'w' => 800, 'h' => 200, 'scheme' => 'blue-white',
			'material' => 'Алюминиевый композит 3 мм', 'size' => '800×200 мм',
			'featured' => false,
			'img'    => array( 'classic-xl-blue-white-1.jpg' ),
			'short'  => '<ul><li>Увеличенная классика для многоквартирных домов и организаций</li><li>Алюминиевый композит 3 мм</li><li>Подходит для партийных заказов ЖЭС</li></ul>',
			'desc'   => '<p>Крупная классическая табличка на синем фоне — привычный городской формат для многоэтажек, административных зданий, школ и предприятий. Для ЖЭС и товариществ собственников делаем партии с безналичной оплатой и закрывающими документами.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'tablichka-nomer-doma-300x300',
			'name'   => 'Табличка с номером дома 300×300 мм',
			'price'  => '29.90',
			'cats'   => array( 'nomera-domov' ),
			'layout' => 'number', 'w' => 300, 'h' => 300, 'scheme' => 'blue-white',
			'material' => 'Алюминиевый композит 3 мм', 'size' => '300×300 мм',
			'featured' => true,
			'img'    => array( 'nomer-doma-blue-white-1.jpg' ),
			'short'  => '<ul><li>Номер дома высотой 18 см — виден с 25 метров</li><li>Можно добавить надпись сверху и снизу</li><li>Для ворот, калитки и второго фасада</li></ul>',
			'desc'   => '<p>Квадратный номерной знак с крупными цифрами. Повесьте его на ворота или калитку, чтобы курьер и гости сразу видели номер с улицы, — а основную адресную табличку оставьте на фасаде. По желанию добавим небольшую надпись сверху («дом», «уч.») и название улицы снизу.</p>' . $common_desc_end,
		),
		array(
			'slug'   => 'tablichka-na-podezd-400x200',
			'name'   => 'Табличка на подъезд с номерами квартир 400×200 мм',
			'price'  => '32.50',
			'cats'   => array( 'tablichki-na-podezd' ),
			'layout' => 'entrance', 'w' => 400, 'h' => 200, 'scheme' => 'white-graphite',
			'material' => 'ПВХ 3 мм', 'size' => '400×200 мм',
			'featured' => true,
			'img'    => array( 'podezd-white-graphite-1.jpg' ),
			'short'  => '<ul><li>Номер подъезда и диапазон квартир</li><li>Для многоквартирных домов, ЖЭС и ТС</li><li>Скидки на комплект для всего дома</li></ul>',
			'desc'   => '<p>Табличка над входом в подъезд с крупным номером и диапазоном квартир. Помогает курьерам, службам доставки и скорой помощи быстро найти нужную квартиру. При заказе комплекта на весь дом — скидка до 25%.</p>' . $common_desc_end,
		),
	);
}

/** Атрибут товара: создать при необходимости, вернуть таксономию. */
function exprinto_ensure_attribute( $slug, $name ) {
	$tax = wc_attribute_taxonomy_name( $slug );
	if ( ! wc_attribute_taxonomy_id_by_name( $slug ) ) {
		wc_create_attribute( array( 'name' => $name, 'slug' => $slug, 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false ) );
		delete_transient( 'wc_attribute_taxonomies' );
		WC_Cache_Helper::invalidate_cache_group( 'woocommerce-attributes' );
	}
	if ( ! taxonomy_exists( $tax ) ) {
		register_taxonomy( $tax, 'product', array( 'hierarchical' => false, 'show_ui' => false, 'query_var' => true, 'rewrite' => false ) );
	}
	return $tax;
}

function exprinto_install_demo() {
	@set_time_limit( 300 ); // phpcs:ignore

	/* ---------- Общие настройки сайта ---------- */
	update_option( 'blogname', 'Promark' );
	update_option( 'blogdescription', 'Адресные таблички на дом с доставкой по Беларуси' );
	update_option( 'timezone_string', 'Europe/Minsk' );
	update_option( 'date_format', 'd.m.Y' );
	update_option( 'time_format', 'H:i' );
	update_option( 'start_of_week', 1 );
	update_option( 'blog_public', 1 );
	update_option( 'default_comment_status', 'closed' );
	update_option( 'default_ping_status', 'closed' );
	update_option( 'thumbnail_size_w', 300 );
	update_option( 'thumbnail_size_h', 300 );

	// Удаляем демо-контент WordPress.
	foreach ( array( 'hello-world', 'privet-mir' ) as $s ) {
		$p = get_page_by_path( $s, OBJECT, 'post' );
		if ( $p ) {
			wp_delete_post( $p->ID, true );
		}
	}
	foreach ( array( 'sample-page', 'primer-stranitsy' ) as $s ) {
		$p = get_page_by_path( $s );
		if ( $p ) {
			wp_delete_post( $p->ID, true );
		}
	}
	foreach ( get_comments( array( 'number' => 50 ) ) as $c ) {
		wp_delete_comment( $c->comment_ID, true );
	}

	/* ---------- WooCommerce ---------- */
	$wc = array(
		'woocommerce_default_country'           => 'BY',
		'woocommerce_currency'                  => 'BYN',
		'woocommerce_currency_pos'              => 'right_space',
		'woocommerce_price_thousand_sep'        => ' ',
		'woocommerce_price_decimal_sep'         => ',',
		'woocommerce_price_num_decimals'        => 2,
		'woocommerce_allowed_countries'         => 'specific',
		'woocommerce_specific_allowed_countries' => array( 'BY' ),
		'woocommerce_ship_to_countries'         => '',
		'woocommerce_calc_taxes'                => 'no',
		'woocommerce_enable_guest_checkout'     => 'yes',
		'woocommerce_enable_checkout_login_reminder' => 'no',
		'woocommerce_enable_signup_and_login_from_checkout' => 'no',
		'woocommerce_cart_redirect_after_add'   => 'yes',
		'woocommerce_enable_ajax_add_to_cart'   => 'no',
		'woocommerce_enable_reviews'            => 'no',
		'woocommerce_weight_unit'               => 'kg',
		'woocommerce_dimension_unit'            => 'mm',
		'woocommerce_coming_soon'               => 'no',
		'woocommerce_store_pages_only'          => 'no',
		'woocommerce_show_marketplace_suggestions' => 'no',
		'woocommerce_allow_tracking'            => 'no',
		'woocommerce_task_list_hidden'          => 'yes',
		'woocommerce_task_list_complete'        => 'yes',
		'woocommerce_onboarding_profile'        => array( 'skipped' => true, 'completed' => true ),
		'woocommerce_thumbnail_cropping'        => '1:1',
		'woocommerce_thumbnail_image_width'     => 600,
		'woocommerce_single_image_width'        => 900,
		'woocommerce_email_from_name'           => 'Promark',
		'woocommerce_shipping_cost_requires_address' => 'no',
		'woocommerce_feature_order_attribution_enabled' => 'no',
		'woocommerce_manage_stock'              => 'no',
		'woocommerce_checkout_phone_field'      => 'required',
		'woocommerce_checkout_company_field'    => 'hidden',
		'woocommerce_checkout_address_2_field'  => 'hidden',
		'woocommerce_enable_shipping_calc'      => 'no',
		'woocommerce_gateway_order'             => array( 'cod' => 0, 'bacs' => 1 ),
		'woocommerce_default_gateway'           => 'cod',
	);
	foreach ( $wc as $k => $v ) {
		update_option( $k, $v );
	}

	// ЧПУ: /%postname%/, товары — /katalog/<категория>/<товар>/.
	update_option( 'permalink_structure', '/%postname%/' );
	update_option( 'woocommerce_permalinks', array(
		'product_base'           => '/tablichki',
		'category_base'          => 'kategoriya',
		'tag_base'               => 'metka',
		'attribute_base'         => '',
		'use_verbose_page_rules' => false,
	) );

	/* ---------- Страницы WooCommerce ---------- */
	$shop_id = exprinto_upsert_page( 'katalog', 'Каталог адресных табличек', '' );
	$cart_id = exprinto_upsert_page( 'cart', 'Корзина', '[woocommerce_cart]' );
	$chk_id  = exprinto_upsert_page( 'checkout', 'Оформление заказа', '[woocommerce_checkout]' );
	$acc_id  = exprinto_upsert_page( 'my-account', 'Личный кабинет', '[woocommerce_my_account]' );
	update_option( 'woocommerce_shop_page_id', $shop_id );
	update_option( 'woocommerce_cart_page_id', $cart_id );
	update_option( 'woocommerce_checkout_page_id', $chk_id );
	update_option( 'woocommerce_myaccount_page_id', $acc_id );
	update_post_meta( $shop_id, '_ex_title', 'Каталог адресных табличек и номерных знаков — цены в Беларуси | Promark.by' );
	update_post_meta( $shop_id, '_ex_desc', 'Каталог адресных табличек, номерных знаков и табличек на подъезд. Цены от 29,90 руб., изготовление 1–2 дня, доставка Европочтой и Белпочтой по всей РБ.' );

	// Woo могла создать свои страницы с другими слагами — удаляем дубликаты.
	foreach ( array( 'shop', 'magazin' ) as $s ) {
		$p = get_page_by_path( $s );
		if ( $p && (int) $p->ID !== (int) $shop_id ) {
			wp_delete_post( $p->ID, true );
		}
	}
	foreach ( array( 'korzina' => $cart_id, 'oformlenie-zakaza' => $chk_id, 'moj-akkaunt' => $acc_id, 'moy-akkaunt' => $acc_id ) as $s => $keep ) {
		$p = get_page_by_path( $s );
		if ( $p && (int) $p->ID !== (int) $keep ) {
			wp_delete_post( $p->ID, true );
		}
	}

	/* ---------- Доставка ---------- */
	if ( class_exists( 'WC_Shipping_Zone' ) ) {
		$zones = WC_Shipping_Zones::get_zones();
		$zone  = null;
		foreach ( $zones as $z ) {
			if ( 'Беларусь' === $z['zone_name'] ) {
				$zone = new WC_Shipping_Zone( $z['id'] );
			}
		}
		if ( ! $zone ) {
			$zone = new WC_Shipping_Zone();
			$zone->set_zone_name( 'Беларусь' );
			$zone->set_zone_order( 1 );
			$zone->add_location( 'BY', 'country' );
			$zone->save();

			$methods = array(
				array( 'flat_rate', 'Европочта — до отделения (1–3 дня)', '4.50' ),
				array( 'flat_rate', 'Белпочта — любое отделение РБ (2–4 дня)', '4.00' ),
				array( 'flat_rate', 'Курьер по Минску', '8.00' ),
				array( 'free_shipping', 'Бесплатная доставка (Европочта / Белпочта)', '' ),
				array( 'local_pickup', 'Самовывоз с производства (Минск)', '' ),
			);
			foreach ( $methods as $m ) {
				$iid      = $zone->add_shipping_method( $m[0] );
				$settings = array( 'title' => $m[1] );
				if ( 'flat_rate' === $m[0] ) {
					$settings['cost']       = $m[2];
					$settings['tax_status'] = 'none';
				}
				if ( 'free_shipping' === $m[0] ) {
					$settings['requires']   = 'min_amount';
					$settings['min_amount'] = '100';
				}
				if ( 'local_pickup' === $m[0] ) {
					$settings['cost'] = '';
				}
				update_option( 'woocommerce_' . $m[0] . '_' . $iid . '_settings', $settings );
			}
		}
	}

	/* ---------- Оплата ---------- */
	update_option( 'woocommerce_cod_settings', array(
		'enabled'            => 'yes',
		'title'              => 'Оплата при получении (наличные или карта)',
		'description'        => 'Оплатите заказ наличными или банковской картой курьеру либо в отделении Европочты / Белпочты.',
		'instructions'       => 'Оплата при получении заказа.',
		'enable_for_methods' => array(),
		'enable_for_virtual' => 'yes',
	) );
	update_option( 'woocommerce_bacs_settings', array(
		'enabled'      => 'yes',
		'title'        => 'Безналичный расчёт / ЕРИП (для организаций и ИП)',
		'description'  => 'Выставим счёт на оплату после согласования макета. Для юрлиц — договор, акт и ТТН.',
		'instructions' => 'Счёт на оплату придёт на ваш e-mail в течение рабочего дня.',
	) );
	update_option( 'woocommerce_cheque_settings', array( 'enabled' => 'no' ) );

	/* ---------- Атрибуты ---------- */
	$tax_mat  = exprinto_ensure_attribute( 'material', 'Материал' );
	$tax_size = exprinto_ensure_attribute( 'razmer', 'Размер' );

	/* ---------- Категории ---------- */
	$default_cat = (int) get_option( 'default_product_cat' );
	if ( $default_cat ) {
		wp_update_term( $default_cat, 'product_cat', array( 'name' => 'Без категории', 'slug' => 'bez-kategorii' ) );
	}
	$cat_ids = array();
	$order   = 0;
	foreach ( exprinto_catalog_categories() as $slug => $c ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		$args = array(
			'slug'        => $slug,
			'description' => $c['desc'],
			'parent'      => $c['parent'] && isset( $cat_ids[ $c['parent'] ] ) ? $cat_ids[ $c['parent'] ] : 0,
		);
		if ( $term ) {
			wp_update_term( $term->term_id, 'product_cat', array_merge( $args, array( 'name' => $c['name'] ) ) );
			$tid = $term->term_id;
		} else {
			$res = wp_insert_term( $c['name'], 'product_cat', $args );
			$tid = is_wp_error( $res ) ? 0 : $res['term_id'];
		}
		if ( ! $tid ) {
			continue;
		}
		$cat_ids[ $slug ] = $tid;
		update_term_meta( $tid, 'ex_title', $c['title'] );
		update_term_meta( $tid, 'ex_desc', $c['meta'] );
		update_term_meta( $tid, 'ex_seo_text', $c['seo'] );
		update_term_meta( $tid, 'order', $order++ );
		$img = exprinto_import_image( $c['image'], $c['name'] );
		if ( $img ) {
			update_term_meta( $tid, 'thumbnail_id', $img );
		}
	}

	/* ---------- Товары ---------- */
	$menu_order = 0;
	foreach ( exprinto_catalog_products() as $p ) {
		$existing = get_page_by_path( $p['slug'], OBJECT, 'product' );
		$product  = $existing ? wc_get_product( $existing->ID ) : new WC_Product_Simple();
		$product->set_name( $p['name'] );
		$product->set_slug( $p['slug'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_regular_price( $p['price'] );
		$product->set_description( $p['desc'] );
		$product->set_short_description( $p['short'] );
		$product->set_featured( ! empty( $p['featured'] ) );
		$product->set_sold_individually( false );
		$product->set_reviews_allowed( false );
		$product->set_menu_order( $menu_order++ );
		$product->set_sku( 'EXP-' . strtoupper( substr( md5( $p['slug'] ), 0, 6 ) ) );
		$product->set_category_ids( array_values( array_filter( array_map( function ( $s ) use ( $cat_ids ) { return $cat_ids[ $s ] ?? 0; }, $p['cats'] ) ) ) );
		$product->set_weight( $p['w'] * $p['h'] > 150000 ? '0.9' : '0.5' );

		// Атрибуты.
		$attrs = array();
		foreach ( array( array( $tax_mat, $p['material'] ), array( $tax_size, $p['size'] ) ) as $i => $pair ) {
			$t = term_exists( $pair[1], $pair[0] );
			if ( ! $t ) {
				$t = wp_insert_term( $pair[1], $pair[0] );
			}
			$term_id = is_array( $t ) ? (int) $t['term_id'] : (int) $t;
			$attr    = new WC_Product_Attribute();
			$attr->set_id( wc_attribute_taxonomy_id_by_name( $pair[0] ) );
			$attr->set_name( $pair[0] );
			$attr->set_options( array( $term_id ) );
			$attr->set_position( $i );
			$attr->set_visible( true );
			$attr->set_variation( false );
			$attrs[] = $attr;
		}
		$custom = new WC_Product_Attribute();
		$custom->set_name( 'Печать' );
		$custom->set_options( array( 'УФ-печать, стойкая к ультрафиолету' ) );
		$custom->set_position( 2 );
		$custom->set_visible( true );
		$attrs[] = $custom;
		$custom2 = new WC_Product_Attribute();
		$custom2->set_name( 'Комплектация' );
		$custom2->set_options( array( 'Табличка, саморезы и дюбели' ) );
		$custom2->set_position( 3 );
		$custom2->set_visible( true );
		$attrs[] = $custom2;
		$product->set_attributes( $attrs );

		// Изображения.
		$images = array();
		foreach ( $p['img'] as $n => $file ) {
			$id = exprinto_import_image( $file, $p['name'] . ( $n ? ' — размеры' : '' ), $p['name'] . ( $n ? ', чертёж с размерами' : '' ) );
			if ( $id ) {
				$images[] = $id;
			}
		}
		if ( $images ) {
			$product->set_image_id( array_shift( $images ) );
			$product->set_gallery_image_ids( $images );
		}

		$product->update_meta_data( '_ex_layout', $p['layout'] );
		$product->update_meta_data( '_ex_w', $p['w'] );
		$product->update_meta_data( '_ex_h', $p['h'] );
		$product->update_meta_data( '_ex_scheme', $p['scheme'] );
		$product->save();

		foreach ( $p['img'] as $file ) {
			$aid = exprinto_import_image( $file, $p['name'] );
			if ( $aid ) {
				wp_update_post( array( 'ID' => $aid, 'post_parent' => $product->get_id() ) );
			}
		}
	}

	/* ---------- Информационные страницы ---------- */
	$pages    = exprinto_demo_pages();
	$page_ids = array();
	foreach ( $pages as $slug => $pg ) {
		$page_ids[ $slug ] = exprinto_upsert_page( $slug, $pg['title'], $pg['content'] );
		if ( ! empty( $pg['seo_title'] ) ) {
			update_post_meta( $page_ids[ $slug ], '_ex_title', $pg['seo_title'] );
		}
		if ( ! empty( $pg['seo_desc'] ) ) {
			update_post_meta( $page_ids[ $slug ], '_ex_desc', $pg['seo_desc'] );
		}
	}
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_ids['glavnaya'] );
	update_option( 'wp_page_for_privacy_policy', $page_ids['politika-konfidencialnosti'] );
	update_option( 'woocommerce_terms_page_id', $page_ids['publichnaya-oferta'] );

	/* ---------- Меню ---------- */
	$menus = array(
		'primary' => array(
			'name'  => 'Главное меню',
			'items' => array(
				array( 'Каталог', 'page', $shop_id ),
				array( 'Конструктор', 'custom', home_url( '/#konstruktor' ) ),
				array( 'Доставка и оплата', 'page', $page_ids['dostavka-i-oplata'] ),
				array( 'Производство', 'page', $page_ids['o-proizvodstve'] ),
				array( 'Вопросы', 'page', $page_ids['voprosy-i-otvety'] ),
				array( 'Контакты', 'page', $page_ids['kontakty'] ),
			),
		),
		'footer'  => array(
			'name'  => 'Покупателям',
			'items' => array(
				array( 'Доставка и оплата', 'page', $page_ids['dostavka-i-oplata'] ),
				array( 'О производстве', 'page', $page_ids['o-proizvodstve'] ),
				array( 'Вопросы и ответы', 'page', $page_ids['voprosy-i-otvety'] ),
				array( 'Публичная оферта', 'page', $page_ids['publichnaya-oferta'] ),
				array( 'Политика конфиденциальности', 'page', $page_ids['politika-konfidencialnosti'] ),
				array( 'Контакты', 'page', $page_ids['kontakty'] ),
			),
		),
		'catalog' => array(
			'name'  => 'Каталог (подвал)',
			'items' => array(),
		),
	);
	foreach ( $cat_ids as $slug => $tid ) {
		$menus['catalog']['items'][] = array( null, 'product_cat', $tid );
	}
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	foreach ( $menus as $loc => $m ) {
		$existing = wp_get_nav_menu_object( $m['name'] );
		if ( $existing ) {
			wp_delete_nav_menu( $existing->term_id );
		}
		$menu_id = wp_create_nav_menu( $m['name'] );
		foreach ( $m['items'] as $pos => $it ) {
			$args = array( 'menu-item-status' => 'publish', 'menu-item-position' => $pos + 1 );
			if ( 'custom' === $it[1] ) {
				$args += array( 'menu-item-title' => $it[0], 'menu-item-url' => $it[2], 'menu-item-type' => 'custom' );
			} elseif ( 'product_cat' === $it[1] ) {
				$args += array( 'menu-item-object' => 'product_cat', 'menu-item-object-id' => $it[2], 'menu-item-type' => 'taxonomy' );
			} else {
				$args += array( 'menu-item-title' => $it[0], 'menu-item-object' => 'page', 'menu-item-object-id' => $it[2], 'menu-item-type' => 'post_type' );
			}
			wp_update_nav_menu_item( $menu_id, 0, $args );
		}
		$locations[ $loc ] = $menu_id;
	}
	set_theme_mod( 'nav_menu_locations', $locations );

	flush_rewrite_rules( false );
	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	update_option( 'exprinto_demo_installed', EXPRINTO_VERSION );
	return true;
}

/** Тексты информационных страниц. */
function exprinto_demo_pages() {
	return array(
		'glavnaya' => array(
			'title'     => 'Главная',
			'seo_title' => 'Адресные таблички на дом — купить в Минске с доставкой по Беларуси | Promark.by',
			'seo_desc'  => 'Адресные таблички на дом с вашим адресом: изготовление от 1 дня, УФ-печать, ПВХ и алюминиевый композит, 12 цветов. Доставка по всей Беларуси, оплата при получении.',
			'content'   => '<h2>Адресные таблички на дом в Беларуси — изготовление на собственном производстве</h2>
<p>Promark изготавливает адресные таблички, номерные знаки и таблички на подъезды для частных домов, дач, многоквартирных домов и организаций. Мы работаем по всей Беларуси: принимаем заказы онлайн, согласовываем макет в мессенджере и отправляем готовую табличку Европочтой, Белпочтой или курьером по Минску.</p>
<h3>Почему адресная табличка обязательна</h3>
<p>Адресный указатель на фасаде помогает курьерам, такси, почтальонам, гостям и — что важнее всего — скорой помощи, пожарным и милиции быстро найти нужный дом. Требование размещать номер дома и название улицы на фасаде закреплено в правилах благоустройства, которые утверждают местные исполкомы, а за его отсутствие владельцу могут вынести предписание.</p>
<h3>Из чего мы делаем таблички</h3>
<ul>
<li><strong>Вспененный ПВХ 3–4 мм</strong> — лёгкий, жёсткий и влагостойкий материал для частных домов и дач.</li>
<li><strong>Алюминиевый композит 3 мм</strong> — максимальная прочность и срок службы от 15 лет, не боится перепадов температур.</li>
<li><strong>УФ-печать</strong> — чернила полимеризуются ультрафиолетом прямо на поверхности, поэтому изображение не выгорает, не трескается на морозе и не смывается.</li>
</ul>
<h3>Сколько стоит адресная табличка</h3>
<p>Цена зависит от размера и материала: табличка с номером дома — от 29,90 руб., современная адресная табличка 590×220 мм — 42,90 руб., большая 900×270 мм — 76,90 руб. В стоимость уже входят макет, крепёж и упаковка. При заказе от 100 руб. доставка по Беларуси бесплатная.</p>
<h3>Доставка в Минск, Брест, Гродно, Гомель, Могилёв, Витебск и любой населённый пункт</h3>
<p>Отправляем заказы ежедневно. В областные центры табличка приходит за 1–2 дня, в районные города и деревни — за 2–4 дня. Оплатить можно при получении — наличными или картой.</p>',
		),
		'dostavka-i-oplata' => array(
			'title'     => 'Доставка и оплата',
			'seo_title' => 'Доставка адресных табличек по Беларуси и способы оплаты | Promark.by',
			'seo_desc'  => 'Доставка адресных табличек Европочтой, Белпочтой и курьером по Минску. Бесплатно от 100 руб. Оплата при получении, через ЕРИП или по безналичному расчёту.',
			'content'   => '<p>Мы отправляем таблички в любой город, агрогородок и деревню Беларуси. Каждая табличка упакована в защитную плёнку и жёсткий картон, поэтому доезжает без царапин и сколов.</p>
<h2>Способы доставки</h2>
<table>
<thead><tr><th>Способ</th><th>Срок</th><th>Стоимость</th></tr></thead>
<tbody>
<tr><td><strong>Европочта</strong> — до отделения в любом городе РБ</td><td>1–3 дня</td><td>4,50 руб.</td></tr>
<tr><td><strong>Белпочта</strong> — любое почтовое отделение, включая деревни</td><td>2–4 дня</td><td>4,00 руб.</td></tr>
<tr><td><strong>Курьер по Минску</strong> — до двери</td><td>в день готовности</td><td>8,00 руб.</td></tr>
<tr><td><strong>Самовывоз</strong> с производства в Минске</td><td>сразу после изготовления</td><td>бесплатно</td></tr>
</tbody>
</table>
<p><strong>Бесплатная доставка</strong> Европочтой и Белпочтой — при заказе от 100 руб.</p>
<h2>Сроки изготовления</h2>
<p>Стандартный срок — 1–2 рабочих дня после согласования макета. Срочное изготовление в день заказа возможно для Минска, если макет утверждён до 12:00.</p>
<h2>Способы оплаты</h2>
<ul>
<li><strong>При получении</strong> — наличными или банковской картой курьеру либо в отделении почты. Предоплата для частных клиентов не нужна.</li>
<li><strong>ЕРИП</strong> — по номеру заказа после согласования макета.</li>
<li><strong>Безналичный расчёт</strong> для организаций и ИП — по счёту, с договором, актом и ТТН.</li>
</ul>
<h2>Гарантия</h2>
<p>Мы даём гарантию 3 года на печать и материал. Если изображение выцвело или отслоилось в течение гарантийного срока — бесплатно изготовим новую табличку.</p>
<p>Поскольку каждая табличка изготавливается по индивидуальному заказу с вашим адресом, товар надлежащего качества возврату не подлежит. Если в табличке есть наша ошибка или брак — переделаем бесплатно.</p>',
		),
		'o-proizvodstve' => array(
			'title'     => 'О производстве',
			'seo_title' => 'Производство адресных табличек в Минске — оборудование и материалы | Promark.by',
			'seo_desc'  => 'Собственное производство адресных табличек: УФ-печать, фрезерная резка, ПВХ и алюминиевый композит. Контроль качества каждой таблички.',
			'content'   => '<p>Promark — это собственное производство полного цикла: от макета до упакованной таблички. Мы не перепродаём чужую продукцию, поэтому контролируем качество на каждом этапе и держим честные цены.</p>
<h2>Как мы делаем табличку</h2>
<ol>
<li><strong>Макет.</strong> Дизайнер проверяет правописание названия улицы, подбирает размер шрифта и выравнивает текст. Макет вы получаете на согласование.</li>
<li><strong>Печать.</strong> Печатаем на планшетном УФ-принтере: чернила застывают под ультрафиолетом за доли секунды и образуют прочный слой, стойкий к солнцу, влаге и истиранию.</li>
<li><strong>Резка.</strong> Фрезерный станок вырезает табличку точно по размеру, скругляет углы и сверлит отверстия под крепёж.</li>
<li><strong>Контроль и упаковка.</strong> Проверяем цвет, адрес и геометрию, наклеиваем защитную плёнку, комплектуем крепежом и упаковываем.</li>
</ol>
<h2>Материалы</h2>
<p><strong>Вспененный ПВХ</strong> — жёсткий пластик с закрытыми порами. Он не впитывает воду, не гниёт и не ржавеет, легко крепится к любой поверхности.</p>
<p><strong>Алюминиевый композит</strong> — «сэндвич» из двух листов алюминия и полимерного наполнителя. Используется для фасадных вывесок и служит десятилетиями.</p>
<h2>Для организаций</h2>
<p>Изготавливаем партии адресных указателей для ЖЭС, застройщиков, сельсоветов, садовых товариществ и управляющих компаний. Работаем по договору с безналичной оплатой, предоставляем полный пакет документов.</p>',
		),
		'voprosy-i-otvety' => array(
			'title'     => 'Вопросы и ответы',
			'seo_title' => 'Вопросы об адресных табличках: сроки, доставка, оплата, монтаж | Promark.by',
			'seo_desc'  => 'Ответы на частые вопросы: сколько изготавливается адресная табличка, как доставляем по Беларуси, сколько служит табличка и как её закрепить.',
			'content'   => '<p>Собрали ответы на вопросы, которые нам задают чаще всего. Не нашли свой — позвоните или напишите в Telegram, ответим в течение 15 минут.</p>',
		),
		'kontakty' => array(
			'title'     => 'Контакты',
			'seo_title' => 'Контакты — заказ адресных табличек в Минске и по Беларуси | Promark.by',
			'seo_desc'  => 'Телефоны, мессенджеры и адрес производства Promark. Принимаем заказы на адресные таблички по всей Беларуси.',
			'content'   => '<p>Принимаем заказы онлайн круглосуточно, а на звонки и сообщения отвечаем в рабочее время. Удобнее всего прислать адрес и пожелания в Viber или Telegram — пришлём макет и цену в течение 15 минут.</p>',
		),
		'publichnaya-oferta' => array(
			'title'   => 'Публичная оферта',
			'content' => '<p><em>Шаблон для заполнения. Замените текст договором публичной оферты вашей организации.</em></p>
<h2>1. Общие положения</h2>
<p>Настоящий документ является публичной офертой продавца о заключении договора розничной купли-продажи товаров дистанционным способом в соответствии с Гражданским кодексом Республики Беларусь и Законом «О защите прав потребителей».</p>
<h2>2. Предмет договора</h2>
<p>Продавец изготавливает по индивидуальному заказу покупателя адресные таблички и иные изделия и передаёт их в собственность покупателя, а покупатель принимает и оплачивает товар.</p>
<h2>3. Оформление заказа и оплата</h2>
<p>Заказ оформляется на сайте или по телефону. Цена указывается в белорусских рублях. Оплата производится при получении, через ЕРИП или безналичным расчётом.</p>
<h2>4. Доставка</h2>
<p>Условия и сроки доставки опубликованы на странице «Доставка и оплата».</p>
<h2>5. Возврат</h2>
<p>Товар, изготовленный по индивидуальному заказу, надлежащего качества возврату и обмену не подлежит. Товар ненадлежащего качества заменяется в соответствии с законодательством Республики Беларусь.</p>
<h2>6. Реквизиты продавца</h2>
<p>Наименование, УНП, юридический адрес, банковские реквизиты — укажите в «Внешний вид → Настроить → Контакты магазина».</p>',
		),
		'politika-konfidencialnosti' => array(
			'title'   => 'Политика конфиденциальности',
			'content' => '<p><em>Шаблон для заполнения. Проверьте текст на соответствие Закону Республики Беларусь «О защите персональных данных».</em></p>
<h2>Какие данные мы собираем</h2>
<p>Имя, номер телефона, адрес доставки и e-mail, которые вы указываете при оформлении заказа или заявки.</p>
<h2>Для чего</h2>
<p>Только для обработки и доставки заказа, согласования макета и связи с вами по заказу. Мы не передаём данные третьим лицам, кроме служб доставки в объёме, необходимом для доставки.</p>
<h2>Хранение и удаление</h2>
<p>Данные хранятся в течение срока, необходимого для исполнения заказа и требований законодательства. Вы можете запросить изменение или удаление своих данных, написав нам на e-mail.</p>',
		),
	);
}
