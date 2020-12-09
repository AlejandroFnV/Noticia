@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>

@if(Session::get('error') != null)
  <h2>{{ Session::get('error') }}</h2>
@endif

<!--mostrar todos los errores juntos-->
{{--@if ($errors->any())
  <div class="alert alert-danger">
        <ul>            
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>            
            @endforeach       
        </ul>    
  </div>
@endif--}}

<form role="form" action="{{ url('backend/noticia') }}" method="post" id="createNoticiaForm">
    @csrf
    <div class="card-body">
        
      <div class="form-group">
        <label for="titulo">Título</label>
        @error('titulo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" id="titulo" placeholder="Titulo de la noticia" name="titulo" value="{{ old('titulo') }}">
      </div>
      
      <div class="form-group">
        <label for="textoNoticia">Contenido de la noticia</label>
        @error('textoNoticia')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
       <textarea type="text" class="form-control" id="textoNoticia" name="textoNoticia" placeholder="Escriba aquí el contenido de la noticia">{{ old('textoNoticia') }}</textarea>
      </div>
      
      <div class="form-group">
        <label for="autor">Autor</label>
        @error('autor')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" id="autor" placeholder="Autor de la noticia" name="autor" value="{{ old('autor') }}">
      </div>
      
      <div class="form-group">
        <label for="fecha">Fecha</label>
        @error('fecha')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}">
      </div>
      
    </div>
    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
</form>

@endsection