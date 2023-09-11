<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
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
            'seller' => 'required',
            'location' => 'required',
            'price' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

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
            'image_1' => 'nullable',
            'image_2' => 'nullable',
            'image_3' => 'nullable',
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
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'product_name' => 'required',
            'seller' => 'required',
            'location' => 'required',
            'price' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
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

    // Show cart
    public function cart() {
        return view('listings.cart');
    }
}
