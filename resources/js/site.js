import { createPicker, countryItems, currencyItems } from './pickers';

/*
 * Hotel Jana — site interactions.
 *
 * Frontend only. The ownership form talks to the existing backend exactly the way
 * the booking form does:
 *   - SSLCommerz: the embed script posts `postdata` from #sslczPayBtn to /pay-via-ajax
 *   - PayPal:     POST {name, phone, address, email, shares} to paypal.create → approve_url
 *   - Currency:   GET /currency[?currency=XXX] → {currency, rate per 1 BDT} (display only)
 * The server prices every order itself; nothing here decides what anyone is charged.
 */

const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
const html = document.documentElement;
const CONFIG = window.HOTEL_JANA || { hotels: {}, sslLimit: Infinity, paypal: { rate: 0, currency: 'USD' }, routes: {} };
const isBn = () => html.dataset.lang === 'bn';
const t = (en, bn) => (isBn() ? bn : en);

html.classList.add('js');

/* ---------------------------------------------------------------- Language */
function setLang(lang) {
    html.lang = lang;
    html.dataset.lang = lang;
    $$('[data-set-lang]').forEach((btn) => btn.setAttribute('aria-pressed', String(btn.dataset.setLang === lang)));
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
    const indexEl = $('[data-hero-index]', hero);
    const pauseBtn = $('.hero__pause', hero);
    const DURATION = 10000; // matches the tick animation in site.css
    const FADE = 3400;      // matches --t-cine

    let index = 0;
    let timer = null;
    let playing = !reducedMotion.matches;
    let userPaused = false;

    const restartTick = () => {
        ticks.forEach((tk, k) => {
            tk.classList.remove('is-running');
            tk.classList.toggle('is-active', k === index);
            tk.setAttribute('aria-current', String(k === index));
        });
        if (playing) {
            void ticks[index].offsetWidth;
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
            setTimeout(() => { if (!prev.classList.contains('is-active')) prev.classList.remove('is-zoom'); }, FADE + 100);
        }
        cur.classList.remove('is-zoom');
        void cur.offsetWidth;
        cur.classList.add('is-active', 'is-zoom');
        cur.setAttribute('aria-hidden', 'false');

        const tpl = cur.querySelector('.hero__slide-label');
        if (tpl && label) label.innerHTML = tpl.innerHTML;
        if (indexEl) indexEl.textContent = String(index + 1).padStart(2, '0');

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
    pauseBtn.addEventListener('click', () => { userPaused = playing; setPlaying(!playing); });

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

    // Lift the intro veil once the first image is ready (or after a short cap).
    const first = $('img', slides[0]);
    const ready = () => requestAnimationFrame(() => html.classList.add('is-ready'));
    if (first.complete) ready();
    else { first.addEventListener('load', ready, { once: true }); setTimeout(ready, 1500); }
}

/* ------------------------------------------------------------------ Reveal */
function initReveal() {
    const items = $$('[data-reveal]');
    if (!('IntersectionObserver' in window)) { items.forEach((el) => el.classList.add('is-in')); return; }
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
        const tick = (now) => {
            const p = Math.min(1, (now - start) / 1400);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))).toLocaleString('en-US');
            if (p < 1) requestAnimationFrame(tick);
        };
        el.textContent = '0';
        requestAnimationFrame(tick);
    });
}

/* ---------------------------------------------------------------- Parallax */
function initParallax() {
    const items = $$('[data-parallax]');
    if (!items.length || reducedMotion.matches) return;
    let ticking = false;
    const update = () => {
        const vh = window.innerHeight;
        items.forEach((img) => {
            const r = img.parentElement.getBoundingClientRect();
            if (r.bottom < 0 || r.top > vh) return;
            const progress = (r.top + r.height / 2 - vh / 2) / vh; // -1..1 around centre
            img.style.setProperty('--py', `${(progress * -36).toFixed(1)}px`);
        });
        ticking = false;
    };
    window.addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(update); } }, { passive: true });
    update();
}

/* ------------------------------------------------------------------- Films
 * YouTube player (privacy-enhanced). Autoplays muted when the section is on screen,
 * advances to the next film when one ends, and a thumbnail click plays that film.
 */
function initFilms() {
    const player = $('[data-player]');
    if (!player) return;

    const thumbs = $$('.thumb');
    const caption = $('[data-player-caption]', player);
    const poster = $('.player__poster', player);
    const holder = $('[data-player-yt]', player);
    const unmuteBtn = $('[data-player-unmute]', player);
    let current = 0;
    let yt = null;
    let ready = false;
    let inView = false;
    let muted = true;
    let poll = null;

    poster.addEventListener('error', () => { if (poster.dataset.fallback && poster.src !== poster.dataset.fallback) poster.src = poster.dataset.fallback; });

    const film = (k) => ({ id: thumbs[k].dataset.id, start: Number(thumbs[k].dataset.start || 0) });

    const markActive = (k) => {
        thumbs.forEach((tb, n) => {
            tb.classList.toggle('is-active', n === k);
            tb.setAttribute('aria-selected', String(n === k));
            tb.tabIndex = n === k ? 0 : -1;
            if (n !== k) tb.querySelector('.thumb__bar span').style.removeProperty('--p');
        });
        caption.classList.add('is-swapping');
        setTimeout(() => {
            caption.innerHTML = thumbs[k].querySelector('.thumb__caption').innerHTML;
            caption.classList.remove('is-swapping');
        }, 980);
        thumbs[k].scrollIntoView({ block: 'nearest', inline: 'nearest', behavior: 'smooth' });
    };

    const trackProgress = () => {
        clearInterval(poll);
        poll = setInterval(() => {
            if (!yt || !ready || !yt.getDuration) return;
            const d = yt.getDuration();
            if (d) thumbs[current].querySelector('.thumb__bar span').style.setProperty('--p', String(Math.min(1, yt.getCurrentTime() / d)));
        }, 300);
    };

    const syncUnmute = () => { unmuteBtn.hidden = !(ready && muted); };

    async function create(autoplayMuted) {
        const YT = await loadYouTubeApi();
        if (yt) return;
        const target = document.createElement('div');
        holder.replaceChildren(target);
        const f = film(current);
        yt = new YT.Player(target, {
            videoId: f.id,
            host: 'https://www.youtube-nocookie.com',
            playerVars: { autoplay: 1, mute: autoplayMuted ? 1 : 0, start: f.start, playsinline: 1, rel: 0, modestbranding: 1, controls: 1 },
            events: {
                onReady: (e) => {
                    ready = true;
                    if (autoplayMuted) { e.target.mute(); muted = true; } else { e.target.unMute(); muted = false; }
                    if (inView || !autoplayMuted) e.target.playVideo(); else e.target.pauseVideo();
                    player.classList.add('is-live');
                    syncUnmute();
                    trackProgress();
                },
                onStateChange: (e) => {
                    player.classList.toggle('is-playing', e.data === YT.PlayerState.PLAYING);
                    if (e.data === YT.PlayerState.ENDED) select((current + 1) % thumbs.length, false);
                },
            },
        });
    }

    function select(k, userGesture) {
        current = k;
        markActive(k);
        const f = film(k);
        poster.src = `https://i.ytimg.com/vi/${f.id}/maxresdefault.jpg`;
        poster.dataset.fallback = `https://i.ytimg.com/vi/${f.id}/hqdefault.jpg`;
        if (!yt) { create(!userGesture); return; }
        if (!ready) return;
        if (userGesture) { yt.unMute(); muted = false; syncUnmute(); }
        yt.loadVideoById({ videoId: f.id, startSeconds: f.start });
    }

    $('.player__play', player).addEventListener('click', () => {
        if (yt && ready) { yt.unMute(); muted = false; syncUnmute(); yt.playVideo(); }
        else { create(false); }
    });
    unmuteBtn.addEventListener('click', () => { if (yt && ready) { yt.unMute(); yt.setVolume(100); muted = false; syncUnmute(); } });

    thumbs.forEach((tb, k) => {
        tb.addEventListener('click', () => select(k, true));
        tb.addEventListener('keydown', (e) => {
            const dir = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
            if (!dir) return;
            e.preventDefault();
            const next = (k + dir + thumbs.length) % thumbs.length;
            thumbs[next].focus();
            select(next, true);
        });
    });

    new IntersectionObserver(([entry]) => {
        inView = entry.isIntersecting;
        if (inView) {
            if (!yt && !reducedMotion.matches) create(true);
            else if (yt && ready) yt.playVideo();
        } else if (yt && ready) {
            yt.pauseVideo();
        }
    }, { threshold: 0.45 }).observe(player);
}

/* ------------------------------------------------------------ Testimonials
 * Visible cards autoplay (muted — browsers only allow muted autoplay). When every
 * visible video has finished, the carousel slides to the next set and plays those.
 * Cards without a YouTube link run a short placeholder timer so the rhythm holds.
 */
let ytApiPromise = null;
function loadYouTubeApi() {
    if (window.YT && window.YT.Player) return Promise.resolve(window.YT);
    if (ytApiPromise) return ytApiPromise;
    ytApiPromise = new Promise((resolve) => {
        const prev = window.onYouTubeIframeAPIReady;
        window.onYouTubeIframeAPIReady = () => { if (prev) prev(); resolve(window.YT); };
        const s = document.createElement('script');
        s.src = 'https://www.youtube.com/iframe_api';
        document.head.appendChild(s);
    });
    return ytApiPromise;
}

/* A slow, eased horizontal glide (native smooth scroll is too quick). Snap is paused meanwhile. */
const SLIDE_MS = 2200;
function glideTo(el, left, ms) {
    cancelAnimationFrame(el._glide);
    if (reducedMotion.matches || !ms) { el.scrollLeft = left; return; }
    const from = el.scrollLeft;
    const dist = left - from;
    if (Math.abs(dist) < 1) return;
    const ease = (t) => (t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2);
    const t0 = performance.now();
    el.style.scrollSnapType = 'none';
    el.dataset.gliding = '1';
    const frame = (now) => {
        const t = Math.min(1, (now - t0) / ms);
        el.scrollLeft = from + dist * ease(t);
        if (t < 1) { el._glide = requestAnimationFrame(frame); return; }
        el.style.scrollSnapType = '';
        delete el.dataset.gliding;
    };
    el._glide = requestAnimationFrame(frame);
}

function initVoices() {
    const track = $('[data-voice-track]');
    if (!track) return;

    const cards = $$('.voice', track);
    const prevBtn = $('[data-voice-prev]');
    const nextBtn = $('[data-voice-next]');
    const indexEl = $('[data-voice-index]');
    const SIM_MS = 9000;

    const players = new Map();   // card -> YT.Player
    const pollers = new Map();   // card -> interval id
    const simTimers = new Map(); // card -> timeout id
    let start = 0;               // index of the first visible card
    let inView = false;
    let autoplay = !reducedMotion.matches;
    let pageToken = 0;

    const gap = () => parseFloat(getComputedStyle(track).columnGap || 0);
    const step = () => cards[0].getBoundingClientRect().width + gap();
    const perView = () => Math.max(1, Math.round((track.clientWidth + gap()) / step()));
    const maxStart = () => Math.max(0, cards.length - perView());
    const visibleCards = () => cards.slice(start, start + perView());

    const updateUi = () => {
        indexEl.textContent = String(start + 1).padStart(2, '0');
        prevBtn.disabled = start <= 0;
        nextBtn.disabled = start >= maxStart();
    };

    function teardown(card) {
        clearInterval(pollers.get(card)); pollers.delete(card);
        clearTimeout(simTimers.get(card)); simTimers.delete(card);
        const p = players.get(card);
        if (p) { try { p.destroy(); } catch (e) { /* ignore */ } players.delete(card); }
        card.classList.remove('is-playing', 'has-player', 'is-simulating', 'is-done');
        card.querySelector('.voice__progress span').style.removeProperty('--p');
        const sound = card.querySelector('[data-voice-sound]');
        if (sound) { sound.setAttribute('aria-pressed', 'false'); sound.setAttribute('aria-label', 'Turn sound on'); }
    }

    function stopAll() {
        pageToken++;
        cards.forEach(teardown);
    }

    function onCardDone(card, token) {
        if (token !== pageToken) return;
        card.classList.remove('is-playing', 'is-simulating');
        card.classList.add('is-done');
        clearInterval(pollers.get(card));
        const current = visibleCards();
        if (current.every((c) => c.classList.contains('is-done'))) {
            // Everyone on this page has played: slide to the next set (wrapping around).
            setTimeout(() => { if (token === pageToken && inView) goTo(start >= maxStart() ? 0 : start + perView(), true); }, 1400);
        }
    }

    async function playCard(card, token) {
        const id = card.dataset.yt;
        card.classList.add('is-playing');
        if (!id) {
            card.style.setProperty('--sim', `${SIM_MS}ms`);
            card.classList.add('is-simulating');
            simTimers.set(card, setTimeout(() => onCardDone(card, token), SIM_MS));
            return;
        }
        const YT = await loadYouTubeApi();
        if (token !== pageToken) return;
        let holder = card.querySelector('[data-voice-player]');
        if (!holder) {
            holder = document.createElement('div');
            holder.className = 'voice__player';
            holder.setAttribute('data-voice-player', '');
            card.querySelector('.voice__media').prepend(holder);
        }
        const target = document.createElement('div');
        holder.replaceChildren(target);
        const player = new YT.Player(target, {
            videoId: id,
            host: 'https://www.youtube-nocookie.com',
            playerVars: { autoplay: 1, mute: 1, start: Number(card.dataset.start || 0), playsinline: 1, rel: 0, modestbranding: 1, controls: 1 },
            events: {
                onReady: (e) => {
                    if (token !== pageToken) return;
                    e.target.mute();
                    e.target.playVideo();
                    card.classList.add('has-player');
                    pollers.set(card, setInterval(() => {
                        const d = player.getDuration?.() || 0;
                        if (d) card.querySelector('.voice__progress span').style.setProperty('--p', String(Math.min(1, player.getCurrentTime() / d)));
                    }, 250));
                },
                onStateChange: (e) => { if (e.data === YT.PlayerState.ENDED) onCardDone(card, token); },
                onError: () => onCardDone(card, token),
            },
        });
        players.set(card, player);
    }

    function playPage() {
        if (!autoplay || !inView) return;
        const token = ++pageToken;
        visibleCards().forEach((card) => playCard(card, token));
    }

    function goTo(index, thenPlay) {
        stopAll();
        start = Math.max(0, Math.min(maxStart(), index));
        glideTo(track, start * step(), SLIDE_MS);
        updateUi();
        if (thenPlay) setTimeout(playPage, reducedMotion.matches ? 0 : SLIDE_MS + 200);
    }

    prevBtn.addEventListener('click', () => goTo(start - perView(), true));
    nextBtn.addEventListener('click', () => goTo(start >= maxStart() ? 0 : start + perView(), true));

    // Manual swipes (mobile) re-sync the visible set.
    let scrollTimer = null;
    track.addEventListener('scroll', () => {
        clearTimeout(scrollTimer);
        if (track.dataset.gliding) return; // our own slide, not a swipe
        scrollTimer = setTimeout(() => {
            const i = Math.round(track.scrollLeft / step());
            if (i !== start) { stopAll(); start = Math.min(i, maxStart()); updateUi(); playPage(); }
        }, 160);
    }, { passive: true });

    // Tap a card: play it with sound (user gesture), or toggle sound if it's playing.
    cards.forEach((card) => {
        const sound = card.querySelector('[data-voice-sound]');
        if (sound) {
            sound.addEventListener('click', (e) => {
                e.stopPropagation();
                const p = players.get(card);
                if (!p) return;
                const on = sound.getAttribute('aria-pressed') !== 'true';
                if (on) {
                    players.forEach((other, c) => { if (c !== card) { other.mute(); const s = c.querySelector('[data-voice-sound]'); s?.setAttribute('aria-pressed', 'false'); } });
                    p.unMute(); p.setVolume(100);
                } else p.mute();
                sound.setAttribute('aria-pressed', String(on));
                sound.setAttribute('aria-label', on ? 'Turn sound off' : 'Turn sound on');
            });
        }
        card.querySelector('.voice__media').addEventListener('click', () => {
            if (!card.classList.contains('is-playing') && !card.classList.contains('has-player')) {
                autoplay = true;
                const i = cards.indexOf(card);
                if (i < start || i >= start + perView()) goTo(i, true);
                else { const token = pageToken; playCard(card, token); }
            }
        });
    });

    new IntersectionObserver(([entry]) => {
        inView = entry.isIntersecting;
        if (inView) playPage(); else stopAll();
    }, { threshold: 0.35 }).observe(track);

    window.addEventListener('resize', () => { start = Math.min(start, maxStart()); updateUi(); });
    updateUi();
}

/* ----------------------------------------------------------------- Gallery */
function initGallery() {
    const grid = $('[data-gallery]');
    if (!grid) return;

    const pool = JSON.parse(grid.dataset.pool);
    const tiles = $$('.tile', grid);
    const pauseBtn = $('[data-gallery-pause]');
    // Every tile keeps its own clock (a staggered start, then every 4.3–6.1s with jitter), and no
    // two tiles ever change within MIN_GAP of each other — so roughly one change a second, never in unison.
    const TILE_MIN = 4300;
    const TILE_JITTER = 1800;
    const MIN_GAP = 700;
    const WIPES = ['inset(100% 0 0 0)', 'inset(0 0 100% 0)', 'inset(0 100% 0 0)', 'inset(0 0 0 100%)'];
    const shown = tiles.map((tl) => Number(tl.dataset.idx));

    let visible = false;
    let userPaused = reducedMotion.matches;
    let timer = null;

    const captionHtml = (item) => `<span class="i18n-en">${item.en}</span><span class="i18n-bn" lang="bn">${item.bn}</span>`;

    const swap = (ti) => {
        const free = pool.map((_, k) => k).filter((k) => !shown.includes(k));
        if (!free.length) return;
        const pi = free[Math.floor(Math.random() * free.length)];
        const tile = tiles[ti];
        const item = pool[pi];
        const old = $$('.tile__img', tile);

        const img = new Image();
        img.className = 'tile__img is-entering';
        img.alt = '';
        img.src = item.src;
        img.style.objectPosition = item.pos;
        img.style.setProperty('--from', WIPES[Math.floor(Math.random() * WIPES.length)]);
        tile.insertBefore(img, tile.querySelector('.tile__cap'));

        const reveal = () => requestAnimationFrame(() => requestAnimationFrame(() => {
            img.classList.add('is-active');
            old.forEach((o) => { o.classList.remove('is-active'); o.classList.add('is-leaving'); });
            setTimeout(() => {
                old.forEach((o) => o.remove());
                img.classList.remove('is-entering');
            }, 3000); // after the wipe (2250ms) and most of the settle (2860ms)
        }));
        (img.decode ? img.decode() : Promise.resolve()).then(reveal, reveal);

        const cap = tile.querySelector('.tile__cap');
        cap.classList.add('is-swapping');
        setTimeout(() => { cap.innerHTML = captionHtml(item); cap.classList.remove('is-swapping'); }, 1500);

        shown[ti] = pi;
    };

    const due = tiles.map(() => 0);
    let lastSwap = 0;
    const tick = () => {
        const now = performance.now();
        if (now - lastSwap >= MIN_GAP) {
            // The most overdue visible tile goes next.
            let pick = -1;
            tiles.forEach((tl, k) => { if (tl.offsetParent !== null && due[k] <= now && (pick < 0 || due[k] < due[pick])) pick = k; });
            if (pick > -1) {
                swap(pick);
                lastSwap = now;
                due[pick] = now + TILE_MIN + Math.random() * TILE_JITTER;
            }
        }
        timer = setTimeout(tick, 120);
    };
    const run = () => {
        clearTimeout(timer);
        timer = null;
        if (!visible || userPaused || document.hidden) return;
        // (Re)start with staggered offsets so the first changes arrive one after another.
        const now = performance.now();
        const order = tiles.map((_, k) => k).sort(() => Math.random() - 0.5);
        order.forEach((k, i) => { due[k] = now + 500 + i * 900 + Math.random() * 300; });
        tick();
    };

    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; run(); }, { threshold: 0.25 }).observe(grid);
    document.addEventListener('visibilitychange', run);
    pauseBtn.setAttribute('aria-pressed', String(userPaused));
    pauseBtn.addEventListener('click', () => {
        userPaused = !userPaused;
        pauseBtn.setAttribute('aria-pressed', String(userPaused));
        run();
    });
}

/* ------------------------------------------------------------ Privilege card */
function initPrivilegeCard() {
    const stack = $('[data-gcards]');
    if (stack) stack.addEventListener('click', () => stack.classList.toggle('is-swapped'));
}

/* ------------------------------------------------------ Ownership & checkout */
const HOTELS = CONFIG.hotels || {};
const KEYS = Object.keys(HOTELS);

const state = {
    qty: Object.fromEntries(KEYS.map((k) => [k, 0])),
    local: null,        // { currency, rate } per 1 BDT, from /currency
    formValid: false,
    fieldsDone: 0,      // required details that pass validation
    fieldsTotal: 0,
    busy: false,
};

const fmtBdt = (n) => new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 }).format(n);
const fmtNum = (value) => {
    const digits = value >= 100 || value === 0 ? 0 : 2;
    return new Intl.NumberFormat('en-US', { minimumFractionDigits: digits, maximumFractionDigits: digits }).format(value);
};

/*
 * Every price on the page is a .money[data-bdt]. With a local currency the converted
 * amount is the main figure and BDT follows in small type; in Bangladesh (or with BDT
 * chosen) BDT stands alone. Display only; the server prices every order in BDT.
 */
function paintMoney(el, bdt) {
    if (bdt !== undefined) el.dataset.bdt = String(bdt);
    const amount = Number(el.dataset.bdt) || 0;
    const local = state.local;
    const ccy = local ? local.currency : 'BDT';
    const num = local ? fmtNum(amount * local.rate) : fmtBdt(amount);
    const key = `${ccy} ${num}`;
    if (el.dataset.painted === key) return;
    const first = el.dataset.painted === undefined;
    el.dataset.painted = key;
    el.classList.toggle('is-local', Boolean(local));
    $('.ccy', el).textContent = ccy;
    $('.money__num', el).textContent = num;
    const alt = $('.money__alt', el);
    alt.hidden = !local;
    alt.textContent = `BDT ${fmtBdt(amount)}`;
    if (first || reducedMotion.matches) return;
    el.classList.remove('swap');
    void el.offsetWidth;
    el.classList.add('swap');
}

function setText(el, text) {
    if (!el || el.textContent === text) return;
    el.textContent = text;
    if (reducedMotion.matches) return;
    el.classList.remove('swap');
    void el.offsetWidth;
    el.classList.add('swap');
}

const totals = () => {
    let count = 0; let bdt = 0;
    KEYS.forEach((k) => { count += state.qty[k]; bdt += state.qty[k] * HOTELS[k].price; });
    return { count, bdt };
};
const sslBlocked = () => totals().bdt >= CONFIG.sslLimit;
const paypalCharge = (bdt) => (CONFIG.paypal.rate > 0 ? Math.round((bdt / CONFIG.paypal.rate) * 100) / 100 : 0);
const fmtCharge = (n) => new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(n);
const methodState = (m) => {
    if (m === 'paypal') return CONFIG.paypal.rate > 0 ? 'active' : 'unavailable';
    if (m === 'sslcommerz') return sslBlocked() ? 'disabled' : 'active';
    return 'unavailable';
};

function setQty(key, value) {
    if (!(key in state.qty)) return;
    const n = Number.isFinite(value) ? Math.floor(value) : 0;
    state.qty[key] = Math.max(0, Math.min(HOTELS[key].max, n));
    render();
}

function missingStep() {
    if (!totals().count) return t('Select at least one share to continue.', 'চালিয়ে যেতে অন্তত একটি শেয়ার নির্বাচন করুন।');
    if (!state.formValid) return t('Complete your details to enable payment.', 'পেমেন্ট চালু করতে আপনার তথ্য সম্পূর্ণ করুন।');
    return '';
}

let helpIsError = false;
function setHelp(message, isError = false) {
    const help = $('[data-pay-help]');
    if (!help) return;
    help.textContent = message;
    help.classList.toggle('is-error', isError);
    helpIsError = isError;
}

function render() {
    if (!KEYS.length) return;
    const { count, bdt } = totals();
    const local = state.local;

    $$('[data-product]').forEach((card) => {
        const key = card.dataset.product;
        const q = state.qty[key];
        card.classList.toggle('is-selected', q > 0);
        $('[data-select]', card).hidden = q > 0;
        $('[data-stepper]', card).hidden = q === 0;
        const input = $('[data-qty]', card);
        if (document.activeElement !== input) input.value = String(q);
        $('[data-dec]', card).disabled = q <= 0;
        $('[data-inc]', card).disabled = q >= HOTELS[key].max;
        paintMoney($('[data-subtotal]', card), q * HOTELS[key].price);
    });

    $$('[data-srow]').forEach((row) => {
        const key = row.dataset.srow;
        const q = state.qty[key];
        row.classList.toggle('is-on', q > 0);
        setText($('[data-srow-qty]', row), fmtBdt(q));
        paintMoney($('[data-srow-amt]', row), q * HOTELS[key].price);
    });
    const empty = $('[data-summary-empty]');
    if (empty) empty.hidden = count > 0;

    paintMoney($('[data-total]'), bdt);
    paintMoney($('[data-orderbar-total]'), bdt);
    // Static prices (hero, hotel spreads, product cards, limits) follow the currency too.
    $$('.money:not([data-total]):not([data-orderbar-total]):not([data-subtotal]):not([data-srow-amt])').forEach((el) => paintMoney(el));
    const rateNote = $('[data-rate-note]');
    if (rateNote) rateNote.hidden = !local;
    currencyPickers.forEach((pk) => pk.set(local ? local.currency : 'BDT'));

    // Two direct payment buttons — each enabled when it applies.
    const blocked = missingStep();
    $$('.paybtn-wrap').forEach((wrap) => {
        const m = wrap.dataset.method;
        const s = methodState(m);
        wrap.dataset.state = s;
        const btn = $('[data-pay]', wrap);
        btn.disabled = s !== 'active' || Boolean(blocked) || state.busy;
        btn.classList.toggle('is-loading', state.busy === m);
    });
    const charge = $('[data-paypal-charge]');
    if (charge) {
        charge.hidden = !count || !(CONFIG.paypal.rate > 0);
        charge.textContent = t(`Charged as ${CONFIG.paypal.currency} ${fmtCharge(paypalCharge(bdt))} via PayPal`, `PayPal-এ চার্জ হবে ${CONFIG.paypal.currency} ${fmtCharge(paypalCharge(bdt))}`);
    }
    if (!helpIsError || !blocked) setHelp('');
    renderLock(count);

    const done = [count > 0, state.formValid, false];
    const currentIdx = done.findIndex((d) => !d);
    $$('.steps__item').forEach((li, i) => {
        li.classList.toggle('is-done', done[i]);
        li.classList.toggle('is-current', i === currentIdx);
    });

    $('[data-orderbar-count]').textContent = t(`${fmtBdt(count)} ${count === 1 ? 'share' : 'shares'} selected`, `${fmtBdt(count)}টি শেয়ার নির্বাচিত`);
    updateOrderBar();
}

/* The payment note says what's still needed; the form footer points to it. */
function renderLock(count) {
    const lock = $('[data-paylock]');
    if (!lock) return;
    const stage = !count ? 'shares' : !state.formValid ? 'form' : 'ready';
    lock.dataset.state = stage;
    lock.disabled = stage === 'ready';
    const left = state.fieldsTotal - state.fieldsDone;
    const copy = {
        shares: [t('Select shares to continue', 'এগিয়ে যেতে শেয়ার নির্বাচন করুন'), t('Choose at least one share, then complete your details.', 'অন্তত একটি শেয়ার বেছে নিয়ে আপনার তথ্য পূরণ করুন।')],
        form: [t('Complete your details to continue', 'এগিয়ে যেতে আপনার তথ্য পূরণ করুন'),
            t(`${state.fieldsDone} of ${state.fieldsTotal} details complete · ${left} to go`, `${state.fieldsTotal}টির মধ্যে ${state.fieldsDone}টি তথ্য সম্পূর্ণ · বাকি ${left}টি`)],
        ready: [t('Ready to pay', 'পেমেন্টের জন্য প্রস্তুত'), t('Choose a payment method.', 'একটি পেমেন্ট পদ্ধতি বেছে নিন।')],
    }[stage];
    setText($('[data-paylock-title]', lock), copy[0]);
    $('[data-paylock-sub]', lock).textContent = copy[1];
    const meter = $('[data-paylock-meter]', lock);
    if (meter.childElementCount !== state.fieldsTotal) meter.innerHTML = '<i></i>'.repeat(state.fieldsTotal);
    [...meter.children].forEach((seg, i) => seg.classList.toggle('is-on', i < state.fieldsDone));
    $('[data-paybtns]').classList.toggle('is-locked', stage !== 'ready');

    const next = $('[data-order-next]');
    if (next) {
        next.dataset.state = state.formValid ? 'done' : 'form';
        $('[data-order-next-text]', next).textContent = state.formValid
            ? (count ? t('Details complete — choose a payment method', 'তথ্য পূরণ হয়েছে — একটি পেমেন্ট পদ্ধতি বেছে নিন') : t('Details complete — now select your shares', 'তথ্য সম্পূর্ণ — এখন শেয়ার নির্বাচন করুন'))
            : t(`Complete these details · ${left} to go`, `এই তথ্যগুলো পূরণ করুন · বাকি ${left}টি`);
    }
}

let summaryInView = false;
function updateOrderBar() {
    const bar = $('[data-orderbar]');
    const show = totals().count > 0 && !summaryInView;
    bar.classList.toggle('is-visible', show);
    bar.setAttribute('aria-hidden', String(!show));
    $('a', bar).tabIndex = show ? 0 : -1;
}

/* Currency: live rates from the existing /currency endpoint (display only). */
async function fetchCurrency(code) {
    if (!CONFIG.routes.currency) return null;
    const url = CONFIG.routes.currency + (code ? `?currency=${encodeURIComponent(code)}` : '');
    try {
        const res = await fetch(url, { headers: { Accept: 'application/json' } });
        const data = res.ok ? await res.json() : null;
        return data && data.currency && data.rate > 0 ? { currency: data.currency, rate: Number(data.rate) } : null;
    } catch (e) {
        return null;
    }
}

const currencyPickers = [];
async function applyCurrency(code) {
    if (code === 'BDT') { state.local = null; render(); return; }
    const local = await fetchCurrency(code);
    state.local = local;
    if (!local) setHelp(t(`${code} rates aren't available right now — showing BDT.`, `${code}-এর হার এখন পাওয়া যাচ্ছে না — BDT দেখানো হচ্ছে।`), true);
    render();
}

function initCurrency() {
    const items = currencyItems();
    $$('[data-picker="currency"]').forEach((root) => {
        currencyPickers.push(createPicker(root, { items, value: 'BDT', kind: 'currency', onChange: (code) => applyCurrency(code) }));
    });
    // Visitor's local currency by location (or ?currency=XXX to preview).
    const preview = new URLSearchParams(window.location.search).get('currency');
    fetchCurrency(preview).then((local) => {
        if (!local || state.local) return;
        state.local = local;
        render();
    });
}

/* Customer details */
const form = () => $('[data-checkout-form]');
const RULES = {
    name: (v) => v.trim().length >= 2,
    phone: (v) => { const d = v.replace(/[^\d]/g, ''); return d.length >= 6 && d.length <= 14; },
    email: (v) => /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/.test(v.trim()),
    address_1: (v) => v.trim().length >= 3,
};

function checkField(input, show) {
    const ok = RULES[input.name](input.value);
    const field = input.closest('.field');
    if (show) {
        field.classList.toggle('is-invalid', !ok);
        input.setAttribute('aria-invalid', String(!ok));
    } else if (ok && field.classList.contains('is-invalid')) {
        field.classList.remove('is-invalid');
        input.setAttribute('aria-invalid', 'false');
    }
    return ok;
}

let countryPicker = null;
function customer() {
    const f = form();
    const code = countryPicker ? countryPicker.item.dial : '+880';
    // Local numbers are often typed with a trunk "0" (e.g. 01712…); drop it after the country code.
    const digits = f.elements.phone.value.replace(/[^\d]/g, '').replace(/^0+/, '');
    const address = [f.elements.address_1.value.trim(), f.elements.address_2.value.trim()].filter(Boolean).join(', ');
    return {
        name: f.elements.name.value.trim(),
        phone: `${code}${digits}`.slice(0, 20),
        email: f.elements.email.value.trim(),
        address: address.slice(0, 255),
    };
}

function sharesPayload() {
    return Object.fromEntries(KEYS.filter((k) => state.qty[k] > 0).map((k) => [k, state.qty[k]]));
}

function initForm() {
    const f = form();
    if (!f) return;
    const cc = $('[data-picker="country"]', f);
    if (cc) countryPicker = createPicker(cc, { items: countryItems(), value: cc.dataset.value || 'BD', kind: 'country', onChange: () => f.elements.phone.focus() });
    const inputs = Object.keys(RULES).map((name) => f.elements[name]);
    const recompute = () => {
        inputs.forEach((input) => {
            const complete = RULES[input.name](input.value);
            input.closest('.field').classList.toggle('is-complete', complete);
            const requiredNote = $(`[data-required-for="${input.name}"]`);
            if (requiredNote) requiredNote.hidden = complete;
        });
        state.fieldsTotal = inputs.length;
        state.fieldsDone = inputs.filter((i) => RULES[i.name](i.value)).length;
        state.formValid = state.fieldsDone === inputs.length;
        render();
    };
    inputs.forEach((input) => {
        input.addEventListener('blur', () => { if (input.value) checkField(input, true); });
        input.addEventListener('input', () => { checkField(input, false); recompute(); });
    });
    f.addEventListener('submit', (e) => e.preventDefault());
    recompute();
}

/* Payment hand-off to the existing backend */
function setBusy(method) {
    state.busy = method || false;
    render();
}

async function payWithPayPal() {
    setBusy('paypal');
    setHelp(t('Connecting to PayPal…', 'PayPal-এর সাথে সংযোগ করা হচ্ছে…'));
    try {
        const res = await fetch(CONFIG.routes.paypal, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ ...customer(), shares: sharesPayload() }),
        });
        const data = await res.json().catch(() => ({}));
        if (res.ok && data.approve_url) {
            window.location.href = data.approve_url;
            return;
        }
        const firstError = data.errors ? Object.values(data.errors).flat()[0] : null;
        setBusy(false);
        setHelp(firstError || data.message || t('Could not start the PayPal payment. Please try again.', 'পেপাল পেমেন্ট শুরু করা যায়নি। আবার চেষ্টা করুন।'), true);
    } catch (e) {
        setBusy(false);
        setHelp(t('Could not reach the server. Please try again.', 'সার্ভারের সাথে সংযোগ করা যায়নি। আবার চেষ্টা করুন।'), true);
    }
}

function payWithSslCommerz() {
    if (sslBlocked()) return;
    const trigger = document.getElementById('sslczPayBtn');
    if (!trigger) return;
    setHelp(t('Opening SSLCommerz…', 'SSLCommerz খোলা হচ্ছে…'));
    trigger.click(); // the embed script takes over from here
}

function initCommerce() {
    if (!KEYS.length || !$('[data-product]')) return;

    // Same contract as the booking form: postdata is set right before the embed reads it.
    const sslBtn = document.getElementById('sslczPayBtn');
    if (sslBtn) {
        sslBtn.addEventListener('click', () => {
            const c = customer();
            const obj = { cus_name: c.name, cus_phone: c.phone, cus_email: c.email, cus_addr1: c.address, cus_shares: sharesPayload() };
            if (window.jQuery) window.jQuery('#sslczPayBtn').prop('postdata', obj);
            else sslBtn.postdata = obj;
        });
    }

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

    $$('[data-qty]').forEach((input) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^\d]/g, '').slice(0, 6);
            if (input.value !== '') setQty(input.dataset.qty, parseInt(input.value, 10));
        });
        input.addEventListener('blur', () => { if (input.value === '') setQty(input.dataset.qty, 0); render(); });
    });

    $$('[data-preselect]').forEach((link) => link.addEventListener('click', () => {
        const key = link.dataset.preselect;
        if (key in state.qty && state.qty[key] === 0) setQty(key, 1);
    }));

    // The lock doubles as a shortcut to whatever is still missing.
    const lock = $('[data-paylock]');
    if (lock) lock.addEventListener('click', () => {
        if (!totals().count) { $('#invest').scrollIntoView({ behavior: reducedMotion.matches ? 'auto' : 'smooth' }); return; }
        const f = form();
        const names = Object.keys(RULES);
        names.forEach((name) => { if (f.elements[name].value) checkField(f.elements[name], true); });
        const first = names.map((n) => f.elements[n]).find((i) => !RULES[i.name](i.value));
        if (first) { first.scrollIntoView({ block: 'center', behavior: reducedMotion.matches ? 'auto' : 'smooth' }); first.focus({ preventScroll: true }); }
    });

    $$('[data-pay]').forEach((btn) => btn.addEventListener('click', () => {
        const f = form();
        Object.keys(RULES).forEach((name) => checkField(f.elements[name], true));
        if (missingStep() || methodState(btn.dataset.pay) !== 'active') { render(); return; }
        if (btn.dataset.pay === 'paypal') payWithPayPal();
        else payWithSslCommerz();
    }));

    new IntersectionObserver(([entry]) => { summaryInView = entry.isIntersecting; updateOrderBar(); }, { threshold: 0.05 }).observe($('#invest'));

    initForm();
    initCurrency();
    document.addEventListener('langchange', render);
    // Returning from the PayPal page via the back button restores usable buttons.
    window.addEventListener('pageshow', (e) => { if (e.persisted) setBusy(false); });
    render();
}

/* ----------------------------------------------------- Crafted interactions */
function initInteractions() {
    const fine = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    // Page progress hairline in the header.
    const bar = $('.hdr__progress');
    if (bar) {
        let raf = null;
        const upd = () => {
            const max = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.transform = `scaleX(${max > 0 ? window.scrollY / max : 0})`;
            raf = null;
        };
        window.addEventListener('scroll', () => { if (!raf) raf = requestAnimationFrame(upd); }, { passive: true });
        upd();
    }

    if (!fine || reducedMotion.matches) return;

    // Magnetic calls to action: they lean a few pixels towards the pointer.
    $$('[data-magnetic]').forEach((el) => {
        el.addEventListener('pointermove', (e) => {
            const r = el.getBoundingClientRect();
            const x = (e.clientX - r.left - r.width / 2) / r.width;
            const y = (e.clientY - r.top - r.height / 2) / r.height;
            el.style.transform = `translate(${(x * 8).toFixed(1)}px, ${(y * 6).toFixed(1)}px)`;
        });
        el.addEventListener('pointerleave', () => { el.style.transform = ''; });
    });

    // The gold card tilts with the pointer and catches the light.
    $$('[data-tilt]').forEach((el) => {
        el.addEventListener('pointermove', (e) => {
            const r = el.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width - 0.5;
            const y = (e.clientY - r.top) / r.height - 0.5;
            el.style.setProperty('--rx', `${(-y * 10).toFixed(2)}deg`);
            el.style.setProperty('--ry', `${(x * 12).toFixed(2)}deg`);
            el.style.setProperty('--gx', `${((x + 0.5) * 100).toFixed(1)}%`);
            el.style.setProperty('--gy', `${((y + 0.5) * 100).toFixed(1)}%`);
            el.classList.add('is-tilting');
        });
        el.addEventListener('pointerleave', () => {
            el.classList.remove('is-tilting');
            ['--rx', '--ry'].forEach((p) => el.style.setProperty(p, '0deg'));
        });
    });
}

/* ------------------------------------------------------- Payment result modal */
function initFlash() {
    const dialog = $('[data-flash]');
    if (dialog && typeof dialog.showModal === 'function') dialog.showModal();
}

initLanguage();
initHeader();
initHero();
initReveal();
initParallax();
initFilms();
initVoices();
initGallery();
initPrivilegeCard();
initCommerce();
initInteractions();
initFlash();
