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
    
    public function achaProduto($produtos, $item){
          
          $document = new DOMDocument('1.0', 'utf-8');
          $document->formatOutput = true;
          $document->preserveWhiteSpace = FALSE;
          libxml_use_internal_errors(true);
          $document->loadHTML($produtos);
       		$vezes = 52; //Loop no Html
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
       //    echo 'Item: '. $a .'<br>'; 
           	    for ($i=4; $i < $vezes ; $i++)
           		{	
           			$numero = $label[$i];
           			$spans = $span[$i];
                $array[$a][$i] = [$label[$i] => $span[$i]];

           	//		echo $numero . ' = ' . $spans .'<br>';
 			        }
 			  
			   // echo "======================================".'<br>';
			}   

      }

}
