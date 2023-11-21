<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\PendingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToyyibPayController extends Controller
{
    public function createBill($data){
        $some_data = array(
            'userSecretKey'=> config('toyyibpay.key'),
            'categoryCode'=> config('toyyibpay.category'),
            'billName'=>'Chaft E-Commerce',
            'billDescription'=>$data['product_name'],
            'billPriceSetting'=> 10,
            'billPayorInfo'=> 1,
            'billAmount'=> $data['price'],
            'billReturnUrl'=> route('toyyibpay-status'),
            'billCallbackUrl'=> route('toyyibpay-callback'),
            'billExternalReferenceNo' => 'Bill-' . uniqid(),
            'billTo'=> 'Chaft',
            'billEmail'=> 'chaft@chaft.online',
            'billPhone'=> '01136870176',
            'billSplitPayment'=> 0,
            'billSplitPaymentArgs'=> '',
            'billPaymentChannel'=> '0',
            'billContentEmail'=> 'Thank you for purchasing our product!',
            'billChargeToCustomer'=> 2,
            'billExpiryDate'=> date('d-m-Y H:i:s', strtotime('+3 days')),
        );

        $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
        $response = Http::asForm()->post($url, $some_data);
        $billCode = $response[0]['BillCode'];

        return redirect('https://dev.toyyibpay.com/' . $billCode);
    }

    public function paymentStatus(PendingOrder $pendingOrder){
        $response = request()->all(['status_id', 'billcode', 'order_id']);

        if($response['status_id'] == 1) {

            $pendingOrder->update([
                'status' => 'Paid'
            ]);

            /* $listing = Listing::find($pendingOrder->listing_id);
            $listing->update([
                'quantity' => $listing->quantity - $pendingOrder->quantity,
            ]); */

            return redirect('/')->with('message', 'Payment successful!');
        } elseif($response['status_id'] == 2) {

            $pendingOrder->update([
                'status' => 'Pending'
            ]);

            return redirect('/')->with('message', 'Payment Pending!');
        
        } elseif($response['status_id'] == 3) {
                
            $pendingOrder->update([
                'status' => 'Failed'
            ]);

            return redirect('/')->with('message', 'Payment failed!');
        } else {
            return redirect('/')->with('message', 'Product Pending for Payment!');
        }
    }

    public function callback(){
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        return redirect('/')->with('message', 'Payment successful!');
    }
}
