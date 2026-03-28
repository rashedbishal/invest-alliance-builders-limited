<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Your Share — Hotel Jana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Cinzel:wght@400;500;600;700&family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #28ace2;
            --gold-light: #4fc3f0;
            --gold-pale: #cceeff;
            --deep-navy: #0A0F1E;
            --ocean-dark: #060D1A;
            --ocean-mid: #0D2137;
            --cream: #F7F1E8;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            background: var(--ocean-dark);
            color: var(--cream);
            font-family: 'Cormorant Garamond', serif;
            min-height: 100vh; cursor: none;
            overflow-x: hidden;
        }
        .cursor { position:fixed;width:8px;height:8px;background:var(--gold);border-radius:50%;pointer-events:none;z-index:99999;transform:translate(-50%,-50%); }
        .cursor-ring { position:fixed;width:36px;height:36px;border:1px solid rgba(40,172,226,0.5);border-radius:50%;pointer-events:none;z-index:99998;transform:translate(-50%,-50%);transition:all 0.15s ease; }

        .page-bg {
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 0% 50%, rgba(7,115,187,0.15) 0%, transparent 60%),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&q=70') center/cover;
            z-index: 0;
        }
        .page-overlay {
            position: fixed; inset: 0;
            background: linear-gradient(135deg, rgba(6,13,26,0.94) 0%, rgba(6,13,26,0.85) 100%);
            z-index: 1;
        }

        .page-inner {
            position: relative; z-index: 2;
            min-height: 100vh;
            display: grid; grid-template-columns: 1fr 1fr;
        }

        /* LEFT PANEL */
        .left-panel {
            padding: 80px 60px;
            display: flex; flex-direction: column; justify-content: center;
            border-right: 1px solid rgba(40,172,226,0.12);
            position: relative; overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute; top: -100px; left: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(40,172,226,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .back-link {
            font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 0.3em;
            color: rgba(40,172,226,0.6); text-decoration: none;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 60px; transition: color 0.3s;
        }
        .back-link:hover { color: var(--gold); }
        .back-link::before { content: '←'; font-size: 14px; }

        .left-eyebrow {
            font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 0.5em;
            color: var(--gold); text-transform: uppercase; margin-bottom: 16px;
        }
        .left-title {
            font-family: 'Cinzel', serif; font-size: clamp(32px, 4vw, 52px);
            font-weight: 400; color: var(--cream); line-height: 1.15; margin-bottom: 24px;
        }
        .left-title em { color: var(--gold); font-style: italic; font-family: 'Cormorant Garamond', serif; }
        .left-body {
            font-family: 'Cormorant Garamond', serif; font-size: 18px;
            color: rgba(232,220,200,0.6); line-height: 1.9; font-weight: 300; margin-bottom: 48px;
        }

        .offer-box {
            background: rgba(40,172,226,0.06);
            border: 1px solid rgba(40,172,226,0.2);
            padding: 28px 32px; margin-bottom: 36px;
        }
        .offer-box-title {
            font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 0.4em;
            color: var(--gold); margin-bottom: 16px; text-transform: uppercase;
        }
        .offer-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0; border-bottom: 1px solid rgba(40,172,226,0.1);
        }
        .offer-row:last-child { border-bottom: none; }
        .offer-key { font-family: 'Cormorant Garamond', serif; font-size: 16px; color: rgba(232,220,200,0.6); }
        .offer-val { font-family: 'Cinzel', serif; font-size: 13px; color: var(--gold); }

        .left-contacts { display: flex; flex-direction: column; gap: 8px; }
        .left-contacts a {
            font-family: 'Cormorant Garamond', serif; font-size: 16px;
            color: rgba(232,220,200,0.5); text-decoration: none; transition: color 0.3s;
        }
        .left-contacts a:hover { color: var(--gold); }

        /* RIGHT PANEL */
        .right-panel { padding: 60px 60px; display: flex; flex-direction: column; justify-content: center; }

        .form-title {
            font-family: 'Cinzel', serif; font-size: 13px; letter-spacing: 0.3em;
            color: rgba(40,172,226,0.7); text-transform: uppercase; margin-bottom: 32px;
        }

        /* FIELDS */
        .form-group { margin-bottom: 20px; position: relative; }
        .form-label {
            display: block; font-family: 'Cinzel', serif; font-size: 9px;
            letter-spacing: 0.4em; color: rgba(40,172,226,0.85);
            text-transform: uppercase; margin-bottom: 7px;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(40,172,226,0.28);
            color: rgba(247,241,232,0.95);
            font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 300;
            padding: 13px 16px;
            outline: none;
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
            backdrop-filter: blur(12px);
            -webkit-appearance: none;
            border-radius: 2px;
        }
        .form-input::placeholder, .form-textarea::placeholder { color: rgba(247,241,232,0.3); }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: rgba(40,172,226,0.65);
            background: rgba(255,255,255,0.12);
            box-shadow: 0 0 0 3px rgba(40,172,226,0.09), inset 0 1px 0 rgba(255,255,255,0.05);
        }
        .form-input:focus + .form-line,
        .form-select:focus + .form-line,
        .form-textarea:focus + .form-line { width: 100%; }
        .form-line { position:absolute; bottom:0; left:0; height:1px; width:0; background:var(--gold); transition:width 0.4s ease; }
        .form-select option { background: #0D2137; color: var(--cream); }
        .form-textarea { min-height: 80px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* DISPLAY ROWS */
        .form-display {
            background: rgba(40,172,226,0.07);
            border: 1px solid rgba(40,172,226,0.2);
            padding: 13px 16px;
            display: flex; justify-content: space-between; align-items: center;
            border-radius: 2px;
        }
        .form-display-label {
            font-family: 'Cinzel', serif; font-size: 9px; letter-spacing: 0.3em;
            color: rgba(40,172,226,0.7); text-transform: uppercase;
        }
        .form-display-val {
            font-family: 'Cinzel', serif; font-size: 15px; color: var(--gold); letter-spacing: 0.05em;
        }

        /* PAYMENT TABS */
        .payment-tabs {
            display: flex; gap: 0;
            border: 1px solid rgba(40,172,226,0.25); border-radius: 2px; overflow: hidden;
        }
        .pay-tab {
            flex: 1; padding: 12px;
            font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 0.2em;
            text-transform: uppercase; text-align: center;
            cursor: pointer; border: none; outline: none;
            background: rgba(255,255,255,0.04);
            color: rgba(247,241,232,0.4);
            transition: all 0.3s;
            border-right: 1px solid rgba(40,172,226,0.2);
        }
        .pay-tab:last-child { border-right: none; }
        .pay-tab.active {
            background: rgba(40,172,226,0.15);
            color: var(--gold);
            box-shadow: inset 0 -2px 0 var(--gold);
        }
        .pay-tab:hover:not(.active) { background: rgba(40,172,226,0.07); color: rgba(247,241,232,0.7); }

        /* SUBMIT */
        .form-submit {
            width: 100%; margin-top: 8px;
            font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 0.4em;
            text-transform: uppercase; color: #0A0F1E;
            background: linear-gradient(135deg, #0773bb, #28ace2, #4fc3f0);
            border: none; padding: 20px; cursor: pointer;
            position: relative; overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 2px;
        }
        .form-submit::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, #4fc3f0, #28ace2, #0773bb);
            opacity: 0; transition: opacity 0.3s;
        }
        .form-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(40,172,226,0.35); }
        .form-submit:hover::before { opacity: 1; }
        .form-submit span { position: relative; z-index: 1; }

        .form-error {
            font-family: 'Cormorant Garamond', serif; font-size: 15px;
            color: #f87171; margin-top: 10px; display: none;
        }
        .form-note {
            margin-top: 16px;
            font-family: 'Cormorant Garamond', serif; font-size: 14px;
            color: rgba(232,220,200,0.3); text-align: center; line-height: 1.7;
        }

        /* SUCCESS */
        .success-screen { display:none; text-align:center; padding:40px 0; }
        .success-icon {
            width:80px; height:80px; border:2px solid var(--gold); border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            margin:0 auto 32px; font-size:32px;
            animation: successPop 0.6s cubic-bezier(0.68,-0.55,0.27,1.55) forwards;
        }
        @keyframes successPop { from{transform:scale(0);opacity:0;} to{transform:scale(1);opacity:1;} }

        .gold-divider { display:flex; align-items:center; gap:16px; margin:32px 0; }
        .gold-divider-line { height:1px; flex:1; background:linear-gradient(to right,transparent,rgba(40,172,226,0.4)); }
        .gold-divider-line.right { background:linear-gradient(to left,transparent,rgba(40,172,226,0.4)); }
        .gold-divider-diamond { width:6px; height:6px; background:var(--gold); transform:rotate(45deg); }

        /* LANG SWITCH */
        .lang-switch { position:fixed; top:28px; right:32px; z-index:9999; }
        .lang-orb { width:60px; height:28px; background:rgba(10,15,30,0.8); border:1px solid rgba(40,172,226,0.4); border-radius:20px; position:relative; cursor:pointer; backdrop-filter:blur(12px); transition:border-color 0.3s; display:flex; align-items:center; padding:0 4px; justify-content:space-between; }
        .lang-orb:hover { border-color:var(--gold); }
        .lang-orb .lang-label { font-family:'Cinzel',serif; font-size:8px; letter-spacing:0.05em; color:var(--gold); font-weight:600; line-height:1; z-index:1; position:relative; padding:0 2px; }
        .lang-orb .lang-ball { position:absolute; width:26px; height:16px; background:linear-gradient(135deg,#0773bb,#28ace2); border-radius:999px; top:50%; transform:translateY(-50%); left:3px; transition:left 0.4s cubic-bezier(0.68,-0.55,0.27,1.55); box-shadow:0 0 8px rgba(40,172,226,0.5); }
        .lang-orb.bn .lang-ball { left:calc(100% - 29px); }

        [data-bn] { display:none; }

        @media(max-width:900px) {
            .page-inner { grid-template-columns:1fr; }
            .left-panel { border-right:none; border-bottom:1px solid rgba(40,172,226,0.12); padding:60px 32px; }
            .right-panel { padding:60px 32px; }
            .form-row { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<div class="lang-switch">
    <div class="lang-orb" id="langToggle" onclick="toggleLang()">
        <span class="lang-label">EN</span>
        <div class="lang-ball"></div>
        <span class="lang-label">বাং</span>
    </div>
</div>

<div class="page-bg"></div>
<div class="page-overlay"></div>

<div class="page-inner">

    <!-- LEFT PANEL -->
    <div class="left-panel">
        <a href="hotel-jana-landing.html" class="back-link" data-en>Back to Hotel Jana</a>
        <a href="hotel-jana-landing.html" class="back-link" data-bn style="display:none">হোটেল জানায় ফিরুন</a>

        <div class="left-eyebrow" data-en>Ownership Reservation</div>
        <div class="left-eyebrow" data-bn style="display:none">মালিকানা সংরক্ষণ</div>

        <h1 class="left-title">
            <span data-en>Begin Your<br>Journey Into<br><em>Paradise</em></span>
            <span data-bn style="display:none">স্বর্গের পথে<br><em>যাত্রা শুরু করুন</em></span>
        </h1>

        <div class="gold-divider">
            <div class="gold-divider-line"></div>
            <div class="gold-divider-diamond"></div>
            <div class="gold-divider-line right"></div>
        </div>

        <p class="left-body" data-en>
            Our ownership consultants are standing by to guide you through one of the finest investment decisions of your life. Complete the form — and the sea will do the rest.
        </p>
        <p class="left-body" style="font-family:'Tiro Bangla',serif;" data-bn style="display:none">
            আমাদের মালিকানা পরামর্শদাতারা আপনার জীবনের অন্যতম সেরা বিনিয়োগের সিদ্ধান্ত নিতে সহায়তার জন্য প্রস্তুত।
        </p>

        <div class="offer-box">
            <div class="offer-box-title" data-en>Current Offer</div>
            <div class="offer-box-title" data-bn style="display:none">বর্তমান অফার</div>
            <div class="offer-row">
                <span class="offer-key" data-en>Listed Price</span>
                <span class="offer-key" data-bn style="display:none">তালিকা মূল্য</span>
                <span class="offer-val" style="text-decoration:line-through;opacity:0.5">৳ 5,00,000</span>
            </div>
            <div class="offer-row">
                <span class="offer-key" data-en>Spot Booking Price</span>
                <span class="offer-key" data-bn style="display:none">স্পট বুকিং মূল্য</span>
                <span class="offer-val">৳ 4,00,000</span>
            </div>
            <div class="offer-row">
                <span class="offer-key" data-en>Annual Dividend</span>
                <span class="offer-key" data-bn style="display:none">বার্ষিক আয়</span>
                <span class="offer-val">~ ৳ 60,000 / share</span>
            </div>
            <div class="offer-row">
                <span class="offer-key" data-en>Land Registration</span>
                <span class="offer-key" data-bn style="display:none">জমি রেজিস্ট্রেশন</span>
                <span class="offer-val">19 sq.ft. Sub-Kabala</span>
            </div>
            <div class="offer-row">
                <span class="offer-key" data-en>Complimentary Stay</span>
                <span class="offer-key" data-bn style="display:none">বিনামূল্যে থাকা</span>
                <span class="offer-val">3 Days / Year</span>
            </div>
        </div>

        <div class="left-contacts">
            <a href="tel:+8801994045693">📞 +88 01994 045693</a>
            <a href="tel:+8801994045705">📞 +88 01994 045705</a>
            <a href="mailto:asad@alliancebuildersltd.org">✉️ asad@alliancebuildersltd.org</a>
            <a href="https://www.hoteljanabd.com" target="_blank">🌐 www.hoteljanabd.com</a>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
        <div class="form-title" data-en>✦ &nbsp; Share Booking Form &nbsp; ✦</div>
        <div class="form-title" data-bn style="display:none">✦ &nbsp; শেয়ার বুকিং ফর্ম &nbsp; ✦</div>

        <div id="formWrap">
            <form id="bookingForm" onsubmit="handleSubmit(event)">

                <!-- Name & Phone -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" data-en>Full Name *</label>
                        <label class="form-label" data-bn style="display:none">পূর্ণ নাম *</label>
                        <input class="form-input" type="text" id="name" name="name" placeholder="Your full name" required>
                        <div class="form-line"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" data-en>Phone Number *</label>
                        <label class="form-label" data-bn style="display:none">ফোন নম্বর *</label>
                        <input class="form-input" type="tel" id="phone" name="phone" placeholder="+880 XXXX XXXXXX" required>
                        <div class="form-line"></div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" data-en>Email Address (Optional)</label>
                    <label class="form-label" data-bn style="display:none">ইমেইল ঠিকানা (ঐচ্ছিক)</label>
                    <input class="form-input" type="email" id="email" name="email" placeholder="your@email.com">
                    <div class="form-line"></div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label class="form-label" data-en>Your Address</label>
                    <label class="form-label" data-bn style="display:none">আপনার ঠিকানা</label>
                    <input class="form-input" type="text" id="address" name="address" placeholder="City, District">
                    <div class="form-line"></div>
                </div>

                <!-- Unit Price -->
                <div class="form-group">
                    <label class="form-label" data-en>Unit Price Per Share (BDT)</label>
                    <label class="form-label" data-bn style="display:none">প্রতি শেয়ারের মূল্য (BDT)</label>
                    <div class="form-display">
                        <span class="form-display-label" data-en>Spot Booking Price</span>
                        <span class="form-display-label" data-bn style="display:none">স্পট বুকিং মূল্য</span>
                        <span class="form-display-val" id="unitprice">৳ 4,00,000</span>
                    </div>
                </div>

                <!-- Share Count -->
                <div class="form-group">
                    <label class="form-label" data-en>Number of Shares *</label>
                    <label class="form-label" data-bn style="display:none">শেয়ারের সংখ্যা *</label>
                    <input class="form-input" type="number" id="count" name="count" min="1" value="1" required>
                    <div class="form-line"></div>
                </div>

                <!-- Total Price -->
                <div class="form-group">
                    <label class="form-label" data-en>Total Investment (BDT)</label>
                    <label class="form-label" data-bn style="display:none">মোট বিনিয়োগ (BDT)</label>
                    <div class="form-display">
                        <span class="form-display-label" data-en>Total Amount</span>
                        <span class="form-display-label" data-bn style="display:none">মোট পরিমাণ</span>
                        <span class="form-display-val" id="totalprice">৳ 4,00,000</span>
                    </div>
                </div>

                <!-- Payment Tabs -->
                <div class="form-group">
                    <label class="form-label" data-en>Payment Method *</label>
                    <label class="form-label" data-bn style="display:none">পেমেন্ট পদ্ধতি *</label>
                    <div class="payment-tabs">
                        <button type="button" class="pay-tab active" id="oneTimeTab">
                            <span data-en>One-Time Payment</span>
                            <span data-bn style="display:none">এককালীন পেমেন্ট</span>
                        </button>
                        <button type="button" class="pay-tab" id="installmentTab">
                            <span data-en>Instalment</span>
                            <span data-bn style="display:none">কিস্তি</span>
                        </button>
                    </div>
                </div>

                <!-- One-Time Section -->
                <div id="oneTimeSection" class="form-group">
                    <label class="form-label" data-en>Full Payment Amount</label>
                    <label class="form-label" data-bn style="display:none">সম্পূর্ণ পেমেন্ট পরিমাণ</label>
                    <input class="form-input" type="number" id="fullAmount" placeholder="Enter full amount">
                    <div class="form-line"></div>
                </div>

                <!-- Instalment Section -->
                <div id="installmentSection" style="display:none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" data-en>Down Payment</label>
                            <label class="form-label" data-bn style="display:none">ডাউন পেমেন্ট</label>
                            <input class="form-input" type="number" id="downPayment" placeholder="Down payment amount">
                            <div class="form-line"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" data-en>No. of Instalments</label>
                            <label class="form-label" data-bn style="display:none">কিস্তির সংখ্যা</label>
                            <input class="form-input" type="number" id="installments" placeholder="e.g. 12">
                            <div class="form-line"></div>
                        </div>
                    </div>
                </div>

                <!-- How did you hear -->
                <div class="form-group">
                    <label class="form-label" data-en>How Did You Hear About Us?</label>
                    <label class="form-label" data-bn style="display:none">কিভাবে জানলেন?</label>
                    <select class="form-select" id="source">
                        <option value="">Select source</option>
                        <option value="referral">Friend / Referral</option>
                        <option value="social">Social Media</option>
                        <option value="event">Event / Seminar</option>
                        <option value="web">Website</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="form-line"></div>
                </div>

                <!-- Error -->
                <p class="form-error" id="error"></p>

                <!-- Submit -->
                <button
                    id="sslczPayBtn"
                    type="submit"
                    token="if you have any token validation"
                    postdata=""
                    order=" "
                    endpoint="{{ url('/pay-via-ajax') }}"
                    class="form-submit">
                    <span data-en>✦ &nbsp; Submit Booking &nbsp; ✦</span>
                    <span data-bn style="display:none">✦ &nbsp; বুকিং জমা দিন &nbsp; ✦</span>
                </button>

                <p class="form-note" data-en>
                    Your information is held in complete confidence. An Alliance Group representative will contact you within 24 hours.
                </p>
                <p class="form-note" style="font-family:'Tiro Bangla',serif;" data-bn style="display:none">
                    আপনার তথ্য সম্পূর্ণ গোপনীয়। অ্যালায়েন্স গ্রুপের একজন প্রতিনিধি ২৪ ঘণ্টার মধ্যে যোগাযোগ করবেন।
                </p>

            </form>
        </div>

        <!-- SUCCESS -->
        <div class="success-screen" id="successScreen">
            <div class="success-icon">✦</div>
            <h2 style="font-family:'Cinzel',serif;font-size:28px;color:var(--gold);margin-bottom:16px" data-en>Booking Received</h2>
            <h2 style="font-family:'Cinzel',serif;font-size:28px;color:var(--gold);margin-bottom:16px;display:none" data-bn>বুকিং পাওয়া গেছে</h2>
            <p style="font-family:'Cormorant Garamond',serif;font-size:20px;color:rgba(232,220,200,0.6);line-height:1.8;max-width:400px;margin:0 auto 32px" data-en>
                Thank you. A Hotel Jana ownership consultant will reach you shortly. Your journey into paradise has begun.
            </p>
            <p style="font-family:'Tiro Bangla',serif;font-size:16px;color:rgba(232,220,200,0.6);line-height:1.9;max-width:400px;margin:0 auto 32px;display:none" data-bn>
                আপনাকে ধন্যবাদ। একজন হোটেল জানা পরামর্শদাতা শীঘ্রই যোগাযোগ করবেন।
            </p>
            <div class="gold-divider" style="justify-content:center">
                <div class="gold-divider-line" style="max-width:80px"></div>
                <div class="gold-divider-diamond"></div>
                <div class="gold-divider-line right" style="max-width:80px"></div>
            </div>
            <a href="hotel-jana-landing.html" style="font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.3em;color:var(--gold);text-decoration:none;display:block;margin-top:24px" data-en>← Return to Hotel Jana</a>
            <a href="hotel-jana-landing.html" style="font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.3em;color:var(--gold);text-decoration:none;display:none;margin-top:24px" data-bn>← হোটেল জানায় ফিরুন</a>
        </div>
    </div>

</div>



<!-- SSLCommerz -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>
    (function(window, document) {
        var loader = function() {
            var script = document.createElement("script"),
                tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };
        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

<script>
    // CURSOR
    const cursor = document.getElementById('cursor');
    const cursorRing = document.getElementById('cursorRing');
    let mouseX=0, mouseY=0, ringX=0, ringY=0;
    document.addEventListener('mousemove', e => {
        mouseX = e.clientX; mouseY = e.clientY;
        cursor.style.left = mouseX + 'px';
        cursor.style.top  = mouseY + 'px';
    });
    function animateRing() {
        ringX += (mouseX - ringX) * 0.12;
        ringY += (mouseY - ringY) * 0.12;
        cursorRing.style.left = ringX + 'px';
        cursorRing.style.top  = ringY + 'px';
        requestAnimationFrame(animateRing);
    }
    animateRing();

    // UNIT PRICE
    const UNIT_PRICE = 400000;

    // TOTAL CALCULATOR
    document.getElementById('count').addEventListener('input', function() {
        const count = parseInt(this.value) || 1;
        const total = count * UNIT_PRICE;
        document.getElementById('totalprice').textContent = '৳ ' + total.toLocaleString('en-BD');
    });

    // PAYMENT TABS
    let paymentType = 'one-time';

    function activateTab(type) {
        paymentType = type;
        const oneTimeSection     = document.getElementById('oneTimeSection');
        const installmentSection = document.getElementById('installmentSection');
        const oneTimeTab         = document.getElementById('oneTimeTab');
        const installmentTab     = document.getElementById('installmentTab');

        if(type === 'one-time') {
            oneTimeSection.style.display     = 'block';
            installmentSection.style.display = 'none';
            oneTimeTab.classList.add('active');
            installmentTab.classList.remove('active');
        } else {
            oneTimeSection.style.display     = 'none';
            installmentSection.style.display = 'block';
            installmentTab.classList.add('active');
            oneTimeTab.classList.remove('active');
        }
    }

    document.getElementById('oneTimeTab').addEventListener('click',     () => activateTab('one-time'));
    document.getElementById('installmentTab').addEventListener('click', () => activateTab('installment'));

    // SSLCOMMERZ postdata
    document.getElementById('sslczPayBtn').addEventListener('click', function() {
        var obj = {};
        obj.cus_name      = document.getElementById('name').value;
        obj.cus_phone     = document.getElementById('phone').value;
        obj.cus_email     = document.getElementById('email').value;
        obj.cus_addr1     = document.getElementById('address').value;
        obj.cus_unit      = document.getElementById('count').value;
        obj.cus_unitprice = UNIT_PRICE;
        obj.cus_amount    = (parseInt(document.getElementById('count').value) || 1) * UNIT_PRICE;
        $('#sslczPayBtn').prop('postdata', obj);
    });

    // FORM VALIDATION + SUBMIT
    function handleSubmit(e) {
        e.preventDefault();
        const name  = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const error = document.getElementById('error');

        if(!name || !phone) {
            error.style.display = 'block';
            error.innerText = 'Please fill in all required fields.';
            return;
        }
        if(paymentType === 'one-time' && !document.getElementById('fullAmount').value) {
            error.style.display = 'block';
            error.innerText = 'Please enter the full payment amount.';
            return;
        }
        if(paymentType === 'installment') {
            if(!document.getElementById('downPayment').value || !document.getElementById('installments').value) {
                error.style.display = 'block';
                error.innerText = 'Please complete the instalment details.';
                return;
            }
        }
        error.style.display = 'none';

        const wrap = document.getElementById('formWrap');
        wrap.style.opacity    = '0';
        wrap.style.transform  = 'translateY(-20px)';
        wrap.style.transition = 'all 0.4s';
        setTimeout(() => {
            wrap.style.display = 'none';
            const s = document.getElementById('successScreen');
            s.style.display    = 'block';
            s.style.opacity    = '0';
            s.style.transform  = 'translateY(20px)';
            s.style.transition = 'all 0.5s';
            requestAnimationFrame(() => {
                s.style.opacity   = '1';
                s.style.transform = 'translateY(0)';
            });
        }, 400);
    }

    // LANG TOGGLE
    let currentLang = 'en';
    function toggleLang() {
        currentLang = currentLang === 'en' ? 'bn' : 'en';
        const orb = document.getElementById('langToggle');
        if(currentLang === 'bn') {
            orb.classList.add('bn');
            document.querySelectorAll('[data-en]').forEach(el => el.style.display = 'none');
            document.querySelectorAll('[data-bn]').forEach(el => {
                const tag = el.tagName.toLowerCase();
                el.style.display = (tag === 'span' || tag === 'a') ? 'inline-block' : 'block';
            });
        } else {
            orb.classList.remove('bn');
            document.querySelectorAll('[data-bn]').forEach(el => el.style.display = 'none');
            document.querySelectorAll('[data-en]').forEach(el => {
                const tag = el.tagName.toLowerCase();
                el.style.display = (tag === 'span' || tag === 'a') ? 'inline-block' : 'block';
            });
        }
    }

    // CURSOR SCALE ON INPUTS
    document.querySelectorAll('.form-input, .form-select, .form-textarea').forEach(el => {
        el.addEventListener('focus', () => { cursor.style.width='16px'; cursor.style.height='16px'; });
        el.addEventListener('blur',  () => { cursor.style.width='8px';  cursor.style.height='8px';  });
    });
</script>
</body>
</html>
