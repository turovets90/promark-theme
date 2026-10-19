/*! Exprinto theme */
(function () {
	'use strict';

	var $ = function (s, c) { return (c || document).querySelector(s); };
	var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

	/* ---------- Меню ---------- */
	var burger = $('.burger');
	if (burger) {
		burger.addEventListener('click', function () {
			var open = document.body.classList.toggle('nav-open');
			burger.setAttribute('aria-expanded', open ? 'true' : 'false');
			burger.setAttribute('aria-label', open ? 'Закрыть меню' : 'Открыть меню');
		});
		var closeNav = function () {
			document.body.classList.remove('nav-open');
			burger.setAttribute('aria-expanded', 'false');
			burger.setAttribute('aria-label', 'Открыть меню');
		};
		document.addEventListener('click', function (e) {
			if (document.body.classList.contains('nav-open') && !e.target.closest('#site-nav') && !e.target.closest('.burger')) { closeNav(); }
		});
		document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeNav(); } });
		$$('#site-nav a').forEach(function (a) {
			a.addEventListener('click', function () { document.body.classList.remove('nav-open'); burger.setAttribute('aria-expanded', 'false'); });
		});
	}

	var header = $('.site-header');
	if (header) {
		var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 40); };
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ---------- Превью табличек ---------- */
	function fontsReady() {
		if (!document.fonts || !document.fonts.load) { return Promise.resolve(); }
		return Promise.all([
			document.fonts.load("400 40px 'Roboto Condensed'"),
			document.fonts.load("500 40px 'Roboto Condensed'"),
			document.fonts.load("700 40px 'Roboto Condensed'"),
			document.fonts.load("700 40px 'PT Serif'"),
			document.fonts.load("400 40px Lobster"),
			document.fonts.load("700 40px Oswald"),
			document.fonts.load("500 40px Oswald")
		]).catch(function () {});
	}

	function readFields(scope) {
		var get = function (name) {
			var el = scope.querySelector('[data-plate="' + name + '"]');
			if (!el) { return ''; }
			if (el.type === 'radio') {
				var chk = scope.querySelector('[data-plate="' + name + '"]:checked');
				return chk ? chk.value : '';
			}
			return el.value;
		};
		return { type: get('type'), street: get('street'), number: get('number'), scheme: get('scheme'), base: get('base'), metal: get('metal'), text: get('text'), finish: get('finish') };
	}

	function draw(target, cfg) {
		if (!window.ExPlate || !target) { return; }
		target.innerHTML = window.ExPlate.svg(cfg);
		var svg = target.firstChild;
		if (svg && cfg.w && cfg.h) { target.style.setProperty('--ratio', cfg.w / cfg.h); }
	}

	function bindSwatchName(scope) {
		$$('[data-plate="scheme"], [data-plate="base"], [data-plate="metal"], [data-plate="text"]', scope).forEach(function (r) {
			r.addEventListener('change', function () {
				var fs = r.closest('fieldset');
				var out = fs && $('.swatches__name', fs);
				if (out) { out.textContent = r.getAttribute('data-name'); }
			});
		});
	}
	function setRadio(scope, name, value) {
		var r = scope.querySelector('[data-plate="' + name + '"][value="' + value + '"]');
		if (r) { r.checked = true; var fs = r.closest('fieldset'); var out = fs && $('.swatches__name', fs); if (out) { out.textContent = r.getAttribute('data-name'); } }
	}
	function money(n) { return Number(n).toFixed(2).replace('.', ',') + ' ' + ((window.exprintoData && exprintoData.currency) || 'руб.'); }
	/** Переключатель «объёмные / печать»: виден, если у товара есть обе цены. */
	function setFinishToggle(scope, prices, finish) {
		var box = $('[data-finish-toggle]', scope);
		if (!box) { return; }
		var both = prices && prices.mirror != null && prices.print != null;
		box.hidden = !both;
		box.disabled = !both;
		['mirror', 'print'].forEach(function (k) {
			var el = box.querySelector('[data-finish-price="' + k + '"]');
			if (el) { el.textContent = prices && prices[k] != null ? money(prices[k]) : ''; }
		});
		var r = box.querySelector('[data-plate="finish"][value="' + finish + '"]');
		if (r) { r.checked = true; }
	}
	/** Показать палитру печати или акрила; скрытая отключается, чтобы не уходить в форму. */
	function setFinish(scope, finish) {
		$$('[data-finish-group]', scope).forEach(function (g) {
			var on = g.getAttribute('data-finish-group') === finish;
			g.hidden = !on;
			(g.tagName === 'FIELDSET' ? [g] : $$('fieldset', g)).forEach(function (fs) { fs.disabled = !on; });
		});
	}

	fontsReady().then(function () {
		// Статичные превью (корзина, 404).
		$$('[data-plate-static]').forEach(function (el) {
			try {
				var cfg = JSON.parse(el.getAttribute('data-plate-static'));
				var target = el.classList.contains('plate-preview') ? el : el;
				if (el.classList.contains('cart-plate')) {
					el.innerHTML = '';
					el.classList.add('plate-preview');
				}
				draw(target, cfg);
			} catch (e) {}
		});

		// Карточка товара.
		$$('[data-plate-config]').forEach(function (box) {
			var base = JSON.parse(box.getAttribute('data-plate-config'));
			var preview = $('[data-plate-preview]', box);
			var form = box.closest('form') || box;
			var livePrice = $('[data-live-price]');
			var update = function () {
				var f = readFields(form), cfg = Object.assign({}, base);
				Object.keys(f).forEach(function (k) { if (f[k] !== '' || k === 'type' || k === 'street') { cfg[k] = f[k]; } });
				draw(preview, cfg);
			};
			$$('[data-plate="finish"]', form).forEach(function (r) {
				r.addEventListener('change', function () {
					setFinish(form, r.value);
					if (livePrice && base.prices && base.prices[r.value] != null) {
						livePrice.innerHTML = '<span class="woocommerce-Price-amount amount"><bdi>' + money(base.prices[r.value]) + '</bdi></span>';
					}
				});
			});
			form.addEventListener('input', update);
			form.addEventListener('change', update);
			bindSwatchName(form);
			update();
		});

		// Конструктор на главной.
		$$('[data-builder]').forEach(function (form) {
			var formats = JSON.parse(form.getAttribute('data-formats'));
			var preview = $('[data-plate-preview]', form);
			var current = formats[0];
			var update = function () {
				var f = readFields(form);
				var fin = f.finish || current.finish;
				draw(preview, {
					layout: current.layout, w: current.w, h: current.h, finish: fin, font: current.font,
					base: f.base || current.base, metal: f.metal || current.metal, text: f.text || current.text,
					type: f.type, street: f.street, number: f.number
				});
			};
			var showPrice = function () {
				var fin = (form.querySelector('[data-plate="finish"]:checked') || {}).value || current.finish;
				var pr = current.prices && current.prices[fin] != null ? current.prices[fin] : current.price;
				$('[data-builder-price]', form).textContent = money(pr);
				var mat = $('[data-builder-material]', form);
				if (mat) {
					mat.textContent = fin === current.finish ? (current.material || '') : (fin === 'mirror' ? 'Алюминиевый композит + объёмные буквы из акрила' : 'Алюминиевый композит, УФ-печать');
				}
			};
			$$('[data-plate="finish"]', form).forEach(function (r) {
				r.addEventListener('change', function () { setFinish(form, r.value); showPrice(); });
			});
			// Миниатюры моделей.
			$$('[data-format-thumb]', form).forEach(function (el) {
				var f = formats[+el.getAttribute('data-format-thumb')];
				el.innerHTML = window.ExPlate.svg({ layout: f.layout, w: f.w, h: f.h, finish: f.finish, font: f.font, scheme: f.scheme, base: f.base, metal: f.metal, text: f.text, title: f.name });
			});
			var setLabels = function (f) {
				['type', 'street', 'number'].forEach(function (k) {
					var el = form.querySelector('[data-label="' + k + '"]');
					if (el && f.labels) { el.textContent = f.labels[k]; }
				});
				var st = form.querySelector('[data-plate="street"]');
				if (st) { st.required = !!f.req; }
			};
			$$('input[name="ex_format"]', form).forEach(function (r) {
				r.addEventListener('change', function () {
					var prevLayout = current.layout;
					current = formats[+r.value];
					form.action = current.url;
					$('[data-builder-id]', form).value = current.id;

					$('[data-builder-size]', form).textContent = current.w + '×' + current.h + ' мм';
					$('[data-builder-material]', form).textContent = current.material || '';
					var link = $('[data-builder-link]', form); if (link) { link.href = current.url; }
					setFinishToggle(form, current.prices, current.finish);
					setFinish(form, current.finish);
					setRadio(form, 'base', current.base); setRadio(form, 'metal', current.metal); setRadio(form, 'text', current.text);
					showPrice();
					setLabels(current);
					// Тип по умолчанию для номерных макетов — без подписи.
					var typeSel = form.querySelector('[data-plate="type"]');
					var numberLike = ['house', 'vertical'];
					if (typeSel && numberLike.indexOf(current.layout) !== numberLike.indexOf(prevLayout)) {
						typeSel.value = current.defaults ? current.defaults.type : 'улица';
					}
					update();
				});
			});
			form.addEventListener('input', update);
			form.addEventListener('change', update);
			bindSwatchName(form);
			update();
		});

		// Демонстрация в первом экране.
		var demo = $('[data-plate-demo]');
		if (demo) {
			var samples = [
				{ layout: 'line', w: 900, h: 270, finish: 'mirror', base: 'graphite', metal: 'silver', type: 'улица', street: 'Солнечная', number: '14' },
				{ layout: 'wave', w: 630, h: 360, finish: 'mirror', base: 'blue', metal: 'silver', type: 'улица', street: 'Садовая', number: '7' },
				{ layout: 'crest', w: 590, h: 330, finish: 'print', scheme: 'green-white', font: 'cond', type: 'улица', street: 'Лесная', number: '23' },
				{ layout: 'arch', w: 620, h: 380, finish: 'mirror', base: 'brown', metal: 'gold', type: 'улица', street: 'Победы', number: '102' },
				{ layout: 'ornate', w: 700, h: 290, finish: 'print', scheme: 'blue-white', type: 'переулок', street: 'Речной', number: '5' }
			];
			var i = 0;
			draw(demo, samples[0]);
			var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (!reduce) {
				setInterval(function () {
					i = (i + 1) % samples.length;
					demo.classList.add('is-swapping');
					setTimeout(function () { draw(demo, samples[i]); demo.classList.remove('is-swapping'); }, 350);
				}, 3600);
			}
		}
	});

	/* ---------- Окно индивидуального заказа ---------- */
	var modal = $('#custom-order');
	if (modal) {
		var form = $('[data-custom-form]', modal);
		var done = $('[data-custom-done]', modal);
		var errBox = $('[data-custom-error]', modal);
		var open = function () {
			form.hidden = false; done.hidden = true; errBox.hidden = true;
			if (typeof modal.showModal === 'function') { modal.showModal(); } else { modal.setAttribute('open', ''); }
			document.documentElement.classList.add('modal-open');
			var first = $('select, input:not([type=hidden])', form);
			if (first && window.matchMedia('(min-width: 783px)').matches) { first.focus(); }
		};
		var close = function () {
			if (typeof modal.close === 'function') { modal.close(); } else { modal.removeAttribute('open'); }
		};
		modal.addEventListener('close', function () { document.documentElement.classList.remove('modal-open'); });
		$$('[data-custom-order]').forEach(function (b) { b.addEventListener('click', open); });
		$$('[data-modal-close]', modal).forEach(function (b) { b.addEventListener('click', close); });
		modal.addEventListener('click', function (e) { if (e.target === modal) { close(); } });

		var fileInput = $('[data-file-input]', modal);
		if (fileInput) {
			fileInput.addEventListener('change', function () {
				var f = fileInput.files && fileInput.files[0];
				$('[data-file-name]', modal).textContent = f ? f.name : 'Прикрепить файл';
				fileInput.closest('.file-field').classList.toggle('has-file', !!f);
			});
		}

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			errBox.hidden = true;
			var fv = function (n) { var el = form.querySelector('[name="' + n + '"]'); return el ? el : {}; };
			var need = [];
			if (!(fv('name').value || '').trim()) { need.push('имя'); }
			if ((fv('phone').value || '').replace(/\D/g, '').length < 7) { need.push('телефон'); }
			if (!(fv('text').value || '').trim() && !(fileInput && fileInput.files.length)) { need.push('текст таблички или эскиз'); }
			if (!fv('agree').checked) { need.push('согласие на обработку данных'); }
			if (need.length) { errBox.textContent = 'Заполните: ' + need.join(', ') + '.'; errBox.hidden = false; return; }
			if (fileInput && fileInput.files[0] && fileInput.files[0].size > 10 * 1024 * 1024) { errBox.textContent = 'Файл больше 10 МБ — пришлите его в мессенджер.'; errBox.hidden = false; return; }

			var btn = $('.custom-form__submit', form);
			btn.disabled = true; btn.classList.add('is-loading');
			fetch(exprintoData.ajax, { method: 'POST', body: new FormData(form), credentials: 'same-origin' })
				.then(function (r) { return r.json().catch(function () { return { success: false }; }); })
				.then(function (res) {
					if (res && res.success) {
						if (res.data && res.data.message) { $('[data-custom-done-text]', modal).textContent = res.data.message; }
						form.reset();
						if (fileInput) { $('[data-file-name]', modal).textContent = 'Прикрепить файл'; }
						form.hidden = true; done.hidden = false;
					} else {
						errBox.textContent = (res && res.data && res.data.message) || 'Не удалось отправить. Позвоните нам или напишите в мессенджер.';
						errBox.hidden = false;
					}
				})
				.catch(function () { errBox.textContent = 'Нет соединения. Попробуйте ещё раз.'; errBox.hidden = false; })
				.then(function () { btn.disabled = false; btn.classList.remove('is-loading'); });
		});
	}

	/* ---------- Количество в корзине (Woo fragments) ---------- */
	if (window.jQuery) {
		window.jQuery(document.body).on('added_to_cart', function () {
			var c = $('.cart-count');
			if (c) { c.classList.remove('is-empty'); }
		});
	}
})();
