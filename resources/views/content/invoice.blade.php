<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        @if(in_array($invoice->invoice_status, ['Processing', 'COMPLETE', 'VALID']))
            MONEY RECEIPT {{$invoice->money_receipt_number}}
        @else
            INVOICE {{$invoice->invoice_number}}
        @endif
    </title>
    <style>
        /* DOMPdf compatible styles */
        @page {
            size: A4;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'ProductSans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #374151;
            background: white;
        }

        .page {
            width: 210mm;
            margin: 0 auto;
            position: relative;
            background: white;
            padding-bottom: 35mm;
        }

        /* Layout utilities */
        .table {
            display: table;
            width: 100%;
        }

        .table-cell {
            display: table-cell;
            vertical-align: top;
        }

        .w-full {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* Spacing */
        .p-5 {
            padding: 20px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 15px;
        }

        .mr-4 {
            margin-right: 15px;
        }

        .relative {
            position: relative;
        }

        .z-20 {
            z-index: 20;
        }

        /* Sizing */
        .w-18 {
            width: 72px;
        }

        .h-16 {
            height: 64px;
        }

        .float-left {
            float: left;
        }

        /* Typography & color */
        .text-xl {
            font-size: 20px;
        }

        .text-2xl {
            font-size: 24px;
        }

        .text-3xl {
            font-size: 32px;
        }

        .text-sm {
            font-size: 12px;
        }

        .text-xs {
            font-size: 9px;
        }

        .text-gray-800 {
            color: #1F2937;
        }

        .text-gray-600 {
            color: #4B5563;
        }

        .text-gray-500 {
            color: #6B7280;
        }

        .font-bold {
            font-weight: bold;
        }

        .italic {
            font-style: italic;
        }

        .leading-6 {
            line-height: 1.6;
        }

        .leading-7 {
            line-height: 1.8;
        }

        /* Gradient */
        .bg-gradient-to-b {
            background: linear-gradient(to bottom, #93C5FD, #FFFFFF);
        }

        .header-section {
            background: linear-gradient(to bottom, #93C5FD, #FFFFFF);
            padding: 20px 5px; /* no horizontal padding */
            border-bottom: 2px solid #93C5FD;
        }

        .header-container {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        /* Shared column behavior */
        .header-col {
            display: table-cell;
            vertical-align: middle;
        }

        /* Column widths = 100% total */
        .logo-col {
            width: 15%;
            padding-left: 12px;
            padding-right: 12px;
        }

        .company-col {
            width: 25%;
            padding: 0 12px;
        }

        .address-col {
            width: 40%;
            padding: 0 12px;
            vertical-align: top;
        }

        /* Last column touches right edge */
        .last-col {
            width: 30%;
            padding-right: 0;
        }

        /* Logo */
        .logo-col img {
            @if($concern == 1)
                 width: 80px;
            height: 71px;
            @else
                 width: 100px;
            height: 100px;
            @endif
             display: block;
        }

        /* Company text */
        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #1F2937;
            margin-bottom: 4px;
        }

        .company-tagline {
            font-size: 10px;
            color: #4B5563;
            font-style: italic;
        }

        /* Address blocks */
        .address-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 6px;
            color: #1F2937;
            text-decoration: underline;
        }

        .address-text {
            font-size: 11px;
            line-height: 1.7;
            color: #4B5563;
        }


        /* Invoice Title Section */
        .invoice-title-section {
            text-align: center;
            padding: 20px 20px 15px;
            position: relative;
            z-index: 15;
        }

        .invoice-title-section h1 {
            font-size: 36px;
            font-weight: bold;
            color: #1F2937;
            letter-spacing: 2px;
            border-bottom: 2px solid #374151;
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Invoice Info Section */
        .invoice-info-section {
            display: table;
            width: 100%;
            padding: 20px;
            border-bottom: 1px solid #E5E7EB;
            position: relative;
            z-index: 15;
        }

        .info-col {
            display: table-cell;
            vertical-align: top;
            width: 33.33%;
            padding: 0 10px;
        }

        .info-title {
            font-weight: bold;
            color: #374151;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .info-text {
            font-size: 11px;
            color: #4B5563;
            line-height: 1.6;
        }

        .info-meta {
            font-size: 11px;
            color: #4B5563;
            line-height: 1.8;
        }

        /* Table utilities */
        .table-section {
            padding: 20px;
            position: relative;
            z-index: 15;
        }

        .table-border {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #D1D5DB;
        }

        .thead-bg {
            background-color: #F3F4F6;
        }

        .th {
            text-align: left;
            padding: 12px;
            font-size: 11px;
            font-weight: bold;
            color: #374151;
            border: 1px solid #D1D5DB;
        }

        .td {
            padding: 12px;
            font-size: 11px;
            color: #4B5563;
            border: 1px solid #D1D5DB;
        }

        .font-medium {
            color: #374151;
            font-weight: 600;
        }

        .subtotal-row {
            background-color: #F9FAFB;
        }

        /* UPDATED - Total row padding to match other rows */
        .total-row {
            background-color: #EFF6FF;
            font-weight: bold;
            font-size: 14px;
            border-top: 2px solid #9CA3AF;
        }

        .total-row td {
            color: #1F2937;
            padding: 8px;
        }

        .total-amount {
            color: #2563EB;
            font-size: 16px;
        }

        /* Watermark Container */
        .watermark-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            pointer-events: none;
            width: 100%;
            height: auto;
            text-align: center;
        }

        .watermark-container img {
            width: 140mm;
            max-width: 80%;
            height: auto;
            opacity: 0.08;
            display: block;
            margin: 0 auto;
        }

        /* Footer */
        .page-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px 20px;
            text-align: center;
            font-size: 9px;
            color: #4B5563;
            background: linear-gradient(to bottom, #FFFFFF, #93C5FD);
            height: 30mm;
            z-index: 20;
        }

        .footer-content-wrapper {
            position: relative;
        }

        .footer-qr {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 120px;
            height: 120px;
        }

        .footer-qr img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .footer-logos {
            text-align: center;
            margin-bottom: 10px;
        }

        .footer-logo {
            height: 40px;
            margin: 0 15px;
            opacity: 0.75;
            vertical-align: middle;
        }

        .footer-text {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .footer-thank-you {
            margin-top: 12px;
            font-weight: bold;
            color: #1F2937;
            font-size: 10px;
        }

        /* Signature section - UPDATED */
        .signature-section {
            display: table;
            width: 100%;
            padding: 18px 20px;
            position: relative;
            z-index: 15;
        }

        .signature-column {
            display: table-cell;
            vertical-align: bottom;
            width: 50%;
            padding: 0 10px;
        }

        .sig-block {
            width: 90%;
            margin-top: 16mm;
        }

        .sig-block-right {
            width: 80%;
            margin-top: 16mm;
            margin-left: auto;
            text-align: right;
        }

        .sig-block-right .sig-line {
            margin-left: auto;
        }

        .sig-line {
            border-top: 1px solid #9CA3AF;
            width: 70%;
            height: 1px;
            margin-bottom: 6px;
        }

        .sig-name {
            font-size: 12px;
            color: #1F2937;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .sig-label {
            font-size: 11px;
            color: #6B7280;
            margin-bottom: 3px;
            /* UPDATED - Fixed height to ensure alignment */
            height: 16px;
            line-height: 16px;
        }

        .sig-date {
            margin-top: 8px;
            font-size: 11px;
            color: #6B7280;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<!-- Watermark Pattern -->
<div class="watermark-container">
    @if($concern == 1)
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/opticore.png'))) }}"
             alt="Watermark">
    @else
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/hotel-jana.png'))) }}"
             alt="Watermark">
    @endif
</div>

<!-- Footer with QR Code -->
<div class="page-footer">
    <div class="footer-content-wrapper">
        <div class="footer-qr">
            <img src="{{ $qrDataUri }}" alt="QR Code">
            <h4>Scan to verify</h4>
        </div>

        <div class="footer-logos">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/alliance.webp'))) }}"
                 alt="Partner Logo 1" class="footer-logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/opticore.png'))) }}"
                 alt="Certification Logo 2" class="footer-logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/jana.png'))) }}"
                 alt="Payment Logo 3" class="footer-logo">
        </div>
        <div class="footer-text">
            This @if(in_array($invoice->invoice_status, ['Processing', 'COMPLETE', 'VALID']))
                receipt
            @else
                invoice
            @endif is system generated and may be valid without a signature or seal.
        </div>
        <div class="footer-thank-you">
            Thank you for your business!
        </div>
    </div>
</div>

<div class="page">

    <!-- Header with Company Info and Two Addresses -->
    <div class="header-section">
        <div class="header-container">

            <!-- Logo -->
            <div class="header-col logo-col">
                @if($concern == 1)
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/osl-half.png'))) }}"
                         alt="Logo">
                @else
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('resources/images/logo/hotel-jana.png'))) }}"
                         alt="Logo">
                @endif
            </div>

            <!-- Company Text -->
            <div class="header-col company-col">
                @if($concern == 1)
                    <div class="company-name">Opticore Solutions Limited</div>
                    <div class="company-tagline">Affordable Services For All</div>
                @else
                    <div class="company-name">Hotel Jana</div>
                    <div class="company-tagline">One step closer to paradise</div>
                @endif
            </div>

            <!-- Head Office -->
            <div class="header-col address-col">
                <div class="address-title">Head Office</div>
                <div class="address-text">
                    House# 640 (1st Floor), West Kazipara, Mirpur<br>
                    Dhaka-1216, Bangladesh<br>
                    Phone: +880-1928568853<br>
                    Email: asad@alliancebuildersltd.org
                </div>
            </div>

            <!-- Corporate Office -->
            <div class="header-col address-col last-col">
                <div class="address-title">Corporate Office</div>
                <div class="address-text">
                    1178, East Monipur, Mirpur<br>
                    Dhaka-1216, Bangladesh<br>
                    Phone: +880-1896-204400<br>
                    Email: osl@opticoresolutionsltd.com
                </div>
            </div>

        </div>
    </div>

    <!-- Invoice Title -->
    <div class="invoice-title-section">
        <h1>
            @if($invoice->invoice_status == 'Pending')
                INVOICE
            @elseif(in_array($invoice->invoice_status, ['Processing', 'COMPLETE', 'VALID']))
                MONEY RECEIPT
            @endif
        </h1>
    </div>

    <!-- Bill To / Ship To / Invoice Info -->
    <div class="invoice-info-section">
        <div class="info-col">
            <div class="info-title">Bill To:</div>
            <div class="info-text">
                {{$transaction?->name ?? ''}}<br>
                {{$transaction?->address ?? ''}}<br>
                Phone: {{$transaction?->phone ?? ''}}<br>
            </div>
        </div>
        <div class="info-col">
            <div class="info-title">Ship To:</div>
            <div class="info-text">
                {{$transaction?->name ?? ''}}<br>
                {{$transaction?->address ?? ''}}<br>
                Phone: {{$transaction?->phone ?? ''}}<br>
            </div>
        </div>
        <div class="info-col">
            <div class="info-meta">
                @if(in_array($invoice->invoice_status, ['Processing', 'COMPLETE', 'VALID']))
                    <strong>Receipt No #: {{$invoice->money_receipt_number}}</strong><br>
                    <strong>Invoice No #:</strong> {{$invoice->invoice_number}}<br>
                @else
                    <strong>Invoice No #: {{$invoice->invoice_number}}</strong><br>
{{--                    <strong>Order No #:</strong> {{$invoice->order_number}}<br>--}}
                @endif
                @if($concern == 2)
{{--                    <strong>Share Id #:</strong> {{$invoice->order?->shareform->share_number}}<br>--}}
                @endif
                <strong>Date:</strong> {{$invoice->invoice_date}}
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-section">
        <table class="table-border">
            <thead class="thead-bg">
            <tr>
                <th class="th" style="width: 10%;">SL. No</th>
                <th class="th" style="width: 50%;">Description</th>
                <th class="th text-right" style="width: 15%;">Unit Price</th>
                <th class="th" style="width: 10%;">Quantity</th>
                <th class="th text-right" style="width: 15%;">Paid Amount</th>
                <th class="th text-center" style="width: 15%;">Remarks</th>
            </tr>
            </thead>
            <tbody>

                <tr>
                    <td class="td">1.</td>
                    <td class="td font-medium">Hotel Jana Kuakata - Share</td>
                    <td class="td text-right">{{number_format($unitprice)}}</td>
                    <td class="td text-right">{{$unit}}</td>
                    <td class="td text-right">{{number_format($invoice->payment_amount)}}</td>
                    <td class="td">{{$invoice->remarks}}</td>
                </tr>

            <tr class="subtotal-row">
                <td colspan="5" class="td text-right">Subtotal</td>
                <td class="td text-right">{{number_format($invoice->payment_amount)}}</td>
            </tr>
            <tr class="total-row">
                <td colspan="5" class="td text-right">
                    @if($invoice->invoice_status == 'Pending')
                        Total Payable Amount
                    @elseif(in_array($invoice->invoice_status, ['Processing', 'COMPLETE', 'VALID']))
                        Total Paid Amount
                    @endif
                </td>
                <td class="td text-right total-amount">{{number_format($invoice->payment_amount)}}</td>
                <td class="td"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
