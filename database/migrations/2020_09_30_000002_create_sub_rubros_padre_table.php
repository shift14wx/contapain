<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubRubrosPadreTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sub_rubros_padre';

    /**
     * Run the migrations.
     * @table sub_rubros_padre
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_sub_rubro_padre');
            $table->string('titulo', 255);
            $table->integer('id_rubro');

            $table->index(["id_rubro"], 'fk_sub_rubro_Rubro_idx');


            $table->foreign('id_rubro', 'fk_sub_rubro_Rubro_idx')
                ->references('id_rubro')->on('Rubros')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
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
