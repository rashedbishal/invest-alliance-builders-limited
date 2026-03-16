<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Payment Confirmation</title>
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

        .button {
            background-color: #0EA5E9;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            padding: 8px 18px;
            display: inline-block;
            border-top: 8px solid #0EA5E9;
            border-bottom: 8px solid #0EA5E9;
            border-left: 18px solid #0EA5E9;
            border-right: 18px solid #0EA5E9;
            font-weight: bold;
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
                        <a href="http://localhost">
                            @if($concern == "Hotel Jana")
                                <img src="{{asset('jana-back.png')}}" alt="Logo"
                                     style="max-width:100%; height:75px; display:block; margin:0 auto;">
                            @else
                                <img src="{{asset('opticore.png')}}" alt="Logo"
                                     style="max-width:100%; height:75px; display:block; margin:0 auto;">
                            @endif
                        </a>
                    </td>
                </tr>
            </table>

            <!-- Email Body -->
            <table class="inner-body" width="570" cellpadding="0" cellspacing="0" role="presentation"
                   style="background-color:#1d1d2c; border-radius:8px; box-shadow:0 4px 20px rgba(0,0,0,0.4); margin:0 auto;">
                <tr>
                    <td class="content-cell" style="padding:32px; font-size:16px; color:#f1f1f1;">
                        <h1 style="margin-top:0; font-size:22px; font-weight:bold; color:#ffffff;">
                            Payment Received Notification
                        </h1>
                        <p style="margin:16px 0;">
                            Hello Team,
                        </p>
                        <p style="margin:16px 0;">
                            A payment has been successfully received and processed for invoice
                            <strong>#{{ $transaction_id }}</strong>.
                        </p>

                        <!-- PAYMENT DETAILS TABLE -->
                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                               style="margin-top:20px; background:#141421; border-radius:6px; padding:20px;">
                            <tr>
                                <td style="color:#d1d1d1; font-size:14px; padding:10px;">
                                    <strong style="color:#ffffff;">Payment Details:</strong><br><br>
                                    <strong>Transaction Id:</strong> #{{ $transaction_id }}<br>
                                    <strong>Customer:</strong> {{ $name }}<br>
                                    <strong>Amount Received:</strong> BDT. {{ number_format($amount) }}<br>
                                    <strong>Payment Date:</strong> {{ $date }}<br>
                                    <strong>Payment Method:</strong> {{ $method }}
                                </td>
                            </tr>
                        </table>

                        <p style="margin:16px 0;">
                            The customer will be notified via email and their services will continue without interruption.
                        </p>

                        <!-- ATTACHMENT SECTION -->
                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                               style="margin-top:30px; background:#141421; border-radius:6px; padding:20px;">
                            <tr>
                                <td style="color:#d1d1d1; font-size:10px; padding:10px;">
                                    <strong>Invoice Attachment</strong><br>
                                    A copy of the invoice has been attached to this email for your records.
                                </td>
                            </tr>
                        </table>

                        <p style="margin:24px 0 0 0; color:#888;">
                            This is an automated notification from the payment processing system.
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
                        © {{now()->year}} {{$concern}}. All rights reserved.
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>
