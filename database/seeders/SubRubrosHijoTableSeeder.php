<?php

namespace Database\Seeders;

use App\Models\SubRubrosHijo;
use Illuminate\Database\Seeder;

class SubRubrosHijoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubRubrosHijo::factory(3)->create();
    }
}
