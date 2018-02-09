<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Requests;
use App\Xml;
use App\Iten;
use App\Destinatario;
use App\Emitente;
use App\PisCofins;
use Input;
use Fpdf;
use App\Ncm;
use App\TbPisCofins;
use App\TbIpi;
use App\TbMva;
use App\TbIcms;
use Rafwell\Grid\Grid;



class XmlController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$xmls = Xml::paginate(10);
    	$url = 'lista';
        return view('xml.index', compact('xmls', 'url'));
    }

    public function create(){
        $url = 'create';
        return view('xml.index', compact('url'));
    }

    public function inserte(Request $request){
		$input = Input::file('xml');
		$arquivo = $_FILES['xml']['name'];
		$extensao = substr($arquivo, -3);
		if(empty($input)){
			notify()->flash('Selecio um arquivo valido',
            'error',
            ['timer'=> 3000,
            'text'=> ''
            ]);
           return back()->withInput();
		}elseif($extensao == 'zip'){
			$nome = "xml.zip";
			$this->upload($input, $nome, $xml);
			return Redirect('xml');
		}elseif($extensao == 'xml'){
			$nome = "xml.xml";
			$this->upload($input, $nome);
			$xml = simplexml_load_file(public_path($nome));
			$this->salvaxml($xml);
			return Redirect('xml');
		}else{
			notify()->flash('Somente Arquivo zip ou xml',
            'error',
            ['timer'=> 3000,
            'text'=> ''
            ]);
           return back()->withInput();
		}
	//	$this->apagaarquivo($input, $nome);
	//	
    }

    public function upload($input, $nome){
    	if($input->move(public_path(), $nome)){
       		
    	}
    }

    public function apagaarquivo($input, $nome){
    	$arquivo = public_path($nome);
    	if(unlink($arquivo)){
    	}
    }

    public function salvaxml($xml)
    {
       		$versao = $xml->NFe->infNFe['versao'];
    		$infNFe = $xml->NFe->infNFe['Id'];
    		$ide = $xml->NFe->infNFe->ide;
    		$det = $xml->NFe->infNFe->det;
    		$dest = $xml->NFe->infNFe->dest->enderDest;
    		$CNPJ = $xml->NFe->infNFe->dest->CNPJ;
    		$xNome = $xml->NFe->infNFe->dest->xNome;
    		$indIEDest = $xml->NFe->infNFe->dest->indIEDest;
    		$IE = $xml->NFe->infNFe->dest->IE;
    		$emit = $xml->NFe->infNFe->emit->enderEmit;
    		$eCNPJ = $xml->NFe->infNFe->emit->CNPJ;
    		$exNome = $xml->NFe->infNFe->emit->xNome;
    		$CRT = $xml->NFe->infNFe->emit->CRT;
    		$eIE = $xml->NFe->infNFe->emit->IE;

			$dados = array('versao', $versao, 'infNFe', $infNFe);
			$dados = compact($dados);
			$dadosdest = array('CNPJ', $CNPJ, 'xNome', $xNome, 'indIEDest', $indIEDest, 'IE', $IE);
			$dadosdest = compact($dadosdest);
			$dadosemit = array('CNPJ', $eCNPJ, 'xNome', $exNome, 'CRT', $CRT, 'IE', $eIE);
			$dadosemit = compact($dadosemit);

			$ide = json_encode($ide);
			$ide = json_decode($ide,TRUE);
			$det = json_encode($det);
			$det = json_decode($det,TRUE);
			$dest = json_encode($dest);
			$dest = json_decode($dest,TRUE);
			$emit = json_encode($emit);
			$emit = json_decode($emit,TRUE);
			$dbxmls = array_merge($dados, $ide);
			$dbdestinos = array_merge($dadosdest, $dest);
			$dbemitentes = array_merge($dadosemit, $emit);
	
			$consultaxml = Xml::where('infNFe', $infNFe)->get();
			$x = sizeof($consultaxml);
				if($x == 0){
					if($xmls = Xml::create($dbxmls)){
						$idxml = $xmls->id;
						$consultadest = Destinatario::where('CNPJ', $CNPJ)->get();
						//$iddestino = $consultadest['id'];
						$d = sizeof($consultadest);
						if($d == 0){
							$destinos = Destinatario::create($dbdestinos);
							$iddestino = $destinos->id;
						}
						$consultaemit = Emitente::where('CNPJ', $eCNPJ)->get();
						//$idemitente = $consultaemit->id;
						$e = sizeof($consultaemit);
						if($e == 0){
							$emitentes = Emitente::create($dbemitentes);
							$idemitente = $emitentes->id;
						}
						$this->inserirItens($xml, $idxml);
   					}

						notify()->flash("Xml Importado com sucesso",
            			'success',
            			['timer'=> 3000,
            			'text'=> 'Arquivo Importado'
            			]);
					
				}else{
					notify()->flash('Xml ja Cadastrado',
            		'error',
            		['timer'=> 3000,
            		'text'=> ''
            		]);
				}
   }

    public function abrirzip(){
    	
    }

    public function inserirItens($xml, $idxml)
    {
		$contaitem = count($xml->NFe->infNFe->det);
		$det = $contaitem;

		for ($i = 0; $i < $det; $i++) {
		//Outros dados
			$idxml = $idxml;
			$nItem = $xml->NFe->infNFe->det[$i];
		// Dados dos Produtos
			$produto = $nItem->prod;
			$cProd = $produto->cProd;
			$xProd = $produto->xProd;
			$NCM = $produto->NCM;
			$CFOP = $produto->CFOP;
			$CFOP = $produto->CFOP;
			$qCom = $produto->qCom;
			$vUnCom = $produto->vUnCom;
			$vProd = $produto->vProd;
			$uTrib = $produto->uTrib;
			$qTrib = $produto->qTrib;
			$vUnTrib = $produto->vUnTrib;
			$indTot = $produto->indTot;

		// Dados do Imposto
			$imposto = $nItem->imposto;
			//ICMS
			$ICMS_ICMS40_orig = $imposto->ICMS->ICMS40->orig;
			$ICMS_ICMS40_CST = $imposto->ICMS->ICMS40->CST;
			$ICMS_ICMS40_vICMS = $imposto->ICMS->ICMS40->vICMS;
			$ICMS_ICMS40_motDesICMS = $imposto->ICMS->ICMS40->motDesICMS;
			//IPI
			$IPI_cEnq = $imposto->IPI->cEnq;
			$IPI_IPITrib_CST = $imposto->IPI->IPITrib->CST;
			$IPI_IPITrib_vBC = $imposto->IPI->IPITrib->vBC;
			$IPI_IPITrib_pIPI = $imposto->IPI->IPITrib->pIPI;
			$IPI_IPITrib_vIPI = $imposto->IPI->IPITrib->vIPI;
			//PIS
			dd($xml);
			$PIS_PISNT_CST = $xml->NFe->infNFe->det[$i]->imposto->PIS->PISNT->CST;
			$PIS_COFINS_COFINSNT_CST = $xml->NFe->infNFe->det[$i]->imposto->PIS->COFINS->COFINSNT->CST;
			$PIS_PISOutr_CST = $xml->NFe->infNFe->det[$i]->imposto->PIS->PISOutr->CST;
			$PIS_PISOutr_vBC = $xml->NFe->infNFe->det[$i]->imposto->PIS->PISOutr->vBC;
			$PIS_PISOutr_pPIS = $xml->NFe->infNFe->det[$i]->imposto->PIS->PISOutr->pPIS;
			$PIS_PISOutr_vPIS = $xml->NFe->infNFe->det[$i]->imposto->PIS->PISOutr->vPIS;
			$COFINS_COFINSOutr_CST = $xml->NFe->infNFe->det[$i]->imposto->COFINS->COFINSOutrg->CST;
			$COFINS_COFINSOutr_vBC = $xml->NFe->infNFe->det[$i]->imposto->COFINS->COFINSOutr->vBC;
			$COFINS_COFINSOutr_pCOFINS = $xml->NFe->infNFe->det[$i]->imposto->COFINS->COFINSOutr->pCOFINS;
			//Montando o Array
			$dadositem = array(
				'id_xml', $idxml,
				'nItem', $i,
				'cProd', $cProd, 
				'xProd', $xProd,
				'NCM', $NCM,
				'CFOP', $CFOP,
				'CFOP', $CFOP,
				'qCom', $qCom,
				'vUnCom', $vUnCom,
				'vProd', $vProd,
				'uTrib', $uTrib,
				'qTrib', $qTrib,
				'vUnTrib', $vUnTrib,
				'indTot', $indTot,
				'ICMS_ICMS40_orig',	$ICMS_ICMS40_orig,
				'ICMS_ICMS40_CST', $ICMS_ICMS40_CST,
				'ICMS_ICMS40_vICMS', $ICMS_ICMS40_vICMS,
				'ICMS_ICMS40_motDesICMS', $ICMS_ICMS40_motDesICMS,
				'IPI_cEnq', $IPI_cEnq,
				'IPI_IPITrib_CST', $IPI_IPITrib_CST,
				'IPI_IPITrib_vBC', $IPI_IPITrib_vBC,
				'IPI_IPITrib_pIPI', $IPI_IPITrib_pIPI,
				'IPI_IPITrib_vIPI', $IPI_IPITrib_vIPI,
				'PIS_PISNT_CST', $PIS_PISNT_CST,
				'PIS_COFINS_COFINSNT_CST', $PIS_COFINS_COFINSNT_CST,
				'PIS_PISOutr_CST', $PIS_PISOutr_CST,
				'PIS_PISOutr_vBC', $PIS_PISOutr_vBC,
				'PIS_PISOutr_pPIS', $PIS_PISOutr_pPIS,
				'PIS_PISOutr_vPIS', $PIS_PISOutr_vPIS,
				'COFINS_COFINSOutr_CST', $COFINS_COFINSOutr_CST,
				'COFINS_COFINSOutr_vBC', $COFINS_COFINSOutr_vBC,
				'COFINS_COFINSOutr_pCOFINS', $COFINS_COFINSOutr_pCOFINS);
			$dadositem = compact($dadositem);
			$dbitens = array_merge($dadositem);
			$itens = Iten::create($dbitens);

		}
	}

	public function XmltoArray()
	{
		$xml = simplexml_load_file(public_path('xml.xml'));
		$infNFe = $xml->NFe->infNFe;
		dd($xml);
		
	}

	public function consultaxml(){
		$url = 'consultaxml';
        return view('xml.index', compact('url'));
	}

	public function consultapis(){
		$url = 'consultapis';
        return view('xml.index', compact('url'));
	}

	public function calcularpis(Request $request){
		$input = Input::file('xml');
		$nome = "calculopis.xml";
		$this->upload($input, $nome);

		//MANIPULANDO O XML
		$xml = simplexml_load_file(public_path($nome));
		//Variaveis do XML
		$item = count($xml->NFe->infNFe->det);
		//Conta o numero de Ites do XML
		$tproduto = $xml -> NFe -> infNFe -> total -> ICMSTot -> vProd;
		//Valor total dos Prodtos do XML
		$tnfe = $xml -> NFe -> infNFe -> total -> ICMSTot -> vNF;
		// Valor Total da NFe
		$tICMS = $xml -> NFe -> infNFe -> total -> ICMSTot -> vICMS;
		// Valor total do ICMS da NFe
		$emitente = $xml -> NFe -> infNFe -> emit -> xNome;
		//Razão social do Emitente
		$fantasia = $xml -> NFe -> infNFe -> emit -> xFant;
		// Nome de Fantasia do Emitente
		$endereco = $xml -> NFe -> infNFe -> emit -> enderEmit -> xMun;
		// Minicipio do Enitente
		$destino = $xml -> NFe -> infNFe -> dest -> xNome;
		// Rasão social do Destino
		$bairrodestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xBairro;
		$logdestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xLgr;
		$enddest = $xml -> NFe -> infNFe -> dest -> enderDest -> xMun;
		// Municipio do Destino
		$chave = $xml -> protNFe -> infProt -> chNFe;
		// Chave de acesso do XML
		$nnfe = $xml -> NFe -> infNFe -> ide -> nNF;
		// Numero da NFe do XML
		$det = $item;
		$itens = 0;
		$tst = 0;
		$i = 0;
		$tribut = 0;
		$monof = 0;
		$tdebICMS = 0;
		$tcreICMS = 0;
		$tpis = 0;
		$tcofins = 0;
		// Versão do XML
		$versao = $xml -> NFe -> infNFe['versao'];
//verifica da de Emissão
		if ($versao >= 3) {
					$origem = $xml -> NFe -> infNFe -> det[$i] -> imposto -> ICMS -> ICMS00 -> orig;
					$demit = $xml -> NFe -> infNFe ->ide -> dhEmi;
				} else {
					$origem = $xml -> NFe -> infNFe -> det[$i] -> imposto -> ICMS -> ICMS40 -> orig;
					$demit = $xml -> NFe -> infNFe ->ide -> dEmi;
				}

//TÍTULO DO RELATÓRIO
$titulo = "RELATORIO DE VALORES PIS/COFINS";
//LOGO QUE SERÁ COLOCADO NO RELATÓRIO
$imagem = "logost.jpg";
//NUMERO DE RESULTADOS POR PÁGINA
$por_pagina = 10;
//TIPO DO PDF GERADO
//F-> SALVA NO ENDEREÇO ESPECIFICADO NA VAR END_FINAL
$tipo_pdf = "D";
//CALCULA QUANTAS PÁGINAS VÃO SER NECESSÁRIAS
$registros = number_format(($item), 2, ',', '.');

$paginas = ceil($item / $por_pagina);
//PREPARA PARA GERAR O PDF

//INICIALIZA AS VARIÁVEIS
$linha_atual = 0;
$inicio = 0;
//PÁGINAS
/*for ($x = 1; $x <= $paginas; $x++) {
	//VERIFICA
	$inicio = $linha_atual;
	$fim = $linha_atual + $por_pagina;
	if ($fim > $paginas)
		$fim = $paginas;*/
	//iNICIO DO pdf
	Fpdf::Open();
	Fpdf::AddPage();
	Fpdf::SetFont("times", "B", 10);
	//logomarca do Relatorio
	Fpdf::SetFillColor(232, 232, 232);
	Fpdf::SetTextColor(0, 0, 0);
	Fpdf::Image('logost.png', 10, 10, -300);
	Fpdf::Ln(5);
	// Move para a direita
	Fpdf::Cell(50);
	// Titulo dentro de uma caixa
	Fpdf::Cell(85, 10, $titulo, 0, 0, 'C');
	// Quebra de linha
	Fpdf::Ln(10);
	//Cabeçalho do relatorio
	Fpdf::SetFont('times', '', 8);
	Fpdf::Line(10, 25, 200, 25);
	Fpdf::Cell(100, 6, 'Cheve de Acesso: ' . $chave, 0, 0, 'L');
	Fpdf::Cell(30, 6, 'N. NFe: ' . $nnfe, 0, 0, 'L');
	Fpdf::Cell(60, 6, 'Data de Emissão: '.$demit, 0, 0, 'L');
	Fpdf::Ln(4);
	Fpdf::Cell(190, 6, 'Fornecedor: ' . $emitente . '   -   Fantasia.:' . $fantasia . '   -   End.:' . $endereco, 0, 0, 'L');
	Fpdf::Ln(4);
	Fpdf::Cell(190, 6, 'Destinatario: ' . $destino . '  -   End.:'.$logdestino.' - ' . $bairrodestino . '-' . $enddest, 0, 0, 'L');
	Fpdf::Line(10, 38, 200, 38);
	Fpdf::Ln(4);



Fpdf::SetFont('times', 'B', 8);
		Fpdf::Cell(90, 6, 'PRODUTOS', 0, 0, 'L');
		Fpdf::Cell(20, 6, 'NCM', 0, 0, 'L');
		Fpdf::Cell(15, 6, 'QTD', 0, 0, 'L');
		Fpdf::Cell(15, 6, 'V. UNT', 0, 0, 'L');
		Fpdf::Cell(20, 6, 'V. TOTAL', 0, 0, 'L');
		Fpdf::Cell(15, 6, 'PIS', 0, 0, 'L');
		Fpdf::Cell(15, 6, 'COFINS', 0, 0, 'L');
		Fpdf::Ln(3);

	//EXIBE OS REGISTROS
	for ($i = 0; $i < $det; $i++) {
		
		$nome = $xml -> NFe -> infNFe -> det[$i] -> prod -> xProd;
		$qtd = $xml -> NFe -> infNFe -> det[$i] -> prod -> qCom;
		$unitario = $xml -> NFe -> infNFe -> det[$i] -> prod -> vUnCom;
		$codigo = $xml -> NFe -> infNFe -> det[$i] -> prod -> cProd;
		$vproduto = $xml -> NFe -> infNFe -> det[$i] -> prod -> vProd;
		$ncm = $xml -> NFe -> infNFe -> det[$i] -> prod -> NCM;
		$qtrib = $xml -> NFe -> infNFe -> det[$i] -> prod -> qTrib;
		$nnfe = $xml -> NFe -> infNFe -> ide -> nNF;
		$vdesconto = '0,00';
		$vliquido = $vproduto;
		$newvliquido = number_format(floatval($vliquido), 3, ',', '.');
		$mva = Ncm::where('NCM', $ncm)->get();

		$dados = $mva;
		foreach ($mva as $mvas) {
			$oppis = $mvas->piscofins;
		
		if($oppis == 'Sim'){
			$pis = $vproduto * 0.0065;
			$cofins = $vproduto * 0.03;
			$tribut += $vproduto;
		}else {
			$pis = '0';
			$cofins = '0';
			$monof += $vproduto;
		}
		if ($dados > '0') {
			$vmva = $mvas->MVA;
			$subtrib = $mvas->reducao;
			$aliint = $mvas->al_interna;
			if ($subtrib == '0.00') {
				$basered = "$vliquido";
				$cmva = (($vmva / 100) * $basered);
				$basajst = ($basered + $cmva);
				$debICMA = (($aliint / 100)* $basajst);
				
			} else {
				$valorreducao = (($subtrib/100) * $vliquido );
				$basered = $vliquido - $valorreducao;
				$cmva = (($vmva / 100) * $basered);
				$basajst = ($basered + $cmva);
				$debICMA = (($aliint / 100)* $basajst);
			};
			if ($origem == 0 or $origem == 5) {
				$ICMS = ($vproduto * 0.12);
				$aliext = '12,00';
				$creICMS = ($basered * 0.12);
			} else {
				$ICMS = ($vproduto * 0.04);
				$aliext = '4,00';
				$creICMS = ($basered * 0.04);
			};
		} else {
			$vmva = 0;
			$ICMS = '0,00';
			$aliext = '0,00';
			$creICMS = '0,00';
			$basered = '0,00';
			$debICMA = '0,00';
			$subtrib = 0;
			$aliint = 0;
			$basajst = '0,00';
		}
		
		}
		$st = ($debICMA - $creICMS);
		$tst += $st;
		$tdebICMS += $debICMA;
		$tcreICMS += $creICMS;
		$itens = $itens + 1;
		$tpis += $pis;
		$tcofins += $cofins;
		
		$newvproduto = number_format(floatval($vproduto), 3, ',', '.');
		$newdebICMA = number_format($debICMA, 3, ',', '.');
		$newtnfe = number_format(floatval($tnfe), 2, ',', '.');
		$newbasered = number_format($basered, 3, ',', '.');
		$newcreICMS = number_format($creICMS, 3, ',', '.');
		$newbasajst = number_format($basajst, 3, ',', '.');
		$newst = number_format($st, 3, ',', '.');
		$newsubtrib = number_format($subtrib, 2, ',', '.');
		$newaliint = number_format($aliint, 2, ',', '.');
		$newvmva = number_format($vmva, 2, ',', '.');
		$newunitario = number_format(floatval($unitario), 3, ',', '.');
		$newqtd = number_format(floatval($qtd), 3, ',', '.');

			//Layuot dos Regsitor
		
		Fpdf::SetFont('times', '', 8);
		Fpdf::Cell(90, 6, $codigo .' - '. $nome, 0, 0, 'L');
		Fpdf::Cell(20, 6, $ncm, 0, 0, 'L');
		Fpdf::Cell(15, 6, $newqtd, 0, 0, 'L');
		Fpdf::Cell(15, 6, $newunitario, 0, 0, 'L');
		Fpdf::Cell(20, 6, $newvproduto, 0, 0, 'L');
		Fpdf::Cell(15, 6, $pis, 0, 0, 'L');
		Fpdf::Cell(15, 6, $cofins, 0, 0, 'L');
		Fpdf::Ln(5);
		Fpdf::SetFont('times', '', 8);
		$linha_atual++;
		
		
	};
	//Imprime o N de paginas
	//$pdf -> SetFont('times', '', 6);
	//$pdf -> Cell(0, 10, "Pagina $x de $paginas", 0, 0, 'R');
//};
Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		Fpdf::Ln(1);
// Totalizadores
Fpdf::SetFont('times', 'B', 12);
Fpdf::Cell(190, 6, 'RESUMO TOTAIS', 0, 0, 'C');
Fpdf::Ln(5);
Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
Fpdf::SetFont('times', '', 8);
Fpdf::Cell(20, 6, 'NFe', 0, 0, 'C');
Fpdf::Cell(30, 6, 'Valor Total da NFe', 0, 0, 'C');
Fpdf::Cell(30, 6, 'Valor Total dos Produtos', 0, 0, 'C');
Fpdf::Cell(30, 6, 'Monofásico', 0, 0, 'C');
Fpdf::Cell(30, 6, 'Tributados', 0, 0, 'C');
Fpdf::Cell(25, 6, 'VALOR PIS', 0, 0, 'C');
Fpdf::Cell(25, 6, 'VALOR COFINS', 0, 0, 'C');
Fpdf::Ln(5);
Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
//$pdf -> Ln(1);
Fpdf::SetFont('times', 'B', 12);
Fpdf::Cell(20, 6, $nnfe, 0, 0, 'C');
Fpdf::Cell(30, 6, (number_format(floatval($tnfe), 2, ',', '.')), 0, 0, 'C');
Fpdf::Cell(30, 6, (number_format(floatval($tproduto), 2, ',', '.')), 0, 0, 'C');
Fpdf::Cell(30, 6, (number_format($monof, 2, ',', '.')), 0, 0, 'C');
Fpdf::Cell(30, 6, (number_format($tribut, 2, ',', '.')), 0, 0, 'C');
Fpdf::Cell(30, 6, (number_format(($tpis), 2, ',', '.')), 0, 0, 'C');
Fpdf::Cell(30, 6, (number_format(($tcofins), 2, ',', '.')), 0, 0, 'C');
Fpdf::Output('CalculoPIS.NFe'.$nnfe.'.pdf', 'D');
		exit;
		return Redirect('consultapis');

	}

	public function calcularxml(Request $request){
		$input = Input::file('xml');
		$nome = "calculoxml.xml";

		$this->upload($input, $nome);
		//MANIPULANDO O XML
		$xml = simplexml_load_file(public_path($nome));
		//Variaveis do XML
		$item = count($xml->NFe->infNFe->det);
		//Conta o numero de Ites do XML
		$tproduto = $xml -> NFe -> infNFe -> total -> ICMSTot -> vProd;
		//Valor total dos Prodtos do XML
		$tnfe = $xml -> NFe -> infNFe -> total -> ICMSTot -> vNF;
		// Valor Total da NFe
		$tICMS = $xml -> NFe -> infNFe -> total -> ICMSTot -> vICMS;
		// Valor total do ICMS da NFe
		$emitente = $xml -> NFe -> infNFe -> emit -> xNome;
		//Razão social do Emitente
		$fantasia = $xml -> NFe -> infNFe -> emit -> xFant;
		// Nome de Fantasia do Emitente
		$endereco = $xml -> NFe -> infNFe -> emit -> enderEmit -> xMun;
		// Minicipio do Enitente
		$destino = $xml -> NFe -> infNFe -> dest -> xNome;
		// Rasão social do Destino
		$bairrodestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xBairro;
		$logdestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xLgr;
		$enddest = $xml -> NFe -> infNFe -> dest -> enderDest -> xMun;
		// Municipio do Destino
		$chave = $xml -> protNFe -> infProt -> chNFe;
		// Chave de acesso do XML
		$nnfe = $xml -> NFe -> infNFe -> ide -> nNF;
		// Numero da NFe do XML
		$det = $item;
		$itens = 0;
		$tst = 0;
		$i = 0;
		// Versão do XML
		$versao = $xml -> NFe -> infNFe['versao'];
//verifica da de Emissão
		if ($versao >= 3) {
					$origem = $xml -> NFe -> infNFe -> det[$i] -> imposto -> ICMS -> ICMS00 -> orig;
					$demit = $xml -> NFe -> infNFe ->ide -> dhEmi;
				} else {
					$origem = $xml -> NFe -> infNFe -> det[$i] -> imposto -> ICMS -> ICMS40 -> orig;
					$demit = $xml -> NFe -> infNFe ->ide -> dEmi;
				}

//TÍTULO DO RELATÓRIO
$titulo = "RELATORIO DE VALORES ST POR NCM";
//LOGO QUE SERÁ COLOCADO NO RELATÓRIO
$imagem = "logost.jpg";
//NUMERO DE RESULTADOS POR PÁGINA
$por_pagina = 10;
//TIPO DO PDF GERADO
//F-> SALVA NO ENDEREÇO ESPECIFICADO NA VAR END_FINAL
$tipo_pdf = "D";
//CALCULA QUANTAS PÁGINAS VÃO SER NECESSÁRIAS
$registros = number_format(($item), 2, ',', '.');

$paginas = ceil($item / $por_pagina);
//PREPARA PARA GERAR O PDF

//INICIALIZA AS VARIÁVEIS
$linha_atual = 0;
$inicio = 0;
//PÁGINAS
/*for ($x = 1; $x <= $paginas; $x++) {
	//VERIFICA
	$inicio = $linha_atual;
	$fim = $linha_atual + $por_pagina;
	if ($fim > $paginas)
		$fim = $paginas;*/
	//iNICIO DO pdf
	Fpdf::AliasNbPages();
	Fpdf::AddPage();
	Fpdf::SetFont("times", "B", 10);
	//logomarca do Relatorio
	Fpdf::SetFillColor(232, 232, 232);
	Fpdf::SetTextColor(0, 0, 0);
	Fpdf::Image('logost.png', 10, 10, -150);
	Fpdf::Ln(5);
	// Move para a direita
	Fpdf::Cell(50);
	// Titulo dentro de uma caixa
	Fpdf::Cell(85, 10, $titulo, 0, 0, 'C');
	// Quebra de linha
	Fpdf::Ln(10);
	//Cabeçalho do relatorio
	Fpdf::SetFont('times', '', 8);
	Fpdf::Line(10, 25, 200, 25);
	Fpdf::Cell(100, 6, 'Cheve de Acesso: ' . $chave, 0, 0, 'L');
	Fpdf::Cell(30, 6, 'N. NFe: ' . $nnfe, 0, 0, 'L');
	Fpdf::Cell(60, 6, 'Data de Emissão: '.$demit, 0, 0, 'L');
	Fpdf::Ln(4);
	Fpdf::Cell(190, 6, 'Fornecedor: ' . $emitente . '   -   Fantasia.:' . $fantasia . '   -   End.:' . $endereco, 0, 0, 'L');
	Fpdf::Ln(4);
	Fpdf::Cell(190, 6, 'Destinatario: ' . $destino . '  -   End.:'.$logdestino.' - ' . $bairrodestino . '-' . $enddest, 0, 0, 'L');
	Fpdf::Line(10, 38, 200, 38);
	Fpdf::Ln(4);
		$tdebICMS  = 0;
		$tcreICMS = 0;
	//EXIBE OS REGISTROS
	for ($i = 0; $i < $det; $i++) {
		$suframa = $xml -> NFe -> infNFe -> det[$i] -> imposto -> ICMS -> ICMS40 -> vICMSDeson;
		$nome = $xml -> NFe -> infNFe -> det[$i] -> prod -> xProd;
		$codigo = $xml -> NFe -> infNFe -> det[$i] -> prod -> cProd;
		$vproduto = $xml -> NFe -> infNFe -> det[$i] -> prod -> vProd;
		$ncm = $xml -> NFe -> infNFe -> det[$i] -> prod -> NCM;
		$qtrib = $xml -> NFe -> infNFe -> det[$i] -> prod -> qTrib;
		$nnfe = $xml -> NFe -> infNFe -> ide -> nNF;
		$vdesconto = $suframa;
		$vliquido = $vproduto;
		//$vliquido = str_replace (".", "", $vliquido);
    	//$vdesconto = str_replace (".", "", $vdesconto);
		$newvliquido = $this->formataReais($vliquido, $vdesconto, "-");
	//dd($newvliquido);
		$mva = Ncm::where('NCM', $ncm)->get();
		$dados = $mva;
		
		$subtrib = 0;
		$cmva = 0;
		$vmva = 0;
		$aliint = 0;
		if ($dados > '0') {
			foreach ($dados as $dado) {
				$vmva = $dado->MVA;
				$subtrib = $dado->reducao;
				$aliint = $dado->al_interna;
			}
			if ($subtrib == '0.00') {
				$basered = $vliquido;
				$cmva = (($vmva / 100) * $basered);
				$basajst = ($basered + $cmva);
				$debICMA = (($aliint / 100)* $basajst);
				$creditoICMS = $suframa;
		
			} else {
				$valorreducao = (($subtrib/100) * $vliquido );
				$basered = $vliquido - $valorreducao;
				$cmva = (($vmva / 100) * $basered);
				$basajst = ($basered + $cmva);
				$debICMA = (($aliint / 100)* $basajst);
				$creditoICMS = ($suframa-($suframa * 0.4167));
			}
			if ($origem == 0 or $origem == 5) {
				$ICMS = ($vproduto * 0.12);
				$aliext = '12,00';
				$creditoICMS = ($basered * 0.12);
			} else {
				$ICMS = ($vproduto * 0.04);
				$aliext = '4,00';
				$creditoICMS = ($basered * 0.04);
			}
		} else {
			$vmva = 0;
			$ICMS = '0,00';
			$aliext = '0,00';
			$creditoICMS = '0,00';
			$basered = '0,00';
			$debICMA = '0,00';
			$subtrib = '0';
			$aliint = '0';
			$basajst = '0,00';
		}
		$st = ($debICMA - $creditoICMS);
		$tst += $st;
	
		$tdebICMS += $debICMA;
		$tcreICMS += $creditoICMS;
		$itens = $itens + 1;
		
		$newvproduto = number_format(floatval($vproduto), 3, ',', '.');
		$newdebICMA = number_format($debICMA, 3, ',', '.');
		$newtnfe = number_format(floatval($tnfe), 2, ',', '.');
		$newbasered = $basered;
		$newcreICMS = number_format($creditoICMS, 3, ',', '.');
		$newbasajst = number_format($basajst, 3, ',', '.');
		$newst = number_format($st, 3, ',', '.');
		$newsubtrib = number_format($subtrib, 2, ',', '.');
		$newaliint = number_format($aliint, 2, ',', '.');
		$newvmva = number_format($vmva, 2, ',', '.');
			
	if ($newvmva != 0) {
	
			//Layuot dos Regsitor
		Fpdf::SetFont('times', 'B', 8);
		Fpdf::Cell(190, 6, 'NCM: ' . $ncm . '  -  item n.: ' . $itens . '  -  Produto: ' . $nnfe . ' - ' . $nome, 0, 0, 'L');
		Fpdf::Ln(3);
		Fpdf::SetFont('times', '', 8);
		Fpdf::Cell(40, 6, 'Valor dos Produtos:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newvproduto, 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Aliquota de Reducao da Base:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newsubtrib.'%', 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Valor do Debito de ICMS:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newdebICMA, 0, 0, 'R');
		Fpdf::Ln(3);
		Fpdf::Cell(40, 6, 'Descontos:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $vdesconto, 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Base Reduzida:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newbasered, 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Valor do Credito de ICMS:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newcreICMS, 0, 0, 'R');
		Fpdf::Ln(3);
		Fpdf::Cell(40, 6, 'Valor Liquido:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newvliquido, 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Aliquota de MVA:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newvmva.'%', 0, 0, 'R');
		Fpdf::Ln(3);
		Fpdf::Cell(40, 6, 'Aliquota Interestadual:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $aliext.'%', 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Base de Cal. Ajust. MVA:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newbasajst, 0, 0, 'R');
		Fpdf::Ln(3);
		Fpdf::Cell(40, 6, 'Beneficios de ICMS:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $vdesconto, 0, 0, 'R');
		Fpdf::Cell(40, 6, 'Aliquota Interna:', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newaliint.'%', 0, 0, 'R');
		Fpdf::SetFont('times', 'B', 10);
		Fpdf::Cell(40, 6, 'Valor ICMS de ST :', 0, 0, 'L');
		Fpdf::Cell(20, 6, $newst, 0, 0, 'R');
		Fpdf::Ln(5);
		Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		Fpdf::Ln(1);
		Fpdf::SetFont('times', '', 8);
		$linha_atual++;
			} elseif($newvmva == 0){
						//Layuot dos Regsitor
		Fpdf::SetFont('times', 'B', 8);
		Fpdf::Cell(190, 6, 'NCM: ' . $ncm . '  -  item n.: ' . $itens . '  -  Produto: ' . $nnfe . ' - ' . $nome, 0, 0, 'L');
		Fpdf::Ln(3);
		Fpdf::SetFont('times', 'B', 14);
		Fpdf::Ln(5);
		Fpdf::Cell(40, 6, 'NCM NÃO CADASTRADO ou MVA COM VALOR ZERO', 0, 0, 'L');
		Fpdf::Ln(5);
		Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		Fpdf::Ln(1);
		Fpdf::SetFont('times', '', 8);
		$linha_atual++;



			}
			
	//Imprime o N de paginas
	//Fpdf::SetFont('times', '', 6);
	//Fpdf::Cell(0, 10, "Pagina $x de $paginas", 0, 0, 'R');
	}
//};

		// Totalizadores
		Fpdf::SetFont('times', 'B', 12);
		Fpdf::Cell(190, 6, 'RESUMO TOTAIS', 0, 0, 'C');
		Fpdf::Ln(5);
		Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		Fpdf::SetFont('times', '', 8);
		Fpdf::Cell(20, 6, 'NFe', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'Valor NFe', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'Valor Produtos', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'CREDITOS DE ICMS', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'DEBITOS DE ICMS', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'VALOR DO ST', 0, 0, 'C');
		Fpdf::Ln(5);
		Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		//Fpdf::Ln(1);
		Fpdf::SetFont('times', 'B', 12);
		Fpdf::Cell(20, 6, $nnfe, 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format(floatval($tnfe), 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format(floatval($tproduto), 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format($tcreICMS, 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format($tdebICMS, 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format(($tdebICMS - $tcreICMS), 2, ',', '.')), 0, 0, 'C');
		Fpdf::Output('CalculoST.NFe'.$nnfe.'.pdf', 'D');
		exit;
		return Redirect('consultaxml');

}

public function formataReais($valor1, $valor2, $operacao)
{
    /*     function formataReais ($valor1, $valor2, $operacao)
     *
     *     $valor1 = Primeiro valor da operação
     *     $valor2 = Segundo valor da operação
     *     $operacao = Tipo de operações possíveis . Pode ser :
     *     "+" = adição,
     *     "-" = subtração,
     *     "*" = multiplicação
     *
     */


    // Antes de tudo , arrancamos os "," e os "." dos dois valores passados a função . Para isso , podemos usar str_replace :
    $valor1 = str_replace (",", "", $valor1);
    $valor1 = str_replace (".", "", $valor1);

    $valor2 = str_replace (",", "", $valor2);
    $valor2 = str_replace (".", "", $valor2);


    // Agora vamos usar um switch para determinar qual o tipo de operação que foi definida :
    switch ($operacao) {
        // Adição :
        case "+":
            $resultado = $valor1 + $valor2;
            break;

        // Subtração :
        case "-":
            $resultado = $valor1 - $valor2;
            break;

        // Multiplicação :
        case "*":
            $resultado = $valor1 * $valor2;
            break;

    } // Fim Switch


    // Calcula o tamanho do resultado com strlen
    $len = strlen ($resultado);


    // Novamente um switch , dessa vez de acordo com o tamanho do resultado da operação ($len) :
    // De acordo com o tamanho de $len , realizamos uma ação para dividir o resultado e colocar
    // as vírgulas e os pontos
    switch ($len) {
        // 2 : 0,99 centavos
        case "2":
            $retorna = "0,$resultado";
            break;

        // 3 : 9,99 reais
        case "3":
            $d1 = substr("$resultado",0,1);
            $d2 = substr("$resultado",-2,2);
            $retorna = "$d1,$d2";
            break;

        // 4 : 99,99 reais
        case "4":
            $d1 = substr("$resultado",0,2);
            $d2 = substr("$resultado",-2,2);
            $retorna = "$d1,$d2";
            break;

        // 5 : 999,99 reais
        case "5":
            $d1 = substr("$resultado",0,3);
            $d2 = substr("$resultado",-2,2);
            $retorna = "$d1,$d2";
            break;

        // 6 : 9.999,99 reais
        case "6":
            $d1 = substr("$resultado",1,3);
            $d2 = substr("$resultado",-2,2);
            $d3 = substr("$resultado",0,1);
            $retorna = "$d3.$d1,$d2";
            break;

        // 7 : 99.999,99 reais
        case "7":
            $d1 = substr("$resultado",2,3);
            $d2 = substr("$resultado",-2,2);
            $d3 = substr("$resultado",0,2);
            $retorna = "$d3.$d1,$d2";
            break;

        // 8 : 999.999,99 reais
        case "8":
            $d1 = substr("$resultado",3,3);
            $d2 = substr("$resultado",-2,2);
            $d3 = substr("$resultado",0,3);
            $retorna = "$d3.$d1,$d2";
            break;

    } // Fim Switch

    // Por fim , retorna o resultado já formatado
    return $retorna;
} // Fim da function

public function pegaXml(Request $request){
	$input = Input::file('xml'); // pega o xml do input
	$nome = "calculoxml.xml"; // nome o xml
	$this->upload($input, $nome); // faz upload do xml com novo nome
	$xml = simplexml_load_file(public_path($nome)); // le o xlm
	return $xml; // retorna o xml
	echo $xml;
}

public function geraPdf(){
	$xml = simplexml_load_file(public_path($nome));
		//Variaveis do XML
		$item = count($xml->NFe->infNFe->det);
		//Conta o numero de Ites do XML
		$tproduto = $xml -> NFe -> infNFe -> total -> ICMSTot -> vProd;
		//Valor total dos Prodtos do XML
		$tnfe = $xml -> NFe -> infNFe -> total -> ICMSTot -> vNF;
		// Valor Total da NFe
		$tICMS = $xml -> NFe -> infNFe -> total -> ICMSTot -> vICMS;
		// Valor total do ICMS da NFe
		$emitente = $xml -> NFe -> infNFe -> emit -> xNome;
		//Razão social do Emitente
		$fantasia = $xml -> NFe -> infNFe -> emit -> xFant;
		// Nome de Fantasia do Emitente
		$endereco = $xml -> NFe -> infNFe -> emit -> enderEmit -> xMun;
		// Minicipio do Enitente
		$destino = $xml -> NFe -> infNFe -> dest -> xNome;
		// Rasão social do Destino
		$bairrodestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xBairro;
		$logdestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xLgr;
		$enddest = $xml -> NFe -> infNFe -> dest -> enderDest -> xMun;
		// Municipio do Destino
		$chave = $xml -> protNFe -> infProt -> chNFe;
		// Chave de acesso do XML
		$nnfe = $xml -> NFe -> infNFe -> ide -> nNF;
		// Numero da NFe do XML

	$this->cabecalho($titulo, $chave, $nnfe, $demit, $endereco, $fantasia, $emitente, $destino, $logdestino, $bairrodestino, $enddest); // Imprime cabeçalho
	$this->corpo();
	$this->rodape();

}
public function corpo(){
	$this->pegaVlitem();
	echo "Total do Produtos: ". $valorProduto . "<br>";
}

public function rodape(){
	// Totalizadores
		Fpdf::SetFont('times', 'B', 12);
		Fpdf::Cell(190, 6, 'RESUMO TOTAIS', 0, 0, 'C');
		Fpdf::Ln(5);
		Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		Fpdf::SetFont('times', '', 8);
		Fpdf::Cell(20, 6, 'NFe', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'Valor NFe', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'Valor Produtos', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'CREDITOS DE ICMS', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'DEBITOS DE ICMS', 0, 0, 'C');
		Fpdf::Cell(30, 6, 'VALOR DO ST', 0, 0, 'C');
		Fpdf::Ln(5);
		Fpdf::Cell(190, 0.2, '', 1, 1, 'C');
		//Fpdf::Ln(1);
		Fpdf::SetFont('times', 'B', 12);
		Fpdf::Cell(20, 6, $nnfe, 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format(floatval($tnfe), 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format(floatval($tproduto), 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format($tcreICMS, 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format($tdebICMS, 2, ',', '.')), 0, 0, 'C');
		Fpdf::Cell(30, 6, (number_format(($tdebICMS - $tcreICMS), 2, ',', '.')), 0, 0, 'C');
		Fpdf::Output('CalculoST.NFe'.$nnfe.'.pdf', 'D');
		exit;
		return Redirect('consultaxml');
}

public function ValorTatol(){

}

public function pegaVlitem(Request $request){
	
	$input = Input::file('xml'); // pega o xml do input
	$nome = "calculoxml.xml"; // nome o xml
	$this->upload($input, $nome); // faz upload do xml com novo nome
	$xml = simplexml_load_file(public_path($nome)); // le o xlm
	$itens = count($xml->NFe->infNFe->det); // Conta a quantidade de Itens da NFe
	$emit = $xml -> NFe -> infNFe -> emit -> xNome;
	//Razão social do Emitente
	$fantasia = $xml -> NFe -> infNFe -> emit -> xFant;
	// Nome de Fantasia do Emitente
	$endereco = $xml -> NFe -> infNFe -> emit -> enderEmit -> xMun;
	// Minicipio do Enitente
	$destinonota = $xml -> NFe -> infNFe -> dest -> xNome;
	// Rasão social do Destino
	$bairrodestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xBairro;
	$logdestino = $xml -> NFe -> infNFe -> dest -> enderDest -> xLgr;
	$enddest = $xml -> NFe -> infNFe -> dest -> enderDest -> xMun;
	// Municipio do Destino
	$chave = $xml -> protNFe -> infProt -> chNFe;
	// Chave de acesso do XML
	$nnfe = $xml -> NFe -> infNFe -> ide -> nNF;
	// Numero da NFe do XML
	

	$origem = $xml->NFe->infNFe->emit->enderEmit->UF;
	$destino = $xml->NFe->infNFe->dest->enderDest->UF;
	$emitente = "Razão Social do Emitente: ".$emit." - Fantasia: ".$fantasia." - Endereço: ".$endereco." - UF: ".$origem;
	
	$destinatario = "Razão Social do Emitente: ".$destinonota." - Endereço: ".$enddest." - Bairro:".$bairrodestino." - UF.:".$destino;
//	$dadosnfe = "Chave NFe: ".$chave - "Numero NFe: ". $nnfe;
	
	$cabecalhos[] = array('emitente'=>$emitente, 'destinatario'=>$destinatario);

	
	for ($i = 0; $i < $itens; $i++) {
		
		$det = $xml->NFe->infNFe->det[$i]; //Simplifica as tag's do Xml
		$valorProduto = $det->prod->vProd; //Valor do Total do Item
		$cstPis = $det->imposto->PIS->PISNT->CST; //pega o valor do cst do pis
		$cstCofins = $det->imposto->COFINS->COFINSNT->CST; //pega o valor do cst do cofins
		$cstIpi = $det->imposto->IPI->IPINT->CST; //pega o valor do cst do ipi
		$valorSuframa = $det->imposto->ICMS->ICMS40->vICMSDeson; //pega o valor da suframa
		$ncm = $det->prod->NCM;
		$cest = $det->prod->CEST;
		$valorFrete = 0;
		$valorOutras = 0;
		$valorDescIncod = 0;
		$valorPis = $this->calculaPis($cstPis, $valorProduto);
		$valorCofins = $this->calculaCofins($cstCofins, $valorProduto);
		$valorIpi = $this->calculaCofins($cstIpi, $valorProduto);
		$valorMva = $this->calculaMva($ncm, $cest, $origem, $destino);
		$valorPisCofins = $valorPis + $valorCofins;
		$valorIFOD = $valorFrete + $valorOutras + $valorIpi + $valorDescIncod;
		$bc1 = $this->formataReais($valorProduto, $valorPisCofins, "-");
		$bc2 = $this->formataReais($bc1, $valorSuframa, "-");
		$bc3 = $this->formataReais($bc2, $valorIFOD, "-");
		$alicotaInterna = $this->pegaAlicotaInterna($ncm, $cest);
		$baseCalc = $valorMva * (float)$bc3;
		$valorSub = $alicotaInterna * $baseCalc;
		$valorIcms = $this->pegaOrigem($origem, $destino);
		$valorIcms = ($valorIcms / 100) * $valorProduto;
		$valorST = $valorSub - $valorIcms;

		$resultadoItens =  array('Item'=>$i, 'produto'=>$valorProduto, 'pis'=>$valorPis, 'cofins'=>$valorCofins, 'bc1'=>$bc1, 'suframa'=>$valorSuframa, 'bc2'=>$bc2, 'ipi'=>$valorIpi, 'outros'=>$valorOutras, 'frete'=>$valorFrete, 'desconto'=>$valorDescIncod, 'bc3'=>$bc3, 'mva'=>$valorMva, 'base'=>$baseCalc, 'interna'=>$alicotaInterna, 'sub'=>$valorSub, 'alicota'=>$alicotaInterna, 'icms'=>$valorIcms, 'st'=>$valorST);         
	}

		dd($resultadoItens);
	return view('xml.resultado', compact('cabecalhos', $cabecalhos, 'resultadoItens', $resultadoItens));

}

public function calculaPis($cstPis, $valorProduto){

	$consultas = TbPisCofins::where('cst', $cstPis)->get();
	foreach ($consultas as $consulta) {
		$pis = $consulta->descricao;
		$alicota = $consulta->alicota_pis;
		$valorPis = $this->porcento($alicota, $valorProduto);
	
	}
		return $valorPis;
	
	
}
public function calculaCofins($cstCofins, $valorProduto){

	$consultas = TbPisCofins::where('cst', $cstCofins)->get();
	foreach ($consultas as $consulta) {
		$cofins = $consulta->descricao;
		$alicota = $consulta->alicota_cofins;
		$valorCofins = $this->porcento($alicota, $valorProduto);
	
	}
		return $valorCofins;
	
	
}

public function calculaIpi($cstIpi, $valorProduto){

	$consultas = TbIpi::where('cst', $cstIpi)->get();
	foreach ($consultas as $consulta) {
		$ipi = $consulta->descricao;
		$alicota = $consulta->alicota;
		$valorIpi = $this->porcento($alicota, $valorProduto);
	
	}
		return $valorIpi;
	
	
}

public function calculaMva($ncm, $cest, $origem, $destino){

	$consultas = TbMva::where([['cest', $cest], ['ncm', $ncm]])->get();
	$origemDestino = $this->pegaOrigem($origem, $destino);
	foreach ($consultas as $consulta) {
		$mvaInterno = $consulta->mva_op_interna; 
		$alicota7 = $consulta->alicota_7;
		$alicota12 = $consulta->alicota_12;
		$alicota4 = $consulta->alicota_4;
		if ($origemDestino == 12) {
			$valorMva = $alicota12;
		} elseif($origemDestino == 7){
			$valorMva = $alicota7;
		}elseif($origemDestino == 4){
			$valorMva = $alicota4;
		}else{
			$valorMva = $mvaInterno;
		}

		$valorMva = ((float)$valorMva/100)+1;
		return (float)$valorMva;
	
	}


	
	
}

public function pegaOrigem($origem, $destino){

	$consultas = DB::table('tb_icms')
                    ->where('origem', '=', $origem)
                    ->where('destino', '=', $destino)
                    ->get();


	foreach ($consultas as $consulta) {
		$alicotaicms = $consulta->icms;

	}
		return $alicotaicms;
	
	
}

public function pegaAlicotaInterna($ncm, $cest){

	$consultas = DB::table('tb_mvas')
                    ->where('ncm', '=', $ncm)
                    ->where('cest', '=', $cest)
                    ->get();
    if ($consultas == true) {
                  foreach ($consultas as $consulta) {
		$alicotaInterna = $consulta->alicota_interna;
	}

	}else{
		$alicotaInterna = 0;	

	}
                                  
	
		return (float)$alicotaInterna / 100;
	
	
}


public function calculaFrete($cstIpi, $valorProduto){

}


public function porcento ( $porcentagem, $total ) {
 return ( $porcentagem / 100 ) * $total;
}

public function resultado(){


}

public function cabecalho($titulo, $chave, $nnfe, $demit, $endereco, $fantasia, $emitente, $destino, $logdestino, $bairrodestino, $enddest){
	Fpdf::Open();
	Fpdf::AddPage();
	Fpdf::SetFont("times", "B", 10);
	//logomarca do Relatorio
	Fpdf::SetFillColor(232, 232, 232);
	Fpdf::SetTextColor(0, 0, 0);
	Fpdf::Image('logost.png', 10, 10, -300);
	Fpdf::Ln(5);
	// Move para a direita
	Fpdf::Cell(50);
	// Titulo dentro de uma caixa
	Fpdf::Cell(85, 10, $titulo, 0, 0, 'C');
	// Quebra de linha
	Fpdf::Ln(10);
	//Cabeçalho do relatorio
	Fpdf::SetFont('times', '', 8);
	Fpdf::Line(10, 25, 200, 25);
	Fpdf::Cell(100, 6, 'Cheve de Acesso: ' . $chave, 0, 0, 'L');
	Fpdf::Cell(30, 6, 'N. NFe: ' . $nnfe, 0, 0, 'L');
	Fpdf::Cell(60, 6, 'Data de Emissão: '.$demit, 0, 0, 'L');
	Fpdf::Ln(4);
	Fpdf::Cell(190, 6, 'Fornecedor: ' . $emitente . '   -   Fantasia.:' . $fantasia . '   -   End.:' . $endereco, 0, 0, 'L');
	Fpdf::Ln(4);
	Fpdf::Cell(190, 6, 'Destinatario: ' . $destino . '  -   End.:'.$logdestino.' - ' . $bairrodestino . '-' . $enddest, 0, 0, 'L');
	Fpdf::Line(10, 38, 200, 38);
	Fpdf::Ln(4);

}

	
}


