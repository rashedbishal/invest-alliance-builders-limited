@php
    $pages = [
        400 => ['title' => 'A request needs another look', 'message' => 'We could not process that request. Please return to the site and try again.'],
        401 => ['title' => 'Please sign in to continue', 'message' => 'This page requires an authenticated session. Sign in, then return to your request.'],
        403 => ['title' => 'This area is private', 'message' => 'Your account does not have access to this page. Please contact us if you believe this is a mistake.'],
        404 => ['title' => 'This page has moved on', 'message' => 'The page you’re looking for isn’t here. Let’s take you back to Hotel Jana.'],
        405 => ['title' => 'This action is not available here', 'message' => 'The requested method is not supported for this page. Return to the site and continue from there.'],
        408 => ['title' => 'That took longer than expected', 'message' => 'The request timed out before it could be completed. Please try again.'],
        419 => ['title' => 'Your session has expired', 'message' => 'For your security, this page can no longer be submitted. Return to the site and try again.'],
        422 => ['title' => 'A few details need attention', 'message' => 'We could not process the information provided. Please review your details and try again.'],
        429 => ['title' => 'Let’s take a brief pause', 'message' => 'There have been too many requests in a short time. Please wait a moment before trying again.'],
        500 => ['title' => 'We’re taking a closer look', 'message' => 'Something unexpected happened on our side. Please try again shortly.'],
        502 => ['title' => 'We’re reconnecting', 'message' => 'A service we rely on did not respond as expected. Please try again shortly.'],
        503 => ['title' => 'A brief pause in service', 'message' => 'Our site is temporarily unavailable. Please try again in a little while.'],
        504 => ['title' => 'The response is taking too long', 'message' => 'A service we rely on took too long to respond. Please try again shortly.'],
    ];
    $page = $pages[$status] ?? ['title' => 'We could not complete that request', 'message' => 'Please return to Hotel Jana and try again.'];
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#12132e">
    <title>{{ $status }} — {{ $page['title'] }} | Hotel Jana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600&family=Manrope:wght@400;500;600;700&family=Newsreader:ital,opsz,wght@1,6..72,400;1,6..72,500&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: dark; --night: #12132e; --night-soft: #1b1c43; --ivory: #f7f4ee; --muted: #b9bbcc; --gold: #e9b872; --blue: #6fc6ec; }
        * { box-sizing: border-box; }
        html { min-height: 100%; background: var(--night); }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; padding: 36px 22px; color: var(--ivory); font-family: Manrope, sans-serif; background: radial-gradient(ellipse at 50% 42%, rgba(52, 54, 107, .48), transparent 56%), linear-gradient(145deg, #12132e 10%, #1a1b40 58%, #11122a); }
        body::before { position: fixed; inset: 0; z-index: 0; content: ''; pointer-events: none; opacity: .23; background: repeating-radial-gradient(circle at 110% -10%, rgba(111, 198, 236, .13) 0 1px, transparent 1px 8px); }
        .frame { position: relative; z-index: 1; width: min(100%, 760px); padding: clamp(30px, 7vw, 72px); text-align: center; border: 1px solid rgba(233, 184, 114, .34); background: linear-gradient(155deg, rgba(255,255,255,.045), rgba(255,255,255,.012)); box-shadow: 0 34px 100px rgba(0,0,0,.3), inset 0 0 0 6px rgba(247,244,238,.025); }
        .frame::before { position: absolute; inset: 7px; border: 1px solid rgba(247,244,238,.075); content: ''; pointer-events: none; }
        .brand { position: relative; display: inline-flex; flex-direction: column; gap: 7px; color: var(--ivory); text-decoration: none; }
        .brand__name { font-family: Cinzel, Georgia, serif; font-size: 15px; font-weight: 600; letter-spacing: .31em; }
        .brand__line { width: 50px; height: 1px; margin: 0 auto; background: linear-gradient(90deg, transparent, var(--gold), transparent); }
        .brand__caption { color: var(--muted); font-size: 9px; letter-spacing: .24em; text-transform: uppercase; }
        .ornament { display: flex; align-items: center; justify-content: center; gap: 13px; margin: clamp(38px, 8vw, 66px) auto 18px; color: var(--gold); }
        .ornament::before, .ornament::after { width: 54px; height: 1px; background: linear-gradient(90deg, transparent, rgba(233,184,114,.55)); content: ''; }
        .ornament::after { transform: rotate(180deg); }
        .ornament span { font-family: Newsreader, Georgia, serif; font-size: 16px; font-style: italic; letter-spacing: .08em; }
        .code { margin: 0; color: rgba(111,198,236,.88); font-size: 12px; font-weight: 600; letter-spacing: .34em; }
        h1 { max-width: 570px; margin: 18px auto 14px; font-family: Newsreader, Georgia, serif; font-size: clamp(38px, 7vw, 62px); font-weight: 400; line-height: 1.04; letter-spacing: -.025em; }
        .message { max-width: 470px; margin: 0 auto; color: var(--muted); font-size: 14px; line-height: 1.85; }
        .actions { display: flex; justify-content: center; margin-top: 34px; }
        .home { display: inline-flex; align-items: center; justify-content: center; gap: 12px; min-height: 50px; padding: 0 22px; color: #17172f; background: var(--gold); border: 1px solid var(--gold); text-decoration: none; font-size: 11px; font-weight: 700; letter-spacing: .15em; text-transform: uppercase; transition: background .2s, color .2s, transform .2s; }
        .home:hover { color: var(--ivory); background: transparent; transform: translateY(-2px); }
        .home:focus-visible { outline: 2px solid var(--blue); outline-offset: 4px; }
        .home svg { width: 16px; height: 16px; }
        .foot { margin: 34px 0 0; color: rgba(185,187,204,.62); font-size: 10px; letter-spacing: .12em; }
        @media (max-width: 480px) { body { padding: 20px 14px; } .frame { padding: 34px 24px 30px; } .message { font-size: 13px; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <main class="frame">
        <a class="brand" href="{{ route('home') }}" aria-label="Hotel Jana home">
            <span class="brand__name">HOTEL JANA</span>
            <span class="brand__line"></span>
            <span class="brand__caption">A considered stay</span>
        </a>
        <div class="ornament" aria-hidden="true"><span>At your service</span></div>
        <p class="code">ERROR {{ $status }}</p>
        <h1>{{ $page['title'] }}</h1>
        <p class="message">{{ $page['message'] }}</p>
        <div class="actions">
            <a class="home" href="{{ route('home') }}">
                <span>Return to Hotel Jana</span>
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="square"/></svg>
            </a>
        </div>
        <p class="foot">HOTEL JANA <span aria-hidden="true">·</span> KUAKATA &amp; COX’S BAZAR</p>
    </main>
</body>
</html>
