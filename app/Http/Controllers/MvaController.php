<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\TbMva;

class MvaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$mvas = TbMva::paginate(10);
    	$url = 'lista';
        return view('mva.index', compact('mvas', 'url'));
    }
    public function create(){
        $url = 'create';
        return view('mva.index', compact('url'));
    }

    public function inserte(Request $request){
        $data = $request->all();
        $rules = array('cest' => 'required', 'ncm'=>'required', 'mva_op_interna'=>'required', 'alicota_interna'=>'required', 'alicota_7'=>'required', 'alicota_12'=>'required', 'alicota_4'=>'required');
        $validator = validator::make($data, $rules);
        if ($validator->fails()) {
           notify()->flash('Campos Obrigatorios',
            'error',
            ['timer'=> 3000,
            'text'=> ''
            ]);
           return back()->withInput();
        }
        $mva = new  TbMva($data);
        if ($mva->save()) {
            notify()->flash('NCM'. $mva->ncm,
            'success',
            ['timer'=> 3000,
            'text'=> 'Inserido Com Sucesso'
            ]);
            return Redirect('mva');
        }else{
        	notify()->flash('Algo deu errado',
            'error',
            ['timer'=> 3000,
            'text'=> ''
            ]);
           return back()->withInput();
        }
    }

    public function delete ($id) {
       if (TbMva::find($id)->delete()) {
            notify()->flash("Registro deletado",
            'success',
            ['timer'=> 3000,
            'text'=> 'Deletado Com Sucesso'
            ]);
            return back()->withInput();
            }
    }

    public function show($id){
        $mvas = TbMva::where('id', $id)->get();
        $url = 'edit';
        return view('mva.index', compact('mvas','url'));
    }
    public function view($id){
        $mvas = TbMva::where('id', $id)->get();
        $url = 'view';
        return view('mva.index', compact('mvas','url'));
    }

    public function update(Request $request)
    {
        $data = $request->All();
        $id = $data['id'];
        $mva = TbMva::find($id);
        if ($mva->update($data)) {
            notify()->flash($mva->ncm,
            'success',
            ['timer'=> 3000,
            'text'=> 'Alterado Com Sucesso'
            ]);
        return redirect()->action('MvaController@index');
        }else{
            notify()->flash('Algo deu Errado Tente Outra Vez',
            'error',
            ['timer'=> 3000,
            'text'=> 'Tente Novamente'
            ]);
        return back()->withInput();
        }
    }
    public function mvarelacao(){
        $mvas = TbMva::paginate(10);
        $url = 'lista';
        return view('mvas.index', compact('mvas', 'url'));
    }
}