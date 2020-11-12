<?php

namespace Database\Seeders;

use App\Models\registro;
use Illuminate\Database\Seeder;

class RegitrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        registro::factory( 10 )->create();
    }
}
