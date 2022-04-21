
@extends('layouts.mainapp')

@section('style')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
{{--  Charts --}}
<div class="container  my-5">
    <div class="card shadow">
        <div class="card-body">
            <div>
                <h2>Number Of Orders Last Months</h2>
                @php
                    $j = 0;
                @endphp
                @for ($i = 1; $i <= 12; $i++)
                    <div class="orders hidden">
                        {{isset($orders[$j]) && $orders[$j]->month == $i ? $orders[$j++]->count : "0"}}
                    </div>
                @endfor
                {{-- <div class="orders">{{isset($orders[2]) ? "1" : "0"}}</div>
                @foreach ($orders as $order)
                    <div class="orders">{{$order->count}}</div>
                @endforeach --}}
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  Products list --}}
    <div class="container mt-5 p-5">
        <div class="py-3 container relative overflow-x-auto shadow-md sm:rounded-lg shadow bg-white">
            
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        
            <div class="d-flex justify-content-between">
                <div class="p-4">
                    <label for="table-search" class="sr-only">Search</label>
                    <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
                <div class="my-5 me-4">
                    <a href="{{route('product.create')}}" class="btn btn-success px-5">Add</a>
                </div>
            </div>
                <table class="w-100 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 mb-5">
                        <tr>
                            <th scope="col" class="px-5 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-5 py-3">
                                price
                            </th>
                            <th scope="col" class="px-5 py-3">
                                Quantity
                            </th>
                            <th scope="col" class="px-5 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-5 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="bg-white bg-gray-50 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-5 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{Str::limit($product->title, 20)}}
                                </th>
                                <td class="px-5 py-4">
                                    {{$product->price}} DH
                                </td>
                                <td class="px-5 py-4">
                                    {{$product->inStock}}
                                </td>
                                <td class="px-5 py-4">
                                    {{Str::limit($categories->where('id', $product->category_id)->first()->title, 20)}}
                                </td>
                                <td class="px-5 py-4">
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{$product->slug}}">
                                        <?xml version="1.0" ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </a>
                                    <a href="{{route('product.edit', $product->slug)}}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
                @if (request()->route()->getName() == 'dashboard')
                    <div class="w-100 text-center">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('allProducts') }}">
                            {{ __('Show All Products') }}
                        </a>
                    </div>
                @endif
                @if (request()->route()->getName() == 'allProducts')
                    <div class="w-100 text-center">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                            {{ __('Show Less') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modale -->
    @foreach ($products as $product)
        <div class="modal fade" id="{{$product->slug}}" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    are you sure you want to delete this product "{{$product->title}}"  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{route('product.delete', $product->slug)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
<script src="/js/popper.min.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

<script>
    var ctx = document.getElementById("myChart").getContext("2d");
    let orders = document.querySelectorAll('.orders');
    let dataVal = [];
    for (let i = 0; i < orders.length; i++) {
        dataVal[i] = orders[i].innerHTML
    }
    var myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "Jan",	
            "Feb",
            "Mar",
            'Apr',
            "May",
            "June",
            "July",
            "Aug",
            "Sept",
            "Oct",
            "Nov",
            "Dec",
        ],
        datasets: [
            {
                label: "work load",
                data: dataVal,
                backgroundColor: "rgba(2, 72, 151, 0.5)",
            },
        ],
    },
    });
</script>
@endsection