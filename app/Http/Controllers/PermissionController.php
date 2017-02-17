<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use DB;
use App\Role;
use App\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	$permissions = Permission::paginate(10);
    	$url = 'lista';
        return view('acl.objeto.index', compact('permissions', 'url'));
    }

   public function create(){
        $url = 'create';
        return view('acl.objeto.index', compact('url'));
    }

    public function view($id){
        $permissions = Permission::where('id', $id)->get();
        $roles = Permission::find($id)->roles;
        $url = 'view';
        return view('acl.objeto.index', compact('roles','permissions','url'));
    }

    public function show($id){
        $permissions = Permission::where('id', $id)->get();
        $url = 'edit';
        return view('acl.objeto.index', compact('permissions','url'));
    }

    public function update(Request $request)
    {
        $data = $request->only('nome', 'descricao', 'id');
        $id = $data['id'];
        $permission = Permission::find($id);
        if ($permission->update($data)) {
            notify()->flash($permission->nome,
            'success',
            ['timer'=> 3000,
            'text'=> 'Alterado Com Sucesso'
            ]);
        return redirect()->action('PermissionController@index');
        }else{
            notify()->flash('Algo deu Errado Tente Outra Vez',
            'error',
            ['timer'=> 3000,
            'text'=> 'Tente Novamente'
            ]);
        return back()->withInput();
        }
    }

    public function delete ($id) {
       if (Permission::find($id)->delete()) {
            notify()->flash("Registro deletado",
            'success',
            ['timer'=> 3000,
            'text'=> 'Deletado Com Sucesso'
            ]);
            return back()->withInput();
            }
    }

  
   public function inserte(Request $request){
        $data = $request->all();
        $rules = array('nome' => 'required|min:4', 'descricao'=>'required');
        $validator = validator::make($data, $rules);
        
        if ($validator->fails()) {
           notify()->flash('Nome e Descrição são Obrigatorios',
            'error',
            ['timer'=> 3000,
            'text'=> ''
            ]);
           return back()->withInput();
        }
        $objeto = new  Permission($data);
        if ($objeto->save()) {
            notify()->flash('Papel =>'. $objeto->nome,
            'success',
            ['timer'=> 3000,
            'text'=> 'Inserido Com Sucesso'
            ]);
            return Redirect('/registerobjeto');
        }

    }
}
