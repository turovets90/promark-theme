<?php
/**
 * Каталог Promark: таблички с объёмными буквами из зеркального акрила и с УФ-печатью.
 * exprinto_catalog_v2_install() — заменяет старые тестовые товары новыми.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

function exprinto_v2_categories() {
	return array(
		'adresnye-tablichki' => array(
			'name'   => 'Адресные таблички',
			'parent' => '',
			'image'  => 'v2-modern-acryl-900x270-1.jpg',
			'desc'   => 'Адресные таблички на дом с названием улицы и номером: объёмные буквы из зеркального акрила или стойкая УФ-печать на алюминиевом композите. Изготовление за 1–3 дня, доставка по всей Беларуси.',
			'title'  => 'Адресные таблички на дом — купить в Минске и по Беларуси | Promark.by',
			'meta'   => 'Адресные таблички на дом с объёмными зеркальными буквами и УФ-печатью. Алюминиевый композит, фигурные формы, любой цвет. Доставка по Беларуси.',
			'seo'    => '<h2>Какую адресную табличку выбрать</h2>
<p><strong>С объёмными буквами из зеркального акрила</strong> — это табличка-украшение фасада. Буквы и цифры вырезаются лазером из акрила с зеркальным серебряным или золотым покрытием и наклеиваются на основу из алюминиевого композита. Они отбрасывают тень, играют на солнце и хорошо видны в свете фар.</p>
<p><strong>С УФ-печатью</strong> — практичный и доступный вариант. Изображение печатается прямо на алюминиевом композите или пластике ультрафиолетовыми чернилами, которые не выгорают и не смываются.</p>
<h3>Форма и размер</h3>
<p>Прямоугольные таблички «Модерн» подходят к современной архитектуре, фигурные «Волна», «Купол», «Герб» и «Ажур» — к классическим и загородным домам. Для узких простенков и столбов ворот есть вертикальная табличка. Размер любой табличке подберём под ваш фасад.</p>',
		),
		'tablichki-obemnye-bukvy' => array(
			'name'   => 'С объёмными буквами из акрила',
			'parent' => 'adresnye-tablichki',
			'image'  => 'v2-wave-blue-1.jpg',
			'desc'   => 'Адресные таблички с объёмными буквами из зеркального акрила (серебро или золото) на основе из алюминиевого композита. Фигурная резка, любой цвет основы.',
			'title'  => 'Адресные таблички с объёмными буквами из зеркального акрила | Promark.by',
			'meta'   => 'Таблички на дом с объёмными буквами из зеркального акрила: серебро и золото, основа из алюминиевого композита, фигурная форма. Доставка по Беларуси.',
			'seo'    => '<h2>Объёмные буквы из зеркального акрила</h2>
<p>Каждая буква и цифра вырезается лазером из листового акрила с зеркальным покрытием и крепится к основе на влагостойкий клей. Объём 3 мм создаёт тень и делает адрес читаемым даже в пасмурную погоду, а зеркальная поверхность отражает свет фар и фонарей.</p>
<p>Основа — алюминиевый композит 3 мм: он не ржавеет, не гнётся и не боится мороза. Цвет основы и букв вы выбираете сами — превью обновляется сразу на странице товара.</p>',
		),
		'tablichki-uf-pechat' => array(
			'name'   => 'С УФ-печатью',
			'parent' => 'adresnye-tablichki',
			'image'  => 'v2-ornate-blue-1.jpg',
			'desc'   => 'Адресные таблички из алюминиевого композита с УФ-печатью: не выгорают на солнце, не боятся влаги и мороза. Классические и фигурные формы.',
			'title'  => 'Адресные таблички с УФ-печатью из алюминиевого композита | Promark.by',
			'meta'   => 'Адресные таблички из алюминиевого композита с УФ-печатью, которая не выгорает. Фигурные и прямоугольные, 12 цветов. Изготовление 1–2 дня.',
			'seo'    => '<h2>УФ-печать: яркость на годы</h2>
<p>УФ-чернила застывают под ультрафиолетом прямо на поверхности композита и образуют прочный слой, устойчивый к солнцу, дождю, морозу и мойке. Табличка остаётся контрастной и читаемой много лет.</p>',
		),
		'nomera-domov' => array(
			'name'   => 'Номерные знаки на дом',
			'parent' => '',
			'image'  => 'v2-house-black-1.jpg',
			'desc'   => 'Таблички с номером дома для фасада, ворот и калитки.',
			'title'  => 'Номерные знаки и таблички с номером дома — купить в Беларуси | Promark.by',
			'meta'   => 'Таблички с номером дома любого размера для фасада, ворот и калитки. УФ-печать, изготовление 1–2 дня, доставка по Беларуси.',
			'seo'    => '<h2>Номер дома, который видно издалека</h2><p>Отдельный номерной знак удобно повесить на ворота или калитку, если основная адресная табличка висит на фасаде. Крупные цифры с засечками читаются с 20–25 метров.</p>',
		),
	);
}

function exprinto_v2_products() {
	$size_price = '
<h3>Размер и цена</h3>
<p>Размер таблички может быть любым — сделаем под ваш фасад, ворота или столб. Цена зависит от размера, формы и технологии, поэтому мы озвучим её после просчёта заказа: оставьте заявку на этой странице, и мы перезвоним в течение 15 минут в рабочее время.</p>';

	$acryl_tail = $size_price . '
<h3>Почему объёмные буквы из акрила</h3>
<ul>
<li><strong>Эффектно днём и ночью.</strong> Зеркальная поверхность отражает солнце, фонари и свет фар — адрес видно даже в темноте.</li>
<li><strong>Долговечно.</strong> Основа — алюминиевый композит 3 мм: не ржавеет, не гнётся, не боится мороза до −40 °C и жары.</li>
<li><strong>Точно.</strong> Буквы и цифры вырезаются лазером с точностью до десятой миллиметра, кромки ровные и гладкие.</li>
<li><strong>Индивидуально.</strong> Цвет основы — графит, чёрный, коричневый, синий, зелёный, бордовый или белый; буквы — зеркальное серебро или золото.</li>
</ul>
<h3>Что входит в заказ</h3>
<ul>
<li>Табличка с вашим адресом и объёмными буквами</li>
<li>Защитная плёнка и жёсткая упаковка</li>
<li>Крепёж: саморезы и дюбели (или скрытый крепёж — по запросу)</li>
<li>Бесплатный макет на согласование</li>
</ul>
<h3>Как заказать</h3>
<p>Впишите название улицы и номер дома, выберите цвета — превью обновится сразу. Оставьте телефон и нажмите «Рассчитать стоимость»: мы перезвоним, назовём цену и пришлём макет в Viber, Telegram или на e-mail. После согласования изготовим табличку за 2–3 рабочих дня и отправим в любой город Беларуси.</p>';

	$print_tail = $size_price . '
<h3>Почему УФ-печать на композите</h3>
<ul>
<li><strong>Не выгорает.</strong> УФ-чернила застывают прямо на поверхности и не боятся солнца, дождя и мороза.</li>
<li><strong>Прочная основа.</strong> Алюминиевый композит — два листа алюминия с наполнителем: не ржавеет и не деформируется.</li>
<li><strong>Любой цвет.</strong> 12 готовых сочетаний или цвет по образцу исполкома.</li>
</ul>
<h3>Что входит в заказ</h3>
<ul>
<li>Табличка с вашим адресом</li>
<li>Отверстия под крепёж, саморезы и дюбели</li>
<li>Бесплатный макет на согласование</li>
</ul>
<h3>Как заказать</h3>
<p>Введите адрес, выберите цвет и оставьте заявку на расчёт. Мы перезвоним и назовём цену, а после согласования макета изготовим табличку за 1–2 рабочих дня и отправим Европочтой, Белпочтой или курьером. Оплата при получении.</p>';

	$acryl_short = function ( $base ) {
		return '<ul><li>Объёмные буквы из акрила с зеркальным серебром (или золотом)</li><li>Основа — алюминиевый композит, ' . $base . '</li><li>Любой размер под ваш фасад, крепёж в комплекте</li><li>Цену назовём после просчёта заказа</li></ul>';
	};
	$print_short = function ( $mat ) {
		return '<ul><li>УФ-печать — не выгорает на солнце</li><li>' . $mat . '</li><li>Любой размер, отверстия и крепёж в комплекте</li><li>Цену назовём после просчёта заказа</li></ul>';
	};

	return array(
		array(
			'slug' => 'adresnaya-tablichka-modern-obemnye-bukvy-grafit', 'old_slug' => 'adresnaya-tablichka-obemnye-bukvy-900x270-grafit', 'style' => '«Модерн»',
			'name' => 'Адресная табличка «Модерн» с объёмными буквами из зеркального акрила, графит',
			'price' => '238.34', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => true,
			'cfg' => array( 'layout' => 'line', 'w' => 900, 'h' => 270, 'finish' => 'mirror', 'base' => 'graphite', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '900×270 мм', 'img' => 'v2-modern-acryl-900x270',
			'short' => $acryl_short( 'графитовый цвет' ),
			'desc' => '<p>Большая адресная табличка в современном стиле: «улица» в плашке, название под тонкой линией и крупный номер справа. Все надписи — объёмные, из акрила с зеркальным серебром, на основе из алюминиевого композита графитового цвета. Такая табличка становится акцентом фасада и хорошо видна с дороги.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/1fCddp3',
		),
		array(
			'slug' => 'adresnaya-tablichka-kupol-obemnye-bukvy-korichnevaya', 'old_slug' => 'adresnaya-tablichka-obemnye-bukvy-620x380-korichnevaya', 'style' => '«Купол»',
			'name' => 'Адресная табличка «Купол» с объёмными буквами из зеркального акрила, коричневая',
			'price' => '218.50', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => true,
			'cfg' => array( 'layout' => 'arch', 'w' => 620, 'h' => 380, 'finish' => 'mirror', 'base' => 'brown', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '620×380 мм', 'img' => 'v2-arch-brown',
			'short' => $acryl_short( 'коричневый цвет' ),
			'desc' => '<p>Классическая табличка с куполом: номер дома в верхней арке, название улицы — крупно в центральной полосе, «улица» — в нижнем выступе. Шрифт с засечками и зеркальная рамка по контуру придают табличке солидный, «усадебный» вид. Идеальна для домов из кирпича, дерева и с отделкой под камень.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/AxdWAgz',
		),
		array(
			'slug' => 'adresnaya-tablichka-gerb-obemnye-bukvy-korichnevaya', 'old_slug' => 'adresnaya-tablichka-obemnye-bukvy-590x330-korichnevaya', 'style' => '«Герб»',
			'name' => 'Адресная табличка «Герб» с объёмными буквами из зеркального акрила, коричневая',
			'price' => '194.70', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => false,
			'cfg' => array( 'layout' => 'crest', 'w' => 590, 'h' => 330, 'finish' => 'mirror', 'base' => 'brown', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '590×330 мм', 'img' => 'v2-crest-brown',
			'short' => $acryl_short( 'коричневый цвет' ),
			'desc' => '<p>Табличка в форме герба: «улица» в верхней вкладке, название — в центральной полосе с фигурными концами, номер дома — в нижнем медальоне. Симметричная композиция и зеркальная рамка смотрятся нарядно и торжественно.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/j7qKGUX',
		),
		array(
			'slug' => 'vertikalnaya-tablichka-nomer-doma-obemnye-cifry-grafit', 'old_slug' => 'adresnaya-tablichka-obemnye-bukvy-220x700-vertikalnaya', 'style' => '«Вертикаль»',
			'name' => 'Вертикальная табличка с номером дома, объёмные цифры из зеркального акрила, графит',
			'price' => '156.92', 'cats' => array( 'tablichki-obemnye-bukvy', 'nomera-domov' ), 'featured' => true,
			'cfg' => array( 'layout' => 'vertical', 'w' => 220, 'h' => 700, 'finish' => 'mirror', 'base' => 'graphite', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '220×700 мм', 'img' => 'v2-vertical-graphite',
			'short' => $acryl_short( 'графитовый цвет' ),
			'desc' => '<p>Узкая вертикальная табличка для столба ворот, простенка у входной двери или колонны. Цифры номера дома расположены одна под другой — крупно и стильно. По желанию добавим внизу название улицы. Крепится на дистанционные держатели, которые «отрывают» табличку от стены.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/4KpD3zR',
		),
		array(
			'slug' => 'adresnaya-tablichka-domovoy-znak-uf-pechat-belo-seraya', 'old_slug' => 'adresnaya-tablichka-900x270-uf-pechat-belo-seraya', 'style' => '«Модерн»',
			'name' => 'Адресная табличка «Домовой знак», бело-серая, алюминиевый композит, УФ-печать',
			'price' => '126.46', 'cats' => array( 'tablichki-uf-pechat' ), 'featured' => true,
			'cfg' => array( 'layout' => 'line', 'w' => 900, 'h' => 270, 'finish' => 'print', 'scheme' => 'white-graphite' ),
			'material' => 'Алюминиевый композит 3 мм', 'size' => '900×270 мм', 'img' => 'v2-modern-print-900x270',
			'short' => $print_short( 'Алюминиевый композит 3 мм' ),
			'desc' => '<p>Большая адресная табличка в лаконичном стиле: крупный номер справа, тип улицы в плашке и название под тонкой линией. Крупный номер читается с 30 метров. Основа — алюминиевый композит, изображение нанесено УФ-печатью.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/RhUeIZP',
		),
		array(
			'slug' => 'adresnaya-tablichka-azhur-uf-pechat-sinyaya', 'old_slug' => 'adresnaya-tablichka-700x290-uf-pechat-sinyaya', 'style' => '«Ажур»',
			'name' => 'Адресная табличка «Ажур», синяя, алюминиевый композит, УФ-печать',
			'price' => '122.34', 'cats' => array( 'tablichki-uf-pechat' ), 'featured' => true,
			'cfg' => array( 'layout' => 'ornate', 'w' => 700, 'h' => 290, 'finish' => 'print', 'scheme' => 'blue-white' ),
			'material' => 'Алюминиевый композит 3 мм', 'size' => '700×290 мм', 'img' => 'v2-ornate-blue',
			'short' => $print_short( 'Фигурная резка, алюминиевый композит 3 мм' ),
			'desc' => '<p>Фигурная табличка с завитками по краям — классический городской стиль. «Улица», название и номер дома расположены по центру, по контуру — декоративная рамка. Синий фон и белые буквы — привычная и хорошо читаемая пара.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/9oyrc62',
		),
		array(
			'slug' => 'adresnaya-tablichka-gerb-uf-pechat-zelenaya', 'old_slug' => 'adresnaya-tablichka-590x330-uf-pechat-zelenaya', 'style' => '«Герб»',
			'name' => 'Адресная табличка «Герб», зелёная, алюминиевый композит, УФ-печать',
			'price' => '117.16', 'cats' => array( 'tablichki-uf-pechat' ), 'featured' => false,
			'cfg' => array( 'layout' => 'crest', 'w' => 590, 'h' => 330, 'finish' => 'print', 'scheme' => 'green-white', 'font' => 'cond' ),
			'material' => 'Алюминиевый композит 3 мм', 'size' => '590×330 мм', 'img' => 'v2-crest-green',
			'short' => $print_short( 'Фигурная резка, алюминиевый композит 3 мм' ),
			'desc' => '<p>Фигурная табличка «Герб» в благородном зелёном цвете: «улица» в верхней вкладке, название в центральной полосе и номер дома в медальоне. Строгий узкий шрифт хорошо читается издалека.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/pHvXy5e',
		),
		array(
			'slug' => 'tablichka-nomer-doma-domovoy-znak-chernaya', 'old_slug' => 'tablichka-nomer-doma-250x250-chernaya', 'style' => '«Домовой знак»',
			'name' => 'Табличка с номером дома «Домовой знак», чёрная, пластик, УФ-печать',
			'price' => '37.75', 'cats' => array( 'nomera-domov' ), 'featured' => true,
			'cfg' => array( 'layout' => 'house', 'w' => 250, 'h' => 250, 'finish' => 'print', 'scheme' => 'black-white' ),
			'material' => 'Пластик ПВХ 3 мм', 'size' => '250×250 мм', 'img' => 'v2-house-black',
			'short' => $print_short( 'Пластик ПВХ 3 мм — лёгкий и влагостойкий' ),
			'desc' => '<p>Квадратный номерной знак с крупными цифрами с засечками и декоративной рамкой. Повесьте его на ворота, калитку или второй фасад — номер дома будет виден с улицы. По желанию добавим надпись сверху и название улицы снизу.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/CrTLccL',
		),
	);
}

/** Установка нового каталога. Старые тестовые товары и категории удаляются. */
function exprinto_catalog_v2_install() {
	@set_time_limit( 300 ); // phpcs:ignore
	$tax_mat  = exprinto_ensure_attribute( 'material', 'Материал' );
	$tax_size = exprinto_ensure_attribute( 'razmer', 'Размер' );
	$new      = wp_list_pluck( exprinto_v2_products(), 'slug' );

	// 1. Удаляем старые товары.
	foreach ( get_posts( array( 'post_type' => 'product', 'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids' ) ) as $pid ) {
		if ( ! in_array( get_post_field( 'post_name', $pid ), $new, true ) ) {
			foreach ( get_attached_media( 'image', $pid ) as $att ) {
				wp_delete_attachment( $att->ID, true );
			}
			wp_delete_post( $pid, true );
		}
	}
	// 2. Старые категории.
	foreach ( array( 'sovremennye-tablichki', 'klassicheskie-tablichki', 'tablichki-na-podezd' ) as $slug ) {
		$t = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $t ) {
			wp_delete_term( $t->term_id, 'product_cat' );
		}
	}

	// 3. Категории.
	$cat_ids = array();
	$order   = 0;
	foreach ( exprinto_v2_categories() as $slug => $c ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		$args = array( 'slug' => $slug, 'description' => $c['desc'], 'parent' => $c['parent'] && isset( $cat_ids[ $c['parent'] ] ) ? $cat_ids[ $c['parent'] ] : 0 );
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

	// 4. Товары.
	$menu_order = 0;
	foreach ( exprinto_v2_products() as $p ) {
		$existing = get_page_by_path( $p['slug'], OBJECT, 'product' );
		$product  = $existing ? wc_get_product( $existing->ID ) : new WC_Product_Simple();
		$product->set_name( $p['name'] );
		$product->set_slug( $p['slug'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_regular_price( $p['price'] );
		$product->set_sale_price( '' );
		$product->set_description( $p['desc'] );
		$product->set_short_description( $p['short'] );
		$product->set_featured( ! empty( $p['featured'] ) );
		$product->set_reviews_allowed( false );
		$product->set_menu_order( $menu_order++ );
		$product->set_sku( 'PM-' . strtoupper( substr( md5( $p['slug'] ), 0, 6 ) ) );
		$product->set_category_ids( array_values( array_filter( array_map( function ( $s ) use ( $cat_ids ) { return $cat_ids[ $s ] ?? 0; }, $p['cats'] ) ) ) );
		$product->set_weight( $p['cfg']['w'] * $p['cfg']['h'] > 150000 ? '1.2' : '0.6' );

		$attrs = array();
		foreach ( array( array( $tax_mat, $p['material'] ), array( $tax_size, $p['size'] ) ) as $i => $pair ) {
			$t = term_exists( $pair[1], $pair[0] );
			if ( ! $t ) {
				$t = wp_insert_term( $pair[1], $pair[0] );
			}
			$attr = new WC_Product_Attribute();
			$attr->set_id( wc_attribute_taxonomy_id_by_name( $pair[0] ) );
			$attr->set_name( $pair[0] );
			$attr->set_options( array( is_array( $t ) ? (int) $t['term_id'] : (int) $t ) );
			$attr->set_position( $i );
			$attr->set_visible( true );
			$attrs[] = $attr;
		}
		$extra = 'mirror' === $p['cfg']['finish']
			? array( 'Технология' => 'Объёмные буквы из акрила, лазерная резка', 'Цвет букв' => 'Зеркальное серебро или золото', 'Комплектация' => 'Табличка, саморезы и дюбели' )
			: array( 'Технология' => 'УФ-печать, стойкая к ультрафиолету', 'Комплектация' => 'Табличка, саморезы и дюбели' );
		$pos = 2;
		foreach ( $extra as $label => $val ) {
			$a = new WC_Product_Attribute();
			$a->set_name( $label );
			$a->set_options( array( $val ) );
			$a->set_position( $pos++ );
			$a->set_visible( true );
			$attrs[] = $a;
		}
		$product->set_attributes( $attrs );

		$images = array();
		foreach ( array( '-1.jpg', '-2.jpg', '-3.jpg' ) as $k => $suffix ) {
			$file = $p['img'] . $suffix;
			$alt  = $p['name'] . ( 1 === $k ? ' — чертёж с размерами' : ( 2 === $k ? ' — варианты цвета' : '' ) );
			$id   = exprinto_import_image( $file, $alt, $alt );
			if ( $id ) {
				$images[] = $id;
			}
		}
		if ( $images ) {
			$product->set_image_id( array_shift( $images ) );
			$product->set_gallery_image_ids( $images );
		}

		foreach ( array( 'layout', 'w', 'h', 'finish', 'scheme', 'base', 'metal', 'font' ) as $k ) {
			$product->update_meta_data( '_ex_' . $k, $p['cfg'][ $k ] ?? '' );
		}
		$product->update_meta_data( '_ex_style', $p['style'] );
		$product->update_meta_data( '_ex_ozon', $p['ozon'] );
		$product->save();
		foreach ( array_merge( array( $product->get_image_id() ), $product->get_gallery_image_ids() ) as $aid ) {
			if ( $aid ) {
				wp_update_post( array( 'ID' => $aid, 'post_parent' => $product->get_id() ) );
			}
		}
	}

	// 5. Тексты, где упоминались старые цены.
	$shop_id = wc_get_page_id( 'shop' );
	update_post_meta( $shop_id, '_ex_desc', 'Каталог адресных табличек с объёмными буквами из зеркального акрила и УФ-печатью. Цены от 37,75 руб., доставка Европочтой и Белпочтой по всей Беларуси.' );
	$front = (int) get_option( 'page_on_front' );
	if ( $front ) {
		$c = get_post_field( 'post_content', $front );
		$c = preg_replace( '#<h3>Из чего мы делаем таблички</h3>.*?</ul>#su', '<h3>Из чего мы делаем таблички</h3>
<ul>
<li><strong>Алюминиевый композит 3 мм</strong> — основа большинства наших табличек: два листа алюминия с полимерным наполнителем. Не ржавеет, не гнётся и служит 15 лет и больше.</li>
<li><strong>Объёмные буквы из зеркального акрила</strong> — вырезаются лазером, бывают серебряными и золотыми и отражают свет фар.</li>
<li><strong>УФ-печать</strong> — чернила полимеризуются ультрафиолетом прямо на поверхности, поэтому изображение не выгорает, не трескается на морозе и не смывается.</li>
</ul>', $c );
		$c = preg_replace( '#<p>Цена зависит от размера и материала:.*?</p>#su', '<p>Цена зависит от размера, формы и технологии: табличка с номером дома — от 37,75 руб., адресная табличка с УФ-печатью — от 117,16 руб., с объёмными буквами из зеркального акрила — от 156,92 руб. В стоимость уже входят макет, крепёж и упаковка. При заказе от 100 руб. доставка по Беларуси бесплатная.</p>', $c );
		wp_update_post( array( 'ID' => $front, 'post_content' => $c ) );
		update_post_meta( $front, '_ex_desc', 'Адресные таблички на дом с объёмными буквами из зеркального акрила и УФ-печатью. Алюминиевый композит, фигурные формы, любой цвет. Доставка по Минску и всей Беларуси.' );
	}

	// 6. Меню каталога в подвале.
	$menu = wp_get_nav_menu_object( 'Каталог (подвал)' );
	if ( $menu ) {
		foreach ( wp_get_nav_menu_items( $menu->term_id ) as $item ) {
			wp_delete_post( $item->ID, true );
		}
		$pos = 1;
		foreach ( $cat_ids as $tid ) {
			wp_update_nav_menu_item( $menu->term_id, 0, array( 'menu-item-object' => 'product_cat', 'menu-item-object-id' => $tid, 'menu-item-type' => 'taxonomy', 'menu-item-status' => 'publish', 'menu-item-position' => $pos++ ) );
		}
	}

	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	update_option( 'exprinto_catalog_version', 2 );
	return true;
}

/**
 * v4: сняты с продажи две модели «Волна» 630×360 (синяя и коричневая).
 * Товары перемещаются в корзину (их можно восстановить в админке: Товары → Корзина),
 * а их адреса навсегда (301) перенаправляются в раздел «С объёмными буквами из акрила».
 */
function exprinto_removed_products() {
	return array(
		'adresnaya-tablichka-obemnye-bukvy-630x360-sinyaya',
		'adresnaya-tablichka-obemnye-bukvy-630x360-korichnevaya',
	);
}

add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 4 ) {
		return;
	}
	foreach ( exprinto_removed_products() as $slug ) {
		$post = get_page_by_path( $slug, OBJECT, 'product' );
		if ( $post && 'trash' !== $post->post_status ) {
			wp_trash_post( $post->ID );
		}
	}
	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	update_option( 'exprinto_catalog_version', 4 );
}, 20 );

/**
 * v5: размеры и цены убраны из товаров. Названия и адреса без размеров,
 * описание «Размер и цена», цены удалены, характеристика «Размер» и чертежи с размерами — из галерей.
 */
add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 5 || ! function_exists( 'wc_get_product' ) ) {
		return;
	}
	@set_time_limit( 120 ); // phpcs:ignore
	foreach ( exprinto_v2_products() as $p ) {
		$post = get_page_by_path( $p['old_slug'] ?? $p['slug'], OBJECT, 'product' );
		if ( ! $post ) {
			$post = get_page_by_path( $p['slug'], OBJECT, 'product' );
		}
		if ( ! $post ) {
			continue;
		}
		$product = wc_get_product( $post->ID );
		if ( ! $product ) {
			continue;
		}
		$product->set_name( $p['name'] );
		$product->set_slug( $p['slug'] );
		$product->set_short_description( $p['short'] );
		$product->set_description( $p['desc'] );
		$product->set_regular_price( '' );
		$product->set_sale_price( '' );
		$product->set_price( '' );

		// Характеристика «Размер» — убрать.
		$attrs = $product->get_attributes();
		unset( $attrs['pa_razmer'] );
		$product->set_attributes( $attrs );

		// Чертёж с размерами (вторая картинка) — убрать из галереи; подписи картинок — по новому названию.
		$gallery = array();
		foreach ( $product->get_gallery_image_ids() as $aid ) {
			$file = (string) get_post_meta( $aid, '_wp_attached_file', true );
			if ( preg_match( '/-2(-\d+)?\.(jpe?g|png|webp)$/i', $file ) ) {
				continue;
			}
			$gallery[] = $aid;
		}
		$product->set_gallery_image_ids( $gallery );
		$product->delete_meta_data( '_ex_price_mirror' );
		$product->delete_meta_data( '_ex_price_print' );
		$product->save();

		$imgs = array_merge( array( $product->get_image_id() ), $gallery );
		foreach ( array_values( array_filter( $imgs ) ) as $k => $aid ) {
			$alt = $p['name'] . ( $k ? ' — варианты цвета' : '' );
			update_post_meta( $aid, '_wp_attachment_image_alt', $alt );
			wp_update_post( array( 'ID' => $aid, 'post_title' => $alt ) );
		}
	}

	// Атрибут «Размер» больше не нужен.
	if ( function_exists( 'wc_attribute_taxonomy_id_by_name' ) && function_exists( 'wc_delete_attribute' ) ) {
		$aid = wc_attribute_taxonomy_id_by_name( 'pa_razmer' );
		if ( $aid ) {
			wc_delete_attribute( $aid );
		}
	}

	// Тексты категорий.
	foreach ( exprinto_v2_categories() as $slug => $c ) {
		$t = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $t ) {
			update_term_meta( $t->term_id, 'ex_desc', $c['meta'] );
			update_term_meta( $t->term_id, 'ex_seo_text', $c['seo'] );
		}
	}

	// Цены в текстах страниц.
	$shop_id = wc_get_page_id( 'shop' );
	if ( $shop_id > 0 ) {
		update_post_meta( $shop_id, '_ex_desc', 'Каталог адресных табличек с объёмными буквами из зеркального акрила и УФ-печатью. Любой размер под ваш фасад, расчёт стоимости за 15 минут, доставка по всей Беларуси.' );
	}
	$pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1 ) );
	foreach ( $pages as $pg ) {
		$c = $pg->post_content;
		$n = preg_replace( '#<p>Цена зависит от размера[^<]*</p>#u', '<p>Размер таблички может быть любым — сделаем под ваш фасад, ворота или столб. Стоимость зависит от размера, формы и технологии, поэтому точную цену мы назовём после просчёта заказа. В неё уже входят макет, крепёж и упаковка, а при заказе от 100 руб. доставка по Беларуси бесплатная.</p>', $c );
		if ( $n !== $c ) {
			wp_update_post( array( 'ID' => $pg->ID, 'post_content' => $n ) );
		}
	}

	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	flush_rewrite_rules( false );
	update_option( 'exprinto_catalog_version', 5 );
}, 25 );

/** Старые адреса товаров → новые (301). Снятые с продажи — в раздел каталога. */
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ), '/' ); // phpcs:ignore
	$slug = preg_replace( '/__trashed$/', '', basename( $path ) );
	if ( in_array( $slug, exprinto_removed_products(), true ) ) {
		$term = get_term_by( 'slug', 'tablichki-obemnye-bukvy', 'product_cat' );
		$link = $term ? get_term_link( $term ) : '';
		wp_safe_redirect( $link && ! is_wp_error( $link ) ? $link : home_url( '/katalog/' ), 301 );
		exit;
	}
	foreach ( exprinto_v2_products() as $p ) {
		if ( isset( $p['old_slug'] ) && $p['old_slug'] === $slug ) {
			$post = get_page_by_path( $p['slug'], OBJECT, 'product' );
			if ( $post && 'publish' === $post->post_status ) {
				wp_safe_redirect( get_permalink( $post ), 301 );
				exit;
			}
		}
	}
}, 5 );

/** v6: заголовок каталога без слова «цены». */
add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 6 || ! function_exists( 'wc_get_page_id' ) ) {
		return;
	}
	$shop_id = wc_get_page_id( 'shop' );
	if ( $shop_id > 0 ) {
		update_post_meta( $shop_id, '_ex_title', 'Каталог адресных табличек и номерных знаков на заказ — любой размер, доставка по Беларуси | Promark.by' );
	}
	foreach ( get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false ) ) as $t ) {
		$title = (string) get_term_meta( $t->term_id, 'ex_title', true );
		if ( preg_match( '/цен[аы]/ui', $title ) ) {
			update_term_meta( $t->term_id, 'ex_title', preg_replace( '/\s*—\s*цен[аы][^|]*/ui', ' — на заказ', $title ) );
		}
	}
	update_option( 'exprinto_catalog_version', 6 );
}, 26 );

/* -------------------------------------------------------------------------
 * v7: три новые модели — «Премиум» (объёмные), «Лофт» (врезные), «Рондо» (объёмные + врезные)
 * ---------------------------------------------------------------------- */

function exprinto_v7_category() {
	return array(
		'slug'   => 'tablichki-vreznye-simvoly',
		'name'   => 'С врезными символами',
		'parent' => 'adresnye-tablichki',
		'image'  => 'v3-loft-inlay-black-1.jpg',
		'desc'   => 'Адресные таблички с врезными символами: буквы и цифры прорезаны в основе из алюминиевого композита, а под ними — зеркальный акрил золотого или серебряного цвета.',
		'title'  => 'Адресные таблички с врезными символами на заказ | Promark.by',
		'meta'   => 'Адресные таблички с врезными буквами и цифрами: прорезь в композите и зеркальный акрил под ней. Любой размер и цвет, расчёт за 15 минут, доставка по Беларуси.',
		'seo'    => '<h2>Что такое врезные символы</h2>
<p>Буквы и цифры не наклеиваются сверху, а прорезаются лазером в лицевом слое таблички. Под прорезью — лист зеркального акрила, поэтому символы мягко блестят изнутри, а поверхность остаётся идеально ровной. Такую табличку легко мыть, с неё нечему отклеиться, и она выглядит строго и дорого.</p>
<p>Основа — алюминиевый композит любого цвета, подложка — зеркальное золото или серебро, белый или чёрный акрил. Размер подбираем под фасад, цену называем после расчёта.</p>',
	);
}

function exprinto_v7_products() {
	$size_price = '
<h3>Размер и цена</h3>
<p>Размер таблички может быть любым — сделаем под ваш фасад, ворота или столб. Цена зависит от размера, формы и технологии, поэтому мы озвучим её после просчёта заказа: оставьте заявку на этой странице, и мы перезвоним в течение 15 минут в рабочее время.</p>';
	$how = '
<h3>Как заказать</h3>
<p>Впишите название улицы и номер дома, выберите цвета — превью обновится сразу. Оставьте телефон и нажмите «Рассчитать стоимость»: мы перезвоним, назовём цену и пришлём макет в Viber, Telegram или на e-mail. После согласования изготовим табличку за 2–3 рабочих дня и отправим в любой город Беларуси.</p>';
	$mat = 'Алюминиевый композит + зеркальный акрил';
	return array(
		array(
			'slug'  => 'adresnaya-tablichka-premium-obemnye-bukvy-chernaya',
			'style' => '«Премиум»',
			'name'  => 'Адресная табличка «Премиум» с объёмными буквами на акриловом стекле, чёрная',
			'cfg'   => array( 'layout' => 'premium', 'w' => 600, 'h' => 380, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'black', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats'  => array( 'adresnye-tablichki', 'tablichki-obemnye-bukvy' ),
			'img'   => 'v3-premium-black',
			'material' => $mat,
			'tech'  => array( 'Технология' => 'Объёмные буквы из акрила, лазерная резка', 'Подложка' => 'Прозрачное акриловое стекло', 'Цвет букв' => 'Зеркальное серебро, золото, белый или чёрный акрил', 'Крепление' => 'Дистанционные держатели из нержавеющей стали' ),
			'short' => '<ul><li>Объёмные буквы и цифры из зеркального акрила</li><li>Табличка на прозрачном акриловом стекле и держателях</li><li>Любой размер под ваш фасад</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc'  => '<p>Строгая табличка для современного дома: крупный номер с засечками и адрес капителью под ним. Объёмные буквы из зеркального акрила лежат на тёмной основе из алюминиевого композита, а вся табличка закреплена на прозрачном акриловом стекле — из-за этого она словно парит над стеной.</p>' . $size_price . '
<h3>Почему эта табличка выглядит дорого</h3>
<ul>
<li><strong>Три слоя.</strong> Стекло, основа и объёмные буквы дают глубину и игру света — табличка заметна и днём, и в свете фонаря.</li>
<li><strong>Дистанционные держатели.</strong> Табличка отстоит от стены на 1,5–2 см, поэтому за ней не скапливается вода и грязь.</li>
<li><strong>Любые цвета.</strong> Основа — чёрный, графит, синий, зелёный и ещё 5 цветов; буквы — серебро, золото, белый или чёрный акрил.</li>
<li><strong>Не боится погоды.</strong> Композит не ржавеет и не гнётся, акрил выдерживает мороз до −40 °C и солнце.</li>
</ul>' . $how,
		),
		array(
			'slug'  => 'adresnaya-tablichka-loft-vreznye-simvoly-chernaya',
			'style' => '«Лофт»',
			'name'  => 'Адресная табличка «Лофт» с врезными символами, чёрная с золотом',
			'cfg'   => array( 'layout' => 'loft', 'w' => 600, 'h' => 300, 'finish' => 'inlay', 'finishes' => 'inlay,mirror', 'base' => 'black', 'metal' => 'gold', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats'  => array( 'adresnye-tablichki', 'tablichki-vreznye-simvoly' ),
			'img'   => 'v3-loft-inlay-black',
			'material' => $mat,
			'tech'  => array( 'Технология' => 'Врезные символы: лазерная прорезь в композите + зеркальный акрил под ней', 'Цвет символов' => 'Зеркальное золото, серебро, белый или чёрный акрил', 'Крепление' => '4 декоративных держателя' ),
			'short' => '<ul><li>Буквы и цифры прорезаны в основе, под ними — зеркальный акрил</li><li>Ровная поверхность: нечему отклеиться, легко мыть</li><li>Любой размер и цвет основы</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc'  => '<p>Минималистичная табличка в стиле лофт: крупный номер, тонкая линия и адрес под ней. Символы не наклеены, а прорезаны лазером в лицевом слое из алюминиевого композита — сквозь прорезь блестит зеркальный акрил. Получается благородный «утопленный» эффект, как у дорогих табличек из металла.</p>' . $size_price . '
<h3>Почему врезные символы</h3>
<ul>
<li><strong>Ничего не отклеится.</strong> Символы — часть таблички, а не накладка, поэтому их не сорвёт ветром и не повредит при мытье.</li>
<li><strong>Аккуратный блеск.</strong> Золото или серебро видны только в прорезях — табличка выглядит сдержанно и дорого.</li>
<li><strong>Точная резка.</strong> Лазер вырезает даже тонкие засечки и мелкий шрифт с ровными краями.</li>
<li><strong>Любые сочетания.</strong> Основа — чёрный, графит, синий, зелёный, бордовый и другие цвета; подложка — золото, серебро, белый или чёрный акрил.</li>
</ul>' . $how,
		),
		array(
			'slug'  => 'adresnaya-tablichka-rondo-obemnye-i-vreznye-simvoly',
			'style' => '«Рондо»',
			'name'  => 'Адресная табличка «Рондо»: объёмный номер и врезной адрес, чёрная',
			'cfg'   => array( 'layout' => 'dome', 'w' => 600, 'h' => 400, 'finish' => 'combo', 'finishes' => 'combo,inlay,mirror', 'base' => 'black', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats'  => array( 'adresnye-tablichki', 'tablichki-obemnye-bukvy', 'tablichki-vreznye-simvoly' ),
			'img'   => 'v3-dome-combo-black',
			'material' => $mat,
			'tech'  => array( 'Технология' => 'Номер — объёмный акрил, адрес — врезные символы', 'Цвет символов' => 'Зеркальное серебро, золото, белый или чёрный акрил', 'Крепление' => '2 декоративных держателя' ),
			'short' => '<ul><li>Номер дома — объёмный, из зеркального акрила</li><li>Адрес — врезной: прорезан в основе, под ним зеркало</li><li>Фигурная форма с куполом, любой размер</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc'  => '<p>Табличка, в которой сочетаются две технологии. Номер дома в куполе — объёмный, из зеркального акрила: он выступает над поверхностью и сразу бросается в глаза. Название улицы — врезное: буквы прорезаны в основе, а под ними блестит зеркальный акрил. Получается выразительный акцент на номере и спокойный, аккуратный адрес.</p>' . $size_price . '
<h3>Почему стоит выбрать «Рондо»</h3>
<ul>
<li><strong>Номер видно издалека.</strong> Объёмные зеркальные цифры отражают свет и читаются с дороги.</li>
<li><strong>Две фактуры на одной табличке.</strong> Объём и прорезь создают глубину, которой нет у обычных табличек.</li>
<li><strong>Классическая форма.</strong> Купол над номером и рамка подходят к фасадам из кирпича, штукатурки и камня.</li>
<li><strong>Цвета на выбор.</strong> Основа — чёрный, графит, коричневый и другие; символы — серебро, золото, белый или чёрный акрил.</li>
</ul>' . $how,
		),
	);
}

add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 7 || ! function_exists( 'wc_get_product' ) || ! function_exists( 'exprinto_import_image' ) ) {
		return;
	}
	@set_time_limit( 300 ); // phpcs:ignore

	// Категория «С врезными символами».
	$c      = exprinto_v7_category();
	$parent = get_term_by( 'slug', $c['parent'], 'product_cat' );
	$term   = get_term_by( 'slug', $c['slug'], 'product_cat' );
	if ( ! $term ) {
		$res  = wp_insert_term( $c['name'], 'product_cat', array( 'slug' => $c['slug'], 'description' => $c['desc'], 'parent' => $parent ? $parent->term_id : 0 ) );
		$term = is_wp_error( $res ) ? null : get_term( $res['term_id'], 'product_cat' );
	}
	if ( $term ) {
		update_term_meta( $term->term_id, 'ex_title', $c['title'] );
		update_term_meta( $term->term_id, 'ex_desc', $c['meta'] );
		update_term_meta( $term->term_id, 'ex_seo_text', $c['seo'] );
		update_term_meta( $term->term_id, 'order', 3 );
		$img = exprinto_import_image( $c['image'], $c['name'] );
		if ( $img ) {
			update_term_meta( $term->term_id, 'thumbnail_id', $img );
		}
	}

	$tax_mat = exprinto_ensure_attribute( 'material', 'Материал' );
	$order   = -3;
	foreach ( exprinto_v7_products() as $p ) {
		$existing = get_page_by_path( $p['slug'], OBJECT, 'product' );
		$product  = $existing ? wc_get_product( $existing->ID ) : new WC_Product_Simple();
		$product->set_name( $p['name'] );
		$product->set_slug( $p['slug'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_regular_price( '' );
		$product->set_description( $p['desc'] );
		$product->set_short_description( $p['short'] );
		$product->set_featured( true );
		$product->set_reviews_allowed( false );
		$product->set_menu_order( $order++ );
		$product->set_sku( 'PM-' . strtoupper( substr( md5( $p['slug'] ), 0, 6 ) ) );
		$cat_ids = array();
		foreach ( $p['cats'] as $slug ) {
			$t = get_term_by( 'slug', $slug, 'product_cat' );
			if ( $t ) {
				$cat_ids[] = $t->term_id;
			}
		}
		$product->set_category_ids( $cat_ids );

		$attrs = array();
		$t     = term_exists( $p['material'], $tax_mat );
		if ( ! $t ) {
			$t = wp_insert_term( $p['material'], $tax_mat );
		}
		if ( ! is_wp_error( $t ) ) {
			$a = new WC_Product_Attribute();
			$a->set_id( wc_attribute_taxonomy_id_by_name( $tax_mat ) );
			$a->set_name( $tax_mat );
			$a->set_options( array( is_array( $t ) ? (int) $t['term_id'] : (int) $t ) );
			$a->set_position( 0 );
			$a->set_visible( true );
			$attrs[] = $a;
		}
		$pos = 1;
		foreach ( $p['tech'] + array( 'Комплектация' => 'Табличка, крепёж, защитная плёнка и упаковка' ) as $label => $val ) {
			$a = new WC_Product_Attribute();
			$a->set_name( $label );
			$a->set_options( array( $val ) );
			$a->set_position( $pos++ );
			$a->set_visible( true );
			$attrs[] = $a;
		}
		$product->set_attributes( $attrs );

		$images = array();
		foreach ( array( '-1.jpg', '-3.jpg' ) as $k => $suffix ) {
			$alt = $p['name'] . ( $k ? ' — варианты цвета' : '' );
			$id  = exprinto_import_image( $p['img'] . $suffix, $alt, $alt );
			if ( $id ) {
				$images[] = $id;
			}
		}
		if ( $images ) {
			$product->set_image_id( array_shift( $images ) );
			$product->set_gallery_image_ids( $images );
		}
		foreach ( $p['cfg'] as $k => $v ) {
			$product->update_meta_data( '_ex_' . $k, $v );
		}
		$product->update_meta_data( '_ex_style', $p['style'] );
		$product->save();
		foreach ( array_merge( array( $product->get_image_id() ), $product->get_gallery_image_ids() ) as $aid ) {
			if ( $aid ) {
				wp_update_post( array( 'ID' => $aid, 'post_parent' => $product->get_id() ) );
			}
		}
	}
	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	update_option( 'exprinto_catalog_version', 7 );
}, 27 );

/** v8: убрать дубли новых моделей (миграция v7 один раз сработала в двух запросах одновременно). */
add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 8 || ! add_option( 'exprinto_migration_lock_v8', time(), '', 'no' ) ) {
		return;
	}
	foreach ( exprinto_v7_products() as $p ) {
		$keep = get_page_by_path( $p['slug'], OBJECT, 'product' );
		$dups = get_posts( array(
			'post_type'   => 'product',
			'post_status' => 'any',
			'numberposts' => -1,
			'meta_key'    => '_ex_style', // phpcs:ignore
			'meta_value'  => $p['style'], // phpcs:ignore
		) );
		foreach ( $dups as $d ) {
			if ( $keep && $d->ID !== $keep->ID && 0 === strpos( $d->post_name, $p['slug'] ) ) {
				wp_trash_post( $d->ID );
			}
		}
	}
	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	update_option( 'exprinto_catalog_version', 8 );
	delete_option( 'exprinto_migration_lock_v8' );
}, 28 );

/* -------------------------------------------------------------------------
 * v9: 11 новых моделей по фото + фото в карточки существующих моделей
 * ---------------------------------------------------------------------- */

function exprinto_v9_blocks() {
	return array(
		'size' => '
<h3>Размер и цена</h3>
<p>Размер таблички может быть любым — сделаем под ваш фасад, ворота или столб. Цена зависит от размера, формы и технологии, поэтому мы озвучим её после просчёта заказа: оставьте заявку на этой странице, и мы перезвоним в течение 15 минут в рабочее время.</p>',
		'how'  => '
<h3>Как заказать</h3>
<p>Впишите название улицы и номер дома, выберите цвета — превью обновится сразу. Оставьте телефон и нажмите «Рассчитать стоимость»: мы перезвоним, назовём цену и пришлём макет в Viber, Telegram или на e-mail. После согласования изготовим табличку за 2–3 рабочих дня и отправим в любой город Беларуси.</p>',
		'acryl' => '
<h3>Почему объёмные буквы из акрила</h3>
<ul>
<li><strong>Видно днём и ночью.</strong> Зеркальный акрил отражает солнце, фонари и свет фар.</li>
<li><strong>Долговечно.</strong> Основа — алюминиевый композит: не ржавеет, не гнётся, не боится мороза до −40 °C.</li>
<li><strong>Точно.</strong> Буквы и цифры вырезаются лазером, кромки ровные и гладкие.</li>
<li><strong>Любые цвета.</strong> 9 цветов основы; буквы — зеркальное серебро, золото, белый или чёрный акрил.</li>
</ul>',
		'inlay' => '
<h3>Почему прорезные символы</h3>
<ul>
<li><strong>Ничего не отклеится.</strong> Символы — часть таблички, а не накладка: их не сорвёт ветром и не повредит при мытье.</li>
<li><strong>Сдержанный блеск.</strong> Зеркальное золото или серебро видны только в прорезях — табличка выглядит строго и дорого.</li>
<li><strong>Точная резка.</strong> Лазер вырезает тонкие линии и засечки с идеально ровными краями.</li>
<li><strong>Любые сочетания.</strong> Основа — чёрный, графит, синий, зелёный и другие цвета; подложка — золото, серебро, белый или чёрный акрил.</li>
</ul>',
		'glass' => '
<h3>Табличка на акриловом стекле</h3>
<ul>
<li><strong>Три слоя.</strong> Прозрачное стекло, основа и символы дают глубину — табличка словно парит над стеной.</li>
<li><strong>Держатели из нержавейки.</strong> Табличка отстоит от стены на 1,5–2 см, за ней не скапливаются вода и грязь.</li>
<li><strong>Любые цвета.</strong> Основа — 9 цветов, символы — серебро, золото, белый или чёрный акрил.</li>
</ul>',
	);
}

function exprinto_v9_products() {
	$b   = exprinto_v9_blocks();
	$mat = 'Алюминиевый композит + зеркальный акрил';
	$obm = array( 'adresnye-tablichki', 'tablichki-obemnye-bukvy' );
	$vrz = array( 'adresnye-tablichki', 'tablichki-vreznye-simvoly' );
	$tech_glass = array( 'Подложка' => 'Прозрачное акриловое стекло', 'Крепление' => 'Дистанционные держатели из нержавеющей стали' );
	return array(
		array(
			'slug' => 'obemnye-cifry-bez-osnovy-akcent', 'style' => '«Акцент»',
			'name' => 'Объёмные цифры «Акцент» без основы, с планкой адреса',
			'cfg'  => array( 'layout' => 'frameless', 'w' => 600, 'h' => 300, 'finish' => 'mirror', 'finishes' => 'mirror', 'base' => 'black', 'metal' => 'black', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => array( 'adresnye-tablichki', 'tablichki-obemnye-bukvy', 'nomera-domov' ), 'img' => 'v4-akcent',
			'photos' => array( 'foto-s0-00.jpg', 'foto-s1-05.jpg' ), 'material' => 'Акрил',
			'tech' => array( 'Технология' => 'Объёмные цифры и планка из акрила, лазерная резка', 'Цвет' => 'Чёрный или белый акрил, зеркальное серебро или золото', 'Крепление' => 'Прямо на фасад, на шпильках' ),
			'short' => '<ul><li>Крупные объёмные цифры без таблички-основы</li><li>Планка с названием улицы, прорезанным насквозь</li><li>Любой размер, чёрный, белый или зеркальный акрил</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Современный номер дома без таблички: крупные объёмные цифры и планка с адресом крепятся прямо на фасад, забор или столб. Название улицы прорезано в планке насквозь — сквозь буквы видна стена. Такой номер выглядит как часть архитектуры дома и хорошо читается с улицы.</p>' . $b['size'] . '
<h3>Почему без основы</h3>
<ul>
<li><strong>Минимализм.</strong> Ничего лишнего — только цифры и адрес, как у современных домов в каталогах архитекторов.</li>
<li><strong>Контраст с фасадом.</strong> Чёрные цифры на светлой стене, белые — на тёмной; зеркальные — на любой.</li>
<li><strong>Крепление на шпильках.</strong> Цифры отстоят от стены, отбрасывают тень и смотрятся объёмно.</li>
</ul>' . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-premium-liniya-na-stekle', 'style' => '«Премиум Линия»',
			'name' => 'Адресная табличка «Премиум Линия» на акриловом стекле, объёмные буквы, графит',
			'cfg'  => array( 'layout' => 'premline', 'w' => 600, 'h' => 340, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'graphite', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => $obm, 'img' => 'v4-premium-line', 'photos' => array( 'foto-s0-02.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Объёмные буквы из акрила, лазерная резка' ) + $tech_glass,
			'short' => '<ul><li>Крупный номер слева, тонкая линия и адрес справа</li><li>Объёмные буквы из зеркального акрила</li><li>На прозрачном акриловом стекле и держателях</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Лаконичная табличка в современном стиле: крупный номер в левом верхнем углу, тонкая линия и название улицы курсивом справа. Объёмные буквы из зеркального акрила на тёмной основе, вся табличка — на прозрачном акриловом стекле.</p>' . $b['size'] . $b['glass'] . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-premium-arka-na-stekle', 'style' => '«Премиум Арка»',
			'name' => 'Адресная табличка «Премиум Арка» на акриловом стекле, объёмные буквы, графит',
			'cfg'  => array( 'layout' => 'premarch', 'w' => 600, 'h' => 380, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'graphite', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => $obm, 'img' => 'v4-premium-arka', 'photos' => array( 'foto-s0-05.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Объёмные буквы и рамка из акрила' ) + $tech_glass,
			'short' => '<ul><li>Плавная арка сверху и объёмная рамка по контуру</li><li>Номер с засечками и адрес капителью</li><li>На прозрачном акриловом стекле и держателях</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Классическая форма с плавной аркой над номером. Объёмные буквы и рамка по контуру — из зеркального акрила, основа — алюминиевый композит, а под табличкой — прозрачное акриловое стекло того же силуэта. Подходит к фасадам из кирпича, штукатурки и камня.</p>' . $b['size'] . $b['glass'] . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-premium-duo-na-stekle', 'style' => '«Премиум Дуо»',
			'name' => 'Адресная табличка «Премиум Дуо»: прорезной номер и объёмный адрес, на акриловом стекле',
			'cfg'  => array( 'layout' => 'duo', 'w' => 600, 'h' => 380, 'finish' => 'combo', 'finishes' => 'combo,mirror', 'base' => 'black', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => array( 'adresnye-tablichki', 'tablichki-obemnye-bukvy', 'tablichki-vreznye-simvoly' ), 'img' => 'v4-premium-duo', 'photos' => array( 'foto-s1-00.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Зеркальная панель с прорезным номером + объёмный адрес' ) + $tech_glass,
			'short' => '<ul><li>Зеркальная панель с прорезным номером</li><li>Название улицы — объёмными буквами</li><li>Две технологии на одной табличке, на акриловом стекле</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Табличка с двумя технологиями сразу. Сверху — панель из зеркального акрила, в которой прорезан крупный номер: сквозь прорезь видна тёмная основа. Ниже — название улицы объёмными зеркальными буквами. Вся конструкция закреплена на прозрачном акриловом стекле.</p>' . $b['size'] . $b['glass'] . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-klassik-obemnye-bukvy-korichnevaya', 'style' => '«Классик»',
			'name' => 'Адресная табличка «Классик» с объёмными буквами из зеркального акрила, коричневая',
			'cfg'  => array( 'layout' => 'classic', 'w' => 800, 'h' => 200, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'brown', 'metal' => 'silver', 'scheme' => 'brown-white', 'text' => 'white' ),
			'cats' => $obm, 'img' => 'v4-klassik', 'photos' => array( 'foto-s1-03.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Объёмные буквы из акрила, лазерная резка', 'Крепление' => '4 отверстия, саморезы и дюбели в комплекте' ),
			'short' => '<ul><li>Вытянутая табличка: «улица», название и номер в рамке</li><li>Объёмные буквы из зеркального акрила</li><li>Любой размер и цвет основы</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Узкая классическая табличка с рамкой по контуру: сверху — «улица», под ней крупное название, справа — номер дома на зеркальной плашке. Хорошо смотрится на заборе, воротах и над входом, читается издалека.</p>' . $b['size'] . $b['acryl'] . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-kvadro-obemnye-bukvy-sinyaya', 'style' => '«Квадро»',
			'name' => 'Адресная табличка «Квадро» с объёмными буквами из зеркального акрила, синяя',
			'cfg'  => array( 'layout' => 'square', 'w' => 320, 'h' => 320, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'blue', 'metal' => 'silver', 'scheme' => 'blue-white', 'text' => 'white' ),
			'cats' => $obm, 'img' => 'v4-kvadro', 'photos' => array( 'foto-s1-04.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Объёмные буквы из акрила, лазерная резка', 'Крепление' => '4 отверстия, саморезы и дюбели в комплекте' ),
			'short' => '<ul><li>Квадратная табличка: крупный номер, улица и плашка «улица»</li><li>Объёмные буквы из зеркального акрила</li><li>Любой размер и цвет основы</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Компактная квадратная табличка, где главное — номер дома. Под ним — название улицы крупными буквами и аккуратная плашка «улица». Подходит для столба ворот, калитки и узкого простенка.</p>' . $b['size'] . $b['acryl'] . $b['how'],
		),
		array(
			'slug' => 'tablichka-nomer-doma-obemnye-cifry-sinyaya', 'style' => '«Номер»',
			'name' => 'Табличка с номером дома, объёмные цифры из зеркального акрила, синяя',
			'cfg'  => array( 'layout' => 'number', 'w' => 360, 'h' => 180, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'blue', 'metal' => 'silver', 'scheme' => 'blue-white', 'text' => 'white' ),
			'cats' => array( 'nomera-domov', 'tablichki-obemnye-bukvy' ), 'img' => 'v4-nomer', 'photos' => array( 'foto-s0-04.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Объёмные цифры из акрила, лазерная резка', 'Крепление' => '4 отверстия, саморезы и дюбели в комплекте' ),
			'short' => '<ul><li>Крупный номер дома, можно с буквой или дробью — 14А, 243/2</li><li>Объёмные цифры из зеркального акрила, рамка по контуру</li><li>Надписи сверху и снизу — по желанию</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Горизонтальная табличка с номером дома: крупные объёмные цифры из зеркального акрила и тонкая рамка. Номер можно дополнить буквой или дробью, а сверху и снизу — добавить название улицы или подпись.</p>' . $b['size'] . $b['acryl'] . $b['how'],
		),
		array(
			'slug' => 'tablichka-nomer-doma-domovoy-znak-obemnye-cifry-chernaya', 'style' => '«Домовой знак»',
			'name' => 'Табличка с номером дома «Домовой знак», объёмные цифры из зеркального акрила, чёрная',
			'cfg'  => array( 'layout' => 'house', 'w' => 250, 'h' => 250, 'finish' => 'mirror', 'finishes' => 'mirror,print', 'base' => 'black', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => array( 'nomera-domov', 'tablichki-obemnye-bukvy' ), 'img' => 'v4-domovoy-akril', 'photos' => array( 'foto-s0-07.jpg', 'foto-s0-06.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Объёмные цифры и рамка из акрила', 'Крепление' => '4 отверстия, саморезы и дюбели в комплекте' ),
			'short' => '<ul><li>Квадратная табличка с крупным номером в фигурной рамке</li><li>Объёмные цифры из зеркального акрила</li><li>Можно добавить название улицы под номером</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Классический «домовой знак»: крупный номер в фигурной рамке с вырезанными уголками. Цифры и рамка — объёмные, из зеркального акрила. По желанию под номером добавим линию и название улицы, а сверху — подпись.</p>' . $b['size'] . $b['acryl'] . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-loft-vertikal-prorezn-simvoly', 'style' => '«Лофт Вертикаль»',
			'name' => 'Вертикальная табличка «Лофт» с прорезными символами, чёрная',
			'cfg'  => array( 'layout' => 'loftv', 'w' => 300, 'h' => 600, 'finish' => 'inlay', 'finishes' => 'inlay,mirror', 'base' => 'black', 'metal' => 'silver', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => $vrz, 'img' => 'v4-loft-vertikal', 'photos' => array( 'foto-s2-02.jpg', 'foto-s2-01.jpg', 'foto-s2-03.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Прорезные символы: лазерная прорезь в композите + зеркальный акрил под ней', 'Крепление' => 'Скрытое, на двусторонний скотч и клей или на шпильки' ),
			'short' => '<ul><li>Узкая вертикальная табличка для простенка у двери</li><li>Номер, линия и адрес прорезаны в основе</li><li>Под прорезями — зеркальное серебро или золото</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Вертикальная табличка для узкого простенка возле входной двери или калитки. Крупный номер, тонкая линия и адрес в две строки прорезаны в основе, а под ними блестит зеркальный акрил. Строгая, современная и очень аккуратная.</p>' . $b['size'] . $b['inlay'] . $b['how'],
		),
		array(
			'slug' => 'tablichka-nomer-doma-loft-kvadrat-prorezn-cifry', 'style' => '«Лофт Квадрат»',
			'name' => 'Табличка с номером дома «Лофт Квадрат», прорезные цифры, графит с золотом',
			'cfg'  => array( 'layout' => 'lofts', 'w' => 400, 'h' => 400, 'finish' => 'inlay', 'finishes' => 'inlay,mirror', 'base' => 'graphite', 'metal' => 'gold', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => array( 'adresnye-tablichki', 'tablichki-vreznye-simvoly', 'nomera-domov' ), 'img' => 'v4-loft-kvadrat', 'photos' => array( 'foto-s2-05.jpg', 'foto-s2-06.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Прорезные цифры: лазерная прорезь в композите + зеркальный акрил под ней', 'Крепление' => '2 декоративных держателя' ),
			'short' => '<ul><li>Квадратная табличка с крупным прорезным номером</li><li>Под прорезями — зеркальное золото или серебро</li><li>По желанию — название улицы под линией</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Квадратная табличка с номером дома: крупные цифры с засечками и линия под ними прорезаны в основе, а в прорезях блестит зеркальное золото. По желанию добавим название улицы. Крепится на двух декоративных держателях.</p>' . $b['size'] . $b['inlay'] . $b['how'],
		),
		array(
			'slug' => 'adresnaya-tablichka-loft-dom-prorezn-simvoly', 'style' => '«Лофт Дом»',
			'name' => 'Адресная табличка «Лофт Дом» с домиком, прорезные символы, чёрная с золотом',
			'cfg'  => array( 'layout' => 'lofth', 'w' => 600, 'h' => 340, 'finish' => 'inlay', 'finishes' => 'inlay,mirror', 'base' => 'black', 'metal' => 'gold', 'scheme' => 'black-white', 'text' => 'white' ),
			'cats' => $vrz, 'img' => 'v4-loft-dom', 'photos' => array( 'foto-s2-08.jpg' ), 'material' => $mat,
			'tech' => array( 'Технология' => 'Прорезные символы: лазерная прорезь в композите + зеркальный акрил под ней', 'Крепление' => '4 декоративных держателя' ),
			'short' => '<ul><li>Силуэт домика, номер, линия и адрес</li><li>Все символы прорезаны в основе, под ними — зеркальный акрил</li><li>Любой размер и цвет основы</li><li>Цену назовём после просчёта заказа</li></ul>',
			'desc' => '<p>Уютная табличка с силуэтом домика: слева — домик, справа — номер, ниже — линия и адрес. Всё прорезано лазером в основе, а под прорезями — зеркальное золото или серебро. Вместо адреса можно написать название дома или фамилию семьи.</p>' . $b['size'] . $b['inlay'] . $b['how'],
		),
	);
}

/** Фото к существующим моделям (slug => файлы) и обновлённые картинки. */
function exprinto_v9_photos() {
	return array(
		'adresnaya-tablichka-premium-obemnye-bukvy-chernaya'      => array( 'foto-s0-01.jpg' ),
		'adresnaya-tablichka-gerb-obemnye-bukvy-korichnevaya'     => array( 'foto-s0-03.jpg' ),
		'adresnaya-tablichka-rondo-obemnye-i-vreznye-simvoly'     => array( 'foto-s1-01.jpg' ),
		'vertikalnaya-tablichka-nomer-doma-obemnye-cifry-grafit'  => array( 'foto-s1-02.jpg' ),
		'adresnaya-tablichka-loft-vreznye-simvoly-chernaya'       => array( 'foto-s2-00.jpg', 'foto-s2-04.jpg', 'foto-s2-07.jpg' ),
	);
}

/** Создать/обновить один товар v9. */
function exprinto_v9_save_product( $p, $order ) {
	$existing = get_page_by_path( $p['slug'], OBJECT, 'product' );
	$product  = $existing ? wc_get_product( $existing->ID ) : new WC_Product_Simple();
	$product->set_name( $p['name'] );
	$product->set_slug( $p['slug'] );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_regular_price( '' );
	$product->set_description( $p['desc'] );
	$product->set_short_description( $p['short'] );
	$product->set_reviews_allowed( false );
	$product->set_menu_order( $order );
	$product->set_sku( 'PM-' . strtoupper( substr( md5( $p['slug'] ), 0, 6 ) ) );
	$cat_ids = array();
	foreach ( $p['cats'] as $slug ) {
		$t = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $t ) {
			$cat_ids[] = $t->term_id;
		}
	}
	$product->set_category_ids( $cat_ids );

	$tax_mat = exprinto_ensure_attribute( 'material', 'Материал' );
	$attrs   = array();
	$t       = term_exists( $p['material'], $tax_mat );
	if ( ! $t ) {
		$t = wp_insert_term( $p['material'], $tax_mat );
	}
	if ( ! is_wp_error( $t ) ) {
		$a = new WC_Product_Attribute();
		$a->set_id( wc_attribute_taxonomy_id_by_name( $tax_mat ) );
		$a->set_name( $tax_mat );
		$a->set_options( array( is_array( $t ) ? (int) $t['term_id'] : (int) $t ) );
		$a->set_position( 0 );
		$a->set_visible( true );
		$attrs[] = $a;
	}
	$pos = 1;
	foreach ( $p['tech'] + array( 'Комплектация' => 'Табличка, крепёж, защитная плёнка и упаковка' ) as $label => $val ) {
		$a = new WC_Product_Attribute();
		$a->set_name( $label );
		$a->set_options( array( $val ) );
		$a->set_position( $pos++ );
		$a->set_visible( true );
		$attrs[] = $a;
	}
	$product->set_attributes( $attrs );

	$main = exprinto_import_image( $p['img'] . '-1.jpg', $p['name'] );
	$gal  = array();
	foreach ( $p['photos'] as $k => $f ) {
		$id = exprinto_import_image( $f, $p['name'] . ' — фото ' . ( $k + 1 ) );
		if ( $id ) {
			$gal[] = $id;
		}
	}
	$var = exprinto_import_image( $p['img'] . '-3.jpg', $p['name'] . ' — варианты цвета' );
	if ( $var ) {
		$gal[] = $var;
	}
	if ( $main ) {
		$product->set_image_id( $main );
	}
	$product->set_gallery_image_ids( $gal );
	foreach ( $p['cfg'] as $k => $v ) {
		$product->update_meta_data( '_ex_' . $k, $v );
	}
	$product->update_meta_data( '_ex_style', $p['style'] );
	$product->save();
	foreach ( array_merge( array( $main ), $gal ) as $aid ) {
		if ( $aid ) {
			wp_update_post( array( 'ID' => $aid, 'post_parent' => $product->get_id() ) );
		}
	}
}

add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 9 || ! function_exists( 'wc_get_product' ) || ! function_exists( 'exprinto_import_image' ) ) {
		return;
	}
	// Один запрос за раз; зависшую блокировку снимаем через 5 минут.
	if ( ! add_option( 'exprinto_v9_lock', time(), '', 'no' ) ) {
		if ( time() - (int) get_option( 'exprinto_v9_lock' ) < 300 ) {
			return;
		}
		update_option( 'exprinto_v9_lock', time(), false );
	}
	@set_time_limit( 300 ); // phpcs:ignore

	$step  = (int) get_option( 'exprinto_v9_step', 0 );
	$items = exprinto_v9_products();
	$batch = 3;
	for ( $i = $step; $i < min( $step + $batch, count( $items ) ); $i++ ) {
		exprinto_v9_save_product( $items[ $i ], -20 + $i );
	}
	$step = $i;
	update_option( 'exprinto_v9_step', $step, false );

	if ( $step >= count( $items ) ) {
		// Фото к существующим моделям: фото после главной картинки, «варианты цвета» — в конце.
		foreach ( exprinto_v9_photos() as $slug => $files ) {
			$post = get_page_by_path( $slug, OBJECT, 'product' );
			$prod = $post ? wc_get_product( $post->ID ) : null;
			if ( ! $prod ) {
				continue;
			}
			$add = array();
			foreach ( $files as $k => $f ) {
				$id = exprinto_import_image( $f, $prod->get_name() . ' — фото ' . ( $k + 1 ) );
				if ( $id ) {
					$add[] = $id;
					wp_update_post( array( 'ID' => $id, 'post_parent' => $prod->get_id() ) );
				}
			}
			$gal = array_values( array_diff( $prod->get_gallery_image_ids(), $add ) );
			$prod->set_gallery_image_ids( array_merge( $add, $gal ) );
			$prod->save();
		}
		// «Рондо» теперь на акриловом стекле — новые картинки.
		$rondo = get_page_by_path( 'adresnaya-tablichka-rondo-obemnye-i-vreznye-simvoly', OBJECT, 'product' );
		if ( $rondo && ( $rp = wc_get_product( $rondo->ID ) ) ) {
			$m = exprinto_import_image( 'v4-rondo-1.jpg', $rp->get_name() );
			$v = exprinto_import_image( 'v4-rondo-3.jpg', $rp->get_name() . ' — варианты цвета' );
			$old = array_flip( array_filter( array( $rp->get_image_id() ) ) );
			$gal = array();
			foreach ( $rp->get_gallery_image_ids() as $aid ) {
				$src = (string) get_post_meta( $aid, '_ex_source', true );
				if ( 0 !== strpos( $src, 'v3-dome-combo' ) ) {
					$gal[] = $aid;
				}
			}
			if ( $m ) {
				$rp->set_image_id( $m );
			}
			if ( $v ) {
				$gal[] = $v;
			}
			$rp->set_gallery_image_ids( $gal );
			$rp->save();
		}
		// Порядок: премиум-серия, «Лофт», затем остальные новинки.
		$order = array(
			'adresnaya-tablichka-premium-obemnye-bukvy-chernaya', 'adresnaya-tablichka-premium-liniya-na-stekle', 'adresnaya-tablichka-premium-arka-na-stekle',
			'adresnaya-tablichka-premium-duo-na-stekle', 'adresnaya-tablichka-rondo-obemnye-i-vreznye-simvoly', 'adresnaya-tablichka-loft-vreznye-simvoly-chernaya',
			'adresnaya-tablichka-loft-vertikal-prorezn-simvoly', 'tablichka-nomer-doma-loft-kvadrat-prorezn-cifry', 'adresnaya-tablichka-loft-dom-prorezn-simvoly',
			'obemnye-cifry-bez-osnovy-akcent', 'adresnaya-tablichka-klassik-obemnye-bukvy-korichnevaya', 'adresnaya-tablichka-kvadro-obemnye-bukvy-sinyaya',
			'tablichka-nomer-doma-obemnye-cifry-sinyaya', 'tablichka-nomer-doma-domovoy-znak-obemnye-cifry-chernaya',
		);
		foreach ( $order as $k => $slug ) {
			$post = get_page_by_path( $slug, OBJECT, 'product' );
			if ( $post ) {
				wp_update_post( array( 'ID' => $post->ID, 'menu_order' => -40 + $k ) );
			}
		}
		if ( function_exists( 'wc_delete_product_transients' ) ) {
			wc_delete_product_transients();
		}
		update_option( 'exprinto_catalog_version', 9 );
	}
	delete_option( 'exprinto_v9_lock' );
}, 29 );

/** v10: тексты оферты и политики конфиденциальности, Title и Description всех товаров. */
add_action( 'init', function () {
	if ( (int) get_option( 'exprinto_catalog_version' ) >= 10 || ! function_exists( 'exprinto_legal_oferta' ) || ! add_option( 'exprinto_migration_lock_v10', time(), '', 'no' ) ) {
		return;
	}
	foreach ( array( 'publichnaya-oferta' => exprinto_legal_oferta(), 'politika-konfidencialnosti' => exprinto_legal_privacy() ) as $slug => $html ) {
		$page = get_page_by_path( $slug );
		if ( $page && ( '' === trim( $page->post_content ) || false !== strpos( $page->post_content, 'Шаблон для заполнения' ) ) ) {
			wp_update_post( array( 'ID' => $page->ID, 'post_content' => $html ) );
		}
		if ( $page ) {
			update_post_meta( $page->ID, '_ex_title', 'publichnaya-oferta' === $slug ? 'Публичная оферта — Promark.by' : 'Политика конфиденциальности — Promark.by' );
			update_post_meta( $page->ID, '_ex_desc', 'publichnaya-oferta' === $slug ? 'Условия изготовления и продажи адресных табличек: заказ, согласование макета, оплата, доставка, гарантия и возврат.' : 'Как Promark обрабатывает и защищает персональные данные покупателей в соответствии с Законом РБ «О защите персональных данных».' );
		}
	}
	if ( function_exists( 'exprinto_product_seo_map' ) && function_exists( 'wc_get_products' ) ) {
		$map = exprinto_product_seo_map();
		foreach ( wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) ) as $p ) {
			$id = $p->get_id();
			list( $t, $d ) = $map[ $p->get_slug() ] ?? exprinto_product_seo_auto( $p );
			if ( ! get_post_meta( $id, '_ex_title', true ) ) {
				update_post_meta( $id, '_ex_title', $t );
			}
			if ( ! get_post_meta( $id, '_ex_desc', true ) ) {
				update_post_meta( $id, '_ex_desc', $d );
			}
		}
	}
	update_option( 'exprinto_catalog_version', 10 );
	delete_option( 'exprinto_migration_lock_v10' );
}, 30 );
