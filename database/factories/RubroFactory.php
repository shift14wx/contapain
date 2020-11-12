<?php

namespace Database\Factories;

use App\Models\Rubro;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class RubroFactory extends Factory
{

    private Faker $_faker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rubro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "titulo" => $this->faker->firstNameMale,
            "debe" =>  $this->faker->randomElement([false,true]),
            "haber" => $this->faker->randomElement([true,false]),
        ];
    }
}
