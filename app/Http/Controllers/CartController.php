<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderLines;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(OrderLines $orderLines)
    {
        //
        return view('cart.show')->with([
            'products' => Product::latest()->paginate(6),
            'categories' => Category::has('products')->get(),
        ]);
    }

    public function addProduct(Request $request, $slug)
    {
        
        $product = Product::where('slug', $slug)->first();
        $orderLine['product'] = $product;
        $orderLine['qty'] = $request->qty;
        $orderLine['price'] = $orderLine['qty']*$product->price;
        $request->session()->push('cartproducts', $orderLine);
        if(!$request->session()->has('orderTotal')) $request->session()->put('orderTotal', 0);
        $orderTotal = $request->session()->get('orderTotal');
        $request->session()->put('orderTotal', $orderTotal+$orderLine['price']);
        return redirect()->route('cart.show')->with([
            'categories' => Category::has('products')->get(),
        ]);
    }

    public function deleteProduct(Request $request, $key)
    {
        $orderLines = $request->session()->get('cartproducts');
        $orderTotal = $request->session()->get('orderTotal');
        $request->session()->put('orderTotal', $orderTotal-$orderLines[$key]['price']);
        unset($orderLines[$key]);
        $request->session()->put('cartproducts', $orderLines);
        if (empty($orderLines)) {
            $request->session()->forget('cartproducts');
            $request->session()->forget('orderTotal');
        }
        return redirect()->route('cart.show')->with('success', 'Product Removed');
        
    }
    public function editProduct(Request $request, $key)
    {
        $orderLine = $request->session()->get('cartproducts');
        $orderTotal = $request->session()->get('orderTotal');
        $request->session()->put('orderTotal', $orderTotal-$orderLine[$key]['price']);
        $orderLine[$key]['qty'] = $request->qty;
        $orderLine[$key]['price'] = $request->qty*$orderLine[$key]['product']->price;
        $orderTotal = $request->session()->get('orderTotal');
        $request->session()->put('orderTotal', $orderTotal+$orderLine[$key]['price']);

        $request->session()->put('cartproducts', $orderLine);
        return redirect()->back()->with('success', 'The quantity edited');
    }
}
