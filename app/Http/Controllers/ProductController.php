<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return Product::get();
    }

    public function store(Request $request) {
        $request->validate([
            'productName' => 'required|string|max:255',
            'imgPath' => 'string|nullable',
            'description' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $product = new Product([
            'productName' => $request->productName,
            'imgPath' => $request->imgPath,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        if ($product->save()) {
            $product->refresh();
            return response()->json([
                'message' => 'Successfully created Product',
            ], 201);
        } else {
            return response()->json([
                'error' => 'Provide proper detail'
            ]);
        }
    }

    public function update(Request $request, Product $product) {
        if ($request->productName != null) {
            $product->productName = $request->productName;
        }
        if ($request->imgPath != null) {
            $product->imgPath = $request->imgPath;
        }
        if ($request->description != null) {
            $product->description = $request->description;
        }
        if ($request->price != null) {
            $product->price = $request->price;
        }
        if ($request->quantity != null) {
            $product->quantity = $request->quantity;
        }

        if ($product->save()) {
            $product->refresh();
            return response()->json([
                'message' => 'Update product successfully',
            ], 201);
        } else {
            return response()->json([
                'error' => 'Unable to update product',
            ], 500);
        }
    }
}

