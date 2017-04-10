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
<<<<<<< HEAD
<<<<<<< HEAD
         //  echo 'Item: '. $a .'<br>'; 
=======
           echo 'Item: '. $a .'<br>'; 
>>>>>>> 2749fba94ce9089c2b85f814c4dc406aad3cf71f
           	    for ($i=5; $i < $vezes ; $i++)
=======
       //    echo 'Item: '. $a .'<br>'; 
           	    for ($i=4; $i < $vezes ; $i++)
>>>>>>> 66fa4fa6194176124e4c40d4f5c9cee19fded3eb
           		{	
           			$numero = $label[$i];
           			$spans = $span[$i];
<<<<<<< HEAD
                $VTP = $span[5];
           			$array[$i] = [$numero=>$spans];
                
           			echo $numero . ' = ' . $spans .'<br>';
 			    }
          echo $VTP .'<br>';
=======
                $array[$a][$i] = [$label[$i] => $span[$i]];

           	//		echo $numero . ' = ' . $spans .'<br>';
 			        }
<<<<<<< HEAD
 			    
>>>>>>> 2749fba94ce9089c2b85f814c4dc406aad3cf71f
			    echo "======================================".'<br>';
          dd($array); 
=======
 			  
			   // echo "======================================".'<br>';
>>>>>>> 66fa4fa6194176124e4c40d4f5c9cee19fded3eb
			}   
<<<<<<< HEAD
				

      
        
    }

=======
>>>>>>> 2749fba94ce9089c2b85f814c4dc406aad3cf71f

      }

}
