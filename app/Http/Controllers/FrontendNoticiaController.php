<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Noticia;
use Illuminate\Http\Request;

class FrontendNoticiaController extends Controller
{
    function index() {
        $noticias = Noticia::all();
        return view('frontend.index', ['noticias' => $noticias]);
    }
    
    function single(Request $request, $id) {
        $noticia = Noticia::find($id);
        $comentarios = Comentario::all();
        $comentarios = $comentarios->where('idnoticia', $id);
        return view('frontend.single', ['noticia' => $noticia, 'comentarios' => $comentarios]); 
        
    }
    
    
}


//sql noticias de un autor