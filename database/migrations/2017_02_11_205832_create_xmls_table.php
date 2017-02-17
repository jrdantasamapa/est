<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXmlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xmls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('versao');
            $table->string('infNFe');
            $table->string('cUF');
            $table->string('cNF');
            $table->string('natOp');
            $table->string('indPag');
            $table->string('mod');
            $table->string('serie');
            $table->string('nNF');
            $table->string('dhEmi');
            $table->string('dhSaiEnt');
            $table->string('tpNF');
            $table->string('idDest');
            $table->string('cMunFG');
            $table->string('tpImp');
            $table->string('tpEmis');
            $table->string('cDV');
            $table->string('tpAmb');
            $table->string('finNFe');
            $table->string('indFinal');
            $table->string('indPres');
            $table->string('procEmi');
            $table->string('verProc');
            $table->timestamps();
        });

        Schema::create('emitentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CNPJ');
            $table->string('xNome');
            $table->string('xLgr');
            $table->string('nro');
            $table->string('xBairro');
            $table->string('cMun');
            $table->string('xMun');
            $table->string('UF');
            $table->string('CEP');
            $table->string('cPais');
            $table->string('xPais');
            $table->string('IE');
            $table->string('CRT');
            $table->timestamps();
        });

        Schema::create('destinatarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CNPJ');
            $table->string('xNome');
            $table->string('xLgr');
            $table->string('nro');
            $table->string('xCpl');
            $table->string('xBairro');
            $table->string('cMun');
            $table->string('xMun');
            $table->string('UF');
            $table->string('CEP');
            $table->string('cPais');
            $table->string('xPais');
            $table->string('indIEDest');
            $table->string('IE');
            $table->timestamps();
        });

        Schema::create('itens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nItem');
            $table->string('cProd');
            $table->string('xProd');
            $table->string('NCM');
            $table->string('CFOP');
            $table->string('uCom');
            $table->string('qCom');
            $table->string('vUnCom');
            $table->string('vProd');
            $table->string('uTrib');
            $table->string('qTrib');
            $table->string('vUnTrib');
            $table->string('indTot');
            $table->string('ICMS_ICMS40_orig');
            $table->string('ICMS_ICMS40_CST');
            $table->string('IPI_cEnq');
            $table->string('IPI_IPINT_CST');
            $table->string('PIS_PISOutr_CST');
            $table->string('PIS_PISOutr_vBC');
            $table->string('PIS_PISOutr_pPIS');
            $table->string('PIS_PISOutr_vPIS');
            $table->string('COFINS_COFINSOutr_CST');
            $table->string('COFINS_COFINSOutr_vBC');
            $table->string('COFINS_COFINSOutr_pCOFINS');
            $table->string('COFINS_COFINSOutr_vCOFINS');
            $table->timestamps();
        });

        Schema::create('totais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vBC');
            $table->string('vICMS');
            $table->string('vICMSDeson');
            $table->string('vBCST');
            $table->string('vST');
            $table->string('vProd');
            $table->string('vFrete');
            $table->string('vSeg');
            $table->string('vDesc');
            $table->string('vII');
            $table->string('vIPI');
            $table->string('vPIS');
            $table->string('vCOFINS');
            $table->string('vOutro');
            $table->string('vNF');
            $table->string('vTotTrib');
            $table->timestamps();
        });

        Schema::create('outros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modFrete');
            $table->string('infCpl');
            $table->string('Signature');
            $table->string('CanonicalizationMethod');
            $table->string('SignatureMethod');
            $table->string('Reference');
            $table->string('Transforms');
            $table->string('Transform');
            $table->string('DigestMethod');
            $table->string('DigestValue');
            $table->binary('SignatureValue');
            $table->binary('X509Certificate');
            $table->string('protNFe');
            $table->string('tpAmb');
            $table->string('verAplic');
            $table->string('chNFe');
            $table->string('dhRecbto');
            $table->string('nProt');
            $table->string('digVal');
            $table->string('cStat');
            $table->string('xMotivo');
            $table->timestamps();
        });

        Schema::create('xml_relacionamento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('xml_id')->unsigned();
            $table->integer('emitente_id')->unsigned();
            $table->integer('destinatario_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('total_id')->unsigned();
            $table->integer('outro_id')->unsigned();

            $table->foreign('xml_id')
            ->references('id')
            ->on('xmls')
            ->onDelete('cascade');

            $table->foreign('emitente_id')
            ->references('id')
            ->on('emitentes')
            ->onDelete('cascade');

            $table->foreign('destinatario_id')
            ->references('id')
            ->on('destinatarios')
            ->onDelete('cascade');

            $table->foreign('item_id')
            ->references('id')
            ->on('itens')
            ->onDelete('cascade');

            $table->foreign('total_id')
            ->references('id')
            ->on('totais')
            ->onDelete('cascade');

            $table->foreign('outro_id')
            ->references('id')
            ->on('outros')
            ->onDelete('cascade');

        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('xml_relacionamento');
        Schema::drop('emitentes');
        Schema::drop('destinatarios');
        Schema::drop('itens');
        Schema::drop('totais');
        Schema::drop('outros');
        Schema::drop('xmls');
    }
}
