<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Resultado;

class LoteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$url = 'quina';
    	$n = 1;
    	$l = 11;
    	$t = 9;
    	$res = [];
    	for ($a=1; $a < $t; $a++) { 
    		for ($i=$n; $i < $l; $i++) { 
    			$r = $this->conta($i);
     			$resultado[$i]=$r;
     		}
			$n=$i+1;
			$l+=10;
    		var_dump($resultado);
     }
       	return view('loteria.index', compact('url', 'resultado'));
    }


    public function conta($n){
    	$contagem = Resultado::where('P', $n)
    							->orWhere('S', $n)
    							->orWhere('T', $n)
    							->orWhere('Q', $n)
    							->orWhere('QT', $n)->get();
    	return count($contagem);
    }

}
