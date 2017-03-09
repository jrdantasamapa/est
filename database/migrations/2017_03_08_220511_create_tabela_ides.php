<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelaIdes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ides', function (Blueprint $table) {
            $table->increments('id');
            $table->float('versao', 2,2);
            $table->integer('cUF', 2);
            $table->integer('cNF', 8);
            $table->string('natOp', 60);
            $table->integer('indPag', 1);
            $table->string('mod', 2);
            $table->integer('serie', 3);
            $table->integer('nNF', 9);
            $table->dateTimeTz('dhEmi');
            $table->string('fusoHorario', 6);
            $table->dateTimeTz('dhSaiEnt');
            $table->integer('tpNf',1);
            $table->integer('idDest', 1);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
            $table->integer('cMunFg' ,7);
            $table->integer('tpImp', 1);
            $table->integer(' tpEmis', 1);
            $table->string('cDV', 1);
            $table->integer('finNFe', 1);
            $table->integer('indFinal' ,1);
            $table->integer('indPres', 1);
            $table->dateTimeTz('dhCont');
            $table->string('xJust', 100);
            $table->text('EmailArquivos', 1000);
            $table->integer('tpAmb', 1);
            $table->string('procEmi');
            $table->string('verProc');
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
        Schema::drop('ides');
    }
}
