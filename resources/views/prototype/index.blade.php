@php
    /*
     | Phase 03 visual prototype. Frontend only: all commerce state below is mocked in
     | resources/js/prototype.js and is NOT connected to the SSLCommerz / PayPal backend.
     */
    $img = fn ($path) => Vite::asset('resources/images/' . $path);
    // Temporary coastal placeholders (no architecture) until Hotel Jana The Dove photography is supplied.
    $ph = fn ($id, $w = 1920) => "https://images.unsplash.com/photo-{$id}?w={$w}&q=80&auto=format&fit=crop";

    $heroSlides = [
        ['src' => $img('swimming-pool-2.jpeg'), 'pos' => '50% 55%', 'en' => 'Hotel Jana Kuakata', 'bn' => 'হোটেল জানা কুয়াকাটা', 'placeholder' => false],
        ['src' => $ph('1473116763249-2faaef81ccda'), 'pos' => '50% 60%', 'en' => "Hotel Jana The Dove · Cox's Bazar", 'bn' => 'হোটেল জানা দ্য ডোভ · কক্সবাজার', 'placeholder' => true],
        ['src' => $img('Reception-2.jpeg'), 'pos' => '50% 50%', 'en' => 'Hotel Jana Kuakata · Lobby', 'bn' => 'হোটেল জানা কুয়াকাটা · লবি', 'placeholder' => false],
        ['src' => $ph('1471922694854-ff1b63b20054'), 'pos' => '50% 55%', 'en' => "Hotel Jana The Dove · Cox's Bazar", 'bn' => 'হোটেল জানা দ্য ডোভ · কক্সবাজার', 'placeholder' => true],
        ['src' => $img('Suite.jpeg'), 'pos' => '50% 55%', 'en' => 'Hotel Jana Kuakata · Suite', 'bn' => 'হোটেল জানা কুয়াকাটা · স্যুইট', 'placeholder' => false],
    ];

    $films = [
        ['poster' => $img('swimming-pool-2.jpeg'), 'en' => 'The Kuakata Horizon', 'bn' => 'কুয়াকাটার দিগন্ত', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা', 'src' => null],
        ['poster' => $img('Reception-2.jpeg'), 'en' => 'Arrival', 'bn' => 'আগমন', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা', 'src' => null],
        ['poster' => $img('Suite.jpeg'), 'en' => 'Suite Living', 'bn' => 'স্যুইট', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা', 'src' => null],
        ['poster' => $ph('1473116763249-2faaef81ccda'), 'en' => 'Shoreline at Dusk', 'bn' => 'গোধূলির সৈকত', 'placeEn' => "Cox's Bazar", 'placeBn' => 'কক্সবাজার', 'src' => null],
        ['poster' => $img('swimming-pool.jpeg'), 'en' => 'Rooftop', 'bn' => 'ছাদ', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা', 'src' => null],
        ['poster' => $img('cafeteria-5.jpg'), 'en' => 'Dining', 'bn' => 'ডাইনিং', 'placeEn' => 'Kuakata', 'placeBn' => 'কুয়াকাটা', 'src' => null],
    ];

    // YouTube IDs are supplied later; null keeps the facade in its "pending" state.
    $testimonials = [
        ['poster' => $img('Reception.jpeg'), 'yt' => null],
        ['poster' => $img('Suite.jpeg'), 'yt' => null],
        ['poster' => $img('swimming-pool-2.jpeg'), 'yt' => null],
        ['poster' => $img('cafeteria-5.jpg'), 'yt' => null],
        ['poster' => $img('Reception-2.jpeg'), 'yt' => null],
        ['poster' => $img('swimming-pool.jpeg'), 'yt' => null],
    ];

    $galleryPool = [
        ['src' => $img('Hotel-Jana-resized.jpg.jpeg'), 'pos' => '50% 40%', 'en' => 'Kuakata · The Tower', 'bn' => 'কুয়াকাটা · ভবন'],
        ['src' => $img('Reception-2.jpeg'), 'pos' => '50% 50%', 'en' => 'Kuakata · Lobby', 'bn' => 'কুয়াকাটা · লবি'],
        ['src' => $img('Suite.jpeg'), 'pos' => '55% 50%', 'en' => 'Kuakata · Suite', 'bn' => 'কুয়াকাটা · স্যুইট'],
        ['src' => $img('swimming-pool.jpeg'), 'pos' => '50% 60%', 'en' => 'Kuakata · Rooftop Pool', 'bn' => 'কুয়াকাটা · ছাদের পুল'],
        ['src' => $img('cafeteria-5.jpg'), 'pos' => '50% 50%', 'en' => 'Kuakata · Dining', 'bn' => 'কুয়াকাটা · ডাইনিং'],
        ['src' => $img('swimming-pool-2.jpeg'), 'pos' => '50% 50%', 'en' => 'Kuakata · Sea Terrace', 'bn' => 'কুয়াকাটা · সমুদ্র টেরেস'],
        ['src' => $img('Reception.jpeg'), 'pos' => '40% 50%', 'en' => 'Kuakata · Reception', 'bn' => 'কুয়াকাটা · রিসেপশন'],
        ['src' => $ph('1473116763249-2faaef81ccda', 1600), 'pos' => '50% 60%', 'en' => "Cox's Bazar · Placeholder", 'bn' => 'কক্সবাজার · নমুনা ছবি'],
        ['src' => $ph('1471922694854-ff1b63b20054', 1600), 'pos' => '50% 50%', 'en' => "Cox's Bazar · Placeholder", 'bn' => 'কক্সবাজার · নমুনা ছবি'],
        ['src' => $ph('1507525428034-b723cf961d3e', 1600), 'pos' => '50% 50%', 'en' => "Cox's Bazar · Placeholder", 'bn' => 'কক্সবাজার · নমুনা ছবি'],
    ];

    $countries = [
        ['BD', '+880'], ['IN', '+91'], ['AE', '+971'], ['SA', '+966'], ['QA', '+974'], ['KW', '+965'], ['OM', '+968'],
        ['MY', '+60'], ['SG', '+65'], ['GB', '+44'], ['US', '+1'], ['CA', '+1'], ['AU', '+61'], ['IT', '+39'], ['DE', '+49'],
    ];

    $currencies = [
        'BDT' => 'Bangladeshi Taka', 'USD' => 'US Dollar', 'GBP' => 'British Pound', 'EUR' => 'Euro',
        'AED' => 'UAE Dirham', 'SAR' => 'Saudi Riyal', 'QAR' => 'Qatari Riyal', 'MYR' => 'Malaysian Ringgit',
        'SGD' => 'Singapore Dollar', 'CAD' => 'Canadian Dollar', 'AUD' => 'Australian Dollar', 'INR' => 'Indian Rupee',
    ];

    $arrow = '<svg class="icon-arrow" viewBox="0 0 20 20" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg>';
@endphp
<!DOCTYPE html>
<html lang="en" data-lang="en" class="show-notes">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Hotel Jana — One step closer to paradise</title>
    <meta name="description" content="Hotel Jana Kuakata and Hotel Jana The Dove, Cox's Bazar. Own a share of Hotel Jana.">
    <meta name="robots" content="noindex">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400..700&family=Newsreader:ital,opsz,wght@0,6..72,200..600;1,6..72,200..600&family=Noto+Sans+Bengali:wght@400..600&family=Noto+Serif+Bengali:wght@300..600&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="{{ $heroSlides[0]['src'] }}" fetchpriority="high">
    @vite(['resources/css/prototype.css', 'resources/js/prototype.js'])
</head>
<body>
<a class="skip-link" href="#invest"><x-proto.t en="Skip to ownership" bn="মালিকানায় যান" /></a>

{{-- ============ HEADER ============ --}}
<header class="hdr" id="hdr">
    <a class="hdr__logo" href="#top" aria-label="Hotel Jana — back to top">
        <img src="{{ $img('logo/jana-back.png') }}" alt="Hotel Jana" width="1000" height="1000">
    </a>
    <div class="lang" role="group" aria-label="Language / ভাষা">
        <button type="button" class="lang__btn" data-set-lang="en" aria-pressed="true">EN</button>
        <span class="lang__sep" aria-hidden="true"></span>
        <button type="button" class="lang__btn" data-set-lang="bn" lang="bn" aria-pressed="false">বাংলা</button>
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
                <template class="hero__slide-label">
                    <x-proto.t :en="$slide['en']" :bn="$slide['bn']" />
                    @if ($slide['placeholder'])<x-proto.note>Placeholder photo</x-proto.note>@endif
                </template>
            </figure>
        @endforeach
    </div>
    <div class="hero__shade" aria-hidden="true"></div>

    <div class="hero__inner container">
        <p class="eyebrow eyebrow--inverse" data-reveal><x-proto.t en="Hotel Jana" bn="হোটেল জানা" /></p>
        <h1 class="hero__title" data-reveal style="--d: 120ms">
            <x-proto.t en="One step closer <br>to <em>paradise.</em>" bn="স্বর্গের আরও <br><em>এক ধাপ কাছে।</em>" />
        </h1>
        <div data-reveal style="--d: 240ms">
            <a class="btn btn--inverse btn--lg" href="#invest">
                <x-proto.t en="Buy now" bn="এখনই কিনুন" />{!! $arrow !!}
            </a>
        </div>
    </div>

    <div class="hero__meta">
        <p class="hero__label" data-hero-label aria-live="polite">
            <x-proto.t :en="$heroSlides[0]['en']" :bn="$heroSlides[0]['bn']" />
        </p>
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
</section>

{{-- ============ 02 HOTEL JANA KUAKATA ============ --}}
<section class="property property--kuakata" id="kuakata" aria-labelledby="kuakata-title">
    <div class="property__grid">
        <div class="property__media" data-reveal="image-left">
            <figure class="property__main">
                <img src="{{ $img('swimming-pool.jpeg') }}" alt="Rooftop pool at Hotel Jana Kuakata overlooking the sea" loading="lazy" style="object-position: 50% 62%">
            </figure>
            <figure class="property__detail">
                <img src="{{ $img('Hotel-Jana-resized.jpg.jpeg') }}" alt="The Hotel Jana Kuakata tower" loading="lazy" style="object-position: 50% 30%">
            </figure>
            <p class="property__credit"><x-proto.t en="Architectural visualisation" bn="স্থাপত্য নকশার চিত্র" /></p>
        </div>

        <div class="property__content">
            <p class="eyebrow" data-reveal><x-proto.t en="Property 01 · Kuakata" bn="প্রপার্টি ০১ · কুয়াকাটা" /></p>
            <h2 class="h-property" id="kuakata-title" data-reveal style="--d: 80ms">
                <x-proto.t en="Hotel Jana <br>Kuakata" bn="হোটেল জানা <br>কুয়াকাটা" />
            </h2>
            <p class="rating" data-reveal style="--d: 160ms">
                <span class="rating__stars" aria-hidden="true">@for ($s = 0; $s < 5; $s++)<svg viewBox="0 0 12 12"><path d="M6 .8l1.5 3.4 3.7.3-2.8 2.4.9 3.6L6 8.6 2.7 10.5l.9-3.6L.8 4.5l3.7-.3z"/></svg>@endfor</span>
                <x-proto.t en="Five-Star Hotel" bn="পাঁচ তারকা হোটেল" />
            </p>
            <p class="lead" data-reveal style="--d: 240ms">
                <x-proto.t en="Kuakata is one of the rare beaches where the sun rises from the sea at dawn and returns to it at dusk. Hotel Jana stands at its heart — a place to let your leisure unfold by the seaside, in a hotel you own."
                           bn="কুয়াকাটা — পৃথিবীর বিরলতম উপহারগুলির একটি। একটি সৈকত যেখানে ভোরে সমুদ্র থেকে সূর্যের জন্ম হয় এবং সন্ধ্যায় সমুদ্রেই অস্ত যায়। আর সেখানেই দাঁড়িয়ে আছে হোটেল জানা — নিজ হোটেলে, প্রকৃতির সাথে।" />
                <x-proto.note>Copy adapted from current site</x-proto.note>
            </p>

            <dl class="stats" data-reveal style="--d: 320ms">
                <div class="stat"><dt><x-proto.t en="Star rating" bn="তারকা মান" /></dt><dd><span data-count="5">5</span><span class="stat__unit">★</span></dd></div>
                <div class="stat"><dt><x-proto.t en="Rooms*" bn="কক্ষ*" /></dt><dd><span data-count="264">264</span></dd></div>
                <div class="stat"><dt><x-proto.t en="Floors*" bn="তলা*" /></dt><dd><span data-count="12">12</span></dd></div>
            </dl>
            <p class="footnote"><x-proto.t en="* Figures from the current website, pending confirmation for the five-star specification." bn="* বর্তমান ওয়েবসাইট থেকে নেওয়া তথ্য, পাঁচ তারকা মান অনুযায়ী নিশ্চিত করা হবে।" /></p>

            <div class="property__invest" data-reveal style="--d: 400ms">
                <div>
                    <p class="label-sm"><x-proto.t en="Share price" bn="শেয়ার মূল্য" /></p>
                    <p class="price-inline"><span class="ccy">BDT</span> 400,000</p>
                </div>
                <a class="link-arrow" href="#invest" data-preselect="kuakata"><x-proto.t en="Invest in Kuakata" bn="কুয়াকাটায় বিনিয়োগ করুন" />{!! $arrow !!}</a>
            </div>
        </div>
    </div>
</section>

{{-- ============ 03 HOTEL JANA THE DOVE ============ --}}
<section class="property property--dove" id="dove" aria-labelledby="dove-title">
    <div class="property__grid">
        <div class="property__content">
            <p class="eyebrow" data-reveal><x-proto.t en="Property 02 · Cox's Bazar" bn="প্রপার্টি ০২ · কক্সবাজার" /></p>
            <h2 class="h-property" id="dove-title" data-reveal style="--d: 80ms">
                <x-proto.t en="Hotel Jana <br><em>The Dove</em>" bn="হোটেল জানা <br><em>দ্য ডোভ</em>" />
            </h2>
            <p class="rating" data-reveal style="--d: 160ms">
                <span class="rating__stars" aria-hidden="true">@for ($s = 0; $s < 4; $s++)<svg viewBox="0 0 12 12"><path d="M6 .8l1.5 3.4 3.7.3-2.8 2.4.9 3.6L6 8.6 2.7 10.5l.9-3.6L.8 4.5l3.7-.3z"/></svg>@endfor</span>
                <x-proto.t en="Four-Star Hotel" bn="চার তারকা হোটেল" />
            </p>
            <p class="lead" data-reveal style="--d: 240ms">
                <x-proto.t en="On the shores of Cox's Bazar, Hotel Jana The Dove brings the same Hotel Jana hospitality to the Bay of Bengal. Property details are being prepared and will be published here once confirmed."
                           bn="কক্সবাজারের সৈকতে হোটেল জানা দ্য ডোভ বঙ্গোপসাগরের তীরে নিয়ে আসছে হোটেল জানার একই আতিথেয়তা। প্রপার্টির বিস্তারিত তথ্য নিশ্চিত হলে এখানে প্রকাশ করা হবে।" />
                <x-proto.note>Temporary copy</x-proto.note>
            </p>

            <dl class="stats" data-reveal style="--d: 320ms">
                <div class="stat"><dt><x-proto.t en="Star rating" bn="তারকা মান" /></dt><dd><span data-count="4">4</span><span class="stat__unit">★</span></dd></div>
                <div class="stat stat--tbc"><dt><x-proto.t en="Rooms" bn="কক্ষ" /></dt><dd><x-proto.t en="To be confirmed" bn="নিশ্চিত করা হবে" /></dd></div>
                <div class="stat stat--tbc"><dt><x-proto.t en="Floors" bn="তলা" /></dt><dd><x-proto.t en="To be confirmed" bn="নিশ্চিত করা হবে" /></dd></div>
            </dl>

            <div class="property__invest" data-reveal style="--d: 400ms">
                <div>
                    <p class="label-sm"><x-proto.t en="Share price" bn="শেয়ার মূল্য" /></p>
                    <p class="price-inline"><span class="ccy">BDT</span> 400,000</p>
                </div>
                <a class="link-arrow" href="#invest" data-preselect="dove"><x-proto.t en="Invest in The Dove" bn="দ্য ডোভে বিনিয়োগ করুন" />{!! $arrow !!}</a>
            </div>
        </div>

        <div class="property__media" data-reveal="image-right">
            <figure class="property__main">
                <img src="{{ $ph('1473116763249-2faaef81ccda') }}" alt="" loading="lazy" style="object-position: 50% 58%">
                <x-proto.note class="note--on-media">Placeholder photo — The Dove photography pending</x-proto.note>
            </figure>
            <figure class="property__detail">
                <img src="{{ $ph('1507525428034-b723cf961d3e', 900) }}" alt="" loading="lazy" style="object-position: 62% 50%">
            </figure>
            <p class="property__credit"><x-proto.t en="Placeholder imagery" bn="নমুনা ছবি" /></p>
        </div>
    </div>
</section>

{{-- ============ 04 VIDEO GALLERY ============ --}}
<section class="films surface-dark" id="films" aria-labelledby="films-title">
    <div class="container section-head section-head--split">
        <div>
            <p class="eyebrow eyebrow--surf" data-reveal><x-proto.t en="Films" bn="চলচ্চিত্র" /></p>
            <h2 class="h2" id="films-title" data-reveal style="--d: 80ms"><x-proto.t en="Hotel Jana, <em>in motion</em>" bn="চলমান ছবিতে <em>হোটেল জানা</em>" /></h2>
        </div>
        <p class="section-head__aside" data-reveal style="--d: 160ms">
            <x-proto.t en="A selection of films from both properties." bn="দুটি প্রপার্টির নির্বাচিত ভিডিও।" />
            <x-proto.note>Placeholder posters · videos pending</x-proto.note>
        </p>
    </div>

    <div class="player-wrap" data-reveal>
        <div class="player" data-player>
            <div class="player__stage">
                @foreach ($films as $i => $film)
                    <img class="player__poster {{ $i === 0 ? 'is-active' : '' }}" src="{{ $film['poster'] }}" alt="" loading="lazy">
                @endforeach
                <video class="player__video" playsinline muted preload="none" hidden></video>
                <div class="player__shade" aria-hidden="true"></div>
                <button type="button" class="player__play" aria-label="Play film">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5.5v13l11-6.5z" fill="currentColor"/></svg>
                </button>
                <div class="player__caption" data-player-caption>
                    <p class="eyebrow eyebrow--inverse"><x-proto.t :en="$films[0]['placeEn']" :bn="$films[0]['placeBn']" /></p>
                    <h3 class="player__title"><x-proto.t :en="$films[0]['en']" :bn="$films[0]['bn']" /></h3>
                </div>
                <div class="player__pending" role="status">
                    <x-proto.t en="Final film to be supplied — placeholder preview" bn="চূড়ান্ত ভিডিও শীঘ্রই — নমুনা প্রদর্শন" />
                </div>
            </div>
        </div>

        <div class="thumbs" role="tablist" aria-label="Choose a film">
            @foreach ($films as $i => $film)
                <button type="button" class="thumb {{ $i === 0 ? 'is-active' : '' }}" role="tab" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" tabindex="{{ $i === 0 ? '0' : '-1' }}"
                        data-src="{{ $film['src'] }}">
                    <span class="thumb__bar" aria-hidden="true"></span>
                    <span class="thumb__img"><img src="{{ $film['poster'] }}" alt="" loading="lazy"></span>
                    <span class="thumb__title"><x-proto.t :en="$film['en']" :bn="$film['bn']" /></span>
                    <template class="thumb__caption">
                        <p class="eyebrow eyebrow--inverse"><x-proto.t :en="$film['placeEn']" :bn="$film['placeBn']" /></p>
                        <h3 class="player__title"><x-proto.t :en="$film['en']" :bn="$film['bn']" /></h3>
                    </template>
                </button>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ 05 TESTIMONIALS ============ --}}
<section class="voices" id="testimonials" aria-labelledby="voices-title">
    <div class="container">
        <div class="section-head section-head--split">
            <div>
                <p class="eyebrow" data-reveal><x-proto.t en="Testimonials" bn="অভিজ্ঞতা" /></p>
                <h2 class="h2" id="voices-title" data-reveal style="--d: 80ms"><x-proto.t en="In their <em>own words</em>" bn="তাঁদের <em>নিজের ভাষায়</em>" /></h2>
            </div>
            <div class="carousel-ctrl" data-reveal style="--d: 160ms">
                <p class="carousel-ctrl__count" aria-live="polite"><span data-voice-index>01</span> / {{ str_pad(count($testimonials), 2, '0', STR_PAD_LEFT) }}</p>
                <button type="button" class="icon-btn" data-voice-prev aria-label="Previous testimonials"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M17 10H4M9 5l-5 5 5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg></button>
                <button type="button" class="icon-btn" data-voice-next aria-label="Next testimonials"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg></button>
            </div>
        </div>
    </div>

    <div class="voices__viewport container">
        <div class="voices__track" data-voice-track role="region" aria-label="Testimonial videos" tabindex="0">
            @foreach ($testimonials as $i => $t)
                <article class="voice" aria-label="Testimonial {{ $i + 1 }} of {{ count($testimonials) }}">
                    <div class="voice__media">
                        <button type="button" class="voice__facade" data-yt="{{ $t['yt'] }}" aria-label="Play testimonial {{ $i + 1 }}">
                            <img src="{{ $t['poster'] }}" alt="" loading="lazy">
                            <span class="voice__play" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 5.5v13l11-6.5z" fill="currentColor"/></svg></span>
                        </button>
                        <p class="voice__pending" role="status"><x-proto.t en="YouTube link to be supplied" bn="ইউটিউব লিংক শীঘ্রই যুক্ত হবে" /></p>
                    </div>
                    <div class="voice__meta">
                        <p class="voice__index">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <div>
                            <h3 class="voice__name"><x-proto.t en="Name to be confirmed" bn="নাম নিশ্চিত করা হবে" /></h3>
                            <p class="voice__role"><x-proto.t en="Shareholder · Location to be confirmed" bn="শেয়ারহোল্ডার · স্থান নিশ্চিত করা হবে" /></p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <x-proto.note>Posters are placeholders — YouTube thumbnails replace them once links are supplied (youtube-nocookie facade)</x-proto.note>
    </div>
</section>

{{-- ============ 06 IMAGE GALLERY ============ --}}
<section class="gallery surface-dark" id="gallery" aria-labelledby="gallery-title">
    <div class="container section-head section-head--split">
        <div>
            <p class="eyebrow eyebrow--surf" data-reveal><x-proto.t en="Gallery" bn="গ্যালারি" /></p>
            <h2 class="h2" id="gallery-title" data-reveal style="--d: 80ms"><x-proto.t en="Moments at <em>Hotel Jana</em>" bn="হোটেল জানার <em>মুহূর্তগুলো</em>" /></h2>
        </div>
        <button type="button" class="text-btn text-btn--inverse" data-gallery-pause aria-pressed="false" data-reveal style="--d: 160ms">
            <span class="i18n-en" data-when="playing">Pause</span><span class="i18n-bn" lang="bn" data-when="playing">থামান</span>
            <span class="i18n-en" data-when="paused">Play</span><span class="i18n-bn" lang="bn" data-when="paused">চালু করুন</span>
        </button>
    </div>

    <div class="gallery__grid" data-gallery data-pool="{{ json_encode($galleryPool) }}" data-reveal>
        @foreach ([0, 1, 2, 3, 4] as $slot)
            @php $g = $galleryPool[$slot]; @endphp
            <figure class="tile tile--{{ $slot }}" data-idx="{{ $slot }}">
                <img class="tile__img is-active" src="{{ $g['src'] }}" alt="" loading="lazy" style="object-position: {{ $g['pos'] }}">
                <figcaption class="tile__cap"><x-proto.t :en="$g['en']" :bn="$g['bn']" /></figcaption>
            </figure>
        @endforeach
    </div>
</section>

{{-- ============ 07 PRIVILEGE CARD ============ --}}
<section class="privilege" id="privilege" aria-labelledby="privilege-title">
    <div class="container privilege__grid">
        <div class="privilege__stage" data-reveal>
            <div class="pcard" role="img" aria-label="Hotel Jana Privilege Card">
                <svg class="pcard__arc" viewBox="0 0 200 200" aria-hidden="true"><path d="M40 30 A 90 90 0 0 1 175 150" fill="none" stroke="currentColor" stroke-width="1"/></svg>
                <div class="pcard__top">
                    <p class="pcard__brand">HOTEL JANA</p>
                    <p class="pcard__name">Privilege Card</p>
                </div>
                <div class="pcard__rule" aria-hidden="true"></div>
                <div class="pcard__bottom">
                    <div>
                        <p class="pcard__label">Shareholder</p>
                        <p class="pcard__holder">Shareholder Name</p>
                        <p class="pcard__number">0000&ensp;0000&ensp;0000&ensp;0000</p>
                    </div>
                    <p class="pcard__mark">J</p>
                </div>
            </div>
            <p class="privilege__caption"><x-proto.t en="Illustrative card design" bn="কার্ডের নকশার নমুনা" /> <x-proto.note>Final card artwork to be approved</x-proto.note></p>
        </div>

        <div class="privilege__content">
            <p class="eyebrow" data-reveal><x-proto.t en="The Privilege Card" bn="প্রিভিলেজ কার্ড" /></p>
            <h2 class="h2" id="privilege-title" data-reveal style="--d: 80ms">
                <x-proto.t en="Your key to a life of <em>unlimited privilege</em>" bn="সীমাহীন সুবিধার <em>জীবনের চাবিকাঠি</em>" />
            </h2>
            <p class="lead" data-reveal style="--d: 160ms">
                <x-proto.t en="As a Hotel Jana shareholder, you receive a personal Privilege Card — access to curated privileges across the hotel, reserved for our shareholders."
                           bn="হোটেল জানার শেয়ারহোল্ডার হিসেবে আপনি পাবেন একটি ব্যক্তিগত প্রিভিলেজ কার্ড — শুধুমাত্র শেয়ারহোল্ডারদের জন্য হোটেলজুড়ে বিশেষ সুবিধা।" />
            </p>

            <ul class="perks" data-reveal style="--d: 240ms">
                <li class="perk"><span class="perk__value">25%</span><span class="perk__text"><x-proto.t en="Published room tariff" bn="রুম ট্যারিফে ছাড়" /></span></li>
                <li class="perk"><span class="perk__value">25%</span><span class="perk__text"><x-proto.t en="Restaurant dining &amp; packed orders" bn="রেস্তোরাঁ ও প্যাকড অর্ডারে ছাড়" /><small><x-proto.t en="On the bill, excluding taxes" bn="বিলের উপর, কর ব্যতীত" /></small></span></li>
                <li class="perk"><span class="perk__value">15%</span><span class="perk__text"><x-proto.t en="Ayurvedic spa treatments" bn="আয়ুর্বেদিক স্পায় ছাড়" /></span></li>
                <li class="perk"><span class="perk__value">10%</span><span class="perk__text"><x-proto.t en="In-room dining service" bn="ইন-রুম ডাইনিংয়ে ছাড়" /></span></li>
            </ul>
            <p class="fineprint" data-reveal style="--d: 320ms">
                <x-proto.t en="Conditions apply. The card does not entitle any privilege in banqueting, conferences, special events &amp; promotions. Blackout dates &amp; house rules apply."
                           bn="শর্ত প্রযোজ্য। ব্যাংকোয়েটিং, কনফারেন্স, বিশেষ ইভেন্ট ও প্রমোশনে প্রযোজ্য নয়। ব্ল্যাকআউট তারিখ ও হাউস রুলস প্রযোজ্য।" />
            </p>
            <x-proto.note>Privileges preserved from current site — confirm they apply to both properties</x-proto.note>
        </div>
    </div>
</section>

{{-- ============ 08 INVESTMENT PRODUCTS ============ --}}
<section class="invest" id="invest" aria-labelledby="invest-title">
    <div class="container">
        <div class="section-head section-head--split">
            <div>
                <p class="eyebrow" data-reveal><x-proto.t en="Ownership" bn="মালিকানা" /></p>
                <h2 class="h2" id="invest-title" data-reveal style="--d: 80ms"><x-proto.t en="Own a share of <em>Hotel Jana</em>" bn="হোটেল জানার <em>শেয়ারের মালিক হোন</em>" /></h2>
                <p class="lead lead--narrow" data-reveal style="--d: 160ms"><x-proto.t en="Two properties, one share price. Select one or both to continue." bn="দুটি প্রপার্টি, একই শেয়ার মূল্য। একটি বা দুটিই নির্বাচন করুন।" /></p>
            </div>
            <label class="ccy-inline" data-reveal style="--d: 240ms">
                <span class="label-sm"><x-proto.t en="Display currency" bn="প্রদর্শিত মুদ্রা" /></span>
                <select class="select select--compact" data-currency aria-label="Display currency">
                    @foreach ($currencies as $code => $name)<option value="{{ $code }}">{{ $code }} — {{ $name }}</option>@endforeach
                </select>
            </label>
        </div>

        <div class="products">
            @foreach ([
                ['key' => 'kuakata', 'img' => $img('Hotel-Jana-resized.jpg.jpeg'), 'pos' => '50% 28%', 'placeholder' => false,
                 'eyebrowEn' => 'Five-Star · Kuakata', 'eyebrowBn' => 'পাঁচ তারকা · কুয়াকাটা',
                 'titleEn' => 'Hotel Jana Kuakata <span class="nowrap">Share</span>', 'titleBn' => 'হোটেল জানা কুয়াকাটা শেয়ার',
                 'propEn' => 'Hotel Jana Kuakata', 'propBn' => 'হোটেল জানা কুয়াকাটা', 'catEn' => '5-Star hotel', 'catBn' => '৫ তারকা হোটেল', 'locEn' => 'Kuakata, Bangladesh', 'locBn' => 'কুয়াকাটা, বাংলাদেশ'],
                ['key' => 'dove', 'img' => $ph('1471922694854-ff1b63b20054', 1400), 'pos' => '50% 55%', 'placeholder' => true,
                 'eyebrowEn' => "Four-Star · Cox's Bazar", 'eyebrowBn' => 'চার তারকা · কক্সবাজার',
                 'titleEn' => "Hotel Jana The Dove — Cox's Bazar <span class=\"nowrap\">Share</span>", 'titleBn' => 'হোটেল জানা দ্য ডোভ — কক্সবাজার শেয়ার',
                 'propEn' => 'Hotel Jana The Dove', 'propBn' => 'হোটেল জানা দ্য ডোভ', 'catEn' => '4-Star hotel', 'catBn' => '৪ তারকা হোটেল', 'locEn' => "Cox's Bazar, Bangladesh", 'locBn' => 'কক্সবাজার, বাংলাদেশ'],
            ] as $n => $p)
                <article class="product" data-product="{{ $p['key'] }}" data-reveal style="--d: {{ $n * 120 }}ms" aria-labelledby="product-{{ $p['key'] }}">
                    <figure class="product__media">
                        <img src="{{ $p['img'] }}" alt="" loading="lazy" style="object-position: {{ $p['pos'] }}">
                        @if ($p['placeholder'])<x-proto.note class="note--on-media">Placeholder photo</x-proto.note>@endif
                    </figure>
                    <div class="product__body">
                        <div class="product__head">
                            <p class="eyebrow"><x-proto.t :en="$p['eyebrowEn']" :bn="$p['eyebrowBn']" /></p>
                            <span class="badge product__badge"><svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 6.2l2.3 2.3 4.7-5" fill="none" stroke="currentColor" stroke-width="1.5"/></svg><x-proto.t en="Selected" bn="নির্বাচিত" /></span>
                        </div>
                        <h3 class="product__title" id="product-{{ $p['key'] }}"><x-proto.t :en="$p['titleEn']" :bn="$p['titleBn']" /></h3>

                        <div class="product__price">
                            <p class="label-sm"><x-proto.t en="Price per share" bn="প্রতি শেয়ারের মূল্য" /></p>
                            <p class="price"><span class="ccy">BDT</span><span class="price__num">400,000</span></p>
                            <p class="approx" data-approx-unit hidden></p>
                        </div>

                        <dl class="facts">
                            <div><dt><x-proto.t en="Property" bn="প্রপার্টি" /></dt><dd><x-proto.t :en="$p['propEn']" :bn="$p['propBn']" /></dd></div>
                            <div><dt><x-proto.t en="Category" bn="ক্যাটাগরি" /></dt><dd><x-proto.t :en="$p['catEn']" :bn="$p['catBn']" /></dd></div>
                            <div><dt><x-proto.t en="Location" bn="অবস্থান" /></dt><dd><x-proto.t :en="$p['locEn']" :bn="$p['locBn']" /></dd></div>
                            <div><dt><x-proto.t en="Ownership terms" bn="মালিকানার শর্তাবলি" /></dt><dd class="is-tbc"><x-proto.t en="To be confirmed" bn="নিশ্চিত করা হবে" /></dd></div>
                        </dl>

                        <div class="product__foot">
                            <button type="button" class="btn btn--secondary product__select" data-select>
                                <x-proto.t en="Select" bn="নির্বাচন করুন" />
                            </button>
                            <div class="stepper" data-stepper hidden>
                                <button type="button" class="stepper__btn" data-dec aria-label="Decrease quantity"><svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h10" stroke="currentColor" stroke-width="1.5"/></svg></button>
                                <output class="stepper__val" data-qty aria-live="polite">0</output>
                                <button type="button" class="stepper__btn" data-inc aria-label="Increase quantity"><svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h10M8 3v10" stroke="currentColor" stroke-width="1.5"/></svg></button>
                            </div>
                            <div class="product__subtotal">
                                <p class="label-sm"><x-proto.t en="Subtotal" bn="উপমোট" /></p>
                                <p class="subtotal" data-subtotal><span class="ccy">BDT</span> 0</p>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <x-proto.note>No returns, dividends or guarantees shown — investment terms to be supplied and approved</x-proto.note>
    </div>
</section>

{{-- ============ 09 CHECKOUT ============ --}}
<section class="checkout" id="checkout" aria-labelledby="checkout-title">
    <div class="container">
        <div class="section-head">
            <p class="eyebrow" data-reveal><x-proto.t en="Checkout" bn="চেকআউট" /></p>
            <h2 class="h2" id="checkout-title" data-reveal style="--d: 80ms"><x-proto.t en="Complete your <em>ownership</em>" bn="আপনার <em>মালিকানা</em> সম্পন্ন করুন" /></h2>
        </div>

        <div class="checkout__grid">
            <form class="panel checkout__form" novalidate data-checkout-form aria-labelledby="details-title">
                <div class="panel__head">
                    <h3 class="h3" id="details-title"><x-proto.t en="Your details" bn="আপনার তথ্য" /></h3>
                    <p class="small muted"><x-proto.t en="All fields are required unless marked optional." bn="ঐচ্ছিক চিহ্নিত ছাড়া সব তথ্য আবশ্যক।" /></p>
                </div>

                <div class="field">
                    <label class="field__label" for="f-name"><x-proto.t en="Full name" bn="পূর্ণ নাম" /></label>
                    <input class="input" id="f-name" name="name" type="text" autocomplete="name" required aria-describedby="e-name">
                    <p class="field__error" id="e-name"><x-proto.t en="Enter your full name." bn="আপনার পূর্ণ নাম লিখুন।" /></p>
                </div>

                <div class="field">
                    <label class="field__label" for="f-phone"><x-proto.t en="Contact number" bn="যোগাযোগ নম্বর" /></label>
                    <div class="phone">
                        <select class="select phone__code" name="country_code" aria-label="Country code" autocomplete="tel-country-code">
                            @foreach ($countries as [$iso, $dial])<option value="{{ $dial }}" @selected($iso === 'BD')>{{ $iso }} {{ $dial }}</option>@endforeach
                        </select>
                        <input class="input phone__num" id="f-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel-national" required aria-describedby="e-phone"
                               data-ph-en="1XXX-XXXXXX" data-ph-bn="১XXX-XXXXXX" placeholder="1XXX-XXXXXX">
                    </div>
                    <p class="field__error" id="e-phone"><x-proto.t en="Enter a valid contact number." bn="সঠিক যোগাযোগ নম্বর লিখুন।" /></p>
                </div>

                <div class="field">
                    <label class="field__label" for="f-email"><x-proto.t en="Email" bn="ইমেইল" /></label>
                    <input class="input" id="f-email" name="email" type="email" autocomplete="email" required aria-describedby="e-email">
                    <p class="field__error" id="e-email"><x-proto.t en="Enter a valid email address." bn="সঠিক ইমেইল ঠিকানা লিখুন।" /></p>
                </div>

                <div class="field">
                    <label class="field__label" for="f-addr1"><x-proto.t en="Address line 1" bn="ঠিকানা (লাইন ১)" /></label>
                    <input class="input" id="f-addr1" name="address_1" type="text" autocomplete="address-line1" required aria-describedby="e-addr1">
                    <p class="field__error" id="e-addr1"><x-proto.t en="Enter your address." bn="আপনার ঠিকানা লিখুন।" /></p>
                </div>

                <div class="field">
                    <label class="field__label" for="f-addr2"><x-proto.t en="Address line 2" bn="ঠিকানা (লাইন ২)" /> <span class="field__opt"><x-proto.t en="(optional)" bn="(ঐচ্ছিক)" /></span></label>
                    <input class="input" id="f-addr2" name="address_2" type="text" autocomplete="address-line2">
                </div>

                <x-proto.note>Integration point (Phase 06): fields map to the existing booking payload for /pay-via-ajax (SSLCommerz) and /paypal/create — no backend changes</x-proto.note>
            </form>

            <aside class="panel summary" aria-labelledby="summary-title">
                <h3 class="h3" id="summary-title"><x-proto.t en="Summary" bn="সারসংক্ষেপ" /></h3>

                <div class="summary__rows">
                    @foreach ([
                        ['key' => 'kuakata', 'img' => $img('Hotel-Jana-resized.jpg.jpeg'), 'pos' => '50% 30%', 'en' => 'Hotel Jana Kuakata Share', 'bn' => 'হোটেল জানা কুয়াকাটা শেয়ার'],
                        ['key' => 'dove', 'img' => $ph('1471922694854-ff1b63b20054', 200), 'pos' => '50% 50%', 'en' => 'Hotel Jana The Dove Share', 'bn' => 'হোটেল জানা দ্য ডোভ শেয়ার'],
                    ] as $r)
                        <div class="srow" data-srow="{{ $r['key'] }}">
                            <div class="srow__inner">
                                <img class="srow__img" src="{{ $r['img'] }}" alt="" loading="lazy" style="object-position: {{ $r['pos'] }}">
                                <div class="srow__info">
                                    <p class="srow__name"><x-proto.t :en="$r['en']" :bn="$r['bn']" /></p>
                                    <p class="srow__calc">BDT 400,000 × <span data-srow-qty>0</span></p>
                                    <div class="stepper stepper--sm">
                                        <button type="button" class="stepper__btn" data-dec="{{ $r['key'] }}" aria-label="Decrease quantity"><svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h10" stroke="currentColor" stroke-width="1.5"/></svg></button>
                                        <output class="stepper__val" data-srow-qty>0</output>
                                        <button type="button" class="stepper__btn" data-inc="{{ $r['key'] }}" aria-label="Increase quantity"><svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h10M8 3v10" stroke="currentColor" stroke-width="1.5"/></svg></button>
                                    </div>
                                </div>
                                <p class="srow__amt" data-srow-amt>0</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="summary__empty" data-summary-empty>
                        <p><x-proto.t en="No shares selected yet." bn="এখনও কোনো শেয়ার নির্বাচন করা হয়নি।" /></p>
                        <a class="link-arrow" href="#invest"><x-proto.t en="Choose a property" bn="প্রপার্টি নির্বাচন করুন" />{!! $arrow !!}</a>
                    </div>
                </div>

                <label class="summary__ccy">
                    <span class="field__label"><x-proto.t en="Currency" bn="মুদ্রা" /></span>
                    <select class="select" data-currency aria-label="Currency">
                        @foreach ($currencies as $code => $name)<option value="{{ $code }}">{{ $code }} — {{ $name }}</option>@endforeach
                    </select>
                </label>

                <div class="summary__total">
                    <div class="summary__total-row">
                        <p class="summary__total-label"><x-proto.t en="Total" bn="মোট" /></p>
                        <p class="total" aria-live="polite"><span class="ccy">BDT</span><span data-total>0</span></p>
                    </div>
                    <p class="approx approx--total" data-approx-total hidden></p>
                    <p class="rate-note" data-rate-note hidden><x-proto.t en="Indicative only · example rate, not live" bn="আনুমানিক · নমুনা হার, লাইভ নয়" /></p>
                    <x-proto.note>Exchange-rate source and gateway charge currency to be confirmed</x-proto.note>
                </div>

                <fieldset class="paymethods">
                    <legend class="field__label"><x-proto.t en="Payment method" bn="পেমেন্ট পদ্ধতি" /></legend>
                    @foreach ([['sslcommerz', 'SSLCOMMERZ', 'Cards, mobile banking &amp; net banking', 'কার্ড, মোবাইল ব্যাংকিং ও নেট ব্যাংকিং'], ['paypal', 'PayPal', 'PayPal balance &amp; international cards', 'পেপ্যাল ব্যালেন্স ও আন্তর্জাতিক কার্ড']] as [$key, $label, $en, $bn])
                        <label class="paymethod" data-method="{{ $key }}" data-state="active">
                            <input type="radio" name="payment_method" value="{{ $key }}">
                            <span class="paymethod__radio" aria-hidden="true"></span>
                            <span class="paymethod__body">
                                <span class="paymethod__name paymethod__name--{{ $key }}">{{ $label }}</span>
                                <span class="paymethod__desc"><x-proto.t :en="$en" :bn="$bn" /></span>
                                <span class="paymethod__reason" data-reason="disabled"><x-proto.t en="Not available for this order. The reason will be shown here." bn="এই অর্ডারের জন্য প্রযোজ্য নয়। কারণ এখানে দেখানো হবে।" /></span>
                            </span>
                            <span class="badge badge--muted paymethod__flag" data-reason="unavailable"><x-proto.t en="Unavailable" bn="অনুপলব্ধ" /></span>
                        </label>
                    @endforeach
                    <div class="note-panel note">
                        <span>Preview method states:</span>
                        @foreach (['sslcommerz' => 'SSLCommerz', 'paypal' => 'PayPal'] as $key => $label)
                            <label>{{ $label }}
                                <select data-demo-state="{{ $key }}"><option>active</option><option>disabled</option><option>unavailable</option></select>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <button type="button" class="btn btn--primary btn--block btn--lg" data-pay disabled aria-describedby="pay-help">
                    <x-proto.t en="Pay now" bn="এখনই পেমেন্ট করুন" />{!! $arrow !!}
                </button>
                <p class="pay-help" id="pay-help" data-pay-help></p>
                <p class="trust">
                    <svg viewBox="0 0 16 16" aria-hidden="true"><rect x="3" y="7" width="10" height="7" rx="1" fill="none" stroke="currentColor" stroke-width="1.2"/><path d="M5.5 7V5a2.5 2.5 0 015 0v2" fill="none" stroke="currentColor" stroke-width="1.2"/></svg>
                    <x-proto.t en="Payments are processed securely by SSLCommerz or PayPal." bn="পেমেন্ট নিরাপদে SSLCommerz বা PayPal-এর মাধ্যমে সম্পন্ন হয়।" />
                </p>
            </aside>
        </div>
    </div>
</section>
</main>

{{-- ============ 10 FOOTER ============ --}}
<footer class="footer surface-dark">
    <div class="container footer__grid">
        <div class="footer__brand">
            <img src="{{ $img('logo/jana-back.png') }}" alt="Hotel Jana" width="72" height="72" loading="lazy">
            <p class="footer__tag"><x-proto.t en="One step closer to paradise." bn="স্বর্গের আরও এক ধাপ কাছে।" /></p>
        </div>
        <div>
            <p class="footer__head"><x-proto.t en="Properties" bn="প্রপার্টি" /></p>
            <ul class="footer__list">
                <li><x-proto.t en="Hotel Jana Kuakata" bn="হোটেল জানা কুয়াকাটা" /><span class="footer__sub"><x-proto.t en="Five-Star · Kuakata" bn="পাঁচ তারকা · কুয়াকাটা" /></span></li>
                <li><x-proto.t en="Hotel Jana The Dove" bn="হোটেল জানা দ্য ডোভ" /><span class="footer__sub"><x-proto.t en="Four-Star · Cox's Bazar" bn="চার তারকা · কক্সবাজার" /></span></li>
            </ul>
        </div>
        <div>
            <p class="footer__head"><x-proto.t en="Contact" bn="যোগাযোগ" /></p>
            <ul class="footer__list">
                <li><a href="tel:+8801994045693">+880 1994 045693</a></li>
                <li><a href="tel:+8801994045705">+880 1994 045705</a></li>
                <li><a href="mailto:asad@alliancebuildersltd.org">asad@alliancebuildersltd.org</a></li>
            </ul>
            <x-proto.note>Contacts from current site — confirm</x-proto.note>
        </div>
    </div>
    <div class="container footer__base">
        <p>© {{ date('Y') }} Hotel Jana Ltd.</p>
        <p><x-proto.t en="Visual prototype — not a live offer" bn="ভিজ্যুয়াল প্রোটোটাইপ — লাইভ অফার নয়" /></p>
    </div>
</footer>

{{-- Mobile order bar --}}
<div class="orderbar" data-orderbar aria-hidden="true">
    <div>
        <p class="orderbar__count" data-orderbar-count></p>
        <p class="orderbar__total"><span class="ccy">BDT</span> <span data-orderbar-total>0</span></p>
    </div>
    <a class="btn btn--primary" href="#checkout" tabindex="-1"><x-proto.t en="Checkout" bn="চেকআউট" /></a>
</div>

{{-- Prototype-only modal: stands in for the hand-off to the existing payment flow --}}
<dialog class="modal" data-pay-modal aria-labelledby="modal-title">
    <div class="modal__icon" aria-hidden="true"><svg viewBox="0 0 48 48"><circle cx="24" cy="24" r="22.5" fill="none" stroke="currentColor"/><path d="M24 14v13M24 32v2" stroke="currentColor" stroke-width="2"/></svg></div>
    <h2 class="h3" id="modal-title"><x-proto.t en="Prototype — payment not connected" bn="প্রোটোটাইপ — পেমেন্ট সংযুক্ত নয়" /></h2>
    <p class="modal__body"><x-proto.t en="In production, this step hands your order to the existing SSLCommerz or PayPal payment flow without any change to the backend." bn="চূড়ান্ত সংস্করণে এই ধাপে আপনার অর্ডার বিদ্যমান SSLCommerz বা PayPal পেমেন্ট প্রক্রিয়ায় পাঠানো হবে, ব্যাকএন্ডে কোনো পরিবর্তন ছাড়াই।" /></p>
    <dl class="modal__recap" data-modal-recap></dl>
    <form method="dialog"><button class="btn btn--primary btn--block"><x-proto.t en="Close" bn="বন্ধ করুন" /></button></form>
</dialog>

<button type="button" class="notes-toggle" data-notes-toggle aria-pressed="true">Prototype notes <b>On</b></button>
</body>
</html>
