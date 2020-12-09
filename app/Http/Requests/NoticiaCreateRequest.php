<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaCreateRequest extends FormRequest
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
            'titulo'        => 'required|min:5|max:60',
            'textoNoticia'  => 'required|min:10|max:200',
            'autor'         => 'required|min:2|max:30',
            'fecha'         => 'required|date',
        ];
    }
    
    public function messages() {
        $required   = 'El campo :attribute es obligatorio.';
        $min        = 'El campo :attribute no tiene la longitud mínima requerida :min.';
        $max        = 'El campo :attribute supera la longitud máxima requerida :max.';
        $date       = 'El campo :attribute no es de tipo fecha.';
        return [
            'titulo.required' => $required,
            'titulo.min' => $min,
            'titulo.max' => $max,
            
            'textoNoticia.required' => $required,
            'textoNoticia.min' => $min,
            'textoNoticia.max' => $max,
            
            'autor.required' => $required,
            'autor.min' => $min,
            'autor.max' => $max,
            
            'fecha.required' => $required,
            'fecha.date' => $date,
        ];
    }
    
    public function attributes() {
        return [
            'titulo'        => 'titulo de la noticia',        
            'textoNoticia'  => 'contenido de la noticia',  
            'autor'         => 'autor de la noticia',  
            'fecha'         => 'fecha de publicación de la noticia',  
        ];
    }
}
