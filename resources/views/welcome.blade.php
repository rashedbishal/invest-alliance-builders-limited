@php
    /*
     | Hotel Jana — single-page site ("Horizon Editorial").
     | Frontend only. Hotels, prices, limits and rates come from the existing backend
     | configuration; payments go through the existing SSLCommerz (/pay-via-ajax) and
     | PayPal (paypal.create) endpoints unchanged.
     */
    $hotels = app(\App\Services\Booking\ShareCatalog::class)->hotels();
    $sslLimit = (float) config('shares.sslcommerz_limit');
    $paypalRate = app(\App\Services\Payment\PayPalRate::class)->chargeRate(); // same rate the PayPal order is created with
    $paypalCurrency = (string) config('paypal.currency', 'USD');

    $img = fn ($path) => Vite::asset('resources/images/' . $path);
    $money = fn ($n) => number_format((float) $n, 0, '.', ',');
    // A price. Rendered in BDT on the server; site.js swaps the visitor's local currency into the
    // main figure and keeps the BDT amount beside it in small type (BDT alone in Bangladesh).
    $price = fn ($n, string $attrs = '', bool $inline = false) =>
        '<span class="money' . ($inline ? ' money--inline' : '') . '" data-bdt="' . (float) $n . '"' . ($attrs ? ' ' . $attrs : '') . '>'
        . '<span class="money__main"><span class="ccy">BDT</span><span class="money__num">' . $money($n) . '</span></span>'
        . '<span class="money__alt" hidden>BDT ' . $money($n) . '</span></span>';

    // Presentation for each bookable hotel key from the share catalog.
    $present = [
        'jana' => [
            'eyebrowEn' => 'Five-Star · Kuakata', 'eyebrowBn' => 'পাঁচ তারকা · কুয়াকাটা',
            'titleEn' => 'Hotel Jana Kuakata', 'titleBn' => 'হোটেল জানা কুয়াকাটা',
            'img' => $img('kuakata/entrance.webp'), 'pos' => '50% 42%', 'stars' => 5,
        ],
        'dove' => [
            'eyebrowEn' => "Four-Star · Cox's Bazar", 'eyebrowBn' => 'চার তারকা · কক্সবাজার',
            'titleEn' => 'Hotel Jana The Dove', 'titleBn' => 'হোটেল জানা দ্য ডাভ',
            'img' => $img('dove/dusk.webp'), 'pos' => '50% 38%', 'stars' => 4,
        ],
    ];
    $sharePrice = $hotels['jana']['price'] ?? ($hotels['dove']['price'] ?? null);

    $heroSlides = [
        ['src' => $img('kuakata/facade-west.webp'), 'pos' => '50% 52%', 'en' => 'Hotel Jana Kuakata', 'bn' => 'হোটেল জানা কুয়াকাটা'],
        ['src' => $img('dove/seafront.webp'), 'pos' => '50% 42%', 'en' => "Hotel Jana The Dove · Cox's Bazar", 'bn' => 'হোটেল জানা দ্য ডাভ · কক্সবাজার'],
        ['src' => $img('kuakata/aerial-pool.webp'), 'pos' => '50% 50%', 'en' => 'Hotel Jana Kuakata · Rooftop', 'bn' => 'হোটেল জানা কুয়াকাটা · ছাদ'],
        ['src' => $img('dove/rooftop-pool.webp'), 'pos' => '50% 45%', 'en' => 'Hotel Jana The Dove · Infinity Pool', 'bn' => 'হোটেল জানা দ্য ডাভ · ইনফিনিটি পুল'],
        ['src' => $img('kuakata/entrance.webp'), 'pos' => '50% 50%', 'en' => 'Hotel Jana Kuakata · Entrance', 'bn' => 'হোটেল জানা কুয়াকাটা · প্রবেশপথ'],
        ['src' => $img('dove/dusk.webp'), 'pos' => '50% 40%', 'en' => 'Hotel Jana The Dove · Dusk', 'bn' => 'হোটেল জানা দ্য ডাভ · গোধূলি'],
    ];

    // YouTube links → id + optional start time (t=…s is honoured when present in the link).
    $yt = function (string $url) {
        preg_match('~(?:youtu\.be/|v=|embed/|shorts/)([A-Za-z0-9_-]{11})~', $url, $m);
        preg_match('~[?&]t=(\d+)~', $url, $t);
        return ['id' => $m[1] ?? null, 'start' => isset($t[1]) ? (int) $t[1] : 0];
    };

    // Brand films (Hotel Jana YouTube channel).
    $films = array_map(fn ($f) => $f + $yt($f['url']), [
        ['url' => 'https://www.youtube.com/watch?v=OQ6oYAF_X4o', 'en' => 'Hotel Jana Kuakata', 'bn' => 'হোটেল জানা কুয়াকাটা', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা'],
        ['url' => 'https://www.youtube.com/watch?v=dAWP64KJwM4', 'en' => 'Hotel Jana The Dove', 'bn' => 'হোটেল জানা দ্য ডাভ', 'placeEn' => "Cox's Bazar", 'placeBn' => 'কক্সবাজার'],
        ['url' => 'https://www.youtube.com/watch?v=PPliWfowRYk', 'en' => 'The Beauty of Kuakata', 'bn' => 'কুয়াকাটার সৌন্দর্য', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা'],
        ['url' => 'https://www.youtube.com/watch?v=Wa3NH0oLBuM&t=317s', 'en' => "The Dove, Cox's Bazar", 'bn' => 'দ্য ডাভ, কক্সবাজার', 'placeEn' => "Cox's Bazar", 'placeBn' => 'কক্সবাজার'],
        ['url' => 'https://www.youtube.com/watch?v=G5QY3n0Nmhg', 'en' => 'Hotel Ownership', 'bn' => 'হোটেল মালিকানা', 'placeEn' => 'Hotel Jana', 'placeBn' => 'হোটেল জানা'],
        ['url' => 'https://www.youtube.com/watch?v=iW8IZNf5TfY', 'en' => 'Your Own Hotel', 'bn' => 'নিজের হোটেল, নিজের রাজত্ব', 'placeEn' => 'Hotel Jana', 'placeBn' => 'হোটেল জানা'],
        ['url' => 'https://www.youtube.com/watch?v=R-q5xIdN3dg', 'en' => 'The Brochure', 'bn' => 'ব্রোশিওর', 'placeEn' => 'Hotel Jana', 'placeBn' => 'হোটেল জানা'],
    ]);

    // Client testimonials (YouTube). Muted autoplay; the carousel advances when a set finishes.
    $testimonials = array_map(fn ($t) => $t + $yt($t['url']), [
        ['url' => 'https://www.youtube.com/watch?v=HWksqni05nc', 'en' => 'Client review', 'bn' => 'ক্লায়েন্ট রিভিউ'],
        ['url' => 'https://www.youtube.com/watch?v=R-_pYiWhdJU', 'en' => 'Client review', 'bn' => 'ক্লায়েন্ট রিভিউ'],
        ['url' => 'https://www.youtube.com/watch?v=XbuZks5_hzM', 'en' => 'Investing for tomorrow', 'bn' => 'আগামীর জন্য বিনিয়োগ'],
        ['url' => 'https://www.youtube.com/watch?v=Erbox3yoyVQ&t=16s', 'en' => 'A secure investment', 'bn' => 'নিরাপদ বিনিয়োগ'],
        ['url' => 'https://www.youtube.com/watch?v=-ANZYmOeq5g', 'en' => 'Investing for tomorrow', 'bn' => 'আগামীর জন্য বিনিয়োগ'],
    ]);

    $galleryPool = [
        ['src' => $img('kuakata/facade-east.webp'), 'pos' => '50% 50%', 'en' => 'Kuakata · The Façade', 'bn' => 'কুয়াকাটা · সম্মুখভাগ'],
        ['src' => $img('dove/tower-sunset.webp'), 'pos' => '50% 40%', 'en' => "The Dove · Sunset", 'bn' => 'দ্য ডাভ · সূর্যাস্ত'],
        ['src' => $img('kuakata/aerial-pool.webp'), 'pos' => '55% 50%', 'en' => 'Kuakata · Rooftop Pool', 'bn' => 'কুয়াকাটা · ছাদের পুল'],
        ['src' => $img('dove/pool-deck.webp'), 'pos' => '50% 50%', 'en' => 'The Dove · Pool Deck', 'bn' => 'দ্য ডাভ · পুল ডেক'],
        ['src' => $img('Reception-2.jpeg'), 'pos' => '50% 50%', 'en' => 'Hotel Jana · Lobby', 'bn' => 'হোটেল জানা · লবি'],
        ['src' => $img('dove/night.webp'), 'pos' => '50% 40%', 'en' => 'The Dove · By Night', 'bn' => 'দ্য ডাভ · রাতে'],
        ['src' => $img('kuakata/entrance.webp'), 'pos' => '50% 50%', 'en' => 'Kuakata · Entrance', 'bn' => 'কুয়াকাটা · প্রবেশপথ'],
        ['src' => $img('dove/marine-drive.webp'), 'pos' => '60% 45%', 'en' => 'The Dove · Marine Drive', 'bn' => 'দ্য ডাভ · মেরিন ড্রাইভ'],
        ['src' => $img('Suite.jpeg'), 'pos' => '55% 50%', 'en' => 'Hotel Jana · Suite', 'bn' => 'হোটেল জানা · স্যুইট'],
        ['src' => $img('kuakata/facade-west.webp'), 'pos' => '50% 50%', 'en' => 'Kuakata · West Façade', 'bn' => 'কুয়াকাটা · পশ্চিম সম্মুখভাগ'],
        ['src' => $img('dove/day.webp'), 'pos' => '50% 40%', 'en' => 'The Dove · By Day', 'bn' => 'দ্য ডাভ · দিনের আলোয়'],
        ['src' => $img('dove/rooftop-pool.webp'), 'pos' => '50% 50%', 'en' => 'The Dove · Infinity Pool', 'bn' => 'দ্য ডাভ · ইনফিনিটি পুল'],
        ['src' => $img('cafeteria-5.jpg'), 'pos' => '50% 50%', 'en' => 'Hotel Jana · Dining', 'bn' => 'হোটেল জানা · ডাইনিং'],
        ['src' => $img('dove/seafront.webp'), 'pos' => '50% 45%', 'en' => 'The Dove · Seafront', 'bn' => 'দ্য ডাভ · সমুদ্রতীর'],
        ['src' => $img('Reception.jpeg'), 'pos' => '40% 50%', 'en' => 'Hotel Jana · Reception', 'bn' => 'হোটেল জানা · রিসেপশন'],
        ['src' => $img('dove/dusk.webp'), 'pos' => '50% 40%', 'en' => 'The Dove · Dusk', 'bn' => 'দ্য ডাভ · গোধূলি'],
    ];

    $arrow = '<svg class="icon-arrow" viewBox="0 0 20 20" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg>';
    $star = '<svg viewBox="0 0 12 12"><path d="M6 .8l1.5 3.4 3.7.3-2.8 2.4.9 3.6L6 8.6 2.7 10.5l.9-3.6L.8 4.5l3.7-.3z"/></svg>';

    $flash = collect(['success', 'info', 'cancel', 'fail', 'error'])->first(fn ($k) => session()->has($k));
@endphp
<!DOCTYPE html>
<html lang="en" data-lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotel Jana — One step closer to paradise</title>
    <meta name="description" content="Hotel Jana Kuakata (Five-Star) and Hotel Jana The Dove, Cox's Bazar (Four-Star). Own a share of Hotel Jana.">
    <meta name="theme-color" content="#12132E">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:ital,wght@0,600;1,500&family=Manrope:wght@400..700&family=Newsreader:ital,opsz,wght@0,6..72,200..600;1,6..72,200..600&family=Noto+Sans+Bengali:wght@400..600&family=Noto+Serif+Bengali:wght@300..600&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="{{ $heroSlides[0]['src'] }}" fetchpriority="high">
    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>
<body>
<a class="skip-link" href="#invest"><x-t en="Skip to ownership" bn="মালিকানায় যান" /></a>

{{-- ============ HEADER ============ --}}
<header class="hdr" id="hdr">
    <span class="hdr__progress" aria-hidden="true"></span>
    <a class="hdr__logo" href="#top" aria-label="Hotel Jana — back to top">
        <img src="{{ $img('logo/jana-back.png') }}" alt="Hotel Jana" width="1000" height="1000">
    </a>
    <div class="hdr__right">
        <a class="btn btn--primary btn--sm hdr__cta btn--buy" href="#invest"><x-t en="Buy now" bn="এখনই কিনুন" /></a>
        <div class="lang" role="group" aria-label="Language / ভাষা">
            <button type="button" class="lang__btn" data-set-lang="en" aria-pressed="true">EN</button>
            <span class="lang__sep" aria-hidden="true"></span>
            <button type="button" class="lang__btn" data-set-lang="bn" lang="bn" aria-pressed="false">বাংলা</button>
        </div>
    </div>
</header>

<main>
{{-- ============ 01 HERO ============ --}}
<section class="hero" id="top" aria-roledescription="carousel" aria-label="Hotel Jana">
    <div class="hero__slides">
        @foreach ($heroSlides as $i => $slide)
            <figure class="hero__slide {{ $i === 0 ? 'is-active is-zoom' : '' }}" aria-hidden="{{ $i === 0 ? 'false' : 'true' }}">
                <img src="{{ $slide['src'] }}" alt="" style="object-position: {{ $slide['pos'] }}"
                     decoding="async" @if ($i === 0) fetchpriority="high" @else loading="lazy" fetchpriority="low" @endif>
                <template class="hero__slide-label"><x-t :en="$slide['en']" :bn="$slide['bn']" /></template>
            </figure>
        @endforeach
    </div>
    <div class="hero__shade" aria-hidden="true"></div>
    <div class="hero__frame" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
    <div class="hero__intro" aria-hidden="true"><span class="hero__intro-line"></span><span class="hero__intro-sun"></span></div>

    <p class="hero__coords" aria-hidden="true">
        <span>Kuakata&ensp;21°49′N&ensp;90°07′E</span><span class="hero__coords-sep"></span><span>Cox's Bazar&ensp;21°26′N&ensp;92°00′E</span>
    </p>

    <div class="hero__inner container" data-hero-content>
        <h1 class="hero__title">
            <span class="i18n-en"><span class="line"><span>Hotel Jana</span></span><span class="line line--place"><span>Kuakata &amp; Cox's Bazar</span></span></span>
            <span class="i18n-bn" lang="bn"><span class="line"><span>হোটেল জানা</span></span><span class="line line--place"><span>কুয়াকাটা ও কক্সবাজার</span></span></span>
        </h1>
        <p class="hero__slogan">
            <span class="rule" aria-hidden="true"></span>
            <span class="i18n-en">One step closer to <em class="scribble">paradise.<svg class="scribble__line" viewBox="0 0 320 26" preserveAspectRatio="none" aria-hidden="true"><path d="M4 17 C 52 7, 104 21, 160 13 S 262 6, 316 15"/></svg></em></span>
            <span class="i18n-bn" lang="bn">স্বর্গের আরও <em class="scribble">এক ধাপ কাছে।<svg class="scribble__line" viewBox="0 0 320 26" preserveAspectRatio="none" aria-hidden="true"><path d="M4 17 C 52 7, 104 21, 160 13 S 262 6, 316 15"/></svg></em></span>
        </p>
        <div class="hero__cta">
            <a class="btn btn--inverse btn--lg btn--buy" href="#invest" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a>
            @if ($sharePrice)
                <p class="hero__price"><x-t en="From" bn="শুরু" /> <strong>{!! $price($sharePrice, '', true) !!}</strong> <x-t en="per share" bn="প্রতি শেয়ার" /></p>
            @endif
        </div>
    </div>

    <div class="hero__meta">
        <p class="hero__count"><span data-hero-index>01</span><span class="hero__count-sep"></span>{{ str_pad(count($heroSlides), 2, '0', STR_PAD_LEFT) }}</p>
        <p class="hero__label" data-hero-label aria-live="polite"><x-t :en="$heroSlides[0]['en']" :bn="$heroSlides[0]['bn']" /></p>
        <div class="hero__ticks">
            @foreach ($heroSlides as $i => $slide)
                <button type="button" class="hero__tick {{ $i === 0 ? 'is-active' : '' }}" aria-label="Image {{ $i + 1 }} of {{ count($heroSlides) }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}"><span></span></button>
            @endforeach
        </div>
        <button type="button" class="hero__pause" aria-label="Pause slideshow" aria-pressed="false">
            <svg class="i-pause" viewBox="0 0 16 16" aria-hidden="true"><path d="M5 3v10M11 3v10" stroke="currentColor" stroke-width="1.5"/></svg>
            <svg class="i-play" viewBox="0 0 16 16" aria-hidden="true"><path d="M5 3l8 5-8 5z" fill="currentColor"/></svg>
        </button>
    </div>
    <a class="hero__scroll" href="#kuakata" aria-label="Scroll to Hotel Jana Kuakata"><span></span></a>
</section>

{{-- ============ 02 HOTEL JANA KUAKATA ============ --}}
<section class="property property--kuakata grain" id="kuakata" aria-labelledby="kuakata-title">
    <div class="property__grid">
        <div class="property__media" data-reveal="image-left">
            <figure class="property__main">
                <img src="{{ $img('kuakata/facade-west.webp') }}" alt="Hotel Jana Kuakata, the street façade" loading="lazy" style="object-position: 50% 55%" data-parallax>
            </figure>
            <figure class="property__detail">
                <img src="{{ $img('kuakata/aerial-pool.webp') }}" alt="Hotel Jana Kuakata from above, with the rooftop pool" loading="lazy" style="object-position: 42% 50%">
            </figure>
            <p class="property__credit"><x-t en="Architectural visualisation" bn="স্থাপত্য নকশার চিত্র" /></p>
        </div>

        <div class="property__content">
            <p class="eyebrow eyebrow--index" data-reveal><span class="idx">01</span><span class="rule" aria-hidden="true"></span><x-t en="Kuakata" bn="কুয়াকাটা" /></p>
            <h2 class="h-property" id="kuakata-title" data-reveal style="--d: 80ms"><x-t en="Hotel Jana <br>Kuakata" bn="হোটেল জানা <br>কুয়াকাটা" /></h2>
            <p class="rating" data-reveal style="--d: 160ms">
                <span class="rating__stars" aria-hidden="true">{!! str_repeat($star, 5) !!}</span>
                <x-t en="Five-Star Hotel" bn="পাঁচ তারকা হোটেল" />
            </p>
            <p class="coords" data-reveal style="--d: 200ms">21°49′ N<span></span>90°07′ E</p>
            <p class="lead lead--drop" data-reveal style="--d: 240ms">
                <x-t en="Kuakata is one of the rare beaches where the sun rises from the sea at dawn and returns to it at dusk. Hotel Jana stands at its heart — a place to let your leisure unfold by the seaside, in a hotel you own."
                     bn="কুয়াকাটা — পৃথিবীর বিরলতম উপহারগুলির একটি। একটি সৈকত যেখানে ভোরে সমুদ্র থেকে সূর্যের জন্ম হয় এবং সন্ধ্যায় সমুদ্রেই অস্ত যায়। আর সেখানেই দাঁড়িয়ে আছে হোটেল জানা — নিজ হোটেলে, প্রকৃতির সাথে।" />
            </p>
            <dl class="stats" data-reveal style="--d: 320ms">
                <div class="stat"><dt><x-t en="Star rating" bn="তারকা মান" /></dt><dd><span data-count="5">5</span><span class="stat__unit">★</span></dd></div>
                <div class="stat"><dt><x-t en="Rooms*" bn="কক্ষ*" /></dt><dd><span data-count="264">264</span></dd></div>
                <div class="stat"><dt><x-t en="Floors*" bn="তলা*" /></dt><dd><span data-count="12">12</span></dd></div>
            </dl>
            <p class="footnote"><x-t en="* Figures subject to confirmation of the final five-star specification." bn="* চূড়ান্ত পাঁচ তারকা নকশা অনুযায়ী তথ্য নিশ্চিত করা হবে।" /></p>
            @isset($hotels['jana'])
                <div class="property__invest" data-reveal style="--d: 400ms">
                    <div>
                        <p class="label-sm"><x-t en="Share price" bn="শেয়ার মূল্য" /></p>
                        <p class="price-inline">{!! $price($hotels['jana']['price']) !!}</p>
                    </div>
                    <a class="btn btn--primary btn--buy" href="#invest" data-preselect="jana" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a>
                </div>
            @endisset
        </div>
    </div>
</section>

{{-- ============ 03 HOTEL JANA THE DOVE ============ --}}
<section class="property property--dove grain" id="dove" aria-labelledby="dove-title">
    <div class="property__grid">
        <div class="property__content">
            <p class="eyebrow eyebrow--index" data-reveal><span class="idx">02</span><span class="rule" aria-hidden="true"></span><x-t en="Cox's Bazar" bn="কক্সবাজার" /></p>
            <h2 class="h-property" id="dove-title" data-reveal style="--d: 80ms"><x-t en="Hotel Jana <br><em>The Dove</em>" bn="হোটেল জানা <br><em>দ্য ডাভ</em>" /></h2>
            <p class="rating" data-reveal style="--d: 160ms">
                <span class="rating__stars" aria-hidden="true">{!! str_repeat($star, 4) !!}</span>
                <x-t en="Four-Star Hotel" bn="চার তারকা হোটেল" />
            </p>
            <p class="coords" data-reveal style="--d: 200ms">21°26′ N<span></span>92°00′ E</p>
            <p class="lead lead--drop" data-reveal style="--d: 240ms">
                <x-t en="On the shores of Cox's Bazar — the world's longest natural sea beach — Hotel Jana The Dove brings the same Hotel Jana hospitality to the Bay of Bengal."
                     bn="বিশ্বের দীর্ঘতম প্রাকৃতিক সমুদ্রসৈকত কক্সবাজারের তীরে হোটেল জানা দ্য ডাভ বঙ্গোপসাগরের পাড়ে নিয়ে আসছে হোটেল জানার একই আতিথেয়তা।" />
            </p>
            <dl class="stats" data-reveal style="--d: 320ms">
                <div class="stat"><dt><x-t en="Star rating" bn="তারকা মান" /></dt><dd><span data-count="4">4</span><span class="stat__unit">★</span></dd></div>
                <div class="stat stat--tbc"><dt><x-t en="Rooms" bn="কক্ষ" /></dt><dd><x-t en="To be announced" bn="শীঘ্রই ঘোষণা" /></dd></div>
                <div class="stat stat--tbc"><dt><x-t en="Floors" bn="তলা" /></dt><dd><x-t en="To be announced" bn="শীঘ্রই ঘোষণা" /></dd></div>
            </dl>
            @isset($hotels['dove'])
                <div class="property__invest" data-reveal style="--d: 400ms">
                    <div>
                        <p class="label-sm"><x-t en="Share price" bn="শেয়ার মূল্য" /></p>
                        <p class="price-inline">{!! $price($hotels['dove']['price']) !!}</p>
                    </div>
                    <a class="btn btn--primary btn--buy" href="#invest" data-preselect="dove" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a>
                </div>
            @endisset
        </div>

        <div class="property__media" data-reveal="image-right">
            <figure class="property__main">
                <img src="{{ $img('dove/seafront.webp') }}" alt="Hotel Jana The Dove on the Cox's Bazar seafront at sunset" loading="lazy" style="object-position: 50% 45%" data-parallax>
            </figure>
            <figure class="property__detail">
                <img src="{{ $img('dove/night.webp') }}" alt="Hotel Jana The Dove lit up at night" loading="lazy" style="object-position: 50% 35%">
            </figure>
            <p class="property__credit"><x-t en="Architectural visualisation" bn="স্থাপত্য নকশার চিত্র" /></p>
        </div>
    </div>
</section>

{{-- ============ 04 VIDEO GALLERY ============ --}}
<section class="films surface-dark" id="films" aria-labelledby="films-title">
    <div class="films__inner">
        <div class="films__head">
            <div>
                <p class="eyebrow eyebrow--index eyebrow--surf" data-reveal><span class="idx">03</span><span class="rule" aria-hidden="true"></span><x-t en="Films" bn="চলচ্চিত্র" /></p>
                <h2 class="h2" id="films-title" data-reveal style="--d: 80ms"><x-t en="Hotel Jana, <em>in motion</em>" bn="চলমান ছবিতে <em>হোটেল জানা</em>" /></h2>
            </div>
            <a class="btn btn--inverse btn--buy" href="#invest" data-reveal style="--d: 160ms" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a>
        </div>
    </div>

    {{-- The player and its thumbnail row together fill one screen height --}}
    <div class="films__screen" data-reveal>
        <div class="films__stage">
            <div class="player marks" data-player>
                <div class="player__stage">
                    <img class="player__poster" src="https://i.ytimg.com/vi/{{ $films[0]['id'] }}/maxresdefault.jpg" data-fallback="https://i.ytimg.com/vi/{{ $films[0]['id'] }}/hqdefault.jpg" alt="" loading="lazy">
                    <div class="player__yt" data-player-yt></div>
                    <div class="player__shade" aria-hidden="true"></div>
                    <button type="button" class="player__play" aria-label="Play film">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5.5v13l11-6.5z" fill="currentColor"/></svg>
                    </button>
                    <div class="player__caption" data-player-caption>
                        <p class="eyebrow eyebrow--inverse"><x-t :en="$films[0]['placeEn']" :bn="$films[0]['placeBn']" /></p>
                        <h3 class="player__title"><x-t :en="$films[0]['en']" :bn="$films[0]['bn']" /></h3>
                    </div>
                    <button type="button" class="player__unmute" data-player-unmute hidden>
                        <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3 8h3l4-3v10l-4-3H3zM13 8l4 4M17 8l-4 4" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
                        <x-t en="Tap for sound" bn="শব্দ চালু করুন" />
                    </button>
                </div>
            </div>

            <div class="thumbs" role="tablist" aria-label="Choose a film">
                @foreach ($films as $i => $film)
                    <button type="button" class="thumb {{ $i === 0 ? 'is-active' : '' }}" role="tab" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" tabindex="{{ $i === 0 ? '0' : '-1' }}"
                            data-id="{{ $film['id'] }}" data-start="{{ $film['start'] }}">
                        <span class="thumb__bar" aria-hidden="true"><span></span></span>
                        <span class="thumb__img"><img src="https://i.ytimg.com/vi/{{ $film['id'] }}/mqdefault.jpg" alt="" loading="lazy"><span class="thumb__n">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span></span>
                        <span class="thumb__title"><x-t :en="$film['en']" :bn="$film['bn']" /></span>
                        <template class="thumb__caption">
                            <p class="eyebrow eyebrow--inverse"><x-t :en="$film['placeEn']" :bn="$film['placeBn']" /></p>
                            <h3 class="player__title"><x-t :en="$film['en']" :bn="$film['bn']" /></h3>
                        </template>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============ 05 TESTIMONIALS ============ --}}
<section class="voices grain" id="testimonials" aria-labelledby="voices-title">
    <div class="container">
        <div class="section-head section-head--split">
            <div>
                <p class="eyebrow eyebrow--index" data-reveal><span class="idx">04</span><span class="rule" aria-hidden="true"></span><x-t en="Testimonials" bn="অভিজ্ঞতা" /></p>
                <h2 class="h2" id="voices-title" data-reveal style="--d: 80ms"><x-t en="In their <em>own words</em>" bn="তাঁদের <em>নিজের ভাষায়</em>" /></h2>
            </div>
            <div class="section-head__actions" data-reveal style="--d: 160ms">
                <div class="carousel-ctrl">
                    <p class="carousel-ctrl__count" aria-live="polite"><span data-voice-index>01</span> / {{ str_pad(count($testimonials), 2, '0', STR_PAD_LEFT) }}</p>
                    <button type="button" class="icon-btn" data-voice-prev aria-label="Previous testimonials"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M17 10H4M9 5l-5 5 5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg></button>
                    <button type="button" class="icon-btn" data-voice-next aria-label="Next testimonials"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg></button>
                </div>
                <a class="btn btn--primary btn--buy" href="#invest" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a>
            </div>
        </div>
    </div>

    <div class="voices__viewport container">
        <div class="voices__track" data-voice-track role="region" aria-label="Testimonial videos" tabindex="0">
            @foreach ($testimonials as $i => $t)
                <article class="voice" data-yt="{{ $t['id'] }}" data-start="{{ $t['start'] }}" aria-label="Testimonial {{ $i + 1 }} of {{ count($testimonials) }}">
                    <div class="voice__media">
                        <img class="voice__poster" src="https://i.ytimg.com/vi/{{ $t['id'] }}/hqdefault.jpg" alt="" loading="lazy">
                        <div class="voice__player" data-voice-player></div>
                        <span class="voice__play" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 5.5v13l11-6.5z" fill="currentColor"/></svg></span>
                        <button type="button" class="voice__sound" data-voice-sound aria-pressed="false" aria-label="Turn sound on">
                            <svg class="i-muted" viewBox="0 0 20 20" aria-hidden="true"><path d="M3 8h3l4-3v10l-4-3H3zM13 8l4 4M17 8l-4 4" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
                            <svg class="i-sound" viewBox="0 0 20 20" aria-hidden="true"><path d="M3 8h3l4-3v10l-4-3H3zM13.5 7.5a3.5 3.5 0 010 5M15.5 5.5a6.5 6.5 0 010 9" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
                        </button>
                        <span class="voice__progress" aria-hidden="true"><span></span></span>
                    </div>
                    <div class="voice__meta">
                        <p class="voice__index">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <div>
                            <h3 class="voice__name"><x-t :en="$t['en']" :bn="$t['bn']" /></h3>
                            <p class="voice__role"><x-t en="Hotel Jana" bn="হোটেল জানা" /></p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ 06 IMAGE GALLERY ============ --}}
<section class="gallery surface-dark" id="gallery" aria-labelledby="gallery-title">
    <div class="container section-head section-head--split">
        <div>
            <p class="eyebrow eyebrow--index eyebrow--surf" data-reveal><span class="idx">05</span><span class="rule" aria-hidden="true"></span><x-t en="Gallery" bn="গ্যালারি" /></p>
            <h2 class="h2" id="gallery-title" data-reveal style="--d: 80ms"><x-t en="Moments at <em>Hotel Jana</em>" bn="হোটেল জানার <em>মুহূর্তগুলো</em>" /></h2>
        </div>
        <div class="section-head__actions" data-reveal style="--d: 160ms">
            <button type="button" class="text-btn text-btn--inverse" data-gallery-pause aria-pressed="false">
                <span data-when="playing"><x-t en="Pause" bn="থামান" /></span>
                <span data-when="paused"><x-t en="Play" bn="চালু করুন" /></span>
            </button>
            <a class="btn btn--inverse btn--buy" href="#invest" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a>
        </div>
    </div>

    <div class="gallery__grid" data-gallery data-pool="{{ json_encode($galleryPool) }}" data-reveal>
        @foreach ([0, 1, 2, 3, 4] as $slot)
            @php $g = $galleryPool[$slot]; @endphp
            <figure class="tile tile--{{ $slot }}" data-idx="{{ $slot }}">
                <img class="tile__img is-active" src="{{ $g['src'] }}" alt="" loading="lazy" style="object-position: {{ $g['pos'] }}">
                <figcaption class="tile__cap"><x-t :en="$g['en']" :bn="$g['bn']" /></figcaption>
            </figure>
        @endforeach
    </div>
</section>

{{-- ============ 07 PRIVILEGE CARD ============ --}}
<section class="privilege grain" id="privilege" aria-labelledby="privilege-title">
    <div class="container privilege__grid">
        <div class="privilege__stage" data-reveal>
            <i class="marks__c" aria-hidden="true"></i><i class="marks__c" aria-hidden="true"></i><i class="marks__c" aria-hidden="true"></i><i class="marks__c" aria-hidden="true"></i>
            <button type="button" class="gcards" data-gcards data-tilt aria-label="Show the other side of the Privilege Card">
                {{-- Back: terms --}}
                <span class="gcard gcard--back">
                    <span class="gcard__shine" aria-hidden="true"></span>
                    <span class="gcard__in gcard__in--back">
                        <span class="gcard__terms-title">Terms &amp; Conditions</span>
                        <span class="gcard__terms">
                            <span>✦ 25% Discount — On Published Room Tariff</span>
                            <span>✦ 25% Discount — Restaurant Dining &amp; Packed Orders <em>(on the bill excluding taxes)</em></span>
                            <span>✦ 15% Discount — Ayurvedic Spa Treatments</span>
                            <span>✦ 10% Discount — In-room Dining Service</span>
                            <span>✦ Conditions Apply</span>
                            <span class="gcard__small">The card does not entitle any privilege in banqueting, conferences, special events &amp; promotions. Blackout dates &amp; house rules apply.</span>
                        </span>
                        <span class="gcard__contact">+88 01896 204401 · asad@alliancebuildersltd.org · alliancebuilders.org</span>
                    </span>
                </span>
                {{-- Front --}}
                <span class="gcard gcard--front">
                    <span class="gcard__shine" aria-hidden="true"></span>
                    <span class="gcard__in">
                        <span class="gcard__row">
                            <span>
                                <span class="gcard__brand">HOTEL JANA</span>
                                <span class="gcard__name">Privilege Card</span>
                            </span>
                            <span class="gcard__tier-wrap">
                                <span class="gcard__tier">GOLD</span>
                                <span class="gcard__chip" aria-hidden="true">@for ($c = 0; $c < 9; $c++)<i></i>@endfor</span>
                            </span>
                        </span>
                        <span class="gcard__wave" aria-hidden="true"></span>
                        <span class="gcard__row gcard__row--end">
                            <span>
                                <span class="gcard__label">Card Holder</span>
                                <span class="gcard__holder">Mr. Farhad</span>
                                <span class="gcard__number">2024 0089 6654 0321</span>
                            </span>
                            <span class="gcard__mark">JANA</span>
                        </span>
                    </span>
                </span>
            </button>
            <p class="privilege__hint"><x-t en="Tap the card to view the terms" bn="শর্তাবলি দেখতে কার্ডে ট্যাপ করুন" /></p>
        </div>

        <div class="privilege__content">
            <p class="eyebrow eyebrow--index" data-reveal><span class="idx">06</span><span class="rule" aria-hidden="true"></span><x-t en="The Privilege Card" bn="প্রিভিলেজ কার্ড" /></p>
            <h2 class="h2" id="privilege-title" data-reveal style="--d: 80ms"><x-t en="Your key to a life of <em>unlimited privilege</em>" bn="সীমাহীন সুবিধার <em>জীবনের চাবিকাঠি</em>" /></h2>
            <p class="lead" data-reveal style="--d: 160ms">
                <x-t en="As a Hotel Jana shareholder, you receive a personal Privilege Card — access to curated privileges across the hotel, reserved for our shareholders."
                     bn="হোটেল জানার শেয়ারহোল্ডার হিসেবে আপনি পাবেন একটি ব্যক্তিগত প্রিভিলেজ কার্ড — শুধুমাত্র শেয়ারহোল্ডারদের জন্য হোটেলজুড়ে বিশেষ সুবিধা।" />
            </p>
            <ul class="perks" data-reveal style="--d: 240ms">
                <li class="perk"><span class="perk__value">25%</span><span class="perk__text"><x-t en="Published room tariff" bn="রুম ট্যারিফে ছাড়" /></span></li>
                <li class="perk"><span class="perk__value">25%</span><span class="perk__text"><x-t en="Restaurant dining &amp; packed orders" bn="রেস্তোরাঁ ও প্যাকড অর্ডারে ছাড়" /><small><x-t en="On the bill, excluding taxes" bn="বিলের উপর, কর ব্যতীত" /></small></span></li>
                <li class="perk"><span class="perk__value">15%</span><span class="perk__text"><x-t en="Ayurvedic spa treatments" bn="আয়ুর্বেদিক স্পায় ছাড়" /></span></li>
                <li class="perk"><span class="perk__value">10%</span><span class="perk__text"><x-t en="In-room dining service" bn="ইন-রুম ডাইনিংয়ে ছাড়" /></span></li>
            </ul>
            <p class="fineprint" data-reveal style="--d: 320ms">
                <x-t en="Conditions apply. The card does not entitle any privilege in banqueting, conferences, special events &amp; promotions. Blackout dates &amp; house rules apply."
                     bn="শর্ত প্রযোজ্য। ব্যাংকোয়েটিং, কনফারেন্স, বিশেষ ইভেন্ট ও প্রমোশনে প্রযোজ্য নয়। ব্ল্যাকআউট তারিখ ও হাউস রুলস প্রযোজ্য।" />
            </p>
            <div data-reveal style="--d: 400ms"><a class="btn btn--primary btn--buy" href="#invest" data-magnetic><x-t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}</a></div>
        </div>
    </div>
</section>

{{-- ============ 08 OWNERSHIP ============ --}}
<section class="invest grain" id="invest" aria-labelledby="invest-title">
    {{-- Block A: the two shares, side by side, sized to one screen --}}
    <div class="invest__select">
        <div class="container">
            <div class="section-head section-head--split invest__head">
                <div>
                    <p class="eyebrow eyebrow--index" data-reveal><span class="idx">07</span><span class="rule" aria-hidden="true"></span><x-t en="Ownership" bn="মালিকানা" /></p>
                    <h2 class="h2" id="invest-title" data-reveal style="--d: 80ms"><x-t en="Own a share of <em>Hotel Jana</em>" bn="হোটেল জানার <em>শেয়ারের মালিক হোন</em>" /></h2>
                </div>
                <div class="invest__tools" data-reveal style="--d: 160ms">
                    <ol class="steps" aria-label="Steps">
                        <li class="steps__item" data-step="1"><span class="steps__n">01</span><x-t en="Select shares" bn="শেয়ার নির্বাচন" /></li>
                        <li class="steps__item" data-step="2"><span class="steps__n">02</span><x-t en="Your details" bn="আপনার তথ্য" /></li>
                        <li class="steps__item" data-step="3"><span class="steps__n">03</span><x-t en="Payment" bn="পেমেন্ট" /></li>
                    </ol>
                    <div class="ccy-inline">
                        <span class="label-sm"><x-t en="Show prices in" bn="মূল্য দেখান" /></span>
                        <div class="picker picker--light picker--compact" data-picker="currency" data-value="BDT" data-label="Display currency"></div>
                    </div>
                </div>
            </div>

            @if (empty($hotels))
                <div class="panel invest__closed">
                    <h3 class="h3"><x-t en="Share booking is currently closed." bn="শেয়ার বুকিং বর্তমানে বন্ধ আছে।" /></h3>
                    <p class="lead"><x-t en="Please contact us for availability." bn="প্রাপ্যতা জানতে আমাদের সাথে যোগাযোগ করুন।" /></p>
                </div>
            @else
                <div class="products">
                    @foreach ($hotels as $key => $hotel)
                        @php $p = $present[$key] ?? ['eyebrowEn' => $hotel['name'], 'eyebrowBn' => $hotel['name_bn'], 'titleEn' => $hotel['name'], 'titleBn' => $hotel['name_bn'], 'img' => $img('swimming-pool-2.jpeg'), 'pos' => '50% 50%', 'stars' => 0]; @endphp
                        <article class="product" data-product="{{ $key }}" data-reveal style="--d: {{ $loop->index * 140 }}ms" aria-labelledby="product-{{ $key }}">
                            <figure class="product__media">
                                <img src="{{ $p['img'] }}" alt="" loading="lazy" style="object-position: {{ $p['pos'] }}">
                                <span class="product__tag"><x-t :en="$p['eyebrowEn']" :bn="$p['eyebrowBn']" /></span>
                                <span class="product__check" aria-hidden="true"><svg viewBox="0 0 12 12"><path d="M2.5 6.2l2.3 2.3 4.7-5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg></span>
                            </figure>
                            <div class="product__body">
                                <div class="product__top">
                                    <h3 class="product__title" id="product-{{ $key }}"><x-t :en="$p['titleEn']" :bn="$p['titleBn']" /></h3>
                                    @if (! empty($p['stars']))<span class="rating__stars product__stars" aria-label="{{ $p['stars'] }}-star">{!! str_repeat($star, $p['stars']) !!}</span>@endif
                                </div>
                                <div class="product__terms">
                                    <div>
                                        <p class="label-sm"><x-t en="Price per share" bn="প্রতি শেয়ারের মূল্য" /></p>
                                        <p class="price">{!! $price($hotel['price']) !!}</p>
                                    </div>
                                    <div class="product__limit">
                                        <p class="label-sm"><x-t en="Per booking" bn="প্রতি বুকিংয়ে" /></p>
                                        <p class="product__limit-val"><x-t :en="'Up to ' . $money($hotel['max'])" :bn="'সর্বোচ্চ ' . $money($hotel['max'])" /></p>
                                    </div>
                                </div>
                                <div class="product__foot">
                                    <button type="button" class="btn btn--secondary btn--sm product__select" data-select><x-t en="Select share" bn="শেয়ার নির্বাচন" /></button>
                                    <div class="stepper" data-stepper hidden>
                                        <button type="button" class="stepper__btn" data-dec="{{ $key }}" aria-label="Decrease {{ $hotel['name'] }} shares"><svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h10" stroke="currentColor" stroke-width="1.5"/></svg></button>
                                        <input class="stepper__val" type="text" inputmode="numeric" pattern="[0-9]*" value="0" data-qty="{{ $key }}" aria-label="{{ $hotel['name'] }} share count">
                                        <button type="button" class="stepper__btn" data-inc="{{ $key }}" aria-label="Increase {{ $hotel['name'] }} shares"><svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h10M8 3v10" stroke="currentColor" stroke-width="1.5"/></svg></button>
                                    </div>
                                    <p class="product__sub"><span class="label-sm"><x-t en="Subtotal" bn="উপমোট" /></span><span class="product__sub-val">{!! $price(0, 'data-subtotal="' . e($key) . '"') !!}</span></p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @unless (empty($hotels))
    {{-- Block B: details and live summary, side by side --}}
    <div class="invest__checkout" id="checkout">
        <div class="container">
            <div class="horizon" data-reveal aria-hidden="true"><span class="horizon__line"></span><span class="horizon__sun"></span></div>
            <div class="order">
                <form class="order__form panel" novalidate data-checkout-form aria-labelledby="details-title" data-reveal>
                    <h3 class="order__title" id="details-title"><span class="order__n">02</span><x-t en="Your details" bn="আপনার তথ্য" /></h3>
                    <p class="order__sub"><x-t en="Your receipt and invoice will be sent to this contact." bn="আপনার রসিদ ও ইনভয়েস এই ঠিকানায় পাঠানো হবে।" /></p>
                    <div class="fields">
                        <div class="field field--full">
                            <label class="field__label" for="f-name"><x-t en="Full name" bn="পূর্ণ নাম" /> <span class="field__required" data-required-for="name"><x-t en="Required" bn="আবশ্যক" /></span></label>
                            <input class="input" id="f-name" name="name" type="text" autocomplete="name" maxlength="120" required aria-describedby="e-name">
                            <p class="field__error" id="e-name"><x-t en="Enter your full name using letters (at least 2)." bn="আপনার পূর্ণ নাম অক্ষরে লিখুন (কমপক্ষে ২টি অক্ষর)।" /></p>
                        </div>
                        <div class="field field--full">
                            <label class="field__label" for="f-phone" id="l-phone"><x-t en="Contact number" bn="যোগাযোগ নম্বর" /> <span class="field__required" data-required-for="phone"><x-t en="Required" bn="আবশ্যক" /></span></label>
                            <div class="phone">
                                <div class="picker picker--light picker--phone" data-picker="country" data-name="country_code" data-value="BD" data-label="Country calling code"></div>
                                <input class="input phone__num" id="f-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel-national" maxlength="15" required aria-describedby="e-phone" placeholder="1XXX XXXXXX">
                            </div>
                            <p class="field__error" id="e-phone"><x-t en="Enter a valid contact number." bn="সঠিক যোগাযোগ নম্বর লিখুন।" /></p>
                        </div>
                        <div class="field field--full">
                            <label class="field__label" for="f-email"><x-t en="Email" bn="ইমেইল" /> <span class="field__required" data-required-for="email"><x-t en="Required" bn="আবশ্যক" /></span></label>
                            <input class="input" id="f-email" name="email" type="email" autocomplete="email" maxlength="50" required aria-describedby="e-email">
                            <p class="field__error" id="e-email"><x-t en="Enter a valid email address." bn="সঠিক ইমেইল ঠিকানা লিখুন।" /></p>
                        </div>
                        <div class="field">
                            <label class="field__label" for="f-addr1"><x-t en="Address line 1" bn="ঠিকানা (লাইন ১)" /> <span class="field__required" data-required-for="address_1"><x-t en="Required" bn="আবশ্যক" /></span></label>
                            <input class="input" id="f-addr1" name="address_1" type="text" autocomplete="address-line1" maxlength="150" required aria-describedby="e-addr1">
                            <p class="field__error" id="e-addr1"><x-t en="Enter your address." bn="আপনার ঠিকানা লিখুন।" /></p>
                        </div>
                        <div class="field">
                            <label class="field__label" for="f-addr2"><x-t en="Address line 2" bn="ঠিকানা (লাইন ২)" /> <span class="field__opt"><x-t en="(optional)" bn="(ঐচ্ছিক)" /></span></label>
                            <input class="input" id="f-addr2" name="address_2" type="text" autocomplete="address-line2" maxlength="100">
                        </div>
                    </div>
                    {{-- Points the way to payment; site.js keeps it in step with the form --}}
                    <p class="order__next" data-order-next data-state="form">
                        <span class="order__next-text" data-order-next-text><x-t en="Complete these details" bn="এই তথ্যগুলো পূরণ করুন" /></span>
                        <svg class="order__next-arrow" viewBox="0 0 20 20" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg>
                    </p>
                </form>

                <aside class="summary" id="summary" aria-labelledby="summary-title" data-reveal style="--d: 120ms">
                    <h3 class="order__title" id="summary-title"><span class="order__n">03</span><x-t en="Summary &amp; payment" bn="সারসংক্ষেপ ও পেমেন্ট" /></h3>

                    <div class="summary__rows">
                        @foreach ($hotels as $key => $hotel)
                            @php $p = $present[$key] ?? ['titleEn' => $hotel['name'], 'titleBn' => $hotel['name_bn'], 'img' => $img('swimming-pool-2.jpeg'), 'pos' => '50% 50%']; @endphp
                            <div class="srow" data-srow="{{ $key }}">
                                <div class="srow__inner">
                                    <img class="srow__img" src="{{ $p['img'] }}" alt="" loading="lazy" style="object-position: {{ $p['pos'] }}">
                                    <div class="srow__info">
                                        <p class="srow__name"><x-t :en="$p['titleEn']" :bn="$p['titleBn']" /></p>
                                        <p class="srow__calc"><span data-srow-qty>0</span> × {!! $price($hotel['price'], '', true) !!}</p>
                                        <div class="srow__controls" aria-label="Adjust selected shares">
                                            <button type="button" class="srow__step" data-dec="{{ $key }}" aria-label="Decrease {{ $hotel['name'] }} shares">−</button>
                                            <button type="button" class="srow__step" data-inc="{{ $key }}" aria-label="Increase {{ $hotel['name'] }} shares">+</button>
                                            <button type="button" class="srow__remove" data-remove="{{ $key }}" aria-label="Remove {{ $hotel['name'] }} shares" title="Remove {{ $hotel['name'] }} shares"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 6h12M8 6V4h4v2m3 0-.7 10H5.7L5 6m3 3v4m4-4v4" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                                        </div>
                                    </div>
                                    <p class="srow__amt">{!! $price(0, 'data-srow-amt') !!}</p>
                                </div>
                            </div>
                        @endforeach
                        <p class="summary__empty" data-summary-empty>
                            <x-t en="No shares selected yet." bn="এখনও কোনো শেয়ার নির্বাচন করা হয়নি।" />
                            <a href="#invest"><x-t en="Choose above" bn="উপরে নির্বাচন করুন" /></a>
                        </p>
                    </div>

                    <div class="summary__total">
                        <div class="summary__total-row">
                            <p class="summary__total-label"><x-t en="Total" bn="মোট" /></p>
                            <p class="total" aria-live="polite">{!! $price(0, 'data-total') !!}</p>
                        </div>
                        <div class="summary__ccy">
                            <p class="summary__ccy-label"><x-t en="Show prices in" bn="মূল্য দেখান" /></p>
                            <div class="picker picker--dark picker--compact" data-picker="currency" data-value="BDT" data-label="Display currency"></div>
                        </div>
                        <p class="rate-note" data-rate-note hidden><x-t en="Converted at today's rate for reference only. You pay in BDT (SSLCommerz) or USD (PayPal)." bn="আজকের হারে শুধুমাত্র তথ্যের জন্য দেখানো হয়েছে। পেমেন্ট হবে BDT (SSLCommerz) বা USD (PayPal)-এ।" /></p>
                    </div>

                    {{-- Payment options are available after shares are chosen and details are complete --}}
                    <button type="button" class="paylock" id="paylock" data-paylock data-state="shares" aria-live="polite">
                        <span class="paylock__body">
                            <span class="paylock__title" data-paylock-title></span>
                            <span class="paylock__meter" data-paylock-meter aria-hidden="true"></span>
                            <span class="paylock__sub" data-paylock-sub></span>
                        </span>
                    </button>

                    <div class="paybtns" role="group" aria-label="Pay with" data-paybtns>
                        <div class="paybtn-wrap" data-method="sslcommerz" data-state="active">
                            <button type="button" class="paybtn paybtn--ssl" data-pay="sslcommerz" aria-describedby="paylock pay-help">
                                <span class="paybtn__label"><x-t en="Pay with" bn="পেমেন্ট করুন" /></span>
                                <img class="paybtn__logo" src="{{ $img('payment/sslcommerz.png') }}" alt="SSLCommerz" width="120" height="26">
                                <span class="spinner" aria-hidden="true"></span>
                            </button>
                            <p class="paybtn__note"><x-t en="Cards, mobile banking &amp; net banking · BDT" bn="কার্ড, মোবাইল ব্যাংকিং ও নেট ব্যাংকিং · BDT" /></p>
                            <p class="paybtn__reason"><x-t :en="'SSLCommerz allows up to ' . $price($sslLimit, '', true) . ' per transaction. Since this order exceeds the per-transaction limit, SSLCommerz cannot be used. Please pay with PayPal.'" :bn="'SSLCommerz-এ প্রতি লেনদেনে সর্বোচ্চ ' . $price($sslLimit, '', true) . ' পর্যন্ত পেমেন্ট করা যায়। এই অর্ডারটি প্রতি লেনদেনের সীমা ছাড়িয়ে যাওয়ায় SSLCommerz ব্যবহার করা যাবে না। অনুগ্রহ করে PayPal ব্যবহার করুন।'" /></p>
                        </div>
                        <div class="paybtn-wrap" data-method="paypal" data-state="{{ $paypalRate > 0 ? 'active' : 'unavailable' }}">
                            <button type="button" class="paybtn paybtn--paypal" data-pay="paypal" aria-describedby="paylock pay-help">
                                <span class="paybtn__label"><x-t en="Pay with" bn="পেমেন্ট করুন" /></span>
                                <img class="paybtn__logo" src="{{ $img('payment/paypal.svg') }}" alt="PayPal" width="88" height="25">
                                <span class="spinner" aria-hidden="true"></span>
                            </button>
                            <p class="paybtn__note" data-paypal-note><x-t :en="'International cards &amp; PayPal balance · ' . e($paypalCurrency)" :bn="'আন্তর্জাতিক কার্ড ও পেপ্যাল ব্যালেন্স · ' . e($paypalCurrency)" /></p>
                            <p class="paybtn__charge" data-paypal-charge hidden></p>
                            <p class="paybtn__reason"><x-t en="PayPal is not available right now." bn="PayPal এখন উপলব্ধ নয়।" /></p>
                        </div>
                        <div class="paybtn-wrap" data-method="bank" data-state="active">
                            <button type="button" class="paybtn paybtn--bank" data-pay="bank" aria-describedby="paylock pay-help">
                                <span class="paybtn__label"><x-t en="Pay with" bn="পেমেন্ট করুন" /></span>
                                <img class="paybtn__logo paybtn__logo--bank" src="{{ $img('payment/dbbl.png') }}" alt="" width="28" height="28">
                                <span class="paybtn__label"><x-t en="Dutch-Bangla Bank Limited" bn="ডাচ-বাংলা ব্যাংক লিমিটেড" /></span>
                                <span class="spinner" aria-hidden="true"></span>
                            </button>
                            <p class="paybtn__note"><x-t en="Bank transfer · pay manually, call for your receipt" bn="ব্যাংক ট্রান্সফার · নিজে পেমেন্ট করুন, রিসিটের জন্য কল করুন" /></p>
                        </div>
                    </div>
                    <p class="pay-help" id="pay-help" data-pay-help aria-live="polite"></p>
                    <p class="trust">
                        <svg viewBox="0 0 16 16" aria-hidden="true"><rect x="3" y="7" width="10" height="7" rx="1" fill="none" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 7V5a2.5 2.5 0 015 0v2" fill="none" stroke="currentColor" stroke-width="1.2"/></svg>
                        <x-t en="Encrypted checkout. Prices are confirmed by our server before payment." bn="এনক্রিপ্টেড চেকআউট। পেমেন্টের আগে আমাদের সার্ভার মূল্য নিশ্চিত করে।" />
                    </p>

                    {{-- SSLCommerz embed trigger (unchanged contract): the embed script hijacks this button and posts `postdata` to /pay-via-ajax --}}
                    <button id="sslczPayBtn" type="button" token="" postdata="" order=" " endpoint="{{ url('/pay-via-ajax') }}" style="display:none"></button>
                </aside>

                {{-- Dutch-Bangla Bank transfer: informational only — no payment is taken on this page. --}}
                <dialog class="modal modal--bank" data-bank-modal aria-labelledby="bank-modal-title">
                    <button type="button" class="modal__close" data-bank-modal-close aria-label="Close">
                        <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </button>
                    <div class="modal__icon modal__icon--bank" aria-hidden="true">
                        <img src="{{ $img('payment/dbbl.png') }}" alt="" width="44" height="44">
                    </div>
                    <h2 class="h3" id="bank-modal-title"><x-t en="Pay by bank transfer" bn="ব্যাংক ট্রান্সফারে পেমেন্ট করুন" /></h2>
                    <p class="modal__body modal__body--left">
                        <x-t en="Transfer your order amount to the account below, then call us to collect your money receipt."
                             bn="নিচের অ্যাকাউন্টে আপনার অর্ডারের পরিমাণ পাঠান, তারপর মানি রিসিট সংগ্রহ করতে আমাদের কল করুন।" />
                    </p>
                    @php
                        $copyIcon = fn (string $value, string $label) =>
                            '<button type="button" class="copy-btn" data-copy="' . e($value) . '" aria-label="' . e($label) . '">'
                            . '<svg class="copy-btn__icon copy-btn__icon--copy" viewBox="0 0 16 16" aria-hidden="true"><rect x="5.5" y="5.5" width="8" height="8" rx="1.2" fill="none" stroke="currentColor" stroke-width="1.3"/><path d="M3.5 10.5h-1a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v1" fill="none" stroke="currentColor" stroke-width="1.3"/></svg>'
                            . '<svg class="copy-btn__icon copy-btn__icon--check" viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8.5l3 3 7-7" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>'
                            . '</button>';
                    @endphp
                    <dl class="bank-details">
                        <div><dt><x-t en="Bank name" bn="ব্যাংকের নাম" /></dt><dd>Dutch-Bangla Bank Limited</dd></div>
                        <div><dt><x-t en="Account number" bn="অ্যাকাউন্ট নম্বর" /></dt><dd class="bank-details__value">{!! $copyIcon('164-1100071744', 'Copy account number') !!}<span>164-1100071744</span></dd></div>
                        <div><dt><x-t en="Branch" bn="শাখা" /></dt><dd>Mirpur Circle-10</dd></div>
                        <div><dt><x-t en="Routing number" bn="রাউটিং নম্বর" /></dt><dd class="bank-details__value">{!! $copyIcon('090263136', 'Copy routing number') !!}<span>090263136</span></dd></div>
                    </dl>
                    <p class="visually-hidden" role="status" aria-live="polite" data-copy-status></p>
                    <p class="modal__note">
                        <x-t en="After making the payment, to collect the money receipt, please call:" bn="পেমেন্ট করার পর, মানি রিসিট সংগ্রহ করতে কল করুন:" />
                        <span class="modal__note-numbers"><a href="tel:+8801896204431">+8801896-204431</a>, <a href="tel:+8801896204422">+8801896-204422</a></span>
                    </p>
                    <form method="dialog"><button class="btn btn--primary btn--block"><x-t en="Done" bn="সম্পন্ন" /></button></form>
                </dialog>
            </div>
        </div>
    </div>
    @endunless
</section>
</main>

{{-- ============ FOOTER ============ --}}
<footer class="footer surface-dark">
    <div class="container"><div class="horizon horizon--dark" aria-hidden="true"><span class="horizon__line"></span><span class="horizon__sun"></span></div></div>
    <div class="container footer__row">
        <div class="footer__brand">
            <img src="{{ $img('logo/jana-back.png') }}" alt="Hotel Jana" width="44" height="44" loading="lazy">
            <p class="footer__tag"><x-t en="One step closer to paradise." bn="স্বর্গের আরও এক ধাপ কাছে।" /></p>
        </div>
        <ul class="footer__links">
            <li><a href="tel:+8801994045693">+880 1994 045693</a></li>
            <li><a href="tel:+8801994045705">+880 1994 045705</a></li>
            <li><a href="mailto:asad@alliancebuildersltd.org">asad@alliancebuildersltd.org</a></li>
        </ul>
        <p class="footer__copy">© {{ date('Y') }} Hotel Jana Ltd.</p>
    </div>
</footer>

{{-- Mobile order bar --}}
<div class="orderbar" data-orderbar aria-hidden="true">
    <div>
        <p class="orderbar__count" data-orderbar-count></p>
        <p class="orderbar__total">{!! $price(0, 'data-orderbar-total', true) !!}</p>
    </div>
    <a class="btn btn--primary btn--sm" href="#summary" tabindex="-1"><x-t en="Pay now" bn="পেমেন্ট করুন" /></a>
</div>

{{-- Payment result from the existing SSLCommerz / PayPal redirects (session flash) --}}
@if ($flash)
    @php
        $isGood = in_array($flash, ['success', 'info'], true);
        $titles = [
            'success' => ['Payment successful', 'পেমেন্ট সফল হয়েছে'],
            'info' => [session('info_title', 'Already processed'), session('info_title') ? session('info_title') : 'ইতিমধ্যে সম্পন্ন'],
            'cancel' => ['Transaction cancelled', 'লেনদেন বাতিল হয়েছে'],
            'fail' => ['Payment failed', 'পেমেন্ট ব্যর্থ হয়েছে'],
            'error' => ['Transaction could not be verified', 'লেনদেন যাচাই করা যায়নি'],
        ];
        $body = match ($flash) {
            'success' => ['Thank you. One of our officials will contact you soon.', 'ধন্যবাদ। আমাদের একজন প্রতিনিধি শীঘ্রই আপনার সাথে যোগাযোগ করবেন।'],
            'fail' => [session('fail_reason', 'Your payment could not be completed. You have not been charged.'), session('fail_reason') ? session('fail_reason') : 'আপনার পেমেন্ট সম্পন্ন করা যায়নি।'],
            default => [session($flash), session($flash)],
        };
    @endphp
    <dialog class="modal modal--{{ $isGood ? 'good' : 'bad' }}" data-flash aria-labelledby="flash-title">
        <div class="modal__icon" aria-hidden="true">
            @if ($flash === 'success')
                <svg viewBox="0 0 48 48"><circle cx="24" cy="24" r="22.5" fill="none" stroke="currentColor"/><path d="M15 24.5l6 6 12-13" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
            @elseif ($flash === 'info')
                <svg viewBox="0 0 48 48"><circle cx="24" cy="24" r="22.5" fill="none" stroke="currentColor"/><path d="M24 21v13M24 14v2" stroke="currentColor" stroke-width="2"/></svg>
            @else
                <svg viewBox="0 0 48 48"><circle cx="24" cy="24" r="22.5" fill="none" stroke="currentColor"/><path d="M17 17l14 14M31 17L17 31" stroke="currentColor" stroke-width="1.8"/></svg>
            @endif
        </div>
        <h2 class="h3" id="flash-title"><x-t :en="e($titles[$flash][0])" :bn="e($titles[$flash][1])" /></h2>
        @if ($body[0])<p class="modal__body"><x-t :en="e($body[0])" :bn="e($body[1])" /></p>@endif
        <form method="dialog"><button class="btn btn--primary btn--block"><x-t en="Continue" bn="চালিয়ে যান" /></button></form>
    </dialog>
@endif

<script>
    // Server-side values for the ownership form (display + client-side guards only; the server re-prices every order).
    window.HOTEL_JANA = {
        hotels: @json($hotels),
        sslLimit: {{ $sslLimit }},
        paypal: { rate: {{ $paypalRate }}, currency: @json($paypalCurrency) },
        routes: { currency: @json(route('currency.show')), paypal: @json(route('paypal.create')), bankTransfer: @json(route('bank-transfer.notify')) },
    };
</script>

{{-- SSLCommerz embed (same loader as the booking form) --}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement('script'), tag = document.getElementsByTagName('script')[0];
            script.src = 'https://seamless-epay.sslcommerz.com/embed.min.js?' + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };
        window.addEventListener ? window.addEventListener('load', loader, false) : window.attachEvent('onload', loader);
    })(window, document);
</script>
</body>
</html>
