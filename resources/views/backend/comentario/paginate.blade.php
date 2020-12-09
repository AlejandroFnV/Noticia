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

@if(isset($search))
<div class="alert alert-light" role="alert">
  Registros encontrados con la búsqueda: "{{ $search }}" order by {{ $orderby }} {{ $sort }} pagina {{ $comentarios->currentPage() ?? '' }}
</div>
@endif

@if(session()->has('op'))
<div class="alert alert-success" role="alert">
  Operation: {{-- session()->get('op') }}. Id: {{ session()->get('id') }}. Result: {{ session()->get('r') --}}
</div>
<br>
@endif

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'asc',
                            'orderby' => 'id'])}}">↓</a>
            id #
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'desc',
                            'orderby' => 'id'])}}">↑</a>
        </th>
        <th scope="col">
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'asc',
                            'orderby' => 'idnoticia'])}}">↓</a>
            Noticia
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'desc',
                            'orderby' => 'idnoticia'])}}">↑</a>
        </th>
        <th scope="col">
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'asc',
                            'orderby' => 'textoComentario'])}}">↓</a>
            textoComentario
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'desc',
                            'orderby' => 'textoComentario'])}}">↑</a>
        </th>
        <th scope="col">
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'asc',
                            'orderby' => 'fecha'])}}">↓</a>
            fecha
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'desc',
                            'orderby' => 'fecha'])}}">↑</a>
        </th>
        <th scope="col">
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'asc',
                            'orderby' => 'correo'])}}">↓</a>
            correo
            <a href="{{ route('backend.comentario.paginate.index',
                            ['search' => $search,
                            'sort' => 'desc',
                            'orderby' => 'correo'])}}">↑</a>
        </th>
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

{{ $comentarios->onEachSide(2)->links() }}

<form id="formDelete" action="{{ url('backend/comentario') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection