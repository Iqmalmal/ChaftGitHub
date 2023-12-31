<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Seller;
use App\Models\Listing;
use App\Models\Order;
use App\Models\PendingOrder;
use App\Models\studentEmail;
use Illuminate\Http\Request;
use App\Rules\CustomEmailRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required','email',Rule::unique('users', 'email'), new CustomEmailRule()],
            'password' => 'required|confirmed|min:6',
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);


        //check if email exist in db
        if(studentEmail::where('email', $formFields['email'])->doesntExist()) {
            return back()->withErrors(['email' => 'Email is not registered within Chaft, Please uses valid student email'])->onlyInput('email');
        } else {
            // Create User
            $user = User::create($formFields);

            // Login
            auth()->login($user);

            return redirect('/')->with('message', 'User created and logged in');
        }
    }

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }


    //Show Admin Dashboard
    public function showAdmin() {
        $seller = Seller::all();
        $user = User::all();


        return view('userAdmin.dashboard', [
            'user' => $user,
            'seller' => $seller,

        ]);
    }


    

    // Authenticate User
    public function authenticate(Request $request, User $user, studentEmail $email) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if( auth()->attempt($formFields) && $email->where('email', $formFields['email'])->value('email') == 'admin@student.gmi.edu.my') {
            $request->session()->regenerate();

            return redirect('/admin')->with('message', 'You are now logged in as Admin!');
        } else {
            if(auth()->attempt($formFields)) {
                $request->session()->regenerate();
    
                return redirect('/')->with('message', 'You are now logged in!');
            } elseif ($user->where('email', $formFields['email'])->doesntExist()) {
                return back()->withErrors(['email' => 'Account is not registered'])->onlyInput('email');
            } else {
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
            }
        }
    }

    

    // Show User Profile
    public function profile(User $user) {
        $user = auth()->user();
        return view('users.profile', ['user' => $user]);
    }


    // Update Profile
    public function updateProfile( Request $request) {
        $formFields = $request->validate([
            'name' => ['min:3'],
            'course' => ['min:3'],
            'semester' => ['min:1'],
            'block' => ['min:1' , 'max:2', 'regex:/^A[1-7]$/'],
            'unit' => ['min:1', 'max:3','regex:/^\d+-\d+$/'],
        ], [
            'unit.regex' => 'The unit field must be in the format of number-number. Example: 1-2, 1-3, 1-4',
        ]);

        // Add Image to Table
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('images', 'public');
            $formFields['profile_image'] = $imagePath;
        }

        // Update User
        User::where('id', auth()->user()->id)->update($formFields);

        return redirect('/profile')->with('message', 'Profile updated!');
    }



    //Show User Address
    public function showAddress(User $user) {
        $user = auth()->user();
        return view('users.address', ['user' => $user]);
    }
    
    // Show My Purchase Section
    public function showMyPurchase(User $user, PendingOrder $pendingOrder) {
        $orders = auth()->user()->pendingOrder; // Retrieve the pending orders for the authenticated user

        $totalPrice = $orders->sum(function ($order) {
            return $order->price * $order->quantity;
        });

        return view('users.mypurchase.toReceive', compact('orders', 'totalPrice'));
    }

    //Show To Pay Section
    public function showToPay(User $user, PendingOrder $pendingOrder) {
        $orders = auth()->user()->pendingOrder; // Retrieve the pending orders for the authenticated user

        $totalPrice = $orders->sum(function ($order) {
            return $order->price * $order->quantity;
        });
        return view('users.mypurchase.toPay', compact('orders', 'totalPrice'));
    }

    //Show To Receive Section
    public function showToReceive(User $user, PendingOrder $pendingOrder, Order $orderItem) {
        $orders = auth()->user()->pendingOrder; // Retrieve the pending orders for the authenticated user
        $id = auth()->id();

        $orderItem = Order::where('user_id', $id)->where('status', 'Shipped')->orWhere('status', 'Paid')->get();


        
        //get listing for email
        $email = Listing::all()->first();
        return view('users.mypurchase.toReceive', compact('orders', 'orderItem', 'email'));
    }

    //Show To Ship Section
    public function showToShip(User $user, Order $order) {
        $orders = auth()->user()->order; // Retrieve the pending orders for the authenticated user
        return view('users.mypurchase.toShip', compact('orders'));
    }

    //Show Completed Section
    public function showCompleted(User $user, Request $request) {
        $orders = auth()->user()->pendingOrder;
        
        $id = auth()->id();
        $orderItem = Order::where('user_id', $id)->where('status', 'Received')->get();
        $email = Listing::all()->first();
        return view('users.mypurchase.completed', compact('orders', 'orderItem', 'email'));
    }

    //Show Cancelled Section
    public function showCancelled(User $user) {
        $orders = auth()->user()->pendingOrder;
        $id = auth()->id();
        $orderItem = Order::where('user_id', $id)->whereIn('status', ['Cancelled'])->get();

        $email = Listing::all()->first();
        return view('users.mypurchase.cancelled', compact('orders', 'orderItem', 'email'));
    }


    //updateOrderStatus

    public function receiveOrder(Request $request) {
        if($request->has('order-receive')){
            $group_id = $request->input('order-receive');
            Order::where('group_id', $group_id)->update(['status' => 'Received']);
            return back()->with('message', 'Item has been Received!');
        }
    }

    public function cancelOrder(Request $request) {
        if($request->has('order-cancel')){
            $id = $request->input('order-cancel');
            Order::where('id', $id)->update(['status' => 'Cancelled']);
            return back()->with('message', 'Item has been Cancelled!');
        }
    }


    
    //Seller



    //Show Seller Page
    public function sellerPage($id) {
        $sellerListing = Seller::find($id);
    
        if ($sellerListing) {
            $listings = Listing::where('seller_id', $id);
    
            // Get the search query from the request
            $searchQuery = request('search');
    
            // Apply the search filter if a query is present
            if ($searchQuery) {
                $listings = $listings->where('product_name', 'like', '%' . $searchQuery . '%');
            }
    
            $listings = $listings->get();
    
            return view('seller.seller-page', [
                'sellerListing' => $sellerListing,
                'listings' => $listings,
                'search' => Listing::latest()->filter(request(['tag', 'search']))->paginate(25),
            ]);
        } else {
            // Handle the case when the seller does not exist
            return back()->with(['message' => 'Seller not found']);
        }
    }


    //Show Seller Register Page
    public function showSellerRegister() {
        $user_id = auth()->id();
        if(Seller::where('user_id', $user_id)->exists()) {
            return redirect('/listings/create')->with(['message', 'You are already registered as a seller!']);
        } else {
        return view('seller.register-seller');
        }
    }

    //Store Seller Data
    public function storeSeller(Request $request) {
        $formFields = $request->validate([
            'SellerName' => 'required',
            'BankName' => 'required',
            'BankAccountNumber' => 'required',
            'PhoneNumber' => 'required'
            ]);

        $formFields['user_id'] = auth()->id();

        if(Seller::where('user_id', $formFields['user_id'])->exists()) {
            return redirect('/')->with(['message', 'You are already registered as a seller!']);

        } else {
            Seller::create($formFields);
            return redirect('/')->with('message', 'Seller successfully registered!');
        }
    }


    //Show Seller Product Dashboard
    public function showSellerProductDashboard($sellerId) {
        $sellerId = auth()->user()->seller->id;
        $seller = Seller::find($sellerId);
        $listings = Listing::where('seller_id', $sellerId);

        if (!$seller) {
            // Handle the case when the seller is not found
            return back()->with(['message' => 'Seller not found']);
        }

        $listings = $listings->get();

        //Search filter (too hard to make it work right now)
        $searchQuery = request('search');
    
            // Apply the search filter if a query is present
            if ($searchQuery) {
                $listings = $listings->where('product_name', 'like', '%' . $searchQuery . '%');
            }

        return view('seller.seller-product-dashboard', [
            'seller' => $seller,
            'listings' => $listings,
        ]);
    }

    //Show Seller Finance Dashboard
    public function showSellerFinanceDashboard($sellerId) {
        $sellerId = auth()->user()->seller->id;
        $seller = Seller::find($sellerId);
        $listings = Listing::where('seller_id', $sellerId)->get();
        

        if (!$seller) {
            // Handle the case when the seller is not found
            return back()->with(['message' => 'Seller not found']);
        }

        return view('seller.seller-finance-dashboard', [
            'seller' => $seller,
            'listings' => $listings,
        ]);
    }

    //Show Seller Shipment Dashboard
    public function showSellerShipmentDashboard($sellerId, Request $request) {
        $sellerId = auth()->user()->seller->id;

        $seller = Seller::find($sellerId);
        

        if (!$seller) {
            // Handle the case when the seller is not found
            return back()->with(['message' => 'Seller not found']);
        }

        

        $orders = Order::whereHas('listing', function ($query) use ($sellerId){
            $query->where('seller_id', $sellerId);
        })->with('user')->get();

        $orderItem = $orders->first();


        //update status
        if($request->has('group_id')){
            $group_id = $request->input('group_id');
            Order::where('group_id', $group_id)->update(['status' => 'Shipped']);
            return redirect('/sellers/dashboard/{seller}/shipment')->with('message', 'Item has been shipped!');
        }

        return view('seller.seller-shipment-dashboard', [
            'seller' => $seller,
            'orders' => $orders,
            'orderItem' => $orderItem,
        ]);
    }
}

