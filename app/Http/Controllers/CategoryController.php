<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return Category::get();
    }

    public function store(Request $request) {
        $request->validate([
            'categoryName' => 'string|max:255',
        ]);

        $category = new Category([
            'categoryName' => $request->categoryName,
        ]);

        if ($category->save()) {
            $category->refresh();
            return response()->json([
                'message' => 'Create category successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Failed to create category'
            ]);
        }
    }

    public function update(Request $request, Category $category) {
        if ($request->categoryName != null) {
            $category->categoryName = $request->categoryName;
        }

        if ($category->save()) {
            $category->refresh();
            return response()->json([
                'message' => 'Update category successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Failed to update category'
            ]);
        }
    }
}
