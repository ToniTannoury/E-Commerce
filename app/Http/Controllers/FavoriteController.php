<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Customer;
use App\Models\Product;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        $customerId = $request->input('customer_id');
        $productId = $request->input('product_id');

        // Check if the customer and product exist
        $customer = Customer::find($customerId);
        $product = Product::find($productId);

        if (!$customer || !$product) {
            return response()->json(['message' => 'Customer or Product not found'], 404);
        }

        // Check if the favorite already exists
        if ($customer->favorites()->where('product_id', $productId)->exists()) {
            return response()->json(['message' => 'Product is already a favorite'], 409);
        }

        // Create a new favorite record in the database
        $favorite = new Favorite();

        $favorite->customer_id = $customerId;
        $favorite->product_id = $productId;
        $favorite->save();

        return response()->json(['message' => 'Product added to favorites'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
         if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        // Delete the favorite record from the database
        $favorite->delete();

        return response()->json(['message' => 'Favorite removed'], 200);
    }
}
