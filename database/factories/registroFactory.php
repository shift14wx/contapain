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
            'id_detalle_concepto' => $this->faker->randomDigitNotNull,
        'debe' => $this->faker->word,
        'haber' => $this->faker->word,
        'concepto_detallado' => $this->faker->word,
        'id_rubro' => $this->faker->randomDigitNotNull,
        'id_asiento' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
