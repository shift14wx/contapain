<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Rubros';

    /**
     * Run the migrations.
     * @table Rubros
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_rubro');
            $table->string('titulo');
            $table->tinyInteger('debe')->nullable()->comment('Este campo es necesario para satisfacer la necesidad de saber si en la tabla de registros se encuentra el ID de uno de sub rubros, puede disminuir o BAJAR
');
            $table->tinyInteger('haber')->nullable()->comment('Este campo es necesario para satisfacer la necesidad de saber si en la tabla de registros se encuentra el ID de uno de sub rubros, puede disminuir o BAJAR');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
