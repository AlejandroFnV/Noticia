<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
// use App\Http\Controllers\NoticiaController;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    function autorNoticias($autor) {
        $noticias = Noticia::all();
        $noticiasAutor = $noticias->where('autor', $autor);
        // dd($noticiasAutor);
        return view('frontend.autor', ['autor' => $autor, 'noticiasAutor' => $noticiasAutor]); 
    }
}
