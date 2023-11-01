<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use App\Models\Listing;
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
        return view('users.profile', ['user' => $user]);
    }

    //Show User Address
    public function showAddress(User $user) {
        return view('users.address', ['user' => $user]);
    }
    
    // Show My Purchase Section
    public function showMyPurchase(User $user, PendingOrder $pendingOrder) {
        $orders = auth()->user()->pendingOrder; // Retrieve the pending orders for the authenticated user

        $totalPrice = $orders->sum(function ($order) {
            return $order->price * $order->quantity;
        });

        return view('users.mypurchase.toPay', compact('orders', 'totalPrice'));
    }

    //Show To Pay Section
    public function showToPay(User $user, PendingOrder $pendingOrder) {
        $orders = auth()->user()->pendingOrder; // Retrieve the pending orders for the authenticated user
        return view('users.mypurchase.toPay', compact('orders'));
    }

    //Show To Receive Section
    public function showToReceive(User $user) {
        return view('users.mypurchase.toReceive', ['user' => $user]);
    }

    //Show To Ship Section
    public function showToShip(User $user) {
        return view('users.mypurchase.toShip', ['user' => $user]);
    }

    //Show Completed Section
    public function showCompleted(User $user) {
        return view('users.mypurchase.completed', ['user' => $user]);
    }

    //Show Cancelled Section
    public function showCancelled(User $user) {
        return view('users.mypurchase.cancelled', ['user' => $user]);
    }


    
    //Seller

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
}

