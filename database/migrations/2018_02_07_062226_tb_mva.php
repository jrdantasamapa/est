<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbMva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tb_mva', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cest', 20);
            $table->string('ncm', 20);
            $table->string('descricao', 200);
            $table->string('mva_op_interna');
            $table->string('alicota_interna');
            $table->string('alicota_7');
            $table->string('alicota_12');
            $table->string('alicota_4');
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
        Schema::drop('tb_mvas');
    }
}