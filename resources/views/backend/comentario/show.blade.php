@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/comentario/' . $comentario->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<a href="{{ url('backend/comentario') }}" class="btn btn-primary">Back</a>
<a href="{{ url('backend/comentario/create') }}" class="btn btn-primary">Añadir comentario</a>
<a href="#" id="enlaceBorrar" data-id="{{ $comentario->id }}" data-name="{{ $comentario->titulo }}" class="btn btn-primary">Borrar comentario</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Field</th>
            <th scope="col">Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Título de la noticia</td>
            <td>{{ $comentario->noticia->titulo }}</td>
        </tr>
        
        <tr>
            <td>Contenido del comentario</td>
            <td>{{ $comentario['textoComentario'] }}</td>
        </tr>
        
        <tr>
            <td>Fecha</td>
            <td>{{ $comentario['fecha'] }}</td>
        </tr>
        
        <tr>
            <td>correo</td>
            <td>{{ $comentario['correo'] }}</td>
        </tr>
    </tbody>
</table>

<!--<img src="{{-- url('portada/' . $portada) --}}" width="100" alt="logo">-->
<!--<img src="{{-- url('privada/' . $logo) --}}" width="100" alt="privada">-->

@endsection