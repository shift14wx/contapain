<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "titulo" => $this->faker->firstNameMale,
            "id_sub_rubro_hijo" => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
