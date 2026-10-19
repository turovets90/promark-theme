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
<p>Прямоугольные таблички «Модерн» подходят к современной архитектуре, фигурные «Волна», «Купол», «Герб» и «Ажур» — к классическим и загородным домам. Для узких простенков и столбов ворот есть вертикальная табличка 220×700 мм.</p>',
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
			'meta'   => 'Таблички с номером дома 250×250 мм. Для фасада, ворот и калитки. УФ-печать, изготовление 1–2 дня, доставка по Беларуси.',
			'seo'    => '<h2>Номер дома, который видно издалека</h2><p>Отдельный номерной знак удобно повесить на ворота или калитку, если основная адресная табличка висит на фасаде. Крупные цифры с засечками читаются с 20–25 метров.</p>',
		),
	);
}

function exprinto_v2_products() {
	$acryl_tail = '
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
<p>Впишите название улицы и номер дома, выберите цвета — превью обновится сразу. После заказа дизайнер пришлёт макет в Viber, Telegram или на e-mail. Изготовим за 2–3 рабочих дня и отправим в любой город Беларуси.</p>';

	$print_tail = '
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
<p>Введите адрес, выберите цвет и оформите заказ. Изготовим за 1–2 рабочих дня и отправим Европочтой, Белпочтой или курьером. Оплата при получении.</p>';

	$acryl_short = function ( $size, $base ) {
		return '<ul><li>Объёмные буквы из акрила с зеркальным серебром (или золотом)</li><li>Основа — алюминиевый композит, ' . $base . '</li><li>Размер ' . $size . ' мм, крепёж в комплекте</li></ul>';
	};
	$print_short = function ( $size, $mat ) {
		return '<ul><li>УФ-печать — не выгорает на солнце</li><li>' . $mat . '</li><li>Размер ' . $size . ' мм, отверстия и крепёж в комплекте</li></ul>';
	};

	return array(
		array(
			'slug' => 'adresnaya-tablichka-obemnye-bukvy-900x270-grafit', 'style' => '«Модерн»',
			'name' => 'Адресная табличка 900×270 мм с объёмными буквами из зеркального акрила, графит',
			'price' => '238.34', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => true,
			'cfg' => array( 'layout' => 'line', 'w' => 900, 'h' => 270, 'finish' => 'mirror', 'base' => 'graphite', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '900×270 мм', 'img' => 'v2-modern-acryl-900x270',
			'short' => $acryl_short( '900×270', 'графитовый цвет' ),
			'desc' => '<p>Большая адресная табличка в современном стиле: «улица» в плашке, название под тонкой линией и крупный номер справа. Все надписи — объёмные, из акрила с зеркальным серебром, на основе из алюминиевого композита графитового цвета. Такая табличка становится акцентом фасада и хорошо видна с дороги.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/1fCddp3',
		),
		array(
			'slug' => 'adresnaya-tablichka-obemnye-bukvy-630x360-sinyaya', 'style' => '«Волна»',
			'name' => 'Адресная табличка «Волна» 630×360 мм с объёмными буквами из зеркального акрила, синяя',
			'price' => '223.36', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => true,
			'cfg' => array( 'layout' => 'wave', 'w' => 630, 'h' => 360, 'finish' => 'mirror', 'base' => 'blue', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '630×360 мм', 'img' => 'v2-wave-blue',
			'short' => $acryl_short( '630×360', 'синий цвет' ),
			'desc' => '<p>Фигурная табличка с плавной «волной» и щитом для номера дома. Название улицы набрано каллиграфическим шрифтом, по контуру — тонкая зеркальная рамка. Яркий синий цвет основы и зеркальное серебро делают табличку заметной на любом фасаде и заборе.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/1fClfQs',
		),
		array(
			'slug' => 'adresnaya-tablichka-obemnye-bukvy-620x380-korichnevaya', 'style' => '«Купол»',
			'name' => 'Адресная табличка «Купол» 620×380 мм с объёмными буквами из зеркального акрила, коричневая',
			'price' => '218.50', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => true,
			'cfg' => array( 'layout' => 'arch', 'w' => 620, 'h' => 380, 'finish' => 'mirror', 'base' => 'brown', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '620×380 мм', 'img' => 'v2-arch-brown',
			'short' => $acryl_short( '620×380', 'коричневый цвет' ),
			'desc' => '<p>Классическая табличка с куполом: номер дома в верхней арке, название улицы — крупно в центральной полосе, «улица» — в нижнем выступе. Шрифт с засечками и зеркальная рамка по контуру придают табличке солидный, «усадебный» вид. Идеальна для домов из кирпича, дерева и с отделкой под камень.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/AxdWAgz',
		),
		array(
			'slug' => 'adresnaya-tablichka-obemnye-bukvy-630x360-korichnevaya', 'style' => '«Волна»',
			'name' => 'Адресная табличка «Волна» 630×360 мм с объёмными буквами из зеркального акрила, коричневая',
			'price' => '195.04', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => false,
			'cfg' => array( 'layout' => 'wave', 'w' => 630, 'h' => 360, 'finish' => 'mirror', 'base' => 'brown', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '630×360 мм', 'img' => 'v2-wave-brown',
			'short' => $acryl_short( '630×360', 'коричневый цвет' ),
			'desc' => '<p>«Волна» в тёплом коричневом цвете — для деревянных домов, фасадов с клинкером и коричневой кровлей. Каллиграфическое название улицы, номер в фигурном щите и зеркальная рамка по контуру. Буквы можно заказать в зеркальном серебре или золоте.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/cFjWTgJ',
		),
		array(
			'slug' => 'adresnaya-tablichka-obemnye-bukvy-590x330-korichnevaya', 'style' => '«Герб»',
			'name' => 'Адресная табличка «Герб» 590×330 мм с объёмными буквами из зеркального акрила, коричневая',
			'price' => '194.70', 'cats' => array( 'tablichki-obemnye-bukvy' ), 'featured' => false,
			'cfg' => array( 'layout' => 'crest', 'w' => 590, 'h' => 330, 'finish' => 'mirror', 'base' => 'brown', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '590×330 мм', 'img' => 'v2-crest-brown',
			'short' => $acryl_short( '590×330', 'коричневый цвет' ),
			'desc' => '<p>Табличка в форме герба: «улица» в верхней вкладке, название — в центральной полосе с фигурными концами, номер дома — в нижнем медальоне. Симметричная композиция и зеркальная рамка смотрятся нарядно и торжественно.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/j7qKGUX',
		),
		array(
			'slug' => 'adresnaya-tablichka-obemnye-bukvy-220x700-vertikalnaya', 'style' => '«Вертикаль»',
			'name' => 'Вертикальная табличка с номером дома 220×700 мм, объёмные цифры из зеркального акрила, графит',
			'price' => '156.92', 'cats' => array( 'tablichki-obemnye-bukvy', 'nomera-domov' ), 'featured' => true,
			'cfg' => array( 'layout' => 'vertical', 'w' => 220, 'h' => 700, 'finish' => 'mirror', 'base' => 'graphite', 'metal' => 'silver' ),
			'material' => 'Алюминиевый композит + зеркальный акрил', 'size' => '220×700 мм', 'img' => 'v2-vertical-graphite',
			'short' => $acryl_short( '220×700', 'графитовый цвет' ),
			'desc' => '<p>Узкая вертикальная табличка для столба ворот, простенка у входной двери или колонны. Цифры номера дома расположены одна под другой — крупно и стильно. По желанию добавим внизу название улицы. Крепится на дистанционные держатели, которые «отрывают» табличку от стены.</p>' . $acryl_tail,
			'ozon' => 'https://ozon.by/t/4KpD3zR',
		),
		array(
			'slug' => 'adresnaya-tablichka-900x270-uf-pechat-belo-seraya', 'style' => '«Модерн»',
			'name' => 'Адресная табличка «Домовой знак» 900×270 мм, бело-серая, алюминиевый композит, УФ-печать',
			'price' => '126.46', 'cats' => array( 'tablichki-uf-pechat' ), 'featured' => true,
			'cfg' => array( 'layout' => 'line', 'w' => 900, 'h' => 270, 'finish' => 'print', 'scheme' => 'white-graphite' ),
			'material' => 'Алюминиевый композит 3 мм', 'size' => '900×270 мм', 'img' => 'v2-modern-print-900x270',
			'short' => $print_short( '900×270', 'Алюминиевый композит 3 мм' ),
			'desc' => '<p>Большая адресная табличка в лаконичном стиле: крупный номер справа, тип улицы в плашке и название под тонкой линией. Номер высотой 21 см читается с 30 метров. Основа — алюминиевый композит, изображение нанесено УФ-печатью.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/RhUeIZP',
		),
		array(
			'slug' => 'adresnaya-tablichka-700x290-uf-pechat-sinyaya', 'style' => '«Ажур»',
			'name' => 'Адресная табличка «Ажур» 700×290 мм, синяя, алюминиевый композит, УФ-печать',
			'price' => '122.34', 'cats' => array( 'tablichki-uf-pechat' ), 'featured' => true,
			'cfg' => array( 'layout' => 'ornate', 'w' => 700, 'h' => 290, 'finish' => 'print', 'scheme' => 'blue-white' ),
			'material' => 'Алюминиевый композит 3 мм', 'size' => '700×290 мм', 'img' => 'v2-ornate-blue',
			'short' => $print_short( '700×290', 'Фигурная резка, алюминиевый композит 3 мм' ),
			'desc' => '<p>Фигурная табличка с завитками по краям — классический городской стиль. «Улица», название и номер дома расположены по центру, по контуру — декоративная рамка. Синий фон и белые буквы — привычная и хорошо читаемая пара.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/9oyrc62',
		),
		array(
			'slug' => 'adresnaya-tablichka-590x330-uf-pechat-zelenaya', 'style' => '«Герб»',
			'name' => 'Адресная табличка «Герб» 590×330 мм, зелёная, алюминиевый композит, УФ-печать',
			'price' => '117.16', 'cats' => array( 'tablichki-uf-pechat' ), 'featured' => false,
			'cfg' => array( 'layout' => 'crest', 'w' => 590, 'h' => 330, 'finish' => 'print', 'scheme' => 'green-white', 'font' => 'cond' ),
			'material' => 'Алюминиевый композит 3 мм', 'size' => '590×330 мм', 'img' => 'v2-crest-green',
			'short' => $print_short( '590×330', 'Фигурная резка, алюминиевый композит 3 мм' ),
			'desc' => '<p>Фигурная табличка «Герб» в благородном зелёном цвете: «улица» в верхней вкладке, название в центральной полосе и номер дома в медальоне. Строгий узкий шрифт хорошо читается издалека.</p>' . $print_tail,
			'ozon' => 'https://ozon.by/t/pHvXy5e',
		),
		array(
			'slug' => 'tablichka-nomer-doma-250x250-chernaya', 'style' => '«Домовой знак»',
			'name' => 'Табличка с номером дома «Домовой знак» 250×250 мм, чёрная, пластик, УФ-печать',
			'price' => '37.75', 'cats' => array( 'nomera-domov' ), 'featured' => true,
			'cfg' => array( 'layout' => 'house', 'w' => 250, 'h' => 250, 'finish' => 'print', 'scheme' => 'black-white' ),
			'material' => 'Пластик ПВХ 3 мм', 'size' => '250×250 мм', 'img' => 'v2-house-black',
			'short' => $print_short( '250×250', 'Пластик ПВХ 3 мм — лёгкий и влагостойкий' ),
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
 * v3: две технологии у каждой модели (объёмные буквы / печать), цвет основы и надписей отдельно.
 * Цены: [объёмные буквы, печать]. Где на Ozon есть только один вариант, второй — расчётный (правится в админке товара).
 */
function exprinto_v3_prices() {
	return array(
		'adresnaya-tablichka-obemnye-bukvy-900x270-grafit'       => array( 238.34, 126.46, 'graphite', 'white' ),
		'adresnaya-tablichka-obemnye-bukvy-630x360-sinyaya'      => array( 223.36, 122.90, 'blue', 'white' ),
		'adresnaya-tablichka-obemnye-bukvy-620x380-korichnevaya' => array( 218.50, 119.90, 'brown', 'white' ),
		'adresnaya-tablichka-obemnye-bukvy-630x360-korichnevaya' => array( 195.04, 107.90, 'brown', 'white' ),
		'adresnaya-tablichka-obemnye-bukvy-590x330-korichnevaya' => array( 194.70, 117.16, 'brown', 'white' ),
		'adresnaya-tablichka-obemnye-bukvy-220x700-vertikalnaya' => array( 156.92, 86.90, 'graphite', 'white' ),
		'adresnaya-tablichka-900x270-uf-pechat-belo-seraya'      => array( 238.34, 126.46, 'white', 'graphite' ),
		'adresnaya-tablichka-700x290-uf-pechat-sinyaya'          => array( 222.90, 122.34, 'blue', 'white' ),
		'adresnaya-tablichka-590x330-uf-pechat-zelenaya'         => array( 194.70, 117.16, 'green', 'white' ),
		'tablichka-nomer-doma-250x250-chernaya'                  => array( 79.90, 37.75, 'black', 'white' ),
	);
}

function exprinto_catalog_v3_update() {
	foreach ( exprinto_v3_prices() as $slug => $row ) {
		$post = get_page_by_path( $slug, OBJECT, 'product' );
		if ( ! $post ) {
			continue;
		}
		update_post_meta( $post->ID, '_ex_price_mirror', wc_format_decimal( $row[0], 2 ) );
		update_post_meta( $post->ID, '_ex_price_print', wc_format_decimal( $row[1], 2 ) );
		update_post_meta( $post->ID, '_ex_base', $row[2] );
		update_post_meta( $post->ID, '_ex_text', $row[3] );
	}
	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
	update_option( 'exprinto_catalog_version', 3 );
}
