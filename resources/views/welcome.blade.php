@extends('layouts.app')

@section('content')

    <h1>Welcome</h1>

    @empty($products)
    <div class="alert alert-danger">
        No products yet...
    </div>

    @else
        <div class="row">

            {{-- Componente para reutilizar en las vistas donde se requiera para mostrar products --}}

            @foreach ($products as $product)

                <div class="col-3">
                    {{-- En caso de querer pasar valores extras en el include --}}
                    {{-- @include('components.product-cart', ['test' => 'testing'])  --}}
                    @include('components.product-cart') 


                </div>
                
            @endforeach
        </div>
        
    @endempty
    
    <p>Lets start!</p>

@endsection