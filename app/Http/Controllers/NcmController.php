<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Ncm;

class NcmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$ncms = Ncm::paginate(10);
    	$url = 'lista';
        return view('ncm.index', compact('ncms', 'url'));
    }
    public function create(){
        $url = 'create';
        return view('ncm.index', compact('url'));
    }

    public function inserte(Request $request){
        $data = $request->all();
        $rules = array('NCM' => 'required', 'MVA'=>'required', 'al_interna'=> 'required', 'reducao'=>'required');
        $validator = validator::make($data, $rules);
        if ($validator->fails()) {
           notify()->flash('Campos Obrigatorios',
            'error',
            ['timer'=> 3000,
            'text'=> ''
            ]);
           return back()->withInput();
        }
        $ncm = new  Ncm($data);
        if ($ncm->save()) {
            notify()->flash('NCM '. $ncm->NCM,
            'success',
            ['timer'=> 3000,
            'text'=> 'Inserido Com Sucesso'
            ]);
            return Redirect('ncm');
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
       if (Ncm::find($id)->delete()) {
            notify()->flash("Registro deletado",
            'success',
            ['timer'=> 3000,
            'text'=> 'Deletado Com Sucesso'
            ]);
            return back()->withInput();
            }
    }

    public function show($id){
        $ncms = Ncm::where('id', $id)->get();
        $url = 'edit';
        return view('ncm.index', compact('ncms','url'));
    }
    public function view($id){
        $ncms = Ncm::where('id', $id)->get();
        $url = 'view';
        return view('ncm.index', compact('ncms','url'));
    }

    public function update(Request $request)
    {
        $data = $request->All();
        $id = $data['id'];
        $ncm = Ncm::find($id);
        if ($ncm->update($data)) {
            notify()->flash($ncm->NCM,
            'success',
            ['timer'=> 3000,
            'text'=> 'Alterado Com Sucesso'
            ]);
        return redirect()->action('NcmController@index');
        }else{
            notify()->flash('Algo deu Errado Tente Outra Vez',
            'error',
            ['timer'=> 3000,
            'text'=> 'Tente Novamente'
            ]);
        return back()->withInput();
        }
    }
}
