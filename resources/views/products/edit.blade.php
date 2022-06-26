@extends('layouts.app')

@section('content')

<h1>Edit a Product</h1>

{{-- Usando el helper de Route le pasamos el name de una ruta especificado en routes/web.php --}}
<form action="{{ route( 'products.update', ['product' => $product->id] ) }}" method="post">

    @method('PUT')
    @csrf

    <div class="form-row">
        <label for="title">title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title') ?? $product->title}}" id="title" required>
    </div>

    <div class="form-row">
        <label for="description">description</label>
        <input class="form-control" type="text" name="description" value="{{ old('description') ?? $product->description}}" id="description" required>
    </div>

    <div class="form-row">
        <label for="price">price</label>
        <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{ old('price') ?? $product->price}}" id="price" required>
    </div>
    {{-- Operador de Union similar a ternario pero con solo 1 opcion 
    value="{{  old('title') ?? $product->title  }}" // doble signo de ?? significa sino esta definido el primero entonces se usa el segundo 
     --}}
    <div class="form-row">
        <label for="stock">stock</label>
        <input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') ?? $product->stock}}" id="stock" required>
    </div>
    
    <div class="form-row">
        <label for="status">status</label>
        <select class="custom-select" name="status" id="status">
            {{-- Si el status del producto es available entonces establezca el atributo selected sino en blanco --}}
            <option {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }} value="available" >Available</option>
            <option {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }} value="unavailable" >Unavailable</option>
        </select>
    </div>

    <div class="form-row mt-3">
        <button type="submit" class="btn btn-primary btn-lg">Create Product</button>
    </div>


</form>



@endsection
