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
    
    public function achaProduto($produtos, $item, $desc){
          $document = new DOMDocument('1.0', 'utf-8');
      //    $document->formatOutput = true;
      //    $document->preserveWhiteSpace = FALSE;
      //    libxml_use_internal_errors(true);
          $document->loadHTML($produtos);
       		$vezes = 52; //Loop no Html
          $nitens = $item->length - 1;
          foreach($document->getElementsByTagName('label') as $node){
            $label[] = $document->saveHTML($node);
                          
          }
     //     print_r($label);      
    		  foreach($document->getElementsByTagName('span') as $node){
            $span[] = $document->saveHTML($node);
          }


         for ($a=0; $a < $nitens; $a++) {
            echo 'Item: '. $a .'<br>';
        	    or ($i=4; $i < $vezes ; $i++){	
              $numero = $label[$a];
        			$spans = $span[$a];
           //   print_r($label[28].' = '. $span[28] . '<br>');
           //   print_r($label[68].' = '. $span[68] . '<br>');
           //   echo "======================================".'<br>'; 
           //   $array[$a][$i] = [$label[$i] => $span[$i]];
           // print_r ($label[0] .' = '. $span[0] . '<br>'); //Versão
           // print_r ($label[1] .' = '. $span[1] . '<br>'); //Versão
          //  print_r ($label[4] .' = '. $span[4] . '<br>'); //Valor Total da NFe
          //  print_r ($label[28] .' = '. $span[28] . '<br>'); //Tributaçãod o ICMS
          //  print_r ($label[50] .' = '. $span[50] . '<br>'); //Tributaçãod o ICMS
           		//	echo $numero . ' = ' . $spans .'<br>';
 			     //  }
           // echo "======================================".'<br>';
			    }

               
    }
}
