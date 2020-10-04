<?php

namespace Database\Factories;

use App\Models\registro;
use Illuminate\Database\Eloquent\Factories\Factory;

class registroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = registro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'id_detalle_concepto' => $this->faker->numberBetween($min=1,$max=3),
        'debe' => 100,
        'haber' => 200,
        'concepto_detallado' => $this->faker->word,
        'id_rubro' => $this->faker->numberBetween($min=1,$max=3),
        'id_asiento' => 11,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
