<?php

namespace Database\Factories;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Noticia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->word() . $this->faker->word(),// regexify('[A-Z]{4}') . ' ' . $this->faker->regexify('[A-Z]{6}'),//Str::random(6) . ' ' . Str::random(9),//$this->faker->unique()->word(),
            'textoNoticia' => $this->faker->text(),
            'autor' => $this->faker->name,
            'fecha' => $this->faker->date, //regexify('[0-31]{2}\-[0-12]{2}\-[2018-2020]{4}'),
        ];
    }
}
