<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'categorias';

    /**
     * Run the migrations.
     * @table categorias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_sub_rubro_hijo');
            $table->increments('id_categorias');
            $table->string('titulo', 255)->nullable();

            $table->index(["id_sub_rubro_hijo"], 'fk_sub_rubro_hijo_categorias_sub_rubro_hijo1_idx');


            $table->foreign('id_sub_rubro_hijo', 'fk_sub_rubro_hijo_categorias_sub_rubro_hijo1_idx')
                ->references('id_sub_rubro_hijo')->on('sub_rubros_hijo')
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
