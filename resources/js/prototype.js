/*
 * Hotel Jana — Phase 03 visual prototype interactions.
 *
 * Everything here is frontend-only. The commerce state (quantities, currency,
 * payment method) is MOCKED and is not connected to the existing SSLCommerz /
 * PayPal backend. Integration happens in Phase 06 against the existing routes
 * (/pay-via-ajax, /paypal/create) without backend changes.
 */

const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
const html = document.documentElement;

html.classList.add('js');

/* ---------------------------------------------------------------- Language */
function setLang(lang) {
    html.lang = lang;
    html.dataset.lang = lang;
    $$('[data-set-lang]').forEach((btn) => btn.setAttribute('aria-pressed', String(btn.dataset.setLang === lang)));
    $$('[data-ph-en]').forEach((input) => {
        input.placeholder = lang === 'bn' ? input.dataset.phBn : input.dataset.phEn;
    });
    document.dispatchEvent(new CustomEvent('langchange'));
}

function initLanguage() {
    $$('[data-set-lang]').forEach((btn) => btn.addEventListener('click', () => setLang(btn.dataset.setLang)));
    setLang('en'); // English is always the default
}

/* ------------------------------------------------------------------ Header */
function initHeader() {
    const hdr = $('#hdr');
    const hero = $('.hero');
    if (!hdr || !hero) return;

    let pastHero = false;
    new IntersectionObserver(([entry]) => {
        pastHero = !entry.isIntersecting;
        hdr.classList.toggle('hdr--solid', pastHero);
        if (!pastHero) hdr.classList.remove('hdr--hidden');
    }, { rootMargin: '-72px 0px 0px 0px' }).observe(hero);

    let lastY = window.scrollY;
    window.addEventListener('scroll', () => {
        const y = window.scrollY;
        if (pastHero && Math.abs(y - lastY) > 6) {
            hdr.classList.toggle('hdr--hidden', y > lastY && !hdr.contains(document.activeElement));
        }
        lastY = y;
    }, { passive: true });
}

/* -------------------------------------------------------------------- Hero */
function initHero() {
    const hero = $('.hero');
    if (!hero) return;

    const slides = $$('.hero__slide', hero);
    const ticks = $$('.hero__tick', hero);
    const label = $('[data-hero-label]', hero);
    const pauseBtn = $('.hero__pause', hero);
    const DURATION = 6500;
    const FADE = 1600;

    let index = 0;
    let timer = null;
    let playing = !reducedMotion.matches;
    let userPaused = false;

    const restartTick = () => {
        ticks.forEach((t, k) => {
            t.classList.remove('is-running');
            t.classList.toggle('is-active', k === index);
            t.setAttribute('aria-current', String(k === index));
        });
        if (playing) {
            const bar = ticks[index].querySelector('span');
            void bar.offsetWidth; // restart the CSS animation
            ticks[index].classList.add('is-running');
        }
    };

    const schedule = () => {
        clearTimeout(timer);
        if (playing) timer = setTimeout(() => show(index + 1), DURATION);
    };

    function show(next) {
        const prev = slides[index];
        index = (next + slides.length) % slides.length;
        const cur = slides[index];

        if (prev !== cur) {
            prev.classList.remove('is-active');
            prev.setAttribute('aria-hidden', 'true');
            setTimeout(() => {
                if (!prev.classList.contains('is-active')) prev.classList.remove('is-zoom');
            }, FADE + 100);
        }
        cur.classList.remove('is-zoom');
        void cur.offsetWidth;
        cur.classList.add('is-active', 'is-zoom');
        cur.setAttribute('aria-hidden', 'false');

        const tpl = cur.querySelector('.hero__slide-label');
        if (tpl && label) label.innerHTML = tpl.innerHTML;

        restartTick();
        schedule();
    }

    const setPlaying = (value) => {
        playing = value;
        hero.classList.toggle('is-paused', !playing);
        pauseBtn.setAttribute('aria-pressed', String(!playing));
        pauseBtn.setAttribute('aria-label', playing ? 'Pause slideshow' : 'Play slideshow');
        if (playing) show(index + 1);
        else clearTimeout(timer);
    };

    ticks.forEach((tick, k) => tick.addEventListener('click', () => show(k)));
    pauseBtn.addEventListener('click', () => {
        userPaused = playing;
        setPlaying(!playing);
    });

    document.addEventListener('visibilitychange', () => {
        if (userPaused || reducedMotion.matches) return;
        if (document.hidden) { clearTimeout(timer); hero.classList.add('is-paused'); }
        else { hero.classList.remove('is-paused'); schedule(); }
    });

    if (!playing) {
        hero.classList.add('is-paused');
        pauseBtn.setAttribute('aria-pressed', 'true');
        pauseBtn.setAttribute('aria-label', 'Play slideshow');
    }
    restartTick();
    schedule();
}

/* ------------------------------------------------------------------ Reveal */
function initReveal() {
    const items = $$('[data-reveal]');
    if (!('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-in'));
        return;
    }
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-in');
            countUp(entry.target);
            io.unobserve(entry.target);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
    items.forEach((el) => io.observe(el));
}

function countUp(root) {
    $$('[data-count]', root).forEach((el) => {
        const target = Number(el.dataset.count);
        if (reducedMotion.matches || !target) return;
        const start = performance.now();
        const dur = 1200;
        const tick = (now) => {
            const p = Math.min(1, (now - start) / dur);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased).toLocaleString('en-US');
            if (p < 1) requestAnimationFrame(tick);
        };
        el.textContent = '0';
        requestAnimationFrame(tick);
    });
}

/* ------------------------------------------------------------------- Films */
function initFilms() {
    const player = $('[data-player]');
    if (!player) return;

    const posters = $$('.player__poster', player);
    const thumbs = $$('.thumb');
    const caption = $('[data-player-caption]', player);
    const video = $('.player__video', player);
    const playBtn = $('.player__play', player);
    let current = 0;

    const stop = () => {
        video.pause();
        video.hidden = true;
        video.removeAttribute('src');
        player.classList.remove('is-previewing');
    };

    const select = (k, autoplay = false) => {
        if (k === current) return;
        stop();
        posters[current].classList.remove('is-active');
        posters[k].classList.add('is-active');
        thumbs.forEach((t, n) => {
            t.classList.toggle('is-active', n === k);
            t.setAttribute('aria-selected', String(n === k));
            t.tabIndex = n === k ? 0 : -1;
        });
        caption.classList.add('is-swapping');
        setTimeout(() => {
            caption.innerHTML = thumbs[k].querySelector('.thumb__caption').innerHTML;
            caption.classList.remove('is-swapping');
        }, 300);
        current = k;
        if (autoplay) play();
    };

    function play() {
        const src = thumbs[current].dataset.src;
        if (src) {
            video.src = src;
            video.hidden = false;
            video.play().catch(() => {});
            return;
        }
        // No final film yet: show a calm placeholder preview on the poster.
        player.classList.remove('is-previewing');
        void player.offsetWidth;
        player.classList.add('is-previewing');
    }

    playBtn.addEventListener('click', play);
    thumbs.forEach((t, k) => {
        t.addEventListener('click', () => select(k, true));
        t.addEventListener('keydown', (e) => {
            const dir = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
            if (!dir) return;
            e.preventDefault();
            const next = (k + dir + thumbs.length) % thumbs.length;
            thumbs[next].focus();
            select(next);
        });
    });

    // Never play off-screen.
    new IntersectionObserver(([entry]) => { if (!entry.isIntersecting) stop(); }, { threshold: 0.2 }).observe(player);
}

/* ------------------------------------------------------------ Testimonials */
function initVoices() {
    const track = $('[data-voice-track]');
    if (!track) return;

    const cards = $$('.voice', track);
    const prev = $('[data-voice-prev]');
    const next = $('[data-voice-next]');
    const indexEl = $('[data-voice-index]');

    const step = () => cards[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).columnGap || 0);

    const update = () => {
        const i = Math.round(track.scrollLeft / step());
        indexEl.textContent = String(Math.min(cards.length, i + 1)).padStart(2, '0');
        prev.disabled = track.scrollLeft <= 2;
        next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
    };

    const behavior = () => (reducedMotion.matches ? 'auto' : 'smooth');
    prev.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: behavior() }));
    next.addEventListener('click', () => track.scrollBy({ left: step(), behavior: behavior() }));
    track.addEventListener('scroll', () => requestAnimationFrame(update), { passive: true });
    window.addEventListener('resize', update);
    update();

    // YouTube facade: only one player exists at a time, loaded on demand.
    const reset = (card) => {
        const frame = card.querySelector('iframe');
        if (frame) frame.remove();
        card.classList.remove('is-playing');
        card.querySelector('.voice__facade').hidden = false;
    };

    cards.forEach((card) => {
        const facade = card.querySelector('.voice__facade');
        facade.addEventListener('click', () => {
            const id = facade.dataset.yt;
            if (!id) {
                card.classList.add('is-pending');
                setTimeout(() => card.classList.remove('is-pending'), 2600);
                return;
            }
            cards.forEach((c) => c !== card && reset(c));
            const iframe = document.createElement('iframe');
            iframe.src = `https://www.youtube-nocookie.com/embed/${encodeURIComponent(id)}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
            iframe.title = facade.getAttribute('aria-label') || 'Testimonial video';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            facade.hidden = true;
            card.querySelector('.voice__media').appendChild(iframe);
            card.classList.add('is-playing');
        });
    });
}

/* ----------------------------------------------------------------- Gallery */
function initGallery() {
    const grid = $('[data-gallery]');
    if (!grid) return;

    const pool = JSON.parse(grid.dataset.pool);
    const tiles = $$('.tile', grid);
    const pauseBtn = $('[data-gallery-pause]');
    const INTERVAL = 4500;
    const shown = tiles.map((t) => Number(t.dataset.idx));

    let visible = false;
    let hovering = false;
    let userPaused = reducedMotion.matches;
    let lastTile = -1;
    let timer = null;

    const captionHtml = (item) =>
        `<span class="i18n-en">${item.en}</span><span class="i18n-bn" lang="bn">${item.bn}</span>`;

    const swap = () => {
        const candidates = tiles.map((_, k) => k).filter((k) => k !== lastTile && tiles[k].offsetParent !== null);
        const free = pool.map((_, k) => k).filter((k) => !shown.includes(k));
        if (!candidates.length || !free.length) return;

        const t = candidates[Math.floor(Math.random() * candidates.length)];
        const p = free[Math.floor(Math.random() * free.length)];
        const tile = tiles[t];
        const item = pool[p];
        const old = $$('.tile__img', tile);

        const img = new Image();
        img.className = 'tile__img';
        img.alt = '';
        img.src = item.src;
        img.style.objectPosition = item.pos;
        tile.insertBefore(img, tile.querySelector('.tile__cap'));

        const reveal = () => requestAnimationFrame(() => requestAnimationFrame(() => {
            img.classList.add('is-active');
            old.forEach((o) => o.classList.remove('is-active'));
            setTimeout(() => old.forEach((o) => o.remove()), 1500);
        }));
        (img.decode ? img.decode() : Promise.resolve()).then(reveal, reveal);

        const cap = tile.querySelector('.tile__cap');
        cap.classList.add('is-swapping');
        setTimeout(() => { cap.innerHTML = captionHtml(item); cap.classList.remove('is-swapping'); }, 700);

        shown[t] = p;
        lastTile = t;
    };

    const run = () => {
        clearInterval(timer);
        if (visible && !hovering && !userPaused && !document.hidden) timer = setInterval(swap, INTERVAL);
    };

    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; run(); }, { threshold: 0.25 }).observe(grid);
    grid.addEventListener('mouseenter', () => { hovering = true; run(); });
    grid.addEventListener('mouseleave', () => { hovering = false; run(); });
    document.addEventListener('visibilitychange', run);
    pauseBtn.setAttribute('aria-pressed', String(userPaused));
    pauseBtn.addEventListener('click', () => {
        userPaused = !userPaused;
        pauseBtn.setAttribute('aria-pressed', String(userPaused));
        run();
    });
}

/* ------------------------------------------------------ Commerce (MOCKED) */
const PRICE_BDT = 400000;

// EXAMPLE ONLY — illustrative BDT per 1 unit, NOT live data. The final build
// connects to an approved exchange-rate source.
const EXAMPLE_RATES = {
    BDT: 1, USD: 122, GBP: 163, EUR: 141, AED: 33.2, SAR: 32.5, QAR: 33.5,
    MYR: 28.5, SGD: 94, CAD: 89, AUD: 80, INR: 1.43,
};

const PRODUCTS = {
    kuakata: { en: 'Hotel Jana Kuakata Share', bn: 'হোটেল জানা কুয়াকাটা শেয়ার' },
    dove: { en: 'Hotel Jana The Dove Share', bn: 'হোটেল জানা দ্য ডোভ শেয়ার' },
};

const state = {
    qty: { kuakata: 0, dove: 0 },
    currency: 'BDT',
    method: null,
    methodState: { sslcommerz: 'active', paypal: 'active' },
    formValid: false,
};

const MAX_QTY = 99; // UI guard only; the real maximum is to be confirmed with the backend.
const fmt = (n) => new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }).format(n);
const approx = (bdt) => `≈ ${state.currency} ${fmt(bdt / EXAMPLE_RATES[state.currency])}`;
const isBn = () => html.dataset.lang === 'bn';

function setText(el, text) {
    if (!el || el.textContent === text) return;
    el.textContent = text;
    if (reducedMotion.matches) return;
    el.classList.remove('swap');
    void el.offsetWidth;
    el.classList.add('swap');
}

function setQty(key, value) {
    state.qty[key] = Math.max(0, Math.min(MAX_QTY, value));
    render();
}

function totals() {
    const count = state.qty.kuakata + state.qty.dove;
    return { count, bdt: count * PRICE_BDT };
}

function missingStep() {
    const { count } = totals();
    if (!count) return isBn() ? 'চালিয়ে যেতে অন্তত একটি শেয়ার নির্বাচন করুন।' : 'Select at least one share to continue.';
    if (!state.formValid) return isBn() ? 'চালিয়ে যেতে আপনার তথ্য সম্পূর্ণ করুন।' : 'Complete your details to continue.';
    if (!state.method) return isBn() ? 'একটি পেমেন্ট পদ্ধতি নির্বাচন করুন।' : 'Choose a payment method.';
    return '';
}

function render() {
    const { count, bdt } = totals();
    const foreign = state.currency !== 'BDT';

    // Product cards
    $$('[data-product]').forEach((card) => {
        const key = card.dataset.product;
        const q = state.qty[key];
        card.classList.toggle('is-selected', q > 0);
        $('[data-select]', card).hidden = q > 0;
        $('[data-stepper]', card).hidden = q === 0;
        setText($('[data-qty]', card), String(q));
        $('[data-dec]', card).disabled = q <= 0;
        $('[data-inc]', card).disabled = q >= MAX_QTY;
        const sub = $('[data-subtotal]', card);
        sub.innerHTML = `<span class="ccy">BDT</span> ${fmt(q * PRICE_BDT)}`;
        const unit = $('[data-approx-unit]', card);
        unit.hidden = !foreign;
        if (foreign) unit.textContent = `${approx(PRICE_BDT)} ${isBn() ? 'প্রতি শেয়ার · নমুনা হার' : 'per share · example rate'}`;
    });

    // Summary rows
    $$('[data-srow]').forEach((row) => {
        const key = row.dataset.srow;
        const q = state.qty[key];
        row.classList.toggle('is-on', q > 0);
        $$('[data-srow-qty]', row).forEach((el) => setText(el, String(q)));
        setText($('[data-srow-amt]', row), `BDT ${fmt(q * PRICE_BDT)}`);
        $(`[data-dec="${key}"]`, row).disabled = q <= 0;
    });
    $('[data-summary-empty]').hidden = count > 0;

    setText($('[data-total]'), fmt(bdt));
    const approxTotal = $('[data-approx-total]');
    approxTotal.hidden = !foreign || !count;
    if (foreign) approxTotal.textContent = approx(bdt);
    $('[data-rate-note]').hidden = !foreign;

    $$('[data-currency]').forEach((sel) => { sel.value = state.currency; });

    // Payment methods
    $$('.paymethod').forEach((el) => {
        const key = el.dataset.method;
        const s = state.methodState[key];
        el.dataset.state = s;
        const input = $('input', el);
        input.disabled = s !== 'active';
        input.checked = state.method === key;
        el.classList.toggle('is-checked', state.method === key);
    });

    // Pay button
    const help = missingStep();
    const pay = $('[data-pay]');
    pay.disabled = Boolean(help);
    $('[data-pay-help]').textContent = help;

    // Mobile order bar
    const bar = $('[data-orderbar]');
    $('[data-orderbar-count]').textContent = isBn()
        ? `${count}টি শেয়ার নির্বাচিত`
        : `${count} ${count === 1 ? 'share' : 'shares'} selected`;
    $('[data-orderbar-total]').textContent = fmt(bdt);
    bar.dataset.hasItems = String(count > 0);
    updateOrderBar();
}

let checkoutInView = false;
let productsInView = false;
function updateOrderBar() {
    const bar = $('[data-orderbar]');
    const show = bar.dataset.hasItems === 'true' && !checkoutInView && !productsInView;
    bar.classList.toggle('is-visible', show);
    bar.setAttribute('aria-hidden', String(!show));
    $('a', bar).tabIndex = show ? 0 : -1;
}

function initCommerce() {
    if (!$('[data-product]')) return;

    // Steppers (product cards + summary)
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-inc],[data-dec],[data-select]');
        if (!btn) return;
        const key = btn.dataset.inc || btn.dataset.dec || btn.closest('[data-product]')?.dataset.product;
        if (!key || !(key in state.qty)) return;
        if (btn.hasAttribute('data-select')) {
            setQty(key, 1);
            requestAnimationFrame(() => $(`[data-product="${key}"] [data-inc]`)?.focus());
        } else {
            setQty(key, state.qty[key] + (btn.hasAttribute('data-inc') ? 1 : -1));
            if (state.qty[key] === 0) requestAnimationFrame(() => $(`[data-product="${key}"] [data-select]`)?.focus());
        }
    });

    // "Invest in …" links pre-select their property
    $$('[data-preselect]').forEach((link) => link.addEventListener('click', () => {
        const key = link.dataset.preselect;
        if (state.qty[key] === 0) setQty(key, 1);
    }));

    $$('[data-currency]').forEach((sel) => sel.addEventListener('change', () => {
        state.currency = sel.value;
        render();
    }));

    $$('.paymethod input').forEach((input) => input.addEventListener('change', () => {
        state.method = input.value;
        render();
    }));

    // Prototype-only controls to preview ACTIVE / DISABLED / UNAVAILABLE states.
    $$('[data-demo-state]').forEach((sel) => sel.addEventListener('change', () => {
        const key = sel.dataset.demoState;
        state.methodState[key] = sel.value;
        if (state.method === key && sel.value !== 'active') state.method = null;
        render();
    }));

    initForm();

    $('[data-pay]').addEventListener('click', () => {
        const modal = $('[data-pay-modal]');
        const { count, bdt } = totals();
        const rows = [
            ...Object.keys(state.qty).filter((k) => state.qty[k]).map((k) => [PRODUCTS[k][isBn() ? 'bn' : 'en'], `× ${state.qty[k]}`]),
            [isBn() ? 'মোট শেয়ার' : 'Total shares', String(count)],
            [isBn() ? 'মোট' : 'Total', `BDT ${fmt(bdt)}`],
            [isBn() ? 'পেমেন্ট পদ্ধতি' : 'Payment method', state.method === 'paypal' ? 'PayPal' : 'SSLCommerz'],
        ];
        const recap = $('[data-modal-recap]');
        recap.replaceChildren(...rows.map(([dt, dd]) => {
            const div = document.createElement('div');
            const t = document.createElement('dt');
            const d = document.createElement('dd');
            t.textContent = dt;
            d.textContent = dd;
            div.append(t, d);
            return div;
        }));
        modal.showModal();
    });

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.target.id === 'checkout') checkoutInView = entry.isIntersecting;
            if (entry.target.id === 'invest') productsInView = entry.isIntersecting;
        });
        updateOrderBar();
    }, { threshold: 0.15 });
    io.observe($('#checkout'));
    io.observe($('#invest'));

    document.addEventListener('langchange', render);
    render();
}

function initForm() {
    const form = $('[data-checkout-form]');
    const rules = {
        name: (v) => v.trim().length >= 2,
        phone: (v) => /^[0-9\s-]{6,15}$/.test(v.trim()),
        email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()),
        address_1: (v) => v.trim().length >= 4,
    };

    const check = (input, show) => {
        const ok = rules[input.name](input.value);
        const field = input.closest('.field');
        if (show) {
            field.classList.toggle('is-invalid', !ok);
            input.setAttribute('aria-invalid', String(!ok));
        } else if (ok && field.classList.contains('is-invalid')) {
            field.classList.remove('is-invalid');
            input.setAttribute('aria-invalid', 'false');
        }
        return ok;
    };

    const inputs = Object.keys(rules).map((name) => form.elements[name]);
    const recompute = () => {
        state.formValid = inputs.every((i) => rules[i.name](i.value));
        render();
    };

    inputs.forEach((input) => {
        input.addEventListener('blur', () => { if (input.value) check(input, true); });
        input.addEventListener('input', () => { check(input, false); recompute(); });
    });
    form.addEventListener('submit', (e) => e.preventDefault());
}

/* ------------------------------------------------------- Prototype notes */
function initNotes() {
    const btn = $('[data-notes-toggle]');
    if (!btn) return;
    btn.addEventListener('click', () => {
        const on = !html.classList.contains('show-notes');
        html.classList.toggle('show-notes', on);
        btn.setAttribute('aria-pressed', String(on));
        btn.querySelector('b').textContent = on ? 'On' : 'Off';
    });
}

initLanguage();
initHeader();
initHero();
initReveal();
initFilms();
initVoices();
initGallery();
initCommerce();
initNotes();
