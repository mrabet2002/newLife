@extends('layouts.mainapp')

@section('style')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .rate {
            border-bottom-right-radius: 12px;
            border-bottom-left-radius: 12px
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #0464a3;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0;
            transition: 0.4s
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important;
            transition: 0.4s
        }

        .rating>input:checked~label:before {
            opacity: 1

        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>
@endsection

@section('header')
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
        </a>
    
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @foreach ($categories as $category)
                <li>
                    <a class="dropdown-item" href="{{route('products.by.category', $category->slug)}}"> {{Str::limit($category->title, 30)}} </a>
                </li>
            @endforeach
        </ul>
    </div>
    @if (request()->route()->getName() == 'products.by.category')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            {{ __($categories->where('slug', request()->slug)->first()->title) }}
        </h2>
    @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            {{ __('Home') }}
        </h2>
    @endif
@endsection

@section('content')
    
    
    <div class="container mt-5 pb-5">
        <div class="card">
            <div class="card-header text-center">
                <h4>Our Products</h4>
            </div>
            <div class="container-fluid mt-3 mb-3">
                <div class="row g-2">
                    @foreach ($products as $product)
                        <div class="col-lg-4">
                            
                            <div class="card">
                                <div class="card-img img-container overflow-hidden" style="height: 250px">
                                    <div class="d-flex justify-content-between align-items-center p-2 position-absolute w-100">
                                        @if ($product->old_price > 0)
                                            <span class='btn btn-danger shadow btn-block'>-{{number_format(100 - (($product->price*100)/$product->old_price), 0, '.', ',')}}%</span>
                                        @endif
                                    </div> 
                                    <a href="{{route('product.show', $product->slug)}}">
                                        <img src="/storage/images/products/{{$product->image}}" class="w-100 img-fluid cursor-pointer">
                                    </a>
                                </div>
                                <div class="p-3">
                                    
                                    <div class="w-100 text-center">
                                        <h6 class="mb-0">{{Str::limit($product->title, 30)}}</h6> 
                                        <br>
                                        <span class="text-danger" style="font-weight: bold">{{$product->price}} DH</span>
                                    </div>
                                    <div class="rating"> 
                                        <input type="radio" name="rating{{$product->id}}" value="5" id="5{{$product->id}}">
                                        <label for="5{{$product->id}}">☆</label> 
                                        <input type="radio" name="rating{{$product->id}}" value="4" id="4{{$product->id}}">
                                        <label for="4{{$product->id}}">☆</label> 
                                        <input type="radio" name="rating{{$product->id}}" value="3" id="3{{$product->id}}">
                                        <label for="3{{$product->id}}">☆</label> 
                                        <input type="radio" name="rating{{$product->id}}" value="2" id="2{{$product->id}}">
                                        <label for="2{{$product->id}}">☆</label> 
                                        <input type="radio" name="rating{{$product->id}}" value="1" id="1{{$product->id}}">
                                        <label for="1{{$product->id}}">☆</label> 
                                    </div>
                                    <div class="mt-3"> <a href="{{route('product.show', $product->slug)}}" class="btn btn-primary btn-block w-100">Show details</a> </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="justify-content-center d-flex">
                {{$products->links()}}
            </div> 
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>
@endsection

