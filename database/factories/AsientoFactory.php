<?php

namespace Database\Factories;

use App\Models\Asiento;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "fecha_inicio" => $this->faker->dateTimeBetween("2020-09-31","2020-10-30"),
            "fecha_cerrado" => $this->faker->dateTimeBetween("2020-09-31","2020-10-30"),
            "concepto_general" => "solo un copcepto bien malo",
            "saldo" => 10.02,
            "id_user" => $this->faker->numberBetween($min = 1, $max = 3)
        ];
    }
}
