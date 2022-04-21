<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderLines;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderLinesRequest;
use App\Http\Requests\UpdateOrderLinesRequest;

class OrderLinesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderLinesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderLinesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderLines  $orderLines
     * @return \Illuminate\Http\Response
     */
    public function show(OrderLines $orderLines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderLines  $orderLines
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderLines $orderLines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderLinesRequest  $request
     * @param  \App\Models\OrderLines  $orderLines
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderLinesRequest $request, OrderLines $orderLines)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderLines  $orderLines
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
    }
}
