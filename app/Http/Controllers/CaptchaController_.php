<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Exception;
use DOMDocument;
use DomXPath;
use Response;
use DownloadNFeSefaz\DownloadNFeSefaz;


class CaptchaController extends Controller
{
  
public function chave(){
	$captcha = $this->captcha();
	$url = 'chave';
    return view('xml.index', compact('url', 'captcha'));

}

public function downloadXml(Request $request){
		$dados = $request->All(); //dados vindos do formulario
        $txtCaptcha = $dados['captcha']; // input digita captcha
		$chNFe = $dados['chave'];// Chave da NFe

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        
        if (session_status() == PHP_SESSION_NONE)
            session_start();
            $url = "https://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8%3d";
            $cookie = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'cookies1.txt';
            $useragent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.99 Safari/535.1';
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

            $postfields = array();
            $postfields['__EVENTTARGET'] = "";
            $postfields['__EVENTARGUMENT'] = "";
            $postfields['__VIEWSTATE'] = $_SESSION['viewstate'];
            $postfields['__VIEWSTATEGENERATOR'] = $_SESSION['stategen'];
            $postfields['__EVENTVALIDATION'] = $_SESSION['eventValidation'];
            $postfields['ctl00$txtPalavraChave'] = "";
            $postfields['ctl00$ContentPlaceHolder1$txtChaveAcessoCompleta'] = $chNFe;
            $postfields['ctl00$ContentPlaceHolder1$txtCaptcha'] = $txtCaptcha;
            $postfields['ctl00$ContentPlaceHolder1$btnConsultar'] = 'Continuar';
            $postfields['ctl00$ContentPlaceHolder1$token'] = $_SESSION['token'];
            $postfields['ctl00$ContentPlaceHolder1$captchaSom'] = $_SESSION['captchaSom'];
            $postfields['hiddenInputToUpdateATBuffer_CommonToolkitScripts'] = '1';

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
            
            // Result
            $html = curl_exec($ch);
            preg_match('~Dados da NF-e~', $html, $tagTeste); //Verifica se Há resultado
  		
            if (isset($tagTeste[0])) {
                $tagDownload = $tagTeste[0];
            } else {
                notify()->flash('Sessão expirada ou captcha ou Chave inválido',
                'error',
                ['timer'=> 3000,
                'text'=> 'Tente Novamente'
                ]);
               return Redirect('/chave');
            }

           	$document = new DOMDocument('1.0', 'utf-8');
            libxml_use_internal_errors(true);
            $document->loadHTML($html);
            $document->formatOutput = true;
            $document->preserveWhiteSpace = false;
            curl_close($ch);
<<<<<<< HEAD:app/Http/Controllers/CaptchaController_.php
            
            $conteudo = preg_replace('/[\f\n\t\rb]+/', '', $html);
           
            preg_match('~<table>.*?(<tr>.*?(<td>(.*?)</td>).*?</tr>).*?</table>~', $conteudo, $matches);
            dd($matches);
            $coluna1 = $matches[0];
            preg_match('/<td align=\'right\'>([\w\d\s]+)<\/td>/', $conteudo, $matches);
            $coluna2 = $matches[0];
            echo '<strong>coluna1:</strong> ' . $coluna1 . '<br />' . PHP_EOL;
            echo '<strong>coluna2:</strong> ' . $coluna2 . '<br />' . PHP_EOL;
                
               $resultado = "";
               $url = 'resultado';
=======

           
            $html = $document->getElementsByTagName('table');        
            $form = array();
            foreach($html as $v){           
                $tag = $v->nodeName;
                $val = $v->nodeValue;           
                foreach($v->attributes as $k => $a){
                    $form[$tag]['label'] = utf8_decode($val);
                    $form[$tag][$k] = $a->nodeValue;
                }
             
            }   
             
               $resultado = $form;
       
            $url = 'resultado';
>>>>>>> 2980b52750e57f43528d0525f8f6686e129803c5:app/Http/Controllers/CaptchaController.php
    	       return view('xml.index', compact('url', 'resultado'));
       
}

    
   public function captcha(){
    	$downloadXml = new DownloadNFeSefaz();
		// Capturando o captcha em formato base64 (png)
		$captcha = $downloadXml->getDownloadXmlCaptcha();
		// Exibindo em html
		return($captcha);		
    }


    public function downloadXML_($captcha, $chave_acesso, $CNPJ, $path_cert, $senha_cert){
		// Iniciando a classe
		$downloadXml = new DownloadNFeSefaz();
		$xml = $downloadXml->downloadXmlSefaz($captcha, $chave_acesso, $CNPJ, $path_cert, $senha_cert);
		return($xml);
    }
}





