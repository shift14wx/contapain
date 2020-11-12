<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriasPadreTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sub_categorias_padre';

    /**
     * Run the migrations.
     * @table sub_categorias_padre
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_categoria');
            $table->increments('is_sub_categoria_padre');
            $table->string('titulo', 255)->nullable();

            $table->index(["id_categoria"], 'fk_sub_categorias_sub_rubro_hijo_categorias1_idx');


            $table->foreign('id_categoria', 'fk_sub_categorias_sub_rubro_hijo_categorias1_idx')
                ->references('id_categorias')->on('categorias')
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
