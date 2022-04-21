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
        .hover-drope-shadow:hover{
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
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
@endsection
@section('content')
    <div class="container mt-5 w-100 pb-5">
        <div class="row">
            <div class="col-lg-8 my-3">
                <div class="rounded-lg w-full">
                    <img src="/storage/images/products/{{$product->image}}" class="rounded-lg cursor-pointer hover-drope-shadow transition duration-300" alt="{{$product->title}}" >
                </div>
            </div>
            <div class="col-lg-4 my-3">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <a href="{{route('products.by.category', $category->slug)}}" class="link-secondary">
                            {{$productCategory->where('id',$product->category_id)->first()->title}}
                        </a>
                        <h2 class="py-4">
                            {{$product->title}}
                        </h2>
                        <div class="d-flex justify-content-between mb-3">
                            <h4>
                                <b>{{$product->price}} DH</b>
                            </h4>
                            
                            <h6>
                                {!!$product->inStock > 0 ? "<div class='text-success'>in stock</div>" : "<div class='text-danger'>Not available</div>"!!}
                            </h6>
                        </div>
                        <form action="{{route('cart.add', $product->slug)}}" method="post">
                            @csrf
                            @if ($product->inStock > 0)
                                <select name="qty" class="form-select" aria-label="Default select example">
                                    @for ($i = 1; $i <= $product->inStock; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="btn btn-dark w-100 my-4 text-white">
                                    Add To Cart
                                </button>
                            @endif
                        </form>
                        <div class="description">
                            <h4>Description</h4>
                            <hr>
                            {{$product->description}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h4>Other Products</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mt-3 mb-3">
                    <div class="row g-2">
                        @foreach ($products as $product)
                            <div class="col-lg-4">
                                
                                <div class="card">
                                    <div class="card-img img-container overflow-hidden" style="height: 250px">
                                        <div class="d-flex justify-content-between align-items-center p-2 position-absolute w-100 "> 
                                            @if ($product->old_price > 0)
                                            <span class='btn btn-danger shadow btn-block'>-{{number_format(100 - (($product->price*100)/$product->old_price), 0, '.', ',')}}%</span>
                                            @endif
                                        </div> 
{{--                                         <div class="d-flex justify-content-between align-items-center p-2 position-absolute w-100 bg-gray-500 opacity-50 hidden" style="height: 250px"></div>--}}  
                                        <a href="{{route('product.show', $product->slug)}}">
                                            <img src="/storage/images/products/{{$product->image}}" class="w-100 img-fluid cursor-pointer">
                                        </a>
                                        
                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            
                                            <div class="text-center w-100">
                                                <h6 class="mb-0">
                                                    {{Str::limit($product->title, 30)}}
                                                </h6> 
                                                <br>
                                                <span class="text-danger font-weight-bold">
                                                    {{$product->price}} DH
                                                </span>
                                            </div>
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>
@endsection