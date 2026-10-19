/*!
 * Promark — генератор превью адресных табличек (SVG).
 * Конструктор на главной, карточка товара, генерация фото товаров.
 *
 * finish: 'print'  — УФ-печать: цветовая схема scheme (фон / текст);
 *         'mirror' — объёмные буквы из зеркального акрила: основа base + металл metal (silver | gold).
 */
(function (root) {
	'use strict';

	/* ---------- Палитры ---------- */

	var SCHEMES = {
		'white-black':    { name: 'Белый / чёрный', bg: '#FFFFFF', fg: '#1B1B1D' },
		'white-graphite': { name: 'Белый / графит', bg: '#FFFFFF', fg: '#4A4D53' },
		'graphite-white': { name: 'Графит / белый', bg: '#4A4D53', fg: '#FFFFFF' },
		'black-white':    { name: 'Чёрный / белый', bg: '#1B1B1D', fg: '#FFFFFF' },
		'white-green':    { name: 'Белый / зелёный', bg: '#FFFFFF', fg: '#1D5B3E' },
		'green-white':    { name: 'Зелёный / белый', bg: '#1D5B3E', fg: '#FFFFFF' },
		'blue-white':     { name: 'Синий / белый', bg: '#22509F', fg: '#FFFFFF' },
		'white-blue':     { name: 'Белый / синий', bg: '#FFFFFF', fg: '#22509F' },
		'burgundy-white': { name: 'Бордовый / белый', bg: '#74202C', fg: '#FFFFFF' },
		'brown-white':    { name: 'Шоколад / белый', bg: '#4A2C22', fg: '#FFFFFF' },
		'yellow-black':   { name: 'Жёлтый / чёрный', bg: '#F3C433', fg: '#1B1B1D' },
		'ivory-black':    { name: 'Слоновая кость / чёрный', bg: '#F1E8D2', fg: '#1B1B1D' }
	};

	// Цвета алюминиевого композита для табличек с объёмными буквами.
	var BASES = {
		'graphite': { name: 'Графит', color: '#44484E' },
		'black':    { name: 'Чёрный', color: '#1C1D20' },
		'brown':    { name: 'Коричневый', color: '#4B2A1F' },
		'blue':     { name: 'Синий', color: '#1F4EA6' },
		'green':    { name: 'Зелёный', color: '#1B5A3C' },
		'burgundy': { name: 'Бордовый', color: '#6B1E29' },
		'white':    { name: 'Белый', color: '#F7F7F5' },
		'ivory':    { name: 'Слоновая кость', color: '#EFE6CF' },
		'yellow':   { name: 'Жёлтый', color: '#F3C433' }
	};

	// Цвет надписей при УФ-печати.
	var TEXTS = {
		'white':    { name: 'Белый', color: '#FFFFFF' },
		'black':    { name: 'Чёрный', color: '#1B1B1D' },
		'graphite': { name: 'Графит', color: '#4A4D53' },
		'silver':   { name: 'Серебристый', color: '#B8BDC3' },
		'gold':     { name: 'Золотистый', color: '#C9A24A' },
		'yellow':   { name: 'Жёлтый', color: '#F3C433' },
		'blue':     { name: 'Синий', color: '#22509F' },
		'green':    { name: 'Зелёный', color: '#1D5B3E' },
		'brown':    { name: 'Коричневый', color: '#4A2C22' },
		'red':      { name: 'Красный', color: '#B3262E' }
	};

	var METALS = {
		'silver': { name: 'Зеркальное серебро', stops: ['#FBFCFD', '#B9C0C8', '#EEF1F4', '#7E8791', '#DDE2E7', '#9AA2AB'], edge: '#5E656D' },
		'gold':   { name: 'Зеркальное золото', stops: ['#FFF4CF', '#C99A3C', '#FBE7A8', '#946A1E', '#EBCB7A', '#B4862F'], edge: '#7A5518' },
		'white':  { name: 'Белый акрил', stops: ['#FFFFFF', '#F1F2F3', '#FFFFFF', '#E3E5E8', '#F7F8F9', '#E9EBEE'], edge: '#B9BEC4' },
		'black':  { name: 'Чёрный акрил', stops: ['#4A4D52', '#141517', '#3A3D42', '#0C0D0E', '#2C2F33', '#151618'], edge: '#000000' }
	};

	function isLight(hex) {
		var h = String(hex).replace('#', '');
		if (h.length !== 6) { return false; }
		var r = parseInt(h.substr(0, 2), 16), g = parseInt(h.substr(2, 2), 16), b = parseInt(h.substr(4, 2), 16);
		return (0.299 * r + 0.587 * g + 0.114 * b) > 170;
	}

	var F = {
		sans:   "'Roboto Condensed', 'Arial Narrow', Arial, sans-serif",
		serif:  "'PT Serif', Georgia, 'Times New Roman', serif",
		script: "Lobster, 'PT Serif', Georgia, serif",
		cond:   "Oswald, 'Roboto Condensed', 'Arial Narrow', sans-serif"
	};
	var CAP = { sans: 0.711, serif: 0.70, script: 0.72, cond: 0.81 };

	/* ---------- Утилиты ---------- */

	var canvas;
	function measure(text, weight, family, size) {
		if (!canvas) { canvas = document.createElement('canvas'); }
		var ctx = canvas.getContext('2d');
		ctx.font = weight + ' ' + size + 'px ' + family;
		return ctx.measureText(text).width;
	}
	function esc(s) {
		return String(s == null ? '' : s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}
	function fit(text, weight, family, size, maxW, minRatio) {
		var w = measure(text, weight, family, size);
		if (w <= maxW || !w) { return { size: size, width: w }; }
		var s = Math.max(size * (maxW / w), size * (minRatio || 0.4));
		return { size: s, width: measure(text, weight, family, s) };
	}
	function n(v) { return Math.round(v * 10) / 10; }
	/** Текст. fill — токен %FG% / %BG% или цвет. */
	function T(x, y, size, weight, fam, txt, anchor, fill, extra) {
		return '<text x="' + n(x) + '" y="' + n(y) + '" font-size="' + n(size) + '" font-weight="' + weight + '" font-family="' + esc(F[fam]) + '" fill="' + (fill || '%FG%') + '"' +
			(anchor ? ' text-anchor="' + anchor + '"' : '') + (extra || '') + '>' + esc(txt) + '</text>';
	}
	function R(x, y, w, h, rx, fill) {
		return '<rect x="' + n(x) + '" y="' + n(y) + '" width="' + n(w) + '" height="' + n(h) + '"' + (rx ? ' rx="' + n(rx) + '"' : '') + ' fill="' + (fill || '%FG%') + '"/>';
	}
	/** Номер дома + до 2 символов: «14», «14А», «185/2». */
	function capTop(base, size, fam) { return base - size * CAP[fam]; }

	/* ---------- Макеты ----------
	 * Каждый возвращает { w, h, shape?: path d, body, border?: {inset, width}, mount: 'holes'|'standoffs'|'side-holes'|'none', rx? }
	 */

	// Широкая: плашка «улица», линия, название, крупный номер справа.
	function layoutLine(o) {
		var w = o.w, h = o.h, pad = h * 0.13, out = '', fam = 'sans';
		var num = fit(o.number, 700, F[fam], h * 0.80, w * 0.34);
		var numX = w - pad * 1.05;
		out += T(numX, h / 2 + CAP[fam] * num.size / 2, num.size, 700, fam, o.number, 'end');
		var leftEnd = numX - num.width - pad * 0.75, leftW = leftEnd - pad;
		if (o.type) {
			var ts = fit(o.type, 500, F[fam], h * 0.16, leftW * 0.8);
			var pillH = ts.size * 1.32, pillY = h * 0.47 - pillH - h * 0.045, pillW = ts.width + ts.size * 0.9;
			out += R(pad, pillY, pillW, pillH, 0);
			out += T(pad + ts.size * 0.45, pillY + pillH / 2 + CAP[fam] * ts.size / 2, ts.size, 500, fam, o.type, '', '%BG%');
		}
		out += R(pad, h * 0.5 - h * 0.006, leftW, h * 0.012, 0);
		var st = fit(o.street.toUpperCase(), 400, F[fam], h * 0.27, leftW);
		out += T(pad - st.size * 0.03, h * 0.53 + CAP[fam] * st.size + h * 0.06, st.size, 400, fam, o.street.toUpperCase());
		return { w: w, h: h, body: out, mount: o.finish === 'mirror' ? 'standoffs' : 'holes' };
	}

	// Компактная: номер сверху справа.
	function layoutQuadro(o) {
		var w = o.w, h = o.h, pad = h * 0.12, out = '', fam = 'sans';
		var num = fit(o.number, 700, F[fam], h * 0.56, w * 0.6);
		var numBase = pad + CAP[fam] * num.size;
		out += T(w - pad, numBase, num.size, 700, fam, o.number, 'end');
		var leftW = w - pad * 2 - num.width - pad * 0.5;
		if (o.type) {
			var ts = fit(o.type, 500, F[fam], h * 0.13, Math.max(leftW, w * 0.25));
			var pillH = ts.size * 1.32, pillW = ts.width + ts.size * 0.9, pillY = numBase - pillH;
			out += R(pad, pillY, pillW, pillH, 0);
			out += T(pad + ts.size * 0.45, pillY + pillH / 2 + CAP[fam] * ts.size / 2, ts.size, 500, fam, o.type, '', '%BG%');
		}
		var lineY = numBase + h * 0.06;
		out += R(pad, lineY, w - pad * 2, h * 0.012, 0);
		var st = fit(o.street.toUpperCase(), 400, F[fam], h * 0.2, w - pad * 2);
		out += T(pad - st.size * 0.03, lineY + h * 0.05 + CAP[fam] * st.size, st.size, 400, fam, o.street.toUpperCase());
		return { w: w, h: h, body: out, mount: 'holes' };
	}

	// Классика: рамка, засечки, номер в плашке.
	function layoutClassic(o) {
		var w = o.w, h = o.h, ins = h * 0.1, out = '', fam = 'serif';
		var boxW = h * 0.9, boxY = ins * 1.8, boxH = h - ins * 3.6;
		var num = fit(o.number, 700, F[fam], h * 0.6, boxW * 0.84);
		boxW = Math.max(boxW, num.width + h * 0.25);
		var boxX = w - ins * 1.8 - boxW;
		out += R(boxX, boxY, boxW, boxH, h * 0.05);
		out += T(boxX + boxW / 2, h / 2 + CAP[fam] * num.size / 2, num.size, 700, fam, o.number, 'middle', '%BG%');
		var cx = (ins * 2 + boxX) / 2, avail = boxX - ins * 4;
		var st = fit(o.street, 700, F[fam], h * 0.36, avail);
		if (o.type) {
			var ts = fit(o.type, 400, F[fam], h * 0.17, avail);
			out += T(cx, h * 0.36, ts.size, 400, fam, o.type, 'middle');
			out += T(cx, h * 0.38 + CAP[fam] * st.size + h * 0.08, st.size, 700, fam, o.street, 'middle');
		} else {
			out += T(cx, h / 2 + CAP[fam] * st.size / 2, st.size, 700, fam, o.street, 'middle');
		}
		return { w: w, h: h, body: out, border: { inset: h * 0.07, width: Math.max(2, h * 0.018) }, mount: 'holes' };
	}

	// Подъезд.
	function layoutEntrance(o) {
		var w = o.w, h = o.h, pad = h * 0.13, out = '', fam = 'sans';
		var num = fit(o.number, 700, F[fam], h * 0.66, w * 0.38);
		out += T(w - pad, h / 2 + CAP[fam] * num.size / 2, num.size, 700, fam, o.number, 'end');
		var leftW = w - pad - num.width - pad * 0.6 - pad;
		var t = (o.type || 'Подъезд').toUpperCase();
		var ts = fit(t, 700, F[fam], h * 0.17, leftW);
		out += T(pad, h * 0.42, ts.size, 700, fam, t);
		out += R(pad, h * 0.52, leftW, h * 0.014, 0);
		if (o.street) {
			var st = fit(o.street, 400, F[fam], h * 0.17, leftW);
			out += T(pad, h * 0.6 + CAP[fam] * st.size + h * 0.03, st.size, 400, fam, o.street);
		}
		return { w: w, h: h, body: out, mount: 'holes' };
	}

	// Номер дома (старый квадрат).
	function layoutNumber(o) {
		var w = o.w, h = o.h, out = '', fam = 'sans';
		var num = fit(o.number, 700, F[fam], h * 0.62, w * 0.78);
		var base = h / 2 + CAP[fam] * num.size / 2 + (o.type ? h * 0.05 : 0) - (o.street ? h * 0.06 : 0);
		if (o.type) {
			var ts = fit(o.type.toUpperCase(), 500, F[fam], h * 0.09, w * 0.7);
			out += T(w / 2, h * 0.2, ts.size, 500, fam, o.type.toUpperCase(), 'middle');
		}
		out += T(w / 2, base, num.size, 700, fam, o.number, 'middle');
		if (o.street) {
			var st = fit(o.street.toUpperCase(), 400, F[fam], h * 0.085, w * 0.76);
			out += T(w / 2, h * 0.86, st.size, 400, fam, o.street.toUpperCase(), 'middle');
		}
		return { w: w, h: h, body: out, border: { inset: h * 0.1, width: h * 0.016 }, mount: 'holes' };
	}

	// «Домовой знак» с номером: рамка с вогнутыми углами, номер с засечками (250×250).
	function layoutHouse(o) {
		var w = o.w, h = o.h, out = '', fam = 'serif';
		var i = h * 0.07, r = h * 0.07, s = Math.max(2.5, h * 0.014);
		var x0 = i, y0 = i, x1 = w - i, y1 = h - i;
		var frame = 'M' + n(x0 + r) + ' ' + n(y0) + 'H' + n(x1 - r) + 'A' + n(r) + ' ' + n(r) + ' 0 0 0 ' + n(x1) + ' ' + n(y0 + r) +
			'V' + n(y1 - r) + 'A' + n(r) + ' ' + n(r) + ' 0 0 0 ' + n(x1 - r) + ' ' + n(y1) +
			'H' + n(x0 + r) + 'A' + n(r) + ' ' + n(r) + ' 0 0 0 ' + n(x0) + ' ' + n(y1 - r) +
			'V' + n(y0 + r) + 'A' + n(r) + ' ' + n(r) + ' 0 0 0 ' + n(x0 + r) + ' ' + n(y0) + 'Z';
		out += '<path d="' + frame + '" fill="none" stroke="%FG%" stroke-width="' + n(s) + '"/>';
		var hasTop = !!o.type, hasBottom = !!o.street;
		var num = fit(o.number, 700, F[fam], h * (hasTop || hasBottom ? 0.56 : 0.74), w * 0.74);
		var base = h / 2 + CAP[fam] * num.size / 2 + (hasTop ? h * 0.05 : 0) - (hasBottom ? h * 0.06 : 0);
		if (hasTop) {
			var ts = fit(o.type, 400, F[fam], h * 0.09, w * 0.66);
			out += T(w / 2, h * 0.22, ts.size, 400, fam, o.type, 'middle');
		}
		out += T(w / 2, base, num.size, 700, fam, o.number, 'middle');
		if (hasBottom) {
			var st = fit(o.street, 700, F[fam], h * 0.09, w * 0.7);
			out += T(w / 2, h * 0.86, st.size, 700, fam, o.street, 'middle');
		}
		return { w: w, h: h, body: out, mount: 'side-holes' };
	}

	// «Волна» со щитом (630×360): название рукописным шрифтом, номер в щите.
	function layoutWave(o) {
		var w = 630, h = 360, out = '';
		var shape = 'M54 332 C28 332 18 304 36 288 C48 278 64 280 70 292 C72 252 98 214 144 200 ' +
			'C204 182 300 184 360 168 C376 164 388 158 392 148 L392 46 C392 30 404 20 420 20 ' +
			'L452 20 C460 32 470 36 482 36 C494 36 504 32 512 20 L544 20 C560 20 572 30 572 46 ' +
			'L572 170 C572 222 540 256 492 280 C470 292 452 306 440 318 C424 334 404 340 380 340 ' +
			'L96 340 C78 340 64 338 54 332 Z';
		// Номер в щите.
		var num = fit(o.number, 700, F.serif, 132, 150);
		out += T(482, 120 + CAP.serif * num.size / 2, num.size, 700, 'serif', o.number, 'middle');
		// Подпись и название.
		var st = fit(o.street, 400, F.script, 86, 320);
		out += T(250, 314, st.size, 400, 'script', o.street, 'middle');
		if (o.type) {
			var ts = fit(o.type, 400, F.script, 38, 150);
			out += T(250 - st.width / 2 + 6, 314 - CAP.script * st.size - 12, ts.size, 400, 'script', o.type, 'start');
		}
		out += '<path d="M436 64 C452 52 470 50 482 58 C494 50 512 52 528 64" fill="none" stroke="%FG%" stroke-width="4" stroke-linecap="round"/>';
		return { w: w, h: h, shape: shape, body: out, border: { inset: 9, width: 4 }, mount: 'none' };
	}

	// «Арка» (620×380): номер в куполе, название в полосе, «улица» в нижнем выступе.
	function layoutArch(o) {
		var w = 620, h = 380, out = '';
		var shape = 'M40 168 L206 168 C206 70 250 22 310 22 C370 22 414 70 414 168 L580 168 ' +
			'A20 20 0 0 0 600 188 L600 272 A20 20 0 0 0 580 292 L404 292 ' +
			'C400 334 362 356 310 356 C258 356 220 334 216 292 L40 292 A20 20 0 0 0 20 272 L20 188 A20 20 0 0 0 40 168 Z';
		var num = fit(o.number, 700, F.serif, 96, 160);
		out += T(310, 112 + CAP.serif * num.size / 2, num.size, 700, 'serif', o.number, 'middle');
		var st = fit(o.street.toUpperCase(), 700, F.serif, 64, 520);
		out += T(310, 230 + CAP.serif * st.size / 2, st.size, 700, 'serif', o.street.toUpperCase(), 'middle');
		if (o.type) {
			var ts = fit(o.type, 400, F.serif, 32, 150);
			out += T(310, 330, ts.size, 400, 'serif', o.type, 'middle');
		}
		// Орнамент над номером.
		out += '<path d="M274 60 C290 48 302 48 310 58 C318 48 330 48 346 60" fill="none" stroke="%FG%" stroke-width="4" stroke-linecap="round"/>';
		out += '<circle cx="46" cy="230" r="6" fill="%FG%"/><circle cx="574" cy="230" r="6" fill="%FG%"/>';
		return { w: w, h: h, shape: shape, body: out, border: { inset: 9, width: 4 }, mount: 'none' };
	}

	// «Герб» (590×330): «улица» в верхней вкладке, название в полосе, номер в нижнем медальоне.
	function layoutCrest(o) {
		var w = 590, h = 330, out = '';
		var fam = o.font === 'cond' ? 'cond' : 'serif';
		var shape = 'M214 76 L214 42 C214 26 226 14 242 14 L348 14 C364 14 376 26 376 42 L376 76 ' +
			'L540 76 L576 106 C566 120 566 138 576 152 C566 166 566 184 576 198 L540 226 L382 226 ' +
			'C382 286 346 318 295 318 C244 318 208 286 208 226 L50 226 L14 198 C24 184 24 166 14 152 ' +
			'C24 138 24 120 14 106 L50 76 Z';
		if (o.type) {
			var ts = fit(o.type, fam === 'cond' ? 500 : 400, F[fam], 34, 140);
			out += T(295, 46 + CAP[fam] * ts.size / 2, ts.size, fam === 'cond' ? 500 : 400, fam, o.type, 'middle');
		}
		var st = fit(o.street.toUpperCase(), 700, F[fam], fam === 'cond' ? 74 : 66, 470);
		out += T(295, 151 + CAP[fam] * st.size / 2, st.size, 700, fam, o.street.toUpperCase(), 'middle');
		var num = fit(o.number, 700, F[fam], 66, 130);
		out += T(295, 266 + CAP[fam] * num.size / 2, num.size, 700, fam, o.number, 'middle');
		// Декоративные линии-завитки под «улица» и над номером.
		out += '<path d="M240 92 C262 102 280 102 295 92 C310 102 328 102 350 92" fill="none" stroke="%FG%" stroke-width="3.5" stroke-linecap="round"/>';
		out += '<path d="M248 214 C266 206 282 206 295 214 C308 206 324 206 342 214" fill="none" stroke="%FG%" stroke-width="3.5" stroke-linecap="round"/>';
		return { w: w, h: h, shape: shape, body: out, border: { inset: 8, width: 4 }, mount: 'none' };
	}

	// «Ажур» (700×290): фигурная форма с завитками, всё по центру.
	function layoutOrnate(o) {
		var w = 700, h = 290, out = '';
		var shape = 'M120 40 C250 16 450 16 580 40 C606 44 626 18 656 26 C690 36 692 80 664 90 ' +
			'C688 112 688 178 664 200 C692 210 690 254 656 264 C626 272 606 246 580 250 ' +
			'C450 274 250 274 120 250 C94 246 74 272 44 264 C10 254 8 210 36 200 ' +
			'C12 178 12 112 36 90 C8 80 10 36 44 26 C74 18 94 44 120 40 Z';
		var fam = 'cond';
		if (o.type) {
			var ts = fit(o.type.toUpperCase(), 500, F[fam], 30, 200);
			out += T(350, 72 + CAP[fam] * ts.size / 2, ts.size, 500, fam, o.type.toUpperCase(), 'middle', '%FG%', ' letter-spacing="2"');
		}
		var st = fit(o.street.toUpperCase(), 700, F[fam], 78, 500);
		out += T(350, 150 + CAP[fam] * st.size / 2, st.size, 700, fam, o.street.toUpperCase(), 'middle');
		var num = fit(o.number, 700, F[fam], 50, 160);
		out += T(350, 228 + CAP[fam] * num.size / 2, num.size, 700, fam, o.number, 'middle');
		// Завитки по бокам «улица» и номера.
		out += '<path d="M230 72 C250 60 268 64 276 74 M470 72 C450 60 432 64 424 74" fill="none" stroke="%FG%" stroke-width="3.5" stroke-linecap="round"/>';
		out += '<path d="M250 228 C270 218 290 222 300 230 M450 228 C430 218 410 222 400 230" fill="none" stroke="%FG%" stroke-width="3.5" stroke-linecap="round"/>';
		return { w: w, h: h, shape: shape, body: out, border: { inset: 10, width: 4 }, mount: 'none' };
	}

	// Вертикальная (220×700): цифры номера одна под другой.
	function layoutVertical(o) {
		var w = o.w || 220, h = o.h || 700, out = '', fam = 'cond';
		var chars = String(o.number).replace(/\s+/g, '').slice(0, 5).split('');
		var count = Math.max(chars.length, 1);
		var hasStreet = !!o.street;
		var top = h * 0.08, bottom = h * (hasStreet ? 0.78 : 0.92);
		var cell = (bottom - top) / count;
		var size = Math.min(cell * 0.95 / CAP[fam], w * 1.05);
		chars.forEach(function (ch, i) {
			var f = fit(ch, 500, F[fam], size, w * 0.66);
			out += T(w / 2, top + cell * i + cell / 2 + CAP[fam] * f.size / 2, f.size, 500, fam, ch, 'middle');
		});
		if (hasStreet) {
			out += R(w * 0.2, h * 0.815, w * 0.6, Math.max(2, h * 0.004), 0);
			var st = fit(o.street.toUpperCase(), 500, F[fam], w * 0.16, w * 0.76);
			out += T(w / 2, h * 0.88, st.size, 500, fam, o.street.toUpperCase(), 'middle');
			if (o.type) {
				var ts = fit(o.type, 400, F[fam], w * 0.09, w * 0.7);
				out += T(w / 2, h * 0.925, ts.size, 400, fam, o.type, 'middle');
			}
		}
		return { w: w, h: h, body: out, mount: 'standoffs', rx: w * 0.03 };
	}

	var LAYOUTS = {
		line: layoutLine, quadro: layoutQuadro, classic: layoutClassic, number: layoutNumber, entrance: layoutEntrance,
		house: layoutHouse, wave: layoutWave, arch: layoutArch, crest: layoutCrest, ornate: layoutOrnate, vertical: layoutVertical
	};

	// Подписи полей по макетам.
	var DEFAULTS = {
		wave: { type: 'улица', street: 'Солнечная', number: '14' },
		vertical: { type: '', street: '', number: '259' },
		house: { type: '', street: '', number: '14' },
		entrance: { type: 'Подъезд', street: 'кв. 1–36', number: '2' },
		number: { type: '', street: 'Солнечная', number: '14' }
	};

	/* ---------- Сборка SVG ---------- */

	var uid = 0;
	function mount(kind, w, h, finish, light) {
		var out = '', pts = [];
		var m = Math.min(w, h);
		if (kind === 'holes') {
			var r = Math.max(3, m * 0.018), off = Math.max(9, m * 0.055);
			pts = [[off, off], [w - off, off], [off, h - off], [w - off, h - off]];
			pts.forEach(function (p) {
				out += '<circle cx="' + n(p[0]) + '" cy="' + n(p[1]) + '" r="' + n(r) + '" fill="' + (light ? '#2a2a2a' : '#d9d9d9') + '"/>';
			});
		} else if (kind === 'side-holes') {
			var r2 = Math.max(3, m * 0.02);
			[[m * 0.035, h / 2], [w - m * 0.035, h / 2]].forEach(function (p) {
				out += '<circle cx="' + n(p[0]) + '" cy="' + n(p[1]) + '" r="' + n(r2) + '" fill="' + (light ? '#2a2a2a' : '#d9d9d9') + '"/>';
			});
		} else if (kind === 'standoffs') {
			var rs = Math.max(6, m * 0.05), o2 = Math.max(16, m * 0.09);
			pts = [[o2, o2], [w - o2, o2], [o2, h - o2], [w - o2, h - o2]];
			pts.forEach(function (p) {
				out += '<circle cx="' + n(p[0] + rs * 0.12) + '" cy="' + n(p[1] + rs * 0.18) + '" r="' + n(rs) + '" fill="#000" fill-opacity=".35"/>' +
					'<circle cx="' + n(p[0]) + '" cy="' + n(p[1]) + '" r="' + n(rs) + '" fill="url(#std' + uid + ')"/>' +
					'<circle cx="' + n(p[0]) + '" cy="' + n(p[1]) + '" r="' + n(rs * 0.62) + '" fill="none" stroke="#fff" stroke-opacity=".5" stroke-width="' + n(rs * 0.12) + '"/>';
			});
		}
		return out;
	}

	/**
	 * @param {Object} o {layout, w, h, finish, scheme, base, metal, type, street, number, font, title, holes}
	 */
	function svg(o) {
		o = o || {};
		uid++;
		var id = uid;
		var layout = LAYOUTS[o.layout] ? o.layout : 'line';
		var def = DEFAULTS[layout] || { type: 'улица', street: 'Солнечная', number: '14' };
		var finish = o.finish === 'mirror' ? 'mirror' : 'print';
		var data = {
			w: +o.w || 900, h: +o.h || 270, finish: finish, font: o.font,
			type: o.type == null ? def.type : String(o.type).trim(),
			street: (o.street == null || String(o.street).trim() === '') ? def.street : String(o.street).trim(),
			number: String(o.number || '').trim() || def.number
		};
		if (layout === 'house' || layout === 'vertical') {
			data.street = String(o.street || '').trim();
		}

		var bg, fg, light, metal;
		if (finish === 'mirror') {
			var b = BASES[o.base] || BASES.graphite;
			metal = METALS[o.metal] || METALS.silver;
			bg = b.color;
			fg = 'url(#mt' + id + ')';
			light = isLight(bg);
		} else if (o.base && o.text && BASES[o.base] && TEXTS[o.text]) {
			bg = BASES[o.base].color; fg = TEXTS[o.text].color;
			light = isLight(bg);
		} else {
			var c = SCHEMES[o.scheme] || SCHEMES['white-black'];
			bg = c.bg; fg = c.fg;
			light = isLight(bg);
		}

		var L = LAYOUTS[layout](data);
		var w = L.w, h = L.h;
		var shapeD = L.shape || null;
		var rx = L.rx != null ? L.rx : Math.min(w, h) * 0.02;
		var shapeEl = shapeD ? '<path d="' + shapeD + '"' : '<rect width="' + w + '" height="' + h + '" rx="' + n(rx) + '"';

		var defs = '<defs>' +
			'<clipPath id="cp' + id + '">' + shapeEl + '/></clipPath>' +
			'<linearGradient id="sh' + id + '" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#fff" stop-opacity=".16"/><stop offset=".45" stop-color="#fff" stop-opacity="0"/><stop offset="1" stop-color="#000" stop-opacity=".12"/></linearGradient>' +
			'<radialGradient id="std' + id + '" cx=".35" cy=".3" r=".8"><stop offset="0" stop-color="#ffffff"/><stop offset=".45" stop-color="#c7ccd1"/><stop offset="1" stop-color="#6f767d"/></radialGradient>';
		if (metal) {
			var s = metal.stops;
			defs += '<linearGradient id="mt' + id + '" gradientUnits="userSpaceOnUse" x1="0" y1="0" x2="' + n(w * 0.55) + '" y2="' + n(h * 1.1) + '" spreadMethod="reflect">' +
				'<stop offset="0" stop-color="' + s[0] + '"/><stop offset=".22" stop-color="' + s[1] + '"/><stop offset=".42" stop-color="' + s[2] + '"/>' +
				'<stop offset=".58" stop-color="' + s[3] + '"/><stop offset=".8" stop-color="' + s[4] + '"/><stop offset="1" stop-color="' + s[5] + '"/></linearGradient>' +
				'<filter id="ds' + id + '" x="-10%" y="-10%" width="120%" height="130%"><feDropShadow dx="' + n(Math.min(w, h) * 0.006) + '" dy="' + n(Math.min(w, h) * 0.012) + '" stdDeviation="' + n(Math.min(w, h) * 0.008) + '" flood-color="#000" flood-opacity=".5"/></filter>';
		}
		defs += '</defs>';

		var tok = function (str, fill) { return str.replace(/%FG%/g, fill).replace(/%BG%/g, bg); };
		var border = '';
		if (L.border) {
			var bi = L.border.inset, bw = L.border.width;
			var edge = shapeD ? '<path d="' + shapeD + '" fill="none"' : '<rect width="' + w + '" height="' + h + '" rx="' + n(rx) + '" fill="none"';
			border = '<g clip-path="url(#cp' + id + ')">' + edge + ' stroke="%FG%" stroke-width="' + n((bi + bw) * 2) + '"/>' + edge + ' stroke="%BG%" stroke-width="' + n(bi * 2) + '"/></g>';
		}

		var out = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' + w + ' ' + h + '" role="img" aria-label="' +
			esc(o.title || ('Адресная табличка: ' + data.type + ' ' + data.street + ', ' + data.number)) + '" class="ex-plate-svg">' + defs;

		// Основа.
		out += shapeEl + ' fill="' + bg + '"/>';
		if (finish === 'mirror') {
			out += shapeEl + ' fill="url(#sh' + id + ')"/>';
		}
		if (light) {
			out += (shapeD ? '<path d="' + shapeD + '"' : '<rect x=".75" y=".75" width="' + (w - 1.5) + '" height="' + (h - 1.5) + '" rx="' + n(rx) + '"') + ' fill="none" stroke="#000" stroke-opacity=".1" stroke-width="1.5"/>';
		}

		// Буквы и рамка.
		var art = border + L.body;
		if (finish === 'mirror') {
			var depth = Math.max(1.2, Math.min(w, h) * 0.006);
			// «Торец» объёмных букв + зеркальная лицевая сторона.
			out += '<g filter="url(#ds' + id + ')"><g transform="translate(' + n(depth * 0.6) + ' ' + n(depth) + ')">' + tok(art, metal.edge).replace(/%BG%/g, bg) + '</g>' + tok(art, fg) + '</g>';
		} else {
			out += tok(art, fg);
		}

		if (o.holes !== false) {
			out += mount(L.mount, w, h, finish, light);
		}
		out += '</svg>';
		return out;
	}

	/** Пропорции макета (для миниатюр форматов). */
	function ratio(layout, w, h) {
		var fixed = { wave: [630, 360], arch: [620, 380], crest: [590, 330], ornate: [700, 290] };
		return fixed[layout] ? fixed[layout][0] / fixed[layout][1] : (w / h);
	}

	root.ExPlate = { svg: svg, schemes: SCHEMES, bases: BASES, texts: TEXTS, metals: METALS, layouts: Object.keys(LAYOUTS), ratio: ratio };
})(window);
