<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Jana — Where the Bay of Bengal Meets Infinity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Cinzel:wght@400;500;600;700&family=Crimson+Pro:ital,wght@0,200;0,300;0,400;1,200;1,300&family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <style>
        /* ── VARIABLES ── */
        :root {
            --gold: #28ace2;
            --gold-light: #4fc3f0;
            --gold-pale: #cceeff;
            --deep-navy: #0a0f1e;
            --ocean-dark: #060D1A;
            --ocean-mid: #0D2137;
            --cream: #F7F1E8;
            --text-light: #E8DCC8;
        }

        /* ── RESET ── */
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body { background:var(--ocean-dark); color:var(--cream); font-family:'Cormorant Garamond',serif; cursor:none; overflow-x:hidden; }

        /* ── CURSOR ── */
        .cursor { position:fixed; width:8px; height:8px; background:var(--gold); border-radius:50%; pointer-events:none; z-index:999999; transform:translate(-50%,-50%); transition:width .3s,height .3s,opacity .3s; mix-blend-mode:difference; }
        .cursor-ring { position:fixed; width:36px; height:36px; border:1px solid rgba(40,172,226,.5); border-radius:50%; pointer-events:none; z-index:999998; transform:translate(-50%,-50%); transition:all .15s ease; }
        body:hover .cursor { opacity:1; }

        /* ── LANG ORB (custom shape + animation) ── */
        .lang-orb { width:60px; height:28px; background:rgba(73,73,73,.8); border:1px solid rgba(40,172,226,.4); border-radius:20px; position:relative; cursor:pointer; backdrop-filter:blur(12px); transition:border-color .3s; display:flex; align-items:center; padding:0 4px; justify-content:space-between; }
        .lang-orb:hover { border-color:var(--gold); }
        .lang-orb .lang-label { font-family:'Cinzel',serif; font-size:12px; letter-spacing:.05em; color:#fff; font-weight:300; line-height:1; z-index:1; position:relative; padding:0 4px; }
        .lang-orb .lang-ball { position:absolute; width:28px; height:18px; background:linear-gradient(135deg,var(--gold),var(--gold-light)); border-radius:999px; top:50%; transform:translateY(-50%); left:4px; transition:left .4s cubic-bezier(.68,-.55,.27,1.55); box-shadow:0 0 8px rgba(40,172,226,.5); }
        .lang-orb.bn .lang-ball { left:calc(100% - 31px); }

        /* ── NAV scrolled state ── */
        nav.scrolled { background:rgba(6,13,26,.92); backdrop-filter:blur(20px); border-bottom:1px solid rgba(40,172,226,.15); }

        /* ── NAV link underline pseudo ── */
        .nav-links a { position:relative; transition:color .3s; }
        .nav-links a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:1px; background:var(--gold); transition:width .3s; }
        .nav-links a:hover { color:var(--gold); }
        .nav-links a:hover::after { width:100%; }

        /* ── HERO backgrounds & animations ── */
        .hero-bg {
            position:absolute; inset:0;
            background:
                radial-gradient(ellipse 80% 50% at 50% 100%,rgba(13,33,55,.9) 0%,transparent 70%),
                radial-gradient(ellipse 60% 40% at 20% 60%,rgba(40,172,226,.06) 0%,transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 60%,rgba(13,33,55,.8) 0%,transparent 60%),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&q=90') center/cover no-repeat;
            animation:heroParallax 20s ease-in-out infinite alternate;
        }
        @keyframes heroParallax { from{transform:scale(1.05) translateY(0)} to{transform:scale(1.12) translateY(-20px)} }

        .hero-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(6,13,26,.3) 0%,rgba(6,13,26,.2) 40%,rgba(6,13,26,.7) 80%,rgba(6,13,26,1) 100%); }

        /* ── Hero text animations ── */
        .hero-eyebrow { opacity:0; animation:fadeUp 1.2s .5s forwards; text-shadow:0 1px 8px rgba(255,255,255,.6); }
        .hero-title    { opacity:0; animation:fadeUp 1.2s .8s forwards; }
        .hero-subtitle { opacity:0; animation:fadeUp 1.2s 1.1s forwards; text-shadow:0 1px 12px rgba(0,0,0,.7); }
        .hero-cta      { opacity:0; animation:fadeUp 1.2s 1.4s forwards; }
        .scroll-indicator { opacity:0; animation:fadeIn 1s 2.5s forwards; }

        @keyframes fadeUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
        @keyframes fadeIn { from{opacity:0} to{opacity:1} }

        /* ── Scroll line pulse ── */
        .scroll-line { width:1px; height:60px; background:linear-gradient(to bottom,transparent,var(--gold),transparent); animation:scrollPulse 2s ease-in-out infinite; }
        @keyframes scrollPulse { 0%,100%{opacity:.4;transform:scaleY(.8)} 50%{opacity:1;transform:scaleY(1)} }

        /* ── Particles ── */
        .particle { position:absolute; border-radius:50%; background:var(--gold); pointer-events:none; animation:float linear infinite; opacity:0; }
        @keyframes float {
            0%   { transform:translateY(100vh) translateX(0) scale(0); opacity:0; }
            10%  { opacity:.6; }
            90%  { opacity:.3; }
            100% { transform:translateY(-100px) translateX(100px) scale(.5); opacity:0; }
        }

        /* ── Gold divider gradients (pseudo-impossible in Tailwind) ── */
        .gold-divider-line       { height:1px; flex:1; max-width:120px; background:linear-gradient(to right,transparent,var(--gold)); }
        .gold-divider-line.right { background:linear-gradient(to left,transparent,var(--gold)); }
        .gold-divider-diamond    { width:6px; height:6px; background:var(--gold); transform:rotate(45deg); }

        /* ── Decorative line ── */
        .gold-line-deco { width:100%; height:1px; background:linear-gradient(to right,transparent,rgba(40,172,226,.4) 30%,rgba(40,172,226,.4) 70%,transparent); margin:60px 0; }

        /* ── Sunrise glow ── */
        .sunrise-glow { position:absolute; bottom:0; left:0; right:0; height:200px; background:linear-gradient(to top,rgba(40,172,226,.08),transparent); pointer-events:none; }

        /* ── Button pseudo hover overlays ── */
        .btn-gold { font-family:'Cinzel',serif; font-size:14px; letter-spacing:.3em; text-transform:uppercase; color:var(--deep-navy); font-weight:bold; background:linear-gradient(135deg,var(--gold),var(--gold-light)); border:none; padding:18px 44px; cursor:pointer; text-decoration:none; display:inline-block; position:relative; overflow:hidden; transition:transform .3s,box-shadow .3s; }
        .btn-gold::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,var(--gold-light),var(--gold)); opacity:0; transition:opacity .3s; }
        .btn-gold:hover   { transform:translateY(-2px); box-shadow:0 12px 40px rgba(40,172,226,.4); }
        .btn-gold:hover::before { opacity:1; }
        .btn-gold span    { position:relative; z-index:1; }
        .btn-outline { font-family:'Cinzel',serif; font-size:14px; letter-spacing:.3em; text-transform:uppercase; color:var(--gold); font-weight:bold; background:transparent; border:1px solid rgba(40,172,226,.5); padding:18px 44px; cursor:pointer; text-decoration:none; display:inline-block; transition:all .3s; backdrop-filter:blur(8px); }
        .btn-outline:hover { background:rgba(40,172,226,.1); border-color:var(--gold); box-shadow:0 0 30px rgba(40,172,226,.2); }

        /* ── Story backgrounds ── */
        .story-bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1519046904884-53103b34b206?w=1920&q=80') center 30%/cover;
            opacity: .5; /* FULL visibility */
            filter: brightness(1.1) contrast(1.1) saturate(1.1);
        }

        .story-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(6,13,26,0.75) 40%,
                rgba(6,13,26,0.25) 100%
            );
        }

        /* ── Gallery hover effects ── */
        .gallery-item img { width:100%; height:100%; object-fit:cover; transition:transform .8s cubic-bezier(.25,.46,.45,.94),filter .5s; filter:brightness(.85) saturate(.9); }
        .gallery-item:hover img { transform:scale(1.06); filter:brightness(1) saturate(1.1); }
        .gallery-item-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(6,13,26,.7) 0%,transparent 50%); opacity:0; transition:opacity .4s; }
        .gallery-item:hover .gallery-item-overlay { opacity:1; }
        .gallery-item-label { position:absolute; bottom:20px; left:20px; font-family:'Cinzel',serif; font-size:18px; letter-spacing:.2em; color:#fff; opacity:0; transition:opacity .4s,transform .4s; transform:translateY(10px); }
        .gallery-item:hover .gallery-item-label { opacity:1; transform:translateY(0); }
        .gallery-gold-border { position:absolute; inset:8px; border:1px solid rgba(255,255,255,.3); pointer-events:none; z-index:3; opacity:0; transition:opacity .4s; border-radius:16px; }
        .gallery-item:hover .gallery-gold-border { opacity:1; }

        /* ── Benefits backgrounds & pseudo ── */
        .benefits-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(
                    ellipse 80% 60% at 50% 0%,
                    rgba(40,172,226,.12) 0%,
                    rgba(40,172,226,.05) 40%,
                    transparent 80%
                ),
                url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1920&q=70') center/cover;
            opacity: 0.52; /* was 0.08 → big visibility boost */
            filter: brightness(1.05) contrast(1.08) saturate(1.05);
        }
        .benefit-card::before {
            content:'';
            position:absolute;
            top:0;
            left:0;
            right:0;
            height:3px; /* slightly thicker */
            background:linear-gradient(to right,transparent,var(--gold),transparent);
            opacity:0;
            transition:opacity .4s, transform .4s;
            transform: scaleX(0.6);
        }

        .benefit-card:hover::before {
            opacity:1;
            transform: scaleX(1);
        }

        .benefit-card-shine {
            position:absolute;
            inset:0;
            pointer-events:none;
            background:radial-gradient(
                circle at 20% 20%,
                rgba(40,172,226,.18) 0%,
                rgba(40,172,226,.08) 30%,
                transparent 65%
            );
            opacity:0;
            transition:opacity .4s;
        }

        .benefit-card:hover .benefit-card-shine {
            opacity:1;
        }
        /* ── Amenities pseudo ── */
        .amenity-item::after { content:''; position:absolute; inset:0; background:radial-gradient(circle at center,rgba(40,172,226,.08) 0%,transparent 70%); opacity:0; transition:opacity .4s; }
        .amenity-item:hover::after { opacity:1; }
        .amenities-bg { position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1920&q=70') center/cover; opacity:.03; }

        /* ── Privilege card shine animation ── */

            .privilege-bg {
                position:absolute;
                inset:0;
                background:
                    linear-gradient(
                        135deg,
                        rgba(40,172,226,.10) 0%,
                        rgba(40,172,226,.05) 40%,
                        transparent 70%
                    ),
                    url('https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1920&q=70') center/cover;
                opacity:.52; /* was .08 → much more visible */
                filter: brightness(1.12) contrast(1.1) saturate(1.08);
            }
            .privilege-card-shine {
                position:absolute;
                top:-50%;
                left:-50%;
                width:200%;
                height:200%;
                background: linear-gradient(
                    45deg,
                    transparent 25%,
                    rgba(255, 244, 200, .45) 50%,
                    transparent 75%
                );
                transform:rotate(30deg);
                animation:cardShine 3s ease-in-out infinite; /* faster + more visible */
                opacity:.8;
            }
            @keyframes cardShine { 0%,100%{transform:rotate(30deg) translateX(-100%)} 50%{transform:rotate(30deg) translateX(100%)} }
            .privilege-card::before {
                content:'';
                position:absolute;
                inset:0;
                background: linear-gradient(
                    135deg,
                    rgba(255, 255, 255, .55) 0%,
                    rgba(255, 255, 255, .2) 35%,
                    transparent 60%,
                    rgba(212,175,55,.25) 100%
                );
                pointer-events:none;
            }
            .privilege-perks li::before {
                content:'✦';
                color:#0b3a5b; /* slightly deeper for contrast */
                font-size:12px; /* bigger */
            }
            .priv-term::before { content:'✦'; font-size:8px; color:rgba(10,15,30,.4); flex-shrink:0; margin-top:2px; }
            .priv-wave-bar::before { content:''; position:absolute; inset:0; background:linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent); border-radius:2px; }

        /* Brand */
        #brand {
            background: linear-gradient(
                to bottom,
                rgba(6, 13, 26, 0.85),
                rgba(6, 13, 26, 0.7)
            );
        }



        /* ── Invest backgrounds ── */
        .invest-bg { position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=90') center/cover; animation:investParallax 25s ease-in-out infinite alternate; }
        @keyframes investParallax { from{transform:scale(1) translateY(0)} to{transform:scale(1.08) translateY(-30px)} }
        .invest-overlay {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top, rgba(255,255,255,0.08), transparent 60%),
                linear-gradient(
                    to bottom,
                    rgba(6, 13, 26, 0.25),
                    rgba(6, 13, 26, 0.4),
                    rgba(6, 13, 26, 0.25)
                );
        }

        /* ── Reveal animations ── */
        .reveal       { opacity:0; transform:translateY(40px); transition:opacity .9s ease,transform .9s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .reveal-left  { opacity:0; transform:translateX(-40px); transition:opacity .9s ease,transform .9s ease; }
        .reveal-left.visible { opacity:1; transform:translateX(0); }
        .reveal-right { opacity:0; transform:translateX(40px); transition:opacity .9s ease,transform .9s ease; }
        .reveal-right.visible { opacity:1; transform:translateX(0); }

        /* ── Language toggle ── */
        [data-bn] { display:none; }
        body.lang-bn [data-en] { display:none; }
        body.lang-bn [data-bn] { display:block; }
        body.lang-bn [data-bn].inline-flex { display:inline-flex; }
        body.lang-bn [data-bn].flex  { display:flex; }
        body.lang-bn [data-bn].grid  { display:grid; }

        /* ── Noise texture overlay ── */
        body::after { content:''; position:fixed; inset:0; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E"); pointer-events:none; z-index:99990; opacity:.4; }

        /* ── Contact hover ── */
        .contact-value a { color:rgba(232,220,200,.7); text-decoration:none; }
        .contact-value a:hover { color:var(--gold); }

        /* ── MOBILE: hide cursor on touch devices ── */
        @media (hover: none) {
            .cursor, .cursor-ring { display:none; }
            body { cursor:auto; }
        }

        /* ── MOBILE: privilege cards wrap scales down ── */
        @media (max-width: 1024px) {
            .privilege-cards-wrap { width:100% !important; height:auto !important; min-height:320px; }
            .priv-card { position:relative !important; width:100% !important; top:auto !important; left:auto !important; }
            .priv-back  { margin-top:16px; }
            #privStack { cursor:default !important; pointer-events:none !important; }
            #privClickHint { display:none !important; }
        }

        /* ── MOBILE: gallery grid collapses ── */
        @media (max-width: 1024px) {
            .gallery-grid { grid-template-columns:1fr 1fr !important; height:auto !important; }
            .gallery-grid .gallery-item:first-child { grid-row:auto !important; }
        }
        @media (max-width: 640px) {
            .gallery-grid { grid-template-columns:1fr !important; }
        }

        /* ── MOBILE: buttons stack and shrink ── */
        @media (max-width: 480px) {
            .btn-gold, .btn-outline { padding:14px 28px; font-size:11px; letter-spacing:.2em; width:100%; text-align:center; box-sizing:border-box; }
        }

        /* ── MOBILE: invest price shrinks ── */
        @media (max-width: 480px) {
            .invest-price-wrap span:nth-child(2) { font-size:44px !important; }
        }
    </style>

    <!-- =====================================================================
     DROP THIS <style> BLOCK anywhere in your <head> or before </body>
     It overrides benefits + amenities to be compact on mobile.
     ===================================================================== -->
    <style>
        /* ══════════════════════════════════════════════════════
           BENEFITS — 12 cards
           Desktop: 3-col grid (unchanged)
           Tablet (640-1023px): 2-col grid, tighter padding
           Mobile (<640px): horizontal snap carousel, one row
           ══════════════════════════════════════════════════════ */

        /* Wrap the existing grid in a scroll container on mobile */
        @media (max-width: 639px) {

            /* Turn the grid into a horizontal scroll carousel */
            #benefits .grid {
                display: flex !important;
                flex-direction: row !important;
                overflow-x: auto !important;
                overflow-y: visible !important;
                scroll-snap-type: x mandatory !important;
                -webkit-overflow-scrolling: touch !important;
                gap: 10px !important;
                padding-bottom: 16px !important;
                /* hide scrollbar visually but keep scroll */
                scrollbar-width: none !important;
            }
            #benefits .grid::-webkit-scrollbar { display: none; }

            /* Each benefit card becomes a fixed-width snap item */
            #benefits .benefit-card {
                flex: 0 0 72vw !important;
                min-width: 0 !important;
                scroll-snap-align: center !important;
                padding: 20px 18px !important;
            }

            /* Shrink the number badge */
            #benefits .benefit-card .font-\[\'Cinzel\'\][style*="30px"] {
                font-size: 18px !important;
            }

            /* Shrink emoji icon */
            #benefits .benefit-card span.text-\[38px\] {
                font-size: 26px !important;
                margin-bottom: 10px !important;
            }

            /* Shrink title */
            #benefits .benefit-card .text-3xl {
                font-size: 17px !important;
                margin-bottom: 6px !important;
            }

            /* Shrink body copy */
            #benefits .benefit-card .text-\[25px\] {
                font-size: 14px !important;
            }
            #benefits .benefit-card .text-2xl {
                font-size: 14px !important;
            }

            /* Scroll hint dots indicator */
            #benefitsDots {
                display: flex !important;
            }
        }

        @media (min-width: 640px) {
            #benefitsDots { display: none !important; }
        }

        /* Tablet: 2-col, tighter */
        @media (min-width: 640px) and (max-width: 1023px) {
            #benefits .benefit-card {
                padding: 28px 24px !important;
            }
            #benefits .benefit-card .text-3xl {
                font-size: 18px !important;
            }
            #benefits .benefit-card .text-\[25px\] {
                font-size: 16px !important;
            }
            #benefits .benefit-card .text-2xl {
                font-size: 15px !important;
            }
            #benefits .benefit-card span.text-\[38px\] {
                font-size: 28px !important;
            }
        }


        /* ══════════════════════════════════════════════════════
           AMENITIES — 17 items
           Desktop: 4-col (unchanged)
           Tablet (640-1023px): 4-col, smaller squares
           Mobile (<640px): 3-col grid, compact squares
           ══════════════════════════════════════════════════════ */

        @media (max-width: 639px) {
            /* Force 3 columns on mobile */
            #amenities .grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 2px !important;
            }

            /* Remove aspect-square, use padding-based square */
            #amenities .amenity-item {
                aspect-ratio: 1 / 1 !important;
                padding: 8px 4px !important;
                gap: 4px !important;
            }

            /* Shrink emoji */
            #amenities .amenity-item span.text-\[64px\] {
                font-size: 28px !important;
            }

            /* Shrink label text */
            #amenities .amenity-item .text-\[28px\] {
                font-size: 10px !important;
                letter-spacing: 0.05em !important;
                line-height: 1.2 !important;
            }
            #amenities .amenity-item .text-\[32px\] {
                font-size: 10px !important;
                line-height: 1.2 !important;
            }

            /* Shrink the footer note */
            #amenities > div > p.text-lg {
                font-size: 13px !important;
            }
            #amenities > div > p.text-\[15px\] {
                font-size: 12px !important;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            #amenities .grid {
                grid-template-columns: repeat(4, 1fr) !important;
            }
            #amenities .amenity-item span.text-\[64px\] {
                font-size: 36px !important;
            }
            #amenities .amenity-item .text-\[28px\] {
                font-size: 13px !important;
                letter-spacing: 0.08em !important;
            }
            #amenities .amenity-item .text-\[32px\] {
                font-size: 14px !important;
            }
            #amenities .amenity-item {
                padding: 12px 8px !important;
                gap: 6px !important;
            }
        }
    </style>

    <!-- Scroll indicator dots for benefits carousel (mobile only) -->
    <style>
        #benefitsDots {
            display: none; /* shown via media query above */
            justify-content: center;
            gap: 6px;
            margin-top: 14px;
        }
        #benefitsDots span {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: rgba(40,172,226,0.3);
            transition: background 0.3s, transform 0.3s;
            cursor: pointer;
        }
        #benefitsDots span.active {
            background: rgba(40,172,226,0.9);
            transform: scale(1.3);
        }
    </style>
</head>

<body>

<!-- CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAVIGATION -->
<nav id="mainNav" class="fixed top-0 left-0 right-0 z-[9990] flex items-center justify-between px-4 py-2 transition-all duration-500">
    <a href="{{route('home')}}" style="font-family:'Cinzel',serif;font-size:20px;letter-spacing:.2em;color:var(--gold);font-weight:600;text-decoration:none;">
        <img src="{{ Vite::asset('resources/images/logo/jana-back.png') }}" alt="jana logo" class="w-14 h-auto">
    </a>

    <!-- Desktop nav -->
    <div class="nav-links hidden lg:flex items-center gap-9">
        <a href="#story"     class="font-['Cinzel'] text-sm tracking-widest text-white uppercase">Our Vision</a>
        <a href="#gallery"   class="font-['Cinzel'] text-sm tracking-widest text-white uppercase">Gallery</a>
        <a href="#benefits"  class="font-['Cinzel'] text-sm tracking-widest text-white uppercase">Ownership</a>
        <a href="#amenities" class="font-['Cinzel'] text-sm tracking-widest text-white uppercase">Amenities</a>
        <a href="#privilege" class="font-['Cinzel'] text-sm tracking-widest text-white uppercase">Privileges</a>
        <a href="{{route('form')}}"  class="font-['Cinzel'] text-lg font-medium tracking-widest uppercase px-5 py-2.5 rounded-md border"
           style="color:blue;border-color:rgb(40,172,226);background-color:#F7F1E8;">Reserve a Share</a>
    </div>

    <!-- Right: lang orb + hamburger -->
    <div class="flex items-center gap-3">
        <div class="lang-orb" id="langToggle" onclick="toggleLang()">
            <span class="lang-label">EN</span>
            <div class="lang-ball"></div>
            <span class="lang-label">বাং</span>
        </div>
        <button id="menuBtn" class="lg:hidden flex flex-col justify-center gap-[5px] w-9 h-9 p-1" onclick="toggleMenu()" aria-label="Open menu">
            <span id="bar1" class="block w-full h-[1px] transition-all duration-300 origin-center" style="background:var(--gold)"></span>
            <span id="bar2" class="block w-full h-[1px] transition-all duration-300" style="background:var(--gold)"></span>
            <span id="bar3" class="block w-3/4 h-[1px] transition-all duration-300 origin-center" style="background:var(--gold)"></span>
        </button>
    </div>
</nav>

<!-- Mobile fullscreen drawer -->
<div id="mobileMenu" class="fixed inset-0 z-[9970] flex flex-col items-center justify-center gap-8 transition-all duration-500 pointer-events-none opacity-0"
     style="background:rgba(6,13,26,.97);backdrop-filter:blur(20px)">
    <a href="#story"     onclick="toggleMenu()" class="font-['Cinzel'] text-2xl tracking-[.3em] uppercase transition-colors" style="color:var(--cream)">Our Vision</a>
    <a href="#gallery"   onclick="toggleMenu()" class="font-['Cinzel'] text-2xl tracking-[.3em] uppercase transition-colors" style="color:var(--cream)">Gallery</a>
    <a href="#benefits"  onclick="toggleMenu()" class="font-['Cinzel'] text-2xl tracking-[.3em] uppercase transition-colors" style="color:var(--cream)">Ownership</a>
    <a href="#amenities" onclick="toggleMenu()" class="font-['Cinzel'] text-2xl tracking-[.3em] uppercase transition-colors" style="color:var(--cream)">Amenities</a>
    <a href="#privilege" onclick="toggleMenu()" class="font-['Cinzel'] text-2xl tracking-[.3em] uppercase transition-colors" style="color:var(--cream)">Privileges</a>
    <div class="mt-4"><a href="{{route('form')}}" class="btn-gold"><span data-en>Reserve a Share</span><span data-bn style="display:none">শেয়ার বুক করুন</span></a></div>
</div>

<!-- ===== HERO ===== -->
<section id="hero" class="min-h-screen relative overflow-hidden flex flex-col items-center justify-center text-center">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div id="particles" class="absolute inset-0 pointer-events-none"></div>

    <div class="relative z-10 px-6 sm:px-10 w-full max-w-4xl mx-auto">
        <p class="hero-eyebrow font-['Cinzel'] text-sm sm:text-lg font-semibold tracking-[.3em] sm:tracking-[.5em] text-black uppercase mb-6" data-en>Kuakata · Bay of Bengal · Bangladesh</p>
        <p class="hero-eyebrow font-['Cinzel'] text-sm sm:text-lg font-semibold tracking-[.3em] sm:tracking-[.5em] text-black uppercase mb-6" data-bn style="display:none">কুয়াকাটা · বঙ্গোপসাগর · বাংলাদেশ</p>

        <h1 class="hero-title font-['Cinzel'] font-normal leading-none text-white tracking-[.05em] mb-2" style="font-size:clamp(48px,10vw,120px)">
            HOTEL<br><span class="italic font-['Cormorant_Garamond']" style="color:var(--gold)">Jana</span>
        </h1>

        <p class="hero-subtitle font-['Cormorant_Garamond'] italic font-light mb-8 sm:mb-12 tracking-[.05em]" style="font-size:clamp(19px,2.9vw,29px);color:rgba(232,220,200,.75)" data-en>Where every wave brings a new possibility</p>
        <p class="hero-subtitle font-['Tiro_Bangla'] font-light mb-8 sm:mb-12" style="font-size:clamp(15px,2.5vw,26px);color:rgba(232,220,200,.75); display:none" data-bn>যেখানে প্রতিটি ঢেউ একটি নতুন সম্ভাবনা নিয়ে আসে</p>

        <div class="hero-cta flex flex-col sm:flex-row gap-4 sm:gap-5 justify-center items-center flex-wrap">
            <a href="{{route('form')}}" class="btn-gold w-full sm:w-auto text-center"><span data-en>Buy Your Share</span><span data-bn style="display:none">আপনার শেয়ার কিনুন</span></a>
            <a href="#story" class="btn-outline w-full sm:w-auto text-center" data-en>Discover the Vision</a>
            <a href="#story" class="btn-outline w-full sm:w-auto text-center" data-bn style="display:none">আমাদের স্বপ্ন জানুন</a>
        </div>
    </div>

    <div class="scroll-indicator absolute bottom-10 left-[49%] -translate-x-1/2 z-10 flex flex-col items-center gap-2">
        <div class="scroll-line"></div>
        <span class="font-['Cinzel'] text-[9px] tracking-[.3em] [writing-mode:vertical-rl]" style="color:rgba(40,172,226,.6)">SCROLL</span>
    </div>
</section>

<!-- ===== STORY ===== -->
<section id="story" class="min-h-screen relative overflow-hidden flex items-center py-20 lg:py-28">
    <div class="story-bg"></div>
    <div class="story-overlay"></div>
    <div class="sunrise-glow"></div>

    <div class="story-inner relative z-10 max-w-[1300px] mx-auto px-6 sm:px-10 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center py-16 lg:py-0">
        <div>
            <div class="flex items-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase before:block before:w-10 before:h-px reveal" style="color:var(--gold);--tw-content:''" data-en>The Genesis</div>
            <div class="flex items-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold); display:none" data-bn>আমাদের যাত্রা</div>

            <h2 class="font-['Cinzel'] font-normal leading-[1.15] mb-6 reveal" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>Let your leisure<br>unfold by the seaside...<em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">in your own hotel, with nature...</em></span>
                <span data-bn style="display:none">অবসর কাটুক সমুদ্রের পাড়ে...<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">নিজ হোটেলে, প্রকৃতির সাথে..</em></span>
            </h2>

            <div class="flex items-center gap-4 justify-center my-6 reveal">
                <div class="gold-divider-line"></div>
                <div class="gold-divider-diamond"></div>
                <div class="gold-divider-line right"></div>
            </div>

            <p class="font-['Cormorant_Garamond'] text-3xl font-light leading-[1.2] mb-5 reveal" style="color:rgba(255,250,250,.9)" data-en>Kuakata — one of earth's rarest gifts. A beach where the sun is born from the sea at dawn and surrenders to it at dusk. This is not a place; it is an experience of a lifetime. And at its heart, Hotel Jana rises — a 4-star monument to refinement, crafted by Alliance Builders Ltd. for those who seek the extraordinary.</p>
            <p class="font-['Tiro_Bangla'] text-[23px] font-light leading-[1.5] mb-5 reveal" style="color:rgba(255,250,250,.9); display:none" data-bn>কুয়াকাটা — পৃথিবীর বিরলতম উপহারগুলির একটি। একটি সৈকত যেখানে ভোরে সমুদ্র থেকে সূর্যের জন্ম হয় এবং সন্ধ্যায় সমুদ্রেই অস্ত যায়। এটি শুধু একটি জায়গা নয়, এটি জীবনের একটি অনুভূতি। আর সেখানেই উঠে দাঁড়াচ্ছে হোটেল জানা — একটি ৪ স্টার আবাসন।</p>

            <p class="font-['Cormorant_Garamond'] text-3xl font-light leading-[1.2] mb-5 reveal" style="color:rgba(255,250,250,.9)" data-en>This is not merely a hotel. It is a legacy. A stake in Hotel Jana is a stake in the future of luxury hospitality in Bangladesh — and an invitation to own a piece of paradise.</p>
            <p class="font-['Tiro_Bangla'] text-[23px] font-light leading-[1.5] mb-5 reveal" style="color:rgba(255,250,250,.9); display:none" data-bn>এটি শুধু একটি হোটেল নয়। এটি একটি উত্তরাধিকার। হোটেল জানায় একটি শেয়ার মানে বাংলাদেশের বিলাসবহুল আতিথেয়তার ভবিষ্যতে একটি অংশ।</p>

            <div class="flex gap-6 sm:gap-12 mt-12 reveal">
                <div><div class="font-['Cinzel'] text-5xl font-normal leading-none" style="color:var(--gold)">4★</div><div class="font-['Cormorant_Garamond'] text-sm tracking-[.1em] uppercase mt-1" style="color:rgba(232,220,200,.5)" data-en>International Standard</div><div class="font-['Tiro_Bangla'] text-sm mt-1" style="color:rgba(232,220,200,.5); display:none" data-bn>আন্তর্জাতিক মান</div></div>
                <div><div class="font-['Cinzel'] text-5xl font-normal leading-none" style="color:var(--gold)">264</div><div class="font-['Cormorant_Garamond'] text-sm tracking-[.1em] uppercase mt-1" style="color:rgba(232,220,200,.5)" data-en>Luxury Rooms</div><div class="font-['Tiro_Bangla'] text-sm mt-1" style="color:rgba(232,220,200,.5); display:none" data-bn>বিলাসবহুল কক্ষ</div></div>
                <div><div class="font-['Cinzel'] text-5xl font-normal leading-none" style="color:var(--gold)">12</div><div class="font-['Cormorant_Garamond'] text-sm tracking-[.1em] uppercase mt-1" style="color:rgba(232,220,200,.5)" data-en>Floor Tower</div><div class="font-['Tiro_Bangla'] text-sm mt-1" style="color:rgba(232,220,200,.5); display:none" data-bn>তলা ভবন</div></div>
            </div>
        </div>

        <div class="relative reveal-right hidden lg:block">
            <div class="absolute -top-4 -right-4 -bottom-4 -left-4 border-4 rounded-2xl z-[1] pointer-events-none" style="border-color:rgba(40,172,226,.15)"></div>
            <img class="w-full [aspect-ratio:3/4] object-cover relative z-[2] border rounded-2xl" style="border-color:rgba(40,172,226,.2)" src="{{ Vite::asset('resources/images/Hotel-Jana-resized.jpg.jpeg')}}" alt="Hotel Jana Exterior">
            <img class="absolute w-[55%] [aspect-ratio:1] bottom-[-40px] left-[-40px] object-cover z-[3] border-[3px] rounded-2xl shadow-[0_0_60px_rgba(0,0,0,0.8)]" style="border-color:var(--ocean-dark)" src="{{ Vite::asset('resources/images/Reception.jpeg') }}" alt="Hotel Jana Lobby">
        </div>
    </div>
</section>

<!-- ===== GALLERY ===== -->
<section id="gallery" class="min-h-screen relative overflow-hidden py-16 sm:py-20" style="background:#050A14">
    <div class="relative z-10 max-w-[1400px] mx-auto px-4 sm:px-8 lg:px-12">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold)" data-en>Visual Journey</div>
            <div class="flex items-center justify-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold); display:none" data-bn>দৃশ্যের যাত্রা</div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] text-center reveal" style="font-size:clamp(28px,4vw,55px);color:var(--cream)">
                <span data-en>"Breathe in the scent of the ocean and feel the vastness of the sky — in your own little retreat."<span class="italic text-xl text-[--gold]"><br>"Perhaps that is life's greatest treasure."</span></span>
                <span data-bn style="display:none">সমুদ্রের ঘ্রাণ নিয়ে আকাশের বিশালতাকে অনুভব করুন নিজ হোটেলে,<span class="italic text-xl text-[--gold]"><br>সেটাই হয়তো জীবনের সর্বশ্রেষ্ঠ পাওয়া।</span></span>
            </h2>
        </div>

        <div class="gallery-grid reveal" style="display:grid;grid-template-columns:2fr 1fr 1fr;grid-template-rows:auto auto;gap:3px;height:80vh;border-radius:16px;overflow:hidden">
            <div class="gallery-item relative overflow-hidden cursor-pointer" style="grid-row:1/3">
                <img src="{{ Vite::asset('resources/images/swimming-pool.jpeg') }}" alt="Hotel Facade">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>THE FACADE</div>
                <div class="gallery-item-label" data-bn style="display:none">বাইরের দৃশ্য</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="{{ Vite::asset('resources/images/Suite.jpeg') }}" alt="Luxury Suite">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>LUXURY SUITE</div>
                <div class="gallery-item-label" data-bn style="display:none">বিলাসবহুল সুইট</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="{{ Vite::asset('resources/images/Reception-2.jpeg') }}" alt="Grand Lobby">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>GRAND LOBBY</div>
                <div class="gallery-item-label" data-bn style="display:none">গ্র্যান্ড লবি</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="{{ Vite::asset('resources/images/swimming-pool-2.jpeg') }}" alt="Rooftop Pool">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>ROOFTOP POOL</div>
                <div class="gallery-item-label" data-bn style="display:none">ছাদের সুইমিং পুল</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="{{ Vite::asset('resources/images/cafeteria-5.jpg') }}" alt="Fine Dining">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>FINE DINING</div>
                <div class="gallery-item-label" data-bn style="display:none">ফাইন ডাইনিং</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== BENEFITS ===== -->
<section id="benefits" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-28" style="background:var(--ocean-mid)">
    <div class="benefits-bg"></div>
    <div class="relative z-10 max-w-[1300px] mx-auto px-4 sm:px-8 lg:px-12">
        <div class="text-center mb-20">
            <div class="inline-block px-6 py-2 mb-6 font-['Cinzel'] text-[10px] tracking-[.4em] uppercase border" style="background:linear-gradient(135deg,rgba(40,172,226,.15),rgba(40,172,226,.05));border-color:rgba(40,172,226,.3);color:var(--gold)" data-en>Ownership Benefits</div>
            <div class="inline-block px-6 py-2 mb-6 font-['Tiro_Bangla'] text-[10px] tracking-[.4em] uppercase border" style="background:linear-gradient(135deg,rgba(40,172,226,.15),rgba(40,172,226,.05));border-color:rgba(40,172,226,.3);color:var(--gold); display:none" data-bn>মালিকানার সুবিধা</div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] reveal" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>Twelve Reasons to Own<br>a Piece of <em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">Paradise</em></span>
                <span data-bn style="display:none">হোটেল জানার মালিকানার<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">১২টি সুবিধা</em></span>
            </h2>
            <p class="font-['Cormorant_Garamond'] text-xl font-light leading-[1.9] mt-4 mx-auto max-w-[600px] reveal" style="color:rgba(232,220,200,.7)" data-en>A share in Hotel Jana is not an expense. It is the most intelligent investment of your lifetime — yielding both financial returns and unparalleled experiences.</p>
            <p class="font-['Tiro_Bangla'] text-[17px] font-light leading-[1.9] mt-4 mx-auto max-w-[600px] reveal" style="color:rgba(232,220,200,.7); display:none" data-bn>হোটেল জানায় একটি শেয়ার কোনো ব্যয় নয়। এটি আপনার জীবনের সবচেয়ে বুদ্ধিমান বিনিয়োগ।</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2px]">
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">01</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">💰</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Discounted Acquisition</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>ছাড়ে মালিকানা ক্রয়</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Spot booking price of ৳3,00,000 against the listed share value of ৳5,00,000 — a 20% exclusive discount at launch.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>প্রতিটি শেয়ারের মূল্য ৳৫,০০,০০০ এর বিপরীতে স্পট বুকিং মূল্য মাত্র ৳৪,০০,০০০ — ২০% বিশেষ ছাড়।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">02</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">📈</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Annual Dividend Income</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>বার্ষিক আয়</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Earn approximately ৳60,000 per share annually — guaranteed, interest-free passive income.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>প্রতি বছর প্রতিটি শেয়ারে প্রায় ৬০ হাজার টাকা নিশ্চিত সুদ মুক্ত আয়ের সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">03</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🔄</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>10% Annual Return Guarantee</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>১০% মুনাফাসহ রিটার্ন</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>The company guarantees the buyback of your share at any time with 10% annual profit included.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>মালিকানা ক্রয়ের পর যেকোনো সময় বার্ষিক ১০% মুনাফাসহ টাকা ফেরত নেওয়ার সুবিধা।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">04</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">📜</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Land &amp; Building Registration</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>জমি ও বিল্ডিং সাব-কবলা</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Receive sub-kabala registration of 2 sq.ft. land and 17 sq.ft. building space — total 19 sq.ft. in your name.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>২ স্কয়ার ফিট জমি ও ১৭ স্কয়ার ফিট বিল্ডিং — মোট ১৯ স্কয়ার ফিট সাব-কবলা রেজিস্ট্রেশন পাবেন।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">05</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🏖️</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Complimentary Stay</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>বিনামূল্যে থাকার সুযোগ</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Enjoy 3 days and 2 nights complimentary accommodation per year, plus family discounts throughout the year.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>বছরে তিন দিন দুই রাত বিনামূল্যে থাকার সুযোগ এবং পরিবারের জন্য সারা বছর বিশেষ ছাড়।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">06</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">💳</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Exclusive Reward Card</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>রিওয়ার্ড কার্ড</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>A personal Reward Card granting special discounts across all hotel services, dining, and spa.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>রিওয়ার্ড কার্ডে সকল সার্ভিসে বিশেষ ছাড় পাবেন।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">07</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🚀</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Asset Appreciation</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>সম্পদের মূল্যবৃদ্ধি</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Hotel shares appreciate 5 to 6 times faster than conventional real estate — a superior wealth creation vehicle.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>অন্যান্য সম্পদের তুলনায় ৫/৬ গুণ বেশি মূল্যবৃদ্ধির সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">08</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🏛️</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Board Directorship</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>বোর্ড অব ডিরেক্টর</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Acquire 50 or more shares and earn a prestigious seat on the Board of Directors of Hotel Jana.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>৫০টি শেয়ার ক্রয়ের মাধ্যমে বোর্ড অব ডিরেক্টরের সদস্য হওয়ার সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">09</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🏗️</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Flexible Payment</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>কিস্তি সুবিধা</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Convenient monthly instalment options available for hotel share acquisition.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>হোটেলে মালিকানা ক্রয়ে মাসিক দীর্ঘমেয়াদি কিস্তির সুবিধা।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">10</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">👑</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Social Prestige</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>সামাজিক মর্যাদা</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Elevate your social standing. Hotel Jana ownership is a symbol of achievement and a prestigious lifestyle.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>সামাজিক মর্যাদাসহ প্রেস্টিজিয়াস লাইফ উপভোগ করুন।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">11</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🤝</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Market Resale Rights</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>পুনরায় বিক্রয়ের সুযোগ</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Sell your share back to the company at market value — complete liquidity at your discretion.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>বাজার মূল্যে কোম্পানির কাছে পুনরায় মালিকানা বিক্রয়ের সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-12 sm:p-14 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(200,230,255,0.70);border-color:rgba(7,115,187,0.3)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[30px] mb-4" style="color:rgba(7,115,187,0.9)">12</div>
                <span class="text-[38px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🌿</span>
                <div class="font-['Cinzel'] text-3xl tracking-[.1em] font-medium mb-3" style="color:#020079" data-en>Hereditary Transfer</div>
                <div class="font-['Tiro_Bangla'] text-[40px] font-medium mb-3" style="color:#020079; display:none" data-bn>বংশপরম্পরায় মালিকানা</div>
                <div class="font-['Cormorant_Garamond'] text-[25px] font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75)" data-en>Your ownership is transferable through generations — a true family legacy, built in paradise.</div>
                <div class="font-['Tiro_Bangla'] text-2xl font-medium leading-[1.2]" style="color:rgba(10,30,60,0.75); display:none" data-bn>বংশ পরম্পরায় মালিকানা পরিবর্তনের সুবিধা — একটি সত্যিকারের পারিবারিক উত্তরাধিকার।</div>
            </div>
        </div>

        <div id="benefitsDots" aria-label="Benefits scroll indicator"></div>
        <div class="text-center mt-16 reveal">
            <a href="{{route('form')}}" class="btn-gold w-full sm:w-auto text-center"><span data-en>Buy Your Share Now</span><span data-bn style="display:none">এখনি আপনার শেয়ার কিনুন</span></a>
        </div>
    </div>
</section>

<script>
    (function () {
        function initBenefitsDots() {
            var grid = document.querySelector('#benefits .grid');
            var dotsWrap = document.getElementById('benefitsDots');
            if (!grid || !dotsWrap) return;

            var cards = grid.querySelectorAll('.benefit-card');
            var total = cards.length;
            dotsWrap.innerHTML = '';

            /* Create one dot per card */
            var dots = [];
            for (var i = 0; i < total; i++) {
                var dot = document.createElement('span');
                if (i === 0) dot.classList.add('active');
                dot.setAttribute('data-i', i);
                dot.addEventListener('click', (function(idx) {
                    return function() { scrollToCard(idx); };
                })(i));
                dotsWrap.appendChild(dot);
                dots.push(dot);
            }

            function scrollToCard(idx) {
                var card = cards[idx];
                if (!card) return;
                grid.scrollTo({ left: card.offsetLeft - (grid.offsetWidth - card.offsetWidth) / 2, behavior: 'smooth' });
            }

            /* Update active dot on scroll */
            grid.addEventListener('scroll', function () {
                var center = grid.scrollLeft + grid.offsetWidth / 2;
                var closest = 0, minDist = Infinity;
                cards.forEach(function (c, i) {
                    var dist = Math.abs((c.offsetLeft + c.offsetWidth / 2) - center);
                    if (dist < minDist) { minDist = dist; closest = i; }
                });
                dots.forEach(function (d, i) {
                    d.classList.toggle('active', i === closest);
                });
            }, { passive: true });
        }

        if (document.readyState === 'complete') { initBenefitsDots(); }
        else { window.addEventListener('load', initBenefitsDots); }

        /* Re-init on resize crossing the 640px boundary */
        var wasMobile = window.innerWidth < 640;
        window.addEventListener('resize', function () {
            var isMobile = window.innerWidth < 640;
            if (isMobile !== wasMobile) { wasMobile = isMobile; initBenefitsDots(); }
        });
    })();
</script>

<!-- ===== AMENITIES ===== -->
<section id="amenities" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-28" style="background:var(--ocean-mid)">
    <div class="amenities-bg"></div>
    <div class="relative z-10 max-w-[1300px] mx-auto px-4 sm:px-8 lg:px-12">
        <div class="text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold)" data-en>World-Class Facilities</div>
            <div class="flex items-center justify-center gap-4 mb-5 font-['Tiro_Bangla'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold); display:none" data-bn>বিশ্বমানের সুবিধা সমূহ</div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] text-center reveal" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>Every Desire. Every Detail.<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">Delivered.</em></span>
                <span data-bn style="display:none">প্রতিটি ইচ্ছা। প্রতিটি বিস্তারিত।<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">পরিপূর্ণ।</em></span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[3px]">
            <!-- amenity items with improved visibility -->
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] z-auto hover:z-[1] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="amenity-icon text-[64px] transition-transform duration-300 hover:scale-[1.2]">🛏️</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>264 Rooms</div><div class="font-['Tiro_Bangla'] text-[32px] leading-[1.4] font-medium" style="color:#0a1a2a; display:none" data-bn>২৬৪ টি রুম</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🍹</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Juice Bar</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>জুস বার</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">💆</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Jacuzzi</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>জেড স্পা</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🏊</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Rooftop Pool</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>রুফটপ সুইমিং পুল</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🍽️</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Lounge</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>লঞ্জ</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🐴</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Horse Riding</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>হর্স রাইডিং</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🚁</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Helipad</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>হেলিপ্যাড</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">📋</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Meeting Rooms</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>মিটিং রুম</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🎡</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Kids Play Zone</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>চিলড্রেন প্লে জোন</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🎭</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Hall Room</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>হল রুম</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">☀️</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Sun Bath</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>সান বাথ</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🍖</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>BBQ Corner</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>বার বি কিউ</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🎬</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Cinema</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>সিনেপ্লেক্স</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🚐</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Transport</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>ট্রান্সপোর্ট</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🍴</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Restaurant</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>রেস্তুরেন্ট</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">💅</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Spa</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>স্পা</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(255, 248, 235, 0.52);border-color:rgba(212, 175, 55, 0.3);box-shadow:0 2px 8px rgba(0,0,0,0.05);"><span class="text-[64px]">🏄</span><div class="font-['Cinzel'] text-[28px] tracking-[.15em] uppercase leading-[1.3] font-semibold" style="color:#0a1a2a;" data-en>Beach Games</div><div class="font-['Tiro_Bangla'] text-[32px] font-medium" style="color:#0a1a2a; display:none" data-bn>বিচ গেমস</div></div>
        </div>

        <p class="text-center mt-10 font-['Cormorant_Garamond'] text-lg italic reveal" style="color:rgba(232,220,200,.45)" data-en>And countless more luxuries to be unveiled. Hotel Jana hands over in December 2030.</p>
        <p class="text-center mt-10 font-['Tiro_Bangla'] text-[15px] reveal" style="color:rgba(232,220,200,.45); display:none" data-bn>ইত্যাদি সহ আরও অনেক কিছু। হোটেলটি হস্তান্তর হবে ডিসেম্বর ২০৩০ সালে।</p>
    </div>
</section>

<!-- ===== PRIVILEGE ===== -->
<section id="privilege" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-28">
    <div class="privilege-bg"></div>
    <div class="relative z-10 max-w-[1300px] mx-auto px-4 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">

        <!-- CARD STACK WRAPPER -->
        <div class="reveal-left mx-auto w-full" style="max-width:520px;">

            <!-- Animated click indicator -->
            <div id="privClickHint" style="display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:16px;">
                <!-- Animated hand pointer -->
                <div style="position:relative;width:32px;height:32px;flex-shrink:0;">
                    <svg id="hintHand" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:32px;height:32px;animation:hintBounce 1.4s ease-in-out infinite;">
                        <path d="M10 18V9a2 2 0 0 1 4 0v5" stroke="rgba(40,172,226,0.9)" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M14 14V8a2 2 0 0 1 4 0v6" stroke="rgba(40,172,226,0.9)" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M18 14V9a2 2 0 0 1 4 0v7" stroke="rgba(40,172,226,0.9)" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M10 18c0 0-2-1-2 2v2c0 4 3 7 8 7s8-3 8-7v-6a2 2 0 0 0-4 0" stroke="rgba(40,172,226,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <!-- Ripple rings on the hand -->
                    <div style="position:absolute;inset:-4px;border-radius:50%;border:1px solid rgba(40,172,226,0.5);animation:hintRipple 1.4s ease-out infinite;"></div>
                    <div style="position:absolute;inset:-4px;border-radius:50%;border:1px solid rgba(40,172,226,0.3);animation:hintRipple 1.4s ease-out 0.5s infinite;"></div>
                </div>

                <!-- Swap arrows -->
                <div style="display:flex;flex-direction:column;gap:3px;align-items:center;">
                    <svg viewBox="0 0 48 12" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:48px;height:12px;animation:hintArrowSlide 1.4s ease-in-out infinite;">
                        <path d="M2 6h40M36 2l6 4-6 4" stroke="rgba(40,172,226,0.85)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg viewBox="0 0 48 12" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:48px;height:12px;animation:hintArrowSlide 1.4s ease-in-out 0.7s infinite;">
                        <path d="M46 6H6M12 2L6 6l6 4" stroke="rgba(40,172,226,0.6)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <!-- Label -->
                <div class="privilege-click-hint">
                    <span class="font-['Cinzel']" style="color:rgba(40,172,226,0.85);font-size:clamp(8px,1.5vw,10px);letter-spacing:.25em;text-transform:uppercase;display:block;" data-en>Click to flip</span>
                    <span class="font-['Tiro_Bangla']" style="color:rgba(40,172,226,0.85);font-size:clamp(8px,1.5vw,11px);display:none;" data-bn>ক্লিক করুন</span>
                    <!-- Blinking dots -->
                    <div style="display:flex;gap:4px;margin-top:4px;justify-content:center;">
                        <div style="width:4px;height:4px;border-radius:50%;background:rgba(40,172,226,0.8);animation:hintDot 1.4s ease-in-out infinite;"></div>
                        <div style="width:4px;height:4px;border-radius:50%;background:rgba(40,172,226,0.8);animation:hintDot 1.4s ease-in-out 0.2s infinite;"></div>
                        <div style="width:4px;height:4px;border-radius:50%;background:rgba(40,172,226,0.8);animation:hintDot 1.4s ease-in-out 0.4s infinite;"></div>
                    </div>
                </div>
            </div>

            <!-- Card stack -->
            <div id="privStack" style="position:relative;width:100%;aspect-ratio:420/345;cursor:pointer;" onclick="swapPrivCards()">

                <!-- BACK CARD (Terms — starts behind) -->
                <div id="privCardBack" class="priv-card" style="
    position:absolute;
    width:80%; aspect-ratio:420/265;
    top:22%; right:0; left:auto;
    z-index:1;
    filter:brightness(.82);
    background:linear-gradient(135deg,#8a6a1a 0%,#d4af37 35%,#f5e6a3 55%,#d4af37 75%,#8a6a1a 100%);
    box-shadow:0 20px 60px rgba(0,0,0,.5),0 0 40px rgba(40,172,226,.15);
    border-radius:12px;
    overflow:hidden;
    transition:transform 0.08s ease, filter 0.4s ease, box-shadow 0.4s ease;
    animation:cardPeekBob 3s ease-in-out infinite;
">
                    <div class="privilege-card-shine"></div>
                    <!-- Inner scaler — fills card, uses vw-like unit via --cw -->
                    <div id="backInner" style="
        position:absolute; inset:0;
        padding: calc(var(--cw,1px)*0.058) calc(var(--cw,1px)*0.072);
        display:flex; flex-direction:column; justify-content:space-between;
        box-sizing:border-box;
    ">
                        <div class="font-['Cinzel'] font-bold tracking-[.15em] uppercase"
                             style="color:rgba(10,15,30,.85);font-size:calc(var(--cw,1px)*0.026);margin-bottom:calc(var(--cw,1px)*0.012);">
                            Terms &amp; Conditions
                        </div>

                        <ul style="flex:1;list-style:none;padding:0;margin:0;display:flex;flex-direction:column;justify-content:flex-start;gap:calc(var(--cw,1px)*0.008);">
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);" data-en>✦ 25% Discount — On Published Room Tariff</li>
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);" data-en>✦ 25% Discount — Restaurant Dining &amp; Packed Orders <em style="opacity:0.72;">(on the bill Excluding Taxes)</em></li>
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);" data-en>✦ 15% Discount — Ayurvedic Spa Treatments</li>
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);" data-en>✦ 10% Discount — In-room Dining Service</li>
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.85);font-size:calc(var(--cw,1px)*0.026);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);" data-en>✦ Conditions Apply</li>
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.78);font-size:calc(var(--cw,1px)*0.024);line-height:1.3;padding:calc(var(--cw,1px)*0.006) 0;font-style:italic;" data-en>The card does not entitle any privilege in banqueting, conferences, special events &amp; promotions. Blackout dates &amp; house rules apply.</li>
                            <li class="font-['Cormorant_Garamond'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);display:none" data-bn>✦ রুম ট্যারিফে ২৫% ছাড়</li>
                            <li class="font-['Tiro_Bangla'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);display:none" data-bn>✦ রেস্তুরেন্ট ও প্যাকড অর্ডারে ২৫% ছাড়</li>
                            <li class="font-['Tiro_Bangla'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);display:none" data-bn>✦ আয়ুর্বেদিক স্পায় ১৫% ছাড়</li>
                            <li class="font-['Tiro_Bangla'] font-semibold" style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.028);line-height:1.25;padding:calc(var(--cw,1px)*0.004) 0;border-bottom:0.5px solid rgba(10,15,30,.15);display:none" data-bn>✦ ইন-রুম ডাইনিংয়ে ১০% ছাড়</li>
                            <li class="font-['Tiro_Bangla'] font-semibold" style="color:rgba(5,15,35,.78);font-size:calc(var(--cw,1px)*0.024);line-height:1.3;padding:calc(var(--cw,1px)*0.006) 0;display:none;font-style:italic;" data-bn>ব্যাংকোয়েটিং, কনফারেন্স, বিশেষ ইভেন্টে প্রযোজ্য নয়।</li>
                        </ul>

                        <div style="background:rgba(10,5,0,.22);border-radius:3px;padding:calc(var(--cw,1px)*0.008) calc(var(--cw,1px)*0.012);display:flex;flex-wrap:nowrap;gap:calc(var(--cw,1px)*0.008);align-items:center;justify-content:center;white-space:nowrap;margin-top:calc(var(--cw,1px)*0.008);overflow:hidden;">
                            <span class="font-['Cinzel'] font-semibold" style="color:rgba(5,15,35,.95);font-size:calc(var(--cw,1px)*0.019);">+88 01896 204401</span>
                            <span style="color:rgba(10,15,30,.5);">·</span>
                            <span class="font-['Cinzel'] font-semibold" style="color:rgba(5,15,35,.95);font-size:calc(var(--cw,1px)*0.019);">asad@alliancebuildersltd.org</span>
                            <span style="color:rgba(10,15,30,.5);">·</span>
                            <span class="font-['Cinzel'] font-semibold" style="color:rgba(5,15,35,.95);font-size:calc(var(--cw,1px)*0.019);">alliancebuilders.org</span>
                        </div>
                    </div>
                </div>

                <!-- FRONT CARD (Privilege — starts on top) -->
                <div id="privCardFront" class="priv-card" style="
    position:absolute;
    width:80%; aspect-ratio:420/265;
    top:0; left:0;
    z-index:2;
    background:linear-gradient(135deg,#8a6a1a 0%,#d4af37 35%,#f5e6a3 55%,#d4af37 75%,#8a6a1a 100%);
    box-shadow:0 20px 60px rgba(0,0,0,.55),0 0 40px rgba(40,172,226,.15);
    border-radius:12px;
    overflow:hidden;
    transition:transform 0.08s ease, filter 0.4s ease, box-shadow 0.4s ease;
    animation:cardFrontNudge 3s ease-in-out infinite;
">
                    <div class="privilege-card-shine"></div>
                    <div id="frontInner" style="
        position:absolute; inset:0;
        padding: calc(var(--cw,1px)*0.068) calc(var(--cw,1px)*0.076);
        display:flex; flex-direction:column; justify-content:space-between;
        box-sizing:border-box;
    ">
                        <!-- Header row -->
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                            <div>
                                <div class="font-['Cinzel'] font-bold tracking-[.22em]"
                                     style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.054);line-height:1;">
                                    HOTEL JANA
                                </div>
                                <div class="font-['Cormorant_Garamond'] italic"
                                     style="color:rgb(5,15,35);font-size:calc(var(--cw,1px)*0.044);letter-spacing:.1em;margin-top:calc(var(--cw,1px)*0.01);">
                                    Privilege Card
                                </div>
                            </div>
                            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:calc(var(--cw,1px)*0.01);">
                                <div class="font-['Cinzel'] font-semibold tracking-[.22em]"
                                     style="color:rgba(5,15,35,.85);font-size:calc(var(--cw,1px)*0.024);">
                                    GOLD
                                </div>
                                <!-- Chip -->
                                <div style="width:calc(var(--cw,1px)*0.082);height:calc(var(--cw,1px)*0.056);background:linear-gradient(135deg,rgba(255,255,255,.55),rgba(200,160,30,.45));border-radius:3px;border:0.5px solid rgba(10,15,30,.22);display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:1fr 1fr 1fr;gap:1px;padding:2px;">
                                    <div style="background:rgba(10,15,30,.08);border-radius:1px;"></div><div style="background:rgba(10,15,30,.08);border-radius:1px;"></div><div style="background:rgba(10,15,30,.08);border-radius:1px;"></div>
                                    <div style="background:rgba(10,15,30,.08);border-radius:1px;"></div><div style="background:rgba(10,15,30,.18);border-radius:1px;"></div><div style="background:rgba(10,15,30,.08);border-radius:1px;"></div>
                                    <div style="background:rgba(10,15,30,.08);border-radius:1px;"></div><div style="background:rgba(10,15,30,.08);border-radius:1px;"></div><div style="background:rgba(10,15,30,.08);border-radius:1px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Wave bar -->
                        <div class="priv-wave-bar"
                             style="background:linear-gradient(90deg,rgba(255,255,255,.08),rgba(255,255,255,.32),rgba(255,255,255,.08));height:calc(var(--cw,1px)*0.066);border-radius:2px;margin:calc(var(--cw,1px)*0.01) 0;">
                        </div>

                        <!-- Footer row -->
                        <div style="display:flex;justify-content:space-between;align-items:flex-end;">
                            <div>
                                <div class="font-['Cinzel'] font-semibold"
                                     style="color:rgba(5,15,35,.75);font-size:calc(var(--cw,1px)*0.024);letter-spacing:.15em;text-transform:uppercase;margin-bottom:calc(var(--cw,1px)*0.008);">
                                    Card Holder
                                </div>
                                <div class="font-['Cinzel'] font-semibold tracking-[.1em]"
                                     style="color:rgba(5,15,35,.92);font-size:calc(var(--cw,1px)*0.042);">
                                    Mr. Farhad
                                </div>
                                <div class="font-mono tracking-[.2em] font-semibold"
                                     style="color:rgba(5,15,35,.85);font-size:calc(var(--cw,1px)*0.028);margin-top:calc(var(--cw,1px)*0.008);">
                                    2024 0089 6654 0321
                                </div>
                            </div>
                            <div class="font-['Cinzel'] font-bold tracking-[.2em]"
                                 style="color:rgba(5,15,35,.7);font-size:calc(var(--cw,1px)*0.038);line-height:1;">
                                JANA
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /privStack -->
        </div>

        <script>
            (function() {
                function updateCardWidth() {
                    const front = document.getElementById('privCardFront');
                    if (!front) return;
                    const w = front.getBoundingClientRect().width;
                    // Set --cw on both cards and their inner wrappers
                    ['privCardFront','privCardBack','frontInner','backInner'].forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.style.setProperty('--cw', w + 'px');
                    });
                }

                // Run on load
                document.addEventListener('DOMContentLoaded', updateCardWidth);
                window.addEventListener('load', updateCardWidth);

                // Run on resize
                window.addEventListener('resize', updateCardWidth);

                // ResizeObserver for the stack itself (handles container resize too)
                const stack = document.getElementById('privStack');
                if (stack && window.ResizeObserver) {
                    new ResizeObserver(updateCardWidth).observe(stack);
                }
            })();
        </script>

        <!-- RIGHT TEXT CONTENT -->
        <div class="reveal-right p-8 rounded-xl" style="backdrop-filter: blur(15px)" >
            <div class="flex items-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase" style="color:var(--gold)" data-en>The Privilege Card</div>
            <div class="flex items-center gap-4 mb-5 font-['Tiro_Bangla'] text-[10px] tracking-[.5em] uppercase" style="color:var(--gold); display:none" data-bn>প্রিভিলেজ কার্ড</div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] mb-6" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>Your Key to a Life of<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">Unlimited Privilege</em></span>
                <span data-bn style="display:none">সীমাহীন সুবিধার<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">জীবনের চাবিকাঠি</em></span>
            </h2>
            <div class="my-7 pl-7 py-6 font-['Cormorant_Garamond'] text-[22px] italic leading-[1.6]" style="background:rgba(40,172,226,.06);border-left:2px solid var(--gold);color:rgba(232,220,200,.8)" data-en>"Every share you own opens a door to privileges that money alone cannot buy — a life lived at the pinnacle."</div>
            <div class="my-7 pl-7 py-6 font-['Tiro_Bangla'] text-[16px] leading-[1.6]" style="background:rgba(40,172,226,.06);border-left:2px solid var(--gold);color:rgba(232,220,200,.8); display:none" data-bn>"আপনার প্রতিটি শেয়ার এমন সুবিধার দরজা খুলে দেয় যা শুধু অর্থ দিয়ে কেনা যায় না।"</div>
            <p class="font-['Cormorant_Garamond'] text-xl font-light leading-[1.9]" style="color:rgba(232,220,200,.7)" data-en>As a Hotel Jana shareholder, you receive a personal Privilege Card — your golden key to a world of curated luxury, reserved only for those who have claimed their place among the elite.</p>
            <p class="font-['Tiro_Bangla'] text-[17px] font-light leading-[1.9]" style="color:rgba(232,220,200,.7); display:none" data-bn>হোটেল জানার শেয়ারহোল্ডার হিসেবে আপনি পাবেন একটি ব্যক্তিগত প্রিভিলেজ কার্ড।</p>
            <div class="mt-9">
                <a href="{{route('form')}}" class="btn-gold w-full sm:w-auto text-center"><span data-en>Buy Your Share Now</span><span data-bn style="display:none">আপনার শেয়ার কিনুন</span></a>
            </div>
        </div>
    </div>
</section>

<style>
    /* ── Idle bob animations (suggest interactivity) ── */
    @keyframes cardFrontNudge {
        0%,100% { transform: translate(0,0) rotate(0deg); }
        30%      { transform: translate(-3px,-4px) rotate(-0.8deg); }
        60%      { transform: translate(2px,-2px) rotate(0.5deg); }
    }
    @keyframes cardPeekBob {
        0%,100% { transform: translate(0,0) rotate(0deg); }
        30%      { transform: translate(4px,3px) rotate(0.6deg); }
        60%      { transform: translate(-2px,2px) rotate(-0.4deg); }
    }

    /* ── Hint animations ── */
    @keyframes hintBounce {
        0%,100% { transform: translateY(0) rotate(-10deg); }
        40%      { transform: translateY(-6px) rotate(-10deg); }
        60%      { transform: translateY(-4px) rotate(-10deg); }
    }
    @keyframes hintRipple {
        0%   { transform: scale(0.6); opacity: 0.8; }
        100% { transform: scale(1.8); opacity: 0; }
    }
    @keyframes hintArrowSlide {
        0%,100% { opacity: 0.4; transform: translateX(0); }
        50%      { opacity: 1;   transform: translateX(4px); }
    }
    @keyframes hintDot {
        0%,100% { transform: scale(0.6); opacity: 0.3; }
        50%      { transform: scale(1.2); opacity: 1; }
    }

    /* ── Press effect ── */
    #privStack:active #privCardFront,
    #privStack:active #privCardBack { transform: scale(0.97); }

    /* ── Swap animation classes ── */
    .priv-swap-out-front {
        animation: swapOutFront 0.55s cubic-bezier(0.4,0,0.2,1) forwards !important;
    }
    .priv-swap-in-front {
        animation: swapInFront 0.55s cubic-bezier(0.4,0,0.2,1) forwards !important;
    }
    .priv-swap-out-back {
        animation: swapOutBack 0.55s cubic-bezier(0.4,0,0.2,1) forwards !important;
    }
    .priv-swap-in-back {
        animation: swapInBack 0.55s cubic-bezier(0.4,0,0.2,1) forwards !important;
    }

    /* Front card sweeps up-left and shrinks behind */
    @keyframes swapOutFront {
        0%   { transform: translate(0,0) scale(1) rotate(0deg); opacity:1; z-index:2; filter:brightness(1); }
        40%  { transform: translate(30px,-30px) scale(0.95) rotate(3deg); opacity:0.85; }
        100% { transform: translate(20%,22%) scale(0.88) rotate(1deg); opacity:1; filter:brightness(0.82); }
    }
    /* Back card comes forward */
    @keyframes swapInFront {
        0%   { transform: translate(20%,22%) scale(0.88) rotate(1deg); filter:brightness(0.82); }
        40%  { transform: translate(-15px,-10px) scale(1.03) rotate(-1.5deg); filter:brightness(1.05); }
        100% { transform: translate(0,0) scale(1) rotate(0deg); filter:brightness(1); }
    }
    /* Old front fades back into back position */
    @keyframes swapOutBack {
        0%   { transform: translate(0,0) scale(1); opacity:1; filter:brightness(1); }
        100% { transform: translate(20%,22%) scale(0.88); opacity:1; filter:brightness(0.82); }
    }
    /* New back settles from front position */
    @keyframes swapInBack {
        0%   { transform: translate(0,0) scale(1); filter:brightness(1); }
        100% { transform: translate(20%,22%) scale(0.88); filter:brightness(0.82); }
    }

    @media (max-width: 1024px) {
        #privStack { aspect-ratio: 420/345; }
    }
</style>

<script>
    (function() {
        var isAnimating = false;
        var frontIsPriv = true; /* tracks which card is in front */

        window.swapPrivCards = function() {
            /* Disable flip on mobile where cards are stacked */
            var backCard = document.getElementById('privCardBack');
            if (backCard && window.getComputedStyle(backCard).position === 'relative') {
                return; /* Cards are stacked, no flip needed */
            }
            if (isAnimating) return;
            isAnimating = true;

            var front = document.getElementById('privCardFront');
            var back  = document.getElementById('privCardBack');

            /* Pause idle bobs during swap */
            front.style.animation = 'none';
            back.style.animation  = 'none';

            /* The card currently on top flies back */
            front.style.zIndex = '3';
            back.style.zIndex  = '2';

            front.classList.add('priv-swap-out-front');
            back.classList.add('priv-swap-in-front');

            setTimeout(function() {
                /* Swap DOM IDs so logic stays consistent */
                front.id = 'privCardBack';
                back.id  = 'privCardFront';

                /* Reset class lists */
                front.classList.remove('priv-swap-out-front');
                back.classList.remove('priv-swap-in-front');

                /* Apply final resting styles via inline — remove conflicting animation */
                front.style.top    = '22%';
                front.style.left   = 'auto';
                front.style.right  = '0';
                front.style.zIndex = '1';
                front.style.filter = 'brightness(0.82)';
                front.style.transform = '';

                back.style.top    = '0';
                back.style.left   = '0';
                back.style.right  = 'auto';
                back.style.zIndex = '2';
                back.style.filter = '';
                back.style.transform = '';

                /* Resume idle bobs with new roles */
                back.style.animation  = 'cardFrontNudge 3s ease-in-out infinite';
                front.style.animation = 'cardPeekBob 3s ease-in-out infinite';

                frontIsPriv = !frontIsPriv;
                isAnimating = false;
            }, 560);
        };
    })();
</script>
<!-- ===== INVEST CTA ===== -->
<!-- ===== INVEST CTA ===== -->
<section id="invest" class="min-h-screen relative overflow-hidden flex items-center justify-center text-center">
    <div class="invest-bg"></div>

    <!-- Stronger overlay: dark vignette + solid dark band behind content -->
    <div class="invest-overlay"></div>
    <!-- Extra solid panel behind the text content for maximum legibility -->
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,
        rgba(6,13,26,0.55) 0%,
        rgba(6,13,26,0.82) 30%,
        rgba(6,13,26,0.88) 55%,
        rgba(6,13,26,0.82) 80%,
        rgba(6,13,26,0.55) 100%);
        pointer-events:none;z-index:1;">
    </div>

    <div class="relative z-10 px-4 sm:px-10 lg:px-12 py-16 sm:py-20 w-full max-w-4xl mx-auto">

        <!-- Divider -->
        <div class="flex items-center justify-center gap-4 mb-10 reveal">
            <div class="gold-divider-line"></div>
            <div class="gold-divider-diamond"></div>
            <div class="gold-divider-line right"></div>
        </div>

        <!-- Quote — larger, heavier, high-contrast -->
        <p class="font-['Cormorant_Garamond'] italic leading-[1.4] mx-auto mb-4 reveal"
           style="font-size:clamp(24px,4.5vw,54px);color:#F7F1E8;max-width:820px;font-weight:500;text-shadow:0 2px 16px rgba(0,0,0,0.7);"
           data-en>"The sun rises from the sea here —<br>and so does your fortune."</p>
        <p class="font-['Tiro_Bangla'] leading-[1.6] mx-auto mb-4 reveal"
           style="font-size:clamp(18px,3.2vw,38px);color:#F7F1E8;max-width:820px;font-weight:400;text-shadow:0 2px 16px rgba(0,0,0,0.7);display:none;"
           data-bn>"এখানে সূর্য সমুদ্র থেকে উদয় হয় —<br>আর তেমনিভাবে উদয় হয় আপনার ভাগ্যও।"</p>

        <!-- Divider line -->
        <div class="flex items-center justify-center gap-3 my-8 reveal">
            <div style="height:1px;width:60px;background:linear-gradient(to right,transparent,rgba(40,172,226,0.6));"></div>
            <div style="width:5px;height:5px;background:rgba(40,172,226,0.8);transform:rotate(45deg);"></div>
            <div style="height:1px;width:60px;background:linear-gradient(to left,transparent,rgba(40,172,226,0.6));"></div>
        </div>

        <!-- Price block — contained card for strong contrast -->
        <div class="reveal mx-auto" style="
            max-width:480px;
            background:rgba(6,13,26,0.75);
            border:1px solid rgba(40,172,226,0.35);
            border-radius:20px;
            padding:clamp(20px,4vw,36px) clamp(24px,5vw,48px);
            backdrop-filter:blur(12px);
            margin-bottom:28px;
            box-shadow:0 8px 48px rgba(0,0,0,0.5),0 0 0 1px rgba(40,172,226,0.08);
        ">
            <!-- Label -->
            <div class="font-['Cinzel'] uppercase tracking-[.35em] mb-4"
                 style="font-size:clamp(9px,1.8vw,11px);color:rgba(40,172,226,0.9);letter-spacing:.35em;" data-en>
                Price Per Share
            </div>
            <div class="font-['Cinzel'] uppercase tracking-[.35em] mb-4"
                 style="font-size:clamp(9px,1.8vw,11px);color:rgba(40,172,226,0.9);letter-spacing:.35em;display:none;" data-bn>
                প্রতি শেয়ারের মূল্য
            </div>

            <!-- Prices row -->
            <div class="flex items-center justify-center gap-4 flex-wrap mb-4">
                <!-- Strikethrough old price — readable now -->
                <div style="text-align:center;">
                    <div class="font-['Cinzel']"
                         style="font-size:clamp(14px,2.8vw,20px);color:rgba(232,220,200,0.55);text-decoration:line-through;text-decoration-color:rgba(232,220,200,0.4);">
                        ৳ 5,00,000
                    </div>
                    <div class="font-['Cormorant_Garamond'] italic"
                         style="font-size:clamp(10px,1.8vw,13px);color:rgba(232,220,200,0.45);margin-top:2px;" data-en>
                        Listed Value
                    </div>
                    <div class="font-['Tiro_Bangla']"
                         style="font-size:clamp(10px,1.8vw,13px);color:rgba(232,220,200,0.45);margin-top:2px;display:none;" data-bn>
                        তালিকাভুক্ত মূল্য
                    </div>
                </div>

                <!-- Arrow -->
                <div style="font-size:clamp(18px,3vw,26px);color:rgba(40,172,226,0.6);">→</div>

                <!-- Current price — bold and bright -->
                <div style="text-align:center;">
                    <div class="font-['Cinzel']"
                         style="font-size:clamp(32px,7vw,64px);color:#28ace2;line-height:1;font-weight:600;text-shadow:0 0 32px rgba(40,172,226,0.35);">
                        ৳ 3,00,000
                    </div>
                    <div class="font-['Cormorant_Garamond'] italic"
                         style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.65);margin-top:4px;" data-en>
                        Spot Booking Price
                    </div>
                    <div class="font-['Tiro_Bangla']"
                         style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.65);margin-top:4px;display:none;" data-bn>
                        স্পট বুকিং মূল্য
                    </div>
                </div>
            </div>

            <!-- Savings badge — visible and clear -->
            <div style="
                display:inline-block;
                background:linear-gradient(135deg,#0773bb,#28ace2);
                color:#F7F1E8;
                border-radius:8px;
                padding:8px 20px;
                margin-top:4px;
            ">
                <span class="font-['Cinzel']"
                      style="font-size:clamp(10px,2vw,13px);letter-spacing:.25em;font-weight:600;" data-en>
                    ✦ SAVE ৳ 2,00,000 — 40% OFF ✦
                </span>
                <span class="font-['Tiro_Bangla']"
                      style="font-size:clamp(10px,2vw,13px);display:none;" data-bn>
                    ✦ ৳ ২,০০,০০০ সাশ্রয় — ৪০% ছাড় ✦
                </span>
            </div>
        </div>

        <!-- Key stats row — scannable at a glance -->
        <div class="flex flex-wrap justify-center gap-3 mb-10 reveal">
            <!-- Stat pill -->
            <div style="
                background:rgba(6,13,26,0.7);
                border:1px solid rgba(40,172,226,0.25);
                border-radius:12px;
                padding:12px 20px;
                min-width:130px;
                backdrop-filter:blur(8px);
            ">
                <div class="font-['Cinzel']" style="font-size:clamp(18px,3.5vw,26px);color:#28ace2;line-height:1;">~৳ 60K</div>
                <div class="font-['Cormorant_Garamond']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;" data-en>Annual Income</div>
                <div class="font-['Tiro_Bangla']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;display:none;" data-bn>বার্ষিক আয়</div>
            </div>
            <div style="
                background:rgba(6,13,26,0.7);
                border:1px solid rgba(40,172,226,0.25);
                border-radius:12px;
                padding:12px 20px;
                min-width:130px;
                backdrop-filter:blur(8px);
            ">
                <div class="font-['Cinzel']" style="font-size:clamp(18px,3.5vw,26px);color:#28ace2;line-height:1;">10%</div>
                <div class="font-['Cormorant_Garamond']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;" data-en>Annual Return</div>
                <div class="font-['Tiro_Bangla']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;display:none;" data-bn>বার্ষিক রিটার্ন</div>
            </div>
            <div style="
                background:rgba(6,13,26,0.7);
                border:1px solid rgba(40,172,226,0.25);
                border-radius:12px;
                padding:12px 20px;
                min-width:130px;
                backdrop-filter:blur(8px);
            ">
                <div class="font-['Cinzel']" style="font-size:clamp(18px,3.5vw,26px);color:#28ace2;line-height:1;">3 Nights</div>
                <div class="font-['Cormorant_Garamond']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;" data-en>Free Stay / Year</div>
                <div class="font-['Tiro_Bangla']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;display:none;" data-bn>বিনামূল্যে থাকা</div>
            </div>
            <div style="
                background:rgba(6,13,26,0.7);
                border:1px solid rgba(40,172,226,0.25);
                border-radius:12px;
                padding:12px 20px;
                min-width:130px;
                backdrop-filter:blur(8px);
            ">
                <div class="font-['Cinzel']" style="font-size:clamp(18px,3.5vw,26px);color:#28ace2;line-height:1;">4 ★</div>
                <div class="font-['Cormorant_Garamond']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;" data-en>Hotel Standard</div>
                <div class="font-['Tiro_Bangla']" style="font-size:clamp(11px,2vw,14px);color:rgba(232,220,200,0.75);margin-top:4px;display:none;" data-bn>হোটেল মান</div>
            </div>
        </div>

        <!-- Urgency line — bigger, clearer -->
        <p class="font-['Cormorant_Garamond'] italic mx-auto mb-10 reveal"
           style="font-size:clamp(17px,2.8vw,24px);color:rgba(247,241,232,0.85);max-width:560px;line-height:1.6;font-weight:500;"
           data-en>
            Limited shares available. The sea does not wait — and neither should you.
        </p>
        <p class="font-['Tiro_Bangla'] mx-auto mb-10 reveal"
           style="font-size:clamp(15px,2.4vw,20px);color:rgba(247,241,232,0.85);max-width:560px;line-height:1.7;display:none;"
           data-bn>
            সীমিত শেয়ার বাকি। সমুদ্র অপেক্ষা করে না — আপনিও করবেন না।
        </p>

        <!-- CTA Buttons — large, clear, stacked on mobile -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center reveal">
            <a href="{{route('form')}}" class="btn-gold w-full sm:w-auto text-center" style="font-size:clamp(12px,2vw,15px);padding:20px 40px;">
                <span data-en>Buy My Share Now</span>
                <span data-bn style="display:none">এখনই শেয়ার কিনুন</span>
            </a>
            <a href="tel:+8801994045693" class="btn-outline w-full sm:w-auto text-center" style="font-size:clamp(12px,2vw,15px);padding:20px 40px;" data-en>
                Speak to an Advisor
            </a>
            <a href="tel:+8801994045693" class="btn-outline w-full sm:w-auto text-center" style="font-size:clamp(12px,2vw,15px);padding:20px 40px;display:none;" data-bn>
                পরামর্শকের সাথে কথা বলুন
            </a>
        </div>

        <!-- Trust note below buttons -->
        <p class="font-['Cormorant_Garamond'] italic mt-8 reveal"
           style="font-size:clamp(13px,2vw,16px);color:rgba(232,220,200,0.5);" data-en>
            ✦ &nbsp; ISO 9001:2015 Certified &nbsp;·&nbsp; Alliance Builders Ltd. &nbsp;·&nbsp; December 2030 Handover &nbsp; ✦
        </p>
        <p class="font-['Tiro_Bangla'] mt-8 reveal"
           style="font-size:clamp(12px,2vw,14px);color:rgba(232,220,200,0.5);display:none;" data-bn>
            ✦ &nbsp; ISO 9001:2015 সার্টিফাইড &nbsp;·&nbsp; অ্যালায়েন্স বিল্ডার্স লি. &nbsp;·&nbsp; ডিসেম্বর ২০৩০ হস্তান্তর &nbsp; ✦
        </p>

    </div>
</section>

<!-- ===== BRAND ===== -->
<section id="brand" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-24">
    <div class="relative z-10 max-w-[1300px] mx-auto px-4 sm:px-8 lg:px-12">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-3 px-6 py-2.5 mb-8 font-['Cinzel'] text-[11px] tracking-[.3em] border reveal" style="background:rgba(40,172,226,.06);border-color:rgba(40,172,226,.2);color:var(--gold)">
                <span>✦</span>
                <span data-en>Alliance Group — ISO 9001:2015 Certified</span>
                <span data-bn style="display:none">অ্যালায়েন্স গ্রুপ — ISO 9001:2015 সার্টিফাইড</span>
                <span>✦</span>
            </div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] text-center reveal" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>A <em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">Legacy</em> of Excellence</span>
                <span data-bn style="display:none">উৎকর্ষতার <em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">উত্তরাধিকার</em></span>
            </h2>
            <p class="font-['Cormorant_Garamond'] text-xl font-light leading-[1.9] mt-4 mx-auto max-w-[600px] text-center reveal" style="color:rgba(232,220,200,.7)" data-en>Hotel Jana is brought to you by Alliance Group — a family of six distinguished companies committed to building Bangladesh's future.</p>
            <p class="font-['Tiro_Bangla'] text-[17px] font-light leading-[1.9] mt-4 mx-auto max-w-[600px] text-center reveal" style="color:rgba(232,220,200,.7); display:none" data-bn>হোটেল জানা আপনার কাছে নিয়ে এসেছে অ্যালায়েন্স গ্রুপ — ছয়টি বিশিষ্ট কোম্পানির একটি পরিবার।</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2px] rounded-xl">
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(161,179,201,0.78);border-color:rgba(40,172,226,.08)"><img src="{{ Vite::asset('resources/images/logo/alliance.webp') }}" class="w-24"><div class="font-['Cinzel'] text-[18px] tracking-[.1em] font-medium" style="color:black">Alliance Builders Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(161,179,201,0.78);border-color:rgba(40,172,226,.08)"><img src="{{ Vite::asset('resources/images/logo/alliance-brokerage.svg') }}" class="w-24"><div class="font-['Cinzel'] text-[18px] tracking-[.1em] font-medium" style="color:black">Alliance Brokerage Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(161,179,201,0.78);border-color:rgba(40,172,226,.08)"><img src="{{ Vite::asset('resources/images/logo/alliance-success-builders.svg') }}" class="w-24"><div class="font-['Cinzel'] text-[18px] tracking-[.1em] font-medium" style="color:black">Alliance Success Builders Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(161,179,201,0.78);border-color:rgba(40,172,226,.08)"><img src="{{ Vite::asset('resources/images/logo/alliance-construction.svg') }}" class="w-24"><div class="font-['Cinzel'] text-[18px] tracking-[.1em] font-medium" style="color:black">Alliance Construction Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(161,179,201,0.78);border-color:rgba(40,172,226,.08)"><img src="{{ Vite::asset('resources/images/logo/jana.png') }}" class="w-24"><div class="font-['Cinzel'] text-[18px] tracking-[.1em] font-medium" style="color:black">Hotel Jana Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(161,179,201,0.78);border-color:rgba(40,172,226,.08)"><img src="{{ Vite::asset('resources/images/logo/alliance-beverage-agro.svg') }}" class="w-24"><div class="font-['Cinzel'] text-[18px] tracking-[.1em] font-medium" style="color:black">Alliance Food &amp; Beverage Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
        </div>

        <div class="gold-line-deco reveal"></div>

        <div class="text-center pb-5 reveal">
            <p class="font-['Cormorant_Garamond'] text-[18px] tracking-[.1em]" style="color:rgba(232,220,200,.45)" data-en>www.alliancebuilders.org &nbsp;·&nbsp; www.hoteljanabd.com</p>
            <p class="font-['Tiro_Bangla'] text-[15px] mt-1" style="color:rgba(232,220,200,.45); display:none" data-bn>www.alliancebuilders.org &nbsp;·&nbsp; www.hoteljanabd.com</p>
        </div>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<div id="contact" class="py-12 px-6 sm:px-10 lg:px-12 border-t" style="background:rgba(40,172,226,.26);border-color:rgba(40,172,226,.2)">
    <div class="max-w-[1300px] mx-auto grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] gap-8 md:gap-12 items-center text-center md:text-left">
        <div class="contact-info">
            <div class="font-['Cinzel'] text-[10px] tracking-[.4em] uppercase mb-3" style="color:var(--gold)" data-en>Head Office</div>
            <div class="font-['Cinzel'] text-[10px] tracking-[.4em] uppercase mb-3" style="color:var(--gold); display:none" data-bn>প্রধান কার্যালয়</div>
            <div class="contact-value font-['Cormorant_Garamond'] text-[15px] leading-[2]" style="color:rgba(232,220,200,.7)">
                Ahmud Villa, House #640 (1st Floor)<br>West Kazipara, Mirpur, Dhaka-1216
            </div>
        </div>
        <div class="text-center">
            <span class="font-['Cinzel'] text-[28px] tracking-[.3em] block mb-2" style="color:var(--gold)">JANA</span>
            <span class="font-['Cormorant_Garamond'] text-[13px] tracking-[.15em]" style="color:rgba(232,220,200,.4)" data-en>WHERE THE BAY MEETS INFINITY</span>
            <span class="font-['Tiro_Bangla'] text-[13px] tracking-[.15em]" style="color:rgba(232,220,200,.4); display:none" data-bn>যেখানে সমুদ্র মিলিত হয় অনন্তের সাথে</span>
        </div>
        <div class="contact-info text-center md:text-right">
            <div class="font-['Cinzel'] text-[10px] tracking-[.4em] uppercase mb-3" style="color:var(--gold)" data-en>Contact</div>
            <div class="font-['Cinzel'] text-[10px] tracking-[.4em] uppercase mb-3" style="color:var(--gold); display:none" data-bn>যোগাযোগ</div>
            <div class="contact-value font-['Cormorant_Garamond'] text-[15px] leading-[2]" style="color:rgba(232,220,200,.7)">
                <a href="tel:+8801994045693">+88 01994 045693</a><br>
                <a href="tel:+8801994045693">+88 01994 045693</a><br>
                <a href="tel:+8801994045705">+88 01994 045705</a><br>
                <a href="mailto:asad@alliancebuildersltd.org">asad@alliancebuildersltd.org</a>
            </div>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
@if(session('success'))
    <div id="successModal" class="fixed inset-0 z-[99999] flex items-center justify-center p-6"
         style="background:rgba(6,13,26,0.92);backdrop-filter:blur(16px)">

        <div class="relative max-w-lg w-full text-center px-10 py-14 border rounded-xl"
             style="background:rgba(13,33,55,0.9);border-color:rgba(40,172,226,0.3)">

            <!-- Close button -->
            <button onclick="document.getElementById('successModal').remove()"
                    class="absolute top-4 right-5 font-['Cinzel'] text-xs tracking-widest"
                    style="color:rgba(40,172,226,0.5)">✕ CLOSE</button>

            <!-- Icon -->
            <div class="w-20 h-20 rounded-full border-2 flex items-center justify-center mx-auto mb-8 text-3xl"
                 style="border-color:var(--gold);animation:successPop 0.6s cubic-bezier(0.68,-0.55,0.27,1.55) forwards">
                ✦
            </div>

            <!-- Title -->
            <h2 class="font-['Cinzel'] text-2xl font-normal mb-3" style="color:var(--gold)">
                Payment Successful
            </h2>

            <p class="font-['Cormorant_Garamond'] text-lg italic mb-8" style="color:rgba(232,220,200,0.6)">
                One of our officials will contact you soon.
            </p>

            <button onclick="document.getElementById('successModal').remove()" class="btn-gold">
                <span>✦ &nbsp; Continue &nbsp; ✦</span>
            </button>
        </div>
    </div>
@endif

<!-- Info MODAL -->
@if(session('info'))
    <div id="infoModal" class="fixed inset-0 z-[99999] flex items-center justify-center p-6"
         style="background:rgba(6,13,26,0.85);backdrop-filter:blur(12px)">
        <div class="relative max-w-md w-full text-center px-10 py-12 border"
             style="background:rgba(13,33,55,0.9);border-color:rgba(40,172,226,0.2)">
            <button onclick="document.getElementById('infoModal').remove()"
                    class="absolute top-4 right-5 font-['Cinzel'] text-xs" style="color:rgba(40,172,226,0.5)">✕</button>
            <div class="text-4xl mb-6">ℹ️</div>
            <h2 class="font-['Cinzel'] text-xl mb-4" style="color:var(--gold)">{{ session('info_title', 'Already Processed') }}</h2>
            <p class="font-['Cormorant_Garamond'] text-lg mb-8" style="color:rgba(232,220,200,0.6)">{{ session('info') }}</p>
            <button onclick="document.getElementById('infoModal').remove()" class="btn-outline">Dismiss</button>
        </div>
    </div>
@endif

<!-- Cancel MODAL -->
@if(session('cancel'))
    <div id="cancelModal" class="fixed inset-0 z-[99999] flex items-center justify-center p-6"
         style="background:rgba(6,13,26,0.85);backdrop-filter:blur(12px)">
        <div class="relative max-w-md w-full text-center px-10 py-12 border"
             style="background:rgba(13,33,55,0.9);border-color:rgba(200,50,50,0.3)">
            <button onclick="document.getElementById('cancelModal').remove()"
                    class="absolute top-4 right-5 font-['Cinzel'] text-xs" style="color:rgba(232,220,200,0.4)">✕</button>
            <div class="text-4xl mb-6">✕</div>
            <h2 class="font-['Cinzel'] text-xl mb-4" style="color:#f87171">Transaction Cancelled</h2>
            <p class="font-['Cormorant_Garamond'] text-lg mb-8" style="color:rgba(232,220,200,0.6)">{{ session('cancel') }}</p>
            <button onclick="document.getElementById('cancelModal').remove()" class="btn-outline">Dismiss</button>
        </div>
    </div>
@endif

<!-- Fail MODAL -->
@if(session('fail'))
    <div id="failModal" class="fixed inset-0 z-[99999] flex items-center justify-center p-6"
         style="background:rgba(6,13,26,0.85);backdrop-filter:blur(12px)">
        <div class="relative max-w-md w-full text-center px-6 py-12 border rounded-2xl"
             style="background:rgba(13,33,55,0.9);border-color:rgba(248,113,113,0.3)">

            <button onclick="document.getElementById('failModal').remove()"
                    class="absolute top-4 right-5 font-['Cinzel'] text-xs"
                    style="color:rgba(232,220,200,0.4)">✕ CLOSE</button>

            <div class="w-20 h-20 rounded-full border-2 flex items-center justify-center mx-auto mb-8 text-3xl"
                 style="border-color:#f87171">✕</div>

            <h2 class="font-['Cinzel'] text-2xl font-normal" style="color:#f87171">
                Payment Failed
            </h2>

            @if(session('fail_reason'))
                <p class="font-['Cormorant_Garamond'] text-lg mt-6" style="color:rgba(232,220,200,0.7)">{{ session('fail_reason') }}</p>
            @endif

{{--            <p class="font-['Cormorant_Garamond'] text-lg italic mb-8"--}}
{{--               style="color:rgba(232,220,200,0.6)">{{ session('fail') }}</p>--}}

{{--            <div class="flex gap-4 justify-center flex-wrap">--}}
{{--                <a href="{{ route('booking-form') }}" class="btn-gold"><span>Try Again</span></a>--}}
{{--                <button onclick="document.getElementById('failModal').remove()"--}}
{{--                        class="btn-outline">Dismiss</button>--}}
{{--            </div>--}}
        </div>
    </div>
@endif

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
    // HAMBURGER MENU
    let menuOpen = false;
    function toggleMenu() {
        menuOpen = !menuOpen;
        const menu = document.getElementById('mobileMenu');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');
        if (menuOpen) {
            menu.style.opacity = '1';
            menu.style.pointerEvents = 'auto';
            bar1.style.transform = 'translateY(6px) rotate(45deg)';
            bar2.style.opacity = '0';
            bar3.style.transform = 'translateY(-6px) rotate(-45deg)';
            bar3.style.width = '100%';
            document.body.style.overflow = 'hidden';
        } else {
            menu.style.opacity = '0';
            menu.style.pointerEvents = 'none';
            bar1.style.transform = '';
            bar2.style.opacity = '1';
            bar3.style.transform = '';
            bar3.style.width = '75%';
            document.body.style.overflow = '';
        }
    }

    // CUSTOM CURSOR
    const cursor = document.getElementById('cursor');
    const cursorRing = document.getElementById('cursorRing');
    let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;
    document.addEventListener('mousemove', e => { mouseX = e.clientX; mouseY = e.clientY; cursor.style.left = mouseX + 'px'; cursor.style.top = mouseY + 'px'; });
    function animateRing() { ringX += (mouseX - ringX) * 0.12; ringY += (mouseY - ringY) * 0.12; cursorRing.style.left = ringX + 'px'; cursorRing.style.top = ringY + 'px'; requestAnimationFrame(animateRing); }
    animateRing();
    document.querySelectorAll('a, button, .gallery-item, .benefit-card, .amenity-item, .lang-orb').forEach(el => {
        el.addEventListener('mouseenter', () => { cursor.style.width = '16px'; cursor.style.height = '16px'; cursorRing.style.width = '52px'; cursorRing.style.height = '52px'; cursorRing.style.borderColor = 'rgba(40,172,226,0.8)'; });
        el.addEventListener('mouseleave', () => { cursor.style.width = '8px'; cursor.style.height = '8px'; cursorRing.style.width = '36px'; cursorRing.style.height = '36px'; cursorRing.style.borderColor = 'rgba(40,172,226,0.5)'; });
    });

    // PARTICLES
    const particlesContainer = document.getElementById('particles');
    function createParticle() {
        const p = document.createElement('div'); p.className = 'particle';
        const size = Math.random() * 3 + 1;
        p.style.cssText = `width:${size}px;height:${size}px;left:${Math.random()*100}%;animation-duration:${Math.random()*10+8}s;animation-delay:${Math.random()*8}s;opacity:0;`;
        particlesContainer.appendChild(p); setTimeout(() => p.remove(), 20000);
    }
    setInterval(createParticle, 600); for (let i = 0; i < 8; i++) createParticle();

    // NAV SCROLL
    window.addEventListener('scroll', () => document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 60));

    // REVEAL ON SCROLL
    const observer = new IntersectionObserver((entries) => { entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }); }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach((el, i) => { el.style.transitionDelay = (i % 4) * 0.08 + 's'; observer.observe(el); });

    // LANGUAGE TOGGLE
    let currentLang = 'en';
    function toggleLang() {
        currentLang = currentLang === 'en' ? 'bn' : 'en';
        const orb = document.getElementById('langToggle');
        if (currentLang === 'bn') {
            document.body.classList.add('lang-bn'); orb.classList.add('bn');
            document.querySelectorAll('[data-en]').forEach(el => el.style.display = 'none');
            document.querySelectorAll('[data-bn]').forEach(el => { const tag = el.tagName.toLowerCase(); el.style.display = (tag === 'a' || tag === 'span') ? 'inline-block' : 'block'; });
        } else {
            document.body.classList.remove('lang-bn'); orb.classList.remove('bn');
            document.querySelectorAll('[data-bn]').forEach(el => el.style.display = 'none');
            document.querySelectorAll('[data-en]').forEach(el => { const tag = el.tagName.toLowerCase(); el.style.display = (tag === 'a' || tag === 'span') ? 'inline-block' : 'block'; });
        }
    }

    // HERO PARALLAX
    const heroBg = document.querySelector('.hero-bg');
    document.getElementById('hero').addEventListener('mousemove', e => { const x = (e.clientX / window.innerWidth - 0.5) * 20; const y = (e.clientY / window.innerHeight - 0.5) * 10; heroBg.style.transform = `scale(1.08) translate(${x}px, ${y}px)`; });

    // SMOOTH SCROLL
    document.querySelectorAll('a[href^="#"]').forEach(a => { a.addEventListener('click', e => { const target = document.querySelector(a.getAttribute('href')); if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); } }); });

    // CARD 3D TILT (desktop/hover devices only)
    if (window.matchMedia('(hover: hover)').matches) {
        document.querySelectorAll('.benefit-card').forEach(card => {
            card.addEventListener('mousemove', e => { const rect = card.getBoundingClientRect(); const x = (e.clientX - rect.left) / rect.width - 0.5; const y = (e.clientY - rect.top) / rect.height - 0.5; card.style.transform = `perspective(600px) rotateY(${x*8}deg) rotateX(${-y*8}deg) scale(1.02)`; });
            card.addEventListener('mouseleave', () => { card.style.transform = ''; });
        });
    }
</script>
</body>
</html>
