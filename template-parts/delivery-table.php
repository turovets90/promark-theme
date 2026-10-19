<?php
/**
 * Таблица способов доставки (вкладка товара, страница доставки).
 *
 * @package Exprinto
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="table-wrap">
	<table class="delivery-table">
		<thead>
			<tr><th scope="col">Способ</th><th scope="col">Куда</th><th scope="col">Срок</th><th scope="col">Стоимость</th></tr>
		</thead>
		<tbody>
			<tr><td><b>Европочта</b></td><td>Отделение в любом городе РБ</td><td>1–3 дня</td><td>4,50 руб.</td></tr>
			<tr><td><b>Белпочта</b></td><td>Любое почтовое отделение, включая деревни и агрогородки</td><td>2–4 дня</td><td>4,00 руб.</td></tr>
			<tr><td><b>Курьер по Минску</b></td><td>До двери, в удобный интервал</td><td>в день готовности</td><td>8,00 руб.</td></tr>
			<tr><td><b>Самовывоз</b></td><td>С производства в Минске</td><td>сразу после изготовления</td><td>бесплатно</td></tr>
		</tbody>
	</table>
</div>
<p class="note"><?php echo exprinto_icon( 'check', 18 ); // phpcs:ignore ?> При заказе от 100 руб. доставка Европочтой и Белпочтой — бесплатно. Оплата при получении: наличными или картой.</p>
