@extends('bootstrap.template')

@section('title')
Editar un alquiler
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/alquiler/createStyle.css') }}">
@endsection

@section('content')
<form action="{{ route('alquiler.store') }}" method="post" enctype="multipart/form-data"> 
    @csrf
    <div class="espacio">
        @error('idcopia')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="idcopia">Pelicula que se va a alquilar</label>
        <select name="idcopia" id="idcopia" required class="form-control">
            <option value="" @if(old('idcopia', $alquiler->idcopia</option>) == null) selected @endif disabled>Selecciona una pelicula</option>
            @foreach($copias as $copia)
                <option value="{{ $copia->id }}" @if(old('idcopia', $alquiler->idcopia) == $copia->id) selected @endif>{{ $copia->pelicula->titulo }}</option>
            @endforeach
         </select>
    </div>
    <div class="espacio">
        @error('idcliente')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="idcliente">Cliente que alquila</label>
        <select name="idcliente" id="idcliente" required class="form-control">
            <option value="" @if(old('idcliente', $alquiler->idcliente</option>) == null) selected @endif disabled>Selecciona un cliente</option>
            @foreach($clientes as $indice=>$idcliente)
                <option value="{{ $indice }}" @if(old('idcliente', $alquiler->idcliente</option>) == $indice) selected @endif>{{ $idcliente }}</option>
            @endforeach
         </select>
    </div>
    <div class="espacio">
        @error('fecha_sal')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="fecha_sal">Día del alquiler:</label>
        <input class="form-control" required id="fecha_sal" name="fecha_sal"  value="{{ old('fecha_sal', $alquiler->fecha_sal) }}" type="date">
    </div>
    <div class="espacio">
        @error('fecha_dev')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="fecha_dev">Día del alquiler:</label>
        <input class="form-control" id="fecha_dev" name="fecha_dev"  value="{{ old('fecha_dev', $alquiler->fecha_dev) }}" type="date">
    </div>
    <div class="espacio">
        @error('precio')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="precio">Precio del alquiler:</label>
        <input class="form-control" min="1" max="999" required id="precio" name="precio" placeholder="Precio del alquiler" value="{{ old('precio', $alquiler->precio) }}" type="number">
    </div>
    <div class="espacio">
        <input class="btn btn-primary" value="Alquilar Pelicula" type="submit">
    </div>
</form>
@endsection