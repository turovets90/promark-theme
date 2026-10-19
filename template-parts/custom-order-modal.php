<?php
/**
 * Всплывающее окно «Индивидуальная табличка».
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;

$opts    = exprinto_custom_order_options();
$product = ( function_exists( 'is_product' ) && is_product() ) ? get_the_title() : '';
$plate   = ( $product && function_exists( 'exprinto_product_plate' ) ) ? exprinto_product_plate( get_the_ID() ) : null;
?>
<dialog class="modal" id="custom-order" aria-labelledby="custom-order-title">
	<div class="modal__box">
		<button type="button" class="modal__close" data-modal-close aria-label="Закрыть"><?php echo exprinto_icon( 'close', 22 ); // phpcs:ignore ?></button>

		<div class="modal__head">
			<?php echo exprinto_eyebrow( 'индивидуальный заказ' ); // phpcs:ignore ?>
			<p class="modal__title" id="custom-order-title">Табличка по вашему размеру, тексту или макету</p>
			<p class="modal__lead">Заполните, что знаете, — остальное подскажет дизайнер. Посчитаем стоимость и перезвоним в течение 30 минут.</p>
		</div>

		<form class="custom-form" method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-custom-form novalidate>
			<input type="hidden" name="action" value="exprinto_custom_order">
			<input type="hidden" name="product" value="<?php echo esc_attr( $product ); ?>">
			<input type="hidden" name="page" value="<?php global $wp; echo esc_url( home_url( user_trailingslashit( $wp->request ) ) ); ?>">
			<?php wp_nonce_field( 'exprinto_custom', 'exprinto_custom_nonce' ); ?>
			<div class="hp" aria-hidden="true"><label>Сайт <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

			<fieldset class="custom-form__group">
				<legend>Что изготовить</legend>
				<div class="custom-form__grid">
					<label class="field field--wide"><span>Изделие</span>
						<select name="kind">
							<?php foreach ( $opts['kind'] as $o ) : ?>
								<option><?php echo esc_html( $o ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="field"><span>Ширина, мм</span><input type="number" name="width" min="50" max="3000" step="1" inputmode="numeric" placeholder="<?php echo esc_attr( $plate ? $plate['w'] : '600' ); ?>"></label>
					<label class="field"><span>Высота, мм</span><input type="number" name="height" min="50" max="3000" step="1" inputmode="numeric" placeholder="<?php echo esc_attr( $plate ? $plate['h'] : '200' ); ?>"></label>
					<label class="field"><span>Материал</span>
						<select name="material">
							<?php foreach ( $opts['material'] as $o ) : ?>
								<option><?php echo esc_html( $o ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="field field--wide"><span>Цвета (фон / текст)</span><input type="text" name="colors" maxlength="80" placeholder="Например: тёмно-синий фон, белые буквы"></label>
					<label class="field field--wide"><span>Текст на табличке <b>*</b></span><textarea name="text" rows="3" maxlength="600" placeholder="ул. Солнечная, 14&#10;или: Подъезд 2, кв. 1–36"></textarea></label>
					<label class="field field--s"><span>Количество, шт.</span><input type="number" name="qty" min="1" max="10000" value="1" inputmode="numeric"></label>
					<label class="field"><span>Крепление</span>
						<select name="mount">
							<?php foreach ( $opts['mount'] as $o ) : ?>
								<option><?php echo esc_html( $o ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="field field--s"><span>Срок</span>
						<select name="term">
							<?php foreach ( $opts['term'] as $o ) : ?>
								<option><?php echo esc_html( $o ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="field field--wide file-field">
						<span>Эскиз, фото образца или макет</span>
						<input type="file" name="sketch" accept=".jpg,.jpeg,.png,.webp,.pdf,.zip" data-file-input>
						<span class="file-field__ui"><?php echo exprinto_icon( 'doc', 20 ); // phpcs:ignore ?> <em data-file-name>Прикрепить файл</em> <small>JPG, PNG, PDF, ZIP · до 10 МБ</small></span>
					</label>
				</div>
			</fieldset>

			<fieldset class="custom-form__group">
				<legend>Ваши контакты</legend>
				<div class="custom-form__grid">
					<label class="field"><span>Имя <b>*</b></span><input type="text" name="name" autocomplete="name" required maxlength="60" placeholder="Иван"></label>
					<label class="field"><span>Телефон <b>*</b></span><input type="tel" name="phone" autocomplete="tel" required maxlength="25" placeholder="+375 (29) 123-45-67"></label>
					<label class="field field--wide"><span>E-mail (пришлём макет и счёт)</span><input type="email" name="email" autocomplete="email" maxlength="80" placeholder="you@mail.by"></label>
					<label class="field field--wide"><span>Комментарий</span><textarea name="comment" rows="2" maxlength="600" placeholder="Тип стены, адрес доставки, пожелания"></textarea></label>
				</div>
			</fieldset>

			<label class="check"><input type="checkbox" name="agree" value="1" required> <span>Согласен на обработку персональных данных согласно <a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/politika-konfidencialnosti/' ) ); ?>" target="_blank">политике конфиденциальности</a></span></label>

			<p class="custom-form__error" role="alert" data-custom-error hidden></p>
			<button class="btn btn--accent btn--lg custom-form__submit" type="submit">Отправить заявку <?php echo exprinto_icon( 'arrow', 18 ); // phpcs:ignore ?></button>
		</form>

		<div class="custom-done" data-custom-done hidden>
			<span class="custom-done__icon"><?php echo exprinto_icon( 'check', 34 ); // phpcs:ignore ?></span>
			<p class="modal__title">Заявка отправлена</p>
			<p data-custom-done-text>Перезвоним в течение 30 минут в рабочее время.</p>
			<button type="button" class="btn btn--ghost" data-modal-close>Закрыть</button>
		</div>
	</div>
</dialog>
