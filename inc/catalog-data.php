<?php
/**
 * Справочники: цветовые схемы, типы улиц, макеты.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

/** Цветовые схемы (дублируются в assets/js/plate.js). */
function exprinto_schemes() {
	return array(
		'white-black'    => array( 'Белый / чёрный', '#FFFFFF', '#1B1B1D' ),
		'white-graphite' => array( 'Белый / графит', '#FFFFFF', '#4A4D53' ),
		'graphite-white' => array( 'Графит / белый', '#4A4D53', '#FFFFFF' ),
		'black-white'    => array( 'Чёрный / белый', '#1B1B1D', '#FFFFFF' ),
		'white-green'    => array( 'Белый / зелёный', '#FFFFFF', '#1D5B3E' ),
		'green-white'    => array( 'Зелёный / белый', '#1D5B3E', '#FFFFFF' ),
		'blue-white'     => array( 'Синий / белый', '#1F4C97', '#FFFFFF' ),
		'white-blue'     => array( 'Белый / синий', '#FFFFFF', '#1F4C97' ),
		'burgundy-white' => array( 'Бордовый / белый', '#74202C', '#FFFFFF' ),
		'brown-white'    => array( 'Шоколад / белый', '#46302A', '#FFFFFF' ),
		'yellow-black'   => array( 'Жёлтый / чёрный', '#F3C433', '#1B1B1D' ),
		'ivory-black'    => array( 'Слоновая кость / чёрный', '#F1E8D2', '#1B1B1D' ),
	);
}

/** Цвета основы (алюминиевый композит) для табличек с объёмными буквами. Дублируются в plate.js. */
function exprinto_bases() {
	return array(
		'graphite' => array( 'Графит', '#44484E' ),
		'black'    => array( 'Чёрный', '#1C1D20' ),
		'brown'    => array( 'Коричневый', '#4B2A1F' ),
		'blue'     => array( 'Синий', '#1F4EA6' ),
		'green'    => array( 'Зелёный', '#1B5A3C' ),
		'burgundy' => array( 'Бордовый', '#6B1E29' ),
		'white'    => array( 'Белый', '#F7F7F5' ),
		'ivory'    => array( 'Слоновая кость', '#EFE6CF' ),
		'yellow'   => array( 'Жёлтый', '#F3C433' ),
	);
}

/** Цвет надписей при УФ-печати. Дублируется в plate.js. */
function exprinto_text_colors() {
	return array(
		'white'    => array( 'Белый', '#FFFFFF' ),
		'black'    => array( 'Чёрный', '#1B1B1D' ),
		'graphite' => array( 'Графит', '#4A4D53' ),
		'silver'   => array( 'Серебристый', '#B8BDC3' ),
		'gold'     => array( 'Золотистый', '#C9A24A' ),
		'yellow'   => array( 'Жёлтый', '#F3C433' ),
		'blue'     => array( 'Синий', '#22509F' ),
		'green'    => array( 'Зелёный', '#1D5B3E' ),
		'brown'    => array( 'Коричневый', '#4A2C22' ),
		'red'      => array( 'Красный', '#B3262E' ),
	);
}

/** Технологии нанесения надписей. */
function exprinto_finishes() {
	return array(
		'mirror' => 'Объёмные буквы из акрила',
		'print'  => 'УФ-печать',
	);
}

/** Цвет объёмных букв (акрил). */
function exprinto_metals() {
	return array(
		'silver' => array( 'Зеркальное серебро', 'linear-gradient(135deg,#fbfcfd,#9aa3ad 45%,#eef1f4 55%,#7e8791)' ),
		'gold'   => array( 'Зеркальное золото', 'linear-gradient(135deg,#fff4cf,#c99a3c 45%,#fbe7a8 55%,#946a1e)' ),
		'white'  => array( 'Белый акрил', 'linear-gradient(135deg,#ffffff,#e3e5e8)' ),
		'black'  => array( 'Чёрный акрил', 'linear-gradient(135deg,#4a4d52,#0c0d0e)' ),
	);
}

/** Типы адресных объектов. */
function exprinto_street_types() {
	return array( 'улица', 'проспект', 'переулок', 'бульвар', 'проезд', 'площадь', 'тракт', 'шоссе', 'микрорайон', 'аллея', 'набережная', 'тупик', 'посёлок', 'деревня', 'садовое товарищество' );
}

/**
 * Подписи полей персонализации для каждого макета.
 * type / street / number — ключи полей.
 */
function exprinto_layout_fields( $layout ) {
	$map = array(
		'line'     => array(
			'type'   => array( 'Тип', true ),
			'street' => array( 'Название улицы', true ),
			'number' => array( 'Номер дома', true ),
		),
		'quadro'   => array(
			'type'   => array( 'Тип', true ),
			'street' => array( 'Название улицы', true ),
			'number' => array( 'Номер дома', true ),
		),
		'classic'  => array(
			'type'   => array( 'Тип', true ),
			'street' => array( 'Название улицы', true ),
			'number' => array( 'Номер дома', true ),
		),
		'number'   => array(
			'type'   => array( 'Надпись сверху', false ),
			'street' => array( 'Надпись снизу (необязательно)', false ),
			'number' => array( 'Номер дома', true ),
		),
		'house'    => array(
			'type'   => array( 'Надпись сверху', false ),
			'street' => array( 'Название улицы (необязательно)', false ),
			'number' => array( 'Номер дома', true ),
		),
		'vertical' => array(
			'type'   => array( 'Тип', false ),
			'street' => array( 'Название улицы (необязательно)', false ),
			'number' => array( 'Номер дома', true ),
		),
		'entrance' => array(
			'type'   => array( 'Надпись', false ),
			'street' => array( 'Квартиры', false ),
			'number' => array( 'Номер подъезда', true ),
		),
	);
	return isset( $map[ $layout ] ) ? $map[ $layout ] : $map['line'];
}
