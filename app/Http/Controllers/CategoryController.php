<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, Colocation $colocation) {
        $categories = $colocation->categories()->get();
        $user = $request->user();
        return view('categories.create', compact('categories', 'user'));
    }

    public function store(CategoryRequest $request, Colocation $colocation) {
        $data = $request->only('name');
        if(Category::where('colocation_id', $colocation->id)->where('name', $data['name'])->exists()){
            return back()->withErrors(['error' => 'Category Already Exists']);
        }

        $category = Category::create([...$data, 'colocation_id' => $colocation->id]);
        return back()->with(['success' => 'category have been created']);
    }
    

    public function delete(Colocation $colocation, Category $category) {
        $category->delete();
        return back()->with(['success' => 'category have been Deleted']);
    }
}
