<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("welcome")->with([
            'products' => Product::latest()->paginate(6),
            'categories' => Category::has('products')->get(),
        ]);
    }
    public function getProductsByCategory($slug)
    {
        $categories = Category::where("slug", $slug)->get();
        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->paginate(6);
        }
        
        return view("welcome")->with([
            'products' => $products,
            'categories' => Category::has('products')->get(),
        ]);
    }
}
