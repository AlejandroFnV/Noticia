@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
<a href="#" id="enlaceBorrar" data-id="{{ $noticia->id }}" data-name="{{ $noticia->titulo }}" class="btn btn-warning">Borrar noticia</a>

<form id="formDelete" action="{{ url('backend/noticia/' . $noticia->id) }}" method="post">
    @method('delete')
    @csrf
</form>

<form role="form" action="{{ url('backend/noticia/' . $noticia->id) }}" method="post" id="editNoticiaForm" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="card-body">
        
      <div class="form-group">
        @error('titulo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="titulo">Titulo</label>
        <input type="text" class="form-control" id="titulo" placeholder="titulo" name="titulo" value="{{ old('titulo' , $noticia->titulo) }}">
      </div>
      
      <div class="form-group">
        @error('textoNoticia')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="textoNoticia">Contenido de la noticia</label>
        <textarea class="form-control" id="textoNoticia" placeholder="Contenido de la noticia" name="textoNoticia">{{ old('textoNoticia' , $noticia->textoNoticia) }}</textarea>
      </div>
      
      <div class="form-group">
        @error('autor')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="autor">Autor</label>
        <input type="text" class="form-control" id="autor" placeholder="autor" name="autor" value="{{ old('autor' , $noticia->autor) }}">
      </div>
      
      <div class="form-group">
         @error('fecha')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="fecha">Fecha</label>
        <input required type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha' , $noticia->fecha) }}">
      </div>
      
      <div class="form-group">
        <label for="portada">Portada de la noticia</label>
        <input type="file" class="form-control" id="portada" name="portada">
      </div>
      
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection