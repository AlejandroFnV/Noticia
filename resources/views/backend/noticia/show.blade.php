@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/noticia/' . $noticia->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<a href="{{ url('backend/noticia') }}" class="btn btn-primary">Back</a>
<a href="{{ url('backend/noticia/create') }}" class="btn btn-primary">Añadir noticia</a>
<a href="#" id="enlaceBorrar" data-id="{{ $noticia->id }}" data-name="{{ $noticia->titulo }}" class="btn btn-primary">Borrar noticia</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Field</th>
            <th scope="col">Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Titulo</td>
            <td>{{ $noticia['titulo'] }}</td>
        </tr>
        
        <tr>
            <td>Contenido de la noticia</td>
            <td>{{ $noticia['textoNoticia'] }}</td>
        </tr>
        
        <tr>
            <td>Autor</td>
            <td>{{ $noticia['autor'] }}</td>
        </tr>
        
        <tr>
            <td>Fecha</td>
            <td>{{ $noticia['fecha'] }}</td>
        </tr>
    </tbody>
</table>

<img src="{{ url('portada/' . $portada) }}" width="100" alt="logo">
<!--<img src="{{-- url('privada/' . $logo) --}}" width="100" alt="privada">-->

@endsection