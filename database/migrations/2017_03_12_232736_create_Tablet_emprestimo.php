<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabletEmprestimo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->float('valor', 2,2);
            $table->float('taxa', 2,2);
            $table->float('saldo', 2,2);
            $table->date('dt_pg');
            $table->float('vl_juros_mes', 2,2);
            $table->float('vl_juros_dia', 2,2);
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
        //
    }
}
