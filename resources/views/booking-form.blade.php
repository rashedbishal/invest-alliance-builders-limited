<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Reserve Your Share — Hotel Jana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@300;400;500;600&family=Cinzel:wght@400;500;600;700&family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">

    <style>
        :root { --gold: #1E5A8C; }
        body {
            font-family: 'Cormorant Garamond', serif;
            background: #0A1428;
            color: #F7F1E8;
            cursor: none;
            overflow-x: hidden;
            width: 100%;
        }
        /* Mobile-first responsive container - fixed overflow issues */
        .tail-container {
            background: linear-gradient(135deg, rgba(10,20,45,0.25), rgba(15,30,65,0.01)),
            url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&q=70') center/cover;
            background-blend-mode: multiply;
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            display: flex;
            align-items: center;
        }
        .custom-cursor {
            position: fixed; width: 8px; height: 8px; background: var(--gold);
            border-radius: 50%; pointer-events: none; z-index: 99999;
            transform: translate(-50%, -50%);
        }
        .cursor-ring {
            position: fixed; width: 36px; height: 36px;
            border: 1px solid rgba(40,172,226,0.65); border-radius: 50%;
            pointer-events: none; z-index: 99998; transform: translate(-50%, -50%);
        }
        .form-input {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(40,172,226,0.6);
            color: #F7F1E8;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
        }
        .form-input:focus {
            border-color: #28ace2;
            background: rgba(255,255,255,0.22);
            box-shadow: 0 0 0 4px rgba(40,172,226,0.2);
            outline: none;
        }
        .form-input.error-field {
            border-color: #ef4444;
            background: rgba(239,68,68,0.15);
        }
        .error-tooltip {
            position: absolute;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            bottom: -28px;
            left: 12px;
            white-space: nowrap;
            z-index: 20;
            font-weight: 500;
            letter-spacing: 0.3px;
            pointer-events: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            font-family: system-ui, sans-serif;
        }
        /* mobile adjustment for tooltip */
        @media (max-width: 480px) {
            .error-tooltip {
                white-space: normal;
                font-size: 0.65rem;
                max-width: 90%;
                bottom: -32px;
                left: 8px;
                right: 8px;
                width: auto;
            }
        }
        .error-tooltip::before {
            content: '';
            position: absolute;
            top: -5px;
            left: 16px;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #ef4444;
        }
        .success-icon {
            animation: successPop 0.6s cubic-bezier(0.68,-0.55,0.27,1.55) forwards;
        }
        @keyframes successPop {
            from { transform:scale(0); opacity:0; }
            to { transform:scale(1); opacity:1; }
        }
        .lang-orb.bn .lang-ball { left: calc(100% - 31px) !important; }
        .field-group {
            position: relative;
            width: 100%;
        }
        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        /* Responsive grid and text fixes */
        @media (max-width: 768px) {
            .tail-container {
                padding: 1rem 0;
            }
            h1 {
                font-size: 2rem !important;
                line-height: 1.3 !important;
            }
            .text-xl {
                font-size: 1.1rem !important;
            }
            .rounded-3xl {
                border-radius: 1.5rem !important;
            }
            .p-9, .md\\:p-11 {
                padding: 1.5rem !important;
            }
        }
        @media (max-width: 480px) {
            .tail-container {
                padding: 0.5rem 0;
            }
            h1 {
                font-size: 1.75rem !important;
            }
            .px-6 {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            .gap-10 {
                gap: 1.5rem !important;
            }
            .offer-box {
                padding: 1rem !important;
            }
            .form-input {
                padding: 0.5rem 1rem !important;
                font-size: 0.95rem !important;
            }
            .py-6 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .text-2xl {
                font-size: 1.3rem !important;
            }
        }
        /* Fix for very small devices 320px */
        @media (max-width: 360px) {
            .grid {
                gap: 1.25rem !important;
            }
            h1 {
                font-size: 1.5rem !important;
            }
            .p-9 {
                padding: 1.2rem !important;
            }
            .text-xs {
                font-size: 0.65rem !important;
            }
            .lang-orb {
                width: 3.5rem !important;
                height: 1.75rem !important;
            }
        }
        /* Prevent horizontal scroll */
        body, html {
            overflow-x: hidden;
            max-width: 100%;
        }
        * {
            max-width: 100%;
            box-sizing: border-box;
        }
        input, button {
            font-size: 16px !important; /* Prevents zoom on mobile */
        }
        .offer-box > div {
            word-break: break-word;
        }
    </style>
</head>
<body class="min-h-screen">

<div class="custom-cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- Language Switch - responsive positioning -->
<div class="fixed top-4 right-4 z-50 md:top-6 md:right-6">
    <div class="lang-orb flex items-center justify-between w-16 h-8 bg-[#0A1428]/90 border border-[#28ace2]/60 hover:border-[#28ace2] rounded-full px-1 backdrop-blur-md cursor-pointer" id="langToggle" onclick="toggleLang()">
        <span class="text-[10px] font-semibold  text-[#28ace2]">EN</span>
        <div class="fixed left-1 lang-ball w-7 h-6 bg-gradient-to-r from-[#0773bb] to-[#28ace2] rounded-full shadow-lg"></div>
        <span class="text-[10px] font-semibold  text-[#28ace2]">বাং</span>
    </div>
</div>

<div class="tail-container min-h-screen flex items-center py-6 md:py-8">
    <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-6 md:gap-10 px-4 sm:px-6 md:px-12 w-full">

        <!-- LEFT PANEL - fully responsive -->
        <div class="flex flex-col justify-center py-4 md:py-6">
            <div class="mb-4 md:mb-6">
                <a href="/" class="inline-flex items-center gap-2 text-[#28ace2]/80 hover:text-[#28ace2] text-xs  bg-[#0A1428]/90 p-2 rounded-xl" data-en>← Back to Hotel Jana</a>
                <a href="/" class="inline-flex items-center gap-2 text-[#28ace2]/80 hover:text-[#28ace2] text-xs  bg-[#0A1428]/90 p-2 rounded-xl hidden" data-bn>← হোটেল জানায় ফিরুন</a>
            </div>

            <div class="uppercase text-[#0A2F5E] text-[11px] md:text-xs tracking-[0.25em]" data-en>Ownership Reservation</div>
            <div class="uppercase text-[#0A2F5E] text-[11px] md:text-xs tracking-[0.25em] hidden" data-bn>মালিকানা সংরক্ষণ</div>

            <h1 class="text-2xl sm:text-3xl md:text-4xl leading-tight font-light mt-3" data-en>
                <span class="text-black">Let your leisure unfold by the seaside...</span> <span class="text-[#0A2F5E] italic">in your own hotel, with nature...</span>
            </h1>
            <h1 class="text-2xl sm:text-3xl md:text-4xl leading-tight font-light mt-3 hidden" data-bn>
                <span class="text-black">অবসর কাটুক সমুদ্রের পাড়ে...</span><span class="text-[#0A2F5E] italic">নিজ হোটেলে, প্রকৃতির সাথে..</span>
            </h1>

            <p class="mt-5 text-base sm:text-xl text-black/90 max-w-md" data-en>
                Complete the form below to reserve your share. Our team will contact you shortly.
            </p>
            <p class="mt-5 text-base sm:text-lg text-black/90 max-w-md hidden" style="font-family:'Tiro Bangla',serif;" data-bn>
                নিচের ফর্মটি পূরণ করে আপনার শেয়ার সংরক্ষণ করুন। আমাদের টিম শীঘ্রই যোগাযোগ করবে।
            </p>

            <!-- Offer Box - responsive -->
            <div class="mt-8 md:mt-10 bg-white/10 border border-[#0A2F5E]/30 rounded-2xl p-5 sm:p-7 text-base backdrop-blur-xl">
                <div class="uppercase text-[#0A2F5E] text-xs  mb-4 md:mb-5" data-en>Current Offer</div>
                <div class="uppercase text-[#0A2F5E] text-xs  mb-4 md:mb-5 hidden" data-bn>বর্তমান অফার</div>

                <div class="space-y-3 sm:space-y-4">
                    <div class="flex justify-between flex-wrap gap-2">
                        <span class="text-black/85" data-en>Price per Share</span>
                        <span class="text-black/85 hidden" data-bn>প্রতি শেয়ারের মূল্য</span>
                        <span class="text-[#0A2F5E] font-semibold">৳ 3,00,000</span>
                    </div>
                    <div class="flex justify-between flex-wrap gap-2">
                        <span class="text-black/85" data-en>Annual Dividend</span>
                        <span class="text-black/85 hidden" data-bn>বার্ষিক আয়</span>
                        <span class="text-[#0A2F5E]">~ ৳ 60,000</span>
                    </div>
                    <div class="flex justify-between flex-wrap gap-2">
                        <span class="text-black/85" data-en>Complimentary Stay</span>
                        <span class="text-black/85 hidden" data-bn>বিনামূল্যে থাকা</span>
                        <span class="text-[#0A2F5E]">3 Days / Year</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL - fully responsive, form adjustments -->
        <div class="flex flex-col justify-center bg-[#0A1428]/95 backdrop-blur-xl rounded-2xl md:rounded-3xl p-5 sm:p-7 md:p-9 lg:p-11">
            <h2 class="text-[#28ace2] uppercase  text-xs sm:text-sm mb-6 md:mb-8" data-en>✦ Share Booking Form ✦</h2>
            <h2 class="text-[#28ace2] uppercase  text-xs sm:text-sm mb-6 md:mb-8 hidden" data-bn>✦ শেয়ার বুকিং ফর্ম ✦</h2>

            <div id="formWrap">
                <form id="bookingForm" class="space-y-2" novalidate>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full">
                        <div class="flex-1 field-group" id="nameGroup">
                            <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5" data-en>FULL NAME *</label>
                            <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5 hidden" data-bn>পূর্ণ নাম *</label>
                            <input type="text" id="name" required class="form-input w-full px-4 sm:px-6 py-2.5 rounded-xl sm:rounded-2xl text-base" autocomplete="name">
                        </div>

                        <div class="flex-1 field-group" id="phoneGroup">
                            <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5" data-en>PHONE NUMBER *</label>
                            <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5 hidden" data-bn>ফোন নম্বর *</label>
                            <input type="tel" id="phone" required class="form-input w-full px-4 sm:px-6 py-2.5 rounded-xl sm:rounded-2xl text-base" autocomplete="tel">
                        </div>
                    </div>

                    <div class="field-group" id="addressGroup">
                        <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5" data-en>ADDRESS *</label>
                        <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5 hidden" data-bn>ঠিকানা *</label>
                        <input type="text" id="address" required class="form-input w-full px-4 sm:px-6 py-2.5 rounded-xl sm:rounded-2xl text-base" autocomplete="address-line1">
                    </div>

                    <div class="field-group" id="emailGroup">
                        <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5" data-en>EMAIL ID (Optional)</label>
                        <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5 hidden" data-bn>ইমেইল আইডি (ঐচ্ছিক)</label>
                        <input type="email" id="email" class="form-input w-full px-4 sm:px-6 py-2.5 rounded-xl sm:rounded-2xl text-base" autocomplete="email">
                    </div>

                    <!-- Fixed Total -->
                    <div class="mt-2">
                        <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5" data-en>TOTAL INVESTMENT</label>
                        <label class="block text-[#28ace2] text-[10px] sm:text-xs  mb-1.5 hidden" data-bn>মোট বিনিয়োগ</label>
                        <div class="bg-white/10 border border-[#28ace2]/40 px-4 sm:px-6 py-2 rounded-xl sm:rounded-2xl text-xl sm:text-2xl text-[#28ace2] font-light">
                            ৳ 3,00,000
                        </div>
                    </div>

                    <!-- Your visible styled button -->
                    <button type="button" onclick="document.getElementById('sslczPayBtn').click()"
                            class="w-full bg-gradient-to-r from-[#0773bb] via-[#28ace2] to-[#4fc3f0] py-2 rounded-xl sm:rounded-2xl text-[#0A1428] font-semibold  text-base sm:text-lg uppercase hover:brightness-110 transition-all mt-2"
                    >
                        <span data-en>✦ &nbsp; Pay Now &nbsp; ✦</span>
                        <span data-bn style="display:none">✦ &nbsp; পে করুন &nbsp; ✦</span>
                    </button>

                    <p class="text-center text-white/75 text-xs sm:text-sm uppercase" data-en>Or</p>
                    <p class="text-center text-white/75 text-xs sm:text-sm hidden" style="font-family:'Tiro Bangla',serif;" data-bn>অথবা</p>

                    <!-- Pay with PayPal -->
                    <button type="button" id="paypalPayBtn"
                            class="w-full bg-[#FFC439] py-2 rounded-xl sm:rounded-2xl text-[#003087] font-semibold text-base sm:text-lg hover:brightness-95 transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        <span data-en>Pay with <span class="font-bold italic">Pay</span><span class="font-bold italic text-[#009cde]">Pal</span></span>
                        <span data-bn style="display:none">পেপাল দিয়ে পে করুন</span>
                    </button>
                    <p id="paypalError" class="text-center text-red-400 text-xs sm:text-sm hidden"></p>

                    <!-- Hidden SSLCommerz trigger — SSL hijacks this, not your button -->
                    <button id="sslczPayBtn"
                            type="button"
                            token=""
                            postdata=""
                            order=" "
                            endpoint="{{ url('/pay-via-ajax') }}"
                            style="display:none">
                    </button>

                    <p class="text-center text-white/75 text-xs sm:text-sm mt-3" data-en>
                        Your information is completely secure. We will contact you within 24 hours.
                    </p>
                    <p class="text-center text-white/75 text-xs sm:text-sm hidden" style="font-family:'Tiro Bangla',serif;" data-bn>
                        আপনার তথ্য সম্পূর্ণ নিরাপদ। আমরা ২৪ ঘণ্টার মধ্যে যোগাযোগ করব।
                    </p>
                </form>
            </div>

            <!-- Success Screen -->
            <div id="successScreen" class="hidden text-center py-8 sm:py-10">
                <div class="success-icon mx-auto w-16 h-16 sm:w-20 sm:h-20 border-2 border-[#28ace2] rounded-full flex items-center justify-center text-3xl sm:text-4xl mb-5 sm:mb-6">✦</div>
                <h2 class="text-2xl sm:text-3xl text-[#28ace2]" data-en>Booking Received</h2>
                <h2 class="text-2xl sm:text-3xl text-[#28ace2] hidden" data-bn>বুকিং পাওয়া গেছে</h2>
                <p class="mt-4 sm:mt-5 text-white/80 leading-relaxed text-sm sm:text-base" data-en>
                    Thank you. A Hotel Jana ownership consultant will reach you shortly.
                </p>
                <p class="mt-4 sm:mt-5 text-white/80 leading-relaxed text-sm sm:text-base hidden" style="font-family:'Tiro Bangla',serif;" data-bn>
                    ধন্যবাদ। একজন হোটেল জানা পরামর্শদাতা শীঘ্রই যোগাযোগ করবেন।
                </p>
                <a href="/" class="mt-8 sm:mt-10 inline-block text-[#28ace2] text-xs sm:text-sm  hover:text-white" data-en>← Return to Hotel Jana</a>
                <a href="/" class="mt-8 sm:mt-10 inline-block text-[#28ace2] text-xs sm:text-sm  hover:text-white hidden" data-bn>← হোটেল জানায় ফিরুন</a>
            </div>
        </div>
    </div>
</div>

<!-- SSLCommerz Scripts - untouched logic -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    (function(window, document) {
        var loader = function() {
            var script = document.createElement("script"),
                tag = document.getElementsByTagName("script")[0];
            script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };
        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

<script>
    // CURSOR - fully preserved
    const cursor = document.getElementById('cursor');
    const cursorRing = document.getElementById('cursorRing');
    let mouseX=0, mouseY=0, ringX=0, ringY=0;
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

    // DOM Elements
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone');
    const addressInput = document.getElementById('address');
    const emailInput = document.getElementById('email');
    const payButton = document.getElementById('sslczPayBtn');
    const bookingForm = document.getElementById('bookingForm');
    const formWrap = document.getElementById('formWrap');
    const successScreen = document.getElementById('successScreen');

    let currentLang = 'en';

    // Tooltip functions - preserved
    function removeTooltip(groupId) {
        const group = document.getElementById(groupId);
        if(!group) return;
        const existingTooltip = group.querySelector('.error-tooltip');
        if(existingTooltip) existingTooltip.remove();
        const inputEl = group.querySelector('input');
        if(inputEl) inputEl.classList.remove('error-field');
    }

    function showTooltip(groupId, message) {
        const group = document.getElementById(groupId);
        if(!group) return;
        removeTooltip(groupId);
        const inputField = group.querySelector('input');
        if(inputField) inputField.classList.add('error-field');

        const tooltip = document.createElement('div');
        tooltip.className = 'error-tooltip';
        if (typeof message === 'object') {
            tooltip.textContent = currentLang === 'bn' ? (message.bn || message.en) : (message.en || message);
        } else {
            tooltip.textContent = message;
        }
        group.style.position = 'relative';
        group.appendChild(tooltip);

        setTimeout(() => {
            if(tooltip && tooltip.parentNode) tooltip.remove();
            if(inputField) inputField.classList.remove('error-field');
        }, 4000);
    }

    // Validators
    function validateName() {
        const val = nameInput.value.trim();
        if(val === '') {
            showTooltip('nameGroup', { en: 'Full name is required', bn: 'পূর্ণ নাম আবশ্যক' });
            return false;
        }
        if(val.length < 2) {
            showTooltip('nameGroup', { en: 'Name must be at least 2 characters', bn: 'নাম কমপক্ষে ২ অক্ষর হতে হবে' });
            return false;
        }
        removeTooltip('nameGroup');
        return true;
    }

    function validatePhone() {
        let val = phoneInput.value.trim();
        if(val === '') {
            showTooltip('phoneGroup', { en: 'Phone number is required', bn: 'ফোন নম্বর আবশ্যক' });
            return false;
        }
        const cleaned = val.replace(/[^\d+]/g, '');
        if(cleaned.length < 8 || cleaned.length > 15) {
            showTooltip('phoneGroup', { en: 'Enter a valid phone number (8-15 digits)', bn: 'বৈধ ফোন নম্বর দিন (৮-১৫ ডিজিট)' });
            return false;
        }
        removeTooltip('phoneGroup');
        return true;
    }

    function validateAddress() {
        const val = addressInput.value.trim();
        if(val === '') {
            showTooltip('addressGroup', { en: 'Address is required', bn: 'ঠিকানা আবশ্যক' });
            return false;
        }
        if(val.length < 3) {
            showTooltip('addressGroup', { en: 'Please enter a complete address', bn: 'দয়া করে সম্পূর্ণ ঠিকানা দিন' });
            return false;
        }
        removeTooltip('addressGroup');
        return true;
    }

    function validateEmail() {
        const val = emailInput.value.trim();
        if(val === '') return true;
        const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
        if(!emailRegex.test(val)) {
            showTooltip('emailGroup', { en: 'Enter a valid email address', bn: 'বৈধ ইমেইল ঠিকানা দিন' });
            return false;
        }
        removeTooltip('emailGroup');
        return true;
    }

    function isFormValid() {
        return validateName() && validatePhone() && validateAddress() && validateEmail();
    }

    function updatePayButtonState() {
        if(isFormValid()) {
            payButton.disabled = false;
        } else {
            payButton.disabled = true;
        }
    }

    // Real-time validation
    nameInput.addEventListener('input', updatePayButtonState);
    phoneInput.addEventListener('input', updatePayButtonState);
    addressInput.addEventListener('input', updatePayButtonState);
    emailInput.addEventListener('input', updatePayButtonState);
    nameInput.addEventListener('blur', () => { validateName(); updatePayButtonState(); });
    phoneInput.addEventListener('blur', () => { validatePhone(); updatePayButtonState(); });
    addressInput.addEventListener('blur', () => { validateAddress(); updatePayButtonState(); });
    emailInput.addEventListener('blur', () => { validateEmail(); updatePayButtonState(); });

    // ORIGINAL SSLCommerz Logic - COMPLETELY UNTOUCHED
    const UNIT_PRICE = 300000;

    const sslBtn = document.getElementById('sslczPayBtn');

    sslBtn.addEventListener('click', function() {
        var obj = {
            cus_name: document.getElementById('name').value,
            cus_phone: document.getElementById('phone').value,
            cus_email: document.getElementById('email').value,
            cus_addr1: document.getElementById('address').value,
            cus_unit: "1",
            cus_unitprice: UNIT_PRICE,
            cus_amount: UNIT_PRICE
        };
        $('#sslczPayBtn').prop('postdata', obj);
    });

    // PayPal: create the order on the server, then send the customer to PayPal to approve it
    const paypalBtn = document.getElementById('paypalPayBtn');
    const paypalError = document.getElementById('paypalError');

    function showPaypalError(en, bn) {
        paypalError.textContent = currentLang === 'bn' ? bn : en;
        paypalError.classList.remove('hidden');
    }

    paypalBtn.addEventListener('click', async function() {
        paypalError.classList.add('hidden');
        if(!isFormValid()) return;

        paypalBtn.disabled = true;
        try {
            const res = await fetch("{{ route('paypal.create') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    name: nameInput.value.trim(),
                    phone: phoneInput.value.trim(),
                    address: addressInput.value.trim(),
                    email: emailInput.value.trim()
                })
            });
            const data = await res.json();
            if(res.ok && data.approve_url) {
                window.location.href = data.approve_url;
                return;
            }
            showPaypalError(data.message || 'Could not start the PayPal payment. Please try again.',
                            'পেপাল পেমেন্ট শুরু করা যায়নি। আবার চেষ্টা করুন।');
        } catch(err) {
            showPaypalError('Could not reach the server. Please try again.', 'সার্ভারের সাথে সংযোগ করা যায়নি। আবার চেষ্টা করুন।');
        }
        paypalBtn.disabled = false;
    });

    function handleSubmit(e) {
        if(!isFormValid()) {
            e.preventDefault();
            updatePayButtonState();
            return false;
        }
        setTimeout(() => {
            const wrap = document.getElementById('formWrap');
            const success = document.getElementById('successScreen');
            if(wrap && success && wrap.style.display !== 'none') {
                wrap.style.opacity = '0';
                setTimeout(() => {
                    wrap.style.display = 'none';
                    success.classList.remove('hidden');
                }, 400);
            }
        }, 200);
        return true;
    }

    bookingForm.addEventListener('submit', handleSubmit);

    // Language Toggle
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
        if(nameInput.classList.contains('error-field')) validateName();
        if(phoneInput.classList.contains('error-field')) validatePhone();
        if(addressInput.classList.contains('error-field')) validateAddress();
        if(emailInput.classList.contains('error-field')) validateEmail();
        updatePayButtonState();
    }

    updatePayButtonState();

    document.querySelectorAll('input').forEach(el => {
        el.addEventListener('focus', () => { cursor.style.width='16px'; cursor.style.height='16px'; });
        el.addEventListener('blur', () => { cursor.style.width='8px'; cursor.style.height='8px'; });
    });

    window.toggleLang = toggleLang;
</script>
</body>
</html>
