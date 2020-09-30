<?php

namespace Database\Seeders;

use App\Models\cartoon;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class CartoonSeeder extends Seeder
{
    private Faker $faker;

    function __construct( Faker $faker ){
        $this->faker = $faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        cartoon::factory()->times(3)->create([
            "name" => $this->faker->firstNameMale,
        ]);
    }
}
