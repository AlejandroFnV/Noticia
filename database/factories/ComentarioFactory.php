<?php

namespace Database\Factories;

use App\Models\Noticia;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comentario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $total = Noticia::all()->count();
        return [
            'idnoticia' => $this->faker->numberBetween(45, 65),
            'textoComentario' => $this->faker->text(),
            'fecha' => date("Y-m-d"),
            'correo' => $this->faker->unique()->safeEmail,
        ];
    }
}