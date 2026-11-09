<?php
/**
 * Заявки с сайта (обратный звонок / расчёт по макету).
 * Сохраняются в админке («Заявки») и дублируются на e-mail администратора.
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	function () {
		register_post_type( 'ex_lead', array(
			'labels'          => array(
				'name'          => 'Заявки',
				'singular_name' => 'Заявка',
				'menu_name'     => 'Заявки с сайта',
				'all_items'     => 'Все заявки',
			),
			'public'          => false,
			'show_ui'         => true,
			'menu_icon'       => 'dashicons-phone',
			'menu_position'   => 56,
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		) );
	}
);

/** Форма заявки. */
function exprinto_lead_form( $context = 'Расчёт заказа' ) {
	$sent = isset( $_GET['lead'] ) && 'ok' === $_GET['lead']; // phpcs:ignore WordPress.Security.NonceVerification
	?>
	<form class="lead-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" id="zayavka">
		<?php if ( $sent ) : ?>
			<p class="lead-form__ok" role="status"><?php echo exprinto_icon( 'check' ); // phpcs:ignore ?> Спасибо! Заявка принята — перезвоним в течение 15 минут в рабочее время.</p>
		<?php endif; ?>
		<input type="hidden" name="action" value="exprinto_lead">
		<input type="hidden" name="context" value="<?php echo esc_attr( $context ); ?>">
		<input type="hidden" name="back" value="<?php echo esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ); ?>">
		<?php wp_nonce_field( 'exprinto_lead', 'exprinto_lead_nonce' ); ?>
		<div class="hp" aria-hidden="true"><label>Сайт <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
		<div class="lead-form__row">
			<label class="field"><span>Ваше имя</span><input type="text" name="name" autocomplete="name" required placeholder="Иван"></label>
			<label class="field"><span>Телефон</span><input type="tel" name="phone" autocomplete="tel" required placeholder="+375 (29) 123-45-67" pattern="[0-9+()\-\s]{7,}"></label>
		</div>
		<label class="field"><span>Что нужно изготовить?</span><textarea name="message" rows="3" placeholder="Например: 5 табличек на подъезды, 400×200, синие"></textarea></label>
		<label class="check"><input type="checkbox" name="agree" value="1" required> <span>Согласен на обработку персональных данных согласно <a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/politika-konfidencialnosti/' ) ); ?>">политике конфиденциальности</a></span></label>
		<button class="btn btn--accent btn--lg" type="submit">Получить расчёт <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></button>
	</form>
	<?php
}

function exprinto_handle_lead() {
	$back = isset( $_POST['back'] ) ? esc_url_raw( wp_unslash( $_POST['back'] ) ) : home_url( '/' );
	if ( ! isset( $_POST['exprinto_lead_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['exprinto_lead_nonce'] ), 'exprinto_lead' ) ) {
		wp_safe_redirect( $back );
		exit;
	}
	if ( ! empty( $_POST['website'] ) ) { // ловушка для ботов.
		wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) . '#zayavka' );
		exit;
	}
	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
	$context = sanitize_text_field( wp_unslash( $_POST['context'] ?? '' ) );

	if ( $phone ) {
		$body = "Имя: {$name}\nТелефон: {$phone}\nИсточник: {$context}\nСтраница: {$back}\n\n{$message}";
		wp_insert_post( array(
			'post_type'    => 'ex_lead',
			'post_status'  => 'private',
			'post_title'   => $name . ' — ' . $phone,
			'post_content' => $body,
		) );
		wp_mail( exprinto_notify_emails(), 'Новая заявка с сайта: ' . $phone, $body );
	}
	wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) . '#zayavka' );
	exit;
}
add_action( 'admin_post_nopriv_exprinto_lead', 'exprinto_handle_lead' );
add_action( 'admin_post_exprinto_lead', 'exprinto_handle_lead' );

/** Адреса, на которые приходят все письма с сайта (заявки и заказы). */
function exprinto_notify_emails() {
	$raw  = get_theme_mod( 'ex_notify_emails', 'posmag.by@gmail.com, a.turovets90@gmail.com' );
	$list = array_filter( array_map( 'sanitize_email', array_map( 'trim', explode( ',', (string) $raw ) ) ) );
	return $list ? array_values( $list ) : array( get_option( 'admin_email' ) );
}

/* -------------------------------------------------------------------------
 * Индивидуальный заказ (всплывающее окно)
 * ---------------------------------------------------------------------- */

function exprinto_custom_order_options() {
	return array(
		'kind'     => array( 'Адресная табличка', 'Номер дома', 'Табличка на подъезд', 'Указатель / навигация', 'Табличка для офиса или организации', 'Другое' ),
		'material' => array( 'Композит + объёмные буквы из зеркального акрила', 'Алюминиевый композит с УФ-печатью', 'Пластик ПВХ с УФ-печатью', 'Не знаю — подскажите' ),
		'mount'    => array( 'Саморезы и дюбели (стандарт)', 'Двусторонний скотч', 'Дистанционные держатели', 'Без крепления' ),
		'term'     => array( 'Обычный (1–2 дня)', 'Срочно (сегодня / завтра)' ),
	);
}

/** Разрешённые форматы файла-эскиза. */
function exprinto_custom_order_mimes() {
	return array(
		'jpg|jpeg' => 'image/jpeg',
		'png'      => 'image/png',
		'webp'     => 'image/webp',
		'pdf'      => 'application/pdf',
		'zip'      => 'application/zip',
	);
}

function exprinto_handle_custom_order() {
	$ajax = wp_doing_ajax();
	$fail = function ( $msg ) use ( $ajax ) {
		if ( $ajax ) {
			wp_send_json_error( array( 'message' => $msg ), 400 );
		}
		wp_die( esc_html( $msg ), 'Ошибка', array( 'back_link' => true ) );
	};

	if ( ! isset( $_POST['exprinto_custom_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['exprinto_custom_nonce'] ), 'exprinto_custom' ) ) {
		$fail( 'Сессия устарела. Обновите страницу и отправьте форму ещё раз.' );
	}
	if ( ! empty( $_POST['website'] ) ) { // ловушка для ботов.
		$ajax ? wp_send_json_success() : exit;
	}

	$f = array();
	foreach ( array( 'name', 'phone', 'email', 'kind', 'width', 'height', 'material', 'colors', 'qty', 'mount', 'term', 'product' ) as $k ) {
		$f[ $k ] = sanitize_text_field( wp_unslash( $_POST[ $k ] ?? '' ) );
	}
	$f['text']    = sanitize_textarea_field( wp_unslash( $_POST['text'] ?? '' ) );
	$f['comment'] = sanitize_textarea_field( wp_unslash( $_POST['comment'] ?? '' ) );
	$f['email']   = sanitize_email( $f['email'] );
	$f['page']    = esc_url_raw( wp_unslash( $_POST['page'] ?? '' ) );

	if ( '' === $f['name'] || strlen( preg_replace( '/\D/', '', $f['phone'] ) ) < 7 ) {
		$fail( 'Укажите имя и телефон — без них мы не сможем связаться с вами.' );
	}
	if ( '' === $f['text'] && empty( $_FILES['sketch']['name'] ) ) {
		$fail( 'Напишите текст для таблички или приложите эскиз.' );
	}

	// Файл-эскиз.
	$file_path = '';
	$file_url  = '';
	if ( ! empty( $_FILES['sketch']['name'] ) && UPLOAD_ERR_OK === (int) $_FILES['sketch']['error'] ) {
		if ( (int) $_FILES['sketch']['size'] > 10 * MB_IN_BYTES ) {
			$fail( 'Файл больше 10 МБ. Отправьте его в Viber/Telegram или на почту.' );
		}
		require_once ABSPATH . 'wp-admin/includes/file.php';
		$dir_filter = function ( $dirs ) {
			$dirs['subdir'] = '/custom-orders';
			$dirs['path']   = $dirs['basedir'] . '/custom-orders';
			$dirs['url']    = $dirs['baseurl'] . '/custom-orders';
			return $dirs;
		};
		add_filter( 'upload_dir', $dir_filter );
		$up = wp_handle_upload( $_FILES['sketch'], array( 'test_form' => false, 'mimes' => exprinto_custom_order_mimes() ) ); // phpcs:ignore
		remove_filter( 'upload_dir', $dir_filter );
		if ( ! empty( $up['error'] ) ) {
			$fail( 'Файл не загружен: ' . $up['error'] . ' Допустимы JPG, PNG, WEBP, PDF, ZIP.' );
		}
		$file_path = $up['file'];
		$file_url  = $up['url'];
		$index     = dirname( $file_path ) . '/index.php';
		if ( ! file_exists( $index ) ) {
			file_put_contents( $index, '<?php // Silence.' ); // phpcs:ignore
		}
	}

	$size  = ( $f['width'] || $f['height'] ) ? trim( $f['width'] ) . ' × ' . trim( $f['height'] ) . ' мм' : 'не указан';
	$lines = array(
		'Имя'               => $f['name'],
		'Телефон'           => $f['phone'],
		'E-mail'            => $f['email'],
		'Изделие'           => $f['kind'],
		'Размер'            => $size,
		'Материал'          => $f['material'],
		'Цвета'             => $f['colors'],
		'Количество'        => $f['qty'],
		'Крепление'         => $f['mount'],
		'Срок'              => $f['term'],
		'Текст на табличке' => $f['text'],
		'Комментарий'       => $f['comment'],
		'Эскиз'             => $file_url,
		'Товар-ориентир'    => $f['product'],
		'Страница'          => $f['page'],
	);
	$body = '';
	foreach ( $lines as $label => $val ) {
		if ( '' !== trim( (string) $val ) ) {
			$body .= $label . ': ' . $val . "\n";
		}
	}

	$lead_id = wp_insert_post( array(
		'post_type'    => 'ex_lead',
		'post_status'  => 'private',
		'post_title'   => 'Индивидуальный заказ: ' . $f['name'] . ' — ' . $f['phone'],
		'post_content' => $body,
	) );

	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $f['email'] ) {
		$headers[] = 'Reply-To: ' . $f['name'] . ' <' . $f['email'] . '>';
	}
	wp_mail(
		exprinto_notify_emails(),
		'Индивидуальный заказ таблички — ' . $f['phone'] . ( $lead_id ? ' (№' . $lead_id . ')' : '' ),
		$body,
		$headers,
		$file_path ? array( $file_path ) : array()
	);

	if ( $f['email'] ) {
		wp_mail(
			$f['email'],
			'Мы получили вашу заявку — ' . get_bloginfo( 'name' ),
			"Здравствуйте, {$f['name']}!\n\nСпасибо за заявку на индивидуальную табличку. Мы посчитаем стоимость и свяжемся с вами по телефону {$f['phone']} в течение 30 минут в рабочее время.\n\nВаша заявка:\n\n{$body}\n— " . get_bloginfo( 'name' ) . ', ' . home_url( '/' ),
			array( 'Content-Type: text/plain; charset=UTF-8' )
		);
	}

	if ( $ajax ) {
		wp_send_json_success( array( 'message' => 'Заявка №' . $lead_id . ' принята. Перезвоним в течение 30 минут в рабочее время.' ) );
	}
	wp_safe_redirect( add_query_arg( 'lead', 'ok', $f['page'] ? $f['page'] : home_url( '/' ) ) );
	exit;
}
add_action( 'wp_ajax_exprinto_custom_order', 'exprinto_handle_custom_order' );
add_action( 'wp_ajax_nopriv_exprinto_custom_order', 'exprinto_handle_custom_order' );
add_action( 'admin_post_exprinto_custom_order', 'exprinto_handle_custom_order' );
add_action( 'admin_post_nopriv_exprinto_custom_order', 'exprinto_handle_custom_order' );

/** Кнопка, открывающая окно индивидуального заказа. */
function exprinto_custom_order_button( $label = 'Заказать индивидуальную табличку', $class = 'btn btn--ghost btn--lg' ) {
	$GLOBALS['exprinto_need_custom_modal'] = true;
	printf(
		'<button type="button" class="%s" data-custom-order aria-haspopup="dialog" aria-controls="custom-order">%s %s</button>',
		esc_attr( $class ),
		exprinto_icon( 'pen', 18 ), // phpcs:ignore
		esc_html( $label )
	);
}

/** Само окно — выводится в подвале, если на странице есть кнопка. */
add_action(
	'wp_footer',
	function () {
		if ( empty( $GLOBALS['exprinto_need_custom_modal'] ) ) {
			return;
		}
		get_template_part( 'template-parts/custom-order-modal' );
	},
	1
);

/* -------------------------------------------------------------------------
 * Заявка на расчёт стоимости (страница товара и конструктор)
 * ---------------------------------------------------------------------- */

/** Контактные поля и кнопка — внутри формы с параметрами таблички. */
function exprinto_quote_fields( $product_id, $context ) {
	global $wp;
	$page = $wp && isset( $wp->request ) ? home_url( user_trailingslashit( $wp->request ) ) : home_url( '/' );
	?>
	<div class="quote" data-quote>
		<input type="hidden" name="action" value="exprinto_quote">
		<input type="hidden" name="product_id" value="<?php echo (int) $product_id; ?>" data-builder-id>
		<input type="hidden" name="context" value="<?php echo esc_attr( $context ); ?>">
		<input type="hidden" name="page" value="<?php echo esc_url( $page ); ?>">
		<?php wp_nonce_field( 'exprinto_quote', 'exprinto_quote_nonce', false ); ?>
		<div class="hp" aria-hidden="true"><label>Сайт <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

		<div class="quote__note">
			<?php echo exprinto_icon( 'ruler', 20 ); // phpcs:ignore ?>
			<p><b>Размер — любой, цену назовём после расчёта.</b> Стоимость зависит от размера, формы и технологии: оставьте телефон — перезвоним в течение 15 минут в рабочее время.</p>
		</div>

		<div class="quote__grid">
			<label class="field"><span>Желаемый размер, мм</span><input type="text" name="size" maxlength="40" placeholder="Например: 600 × 300 или «подскажите»"></label>
			<label class="field field--s"><span>Количество</span><input type="number" name="qty" min="1" max="10000" value="1" inputmode="numeric"></label>
			<label class="field"><span>Имя <b>*</b></span><input type="text" name="name" autocomplete="name" maxlength="60" placeholder="Иван" required></label>
			<label class="field"><span>Телефон <b>*</b></span><input type="tel" name="phone" autocomplete="tel" maxlength="25" placeholder="+375 (29) 123-45-67" required></label>
			<label class="field field--wide"><span>E-mail (необязательно — пришлём макет)</span><input type="email" name="email" autocomplete="email" maxlength="80" placeholder="you@mail.by"></label>
			<label class="field field--wide"><span>Комментарий</span><textarea name="comment" rows="2" maxlength="600" placeholder="Тип стены, город доставки, пожелания к макету"></textarea></label>
		</div>
		<label class="check"><input type="checkbox" name="agree" value="1" required> <span>Согласен на обработку персональных данных согласно <a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/politika-konfidencialnosti/' ) ); ?>" target="_blank">политике конфиденциальности</a></span></label>
		<p class="custom-form__error" role="alert" data-quote-error hidden></p>
		<button type="submit" class="btn btn--accent btn--lg quote__submit">Рассчитать стоимость <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></button>
		<p class="quote__hint"><?php echo exprinto_icon( 'shield', 16 ); // phpcs:ignore ?> Ни к чему не обязывает. Оплата — только после согласования цены и макета.</p>
	</div>
	<div class="quote-done" data-quote-done hidden>
		<span class="custom-done__icon"><?php echo exprinto_icon( 'check', 34 ); // phpcs:ignore ?></span>
		<p class="quote-done__title">Заявка отправлена</p>
		<p data-quote-done-text>Перезвоним в течение 15 минут в рабочее время, назовём цену и пришлём макет.</p>
	</div>
	<?php
}

function exprinto_handle_quote() {
	$ajax = wp_doing_ajax();
	$fail = function ( $msg ) use ( $ajax ) {
		if ( $ajax ) {
			wp_send_json_error( array( 'message' => $msg ), 400 );
		}
		wp_die( esc_html( $msg ), 'Ошибка', array( 'back_link' => true ) );
	};
	if ( ! isset( $_POST['exprinto_quote_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['exprinto_quote_nonce'] ), 'exprinto_quote' ) ) {
		$fail( 'Сессия устарела. Обновите страницу и отправьте заявку ещё раз.' );
	}
	if ( ! empty( $_POST['website'] ) ) { // ловушка для ботов.
		$ajax ? wp_send_json_success() : exit;
	}
	$get = function ( $k ) {
		return isset( $_POST[ $k ] ) ? trim( sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) ) : '';
	};
	$name  = $get( 'name' );
	$phone = $get( 'phone' );
	$email = sanitize_email( $get( 'email' ) );
	if ( '' === $name || strlen( preg_replace( '/\D/', '', $phone ) ) < 7 ) {
		$fail( 'Укажите имя и телефон — без них мы не сможем назвать цену.' );
	}

	$pid     = absint( $_POST['product_id'] ?? 0 );
	$product = $pid && function_exists( 'wc_get_product' ) ? wc_get_product( $pid ) : null;
	$plate   = $product && function_exists( 'exprinto_product_plate' ) ? exprinto_product_plate( $product ) : null;

	$lines = array(
		'Имя'     => $name,
		'Телефон' => $phone,
		'E-mail'  => $email,
		'Модель'  => $product ? $product->get_name() : '',
	);
	if ( $plate ) {
		$labels = exprinto_plate_labels( $pid );
		$finish = sanitize_key( $get( 'ex_finish' ) );
		$finish = isset( exprinto_finishes()[ $finish ] ) ? $finish : $plate['finish'];
		$vals   = array(
			'type'   => $get( 'ex_type' ),
			'street' => $get( 'ex_street' ),
			'number' => $get( 'ex_number' ),
			'finish' => $finish,
			'base'   => isset( exprinto_bases()[ $get( 'ex_base' ) ] ) ? $get( 'ex_base' ) : $plate['base'],
		);
		if ( 'print' !== $finish ) {
			$vals['metal'] = isset( exprinto_metals()[ $get( 'ex_metal' ) ] ) ? $get( 'ex_metal' ) : $plate['metal'];
		} else {
			$vals['text'] = isset( exprinto_text_colors()[ $get( 'ex_text' ) ] ) ? $get( 'ex_text' ) : $plate['text'];
		}
		foreach ( $vals as $k => $v ) {
			if ( '' !== $v && isset( $labels[ $k ] ) ) {
				$lines[ $labels[ $k ] ] = exprinto_plate_value( $k, $v );
			}
		}
	}
	$lines['Желаемый размер'] = $get( 'size' ) ? $get( 'size' ) : 'не указан — подобрать';
	$lines['Количество']      = max( 1, absint( $_POST['qty'] ?? 1 ) );
	$lines['Комментарий']     = sanitize_textarea_field( wp_unslash( $_POST['comment'] ?? '' ) );
	$lines['Источник']        = $get( 'context' );
	$lines['Страница']        = esc_url_raw( wp_unslash( $_POST['page'] ?? '' ) );

	$body = '';
	foreach ( $lines as $label => $val ) {
		if ( '' !== trim( (string) $val ) ) {
			$body .= $label . ': ' . $val . "\n";
		}
	}
	$lead_id = wp_insert_post( array(
		'post_type'    => 'ex_lead',
		'post_status'  => 'private',
		'post_title'   => 'Расчёт: ' . $name . ' — ' . $phone,
		'post_content' => $body,
	) );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	wp_mail( exprinto_notify_emails(), 'Заявка на расчёт таблички — ' . $phone . ( $lead_id ? ' (№' . $lead_id . ')' : '' ), $body, $headers );
	if ( $email ) {
		wp_mail(
			$email,
			'Мы получили вашу заявку — ' . get_bloginfo( 'name' ),
			"Здравствуйте, {$name}!\n\nСпасибо за заявку. Мы посчитаем стоимость таблички и перезвоним по телефону {$phone} в течение 15 минут в рабочее время.\n\nВаша заявка:\n\n{$body}\n— " . get_bloginfo( 'name' ) . ', ' . home_url( '/' ),
			array( 'Content-Type: text/plain; charset=UTF-8' )
		);
	}
	$msg = 'Заявка' . ( $lead_id ? ' №' . $lead_id : '' ) . ' принята. Перезвоним в течение 15 минут в рабочее время, назовём цену и пришлём макет.';
	if ( $ajax ) {
		wp_send_json_success( array( 'message' => $msg ) );
	}
	$back = esc_url_raw( wp_unslash( $_POST['page'] ?? '' ) );
	wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ? $back : home_url( '/' ) ) );
	exit;
}
add_action( 'wp_ajax_exprinto_quote', 'exprinto_handle_quote' );
add_action( 'wp_ajax_nopriv_exprinto_quote', 'exprinto_handle_quote' );
add_action( 'admin_post_exprinto_quote', 'exprinto_handle_quote' );
add_action( 'admin_post_nopriv_exprinto_quote', 'exprinto_handle_quote' );
