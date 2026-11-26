<?php

namespace App\Http\Controllers;

use App\Helpers\QRProcessor;
use App\Helpers\TransactionIdHelper;
use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\TransactionShare;
use App\Services\Booking\ShareCatalog;
use App\Services\Payment\MoneyReceiptGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request, ShareCatalog $catalog)
    {
        $invoice = null;
        $order = null;
        $order_number = null;
        $payment_amount = null;
        // Here you have to receive all the order data to initate the payment.
        // Lets your oder trnsaction informations are saving in a table called "orders"
        // In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $cartData = json_decode($request->cart_json) ?? null;

        // The customer must agree to the Terms, Privacy and Refund policies before paying.
        if (($cartData->terms_accepted ?? false) !== true) {
            return response()->json(['status' => 'FAILED', 'message' => 'Please read and agree to the Terms & Conditions, Privacy Policy and Return & Refund Policy.'], 422);
        }

        // The amount is priced here from the selected hotel shares. Any price or
        // total sent by the browser is ignored.
        try {
            $quote = $catalog->quote((array) ($cartData->cus_shares ?? []));
        } catch (InvalidArgumentException $e) {
            return response()->json(['status' => 'FAILED', 'message' => $e->getMessage()], 422);
        }

        if ($quote['total'] >= (float) config('shares.sslcommerz_limit')) {
            return response()->json(['status' => 'FAILED', 'message' => 'This amount is too high for SSLCommerz. Please pay with PayPal.'], 422);
        }

        $post_data = [];
        $post_data['total_amount'] = $quote['total']; // You cant not pay less than 10
        // $post_data['total_amount'] = '10';
        $post_data['currency'] = 'BDT';
        $post_data['tran_id'] = TransactionIdHelper::generate(); // tran_id must be unique

        // CUSTOMER INFORMATION
        $post_data['cus_name'] = $cartData->cus_name;
        $post_data['cus_email'] = $cartData->cus_email ?? null;
        $post_data['cus_add1'] = $cartData->cus_addr1;
        $post_data['cus_add2'] = '';
        $post_data['cus_city'] = '';
        $post_data['cus_state'] = '';
        $post_data['cus_postcode'] = '';
        $post_data['cus_country'] = '';
        $post_data['cus_phone'] = $cartData->cus_phone;
        $post_data['cus_fax'] = '';

        // SHIPMENT INFORMATION
        //        $post_data['ship_name'] = 'testosl2ebt';
        //        $post_data['ship_add1'] = "Dhaka";
        //        $post_data['ship_add2'] = "Dhaka";
        //        $post_data['ship_city'] = "Dhaka";
        //        $post_data['ship_state'] = "Dhaka";
        //        $post_data['ship_postcode'] = "1000";
        //        $post_data['ship_phone'] = "";
        //        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = 'NO';
        $post_data['product_name'] = 'Service';
        $post_data['product_category'] = 'Virtual';
        $post_data['product_profile'] = 'Service';

        // OPTIONAL PARAMETERS
        $post_data['value_a'] = round($quote['total'] / $quote['units'], 2); // average unit price
        $post_data['value_b'] = (string) $quote['units']; // total share count
        $post_data['value_c'] = '';
        $post_data['value_d'] = 'ref004';

        // Before  going to initiate the payment order status need to update as Pending.
        $update_product = Transaction::where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'] ?? null,
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                // 'amount' => '10',
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'invoice_number' => null,
                'currency' => $post_data['currency'],
            ]);

        foreach ($quote['lines'] as $line) {
            TransactionShare::create(['transaction_id' => $post_data['tran_id']] + $line);
        }

        $sslc = new SslCommerzNotification;
        // initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (! is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }

    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = Transaction::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'cn_identifier')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = Transaction::where('transaction_id', $tran_id)->first();
                $update_product->update([
                    'status' => 'Processing',
                    'val_id' => $request->input('val_id'),
                    'card_type' => $request->input('card_type'),
                    'store_amount' => $request->input('store_amount'),
                    'card_no' => $request->input('card_no'),
                    'bank_tran_id' => $request->input('bank_tran_id'),
                    'tran_date' => $request->input('tran_date'),
                    'error' => $request->input('error'),
                    'currency' => $request->input('currency'),
                    'card_issuer' => $request->input('card_issuer'),
                    'card_brand' => $request->input('card_brand'),
                    'card_sub_brand' => $request->input('card_sub_brand'),
                    'card_issuer_country' => $request->input('card_issuer_country'),
                    'card_issuer_country_code' => $request->input('card_issuer_country_code'),
                    'store_id' => $request->input('store_id'),
                    'verify_sign' => $request->input('verify_sign'),
                    'verify_sign_sha2' => $request->input('verify_sign_sha2'),
                    'currency_type' => $request->input('currency_type'),
                    'currency_amount' => $request->input('currency_amount'),
                    'currency_rate' => $request->input('currency_rate'),
                    'base_fair' => $request->input('base_fair'),
                    'subscription_id' => $request->input('subscription_id'),
                    'risk_level' => $request->input('risk_level'),
                    'risk_title' => $request->input('risk_title'),
                    'cn_identifier' => 2,
                ]);

                $data = [
                    'invoice_date' => now()->format('Y-m-d'),
                    'payment_amount' => $request->input('amount'),
                    'invoice_status' => 'Processing',
                    'remarks' => 'Online Payment',
                    'public_token' => bin2hex(random_bytes(32)),
                    'public_token_expires_at' => null,
                    'public_token_revoked_at' => null,
                ];

                $invoice = Invoice::create($data);
                $update_product->update([
                    'invoice_number' => $invoice->invoice_number,
                ]);

                $data = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email') ?? null,
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'unit_price' => $request->input('value_a'),
                    'unit' => $request->input('value_b'),
                    'total_price' => $request->input('amount'),
                    'invoice_number' => $invoice->invoice_number,
                ];

                $submission = Submission::create($data);

                $update_transaction = Transaction::where('transaction_id', $tran_id)->first();

                $invoice = Invoice::where('invoice_number', $update_transaction->invoice_number)->first();

                $invoice->update([
                    'payment_date' => $update_transaction->updated_at->format('Y-m-d'),
                    'invoice_status' => $update_transaction->status,
                    'money_receipt_number' => MoneyReceiptGenerator::generate(),
                ]);

                $downloadUrl = route('invoice-access', [
                    'token' => $invoice->public_token,
                ]);

                $qrDataUri = QRProcessor::generate($downloadUrl);

                $pdf = PDF::loadView('content.invoice', ['invoice' => $invoice, 'concern' => $update_transaction->cn_identifier, 'qrDataUri' => $qrDataUri, 'transaction' => $update_transaction, 'unitprice'=> $request->input('value_a'), 'unit'=> $request->input('value_b')])->output();

                if($request->input('email'))
                {
                    Mail::to($update_transaction->email)
                        ->queue(new PaymentConfirmationMail(base64_encode($pdf), $update_transaction->invoice_number, $update_transaction->cn_identifier, $invoice->money_receipt_number));
                }

                Mail::to(config('portal.email_address.managing_director'))
                    ->cc(config('portal.email_address.accounts'))
                    ->bcc(config('portal.email_address.osl'))
                    ->queue(new PaymentReceiveConfirmationMail(base64_encode($pdf), $update_transaction->invoice_number, $update_transaction->cn_identifier, $invoice->money_receipt_number, $update_transaction->name, $amount, $update_transaction->tran_date, 'Online Payment'));


                return redirect()->route('home')->with('info', 'Transaction Successful with NON IPN');
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            Cache::forget('jana-monthly-payment-count');
            Cache::forget('daily-jana-payment'); 
            Cache::forget('weekly-jana-payment'); 
            Cache::forget('monthly-jana-payment'); 
            Cache::forget('monthly-total-payment'); 
            return redirect()->route('home')->with('success', 'Transaction is successful');
//            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return redirect()->route('home')->with('cancel', 'Transaction is cancelled');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('transactions')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            return redirect()->route('home')->with('fail', 'Transaction is failed');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            return redirect()->route('home')->with('info', 'Transaction is already successful');
        } else {
            return redirect()->route('home')->with('error', 'Transaction is invalid');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('transactions')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Cancelled']);

            return redirect()->route('home')->with('cancel', 'Transaction is cancelled');

        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

            return redirect()->route('home')->with('info', 'Transaction is already successful');

        } else {

            return redirect()->route('home')->with('error', 'Transaction is invalid');
        }


    }

    public function ipn(Request $request)
    {
        $amount = $request->input('amount');
        // Received all the payement information from the gateway
        if ($request->input('tran_id')) { // Check transation id is posted or not.
            $tran_id = $request->input('tran_id');

            // Check order status in order tabel against the transaction id or order id.
            $order_details = Transaction::where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification;
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == true) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = Transaction::where('transaction_id', $tran_id)->firstOrFail();
                    $update_product->update(['status' => 'Processing',
                        'val_id' => $request->input('val_id'),
                        'card_type' => $request->input('card_type'),
                        'store_amount' => $request->input('store_amount'),
                        'card_no' => $request->input('card_no'),
                        'bank_tran_id' => $request->input('bank_tran_id'),
                        'tran_date' => $request->input('tran_date'),
                        'error' => $request->input('error'),
                        'currency' => $request->input('currency'),
                        'card_issuer' => $request->input('card_issuer'),
                        'card_brand' => $request->input('card_brand'),
                        'card_sub_brand' => $request->input('card_sub_brand'),
                        'card_issuer_country' => $request->input('card_issuer_country'),
                        'card_issuer_country_code' => $request->input('card_issuer_country_code'),
                        'store_id' => $request->input('store_id'),
                        'verify_sign' => $request->input('verify_sign'),
                        'verify_sign_sha2' => $request->input('verify_sign_sha2'),
                        'currency_type' => $request->input('currency_type'),
                        'currency_amount' => $request->input('currency_amount'),
                        'currency_rate' => $request->input('currency_rate'),
                        'base_fair' => $request->input('base_fair'),
                        'subscription_id' => $request->input('subscription_id'),
                        'risk_level' => $request->input('risk_level'),
                        'risk_title' => $request->input('risk_title'),
                        'cn_identifier' => 2
                    ]);

                    $data = [
                        'invoice_date' => now()->format('Y-m-d'),
                        'payment_amount' => $request->input('amount'),
                        'invoice_status' => 'Processing',
                        'remarks' => 'Online Payment',
                        'public_token' => bin2hex(random_bytes(32)),
                        'public_token_expires_at' => null,
                        'public_token_revoked_at' => null,
                    ];

                    $invoice = Invoice::create($data);
                    $update_product->update([
                        'invoice_number' => $invoice->invoice_number,
                    ]);

                    $data = [
                        'name' => $request->input('name'),
                        'email' => $request->input('email') ?? null,
                        'phone' => $request->input('phone'),
                        'address' => $request->input('address'),
                        'unit_price' => $request->input('value_a'),
                        'unit' => $request->input('value_b'),
                        'total_price' => $request->input('amount'),
                        'invoice_number' => $invoice->invoice_number,
                    ];

                    $submission = Submission::create($data);

                    $update_transaction = Transaction::where('transaction_id', $tran_id)->first();

                    $invoice = Invoice::where('invoice_number', $update_transaction->invoice_number)->first();

                    $invoice->update([
                        'payment_date' => $update_transaction->updated_at->format('Y-m-d'),
                        'invoice_status' => $update_transaction->status,
                        'money_receipt_number' => MoneyReceiptGenerator::generate(),
                    ]);


                    $downloadUrl = route('invoice-access', [
                        'token' => $invoice->public_token,
                    ]);

                    $downloadUrl = route('invoice-access', [
                        'token' => $invoice->public_token,
                    ]);

                    $qrDataUri = QRProcessor::generate($downloadUrl);

                    $pdf = PDF::loadView('content.invoice', ['invoice' => $invoice, 'concern' => $update_transaction->cn_identifier, 'qrDataUri' => $qrDataUri, 'transaction' => $update_transaction, 'unitprice'=> $request->input('value_a'), 'unit'=> $request->input('value_b')])->output();

                    if($request->input('email'))
                    {
                        Mail::to($update_transaction->email)
                            ->queue(new PaymentConfirmationMail(base64_encode($pdf), $update_transaction->invoice_number, $update_transaction->cn_identifier, $invoice->money_receipt_number));
                    }

                    Mail::to(config('portal.email_address.managing_director'))
                        ->cc(config('portal.email_address.accounts'))
                        ->bcc(config('portal.email_address.osl'))
                        ->queue(new PaymentReceiveConfirmationMail(base64_encode($pdf), $update_transaction->invoice_number, $update_transaction->cn_identifier, $invoice->money_receipt_number, $update_transaction->name, $amount, $update_transaction->tran_date, 'Online Payment'));


                    return response('IPN OK', 200);
                }

                return response('SIGNATURE MISMATCH', 400);
            } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                // That means Order status already updated. No need to udate database.

                return response('ALREADY PROCESSED', 200);
            } else {
                // That means something wrong happened. You can redirect customer to your product page.

                return response('INVALID TRANSACTION', 400);
            }
        } else {
            return response('INVALID DATA', 400);
        }
    }

}
