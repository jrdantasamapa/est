<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Emprestimo;

class EmprestimoController extends Controller
{
    public function index(){
    	$emprestimos = Emprestimo::paginate(10);
    	$url = 'lista';
        return view('emprestimo.index', compact('emprestimos', 'url'));
    }
}
