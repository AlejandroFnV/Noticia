<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idnoticia'         => 'required',
            'textoComentario'   => 'required|min:5|max:200',
            'fecha'             => 'required|date',
            'correo'            => 'required|email',
        ];
    }
    
    public function messages() {
        $required   = 'El campo :attribute es obligatorio.';
        $min        = 'El campo :attribute no tiene la longitud mínima requerida :min.';
        $max        = 'El campo :attribute supera la longitud máxima requerida :max.';
        $date       = 'El campo :attribute no es de tipo fecha.';
        $email      = 'El campo :attribute no es un correo.';
        return [
            'idnoticia,required' => $required,
            
            'textoComentario.required' => $required,
            'textoComentario.min' => $min,
            'textoComentario.max' => $max,
            
            'fecha.required' => $required,
            'fecha.date' => $date,
            
            'correo.required' => $required,
            'correo.email' => $email,
        ];
    }
    
    public function attributes() {
        return [
            'idnoticia'         => 'noticia',
            'textoComentario'   => 'contenido del comentario',        
            'fecha'             => 'fecha de publicación del comentario',
            'correo'            => 'correo',  
              
        ];
    }
}