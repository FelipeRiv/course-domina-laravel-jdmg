@extends('layouts.app')

@section('content')

<h1>Create a Product</h1>

{{-- Usando el helper de Route le pasamos el name de una ruta--}}
<form action="{{ route('products.store') }}" method="post">

    @csrf

    <div class="form-row">
        <label for="title">title</label>
        <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" required>
    </div>

    <div class="form-row">
        <label for="description">description</label>
        <input class="form-control" type="text" name="description" id="description" value="{{ old('description') }}" required>
    </div>

    <div class="form-row">
        <label for="price">price</label>
        <input class="form-control" type="number" min="1.00" step="0.01" name="price" id="price" value="{{ old('price') }}" required>
    </div>
    
    <div class="form-row">
        <label for="stock">stock</label>
        <input class="form-control" type="number" min="0" name="stock" id="stock" value="{{ old('stock') }}" required>
    </div>
    
    <div class="form-row">
        <label for="status">status</label>
        <select class="custom-select" name="status" id="status">
            {{-- se trata de poner que valor estaba previamente con un selected de atributo 
                Vamos a preguntar si el valor del old status hace match con alguna de las opciones de available o unavailable
             --}}
            <option value="" selected>Select</option>
            <option {{ old('status') == 'available' ? 'selected' : '' }} value="available" >Available</option>
            <option {{ old('status') == 'unavailable' ? 'selected' : '' }} value="unavailable" >Unavailable</option>
        </select>
    </div>

    <div class="form-row mt-3">
        <button type="submit" class="btn btn-primary btn-lg">Create Product</button>
    </div>


</form>



@endsection
