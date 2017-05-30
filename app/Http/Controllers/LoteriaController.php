<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	//$ncms = Ncm::paginate(10);
    	$url = 'quina';
        return view('loteria.index', compact('url'));
    }
}
