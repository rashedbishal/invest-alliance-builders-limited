/*
 * Searchable flag pickers for country calling codes and currencies.
 * Names come from the browser (Intl.DisplayNames) in English or Bangla; flags are
 * lightweight PNGs from flagcdn. Accessible combobox + listbox pattern.
 */

// ISO 3166 alpha-2 + calling code, for every country/territory.
const DIAL = 'AF93 AX358 AL355 DZ213 AS1684 AD376 AO244 AI1264 AQ672 AG1268 AR54 AM374 AW297 AU61 AT43 AZ994 BS1242 BH973 BD880 BB1246 BY375 BE32 BZ501 BJ229 BM1441 BT975 BO591 BQ599 BA387 BW267 BR55 IO246 VG1284 BN673 BG359 BF226 BI257 KH855 CM237 CA1 CV238 KY1345 CF236 TD235 CL56 CN86 CX61 CC61 CO57 KM269 CG242 CD243 CK682 CR506 CI225 HR385 CU53 CW599 CY357 CZ420 DK45 DJ253 DM1767 DO1809 EC593 EG20 SV503 GQ240 ER291 EE372 SZ268 ET251 FK500 FO298 FJ679 FI358 FR33 GF594 PF689 GA241 GM220 GE995 DE49 GH233 GI350 GR30 GL299 GD1473 GP590 GU1671 GT502 GG44 GN224 GW245 GY592 HT509 HN504 HK852 HU36 IS354 IN91 ID62 IR98 IQ964 IE353 IM44 IL972 IT39 JM1876 JP81 JE44 JO962 KZ7 KE254 KI686 XK383 KW965 KG996 LA856 LV371 LB961 LS266 LR231 LY218 LI423 LT370 LU352 MO853 MG261 MW265 MY60 MV960 ML223 MT356 MH692 MQ596 MR222 MU230 YT262 MX52 FM691 MD373 MC377 MN976 ME382 MS1664 MA212 MZ258 MM95 NA264 NR674 NP977 NL31 NC687 NZ64 NI505 NE227 NG234 NU683 NF672 KP850 MK389 MP1670 NO47 OM968 PK92 PW680 PS970 PA507 PG675 PY595 PE51 PH63 PN64 PL48 PT351 PR1787 QA974 RE262 RO40 RU7 RW250 BL590 SH290 KN1869 LC1758 MF590 PM508 VC1784 WS685 SM378 ST239 SA966 SN221 RS381 SC248 SL232 SG65 SX1721 SK421 SI386 SB677 SO252 ZA27 GS500 KR82 SS211 ES34 LK94 SD249 SR597 SJ47 SE46 CH41 SY963 TW886 TJ992 TZ255 TH66 TL670 TG228 TK690 TO676 TT1868 TN216 TR90 TM993 TC1649 TV688 UG256 UA380 AE971 GB44 US1 UY598 VI1340 UZ998 VU678 VA39 VE58 VN84 WF681 EH212 YE967 ZM260 ZW263';
const POPULAR_COUNTRIES = ['BD', 'IN', 'AE', 'SA', 'QA', 'KW', 'OM', 'BH', 'MY', 'SG', 'GB', 'US', 'CA', 'AU', 'IT'];

// Active ISO 4217 currencies.
const CURRENCIES = 'AED AFN ALL AMD ANG AOA ARS AUD AWG AZN BAM BBD BDT BGN BHD BIF BMD BND BOB BRL BSD BTN BWP BYN BZD CAD CDF CHF CLP CNY COP CRC CUP CVE CZK DJF DKK DOP DZD EGP ERN ETB EUR FJD FKP GBP GEL GHS GIP GMD GNF GTQ GYD HKD HNL HTG HUF IDR ILS INR IQD IRR ISK JMD JOD JPY KES KGS KHR KMF KPW KRW KWD KYD KZT LAK LBP LKR LRD LSL LYD MAD MDL MGA MKD MMK MNT MOP MRU MUR MVR MWK MXN MYR MZN NAD NGN NIO NOK NPR NZD OMR PAB PEN PGK PHP PKR PLN PYG QAR RON RSD RUB RWF SAR SBD SCR SDG SEK SGD SHP SLE SOS SRD SSP STN SVC SYP SZL THB TJS TMT TND TOP TRY TTD TWD TZS UAH UGX USD UYU UZS VES VND VUV WST XAF XCD XOF XPF YER ZAR ZMW ZWL'.split(' ');
const POPULAR_CURRENCIES = ['BDT', 'USD', 'GBP', 'EUR', 'AED', 'SAR', 'QAR', 'KWD', 'OMR', 'MYR', 'SGD', 'CAD', 'AUD', 'INR'];
const CURRENCY_FLAG = { EUR: 'eu', ANG: 'cw', XAF: 'cm', XOF: 'sn', XCD: 'ag', XPF: 'pf' };

const lang = () => (document.documentElement.dataset.lang === 'bn' ? 'bn' : 'en');
const namers = {};
function displayName(type, code) {
    const l = lang();
    const key = `${type}:${l}`;
    try {
        namers[key] = namers[key] || new Intl.DisplayNames([l, 'en'], { type });
        return namers[key].of(code) || code;
    } catch (e) {
        return code;
    }
}
function currencySymbol(code) {
    try {
        const part = new Intl.NumberFormat('en', { style: 'currency', currency: code, currencyDisplay: 'narrowSymbol' })
            .formatToParts(0).find((p) => p.type === 'currency');
        return part ? part.value : code;
    } catch (e) {
        return code;
    }
}

export const flagUrl = (cc, w = 40) => `https://flagcdn.com/w${w}/${cc.toLowerCase()}.png`;

export function countryItems() {
    return DIAL.split(' ').map((entry) => {
        const iso = entry.slice(0, 2);
        const dial = `+${entry.slice(2)}`;
        return { value: iso, flag: iso, get label() { return displayName('region', iso) === 'XK' ? 'Kosovo' : displayName('region', iso); }, meta: dial, dial, popular: POPULAR_COUNTRIES.indexOf(iso) };
    });
}

export function currencyItems() {
    return CURRENCIES.map((code) => ({
        value: code,
        flag: CURRENCY_FLAG[code] || code.slice(0, 2),
        get label() { return displayName('currency', code); },
        meta: code,
        symbol: currencySymbol(code),
        popular: POPULAR_CURRENCIES.indexOf(code),
    }));
}

let uid = 0;
const TEXT = {
    search: { en: 'Search', bn: 'খুঁজুন' },
    popular: { en: 'Popular', bn: 'জনপ্রিয়' },
    all: { en: 'All', bn: 'সব' },
    none: { en: 'No matches', bn: 'কিছু পাওয়া যায়নি' },
};

/**
 * Turn an empty <div class="picker" data-picker="country|currency"> into a combobox.
 * Returns { get value, set(value, silent) }.
 */
export function createPicker(root, { items, value, onChange, kind }) {
    const id = `pk${++uid}`;
    const byValue = new Map(items.map((it) => [it.value, it]));
    let current = byValue.get(value) || items[0];
    let open = false;
    let active = -1;
    let visible = [];

    root.innerHTML = `
        <button type="button" class="picker__btn" aria-haspopup="listbox" aria-expanded="false" aria-controls="${id}-pop">
            <span class="picker__flag"><img alt="" width="22" height="16" loading="lazy"></span>
            <span class="picker__text"><span class="picker__main"></span><span class="picker__sub"></span></span>
            <svg class="picker__chev" viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
        </button>
        <div class="picker__pop" id="${id}-pop" hidden>
            <div class="picker__search">
                <svg viewBox="0 0 16 16" aria-hidden="true"><circle cx="7" cy="7" r="4.5" fill="none" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 10.5 14 14" stroke="currentColor" stroke-width="1.3"/></svg>
                <input type="text" role="combobox" aria-autocomplete="list" aria-expanded="true" aria-controls="${id}-list" autocomplete="off" spellcheck="false">
            </div>
            <ul class="picker__list" id="${id}-list" role="listbox"></ul>
        </div>
        ${root.dataset.name ? `<input type="hidden" name="${root.dataset.name}">` : ''}`;

    const btn = root.querySelector('.picker__btn');
    const pop = root.querySelector('.picker__pop');
    const search = root.querySelector('.picker__search input');
    const list = root.querySelector('.picker__list');
    const hidden = root.querySelector('input[type="hidden"]');
    if (root.dataset.label) btn.setAttribute('aria-label', root.dataset.label);
    // The popover floats above the page: in the browser's top layer where supported, otherwise
    // moved to <body> with fixed positioning. Either way it takes no space in the layout, can't be
    // clipped by a parent, and is placed against the viewport so it never widens the page.
    const topLayer = typeof pop.showPopover === 'function';
    if (topLayer) pop.setAttribute('popover', 'manual');
    pop.classList.add(`picker__pop--${kind}`);

    const t = (k) => TEXT[k][lang()];
    const flagImg = (it) => `<img src="${flagUrl(it.flag)}" srcset="${flagUrl(it.flag, 80)} 2x" alt="" width="22" height="16" loading="lazy" onerror="this.style.visibility='hidden'">`;

    function paintButton() {
        const img = btn.querySelector('.picker__flag img');
        img.src = flagUrl(current.flag);
        img.srcset = `${flagUrl(current.flag, 80)} 2x`;
        img.onerror = () => { img.style.visibility = 'hidden'; };
        img.style.visibility = '';
        if (kind === 'country') {
            btn.querySelector('.picker__main').textContent = current.dial;
            btn.querySelector('.picker__sub').textContent = current.value;
        } else {
            btn.querySelector('.picker__main').textContent = current.value;
            btn.querySelector('.picker__sub').textContent = current.symbol !== current.value ? current.symbol : '';
        }
        btn.title = current.label;
        if (hidden) hidden.value = kind === 'country' ? current.dial : current.value;
    }

    function row(it, idx) {
        const selected = it.value === current.value;
        const badge = kind === 'currency' ? `<span class="picker__sym" aria-hidden="true">${it.symbol}</span>` : '';
        return `<li role="option" id="${id}-o${idx}" data-value="${it.value}" aria-selected="${selected}" class="picker__opt${selected ? ' is-selected' : ''}">
            <span class="picker__flag">${flagImg(it)}${badge}</span>
            <span class="picker__name">${it.label}</span>
            <span class="picker__meta">${it.meta}</span>
            <svg class="picker__tick" viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 6.2l2.3 2.3 4.7-5" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
        </li>`;
    }

    function renderList() {
        const q = search.value.trim().toLowerCase().replace(/^\+/, '');
        const match = (it) => !q || it.label.toLowerCase().includes(q) || it.value.toLowerCase().includes(q) || (it.dial && it.dial.slice(1).startsWith(q)) || (it.symbol && it.symbol.toLowerCase() === q);
        const filtered = items.filter(match);
        const popular = q ? [] : filtered.filter((it) => it.popular > -1).sort((a, b) => a.popular - b.popular);
        const rest = filtered.filter((it) => q || it.popular === -1).sort((a, b) => a.label.localeCompare(b.label, lang()));
        visible = [...popular, ...rest];
        let html = '';
        let idx = 0;
        if (popular.length) {
            html += `<li class="picker__group" role="presentation">${t('popular')}</li>`;
            popular.forEach((it) => { html += row(it, idx++); });
            html += `<li class="picker__group" role="presentation">${t('all')}</li>`;
        }
        rest.forEach((it) => { html += row(it, idx++); });
        list.innerHTML = html || `<li class="picker__empty" role="presentation">${t('none')}</li>`;
        setActive(Math.max(0, visible.findIndex((it) => it.value === current.value)), !q);
    }

    function setActive(i, center = false) {
        active = Math.max(0, Math.min(visible.length - 1, i));
        list.querySelectorAll('.picker__opt').forEach((li, k) => li.classList.toggle('is-active', k === active));
        const el = list.querySelector(`#${id}-o${active}`);
        if (el) {
            search.setAttribute('aria-activedescendant', el.id);
            if (center) list.scrollTop = el.offsetTop - list.clientHeight / 2 + el.clientHeight / 2;
            else el.scrollIntoView({ block: 'nearest' });
        }
    }

    function show() {
        if (open) return;
        open = true;
        search.placeholder = t('search');
        search.value = '';
        if (!topLayer && pop.parentNode !== document.body) document.body.appendChild(pop);
        pop.hidden = false;
        if (topLayer) { try { pop.showPopover(); } catch (e) { /* already open */ } }
        root.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
        renderList();
        place();
        window.addEventListener('resize', place);
        window.addEventListener('scroll', place, { passive: true, capture: true });
        requestAnimationFrame(() => search.focus({ preventScroll: true }));
        document.addEventListener('pointerdown', outside, true);
    }

    // Anchor to the button, flip above it when there's more room there, and keep a 12px margin
    // from every edge of the viewport.
    function place() {
        if (!open) return;
        const g = 12;
        const vw = document.documentElement.clientWidth;
        const vh = document.documentElement.clientHeight;
        const r = btn.getBoundingClientRect();
        if (r.bottom < 0 || r.top > vh) { hide(false); return; }
        const w = Math.min(340, vw - g * 2);
        let left = r.left + w > vw - g ? r.right - w : r.left;
        left = Math.max(g, Math.min(left, vw - g - w));
        const below = vh - r.bottom - g - 8;
        const above = r.top - g - 8;
        const up = below < 300 && above > below;
        list.style.maxHeight = `${Math.max(140, Math.min(320, (up ? above : below) - 56))}px`;
        pop.style.width = `${w}px`;
        pop.style.left = `${Math.round(left)}px`;
        pop.style.top = up ? 'auto' : `${Math.round(r.bottom + 8)}px`;
        pop.style.bottom = up ? `${Math.round(vh - r.top + 8)}px` : 'auto';
        pop.classList.toggle('is-up', up);
        pop.style.transformOrigin = `${left + w / 2 > r.left + r.width / 2 ? 'left' : 'right'} ${up ? 'bottom' : 'top'}`;
    }

    function hide(focusBtn = true) {
        if (!open) return;
        open = false;
        window.removeEventListener('resize', place);
        window.removeEventListener('scroll', place, { capture: true });
        root.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
        if (topLayer) { try { pop.hidePopover(); } catch (e) { /* already closed */ } }
        pop.hidden = true;
        document.removeEventListener('pointerdown', outside, true);
        if (focusBtn) btn.focus({ preventScroll: true });
    }

    function outside(e) { if (!root.contains(e.target) && !pop.contains(e.target)) hide(false); }

    function choose(v, silent = false) {
        const it = byValue.get(v);
        if (!it) return;
        const changed = it.value !== current.value;
        current = it;
        paintButton();
        if (changed && !silent && onChange) onChange(it.value, it);
    }

    btn.addEventListener('click', () => (open ? hide() : show()));
    btn.addEventListener('keydown', (e) => { if (['ArrowDown', 'ArrowUp'].includes(e.key)) { e.preventDefault(); show(); } });
    search.addEventListener('input', renderList);
    search.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown') { e.preventDefault(); setActive(active + 1); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); setActive(active - 1); }
        else if (e.key === 'Enter') { e.preventDefault(); if (visible[active]) { choose(visible[active].value); hide(); } }
        else if (e.key === 'Escape') { e.preventDefault(); hide(); }
        else if (e.key === 'Tab') hide(false);
    });
    list.addEventListener('pointermove', (e) => {
        const li = e.target.closest('.picker__opt');
        if (li) setActive([...list.querySelectorAll('.picker__opt')].indexOf(li));
    });
    list.addEventListener('click', (e) => {
        const li = e.target.closest('.picker__opt');
        if (li) { choose(li.dataset.value); hide(); }
    });
    document.addEventListener('langchange', () => { paintButton(); if (open) renderList(); });

    paintButton();
    return {
        get value() { return current.value; },
        get item() { return current; },
        set(v, silent = true) { choose(v, silent); },
        has(v) { return byValue.has(v); },
    };
}
