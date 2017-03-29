<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Exception;
use DOMDocument;
use DomXPath;
use Response;
use Htmldom;
use DownloadNFeSefaz\DownloadNFeSefaz;
class CaptchaController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
  
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
            $document->formatOutput = true;
            $document->preserveWhiteSpace = FALSE;
            libxml_use_internal_errors(true);
           // $html = preg_replace('/[\f\n\t\rb]+/', '', $html);
            $document->loadHTML($html);
            curl_close($ch);

          //  Pegando todos os label (titulos)
            $label = $document->getElementsByTagName('label');
            $span = $document->getElementsByTagName('span');
             for ($i = 0; $i < $label->length; $i++) {
                   $row_label[] = $label->item($i)->nodeValue;
               }
            for ($i = 0; $i < $span->length; $i++) {
                  //$row[$row_label[$i]] = $span->item($i)->nodeValue;
                 $row_span[] = $span->item($i)->nodeValue;
               }
                   
               var_dump($row_span);
   
          // Pegando todos os span (conteudo)
                
           // $tabelas = $document->getElementsByTagName('table');
                
               // $numero = $tabelas->length;
            //    $i = 0;
            //    while($tabela = $tabelas->item($i++)){
            //        $resultado = $document->saveHTML($tabela);
                //    echo $resultado;
             //       $html = new \Htmldom($resultado);

                //    foreach($html->find('fieldset') as $label){
                           // echo $label . '<br>';

                 //       }

                
             
               //     foreach($html->find('td') as $element){
                      //  echo strip_tags($element);
                     //   echo '<br>';
                      //  $classe = $element->class;
                      // if ($element == 'Num.') {
                       //    echo $element . '<br>';
                      // }
                     // if ($classe == 'fixo-prod-serv-descricao') {
                             // echo $element . '<br>';
                       // }
                //     } 
                           
           //     }

               $url = 'resultado';
    	       return view('xml.index', compact('url', 'resultado'));
    }

    public function table($document)
    {   
                $tables = $document->getElementsByTagName('table');
                $i = 0;
                while( $tabela = $tables->item($i++)){
                  //  $resultado = $document->saveHTML($tabela);
                    $rows = $tabela->getElementsByTagName('tr');
                    $cols = $rows->item(0)->getElementsByTagName('td');
                    $label = $cols->item(0)->getElementsByTagName('label');
                    var_dump($label);
                }
             //   $rows = $tables->item(0)->getElementsByTagName('tr');
              //  $cols = $rows->item(0)->getElementsByTagName('td');
              //  $label = $cols->item(0)->getElementsByTagName('label');
                $span = $cols->item(0)->getElementsByTagName('span');
                $row_headers = NULL;
                foreach ($cols as $node) {
                   // print $node->nodeValue."\n";
                    $row_headers[] = $node->nodeValue;
                }
                 
                $table = array();
                //get all rows from the table
                $rows = $tables->item(0)->getElementsByTagName('tr');
                foreach ($rows as $row)
                {
                    // get each column by tag name
                    $cols = $row->getElementsByTagName('td');
                    $row = array();
                    $i=0;
                    foreach ($cols as $node) {
                        # code...
                        //print $node->nodeValue."\n";
                        if($row_headers==NULL)
                            $row[] = $node->nodeValue;
                        else
                            $row[$row_headers[$i]] = $node->nodeValue;
                        $i++;
                    }
                    $table[] = $row;
                }
                 
                print_r($table);
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