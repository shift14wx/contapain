<?php

namespace Database\Seeders;

use App\Models\SubRubrosPadre;
use Illuminate\Database\Seeder;

class SubRubrosPadreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubRubrosPadre::factory(3)->create();
    }
}
