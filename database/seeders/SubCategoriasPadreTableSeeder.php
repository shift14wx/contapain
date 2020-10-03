<?php

namespace Database\Seeders;

use App\Models\SubCategoriasPadre;
use Illuminate\Database\Seeder;

class SubCategoriasPadreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategoriasPadre::factory(3)->create();
    }
}
