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
    	for ($i=1; $i < 71; $i++) { 
    		$n = $i;
    		$r = $this->conta($n);
    		echo $i.'<=>'.$r."<br>";
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
