<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\OrderLines;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Order::create([
                "user_id" => auth()->id(),
                "total" => $request->session()->get('orderTotal'),
            ]);
            $order = Order::where('user_id', auth()->id())->latest()->first();
            foreach ($request->session()->get('cartproducts') as $key => $cartProduct) {
                OrderLines::create([
                    "qty" => $cartProduct['qty'],
                    "price" => $cartProduct['price'],
                    "product_id" => $cartProduct['product']->id,
                    "order_id" => $order->id,
                ]);
            }
            $request->session()->forget('cartproducts');
            $request->session()->forget('orderTotal');
            return redirect()->route('cart.show')->with('success', 'Your order saved successfully');
        } catch (Exception $e) {
            return redirect()->route('cart.show')->with('eroor', 'Somthing went wrang');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
