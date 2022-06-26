@extends('layouts.app')

@section('content')
    
    <h1>{{$product->title}} ({{$product->id}})</h1>

    <p>{!! $html !!}</p>  {{-- // ## Permite codigo html sino se verian las etiquetas --}}

    <p>{{-- $product --}}</p> {{-- comentario laravel no se vera en codigo fuente --}}

    {{-- ignora la variable en blade para ser usada en algun framework tipo vuew react etc --}}
    {{-- <p>@{{ product }}</p>  --}}


    @include('components.product-cart')
    
@endsection