<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Jana — Where the Bay of Bengal Meets Infinity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Cinzel:wght@400;500;600;700&family=Crimson+Pro:ital,wght@0,200;0,300;0,400;1,200;1,300&family=Tiro+Bangla:ital@0;1&display=swap"
        rel="stylesheet">

    <style>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--ocean-dark);
            color: var(--cream);
            font-family: 'Cormorant Garamond', serif;
            cursor: none;
            overflow-x: hidden;
        }

        /* CUSTOM CURSOR */
        .cursor {
            position: fixed;
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
            pointer-events: none;
            z-index: 99999;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s, opacity 0.3s;
            mix-blend-mode: difference;
        }

        .cursor-ring {
            position: fixed;
            width: 36px;
            height: 36px;
            border: 1px solid rgba(40, 172, 226, 0.5);
            border-radius: 50%;
            pointer-events: none;
            z-index: 99998;
            transform: translate(-50%, -50%);
            transition: all 0.15s ease;
        }

        body:hover .cursor {
            opacity: 1;
        }

        /* LANG SWITCH */
        .lang-switch {
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .lang-orb {
            width: 60px;
            height: 28px;
            background: rgba(73, 73, 73, 0.8);
            border: 1px solid rgba(40, 172, 226, 0.4);
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            backdrop-filter: blur(12px);
            transition: border-color 0.3s;
            display: flex;
            align-items: center;
            padding: 0 4px;
            justify-content: space-between;
        }

        .lang-orb:hover {
            border-color: var(--gold);
        }

        .lang-orb .lang-label {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            letter-spacing: 0.05em;
            color: white;
            font-weight: 300;
            line-height: 1;
            z-index: 1;
            position: relative;
            padding: 0 4px;
        }

        /* .lang-label { padding: 0 4px; } */

        .lang-orb .lang-ball {
            position: absolute;
            width: 28px;
            height: 18px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 999px;
            top: 50%;
            transform: translateY(-50%);
            left: 4px;
            transition: left 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            box-shadow: 0 0 8px rgba(40, 172, 226, 0.5);
        }


        .lang-orb.bn .lang-ball {
            left: calc(100% - 31px);
        }

        /* NAV */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9990;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background 0.5s, backdrop-filter 0.5s;
        }

        nav.scrolled {
            background: rgba(6, 13, 26, 0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(40, 172, 226, 0.15);
        }

        .nav-logo {
            font-family: 'Cinzel', serif;
            font-size: 20px;
            letter-spacing: 0.2em;
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
        }

        .nav-logo span {
            color: var(--cream);
            font-weight: 400;
        }

        .nav-links {
            display: flex;
            gap: 36px;
            align-items: center;
        }

        .nav-links a {
            font-family: 'Cinzel', serif;
            font-size: 12px;
            letter-spacing: 0.2em;
            color: rgb(255, 255, 255);
            text-decoration: none;
            text-transform: uppercase;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--gold);
            transition: width 0.3s;
        }

        .nav-links a:hover {
            color: var(--gold);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* .nav-button:hover { background-color: black; } */

        /* SECTIONS */
        section {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* HERO */
        #hero {
            background: var(--ocean-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            position: relative;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 50% 100%, rgba(13, 33, 55, 0.9) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 20% 60%, rgba(40, 172, 226, 0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 60%, rgba(13, 33, 55, 0.8) 0%, transparent 60%),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&q=90') center/cover no-repeat;
            animation: heroParallax 20s ease-in-out infinite alternate;
        }

        @keyframes heroParallax {
            from {
                transform: scale(1.05) translateY(0);
            }

            to {
                transform: scale(1.12) translateY(-20px);
            }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
            rgba(6, 13, 26, 0.3) 0%,
            rgba(6, 13, 26, 0.2) 40%,
            rgba(6, 13, 26, 0.7) 80%,
            rgba(6, 13, 26, 1) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 0 24px;
        }

        .hero-eyebrow {
            font-family: 'Cinzel', serif;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5em;
            color: rgb(0, 0, 0);
            text-transform: uppercase;
            margin-bottom: 24px;
            opacity: 0;
            animation: fadeUp 1.2s 0.5s forwards;
            text-shadow: 0 1px 8px rgba(255, 255, 255, 0.6);
        }

        .hero-title {
            font-family: 'Cinzel', serif;
            font-size: clamp(52px, 10vw, 120px);
            font-weight: 400;
            line-height: 1;
            color: white;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            opacity: 0;
            animation: fadeUp 1.2s 0.8s forwards;
        }

        .hero-title-gold {
            color: var(--gold);
            font-style: italic;
            font-family: 'Cormorant Garamond', serif;
        }

        .hero-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(16px, 2.5vw, 26px);
            font-style: italic;
            font-weight: 300;
            color: rgba(232, 220, 200, 0.75);
            margin-bottom: 48px;
            letter-spacing: 0.05em;
            opacity: 0;
            animation: fadeUp 1.2s 1.1s forwards;
            text-shadow: 0 1px 12px rgba(0, 0, 0, 0.7);
        }

        .hero-cta {
            opacity: 0;
            animation: fadeUp 1.2s 1.4s forwards;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-gold {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--deep-navy);
            font-weight: bold;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border: none;
            padding: 18px 44px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(40, 172, 226, 0.4);
        }

        .btn-gold:hover::before {
            opacity: 1;
        }

        .btn-gold span {
            position: relative;
            z-index: 1;
        }

        .btn-outline {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: bold;
            background: transparent;
            border: 1px solid rgba(40, 172, 226, 0.5);
            padding: 18px 44px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            backdrop-filter: blur(8px);
        }

        .btn-outline:hover {
            background: rgba(40, 172, 226, 0.1);
            border-color: var(--gold);
            box-shadow: 0 0 30px rgba(40, 172, 226, 0.2);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 49%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            opacity: 0;
            animation: fadeIn 1s 2.5s forwards;
        }

        .scroll-line {
            width: 1px;
            height: 60px;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
            animation: scrollPulse 2s ease-in-out infinite;
        }

        @keyframes scrollPulse {

            0%,
            100% {
                opacity: 0.4;
                transform: scaleY(0.8);
            }

            50% {
                opacity: 1;
                transform: scaleY(1);
            }
        }

        .scroll-text {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 0.3em;
            color: rgba(40, 172, 226, 0.6);
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }

        /* FLOATING PARTICLES */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--gold);
            pointer-events: none;
            animation: float linear infinite;
            opacity: 0;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 0.6;
            }

            90% {
                opacity: 0.3;
            }

            100% {
                transform: translateY(-100px) translateX(100px) scale(0.5);
                opacity: 0;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* GOLDEN DIVIDER */
        .gold-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            justify-content: center;
            margin: 24px 0;
        }

        .gold-divider-line {
            height: 1px;
            flex: 1;
            max-width: 120px;
            background: linear-gradient(to right, transparent, var(--gold));
        }

        .gold-divider-line.right {
            background: linear-gradient(to left, transparent, var(--gold));
        }

        .gold-divider-diamond {
            width: 6px;
            height: 6px;
            background: var(--gold);
            transform: rotate(45deg);
        }

        /* SECTION: STORY */
        #story {
            background: var(--ocean-dark);
            display: flex;
            align-items: center;
            padding: 120px 0;
        }

        .story-bg {
            position: absolute;
            inset: 0;
            background:
                url('https://images.unsplash.com/photo-1519046904884-53103b34b206?w=1920&q=80') center 30%/cover;
            opacity: 0.12;
        }

        .story-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--ocean-dark) 50%, rgba(6, 13, 26, 0.85) 100%);
        }

        .story-inner {
            position: relative;
            z-index: 2;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 48px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 100px;
            align-items: center;
        }

        .story-left {}

        .section-eyebrow {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 0.5em;
            color: var(--gold);
            text-transform: uppercase;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .section-eyebrow::before {
            content: '';
            display: block;
            width: 40px;
            height: 1px;
            background: var(--gold);
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-size: clamp(32px, 5vw, 60px);
            font-weight: 400;
            color: var(--cream);
            line-height: 1.15;
            margin-bottom: 24px;
        }

        .section-title em {
            color: var(--gold);
            font-style: italic;
            font-family: 'Cormorant Garamond', serif;
        }

        .section-body {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 300;
            color: rgba(232, 220, 200, 0.7);
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .section-body-bn {
            font-family: 'Tiro Bangla', sans-serif;
            font-size: 17px;
            font-weight: 300;
            color: rgba(232, 220, 200, 0.7);
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .story-stat {
            display: flex;
            gap: 48px;
            margin-top: 48px;
        }

        .stat-item {}

        .stat-num {
            font-family: 'Cinzel', serif;
            font-size: 48px;
            font-weight: 400;
            color: var(--gold);
            line-height: 1;
        }

        .stat-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            color: rgba(232, 220, 200, 0.5);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .story-right {
            position: relative;
        }

        .story-img-main {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(40, 172, 226, 0.2);
            border-radius: 16px;
        }

        .story-img-accent {
            position: absolute;
            width: 55%;
            aspect-ratio: 1;
            bottom: -40px;
            left: -40px;
            object-fit: cover;
            z-index: 3;
            border: 3px solid var(--ocean-dark);
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.8);
            border-radius: 16px;
        }

        .story-gold-frame {
            position: absolute;
            top: -16px;
            right: -16px;
            bottom: -16px;
            left: -16px;
            border: 4px solid rgba(40, 172, 226, 0.15);
            border-radius: 16px;
            z-index: 1;
            pointer-events: none;
        }

        /* SECTION: GALLERY */
        #gallery {
            background: #050A14;
            padding: 80px 0;
        }

        .gallery-inner {
            position: relative;
            z-index: 2;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 48px;
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 3px;
            height: 80vh;
            border-radius: 16px;
            overflow: hidden;
        }

        .gallery-item {
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .gallery-item:first-child {
            grid-row: 1 / 3;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.5s;
            filter: brightness(0.85) saturate(0.9);
        }

        .gallery-item:hover img {
            transform: scale(1.06);
            filter: brightness(1) saturate(1.1);
        }

        .gallery-item-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(6, 13, 26, 0.7) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .gallery-item:hover .gallery-item-overlay {
            opacity: 1;
        }

        .gallery-item-label {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-family: 'Cinzel', serif;
            font-size: 18px;
            letter-spacing: 0.2em;
            color: white;
            opacity: 0;
            transition: opacity 0.4s, transform 0.4s;
            transform: translateY(10px);
        }

        .gallery-item:hover .gallery-item-label {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-gold-border {
            position: absolute;
            inset: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            pointer-events: none;
            z-index: 3;
            opacity: 0;
            transition: opacity 0.4s;
            border-radius: 16px;
        }

        .gallery-item:hover .gallery-gold-border {
            opacity: 1;
        }

        /* SECTION: SHARE BENEFITS */
        #benefits {
            background: var(--ocean-dark);
            padding: 120px 0;
            position: relative;
        }

        .benefits-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 50% 0%, rgba(40, 172, 226, 0.04) 0%, transparent 60%),
                url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1920&q=70') center/cover;
            opacity: 0.08;
        }

        .benefits-inner {
            position: relative;
            z-index: 2;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 48px;
        }

        .benefits-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .benefits-tag {
            display: inline-block;
            background: linear-gradient(135deg, rgba(40, 172, 226, 0.15), rgba(40, 172, 226, 0.05));
            border: 1px solid rgba(40, 172, 226, 0.3);
            padding: 8px 24px;
            margin-bottom: 24px;
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 0.4em;
            color: var(--gold);
            text-transform: uppercase;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            /* border-radius: 16px; overflow: hidden; */
        }

        .benefit-card {
            background: rgba(13, 33, 55, 0.4);
            border: 1px solid rgba(40, 172, 226, 0.1);
            padding: 44px 36px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.4s, background 0.4s;
            backdrop-filter: blur(10px);
        }

        .benefit-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .benefit-card:hover {
            border-color: rgba(40, 172, 226, 0.3);
            background: rgba(13, 33, 55, 0.7);
        }

        .benefit-card:hover::before {
            opacity: 1;
        }

        .benefit-num {
            font-family: 'Cinzel', serif;
            font-size: 11px;
            letter-spacing: 0.3em;
            color: rgba(40, 172, 226, 0.4);
            margin-bottom: 16px;
        }

        .benefit-icon {
            font-size: 32px;
            margin-bottom: 20px;
            display: block;
            filter: sepia(1) saturate(2) hue-rotate(15deg);
        }

        .benefit-title {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            letter-spacing: 0.1em;
            color: var(--gold);
            margin-bottom: 12px;
            font-weight: 500;
        }

        .benefit-title-bn {
            font-family: 'Tiro Bangla', serif;
            font-size: 15px;
            color: var(--gold);
            margin-bottom: 12px;
            font-weight: 500;
        }

        .benefit-desc {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            color: rgba(232, 220, 200, 0.6);
            line-height: 1.7;
            font-weight: 300;
        }

        .benefit-desc-bn {
            font-family: 'Tiro Bangla', serif;
            font-size: 14px;
            color: rgba(232, 220, 200, 0.6);
            line-height: 1.8;
            font-weight: 300;
        }

        .benefit-card-shine {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle at 0% 0%, rgba(40, 172, 226, 0.05) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .benefit-card:hover .benefit-card-shine {
            opacity: 1;
        }

        /* SECTION: AMENITIES */
        #amenities {
            background: #04080F;
            padding: 120px 0;
            position: relative;
        }

        .amenities-bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1540541338287-41700207dee6?w=1920&q=70') center/cover;
            opacity: 0.07;
        }

        .amenities-inner {
            position: relative;
            z-index: 2;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 48px;
        }

        .amenities-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 3px;
        }

        .amenity-item {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: rgba(13, 33, 55, 0.3);
            border: 1px solid rgba(40, 172, 226, 0.08);
            padding: 24px 16px;
            text-align: center;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
            cursor: default;
        }

        .amenity-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(40, 172, 226, 0.08) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .amenity-item:hover {
            background: rgba(13, 33, 55, 0.8);
            border-color: rgba(40, 172, 226, 0.3);
            transform: scale(1.03);
            z-index: 1;
        }

        .amenity-item:hover::after {
            opacity: 1;
        }

        .amenity-icon {
            font-size: 28px;
            transition: transform 0.3s;
        }

        .amenity-item:hover .amenity-icon {
            transform: scale(1.2);
        }

        .amenity-name {
            font-family: 'Cinzel', serif;
            font-size: 16px;
            letter-spacing: 0.15em;
            color: rgba(40, 172, 226, 0.7);
            text-transform: uppercase;
            line-height: 1.3;
        }

        .amenity-name-bn {
            font-family: 'Tiro Bangla', serif;
            font-size: 20px;
            color: rgba(40, 172, 226, 0.7);
            line-height: 1.4;
        }

        /* SECTION: PRIVILEGE */
        #privilege {
            background: var(--ocean-dark);
            padding: 120px 0;
            position: relative;
        }

        .privilege-bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(40, 172, 226, 0.03) 0%, transparent 50%),
                url('https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1920&q=70') center/cover;
            opacity: 0.08;
        }

        .privilege-inner {
            position: relative;
            z-index: 2;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 48px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .privilege-card-wrap {
            perspective: 1000px;
        }

        .privilege-card {
            background: linear-gradient(135deg, #28ace2 0%, #4fc3f0 30%, #cceeff 50%, #4fc3f0 70%, #28ace2 100%);
            border-radius: 16px;
            padding: 48px 44px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.6), 0 0 60px rgba(40, 172, 226, 0.2);
            transform-style: preserve-3d;
            transition: transform 0.6s;
            min-height: 320px;
        }

        .privilege-card-wrap:hover .privilege-card {
            transform: rotateY(-8deg) rotateX(4deg);
        }

        .privilege-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, transparent 40%, rgba(255, 255, 255, 0.1) 100%);
            pointer-events: none;
        }

        .privilege-card-shine {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.15) 50%, transparent 70%);
            transform: rotate(30deg);
            animation: cardShine 4s ease-in-out infinite;
        }

        @keyframes cardShine {

            0%,
            100% {
                transform: rotate(30deg) translateX(-100%);
            }

            50% {
                transform: rotate(30deg) translateX(100%);
            }
        }

        .privilege-hotel-name {
            font-family: 'Cinzel', serif;
            font-size: 22px;
            color: var(--deep-navy);
            font-weight: 700;
            letter-spacing: 0.2em;
            margin-bottom: 4px;
        }

        .privilege-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: rgba(10, 15, 30, 0.6);
            font-style: italic;
            margin-bottom: 32px;
        }

        .privilege-badge {
            display: inline-block;
            background: rgba(10, 15, 30, 0.15);
            border: 1px solid rgba(10, 15, 30, 0.25);
            padding: 6px 14px;
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 0.3em;
            color: var(--deep-navy);
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .privilege-perks {
            list-style: none;
        }

        .privilege-perks li {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            color: rgba(10, 15, 30, 0.75);
            padding: 6px 0;
            border-bottom: 1px solid rgba(10, 15, 30, 0.1);
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .privilege-perks li::before {
            content: '✦';
            color: var(--deep-navy);
            font-size: 10px;
        }

        .privilege-perks-bn li {
            font-family: 'Tiro Bangla', serif;
            font-size: 13px;
        }

        .privilege-right {}

        .privilege-highlight {
            background: rgba(40, 172, 226, 0.06);
            border-left: 2px solid var(--gold);
            padding: 24px 28px;
            margin: 28px 0;
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-style: italic;
            color: rgba(232, 220, 200, 0.8);
            line-height: 1.6;
        }

        .privilege-highlight-bn {
            font-family: 'Tiro Bangla', serif;
            font-size: 16px;
            font-style: normal;
        }

        .privilege-cards-wrap {
            position: relative;
            width: 420px;
            height: 265px;
        }

        .priv-card {
            position: absolute;
            width: 420px;
            height: 265px;
            border-radius: 16px;
            padding: 28px 32px;
            overflow: hidden;
            background: linear-gradient(135deg, #0773bb 0%, #28ace2 35%, #4fc3f0 55%, #28ace2 75%, #0773bb 100%);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(40, 172, 226, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.4s ease;
        }

        .priv-front {
            top: 0;
            left: 0;
            z-index: 1;
            cursor: pointer;
        }

        .priv-back {
            top: 80px;
            left: 140px;
            z-index: 2;
            filter: brightness(0.85);
        }

        .priv-back:hover {
            transform: translateY(-8px) translateX(-8px);
        }

        .priv-wave-bar {
            height: 28px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.15));
            border-radius: 2px;
            position: relative;
            margin: 16px 0 0;
        }

        .priv-wave-bar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            border-radius: 2px;
        }

        .priv-term {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            color: rgba(10, 15, 30, 0.75);
            padding: 5px 0;
            border-bottom: 1px solid rgba(10, 15, 30, 0.1);
            display: flex;
            gap: 8px;
            align-items: baseline;
            line-height: 1.4;
        }

        .priv-term::before {
            content: '✦';
            font-size: 8px;
            color: rgba(10, 15, 30, 0.4);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .priv-contact-bar {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 6px;
            padding: 8px 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px 16px;
            margin-top: 4px;
        }

        .priv-contact-bar span {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 0.05em;
            color: rgba(10, 15, 30, 0.65);
        }

        /* SECTION: CTA INVESTMENT */
        #invest {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .invest-bg {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920&q=90') center/cover;
            animation: investParallax 25s ease-in-out infinite alternate;
        }

        @keyframes investParallax {
            from {
                transform: scale(1) translateY(0);
            }

            to {
                transform: scale(1.08) translateY(-30px);
            }
        }

        .invest-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
            rgba(6, 13, 26, 0.6),
            rgba(6, 13, 26, 0.75),
            rgba(6, 13, 26, 0.6));
        }

        .invest-content {
            position: relative;
            z-index: 2;
            padding: 80px 48px;
        }

        .invest-quote {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(28px, 5vw, 64px);
            font-style: italic;
            font-weight: 300;
            color: var(--cream);
            line-height: 1.3;
            max-width: 900px;
            margin: 0 auto 24px;
        }

        .invest-quote-bn {
            font-family: 'Tiro Bangla', sans-serif;
            font-size: clamp(20px, 3.5vw, 42px);
            font-style: normal;
            font-weight: 300;
            color: var(--cream);
            line-height: 1.5;
            max-width: 900px;
            margin: 0 auto 24px;
        }

        .invest-price-wrap {
            margin: 48px 0;
            display: flex;
            justify-content: center;
            align-items: baseline;
            gap: 16px;
        }

        .invest-price-old {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            color: rgba(232, 220, 200, 0.4);
            text-decoration: line-through;
        }

        .invest-price {
            font-family: 'Cinzel', serif;
            font-size: 64px;
            color: var(--gold);
            line-height: 1;
            text-shadow: 0 0 40px rgba(40, 172, 226, 0.4);
        }

        .invest-price-unit {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            color: rgba(232, 220, 200, 0.6);
        }

        .invest-discount {
            display: inline-block;
            background: var(--gold);
            color: var(--deep-navy);
            font-family: 'Cinzel', serif;
            font-size: 11px;
            letter-spacing: 0.3em;
            padding: 8px 20px;
            margin-bottom: 48px;
        }

        /* SECTION: BRAND */
        #brand {
            background: #04080F;
            padding: 100px 0;
            position: relative;
        }

        .brand-inner {
            position: relative;
            z-index: 2;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 48px;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 64px;
        }

        .brand-iso {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(40, 172, 226, 0.06);
            border: 1px solid rgba(40, 172, 226, 0.2);
            padding: 10px 24px;
            margin-bottom: 32px;
            font-family: 'Cinzel', serif;
            font-size: 11px;
            letter-spacing: 0.3em;
            color: var(--gold);
        }

        .brand-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
        }

        .brand-card {
            background: rgba(13, 33, 55, 0.3);
            border: 1px solid rgba(40, 172, 226, 0.08);
            padding: 36px 32px;
            text-align: center;
            transition: all 0.4s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .brand-card:hover {
            background: rgba(13, 33, 55, 0.7);
            border-color: rgba(40, 172, 226, 0.25);
        }

        .brand-card-icon {
            font-size: 36px;
        }

        .brand-card-name {
            font-family: 'Cinzel', serif;
            font-size: 13px;
            letter-spacing: 0.1em;
            color: var(--cream);
            font-weight: 500;
        }

        .brand-card-dot {
            width: 4px;
            height: 4px;
            background: var(--gold);
            border-radius: 50%;
            margin: 4px auto 0;
        }

        /* CONTACT STRIP */
        #contact {
            background: rgba(40, 172, 226, 0.06);
            border-top: 1px solid rgba(40, 172, 226, 0.2);
            padding: 60px 48px;
            min-height: auto;
            scroll-snap-align: none;
        }

        .contact-inner {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 48px;
            align-items: center;
        }

        .contact-info {}

        .contact-label {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 0.4em;
            color: var(--gold);
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .contact-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            color: rgba(232, 220, 200, 0.7);
            line-height: 2;
        }

        .contact-value a {
            color: rgba(232, 220, 200, 0.7);
            text-decoration: none;
        }

        .contact-value a:hover {
            color: var(--gold);
        }

        .contact-center {
            text-align: center;
        }

        .footer-logo {
            font-family: 'Cinzel', serif;
            font-size: 28px;
            letter-spacing: 0.3em;
            color: var(--gold);
            display: block;
            margin-bottom: 8px;
        }

        .footer-sub {
            font-family: 'Cormorant Garamond', serif;
            font-size: 13px;
            color: rgba(232, 220, 200, 0.4);
            letter-spacing: 0.15em;
        }

        /* REVEAL ANIMATIONS */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.9s ease, transform 0.9s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.9s ease, transform 0.9s ease;
        }

        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.9s ease, transform 0.9s ease;
        }

        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* LANGUAGE TOGGLE */
        [data-bn] {
            display: none;
        }

        body.lang-bn [data-en] {
            display: none;
        }

        body.lang-bn [data-bn] {
            display: block;
        }

        body.lang-bn [data-bn].inline-flex {
            display: inline-flex;
        }

        body.lang-bn [data-bn].flex {
            display: flex;
        }

        body.lang-bn [data-bn].grid {
            display: grid;
        }

        /* NOISE TEXTURE */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 99990;
            opacity: 0.4;
        }

        /* HORIZONTAL GOLD LINE DECORATION */
        .gold-line-deco {
            width: 100%;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(40, 172, 226, 0.4) 30%, rgba(40, 172, 226, 0.4) 70%, transparent);
            margin: 60px 0;
        }

        /* SUNRISE GLOW EFFECT */
        .sunrise-glow {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to top, rgba(40, 172, 226, 0.08), transparent);
            pointer-events: none;
        }

        @media (max-width: 1024px) {

            .story-inner,
            .privilege-inner {
                grid-template-columns: 1fr;
                gap: 48px;
            }

            .story-right {
                display: none;
            }

            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .amenities-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .brand-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                height: auto;
                grid-template-rows: auto;
            }

            .gallery-item:first-child {
                grid-row: auto;
            }

            nav {
                padding: 20px 24px;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .amenities-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .brand-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                height: auto;
            }

            .contact-inner {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .story-stat {
                gap: 24px;
            }

            #contact {
                padding: 40px 24px;
            }

            .invest-price {
                font-size: 44px;
            }
        }
    </style>
</head>

<body>

<!-- CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>



<!-- NAVIGATION -->
<nav id="mainNav">
    <a href="#" class="nav-logo">
        <img src="jana.png" alt="jana logo" style="width: 48px; height: auto; padding: 4px;">
    </a>
    <div class="nav-links">
        <a href="#story">Our Vision</a>
        <a href="#gallery">Gallery</a>
        <a href="#benefits">Ownership</a>
        <a href="#amenities">Amenities</a>
        <a href="#privilege">Privileges</a>
        <a class="nav-button" href="form.html"
           style="color:var(--gold); border: 1px solid rgb(40,172,226); background-color: #F7F1E8; padding: 10px 20px; border-radius: 6px;">Reserve
            a Share</a>
    </div>
    <!-- LANGUAGE SWITCH -->
    <div class="lang-switch">
        <div class="lang-orb" id="langToggle" onclick="toggleLang()">
            <span class="lang-label">EN</span>
            <div class="lang-ball"></div>
            <span class="lang-label">বাং</span>
        </div>
    </div>
</nav>

<!-- ===== SECTION 1: HERO ===== -->
<section id="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <!-- Floating particles -->
    <div id="particles"></div>

    <div class="hero-content">
        <p class="hero-eyebrow" data-en>Kuakata · Bay of Bengal · Bangladesh</p>
        <p class="hero-eyebrow" data-bn style="display:none">কুয়াকাটা · বঙ্গোপসাগর · বাংলাদেশ</p>

        <h1 class="hero-title">
            HOTEL<br><span class="hero-title-gold">Jana</span>
        </h1>

        <p class="hero-subtitle" data-en>Where the horizon bows and the sea whispers eternity.</p>
        <p class="hero-subtitle" data-bn style="display:none">যেখানে দিগন্ত নতজানু হয়, সমুদ্র বলে অনন্তকালের কথা।</p>

        <div class="hero-cta">
            <a href="form.html" class="btn-gold"><span data-en>Claim Your Share</span><span data-bn
                                                                                            style="display:none">আপনার শেয়ার নিন</span></a>
            <a href="#story" class="btn-outline" data-en>Discover the Vision</a>
            <a href="#story" class="btn-outline" data-bn style="display:none">আমাদের স্বপ্ন জানুন</a>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="scroll-line"></div>
        <span class="scroll-text">SCROLL</span>
    </div>
</section>

<!-- ===== SECTION 2: STORY ===== -->
<section id="story">
    <div class="story-bg"></div>
    <div class="story-overlay"></div>
    <div class="sunrise-glow"></div>

    <div class="story-inner">
        <div class="story-left">
            <div class="section-eyebrow reveal" data-en>The Genesis</div>
            <div class="section-eyebrow reveal" data-bn style="display:none">আমাদের যাত্রা</div>

            <h2 class="section-title reveal">
                <span data-en>A Dream Rising<br>from the <em>Golden Shore</em></span>
                <span data-bn style="display:none">সোনালি তীর থেকে<br><em>জন্ম নেওয়া স্বপ্ন</em></span>
            </h2>

            <div class="gold-divider reveal">
                <div class="gold-divider-line"></div>
                <div class="gold-divider-diamond"></div>
                <div class="gold-divider-line right"></div>
            </div>

            <p class="section-body reveal" data-en>
                Kuakata — one of earth's rarest gifts. A beach where the sun is born from the sea at dawn and surrenders to it
                at dusk. This is not a place; it is an experience of a lifetime. And at its heart, Hotel Jana rises — a 4-star
                monument to refinement, crafted by Alliance Builders Ltd. for those who seek the extraordinary.
            </p>
            <p class="section-body-bn reveal" data-bn style="display:none">
                কুয়াকাটা — পৃথিবীর বিরলতম উপহারগুলির একটি। একটি সৈকত যেখানে ভোরে সমুদ্র থেকে সূর্যের জন্ম হয় এবং সন্ধ্যায়
                সমুদ্রেই অস্ত যায়। এটি শুধু একটি জায়গা নয়, এটি জীবনের একটি অনুভূতি। আর সেখানেই উঠে দাঁড়াচ্ছে হোটেল জানা —
                একটি ৪ স্টার আবাসন, Alliance Builders Ltd. নির্মিত।
            </p>

            <p class="section-body reveal" data-en>
                This is not merely a hotel. It is a legacy. A stake in Hotel Jana is a stake in the future of luxury
                hospitality in Bangladesh — and an invitation to own a piece of paradise.
            </p>
            <p class="section-body-bn reveal" data-bn style="display:none">
                এটি শুধু একটি হোটেল নয়। এটি একটি উত্তরাধিকার। হোটেল জানায় একটি শেয়ার মানে বাংলাদেশের বিলাসবহুল আতিথেয়তার
                ভবিষ্যতে একটি অংশ — স্বর্গের একটুকরো আপনার নামে।
            </p>

            <div class="story-stat reveal">
                <div class="stat-item">
                    <div class="stat-num">4★</div>
                    <div class="stat-label" data-en>International Standard</div>
                    <div class="stat-label" data-bn style="display:none">আন্তর্জাতিক মান</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">264</div>
                    <div class="stat-label" data-en>Luxury Rooms</div>
                    <div class="stat-label" data-bn style="display:none">বিলাসবহুল কক্ষ</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">12</div>
                    <div class="stat-label" data-en>Floor Tower</div>
                    <div class="stat-label" data-bn style="display:none">তলা ভবন</div>
                </div>
            </div>
        </div>

        <div class="story-right reveal-right">
            <div class="story-gold-frame"></div>
            <img class="story-img-main" src="https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800&q=90"
                 alt="Hotel Jana Exterior">
            <img class="story-img-accent" src="https://images.unsplash.com/photo-1455587734955-081b22074882?w=400&q=90"
                 alt="Hotel Jana Lobby">
        </div>
    </div>
</section>

<!-- ===== SECTION 3: GALLERY ===== -->
<section id="gallery">
    <div class="gallery-inner">
        <div class="gallery-header">
            <div class="section-eyebrow reveal" style="justify-content:center" data-en>Visual Journey</div>
            <div class="section-eyebrow reveal" style="justify-content:center" data-bn style="display:none">দৃশ্যের যাত্রা
            </div>
            <h2 class="section-title reveal" style="text-align:center">
                <span data-en>A World Unlike Any Other</span>
                <span data-bn style="display:none">অন্য কোনো জগতের মতো নয়</span>
            </h2>
        </div>

        <div class="gallery-grid reveal">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=900&q=90" alt="Hotel Facade">
                <div class="gallery-item-overlay"></div>
                <div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>THE FACADE</div>
                <div class="gallery-item-label" data-bn style="display:none">বাইরের দৃশ্য</div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=90" alt="Luxury Suite">
                <div class="gallery-item-overlay"></div>
                <div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>LUXURY SUITE</div>
                <div class="gallery-item-label" data-bn style="display:none">বিলাসবহুল সুইট</div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=600&q=90" alt="Grand Lobby">
                <div class="gallery-item-overlay"></div>
                <div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>GRAND LOBBY</div>
                <div class="gallery-item-label" data-bn style="display:none">গ্র্যান্ড লবি</div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1445019980597-93fa8acb246c?w=600&q=90" alt="Rooftop Pool">
                <div class="gallery-item-overlay"></div>
                <div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>ROOFTOP POOL</div>
                <div class="gallery-item-label" data-bn style="display:none">ছাদের সুইমিং পুল</div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=90" alt="Fine Dining">
                <div class="gallery-item-overlay"></div>
                <div class="gallery-gold-border"></div>
                <div class="gallery-item-label" data-en>FINE DINING</div>
                <div class="gallery-item-label" data-bn style="display:none">ফাইন ডাইনিং</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SECTION 4: SHARE BENEFITS ===== -->
<section id="benefits">
    <div class="benefits-bg"></div>
    <div class="benefits-inner">
        <div class="benefits-header">
            <div class="benefits-tag" data-en>Ownership Benefits</div>
            <div class="benefits-tag" data-bn style="display:none">মালিকানার সুবিধা</div>

            <h2 class="section-title reveal">
                <span data-en>Twelve Reasons to Own<br>a Piece of <em>Paradise</em></span>
                <span data-bn style="display:none">স্বর্গের একটুকরো কেনার<br><em>বারোটি কারণ</em></span>
            </h2>
            <p class="section-body reveal" style="max-width:600px;margin:0 auto" data-en>
                A share in Hotel Jana is not an expense. It is the most intelligent investment of your lifetime — yielding
                both financial returns and unparalleled experiences.
            </p>
            <p class="section-body-bn reveal" style="max-width:600px;margin:0 auto" data-bn style="display:none">
                হোটেল জানায় একটি শেয়ার কোনো ব্যয় নয়। এটি আপনার জীবনের সবচেয়ে বুদ্ধিমান বিনিয়োগ।
            </p>
        </div>

        <div class="benefits-grid">
            <!-- Benefit 1 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">01</div>
                <span class="benefit-icon">💰</span>
                <div class="benefit-title" data-en>Discounted Acquisition</div>
                <div class="benefit-title-bn" data-bn style="display:none">ছাড়ে মালিকানা ক্রয়</div>
                <div class="benefit-desc" data-en>Spot booking price of ৳4,00,000 against the listed share value of ৳5,00,000
                    — a 20% exclusive discount at launch.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">প্রতিটি শেয়ারের মূল্য ৳৫,০০,০০০ এর বিপরীতে স্পট
                    বুকিং মূল্য মাত্র ৳৪,০০,০০০ — ২০% বিশেষ ছাড়।</div>
            </div>
            <!-- Benefit 2 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">02</div>
                <span class="benefit-icon">📈</span>
                <div class="benefit-title" data-en>Annual Dividend Income</div>
                <div class="benefit-title-bn" data-bn style="display:none">বার্ষিক আয়</div>
                <div class="benefit-desc" data-en>Earn approximately ৳60,000 per share annually — guaranteed, interest-free
                    passive income.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">প্রতি বছর প্রতিটি শেয়ারে প্রায় ৬০ হাজার টাকা
                    নিশ্চিত সুদ মুক্ত আয়ের সুযোগ।</div>
            </div>
            <!-- Benefit 3 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">03</div>
                <span class="benefit-icon">🔄</span>
                <div class="benefit-title" data-en>10% Annual Return Guarantee</div>
                <div class="benefit-title-bn" data-bn style="display:none">১০% মুনাফাসহ রিটার্ন</div>
                <div class="benefit-desc" data-en>The company guarantees the buyback of your share at any time with 10% annual
                    profit included.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">মালিকানা ক্রয়ের পর যেকোনো সময় বার্ষিক ১০% মুনাফাসহ
                    টাকা ফেরত নেওয়ার সুবিধা।</div>
            </div>
            <!-- Benefit 4 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">04</div>
                <span class="benefit-icon">📜</span>
                <div class="benefit-title" data-en>Land & Building Registration</div>
                <div class="benefit-title-bn" data-bn style="display:none">জমি ও বিল্ডিং সাব-কবলা</div>
                <div class="benefit-desc" data-en>Receive sub-kabala registration of 2 sq.ft. land and 17 sq.ft. building
                    space — total 19 sq.ft. in your name.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">২ স্কয়ার ফিট জমি ও ১৭ স্কয়ার ফিট বিল্ডিং — মোট ১৯
                    স্কয়ার ফিট সাব-কবলা রেজিস্ট্রেশন পাবেন।</div>
            </div>
            <!-- Benefit 5 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">05</div>
                <span class="benefit-icon">🏖️</span>
                <div class="benefit-title" data-en>Complimentary Stay</div>
                <div class="benefit-title-bn" data-bn style="display:none">বিনামূল্যে থাকার সুযোগ</div>
                <div class="benefit-desc" data-en>Enjoy 3 days and 2 nights complimentary accommodation per year, plus family
                    discounts throughout the year.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">বছরে তিন দিন দুই রাত বিনামূল্যে থাকার সুযোগ এবং
                    পরিবারের জন্য সারা বছর বিশেষ ছাড়।</div>
            </div>
            <!-- Benefit 6 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">06</div>
                <span class="benefit-icon">💳</span>
                <div class="benefit-title" data-en>Exclusive Reward Card</div>
                <div class="benefit-title-bn" data-bn style="display:none">রিওয়ার্ড কার্ড</div>
                <div class="benefit-desc" data-en>A personal Reward Card granting special discounts across all hotel services,
                    dining, and spa.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">রিওয়ার্ড কার্ডে সকল সার্ভিসে বিশেষ ছাড় পাবেন।
                </div>
            </div>
            <!-- Benefit 7 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">07</div>
                <span class="benefit-icon">🚀</span>
                <div class="benefit-title" data-en>Asset Appreciation</div>
                <div class="benefit-title-bn" data-bn style="display:none">সম্পদের মূল্যবৃদ্ধি</div>
                <div class="benefit-desc" data-en>Hotel shares appreciate 5 to 6 times faster than conventional real estate —
                    a superior wealth creation vehicle.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">অন্যান্য সম্পদের তুলনায় ৫/৬ গুণ বেশি মূল্যবৃদ্ধির
                    সুযোগ।</div>
            </div>
            <!-- Benefit 8 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">08</div>
                <span class="benefit-icon">🏛️</span>
                <div class="benefit-title" data-en>Board Directorship</div>
                <div class="benefit-title-bn" data-bn style="display:none">বোর্ড অব ডিরেক্টর</div>
                <div class="benefit-desc" data-en>Acquire 50 or more shares and earn a prestigious seat on the Board of
                    Directors of Hotel Jana.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">৫০টি শেয়ার ক্রয়ের মাধ্যমে বোর্ড অব ডিরেক্টরের
                    সদস্য হওয়ার সুযোগ।</div>
            </div>
            <!-- Benefit 9 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">09</div>
                <span class="benefit-icon">🏗️</span>
                <div class="benefit-title" data-en>Flexible Payment</div>
                <div class="benefit-title-bn" data-bn style="display:none">কিস্তি সুবিধা</div>
                <div class="benefit-desc" data-en>Convenient monthly instalment options available for hotel share acquisition.
                </div>
                <div class="benefit-desc-bn" data-bn style="display:none">হোটেলে মালিকানা ক্রয়ে মাসিক দীর্ঘমেয়াদি কিস্তির
                    সুবিধা।</div>
            </div>
            <!-- Benefit 10 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">10</div>
                <span class="benefit-icon">👑</span>
                <div class="benefit-title" data-en>Social Prestige</div>
                <div class="benefit-title-bn" data-bn style="display:none">সামাজিক মর্যাদা</div>
                <div class="benefit-desc" data-en>Elevate your social standing. Hotel Jana ownership is a symbol of
                    achievement and a prestigious lifestyle.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">সামাজিক মর্যাদাসহ প্রেস্টিজিয়াস লাইফ উপভোগ করুন।
                </div>
            </div>
            <!-- Benefit 11 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">11</div>
                <span class="benefit-icon">🤝</span>
                <div class="benefit-title" data-en>Market Resale Rights</div>
                <div class="benefit-title-bn" data-bn style="display:none">পুনরায় বিক্রয়ের সুযোগ</div>
                <div class="benefit-desc" data-en>Sell your share back to the company at market value — complete liquidity at
                    your discretion.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">বাজার মূল্যে কোম্পানির কাছে পুনরায় মালিকানা
                    বিক্রয়ের সুযোগ।</div>
            </div>
            <!-- Benefit 12 -->
            <div class="benefit-card reveal">
                <div class="benefit-card-shine"></div>
                <div class="benefit-num">12</div>
                <span class="benefit-icon">🌿</span>
                <div class="benefit-title" data-en>Hereditary Transfer</div>
                <div class="benefit-title-bn" data-bn style="display:none">বংশপরম্পরায় মালিকানা</div>
                <div class="benefit-desc" data-en>Your ownership is transferable through generations — a true family legacy,
                    built in paradise.</div>
                <div class="benefit-desc-bn" data-bn style="display:none">বংশ পরম্পরায় মালিকানা পরিবর্তনের সুবিধা — একটি
                    সত্যিকারের পারিবারিক উত্তরাধিকার।</div>
            </div>
        </div>

        <div style="text-align:center;margin-top:64px" class="reveal">
            <a href="form.html" class="btn-gold"><span data-en>Begin Your Ownership Journey</span><span data-bn
                                                                                                        style="display:none">মালিকানার যাত্রা শুরু করুন</span></a>
        </div>
    </div>
</section>

<!-- ===== SECTION 5: AMENITIES ===== -->
<section id="amenities">
    <div class="amenities-bg"></div>
    <div class="amenities-inner">
        <div class="amenities-header">
            <div class="section-eyebrow reveal" style="justify-content:center" data-en>World-Class Facilities</div>
            <div class="section-eyebrow reveal" style="justify-content:center" data-bn style="display:none">বিশ্বমানের
                সুবিধা সমূহ</div>
            <h2 class="section-title reveal" style="text-align:center">
                <span data-en>Every Desire. Every Detail.<br><em>Delivered.</em></span>
                <span data-bn style="display:none">প্রতিটি ইচ্ছা। প্রতিটি বিস্তারিত।<br><em>পরিপূর্ণ।</em></span>
            </h2>
        </div>

        <div class="amenities-grid">
            <div class="amenity-item reveal"><span class="amenity-icon">🛏️</span>
                <div class="amenity-name" data-en>264 Rooms</div>
                <div class="amenity-name-bn" data-bn style="display:none">২৬৪ টি রুম</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🍹</span>
                <div class="amenity-name" data-en>Juice Bar</div>
                <div class="amenity-name-bn" data-bn style="display:none">জুস বার</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">💆</span>
                <div class="amenity-name" data-en>Jacuzzi</div>
                <div class="amenity-name-bn" data-bn style="display:none">জেড স্পা</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🏊</span>
                <div class="amenity-name" data-en>Rooftop Pool</div>
                <div class="amenity-name-bn" data-bn style="display:none">রুফটপ সুইমিং পুল</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🍽️</span>
                <div class="amenity-name" data-en>Lounge</div>
                <div class="amenity-name-bn" data-bn style="display:none">লঞ্জ</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🐴</span>
                <div class="amenity-name" data-en>Horse Riding</div>
                <div class="amenity-name-bn" data-bn style="display:none">হর্স রাইডিং</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🚁</span>
                <div class="amenity-name" data-en>Helipad</div>
                <div class="amenity-name-bn" data-bn style="display:none">হেলিপ্যাড</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">📋</span>
                <div class="amenity-name" data-en>Meeting Rooms</div>
                <div class="amenity-name-bn" data-bn style="display:none">মিটিং রুম</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🎡</span>
                <div class="amenity-name" data-en>Kids Play Zone</div>
                <div class="amenity-name-bn" data-bn style="display:none">চিলড্রেন প্লে জোন</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🚁</span>
                <div class="amenity-name" data-en>Helicopter</div>
                <div class="amenity-name-bn" data-bn style="display:none">হেলিকপ্টার</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🎭</span>
                <div class="amenity-name" data-en>Hall Room</div>
                <div class="amenity-name-bn" data-bn style="display:none">হল রুম</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">☀️</span>
                <div class="amenity-name" data-en>Sun Bath</div>
                <div class="amenity-name-bn" data-bn style="display:none">সান বাথ উইথ সিকিউরিটি</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🍖</span>
                <div class="amenity-name" data-en>BBQ Corner</div>
                <div class="amenity-name-bn" data-bn style="display:none">বার বি কিউ কর্নার</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🎬</span>
                <div class="amenity-name" data-en>Cinema</div>
                <div class="amenity-name-bn" data-bn style="display:none">সিনেপ্লেক্স</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🚐</span>
                <div class="amenity-name" data-en>Transport Service</div>
                <div class="amenity-name-bn" data-bn style="display:none">নিজস্ব ট্রান্সপোর্ট</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🍴</span>
                <div class="amenity-name" data-en>Restaurant</div>
                <div class="amenity-name-bn" data-bn style="display:none">রেস্তুরেন্ট</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">💅</span>
                <div class="amenity-name" data-en>Spa</div>
                <div class="amenity-name-bn" data-bn style="display:none">স্পা</div>
            </div>
            <div class="amenity-item reveal"><span class="amenity-icon">🏄</span>
                <div class="amenity-name" data-en>Beach Games</div>
                <div class="amenity-name-bn" data-bn style="display:none">বিচ গেমস</div>
            </div>
        </div>

        <p class="reveal"
           style="text-align:center;margin-top:40px;font-family:'Cormorant Garamond',serif;font-size:30px;color:rgb(255, 255, 255);font-style:italic"
           data-en>
            And countless more luxuries to be unveiled. Hotel Jana hands over in December 2030.
        </p>
        <p class="reveal"
           style="text-align:center;margin-top:40px;font-family:'Tiro Bangla',sans-serif;font-size:26px;color:rgb(255, 255, 255)"
           data-bn style="display:none">
            ইত্যাদি আরও অনেক কিছু। হোটেলটি হস্তান্তর হবে ডিসেম্বর ২০৩০ সালে।
        </p>
    </div>
</section>

<!-- ===== SECTION 6: PRIVILEGE CARD ===== -->
<section id="privilege">
    <div class="privilege-bg"></div>
    <div class="privilege-inner">

        <div class="privilege-cards-wrap reveal-left">

            <!-- BACK CARD (behind) -->
            <div class="priv-card priv-back">
                <div class="privilege-card-shine"></div>
                <div
                    style="font-family:'Cinzel',serif; font-size:11px; color:rgba(10,15,30,0.7); font-weight:600; letter-spacing:0.1em; margin-bottom:10px;">
                    Terms &amp; Conditions</div>
                <ul style="list-style:none; padding:0; margin:0 0 10px;">
                    <li class="priv-term" data-en>25% Discount — On Published Room Tariff</li>
                    <li class="priv-term" data-en>25% Discount — Restaurant Dining &amp; Packed Orders <span
                            style="font-size:10px;opacity:0.6;">(Excl. Taxes)</span></li>
                    <li class="priv-term" data-en>15% Discount — Ayurvedic Spa Treatments</li>
                    <li class="priv-term" data-en>10% Discount — In-room Dining Service</li>
                    <li class="priv-term" data-en>Not valid for banqueting, conferences, or special events</li>
                    <li class="priv-term" data-en>Blackout dates as defined by the hotel apply</li>
                    <li class="priv-term" data-bn style="display:none">রুম ট্যারিফে ২৫% ছাড়</li>
                    <li class="priv-term" data-bn style="display:none">রেস্তুরেন্ট ও অর্ডারে ২৫% ছাড়</li>
                    <li class="priv-term" data-bn style="display:none">আয়ুর্বেদিক স্পায় ১৫% ছাড়</li>
                    <li class="priv-term" data-bn style="display:none">ইন-রুম ডাইনিংয়ে ১০% ছাড়</li>
                    <li class="priv-term" data-bn style="display:none">ব্যাংকোয়েটিং বা বিশেষ অনুষ্ঠানে প্রযোজ্য নয়</li>
                    <li class="priv-term" data-bn style="display:none">হোটেল নির্ধারিত ব্ল্যাকআউট তারিখ প্রযোজ্য</li>
                </ul>
                <div class="priv-contact-bar">
                    <span>+88 01896 204401</span>
                    <span>asad@alliancebuildersltd.org</span>
                    <span>www.alliancebuilders.org</span>
                </div>
            </div>

            <!-- FRONT CARD (on top) -->
            <div class="priv-card priv-front">
                <div class="privilege-card-shine"></div>
                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                    <div>
                        <div
                            style="font-family:'Cinzel',serif; font-size:10px; color:rgba(10,15,30,0.5); letter-spacing:0.15em; margin-bottom:3px;">
                            Privilege Card</div>
                        <div class="privilege-hotel-name">HOTEL JANA</div>
                    </div>
                    <div
                        style="font-family:'Cinzel',serif; font-size:9px; color:rgba(10,15,30,0.4); letter-spacing:0.2em; padding-top:4px;">
                        GOLD</div>
                </div>
                <div class="priv-wave-bar"></div>
                <div style="margin-top:auto; padding-top:16px;">
                    <div
                        style="font-family:'Cinzel',serif; font-size:15px; font-weight:600; color:rgba(10,15,30,0.8); letter-spacing:0.05em;">
                        Mr. Farhad</div>
                    <div
                        style="font-family:'Courier New',monospace; font-size:12px; color:rgba(10,15,30,0.5); letter-spacing:0.2em; margin-top:3px;">
                        2024 0089 6654 0321</div>
                </div>
            </div>

        </div>

        <div class="privilege-right reveal-right">
            <div class="section-eyebrow" data-en>The Privilege Card</div>
            <div class="section-eyebrow" data-bn style="display:none">প্রিভিলেজ কার্ড</div>
            <h2 class="section-title">
                <span data-en>Your Key to a Life of<br><em>Unlimited Privilege</em></span>
                <span data-bn style="display:none">সীমাহীন সুবিধার<br><em>জীবনের চাবিকাঠি</em></span>
            </h2>
            <div class="privilege-highlight" data-en>
                "Every share you own opens a door to privileges that money alone cannot buy — a life lived at the pinnacle."
            </div>
            <div class="privilege-highlight privilege-highlight-bn" data-bn style="display:none">
                "আপনার প্রতিটি শেয়ার এমন সুবিধার দরজা খুলে দেয় যা শুধু অর্থ দিয়ে কেনা যায় না।"
            </div>
            <p class="section-body" data-en>
                As a Hotel Jana shareholder, you receive a personal Privilege Card — your golden key to a world of curated
                luxury, reserved only for those who have claimed their place among the elite.
            </p>
            <p class="section-body-bn" data-bn style="display:none">
                হোটেল জানার শেয়ারহোল্ডার হিসেবে আপনি পাবেন একটি ব্যক্তিগত প্রিভিলেজ কার্ড।
            </p>
            <div style="margin-top:36px">
                <a href="form.html" class="btn-gold"><span data-en>Claim Your Privilege</span><span data-bn
                                                                                                    style="display:none">আপনার সুবিধা নিন</span></a>
            </div>
        </div>

    </div>
</section>

<!-- ===== SECTION 7: CINEMATIC CTA ===== -->
<section id="invest">
    <div class="invest-bg"></div>
    <div class="invest-overlay"></div>
    <div class="invest-content">
        <div class="reveal">
            <div class="gold-divider" style="justify-content:center;margin-bottom:32px">
                <div class="gold-divider-line"></div>
                <div class="gold-divider-diamond"></div>
                <div class="gold-divider-line right"></div>
            </div>
        </div>

        <p class="invest-quote reveal" data-en>
            "The sun rises from the sea here — and so does your fortune."
        </p>
        <p class="invest-quote-bn reveal" data-bn style="display:none">
            "এখানে সূর্য সমুদ্র থেকে উদয় হয় — আর তেমনিভাবে উদয় হয় আপনার ভাগ্যও।"
        </p>

        <div class="invest-price-wrap reveal">
            <span class="invest-price-old">৳5,00,000</span>
            <span class="invest-price">৳4,00,000</span>
            <span class="invest-price-unit">/share</span>
        </div>

        <div class="invest-discount reveal" data-en>✦ SPOT BOOKING — 20% EXCLUSIVE DISCOUNT ✦</div>
        <div class="invest-discount reveal" data-bn style="display:none">✦ স্পট বুকিং — ২০% বিশেষ ছাড় ✦</div>

        <p class="reveal"
           style="font-family:'Cormorant Garamond',serif;font-size:22px;color:rgba(232,220,200,0.6);font-style:italic;max-width:600px;margin:0 auto 48px"
           data-en>
            Limited shares. Unlimited legacy. The sea does not wait — and neither should you.
        </p>
        <p class="reveal"
           style="font-family:'Tiro Bangla',sans-serif;font-size:17px;color:rgba(232,220,200,0.6);max-width:600px;margin:0 auto 48px"
           data-bn style="display:none">
            সীমিত শেয়ার। অসীম উত্তরাধিকার। সমুদ্র অপেক্ষা করে না — আপনারও করা উচিত নয়।
        </p>

        <div class="reveal" style="display:flex;gap:20px;justify-content:center;flex-wrap:wrap">
            <a href="form.html" class="btn-gold"><span data-en>Reserve My Share Now</span><span data-bn
                                                                                                style="display:none">এখনই শেয়ার সংরক্ষণ করুন</span></a>
            <a href="tel:+8801994045693" class="btn-outline" data-en>Speak to an Advisor</a>
            <a href="tel:+8801994045693" class="btn-outline" data-bn style="display:none">পরামর্শকের সাথে কথা বলুন</a>
        </div>
    </div>
</section>

<!-- ===== SECTION 8: BRAND ===== -->
<section id="brand" style="scroll-snap-align:start">
    <div class="brand-inner">
        <div class="brand-header">
            <div class="brand-iso reveal">
                <span>✦</span>
                <span data-en>Alliance Group — ISO 9001:2015 Certified</span>
                <span data-bn style="display:none">অ্যালায়েন্স গ্রুপ — ISO 9001:2015 সার্টিফাইড</span>
                <span>✦</span>
            </div>
            <h2 class="section-title reveal" style="text-align:center">
                <span data-en>A <em>Legacy</em> of Excellence</span>
                <span data-bn style="display:none">উৎকর্ষতার <em>উত্তরাধিকার</em></span>
            </h2>
            <p class="section-body reveal" style="max-width:600px;margin:0 auto;text-align:center" data-en>
                Hotel Jana is brought to you by Alliance Group — a family of six distinguished companies committed to building
                Bangladesh's future.
            </p>
            <p class="section-body-bn reveal" style="max-width:600px;margin:0 auto;text-align:center" data-bn
               style="display:none">
                হোটেল জানা আপনার কাছে নিয়ে এসেছে অ্যালায়েন্স গ্রুপ — ছয়টি বিশিষ্ট কোম্পানির একটি পরিবার।
            </p>
        </div>

        <div class="brand-grid">
            <div class="brand-card reveal"><span class="brand-card-icon">🏗️</span>
                <div class="brand-card-name">Alliance Builders Ltd.</div>
                <div class="brand-card-dot"></div>
            </div>
            <div class="brand-card reveal"><span class="brand-card-icon">📊</span>
                <div class="brand-card-name">Alliance Brokerage Ltd.</div>
                <div class="brand-card-dot"></div>
            </div>
            <div class="brand-card reveal"><span class="brand-card-icon">🏆</span>
                <div class="brand-card-name">Alliance Success Builders Ltd.</div>
                <div class="brand-card-dot"></div>
            </div>
            <div class="brand-card reveal"><span class="brand-card-icon">🏛️</span>
                <div class="brand-card-name">Alliance Construction Ltd.</div>
                <div class="brand-card-dot"></div>
            </div>
            <div class="brand-card reveal"><span class="brand-card-icon">🌊</span>
                <div class="brand-card-name">Hotel Jana Ltd.</div>
                <div class="brand-card-dot"></div>
            </div>
            <div class="brand-card reveal"><span class="brand-card-icon">🍃</span>
                <div class="brand-card-name">Alliance Food & Beverage Ltd.</div>
                <div class="brand-card-dot"></div>
            </div>
        </div>

        <div class="gold-line-deco reveal"></div>

        <div style="text-align:center;padding:0 0 20px" class="reveal">
            <p style="font-family:'Cormorant Garamond',serif;font-size:18px;color:rgba(232,220,200,0.45);letter-spacing:0.1em"
               data-en>
                www.alliancebuilders.org &nbsp;·&nbsp; www.hoteljanabd.com
            </p>
            <p style="font-family:'Tiro Bangla',sans-serif;font-size:15px;color:rgba(232,220,200,0.45);margin-top:4px"
               data-bn style="display:none">
                www.alliancebuilders.org &nbsp;·&nbsp; www.hoteljanabd.com
            </p>
        </div>
    </div>
</section>

<!-- ===== CONTACT STRIP ===== -->
<div id="contact">
    <div class="contact-inner">
        <div class="contact-info">
            <div class="contact-label" data-en>Head Office</div>
            <div class="contact-label" data-bn style="display:none">প্রধান কার্যালয়</div>
            <div class="contact-value">
                Ahmud Villa, House #640 (1st Floor)<br>
                West Kazipara, Mirpur, Dhaka-1216
            </div>
        </div>

        <div class="contact-center">
            <span class="footer-logo">JANA</span>
            <span class="footer-sub" data-en>WHERE THE BAY MEETS INFINITY</span>
            <span class="footer-sub" data-bn style="display:none">যেখানে সমুদ্র মিলিত হয় অনন্তের সাথে</span>
        </div>

        <div class="contact-info" style="text-align:right">
            <div class="contact-label" data-en>Contact</div>
            <div class="contact-label" data-bn style="display:none">যোগাযোগ</div>
            <div class="contact-value">
                <a href="tel:+8801994045693">+88 01994 045693</a><br>
                <a href="tel:+8801994045705">+88 01994 045705</a><br>
                <a href="mailto:asad@alliancebuildersltd.org">asad@alliancebuildersltd.org</a>
            </div>
        </div>
    </div>
</div>

<script>
    // CUSTOM CURSOR
    const cursor = document.getElementById('cursor');
    const cursorRing = document.getElementById('cursorRing');
    let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;

    document.addEventListener('mousemove', e => {
        mouseX = e.clientX; mouseY = e.clientY;
        cursor.style.left = mouseX + 'px';
        cursor.style.top = mouseY + 'px';
    });

    function animateRing() {
        ringX += (mouseX - ringX) * 0.12;
        ringY += (mouseY - ringY) * 0.12;
        cursorRing.style.left = ringX + 'px';
        cursorRing.style.top = ringY + 'px';
        requestAnimationFrame(animateRing);
    }
    animateRing();

    document.querySelectorAll('a, button, .gallery-item, .benefit-card, .amenity-item, .lang-orb').forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.width = '16px';
            cursor.style.height = '16px';
            cursorRing.style.width = '52px';
            cursorRing.style.height = '52px';
            cursorRing.style.borderColor = 'rgba(40,172,226,0.8)';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.width = '8px';
            cursor.style.height = '8px';
            cursorRing.style.width = '36px';
            cursorRing.style.height = '36px';
            cursorRing.style.borderColor = 'rgba(40,172,226,0.5)';
        });
    });

    // PARTICLES
    const particlesContainer = document.getElementById('particles');
    function createParticle() {
        const p = document.createElement('div');
        p.className = 'particle';
        const size = Math.random() * 3 + 1;
        p.style.cssText = `
    width:${size}px;height:${size}px;
    left:${Math.random() * 100}%;
    animation-duration:${Math.random() * 10 + 8}s;
    animation-delay:${Math.random() * 8}s;
    opacity:0;
  `;
        particlesContainer.appendChild(p);
        setTimeout(() => p.remove(), 20000);
    }
    setInterval(createParticle, 600);
    for (let i = 0; i < 8; i++) createParticle();

    // NAV SCROLL
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('mainNav');
        nav.classList.toggle('scrolled', window.scrollY > 60);
    });

    // REVEAL ON SCROLL
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                // Stagger children if parent
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach((el, i) => {
        el.style.transitionDelay = (i % 4) * 0.08 + 's';
        observer.observe(el);
    });

    // LANGUAGE TOGGLE
    let currentLang = 'en';

    function toggleLang() {
        currentLang = currentLang === 'en' ? 'bn' : 'en';
        const orb = document.getElementById('langToggle');

        if (currentLang === 'bn') {
            document.body.classList.add('lang-bn');
            orb.classList.add('bn');
            // Show bn elements, hide en
            document.querySelectorAll('[data-en]').forEach(el => el.style.display = 'none');
            document.querySelectorAll('[data-bn]').forEach(el => {
                // Restore display based on tag
                const tag = el.tagName.toLowerCase();
                if (tag === 'div' || tag === 'p' || tag === 'h1' || tag === 'h2' || tag === 'ul') {
                    el.style.display = 'block';
                } else if (tag === 'a' || tag === 'span') {
                    el.style.display = 'inline-block';
                } else {
                    el.style.display = 'block';
                }
            });
        } else {
            document.body.classList.remove('lang-bn');
            orb.classList.remove('bn');
            document.querySelectorAll('[data-bn]').forEach(el => el.style.display = 'none');
            document.querySelectorAll('[data-en]').forEach(el => {
                const tag = el.tagName.toLowerCase();
                if (tag === 'div' || tag === 'p' || tag === 'h1' || tag === 'h2' || tag === 'ul') {
                    el.style.display = 'block';
                } else if (tag === 'a' || tag === 'span') {
                    el.style.display = 'inline-block';
                } else {
                    el.style.display = 'block';
                }
            });
        }
    }

    // HERO MOUSE PARALLAX
    const heroBg = document.querySelector('.hero-bg');
    document.getElementById('hero').addEventListener('mousemove', e => {
        const x = (e.clientX / window.innerWidth - 0.5) * 20;
        const y = (e.clientY / window.innerHeight - 0.5) * 10;
        heroBg.style.transform = `scale(1.08) translate(${x}px, ${y}px)`;
    });

    // SMOOTH SCROLL
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });

    // CARD 3D tilt
    document.querySelectorAll('.benefit-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            card.style.transform = `perspective(600px) rotateY(${x * 8}deg) rotateX(${-y * 8}deg) scale(1.02)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
</script>
</body>

</html>
