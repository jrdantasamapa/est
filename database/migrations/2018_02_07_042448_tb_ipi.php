<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbIpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tb_ipi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cst', 50);
            $table->string('descricao', 200);
            $table->string('alicota');
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
        Schema::drop('tb_ipi');
    }
}
