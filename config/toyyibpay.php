<?php

return [

  'client_secret' => env('TOYYIBPAY_USER_SECRET_KEY', ''),
  'redirect_uri' => env('TOYYIBPAY_REDIRECT_URI', ''),
  'sandbox' => env('TOYYIBPAY_SANDBOX', true),

  'key' => env('TOYYIBPAY_KEY'),
  'category' => env('CATEGORY_KEY'),

];



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