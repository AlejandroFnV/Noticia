<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    
    //nombre de la tabla, obligatorio
    protected $table = 'comentario';
    
    //tabla ticket: id, created_at, updated_at
    protected $fillable = ['idnoticia', 'textoComentario', 'fecha', 'correo'];

    public function noticia () {        
        return $this->belongsTo ('App\Models\Noticia', 'idnoticia');
    }
}
