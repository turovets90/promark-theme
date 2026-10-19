<?php
/**
 * Контакты и реквизиты в «Внешний вид → Настроить → Контакты магазина».
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

function exprinto_contact_defaults() {
	return array(
		'phone'     => '+375 (29) 142-63-73',
		'phone2'    => '',
		'email'     => 'posmag.by@gmail.com',
		'city'      => 'Минск',
		'address'   => 'г. Минск, ул. Примерная, 1 (производство)',
		'hours'     => 'Пн–Пт 9:00–19:00, Сб 10:00–15:00',
		'telegram'  => 'https://t.me/+375291426373',
		'viber'     => 'viber://chat?number=%2B375291426373',
		'instagram' => 'https://instagram.com/',
		'legal'     => 'ИП Иванов И. И., УНП 000000000. Свидетельство о гос. регистрации выдано ... Зарегистрирован в Торговом реестре РБ.',
		'lat'       => '53.9023',
		'lng'       => '27.5619',
		'notify_emails' => 'posmag.by@gmail.com, a.turovets90@gmail.com',
	);
}

/** Значение контакта. */
function exprinto_opt( $key ) {
	$d = exprinto_contact_defaults();
	return get_theme_mod( 'ex_' . $key, isset( $d[ $key ] ) ? $d[ $key ] : '' );
}

/** Телефон в формате для ссылки tel:. */
function exprinto_tel( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
}

add_action(
	'customize_register',
	function ( WP_Customize_Manager $wp_customize ) {
		$wp_customize->add_section( 'exprinto_contacts', array(
			'title'    => 'Контакты магазина',
			'priority' => 30,
		) );
		$labels = array(
			'phone'     => 'Телефон (основной)',
			'phone2'    => 'Телефон (дополнительный)',
			'email'     => 'E-mail',
			'city'      => 'Город',
			'address'   => 'Адрес',
			'hours'     => 'Режим работы',
			'telegram'  => 'Telegram (ссылка)',
			'viber'     => 'Viber (ссылка)',
			'instagram' => 'Instagram (ссылка)',
			'legal'     => 'Реквизиты продавца (подвал)',
			'lat'       => 'Широта (для карты и микроразметки)',
			'lng'       => 'Долгота',
			'notify_emails' => 'E-mail для писем с сайта (через запятую)',
		);
		$defaults = exprinto_contact_defaults();
		foreach ( $labels as $key => $label ) {
			$wp_customize->add_setting( 'ex_' . $key, array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => 'legal' === $key ? 'sanitize_textarea_field' : 'sanitize_text_field',
				'transport'         => 'refresh',
			) );
			$wp_customize->add_control( 'ex_' . $key, array(
				'label'   => $label,
				'section' => 'exprinto_contacts',
				'type'    => 'legal' === $key ? 'textarea' : 'text',
			) );
		}
	}
);
