<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\CustomEmailRule;
use Illuminate\Validation\Rule;

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

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
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

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Store price in DB
    public function storePrice(Request $request, User $user) {
        // Check if the user is authenticated
        if (auth()->check()) {
            $formFields = $request->validate([
                'totalPrice' => 'required'
            ]);

            $user->update($formFields);
            return redirect('/checkout')->with('message', 'Price updated successfully!');
        } else {
            // Handle the case when the user is not authenticated
            return redirect('users.register');
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





    
    //Show My Purchase Section
    public function showMyPurchase(User $user) {
        return view('users.mypurchase.toPay', ['user' => $user]);
    }

    //Show To Pay Section
    public function showToPay(User $user) {
        return view('users.mypurchase.toPay', ['user' => $user]);
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

}
