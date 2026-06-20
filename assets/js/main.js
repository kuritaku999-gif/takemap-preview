/* 竹マップ — main.js v0.2
 * - ハンバーガーメニュー（モバイル）
 * - メガメニュー（モバイル時アコーディオン）
 * - 検索オーバーレイ
 * - カテゴリフィルタ
 * - ヒーロースライダー（オートプレイ・ドット・矢印・スワイプ）
 * - スクロール出現アニメーション (IntersectionObserver)
 */
(function () {
	'use strict';

	const ready = (fn) => {
		if (document.readyState !== 'loading') fn();
		else document.addEventListener('DOMContentLoaded', fn);
	};

	ready(function () {

		/* ---------- Mobile Menu ---------- */
		const menuBtn = document.querySelector('.js-menu-toggle');
		const menuNav = document.querySelector('.site-header__nav');
		if (menuBtn && menuNav) {
			menuBtn.addEventListener('click', function () {
				const open = menuNav.classList.toggle('is-open');
				menuBtn.classList.toggle('is-open', open);
				menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
				document.body.style.overflow = open ? 'hidden' : '';
			});
		}

		/* ---------- Mobile Mega Accordion ---------- */
		document.querySelectorAll('.gnav__item--has-mega > a').forEach(a => {
			a.addEventListener('click', function (e) {
				if (window.matchMedia('(max-width: 767px)').matches) {
					e.preventDefault();
					const item = this.parentElement;
					const wasOpen = item.classList.contains('is-open');
					document.querySelectorAll('.gnav__item--has-mega.is-open').forEach(o => o.classList.remove('is-open'));
					if (!wasOpen) item.classList.add('is-open');
				}
			});
		});

		/* ---------- Search Overlay ---------- */
		const searchToggles = document.querySelectorAll('.js-search-toggle');
		const overlay = document.getElementById('search-overlay');
		if (overlay && searchToggles.length) {
			searchToggles.forEach(btn => {
				btn.addEventListener('click', function () {
					const willOpen = overlay.hasAttribute('hidden');
					if (willOpen) {
						overlay.removeAttribute('hidden');
						const input = overlay.querySelector('input[type="search"]');
						if (input) setTimeout(() => input.focus(), 80);
						document.body.style.overflow = 'hidden';
					} else {
						overlay.setAttribute('hidden', '');
						document.body.style.overflow = '';
					}
					searchToggles.forEach(b => {
						if (b.classList.contains('icon-btn')) b.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
					});
				});
			});
			overlay.addEventListener('click', function (e) {
				if (e.target === overlay) {
					overlay.setAttribute('hidden', '');
					document.body.style.overflow = '';
				}
			});
			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape' && !overlay.hasAttribute('hidden')) {
					overlay.setAttribute('hidden', '');
					document.body.style.overflow = '';
				}
			});
		}

		/* ---------- Category Filter Tabs ---------- */
		const tabContainer = document.querySelector('.js-filter-tabs');
		const target = document.querySelector('.js-filter-target');
		if (tabContainer && target) {
			tabContainer.addEventListener('click', function (e) {
				const btn = e.target.closest('.filter-tabs__btn');
				if (!btn) return;
				const cat = btn.dataset.cat;
				tabContainer.querySelectorAll('.filter-tabs__btn').forEach(b => b.classList.toggle('is-active', b === btn));
				target.querySelectorAll('.card').forEach(card => {
					if (cat === 'all') { card.style.display = ''; return; }
					card.style.display = card.classList.contains('category-' + cat) ? '' : 'none';
				});
			});
		}

		/* ---------- Header shadow on scroll ---------- */
		const header = document.getElementById('site-header');
		if (header) {
			const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
			onScroll();
			window.addEventListener('scroll', onScroll, { passive: true });
		}

		/* ---------- HERO SLIDER ---------- */
		document.querySelectorAll('.js-slider').forEach(initSlider);

		function initSlider(root) {
			const track = root.querySelector('.hero-slider__track');
			const slides = Array.from(root.querySelectorAll('.hero-slider__slide'));
			const prevBtn = root.querySelector('.hero-slider__nav--prev');
			const nextBtn = root.querySelector('.hero-slider__nav--next');
			const dotsContainer = root.querySelector('.hero-slider__dots');
			if (!track || slides.length === 0) return;

			let current = 0;
			let timer = null;
			const autoplayMs = parseInt(root.dataset.autoplay || '0', 10);

			// dots
			slides.forEach((_, i) => {
				const dot = document.createElement('button');
				dot.className = 'hero-slider__dot' + (i === 0 ? ' is-active' : '');
				dot.setAttribute('aria-label', `スライド ${i + 1} へ`);
				dot.setAttribute('role', 'tab');
				dot.addEventListener('click', () => go(i, true));
				dotsContainer && dotsContainer.appendChild(dot);
			});
			const dots = root.querySelectorAll('.hero-slider__dot');

			function go(idx, userInteract) {
				current = (idx + slides.length) % slides.length;
				track.style.transform = `translateX(-${current * 100}%)`;
				slides.forEach((s, i) => s.classList.toggle('is-active', i === current));
				dots.forEach((d, i) => d.classList.toggle('is-active', i === current));
				if (userInteract) restartAuto();
			}

			function next() { go(current + 1); }
			function prev() { go(current - 1); }

			prevBtn && prevBtn.addEventListener('click', () => { prev(); restartAuto(); });
			nextBtn && nextBtn.addEventListener('click', () => { next(); restartAuto(); });

			function startAuto() {
				if (autoplayMs > 0) timer = setInterval(next, autoplayMs);
			}
			function stopAuto() { if (timer) clearInterval(timer); timer = null; }
			function restartAuto() { stopAuto(); startAuto(); }

			// pause on hover
			root.addEventListener('mouseenter', stopAuto);
			root.addEventListener('mouseleave', startAuto);

			// touch / swipe
			let touchStartX = 0, touchDeltaX = 0;
			root.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; stopAuto(); }, { passive: true });
			root.addEventListener('touchmove',  e => { touchDeltaX = e.touches[0].clientX - touchStartX; }, { passive: true });
			root.addEventListener('touchend',   () => {
				if (Math.abs(touchDeltaX) > 50) (touchDeltaX < 0 ? next() : prev());
				touchDeltaX = 0; startAuto();
			});

			// keyboard
			root.setAttribute('tabindex', '0');
			root.addEventListener('keydown', e => {
				if (e.key === 'ArrowLeft') { prev(); restartAuto(); }
				if (e.key === 'ArrowRight') { next(); restartAuto(); }
			});

			startAuto();
		}

		/* ---------- Scroll Reveal (IntersectionObserver) ---------- */
		const reveals = document.querySelectorAll('.reveal, .stagger');
		if ('IntersectionObserver' in window && reveals.length) {
			const io = new IntersectionObserver((entries) => {
				entries.forEach(en => {
					if (en.isIntersecting) {
						en.target.classList.add('is-visible');
						io.unobserve(en.target);
					}
				});
			}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
			reveals.forEach(el => io.observe(el));
		} else {
			reveals.forEach(el => el.classList.add('is-visible'));
		}

		/* ---------- Card hover tilt (subtle parallax) ---------- */
		document.querySelectorAll('.card').forEach(card => {
			card.addEventListener('mousemove', e => {
				const r = card.getBoundingClientRect();
				const x = (e.clientX - r.left) / r.width - .5;
				const y = (e.clientY - r.top) / r.height - .5;
				card.style.transform = `translateY(-6px) rotate(${x * 1.2}deg) rotateY(${x * 4}deg) rotateX(${-y * 4}deg)`;
			});
			card.addEventListener('mouseleave', () => { card.style.transform = ''; });
		});

	});
})();
