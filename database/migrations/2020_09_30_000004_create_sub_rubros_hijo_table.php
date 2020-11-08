<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubRubrosHijoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sub_rubros_hijo';

    /**
     * Run the migrations.
     * @table sub_rubros_hijo
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_sub_rubro_hijo');
            $table->string('titulo', 255)->nullable();
            $table->integer('id_sub_rubro_padre');

            $table->index(["id_sub_rubro_padre"], 'fk_sub_rubro_hijo_sub_rubro1_idx');


            $table->foreign('id_sub_rubro_padre', 'fk_sub_rubro_hijo_sub_rubro1_idx')
                ->references('id_sub_rubro_padre')->on('sub_rubros_padre')
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
