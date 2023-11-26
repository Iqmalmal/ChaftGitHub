<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Order;
use App\Models\PendingOrder;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToyyibPayController extends Controller
{
    public function createBill(Request $request){
        $cart = ShoppingCart::where('user_id', auth()->user()->id)->get();

        $group_id = uniqid();
        foreach ($cart as $cartItem) {
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
        $productNames = PendingOrder::where('group_id', $group_id)->pluck('product_name')->toArray();
        $productNamesString = implode(', ', $productNames); 
        $groupIds = $cart->pluck('group_id')->toArray();

        $some_data = array(
            'userSecretKey'=> config('toyyibpay.key'),
            'categoryCode'=> config('toyyibpay.category'),
            'billName'=>'Chaft E-Commerce',
            'billDescription'=>'Payment for ' . $productNamesString ,
            'billPriceSetting'=> 1,
            'billPayorInfo'=> 1,
            'billAmount'=> $request->input('totalPrice') * 100,
            'billReturnUrl'=> route('toyyibpay-status', ['group_id=' . $group_id]),
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

        return redirect('https://dev.toyyibpay.com/' . $billCode );
    }

    public function paymentStatus(Request $request){
        $group_id = $request->query('group_id');
        $response = $request->all(['status_id', 'billcode', 'order_id']);
        
        if($group_id) {
        if($response['status_id'] == 1) {

            //Move order from pending order to order table
            $pendingOrders = PendingOrder::where('group_id', $group_id)->get();

            foreach ($pendingOrders as $pendingOrder) {
                $orderItem = ([
                'user_id' => $pendingOrder->user_id,
                'product_id' => $pendingOrder->product_id,
                'group_id' => $pendingOrder->group_id,
                'recipient' => $pendingOrder->recipient,
                'product_name' => $pendingOrder->product_name,
                'price' => $pendingOrder->price,
                'quantity' => $pendingOrder->quantity,
                'variant' => $pendingOrder->variant,
                'images' => $pendingOrder->images,
                'totalPrice' => $pendingOrder->totalPrice,
                'status' => ' Paid '
                ]);
                
                Order::create($orderItem);
                
            }
            //Remove order from pending order table
            PendingOrder::where('group_id', $group_id)->delete();
    
            return redirect('/')->with('message', 'Payment successful!');
        } elseif($response['status_id'] == 2) {
            
            PendingOrder::where('group_id', $group_id)->update(['status' => 'Pending']);
    
            return redirect('/')->with('message', 'Payment unsuccessful!');
        }
    } else {
        return redirect('/')->with('message', 'Group ID not found.');
    }
    }

    public function callback(){
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        return redirect('/')->with('message', 'Payment successful!');
    }
}
