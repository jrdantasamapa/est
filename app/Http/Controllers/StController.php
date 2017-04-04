<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DOMDocument;
use DomXPath;

class StController extends Controller
{
    public function calculaST(){

    }
    public function achaProduto(){
    	$document = new DOMDocument();
        $document->loadHTMLFile('produtos.html');
        $procura = new DomXPath($document); // instancia o DomXPath
        $item = $procura->query("//*[contains(@class, 'fixo-prod-serv-numero')]");
        $v = $procura->query("//*[contains(@class, 'fixo-versao-xml')]");
        if ($v->length > 0) {
    		$vs = $v->item(0)->nodeValue;
    		$pieces = explode("L", $vs);
    		if ($pieces[1] == 3.10) {
				$vezes = 46;
			}elseif($pieces[1] == 2.00){
				$vezes = 53;
			}
			
		}
        	
        $nitens = $item->length - 1;
       foreach($document->getElementsByTagName('label') as $node)
                    {
                        $label[] = $document->saveHTML($node);
                    }
  		foreach($document->getElementsByTagName('span') as $node)
                    {
                        $span[] = $document->saveHTML($node);
                    }
           for ($a=0; $a < $nitens; $a++) {
         //  echo 'Item: '. $a .'<br>'; 
           	    for ($i=5; $i < $vezes ; $i++)
           		{	
           			$numero = $label[$i];
           			$spans = $span[$i];
                $VTP = $span[5];
           			$array[$i] = [$numero=>$spans];
                
           			echo $numero . ' = ' . $spans .'<br>';
 			    }
          echo $VTP .'<br>';
			    echo "======================================".'<br>';
          dd($array); 
			}   
				

      
        
    }


}
