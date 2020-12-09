@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<a href="{{ url('backend/comentario/create') }}" class="btn btn-primary">Añadir comentario</a>

@if(Session::get('op') != null)
<div class="alert alert-success" role="alert">
  Noticia añadida correctamente, con id: {{ Session::get('id') }}
</div>
<br>
@endif

<!-- 
op -> store, update, destroy
r -> numero negativo, 0, positivo (acierto)
id -> id del elemento afectado
-->
@if(session()->has('op'))
<div class="alert alert-success" role="alert">
  Operation: {{-- session()->get('op') }}. Id: {{ session()->get('id') }}. Result: {{ session()->get('r') --}}
</div>
<br>
@endif

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">id #</th>
        <th scope="col">Noticia</th>
        <th scope="col">textoComentario</th>
        <th scope="col">fecha</th>
        <th scope="col">correo</th>
        <th scope="col">show</th>
        <th scope="col">edit</th>
        <th scope="col">delete</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($comentarios as $comentario)
        <tr>
            <td scope="row">{{ $comentario->id }}</td>
            <td>{{ $comentario->noticia->titulo }}</td>
            <td>{{ $comentario->textoComentario }}</td>
            <td>{{ $comentario->fecha }}</td>
            <td>{{ $comentario->correo }}</td>
            
            <td><a href="{{ url('backend/comentario/' . $comentario->id) }}">show</a></td>
            <td><a href="{{ url('backend/comentario/' . $comentario->id . '/edit') }}">edit</a></td>
            <td><a data-id="{{ $comentario->id }}" data-name="{{ $comentario->titulo }}" class="enlaceBorrar" href="#">delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/comentario') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection