<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\PendingOrder;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToyyibPayController extends Controller
{
    public function createBill(Request $request){
        $cart = ShoppingCart::where('user_id', auth()->user()->id)->get();

        foreach ($cart as $cartItem) {
            $group_id = uniqid();
            PendingOrder::create([
                'user_id' => auth()->user()->id,
                'product_id' => $cartItem->product_id,
                'group_id' => $group_id,
                'recipient' => auth()->user()->name,
                'product_name' => $cartItem->product_name,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'variant' => $cartItem->variant,
                'images' => $cartItem->images,
                'totalPrice' => $request->input('totalPrice'),
                'status' => 'Unpaid'
            ]);
        }

        // Delete data in shopping_cart table
        ShoppingCart::where('user_id', auth()->user()->id)->delete();

        // Reset totalPrice in users table to 0
        User::where('id', auth()->user()->id)->update(['totalPrice' => 0]);

        // Retrieve the product details from the pending orders
        $user_id = auth()->id();

        // Retrieve the product names
        $productNames = PendingOrder::where('user_id', $user_id)->pluck('product_name')->toArray();
        $productNamesString = implode(', ', $productNames); 
        $groupIds = $cart->pluck('group_id')->toArray();
        $uniqueGroupIds = array_unique($groupIds);

        $produtPrice = PendingOrder::where('user_id', $user_id)->value('totalPrice') * 100;

        /* $produtPrice = PendingOrder::where('user_id', $user_id)->whereIn('group_id', $uniqueGroupIds)->value('totalPrice') * 100; */

        $some_data = array(
            'userSecretKey'=> config('toyyibpay.key'),
            'categoryCode'=> config('toyyibpay.category'),
            'billName'=>'Chaft E-Commerce',
            'billDescription'=>'Payment for ' . $productNamesString ,
            'billPriceSetting'=> 1,
            'billPayorInfo'=> 1,
            'billAmount'=> $produtPrice,
            'billReturnUrl'=> route('toyyibpay-status', ),
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
        dd(request()->all(['status_id', 'billcode', 'order_id']));

        /* if($response['status_id'] == 1) {

            $pendingOrder->update([
                'status' => 'Paid'
            ]);

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
        } */
    }

    public function callback(){
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        return redirect('/')->with('message', 'Payment successful!');
    }
}
