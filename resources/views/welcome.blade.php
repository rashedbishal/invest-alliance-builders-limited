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
        .cursor { position:fixed; width:8px; height:8px; background:var(--gold); border-radius:50%; pointer-events:none; z-index:99999; transform:translate(-50%,-50%); transition:width .3s,height .3s,opacity .3s; mix-blend-mode:difference; }
        .cursor-ring { position:fixed; width:36px; height:36px; border:1px solid rgba(40,172,226,.5); border-radius:50%; pointer-events:none; z-index:99998; transform:translate(-50%,-50%); transition:all .15s ease; }
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
        .story-bg    { position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1519046904884-53103b34b206?w=1920&q=80') center 30%/cover; opacity:.12; }
        .story-overlay { position:absolute; inset:0; background:linear-gradient(135deg,var(--ocean-dark) 50%,rgba(6,13,26,.85) 100%); }

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
        .benefits-bg { position:absolute; inset:0; background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(40,172,226,.04) 0%,transparent 60%),url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1920&q=70') center/cover; opacity:.08; }
        .benefit-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(to right,transparent,var(--gold),transparent); opacity:0; transition:opacity .4s; }
        .benefit-card:hover::before { opacity:1; }
        .benefit-card-shine { position:absolute; inset:0; pointer-events:none; background:radial-gradient(circle at 0% 0%,rgba(40,172,226,.05) 0%,transparent 60%); opacity:0; transition:opacity .4s; }
        .benefit-card:hover .benefit-card-shine { opacity:1; }

        /* ── Amenities pseudo ── */
        .amenity-item::after { content:''; position:absolute; inset:0; background:radial-gradient(circle at center,rgba(40,172,226,.08) 0%,transparent 70%); opacity:0; transition:opacity .4s; }
        .amenity-item:hover::after { opacity:1; }
        .amenities-bg { position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1920&q=70') center/cover; opacity:.07; }

        /* ── Privilege card shine animation ── */
        .privilege-bg { position:absolute; inset:0; background:linear-gradient(135deg,rgba(40,172,226,.03) 0%,transparent 50%),url('https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1920&q=70') center/cover; opacity:.08; }
        .privilege-card-shine { position:absolute; top:-50%; left:-50%; width:200%; height:200%; background:linear-gradient(45deg,transparent 30%,rgba(255,255,255,.15) 50%,transparent 70%); transform:rotate(30deg); animation:cardShine 4s ease-in-out infinite; }
        @keyframes cardShine { 0%,100%{transform:rotate(30deg) translateX(-100%)} 50%{transform:rotate(30deg) translateX(100%)} }
        .privilege-card::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(255,255,255,.3) 0%,transparent 40%,rgba(255,255,255,.1) 100%); pointer-events:none; }
        .privilege-perks li::before { content:'✦'; color:var(--deep-navy); font-size:10px; }
        .priv-term::before { content:'✦'; font-size:8px; color:rgba(10,15,30,.4); flex-shrink:0; margin-top:2px; }
        .priv-wave-bar::before { content:''; position:absolute; inset:0; background:linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent); border-radius:2px; }

        /* ── Invest backgrounds ── */
        .invest-bg { position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=90') center/cover; animation:investParallax 25s ease-in-out infinite alternate; }
        @keyframes investParallax { from{transform:scale(1) translateY(0)} to{transform:scale(1.08) translateY(-30px)} }
        .invest-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(6,13,26,.6),rgba(6,13,26,.75),rgba(6,13,26,.6)); }

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
</head>

<body>

<!-- CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAVIGATION -->
<nav id="mainNav" class="fixed top-0 left-0 right-0 z-[9990] flex items-center justify-between px-4 py-2 transition-all duration-500">
    <a href="#" style="font-family:'Cinzel',serif;font-size:20px;letter-spacing:.2em;color:var(--gold);font-weight:600;text-decoration:none;">
        <img src="jana.png" alt="jana logo" class="w-12 h-auto p-1">
    </a>

    <!-- Desktop nav -->
    <div class="nav-links hidden lg:flex items-center gap-9">
        <a href="#story"     class="font-['Cinzel'] text-xs tracking-widest text-white uppercase">Our Vision</a>
        <a href="#gallery"   class="font-['Cinzel'] text-xs tracking-widest text-white uppercase">Gallery</a>
        <a href="#benefits"  class="font-['Cinzel'] text-xs tracking-widest text-white uppercase">Ownership</a>
        <a href="#amenities" class="font-['Cinzel'] text-xs tracking-widest text-white uppercase">Amenities</a>
        <a href="#privilege" class="font-['Cinzel'] text-xs tracking-widest text-white uppercase">Privileges</a>
        <a href="form.html"  class="font-['Cinzel'] text-xs tracking-widest uppercase px-5 py-2.5 rounded-md border"
           style="color:var(--gold);border-color:rgb(40,172,226);background-color:#F7F1E8;">Reserve a Share</a>
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
    <div class="mt-4"><a href="form.html" class="btn-gold"><span data-en>Reserve a Share</span><span data-bn style="display:none">শেয়ার বুক করুন</span></a></div>
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

        <p class="hero-subtitle font-['Cormorant_Garamond'] italic font-light mb-8 sm:mb-12 tracking-[.05em]" style="font-size:clamp(15px,2.5vw,26px);color:rgba(232,220,200,.75)" data-en>Where the horizon bows and the sea whispers eternity.</p>
        <p class="hero-subtitle font-['Tiro_Bangla'] font-light mb-8 sm:mb-12" style="font-size:clamp(15px,2.5vw,26px);color:rgba(232,220,200,.75); display:none" data-bn>যেখানে দিগন্ত নতজানু হয়, সমুদ্র বলে অনন্তকালের কথা।</p>

        <div class="hero-cta flex flex-col sm:flex-row gap-4 sm:gap-5 justify-center items-center flex-wrap">
            <a href="form.html" class="btn-gold w-full sm:w-auto text-center"><span data-en>Claim Your Share</span><span data-bn style="display:none">আপনার শেয়ার নিন</span></a>
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
                <span data-en>A Dream Rising<br>from the <em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">Golden Shore</em></span>
                <span data-bn style="display:none">সোনালি তীর থেকে<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">জন্ম নেওয়া স্বপ্ন</em></span>
            </h2>

            <div class="flex items-center gap-4 justify-center my-6 reveal">
                <div class="gold-divider-line"></div>
                <div class="gold-divider-diamond"></div>
                <div class="gold-divider-line right"></div>
            </div>

            <p class="font-['Cormorant_Garamond'] text-xl font-light leading-[1.9] mb-5 reveal" style="color:rgba(232,220,200,.7)" data-en>Kuakata — one of earth's rarest gifts. A beach where the sun is born from the sea at dawn and surrenders to it at dusk. This is not a place; it is an experience of a lifetime. And at its heart, Hotel Jana rises — a 4-star monument to refinement, crafted by Alliance Builders Ltd. for those who seek the extraordinary.</p>
            <p class="font-['Tiro_Bangla'] text-[17px] font-light leading-[1.9] mb-5 reveal" style="color:rgba(232,220,200,.7); display:none" data-bn>কুয়াকাটা — পৃথিবীর বিরলতম উপহারগুলির একটি। একটি সৈকত যেখানে ভোরে সমুদ্র থেকে সূর্যের জন্ম হয় এবং সন্ধ্যায় সমুদ্রেই অস্ত যায়। এটি শুধু একটি জায়গা নয়, এটি জীবনের একটি অনুভূতি। আর সেখানেই উঠে দাঁড়াচ্ছে হোটেল জানা — একটি ৪ স্টার আবাসন।</p>

            <p class="font-['Cormorant_Garamond'] text-xl font-light leading-[1.9] mb-5 reveal" style="color:rgba(232,220,200,.7)" data-en>This is not merely a hotel. It is a legacy. A stake in Hotel Jana is a stake in the future of luxury hospitality in Bangladesh — and an invitation to own a piece of paradise.</p>
            <p class="font-['Tiro_Bangla'] text-[17px] font-light leading-[1.9] mb-5 reveal" style="color:rgba(232,220,200,.7); display:none" data-bn>এটি শুধু একটি হোটেল নয়। এটি একটি উত্তরাধিকার। হোটেল জানায় একটি শেয়ার মানে বাংলাদেশের বিলাসবহুল আতিথেয়তার ভবিষ্যতে একটি অংশ।</p>

            <div class="flex gap-6 sm:gap-12 mt-12 reveal">
                <div><div class="font-['Cinzel'] text-5xl font-normal leading-none" style="color:var(--gold)">4★</div><div class="font-['Cormorant_Garamond'] text-sm tracking-[.1em] uppercase mt-1" style="color:rgba(232,220,200,.5)" data-en>International Standard</div><div class="font-['Tiro_Bangla'] text-sm mt-1" style="color:rgba(232,220,200,.5); display:none" data-bn>আন্তর্জাতিক মান</div></div>
                <div><div class="font-['Cinzel'] text-5xl font-normal leading-none" style="color:var(--gold)">264</div><div class="font-['Cormorant_Garamond'] text-sm tracking-[.1em] uppercase mt-1" style="color:rgba(232,220,200,.5)" data-en>Luxury Rooms</div><div class="font-['Tiro_Bangla'] text-sm mt-1" style="color:rgba(232,220,200,.5); display:none" data-bn>বিলাসবহুল কক্ষ</div></div>
                <div><div class="font-['Cinzel'] text-5xl font-normal leading-none" style="color:var(--gold)">12</div><div class="font-['Cormorant_Garamond'] text-sm tracking-[.1em] uppercase mt-1" style="color:rgba(232,220,200,.5)" data-en>Floor Tower</div><div class="font-['Tiro_Bangla'] text-sm mt-1" style="color:rgba(232,220,200,.5); display:none" data-bn>তলা ভবন</div></div>
            </div>
        </div>

        <div class="relative reveal-right hidden lg:block">
            <div class="absolute -top-4 -right-4 -bottom-4 -left-4 border-4 rounded-2xl z-[1] pointer-events-none" style="border-color:rgba(40,172,226,.15)"></div>
            <img class="w-full [aspect-ratio:3/4] object-cover relative z-[2] border rounded-2xl" style="border-color:rgba(40,172,226,.2)" src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=90" alt="Hotel Jana Exterior">
            <img class="absolute w-[55%] [aspect-ratio:1] bottom-[-40px] left-[-40px] object-cover z-[3] border-[3px] rounded-2xl shadow-[0_0_60px_rgba(0,0,0,0.8)]" style="border-color:var(--ocean-dark)" src="https://images.unsplash.com/photo-1455587734955-081b22074882?w=400&q=90" alt="Hotel Jana Lobby">
        </div>
    </div>
</section>

<!-- ===== GALLERY ===== -->
<section id="gallery" class="min-h-screen relative overflow-hidden py-16 sm:py-20" style="background:#050A14">
    <div class="relative z-10 max-w-[1400px] mx-auto px-4 sm:px-8 lg:px-12">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold)" data-en>Visual Journey</div>
            <div class="flex items-center justify-center gap-4 mb-5 font-['Cinzel'] text-[10px] tracking-[.5em] uppercase reveal" style="color:var(--gold); display:none" data-bn>দৃশ্যের যাত্রা</div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] text-center reveal" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>A World Unlike Any Other</span>
                <span data-bn style="display:none">অন্য কোনো জগতের মতো নয়</span>
            </h2>
        </div>

        <div class="gallery-grid reveal" style="display:grid;grid-template-columns:2fr 1fr 1fr;grid-template-rows:auto auto;gap:3px;height:80vh;border-radius:16px;overflow:hidden">
            <div class="gallery-item relative overflow-hidden cursor-pointer" style="grid-row:1/3">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=900&q=90" alt="Hotel Facade">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>THE FACADE</div>
                <div class="gallery-item-label" data-bn style="display:none">বাইরের দৃশ্য</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=90" alt="Luxury Suite">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>LUXURY SUITE</div>
                <div class="gallery-item-label" data-bn style="display:none">বিলাসবহুল সুইট</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=600&q=90" alt="Grand Lobby">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>GRAND LOBBY</div>
                <div class="gallery-item-label" data-bn style="display:none">গ্র্যান্ড লবি</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?w=600&q=90" alt="Rooftop Pool">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>ROOFTOP POOL</div>
                <div class="gallery-item-label" data-bn style="display:none">ছাদের সুইমিং পুল</div>
            </div>
            <div class="gallery-item relative overflow-hidden cursor-pointer">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=90" alt="Fine Dining">
                <div class="gallery-item-overlay"></div><div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>FINE DINING</div>
                <div class="gallery-item-label" data-bn style="display:none">ফাইন ডাইনিং</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== BENEFITS ===== -->
<section id="benefits" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-28" style="background:var(--ocean-dark)">
    <div class="benefits-bg"></div>
    <div class="relative z-10 max-w-[1300px] mx-auto px-4 sm:px-8 lg:px-12">
        <div class="text-center mb-20">
            <div class="inline-block px-6 py-2 mb-6 font-['Cinzel'] text-[10px] tracking-[.4em] uppercase border" style="background:linear-gradient(135deg,rgba(40,172,226,.15),rgba(40,172,226,.05));border-color:rgba(40,172,226,.3);color:var(--gold)" data-en>Ownership Benefits</div>
            <div class="inline-block px-6 py-2 mb-6 font-['Tiro_Bangla'] text-[10px] tracking-[.4em] uppercase border" style="background:linear-gradient(135deg,rgba(40,172,226,.15),rgba(40,172,226,.05));border-color:rgba(40,172,226,.3);color:var(--gold); display:none" data-bn>মালিকানার সুবিধা</div>
            <h2 class="font-['Cinzel'] font-normal leading-[1.15] reveal" style="font-size:clamp(32px,5vw,60px);color:var(--cream)">
                <span data-en>Twelve Reasons to Own<br>a Piece of <em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">Paradise</em></span>
                <span data-bn style="display:none">স্বর্গের একটুকরো কেনার<br><em class="font-['Cormorant_Garamond'] italic" style="color:var(--gold)">বারোটি কারণ</em></span>
            </h2>
            <p class="font-['Cormorant_Garamond'] text-xl font-light leading-[1.9] mt-4 mx-auto max-w-[600px] reveal" style="color:rgba(232,220,200,.7)" data-en>A share in Hotel Jana is not an expense. It is the most intelligent investment of your lifetime — yielding both financial returns and unparalleled experiences.</p>
            <p class="font-['Tiro_Bangla'] text-[17px] font-light leading-[1.9] mt-4 mx-auto max-w-[600px] reveal" style="color:rgba(232,220,200,.7); display:none" data-bn>হোটেল জানায় একটি শেয়ার কোনো ব্যয় নয়। এটি আপনার জীবনের সবচেয়ে বুদ্ধিমান বিনিয়োগ।</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2px]">
            <!-- benefit macro — repeated 12× -->
{{--            {% set benefits = [--}}
{{--            ['01','💰','Discounted Acquisition','ছাড়ে মালিকানা ক্রয়','Spot booking price of ৳4,00,000 against the listed share value of ৳5,00,000 — a 20% exclusive discount at launch.','প্রতিটি শেয়ারের মূল্য ৳৫,০০,০০০ এর বিপরীতে স্পট বুকিং মূল্য মাত্র ৳৪,০০,০০০ — ২০% বিশেষ ছাড়।'],--}}
{{--            ] %}--}}

            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">01</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">💰</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Discounted Acquisition</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>ছাড়ে মালিকানা ক্রয়</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Spot booking price of ৳4,00,000 against the listed share value of ৳5,00,000 — a 20% exclusive discount at launch.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>প্রতিটি শেয়ারের মূল্য ৳৫,০০,০০০ এর বিপরীতে স্পট বুকিং মূল্য মাত্র ৳৪,০০,০০০ — ২০% বিশেষ ছাড়।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">02</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">📈</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Annual Dividend Income</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>বার্ষিক আয়</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Earn approximately ৳60,000 per share annually — guaranteed, interest-free passive income.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>প্রতি বছর প্রতিটি শেয়ারে প্রায় ৬০ হাজার টাকা নিশ্চিত সুদ মুক্ত আয়ের সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">03</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🔄</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>10% Annual Return Guarantee</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>১০% মুনাফাসহ রিটার্ন</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>The company guarantees the buyback of your share at any time with 10% annual profit included.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>মালিকানা ক্রয়ের পর যেকোনো সময় বার্ষিক ১০% মুনাফাসহ টাকা ফেরত নেওয়ার সুবিধা।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">04</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">📜</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Land &amp; Building Registration</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>জমি ও বিল্ডিং সাব-কবলা</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Receive sub-kabala registration of 2 sq.ft. land and 17 sq.ft. building space — total 19 sq.ft. in your name.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>২ স্কয়ার ফিট জমি ও ১৭ স্কয়ার ফিট বিল্ডিং — মোট ১৯ স্কয়ার ফিট সাব-কবলা রেজিস্ট্রেশন পাবেন।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">05</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🏖️</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Complimentary Stay</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>বিনামূল্যে থাকার সুযোগ</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Enjoy 3 days and 2 nights complimentary accommodation per year, plus family discounts throughout the year.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>বছরে তিন দিন দুই রাত বিনামূল্যে থাকার সুযোগ এবং পরিবারের জন্য সারা বছর বিশেষ ছাড়।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">06</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">💳</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Exclusive Reward Card</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>রিওয়ার্ড কার্ড</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>A personal Reward Card granting special discounts across all hotel services, dining, and spa.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>রিওয়ার্ড কার্ডে সকল সার্ভিসে বিশেষ ছাড় পাবেন।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">07</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🚀</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Asset Appreciation</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>সম্পদের মূল্যবৃদ্ধি</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Hotel shares appreciate 5 to 6 times faster than conventional real estate — a superior wealth creation vehicle.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>অন্যান্য সম্পদের তুলনায় ৫/৬ গুণ বেশি মূল্যবৃদ্ধির সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">08</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🏛️</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Board Directorship</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>বোর্ড অব ডিরেক্টর</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Acquire 50 or more shares and earn a prestigious seat on the Board of Directors of Hotel Jana.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>৫০টি শেয়ার ক্রয়ের মাধ্যমে বোর্ড অব ডিরেক্টরের সদস্য হওয়ার সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">09</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🏗️</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Flexible Payment</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>কিস্তি সুবিধা</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Convenient monthly instalment options available for hotel share acquisition.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>হোটেলে মালিকানা ক্রয়ে মাসিক দীর্ঘমেয়াদি কিস্তির সুবিধা।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">10</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">👑</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Social Prestige</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>সামাজিক মর্যাদা</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Elevate your social standing. Hotel Jana ownership is a symbol of achievement and a prestigious lifestyle.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>সামাজিক মর্যাদাসহ প্রেস্টিজিয়াস লাইফ উপভোগ করুন।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">11</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🤝</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Market Resale Rights</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>পুনরায় বিক্রয়ের সুযোগ</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Sell your share back to the company at market value — complete liquidity at your discretion.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>বাজার মূল্যে কোম্পানির কাছে পুনরায় মালিকানা বিক্রয়ের সুযোগ।</div>
            </div>
            <div class="benefit-card relative overflow-hidden p-11 border backdrop-blur-[10px] transition-all duration-[400ms] reveal" style="background:rgba(13,33,55,.4);border-color:rgba(40,172,226,.1)">
                <div class="benefit-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] tracking-[.3em] mb-4" style="color:rgba(40,172,226,.4)">12</div>
                <span class="text-[32px] block mb-5" style="filter:sepia(1) saturate(2) hue-rotate(15deg)">🌿</span>
                <div class="font-['Cinzel'] text-sm tracking-[.1em] font-medium mb-3" style="color:var(--gold)" data-en>Hereditary Transfer</div>
                <div class="font-['Tiro_Bangla'] text-[15px] font-medium mb-3" style="color:var(--gold); display:none" data-bn>বংশপরম্পরায় মালিকানা</div>
                <div class="font-['Cormorant_Garamond'] text-[17px] font-light leading-[1.7]" style="color:rgba(232,220,200,.6)" data-en>Your ownership is transferable through generations — a true family legacy, built in paradise.</div>
                <div class="font-['Tiro_Bangla'] text-sm font-light leading-[1.8]" style="color:rgba(232,220,200,.6); display:none" data-bn>বংশ পরম্পরায় মালিকানা পরিবর্তনের সুবিধা — একটি সত্যিকারের পারিবারিক উত্তরাধিকার।</div>
            </div>
        </div>

        <div class="text-center mt-16 reveal">
            <a href="form.html" class="btn-gold w-full sm:w-auto text-center"><span data-en>Begin Your Ownership Journey</span><span data-bn style="display:none">মালিকানার যাত্রা শুরু করুন</span></a>
        </div>
    </div>
</section>

<!-- ===== AMENITIES ===== -->
<section id="amenities" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-28" style="background:#04080F">
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

        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-[3px]">
            <!-- amenity items -->
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] z-auto hover:z-[1] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="amenity-icon text-[28px] transition-transform duration-300 hover:scale-[1.2]">🛏️</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>264 Rooms</div><div class="font-['Tiro_Bangla'] text-[20px] leading-[1.4]" style="color:rgba(40,172,226,.7); display:none" data-bn>২৬৪ টি রুম</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🍹</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Juice Bar</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>জুস বার</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">💆</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Jacuzzi</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>জেড স্পা</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🏊</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Rooftop Pool</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>রুফটপ সুইমিং পুল</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🍽️</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Lounge</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>লঞ্জ</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🐴</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Horse Riding</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>হর্স রাইডিং</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🚁</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Helipad</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>হেলিপ্যাড</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">📋</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Meeting Rooms</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>মিটিং রুম</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🎡</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Kids Play Zone</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>চিলড্রেন প্লে জোন</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🎭</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Hall Room</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>হল রুম</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">☀️</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Sun Bath</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>সান বাথ</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🍖</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>BBQ Corner</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>বার বি কিউ</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🎬</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Cinema</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>সিনেপ্লেক্স</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🚐</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Transport</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>ট্রান্সপোর্ট</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🍴</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Restaurant</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>রেস্তুরেন্ট</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">💅</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Spa</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>স্পা</div></div>
            <div class="amenity-item aspect-square flex flex-col items-center justify-center gap-3 relative overflow-hidden p-6 text-center border transition-all duration-[400ms] hover:scale-[1.03] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[28px]">🏄</span><div class="font-['Cinzel'] text-[16px] tracking-[.15em] uppercase leading-[1.3]" style="color:rgba(40,172,226,.7)" data-en>Beach Games</div><div class="font-['Tiro_Bangla'] text-[20px]" style="color:rgba(40,172,226,.7); display:none" data-bn>বিচ গেমস</div></div>
        </div>

        <p class="text-center mt-10 font-['Cormorant_Garamond'] text-lg italic reveal" style="color:rgba(232,220,200,.45)" data-en>And countless more luxuries to be unveiled. Hotel Jana hands over in December 2030.</p>
        <p class="text-center mt-10 font-['Tiro_Bangla'] text-[15px] reveal" style="color:rgba(232,220,200,.45); display:none" data-bn>ইত্যাদি সহ আরও অনেক কিছু। হোটেলটি হস্তান্তর হবে ডিসেম্বর ২০৩০ সালে।</p>
    </div>
</section>

<!-- ===== PRIVILEGE ===== -->
<section id="privilege" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-28" style="background:var(--ocean-dark)">
    <div class="privilege-bg"></div>
    <div class="relative z-10 max-w-[1300px] mx-auto px-4 sm:px-8 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">

        <div class="privilege-cards-wrap relative reveal-left mx-auto" style="width:420px;height:265px;max-width:100%">
            <!-- BACK CARD -->
            <div class="priv-card priv-back absolute flex flex-col justify-between overflow-hidden rounded-2xl p-7" style="width:420px;height:265px;top:80px;left:140px;z-index:2;filter:brightness(.85);background:linear-gradient(135deg,#0773bb 0%,#28ace2 35%,#4fc3f0 55%,#28ace2 75%,#0773bb 100%);box-shadow:0 20px 60px rgba(0,0,0,.5),0 0 40px rgba(40,172,226,.15);transition:transform .4s ease">
                <div class="privilege-card-shine"></div>
                <div class="font-['Cinzel'] text-[11px] font-semibold tracking-[.1em] mb-3" style="color:rgba(10,15,30,.7)">Terms &amp; Conditions</div>
                <ul class="flex-1 list-none p-0 m-0 mb-4 overflow-hidden">
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Cormorant_Garamond'] text-sm leading-[1.4]" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1)" data-en>25% Discount — On Published Room Tariff</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Cormorant_Garamond'] text-sm leading-[1.4]" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1)" data-en>25% Discount — Restaurant Dining &amp; Packed Orders</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Cormorant_Garamond'] text-sm leading-[1.4]" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1)" data-en>15% Discount — Ayurvedic Spa Treatments</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Cormorant_Garamond'] text-sm leading-[1.4]" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1)" data-en>10% Discount — In-room Dining Service</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Cormorant_Garamond'] text-sm leading-[1.4]" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1)" data-en>Not valid for banqueting or special events</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] font-['Cormorant_Garamond'] text-sm leading-[1.4]" style="color:rgba(10,15,30,.75)" data-en>Blackout dates as defined by the hotel apply</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Tiro_Bangla'] text-sm" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1); display:none" data-bn>রুম ট্যারিফে ২৫% ছাড়</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Tiro_Bangla'] text-sm" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1); display:none" data-bn>রেস্তুরেন্ট ও অর্ডারে ২৫% ছাড়</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Tiro_Bangla'] text-sm" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1); display:none" data-bn>আয়ুর্বেদিক স্পায় ১৫% ছাড়</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] border-b font-['Tiro_Bangla'] text-sm" style="color:rgba(10,15,30,.75);border-color:rgba(10,15,30,.1); display:none" data-bn>ইন-রুম ডাইনিংয়ে ১০% ছাড়</li>
                    <li class="priv-term flex gap-2 items-baseline py-[5px] font-['Tiro_Bangla'] text-sm" style="color:rgba(10,15,30,.75); display:none" data-bn>ব্যাংকোয়েটিং বা বিশেষ অনুষ্ঠানে প্রযোজ্য নয়</li>
                </ul>
                <div class="priv-contact-bar flex flex-wrap gap-x-4 gap-y-1.5 mt-1 rounded-md p-2" style="background:rgba(255,255,255,.25)">
                    <span class="font-['Cinzel'] text-[9px] tracking-[.05em]" style="color:rgba(10,15,30,.65)">+88 01896 204401</span>
                    <span class="font-['Cinzel'] text-[9px] tracking-[.05em]" style="color:rgba(10,15,30,.65)"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7c1d0f1d183c1d1010151d121f191e09151018190e0f10081852130e1b">[email&#160;protected]</a></span>
                    <span class="font-['Cinzel'] text-[9px] tracking-[.05em]" style="color:rgba(10,15,30,.65)">www.alliancebuilders.org</span>
                </div>
            </div>
            <!-- FRONT CARD -->
            <div class="priv-card priv-front absolute flex flex-col justify-between overflow-hidden rounded-2xl p-7" style="width:420px;height:265px;top:0;left:0;z-index:1;cursor:pointer;background:linear-gradient(135deg,#0773bb 0%,#28ace2 35%,#4fc3f0 55%,#28ace2 75%,#0773bb 100%);box-shadow:0 20px 60px rgba(0,0,0,.5),0 0 40px rgba(40,172,226,.15);transition:transform .4s ease">
                <div class="privilege-card-shine"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <div class="font-['Cinzel'] text-[10px] tracking-[.15em] mb-1" style="color:rgba(10,15,30,.5)">Privilege Card</div>
                        <div class="privilege-hotel-name font-['Cinzel'] text-[22px] font-bold tracking-[.2em] mb-1" style="color:var(--deep-navy)">HOTEL JANA</div>
                    </div>
                    <div class="font-['Cinzel'] text-[9px] tracking-[.2em] pt-1" style="color:rgba(10,15,30,.4)">GOLD</div>
                </div>
                <div class="priv-wave-bar relative h-7 rounded-[2px] mt-4" style="background:linear-gradient(90deg,rgba(255,255,255,.15),rgba(255,255,255,.4),rgba(255,255,255,.15))"></div>
                <div class="mt-auto pt-4">
                    <div class="font-['Cinzel'] text-[15px] font-semibold tracking-[.05em]" style="color:rgba(10,15,30,.8)">Mr. Farhad</div>
                    <div class="font-mono text-[12px] tracking-[.2em] mt-1" style="color:rgba(10,15,30,.5)">2024 0089 6654 0321</div>
                </div>
            </div>
        </div>

        <div class="reveal-right">
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
                <a href="form.html" class="btn-gold w-full sm:w-auto text-center"><span data-en>Claim Your Privilege</span><span data-bn style="display:none">আপনার সুবিধা নিন</span></a>
            </div>
        </div>
    </div>
</section>

<!-- ===== INVEST CTA ===== -->
<section id="invest" class="min-h-screen relative overflow-hidden flex items-center justify-center text-center">
    <div class="invest-bg"></div>
    <div class="invest-overlay"></div>
    <div class="relative z-10 px-4 sm:px-10 lg:px-12 py-16 sm:py-20 w-full max-w-5xl mx-auto">
        <div class="reveal">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="gold-divider-line"></div>
                <div class="gold-divider-diamond"></div>
                <div class="gold-divider-line right"></div>
            </div>
        </div>
        <p class="font-['Cormorant_Garamond'] italic font-light leading-[1.3] mx-auto mb-6 reveal" style="font-size:clamp(28px,5vw,64px);color:var(--cream);max-width:900px" data-en>"The sun rises from the sea here — and so does your fortune."</p>
        <p class="font-['Tiro_Bangla'] font-light leading-[1.5] mx-auto mb-6 reveal" style="font-size:clamp(20px,3.5vw,42px);color:var(--cream);max-width:900px; display:none" data-bn>"এখানে সূর্য সমুদ্র থেকে উদয় হয় — আর তেমনিভাবে উদয় হয় আপনার ভাগ্যও।"</p>

        <div class="flex justify-center items-baseline gap-4 my-12 reveal">
            <span class="font-['Cinzel'] text-[28px] line-through" style="color:rgba(232,220,200,.4)">৳5,00,000</span>
            <span class="font-['Cinzel'] leading-none" style="font-size:64px;color:var(--gold);text-shadow:0 0 40px rgba(40,172,226,.4)">৳4,00,000</span>
            <span class="font-['Cormorant_Garamond'] text-xl" style="color:rgba(232,220,200,.6)">/share</span>
        </div>

        <div class="inline-block px-5 py-2 mb-12 font-['Cinzel'] text-[11px] tracking-[.3em] reveal" style="background:var(--gold);color:var(--deep-navy)" data-en>✦ SPOT BOOKING — 20% EXCLUSIVE DISCOUNT ✦</div>
        <div class="inline-block px-5 py-2 mb-12 font-['Tiro_Bangla'] text-[11px] tracking-[.3em] reveal" style="background:var(--gold);color:var(--deep-navy); display:none" data-bn>✦ স্পট বুকিং — ২০% বিশেষ ছাড় ✦</div>

        <p class="font-['Cormorant_Garamond'] text-[22px] italic mx-auto mb-12 reveal" style="color:rgba(232,220,200,.6);max-width:600px" data-en>Limited shares. Unlimited legacy. The sea does not wait — and neither should you.</p>
        <p class="font-['Tiro_Bangla'] text-[17px] mx-auto mb-12 reveal" style="color:rgba(232,220,200,.6);max-width:600px; display:none" data-bn>সীমিত শেয়ার। অসীম উত্তরাধিকার। সমুদ্র অপেক্ষা করে না।</p>

        <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 justify-center items-center flex-wrap reveal">
            <a href="form.html" class="btn-gold w-full sm:w-auto text-center"><span data-en>Reserve My Share Now</span><span data-bn style="display:none">এখনই শেয়ার সংরক্ষণ করুন</span></a>
            <a href="tel:+8801994045693" class="btn-outline w-full sm:w-auto text-center" data-en>Speak to an Advisor</a>
            <a href="tel:+8801994045693" class="btn-outline w-full sm:w-auto text-center" data-bn style="display:none">পরামর্শকের সাথে কথা বলুন</a>
        </div>
    </div>
</section>

<!-- ===== BRAND ===== -->
<section id="brand" class="min-h-screen relative overflow-hidden py-16 sm:py-20 lg:py-24" style="background:#04080F">
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2px]">
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[36px]">🏗️</span><div class="font-['Cinzel'] text-[13px] tracking-[.1em] font-medium" style="color:var(--cream)">Alliance Builders Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[36px]">📊</span><div class="font-['Cinzel'] text-[13px] tracking-[.1em] font-medium" style="color:var(--cream)">Alliance Brokerage Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[36px]">🏆</span><div class="font-['Cinzel'] text-[13px] tracking-[.1em] font-medium" style="color:var(--cream)">Alliance Success Builders Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[36px]">🏛️</span><div class="font-['Cinzel'] text-[13px] tracking-[.1em] font-medium" style="color:var(--cream)">Alliance Construction Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[36px]">🌊</span><div class="font-['Cinzel'] text-[13px] tracking-[.1em] font-medium" style="color:var(--cream)">Hotel Jana Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
            <div class="flex flex-col items-center gap-3 p-9 text-center border transition-all duration-[400ms] hover:border-[rgba(40,172,226,0.25)] reveal" style="background:rgba(13,33,55,.3);border-color:rgba(40,172,226,.08)"><span class="text-[36px]">🍃</span><div class="font-['Cinzel'] text-[13px] tracking-[.1em] font-medium" style="color:var(--cream)">Alliance Food &amp; Beverage Ltd.</div><div class="w-1 h-1 rounded-full mx-auto mt-1" style="background:var(--gold)"></div></div>
        </div>

        <div class="gold-line-deco reveal"></div>

        <div class="text-center pb-5 reveal">
            <p class="font-['Cormorant_Garamond'] text-[18px] tracking-[.1em]" style="color:rgba(232,220,200,.45)" data-en>www.alliancebuilders.org &nbsp;·&nbsp; www.hoteljanabd.com</p>
            <p class="font-['Tiro_Bangla'] text-[15px] mt-1" style="color:rgba(232,220,200,.45); display:none" data-bn>www.alliancebuilders.org &nbsp;·&nbsp; www.hoteljanabd.com</p>
        </div>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<div id="contact" class="py-12 px-6 sm:px-10 lg:px-12 border-t" style="background:rgba(40,172,226,.06);border-color:rgba(40,172,226,.2)">
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
                <a href="tel:+8801994045705">+88 01994 045705</a><br>
                <a href="/cdn-cgi/l/email-protection#bddccedcd9fddcd1d1d4dcd3ded8dfc8d4d1d9d8cfced1c9d993d2cfda"><span class="__cf_email__" data-cfemail="38594b595c785954545159565b5d5a4d51545c5d4a4b544c5c16574a5f">[email&#160;protected]</span></a>
            </div>
        </div>
    </div>
</div>

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
