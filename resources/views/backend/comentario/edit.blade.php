@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
<a href="#" id="enlaceBorrar" data-id="{{ $comentario->id }}" data-name="{{ $comentario->titulo }}" class="btn btn-warning">Borrar comentario</a>

<form id="formDelete" action="{{ url('backend/comentario/' . $comentario->id) }}" method="post">
    @method('delete')
    @csrf
</form>

<form role="form" action="{{ url('backend/comentario/' . $comentario->id) }}" method="post" id="editComentarioForm" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="card-body">
        
        
       <div class="form-group">
        <label for="idnoticia">Noticia</label>
        @if(isset($noticias))
        <select name="idnoticia" id="idnoticia" required class="form-control">
            <option value="" disabled>Elige una noticia</option>
            @foreach($noticias as $noticia)
            @if($noticia->id == old('idnoticia', $comentario->idnoticia))
                <option selected value="{{ $noticia->id }}">{{ $noticia->titulo }}</option>
            @else
                <option value="{{ $noticia->id }}">{{ $noticia->titulo }}</option>
            @endif
            @endforeach
        @endif
        </select>
      </div>
        
    
      <div class="form-group">
        <label for="textoComentario">Contenido del comentario</label>
        @error('textoComentario')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <textarea type="text" class="form-control" id="textoComentario" placeholder="Contenido" name="textoComentario">{{ old('textoComentario', $comentario->textoComentario) }}</textarea>
      </div>
      
      <div class="form-group">
        <label for="fecha">Fecha</label>
        @error('fecha')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $comentario->fecha) }}">
      </div>
      
      <div class="form-group">
        <label for="correo">Correo</label>
        @error('correo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="text" class="form-control" id="correo" name="correo" value="{{ old('correo', $comentario->correo) }}">
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