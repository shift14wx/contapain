<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'registro';

    /**
     * Run the migrations.
     * @table registro
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_registro');
            $table->integer('id_detalle_concepto')->nullable()->comment('este puede ser cualquier sub rubro del BC de CATALOGO DE CUENTAS');
            $table->decimal('debe')->nullable();
            $table->decimal('haber')->nullable();
            $table->string('concepto_detallado', 255)->nullable();
            $table->integer('id_rubro');
            $table->integer('id_asiento');

            $table->index(["id_rubro"], 'fk_registro_Rubros1_idx');

            $table->index(["id_asiento"], 'fk_registro_Asiento1_idx');


            $table->foreign('id_rubro', 'fk_registro_Rubros1_idx')
                ->references('id_rubro')->on('Rubros')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('id_asiento', 'fk_registro_Asiento1_idx')
                ->references('id_asiento')->on('Asiento')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->unsignedInteger("id_clasificacion")->nullable();
            $table->foreign("id_clasificacion")->on("clasificacions")->references("id");

            $table->timestamps();
            $table->softDeletes();

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
