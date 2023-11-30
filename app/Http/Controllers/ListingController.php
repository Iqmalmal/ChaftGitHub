<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
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

        $colours = [];
        $sizes = [];
        $capacities = [];
        $stocks = [];

        // Loop through the variant fields dynamically (assuming a maximum of 3 variants)
        for ($i = 1; $i <= 3; $i++) {
            // Gather variant data
            $colour = $request->input('colour_' . $i);
            $size = $request->input('size_' . $i);
            $capacity = $request->input('capacity_' . $i);
            $stock = $request->input('stock_' . $i);

            // Check if any of the fields are not empty before adding to the respective arrays
            if ($colour) {
                $colours[] = $colour;
            }
            if ($size) {
                $sizes[] = $size;
            }
            if ($capacity) {
                $capacities[] = $capacity;
            }
            if ($stock) {
                $stocks[] = $stock;
            }
        }

        $productVariantData = $request->validate([
            'colour_1' => 'nullable',
            'size_1' => 'nullable',
            'capacity_1' => 'nullable',
            'stock_1' => 'nullable',
        ]);


        $productVariantData['colour_1'] = json_encode($colours);
        $productVariantData['size_1'] = json_encode($sizes);
        $productVariantData['capacity_1'] = json_encode($capacities);

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

        if($listing->seller_id = auth()->id()) {
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
}
