<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
</head>
<body>

    {{-- variable errors aveces tiene valores a veces no si usamos validate de request aca estaria nlos errores  --}}
    {{-- @dump($errors); --}}

    {{-- Error msj de la session --}}

    {{-- Pregunta si la sesion tiene una propiedad como la que llamamos en Product controller llamada error --}}
    {{-- Ya no lo necesito porque estou usando withErrors('msj') en el controller --}}
    {{-- @if (session()->has('error')) 

        <div class="alert alert-danger">
            {{ session()->get('error') }}

        </div>
        
    @endif
     --}}
    @if (session()->has('success'))

        <div class="alert alert-success">
            {{ session()->get('success') }}

        </div>
        
    @endif

    {{-- Debemos validar si la var errors esta establecida y tiene algun error --}}
    @if ( isset($errors) && $errors->any() ) {{-- any si hay algun error usar ambas  --}}
        
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>    

    @endif
    
    @yield('content')
    
</body>
</html>