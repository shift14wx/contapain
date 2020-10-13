<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsientoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Asiento';

    /**
     * Run the migrations.
     * @table Asiento
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_asiento');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_cerrado')->nullable();
            $table->string('concepto_general')->nullable();
            $table->decimal('saldo')->nullable();


            $table->integer('id_user');

            $table->index(["id_user"], 'fk_asiento_usuario_idx');

            $table->foreign('id_user', 'fk_asiento_usuario_idx')
                ->references('id')->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            

            $table->integer('id_company');

            $table->index(["id_company"], 'fk_asiento_company_idx');

            $table->foreign('id_company', 'fk_asiento_company_idx')
            ->references('id_company')->on('companies')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

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
