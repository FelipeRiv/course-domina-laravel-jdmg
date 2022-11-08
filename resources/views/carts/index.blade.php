@extends('layouts.app')

@section('content')

    <h1>Your Cart</h1>

    @if( !isset($cart) || $cart->products->isEmpty() )
    <div class="alert alert-danger">
        cart is empty...
    </div>

    @else
        <h4 class="text-center">Your cart total <strong>{{ $cart->total }}</strong></h4>
        <a class="btn btn-success mb-3" href="{{ route('orders.create') }}">
            Start Order
        </a>

        <div class="row">

            {{-- Componente para reutilizar en las vistas donde se requiera para mostrar cart --}}

            @foreach ($cart->products as $product)

                <div class="col-3">
                    {{-- En caso de querer pasar valores extras en el include --}}
                    {{-- @include('components.product-cart', ['test' => 'testing'])  --}}
                    @include('components.product-cart') 


                </div>
                
            @endforeach
        </div>
        
    @endempty

@endsection