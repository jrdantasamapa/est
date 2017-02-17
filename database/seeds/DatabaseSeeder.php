<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = User::get();
        $papel = Role::get();
        $objetos = Permission::get();
        $userpapel = DB::table('role_user')->get(); 
        if($usuarios->count() == 0) {
            User::create(array(
                'name' => 'JRDantas',
                'email' => 'jdsilva@azi.com.br',
                'password' => Hash::make('32811293@jr'),
            ));
        }

        if($papel->count() == 0){
            Role::create(array(
                'nome' => 'Administrador',
                'descricao' => 'Acesso Total ao Sistema',
            ));
            $data = array('role_id'=>'1', 'user_id'=>'1');
            DB::table('role_user')->insert($data);
        }

           
      
      
        Permission::create(array(
        'nome'=>
            array(['bt_alterarsenha','descricao'=>'Botão menu superior Alterar Senha'],
                  ['bt_cadastro_acolhido','descricao'=>'Botão sub-menu Cadastrar Acolhido'],
                  ['bt_cadastro_objeto','descricao'=>'Botão sub-menu Cadastrar Objeto'],
                  ['bt_cadastro_padrinho','descricao'=>'Botão sub-menu Cadastrar Padrinhos'],
                  ['bt_cadastro_papel','descricao'=>'Botão sub-menu Cadastrar Papel'],
                  ['bt_cadastro_usuario','descricao'=>'Botão sub-menu Cadastrar usuarios'],
                  ['bt_Deletar_acolhido','descricao'=>'Botão sub-menu deletar acolhidos'],
                  ['bt_Deletar_objeto','descricao'=>'Botão sub-menu deletar objetios'],
                  ['bt_Deletar_objeto_papel','descricao'=>'Botão sub-menu deletar objetos de um papel'],
                  ['bt_Deletar_papel','descricao'=>'Botão sub-menu deletar papel'],
                  ['bt_Deletar_termo','descricao'=>'Botão sub-menu deletar termo'],
                  ['bt_Deletar_usuario','descricao'=>'Botão sub-menu deletar usuarios'],
                  ['bt_edita_pia_acolhido','descricao'=>'Botão sub-menu editar pia de um acolhido'],
                  ['bt_editar_acolhido','descricao'=>'Botão sub-menu editar cadastro de acolhido'],
                  ['bt_editar_obejto','descricao'=>'Botão sub-menu editar cadastro de objeto'],
                  ['bt_editar_padrinho','descricao'=>'Botão sub-menu editar cadastro de padrinho'],
                  ['bt_editar_papel','descricao'=>'Botão sub-menu editar cadastro de papel'],
                  ['bt_editar_termo','descricao'=>'Botão sub-menu editar cadastro de termo'],
                  ['bt_editar_usuario','descricao'=>'Botão sub-menu editar cadastro de usuários'],
                  ['bt_lista_objeto','descricao'=>'Botão sub-menu listar objetos'],
                  ['bt_lista_padrinho','descricao'=>'Botão sub-menu listar padrinhos'],
                  ['bt_lista_papel','descricao'=>'Botão sub-menu listar papel'],
                  ['bt_lista_termo','descricao'=>'Botão sub-menu listar termo'],
                  ['bt_lista_usuario','descricao'=>'Botão sub-menu listar usuários'],
                  ['bt_listar_acolhido','descricao'=>'Botão sub-menu listar acolhidos'],
                  ['bt_objeto_papel','descricao'=>'Botão sub-menu objetos de um papel'],
                  ['bt_padrinho','descricao'=>'Botão menu superior padrinho'],
                  ['bt_papel_usuario','descricao'=>'Botão sub-menu papel de um usuários'],
                  ['bt_acolhido','descricao'=>'Botão menu superior Acolhido'],
                  ['bt_pia_acolhido','descricao'=>'Botão sub-menu pia de acolhidos'],
                  ['bt_relatorio','descricao'=>'Botão menu superior Relatorios'],
                  ['bt_termo','descricao'=>'Botão sub-menu termos'],
                  ['bt_usuario','descricao'=>'Botão menu superior usuário'],
                  ['bt_visualizar_acolhido','descricao'=>'Botão sub-menu Visualizar acolhido cadastrados'],
                  ['bt_visualizar_objeto','descricao'=>'Botão sub-menu Visualizar objetos cadastrados'],
                  ['bt_visualizar_padrinho','descricao'=>'Botão sub-menu Visualizar padrinhos cadastrados'],
                  ['bt_visualizar_papel','descricao'=>'Botão sub-menu Visualizar papeis cadastrados'],
                  ['bt_visualizar_termo','descricao'=>'Botão sub-menu Visualizar termos cadastrados'],
                  ['bt_visualizar_usuario','descricao'=>'Botão sub-menu Visualizar usuários cadastrados']
            )));

    }
 
}


