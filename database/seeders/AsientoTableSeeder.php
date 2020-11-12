<?php

namespace Database\Seeders;

use App\Models\Asiento;
use Illuminate\Database\Seeder;

class AsientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asiento::factory(10)->create();
    }
}
