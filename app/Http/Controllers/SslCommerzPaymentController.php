<?php

namespace App\Http\Controllers;

use App\Helpers\TransactionIdHelper;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Services\Payment\MoneyReceiptGenerator;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Log;

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

    public function payViaAjax(Request $request)
    {
        $invoice = null;
        $order = null;
        $order_number = null;
        $payment_amount = null;
        // Here you have to receive all the order data to initate the payment.
        // Lets your oder trnsaction informations are saving in a table called "orders"
        // In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $cartData = json_decode($request->cart_json) ?? null;




        $post_data = [];
        $post_data['total_amount'] = $cartData->cus_amount; // You cant not pay less than 10
        $post_data['currency'] = 'BDT';
        $post_data['tran_id'] = TransactionIdHelper::generate(); // tran_id must be unique

        // CUSTOMER INFORMATION
        $post_data['cus_name'] = $cartData->cus_name;
        $post_data['cus_email'] = $cartData->cus_email;
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
        $post_data['value_a'] = '';
        $post_data['value_b'] = '';
        $post_data['value_c'] = '';
        $post_data['value_d'] = 'ref004';

        // Before  going to initiate the payment order status need to update as Pending.
        $update_product = Transaction::where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'invoice_number' => null,
                'currency' => $post_data['currency'],
            ]);

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
                    'cl_identifier' => $request->input('value_a'),
                    'cn_identifier' => $request->input('value_b'),
                ]);

                $data = [
                    'invoice_date' => now()->format('Y-m-d'),
                    'payment_amount' => $request->input('amount'),
                    'invoice_status' => 'Processing',
                    'remarks' => 'Online Payment',
                    'public_token' => bin2hex(random_bytes(32)),
                    'public_token_expires_at' => now()->addYears(1),
                    'public_token_revoked_at' => null,
                ];

                $invoice = Invoice::create($data);
                $update_product->update([
                    'invoice_number' => $invoice->invoice_number,
                ]);

                $update_transaction = Transaction::where('transaction_id', $tran_id)->first();

                $invoice = Invoice::where('invoice_number', $update_transaction->invoice_number)->first();

                $invoice->update([
                    'payment_date' => $update_transaction->updated_at->format('Y-m-d'),
                    'invoice_status' => $update_transaction->status,
                    'money_receipt_number' => MoneyReceiptGenerator::generate(),
                ]);
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
