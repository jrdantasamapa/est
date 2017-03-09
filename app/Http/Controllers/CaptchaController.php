<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// Autoload
//require './vendor/autoload.php';

// Iniciando a classe
use DownloadNFeSefaz\DownloadNFeSefaz;


class CaptchaController extends Controller
{
  
public function chave(){
	$captcha = $this->captcha();
	$url = 'chave';
    return view('xml.index', compact('url', 'captcha'));

}

    
   public function captcha(){
    	$downloadXml = new DownloadNFeSefaz();
		// Capturando o captcha em formato base64 (png)
		$captcha = $downloadXml->getDownloadXmlCaptcha();
		// Exibindo em html
		return($captcha);		
    }


    public function downloadXML($captcha, $chave_acesso, $CNPJ, $path_cert, $senha_cert){
		// Iniciando a classe
		$downloadXml = new DownloadNFeSefaz();
		$xml = $downloadXml->downloadXmlSefaz($captcha, $chave_acesso, $CNPJ, $path_cert, $senha_cert);
		return($xml);
    }
}





