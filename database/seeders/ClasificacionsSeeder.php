<?php

namespace Database\Seeders;

use App\Models\Clasificacion;
use Illuminate\Database\Seeder;

class ClasificacionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clasificacion::factory()->create([
            "titulo" => "activo corriente"
        ]);
        Clasificacion::factory()->create([
            "titulo" => "activo no corriente"
        ]);
        Clasificacion::factory()->create([
            "titulo" => "pasivo corriente"
        ]);
        Clasificacion::factory()->create([
            "titulo" => "pasivo no corriente"
        ]);
        Clasificacion::factory()->create([
            "titulo" => "capital contribuido"
        ]);
       Clasificacion::factory()->create([
            "titulo" => "capital ganado"
        ]);
    }
}
