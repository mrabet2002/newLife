@extends('layouts.mainapp')

@section('style')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Cart') }}
    </h2>
@endsection

@section('content')
    @if (session()->has('cartproducts'))
    <div class="container mt-5 p-5">
        <div class="py-3 container relative overflow-x-auto shadow-md sm:rounded-lg shadow bg-white">
            
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        
            <div class="d-flex justify-content-end">
                <div class="my-5 me-4">
                    <a href="{{route('home')}}" class="text-gray-500 transition text-decoration-none hover:text-gray-700 px-5">Keep shopping</a>
                </div>
            </div>
            <div>
                <table class="w-100 text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody>
                        @foreach (session()->get('cartproducts') as $key => $cartproduct)
                            <tr class="bg-gray-100 rounded border-bottom-2">
                                <td class="px-5 py-4">
                                    <div class="overflow-hidden" style="height: 200px; width:270px; ">
                                        <img src="/storage/images/products/{{$cartproduct['product']->image}}" class="w-100 img-fluid rounded">
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <form action="{{route('cart.edit.product', $key)}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <select name="qty" class="form-select form-control mb-3" aria-label="Default select example">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{$i}}" {{$cartproduct['qty'] == $i?'selected':''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button type="submit" href="{{route('cart.edit.product', $cartproduct['product']->slug)}}" class="form-control btn btn-secondary">
                                                    modify
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </td>
                                <td class="px-5 py-4">
                                    @php
                                        $category = $categories->where('id', $cartproduct['product']->category_id)->first();
                                    @endphp
                                    <div class="py-2">
                                        <a class="text-gray-500 transition text-decoration-none hover:text-gray-700" href="{{route('products.by.category', $category->slug)}}">
                                            {{Str::limit($category->title, 20)}}
                                        </a>
                                        <br>
                                        <a class="text-gray-500 transition text-decoration-none hover:text-gray-700" href="{{route('product.show', $cartproduct['product']->slug)}}">
                                            {{Str::limit($cartproduct['product']->title, 20)}}
                                        </a>
                                        <br>
                                        {{$cartproduct['price']}} DH
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{'product-'.$key}}">
                                        <?xml version="1.0" ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </a>
                                    
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3 text-center">
                    <h4 class="text-dark mt-3 px-5">{{session()->get('orderTotal')}} DH</h4>
                </div>
                <div class="my-3 text-center">
                    <a href="{{route('order.create')}}" class="btn btn-dark mt-3 px-5">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modale -->
    @foreach (session('cartproducts') as $key => $cartproduct)
        <div class="modal fade" id="{{'product-'.$key}}" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    are you sure you want to delete this product from cart ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{route('cart.delete.product', $key)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    @endforeach
    @else
        <div class="container mt-5 p-5">
            <div class="py-3 container relative overflow-x-auto shadow-md sm:rounded-lg shadow bg-white">
                
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
            
                <div class="d-flex justify-content-end">
                    <div class="my-5 me-4">
                        <a href="{{route('home')}}" class="text-gray-500 transition text-decoration-none hover:text-gray-700 px-5">Keep shopping</a>
                    </div>
                </div>
                    <h3 class="d-flex text-secondary py-5 justify-content-center">
                        Your Cart Is Empty
                    </h3>
            </div>
        </div>
    @endif
    
@endsection

@section('script')
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>
@endsection

