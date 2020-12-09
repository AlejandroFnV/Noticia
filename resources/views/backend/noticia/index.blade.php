@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<a href="{{ url('backend/noticia/create') }}" class="btn btn-primary">Añadir noticia</a>

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
        <th scope="col">titulo</th>
        <th scope="col">texto</th>
        <th scope="col">autor</th>
        <th scope="col">fecha</th>
        <th scope="col">ver comentarios</th>
        <th scope="col">show</th>
        <th scope="col">edit</th>
        <th scope="col">delete</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($noticias as $noticia)
        <tr>
            <td scope="row">{{ $noticia->id }}</td>
            <td>{{ $noticia->titulo }}</td>
            <td>{{ $noticia->textoNoticia }}</td>
            <td>{{ $noticia->autor }}</td>
            <td>{{ $noticia->fecha }}</td>
            
            <td><a href="{{ url('backend/comentario/' . $noticia->id . '/comentarios') }}">comentarios</a></td>
            
            <td><a href="{{ url('backend/noticia/' . $noticia->id) }}">show</a></td>
            <td><a href="{{ url('backend/noticia/' . $noticia->id . '/edit') }}">edit</a></td>
            <td><a data-id="{{ $noticia->id }}" data-name="{{ $noticia->titulo }}" class="enlaceBorrar" href="#">delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/noticia') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection