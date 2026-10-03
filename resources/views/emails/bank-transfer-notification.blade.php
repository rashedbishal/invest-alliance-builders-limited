<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Bank Transfer Enquiry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }
            .footer {
                width: 100% !important;
            }
            .wrapper-padding {
                padding: 20px !important;
            }
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }
    </style>
</head>

<body
    style="background: linear-gradient(0deg, #0B1A2A 0%, #102B42 20%, #0F172A 50%, #000000 100%);
    background-attachment: fixed;
    margin: 0; padding: 0; width: 100%;
    font-family: 'ProductSans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    color: #f1f1f1; line-height: 1.4;">

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center" class="wrapper-padding" style="padding: 40px;">

            <!-- Logo -->
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                   style="margin:20px auto; text-align:center;">
                <tr>
                    <td>
                        <img src="{{ asset('images/jana-back.png') }}" alt="Hotel Jana"
                             style="max-width:100%; height:75px; display:block; margin:0 auto;">
                    </td>
                </tr>
            </table>

            <!-- Email Body -->
            <table class="inner-body" width="570" cellpadding="0" cellspacing="0" role="presentation"
                   style="background-color:#1d1d2c; border-radius:8px; box-shadow:0 4px 20px rgba(0,0,0,0.4); margin:0 auto;">
                <tr>
                    <td class="content-cell" style="padding:32px; font-size:16px; color:#f1f1f1;">
                        <h1 style="margin-top:0; font-size:22px; font-weight:bold; color:#ffffff;">
                            Bank Transfer Enquiry — Dutch-Bangla Bank Limited
                        </h1>
                        <p style="margin:16px 0;">
                            Hello,
                        </p>
                        <p style="margin:16px 0;">
                            A customer has chosen to pay by Dutch-Bangla Bank transfer for the order below.
                            No online payment has been taken and no invoice has been generated — please follow up
                            and issue a money receipt once the customer calls in to confirm the transfer.
                        </p>

                        <!-- CUSTOMER DETAILS TABLE -->
                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                               style="margin-top:20px; background:#141421; border-radius:6px; padding:20px;">
                            <tr>
                                <td style="color:#d1d1d1; font-size:14px; padding:10px;">
                                    <strong style="color:#ffffff;">Customer Details:</strong><br><br>
                                    <strong>Name:</strong> {{ $name }}<br>
                                    <strong>Contact number:</strong> {{ $phone }}<br>
                                    <strong>Email:</strong> {{ $email }}<br>
                                    <strong>Address line 1:</strong> {{ $addressLine1 }}<br>
                                    @if ($addressLine2)
                                        <strong>Address line 2:</strong> {{ $addressLine2 }}<br>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <!-- ORDER DETAILS TABLE -->
                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                               style="margin-top:20px; background:#141421; border-radius:6px; padding:20px;">
                            <tr>
                                <td style="color:#d1d1d1; font-size:14px; padding:10px;">
                                    <strong style="color:#ffffff;">Order Details:</strong><br><br>
                                    @foreach ($lines as $line)
                                        {{ $line['hotel_name'] }} — {{ $line['quantity'] }} share{{ $line['quantity'] > 1 ? 's' : '' }}
                                        × BDT {{ number_format($line['unit_price']) }} = BDT {{ number_format($line['subtotal']) }}<br>
                                    @endforeach
                                    <br>
                                    <strong>Total:</strong> BDT {{ number_format($total) }}
                                </td>
                            </tr>
                        </table>

                        <p style="margin:24px 0 0 0; color:#888;">
                            This is an automated notification from the booking system.
                        </p>
                    </td>
                </tr>
            </table>

            <!-- Footer -->
            <table class="footer" width="570" cellpadding="0" cellspacing="0" role="presentation"
                   style="margin:20px auto; text-align:center;">
                <tr>
                    <td class="content-cell" align="center"
                        style="padding:32px; font-size:12px; color:#b0adc5;">
                        © {{ now()->year }} Hotel Jana. All rights reserved.
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>
