<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use App\Models\Listing;
use App\Models\PendingOrder;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(25)
        ]);
    }

    //show listing
    public function show($id) {
        // Retrieve the listing data
        $listing = Listing::find($id);
        $sellerListings = Seller::find($listing->seller_id);
    
        // Retrieve associated product variant data
        $productVariantData = $listing->productVariants; // Assuming you have defined the relationship
    
        return view('listings.show', [
            'listing' => $listing,
            'productVariantData' => $productVariantData,
            'sellerListings' => $sellerListings,
        ]);
    }
    

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {

        $formFields = $request->validate([
            'product_name' => 'required',
            'location' => 'required',
            'price' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('images')) {
            $imagePaths = [];
    
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $imagePaths[] = $imagePath;
            }
    
            $formFields['images'] = json_encode($imagePaths);
        }
        
        $formFields['seller_id'] = auth()->user()->seller->id;
        $formFields['sellerName'] = auth()->user()->seller->sellerName;
        $formFields['email'] = auth()->user()->email;


        $listing = Listing::create($formFields);


        $listingId = $listing->id;

        $productVariantData = $request->validate([
            'colour_1' => 'nullable',
            'colour_2' => 'nullable',
            'colour_3' => 'nullable',
            'size_1' => 'nullable',
            'size_2' => 'nullable',
            'size_3' => 'nullable',
            'capacity_1' => 'nullable',
            'capacity_2' => 'nullable',
            'capacity_3' => 'nullable',
            'stock_1' => 'nullable',
            'stock_2' => 'nullable',
            'stock_3' => 'nullable',
        ]);

        $productVariantData['product_id'] = $listingId;
        ProductVariant::create($productVariantData);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
public function update(Request $request, Listing $listing) {
    // Make sure logged in user is the owner
    if ($listing->seller_id != auth()->id()) {
        abort(403, 'Unauthorized Action');
    }

    $formFields = $request->validate([
        'product_name' => 'required',
        'location' => 'required',
        'price' => 'required',
        'tags' => 'required',
        'description' => 'required'
    ]);

    if ($request->hasFile('images')) {
        $imagePaths = [];

        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('images', 'public');
            $imagePaths[] = $imagePath;
        }

        $formFields['images'] = json_encode($imagePaths);
    }

    $listing->update($formFields);

    return back()->with('message', 'Listing updated successfully!');
}


    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->seller_id != auth()->id()) {
            if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
                Storage::disk('public')->delete($listing->logo);
            }
            $listing->delete();
            return redirect('/')->with('message', 'Listing deleted successfully');
            
        } else {
            abort(403, 'Unauthorized Action');
        }

    }

    // Manage Listings
    public function manage() {
        $sellerId = auth()->user()->seller->id; // Assuming you have a Seller model
        $listings = Listing::where('seller_id', $sellerId)->get();
        
        return view('listings.manage', ['listings' => $listings]);
    }




    /* SHOPPING CART */


    // Show cart
    public function cart() {
        return view('listings.cart', ['cartItems' => auth()->user()->shoppingCart]);
    }

    // Add to cart
    public function addToCart(Request $request) {
        $user = auth()->user();
        $productId = $request->input('listing-id');
        $productName = $request->input('listing-name');
        $price = $request->input('listing-price');
        $variants = $request->input('selected-variants');
        $quantity = 1; 

        // Serialize the variants to a string for comparison
        $serializedVariants = implode(', ', $variants);

        // Check if the item already exists in the cart for the user
        $cartItem = ShoppingCart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->where('variant', $serializedVariants)
            ->first();

        if ($cartItem) {
            // Variants are the same, update quantity
            $cartItem->increment('quantity', $quantity);
        } else {
            // Variants are different or the item doesn't exist, create a new cart item
            ShoppingCart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'product_name' => $productName,
                'price' => $price,
                'quantity' => $quantity,
                'variant' => $serializedVariants,
                'images' => Listing::find($productId)->images
            ]);
        }

        return back()->with('message', 'Added to cart!');
    }

    // Remove an item from the shopping cart
    public function destroyCart(Request $request,$id) {
        $cartItem = ShoppingCart::find($id);

        // Make sure logged in user is owner
        if($cartItem->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if (!$cartItem) {
            return redirect('/cart')->with('error', 'Item not found in cart');
        }

        $cartItem->delete();

        $total = $request->input('total');
        $price = $request->input('price');
        $totalPrice = $total - $price;
        // Reset totalPrice in users table to 0
        User::where('id', auth()->user()->id)->update(['totalPrice' => $totalPrice]);

        return redirect('/cart')->with('message', 'Item has been removed from cart');
    }




    //Payment

    // Show checkout page
    public function checkout(Request $request) {

        $cart = ShoppingCart::where('user_id', auth()->user()->id)->get();

        foreach ($cart as $cartItem) {
            PendingOrder::create([
                'user_id' => auth()->user()->id,
                'product_id' => $cartItem->product_id,
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
        $productPrice = PendingOrder::where('user_id', $user_id)->pluck('price')->toArray();
        $productNamesString = implode(', ', $productNames); 
        $data = [
            'form_params' => [
                'product_names' => $productNamesString,
                'product_price' => $productPrice,

            ]
        ];

    return redirect('/toyyibpay', $data);
    }

    //Pending
    public function pending() {

        $orders = auth()->user()->pendingOrder; // Retrieve the pending orders for the authenticated user
        PendingOrder::where('user_id', auth()->user()->id)->delete();
        return back()->with('message', 'Your order has been placed!');
    }
}
