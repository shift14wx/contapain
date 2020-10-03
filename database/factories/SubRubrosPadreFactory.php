<?php

namespace Database\Factories;

use App\Models\SubRubrosPadre;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubRubrosPadreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubRubrosPadre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "titulo" => $this->faker->firstNameMale,
            "id_rubro" => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
