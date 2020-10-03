<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\SubRubrosHijo;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubRubrosHijoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubRubrosHijo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "titulo" => $this->faker->firstNameMale,
            "id_sub_rubro_padre" => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
