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

<form role="form" action="{{ url('backend/comentario') }}" method="post" id="createComentarioForm">
    @csrf
    <div class="card-body">
      
      <div class="form-group">
        <label for="idnoticia">Noticia</label>
        @if(isset($noticias))
        <select name="idnoticia" id="idnoticia" required class="form-control">
            <option value="" disabled selected>Elige una noticia</option>
            @foreach($noticias as $noticia)
                <option value="{{ $noticia->id }}">{{ $noticia->titulo }}</option>
            @endforeach
        </select>
        @else
            {{ $noticia->titulo }}
            <input type="hidden" id="idnoticia" name="idnoticia" value="{{ $noticia->id }}"/>
        @endif
      </div>
      
      <div class="form-group">
        <label for="textoComentario">Contenido del comentario</label>
        @error('textoComentario')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <textarea type="text" class="form-control" id="textoComentario" placeholder="Contenido" name="textoComentario">{{ old('textoComentario') }}</textarea>
      </div>
      
      <div class="form-group">
        <label for="fecha">Fecha</label>
        @error('fecha')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}">
      </div>
      
      <div class="form-group">
        <label for="correo">Correo</label>
        @error('correo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" id="correo" name="correo" value="{{ old('correo') }}">
      </div>
      
    </div>
    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
</form>

@endsection