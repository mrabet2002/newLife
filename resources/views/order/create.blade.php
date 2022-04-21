@extends('layouts.mainapp')

@section('style')
    <link rel="stylesheet" href="/css/bootstrap.min.css">
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Fenalize Order') }}
    </h2>
@endsection

@section('content')
    
        <div class="container mt-5 p-5">
            <div class="py-3 container relative overflow-x-auto shadow-md sm:rounded-lg shadow bg-white">
                
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
            
                <div class="d-flex justify-content-center">
                    <div class="my-3 text-center">
                        <a href="{{route('order.store')}}" class="btn btn-dark mt-3 px-5">
                            Save Order And Go To Paiment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
@endsection

@section('script')
    <script src="/js/popper.min.js" ></script>
    <script src="/js/bootstrap.min.js" ></script>
@endsection