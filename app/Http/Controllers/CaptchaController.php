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

     public function __construct(){
        $this->middleware('auth');
    }
  
    public function chave(){ //pega o captcha 
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
            $document->loadHTML($html);
            curl_close($ch);


                
            // String a ser tratada
             $string = $html; 

            // Expressão regular 
             $regex  = "#\<table\>\|\<tr\>\[\<td\>(.*)\<\/td\>\]\<\/tr\>\|\<\/table\>#"; 

              // Extrai o conteudo
              preg_match_all($regex,$string,$retorno,PREG_PATTERN_ORDER);

              // Valor #VALOR#
              $valor = $retorno[1];

              // Exibi o valor
              echo $valor;



                $procura = new DomXPath($document); // instancia o DomXPath
                $div = $procura->query("//*[contains(@class, 'indentacaoConteudo')]"); //Div com Relação deProdutos
                $ver = $procura->query("//*[contains(@class, 'fixo-versao-xml')]"); // Procurando Versão
                $prod = $procura->query("//*[contains(@id, 'Prod')]"); // Procurando Dados por produto
                $emit = $procura->query("//*[contains(@id, 'Emitente')]"); // Procura dados emitente
                $item = $procura->query("//*[contains(@class, 'fixo-prod-serv-numero')]"); // Numero de itens
                $desc = $procura->query("//*[contains(@class, 'fixo-prod-serv-descricao')]"); // Decricao Itens
                $qtd = $procura->query("//*[contains(@class, 'fixo-prod-serv-qtd')]"); // Qtd Itens
                $uc = $procura->query("//*[contains(@class, 'fixo-prod-serv-uc')]"); // Unidades do Itens
                $vb = $procura->query("//*[contains(@class, 'fixo-prod-serv-vb')]");// Valor Bruto do Itens

                $nitem = $item->length;
                $nitens = $item->length - 1;
                $vezes = 200; //Loop no Html
             
                foreach($document->getElementsByTagName('label') as $node){
                    $label[] = $document->saveHTML($node);
                    $pp[] = explode('</label>', $document->saveHTML($node));
                }

              
               
                foreach($document->getElementsByTagName('span') as $node){
                    $span[] = $document->saveHTML($node);
                }

                foreach ($item as $itens) {
                    $it[] = $itens->nodeValue;
                }
                foreach ($desc as $descricao) {
                    $d[] = $descricao->nodeValue;
                } 
                foreach ($qtd as $quantidade) {
                    $q[] = $quantidade->nodeValue;
                }
                foreach ($vb as $valor) {
                    $v[] = $valor->nodeValue;
                }
                foreach ($uc as $unidade) {
                    $u[] = $unidade->nodeValue;
                }

                foreach ($prod as $produto) {
                    $p[] = $produto->nodeValue;
                }
               // print_r($produto->nodeValue);
            //    dd($span);
            //    $inicio = 100;
              //  $loop = 40;
             //   $inicio = $inicio + $loop;
                
                
              //  for ($a=0; $a < $vezes; $a++) {
                  
                     //   $numero = $label[$a];
                       // $spans = $span[$a];
                        
                       
                     /*   echo "======================================".'<br>'; 
                        print_r ($label[0] .' = '. $span[0] . '<br>'); //Versão
                        print_r ($label[1] .' = '. $span[1] . '<br>'); //Versão
                        print_r ($label[4] .' = '. $span[4] . '<br>'); //Valor Total da NFe
                        print_r ($label[28] .' = '. $span[28] . '<br>'); //Tributaçãod o ICMS
                        print_r ($label[50] .' = '. $span[50] . '<br>'); //Tributaçãod o ICMS
                        echo $numero . ' = ' . $spans .'<br>';*/
                    //    $array[$a][$i] = [$label[$i] => $span[$i]];
                      //  echo $numero .' = '. $spans . '<br>';

                  //  print_r($label[$a].' = '. $span[$a] . '<br>');
                   // echo "======================================".'<br>';
              //  }
               //  print_r($array);
                $dados = array(
                                'item'=> $it,
                                'descricao' => $d,
                                'quantidade'=>$q,
                                'valor'=>$v,
                                'unidade'=>$u
                                );
                $resultado = $document->saveHTML($div->item(1));
                $produtos = $document->saveHTML($prod->item(0));

             //   $emitente = $document->saveHTML($emit->item(0));
              //  $versao = $document->saveHTML($ver->item(0));
               // $descricao = $document->saveHTML($desc->item(1));

              //  $quantidade = $document->saveHTML($qtd->item(1));
              //  $unidade = $document->saveHTML($uc->item(1));
             //   $valor = $document->saveHTML($vb->item(1));
                
            //    $teste = new StController();
             //   $teste->achaProduto($produtos, $item, $desc);

                
           /*     unlink('produtos.html');
                fopen('produtos.html','w+');
                $name = 'produtos.html';
                $file = fopen($name, 'r+');
                fwrite($file, $versao);
                fwrite($file, $produtos);
                fclose($file); */
                
                unlink('produtos.html');
                fopen('produtos.html','w+');
                $name = 'produtos.html';
                $file = fopen($name, 'r+');
            //    fwrite($file, $prod);
                fwrite($file, $produtos);
                fclose($file); 

              
               $url = 'resultado';
    	       return view('xml.index', compact('url', 'resultado', 'dados', 'nitem'));
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
