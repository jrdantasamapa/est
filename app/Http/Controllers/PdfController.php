<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Fpdf;
use Auth;

class PdfController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

	public function cabecalho()
	{
		Fpdf::AliasNbPages();
		Fpdf::AddPage();
		Fpdf::SetY(10);
		Fpdf::Image(public_path('clogost.png'),5,5,-120); // importa uma imagem
		Fpdf::SetXY(10, 40);
		Fpdf::ln(5);
	}

	public function rodape()
	{
		$endereco = "Av. Jose de Achieta, n 455 bairro - Santana-Ap cep.: 68925-000 - fone(): 99999999999";
		Fpdf::SetY(270);
		Fpdf::SetFont('Arial','I',6);
		Fpdf::ln(5);
		Fpdf::Cell(0, 5, $endereco . " - Gerado por: ". Auth::user()->name.' - '. date('Y-m-d H:i:s') , 0, 0);
	}

	public function pdfpis(Request $request){
		$this->cabecalho();
		$this->rodape();
	}

	public function pdfficha(){

	}	

	public function github (){
		$this->cabecalho();
		$this->rodape();
		Fpdf::Output('CalculoST.NFe'.'asdasdasd'.'.pdf', 'D');
	}

}
