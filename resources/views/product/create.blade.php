@extends('layouts.mainapp')

@section('style')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add Product') }}
    </h2>
@endsection
    
@section('content')
    <div class="container my-5 w-50">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul style="list-style-type:disc">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" 
                                name="title"
                                placeholder="Title" id="title"
                                class="form-control">
                                <label for="title">Title</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-floating mb-3">
                            <input type="number" 
                                name="price"
                                placeholder="Price" id="price"
                                class="form-control">
                                <label for="price">Price</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-floating mb-3">
                            <input type="number" 
                                name="old_price"
                                placeholder="Olde price" id="old_price"
                                class="form-control">
                                <label for="old_price">Olde price</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-floating mb-3">
                            <input type="number" 
                                name="inStock"
                                placeholder="Quantity in stock" id="instock"
                                class="form-control">
                                <label for="instock">Quantity in stock</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" 
                        name="image"
                        class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <select class="form-control" name="category_id" class="form-select">
                            <option value="" selected disabled>
                                Choisir une categorie
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-floating">
                            <textarea name="description" class="form-control h-25" placeholder="Description" id="floatingTextarea2" cols="30" rows="10"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                    </div>
                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-success">Validate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection