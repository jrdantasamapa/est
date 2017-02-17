<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use DB;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
   
public function __construct()
    {
        $this->middleware('auth');
    }
   public function index(){
    	$roles = Role::paginate(10);
    	$url = 'lista';
        return view('acl.papel.index', compact('roles', 'url'));
    }

   public function create(){
        $url = 'create';
        return view('acl.papel.index', compact('url'));
    }

    public function view($id){
        $roles = Role::where('id', $id)->get();
        $objetos = Role::find($id)->permission;
        $url = 'view';
        return view('acl.papel.index', compact('roles','objetos','url'));
    }

    public function show($id){
        $roles = Role::where('id', $id)->get();
        $url = 'edit';
        return view('acl.papel.index', compact('roles','url'));
    }

    public function update(Request $request)
    {
        $data = $request->only('nome', 'descricao', 'id');
        $id = $data['id'];
        $role = Role::find($id);
        if ($role->update($data)) {
            notify()->flash($role->nome,
            'success',
            ['timer'=> 3000,
            'text'=> 'Alterado Com Sucesso'
            ]);
        return redirect()->action('RoleController@index');
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
       if (Role::find($id)->delete()) {
            notify()->flash("Registro deletado",
            'success',
            ['timer'=> 3000,
            'text'=> 'Deletado Com Sucesso'
            ]);
            return back()->withInput();
            }
    }

    public function deleteobj( $permission_id, $role_id ){
        if (Role::find($permission_id)->permission()->detach([$role_id])) {
            notify()->flash("Registro deletado",
            'success',
            ['timer'=> 3000,
            'text'=> 'Deletado Com Sucesso'
            ]);
            return back()->withInput();
            }
        
        }

    public function createobjpapel($id){
        $papels = Role::where('id', $id)->get();
        $url = 'inserirobj';
        $roleusers = Role::find($id)->permission;
        $roles = Permission::all();
            return view('acl.papel.index', compact('papels','url','roles', 'roleusers'));
        }
        

    public function inserirobjpapel(Request $request){
        $data = $request->only('permission_id','role_id');
           if (DB::table('permission_role')->insert($data)){
            notify()->flash('Objeto',
            'success',
            ['timer'=> 3000,
            'text'=> 'Inserido Com Sucesso'
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
        $papel = new  Role($data);
        if ($papel->save()) {
            notify()->flash('Papel'. $papel->nome,
            'success',
            ['timer'=> 3000,
            'text'=> 'Inserido Com Sucesso'
            ]);

            return Redirect('/registerpapel');
        }

    }
}
