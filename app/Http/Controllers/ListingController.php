<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\ImageManagerStatic as Image;

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
    
        // Retrieve associated product variant data
        $productVariantData = $listing->productVariants; // Assuming you have defined the relationship
    
        return view('listings.show', [
            'listing' => $listing,
            'productVariantData' => $productVariantData,
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
            'images' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('images')) {
            $imagePaths = [];
    
            foreach ($request->file('images') as $image) {
                $imagePath = $image->getClientOriginalName();
                $image_resize = ImageManagerStatic::make($image->getRealPath());
                $image_resize->resize(300, 300);
                $imagePath = $image->store('images', 'public');
                $imagePaths[] = $imagePath;
            }
    
            $formFields['images'] = json_encode($imagePaths);
        }

        $formFields['user_id'] = auth()->id();
        $formFields['seller'] = auth()->user()->name;
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
    if ($listing->user_id != auth()->id()) {
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

        // Update the 'images' field with the new image paths
        $formFields['images'] = json_encode($imagePaths);
    }

    $listing->update($formFields);

    return back()->with('message', 'Listing updated successfully!');
}


    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
        
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings]);
    }



    /* SHOPPING CART */
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

    // Show cart
    public function cart() {
        return view('listings.cart', ['cartItems' => auth()->user()->shoppingCart]);
    }

    

    // Remove an item from the shopping cart
    public function destroyCart($id) {
        $cartItem = ShoppingCart::find($id);

        // Make sure logged in user is owner
        if($cartItem->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if (!$cartItem) {
            return redirect('/cart')->with('error', 'Item not found in cart');
        }

        $cartItem->delete();

        return redirect('/cart')->with('message', 'Item has been removed from cart');
    }

    

}
