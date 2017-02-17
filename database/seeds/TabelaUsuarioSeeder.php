<?php

use Illuminate\Database\Seeder;
use App\User;
class TabelaUsuarioSeeder extends Seeder {
 
    public function run()
    {
        $usuarios = User::get();
        $papel = Role::get();
        $objetos = Permission::get();
 
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
        }

        if($objetos->count() == 0){
            Permission::create(array(
        ['nome'=>'bt_alterarsenha','descricao'=>'Botão menu superior Alterar Senha'],
        ['nome'=>'bt_cadastro_acolhido','descricao'=>'Botão sub-menu Cadastrar Acolhido'],
        ['nome'=>'bt_cadastro_objeto','descricao'=>'Botão sub-menu Cadastrar Objeto'],
        ['nome'=>'bt_cadastro_padrinho','descricao'=>'Botão sub-menu Cadastrar Padrinhos'],
        ['nome'=>'bt_cadastro_papel','descricao'=>'Botão sub-menu Cadastrar Papel'],
        ['nome'=>'bt_cadastro_usuario','descricao'=>'Botão sub-menu Cadastrar usuarios'],
        ['nome'=>'bt_Deletar_acolhido','descricao'=>'Botão sub-menu deletar acolhidos'],
        ['nome'=>'bt_Deletar_objeto','descricao'=>'Botão sub-menu deletar objetios'],
        ['nome'=>'bt_Deletar_objeto_papel','descricao'=>'Botão sub-menu deletar objetos de um papel'],
        ['nome'=>'bt_Deletar_papel','descricao'=>'Botão sub-menu deletar papel'],
        ['nome'=>'bt_Deletar_termo','descricao'=>'Botão sub-menu deletar termo'],
        ['nome'=>'bt_Deletar_usuario','descricao'=>'Botão sub-menu deletar usuarios'],
        ['nome'=>'bt_edita_pia_acolhido','descricao'=>'Botão sub-menu editar pia de um acolhido'],
        ['nome'=>'bt_editar_acolhido','descricao'=>'Botão sub-menu editar cadastro de acolhido'],
        ['nome'=>'bt_editar_obejto','descricao'=>'Botão sub-menu editar cadastro de objeto'],
        ['nome'=>'bt_editar_padrinho','descricao'=>'Botão sub-menu editar cadastro de padrinho'],
        ['nome'=>'bt_editar_papel','descricao'=>'Botão sub-menu editar cadastro de papel'],
        ['nome'=>'bt_editar_termo','descricao'=>'Botão sub-menu editar cadastro de termo'],
        ['nome'=>'bt_editar_usuario','descricao'=>'Botão sub-menu editar cadastro de usuários'],
        ['nome'=>'bt_lista_objeto','descricao'=>'Botão sub-menu listar objetos'],
        ['nome'=>'bt_lista_padrinho','descricao'=>'Botão sub-menu listar padrinhos'],
        ['nome'=>'bt_lista_papel','descricao'=>'Botão sub-menu listar papel'],
        ['nome'=>'bt_lista_termo','descricao'=>'Botão sub-menu listar termo'],
        ['nome'=>'bt_lista_usuario','descricao'=>'Botão sub-menu listar usuários'],
        ['nome'=>'bt_listar_acolhido','descricao'=>'Botão sub-menu listar acolhidos'],
        ['nome'=>'bt_objeto_papel','descricao'=>'Botão sub-menu objetos de um papel'],
        ['nome'=>'bt_padrinho','descricao'=>'Botão menu superior padrinho'],
        ['nome'=>'bt_papel_usuario','descricao'=>'Botão sub-menu papel de um usuários'],
        ['nome'=>'bt_acolhido','descricao'=>'Botão menu superior Acolhido'],
        ['nome'=>'bt_pia_acolhido','descricao'=>'Botão sub-menu pia de acolhidos'],
        ['nome'=>'bt_relatorio','descricao'=>'Botão menu superior Relatorios'],
        ['nome'=>'bt_termo','descricao'=>'Botão sub-menu termos'],
        ['nome'=>'bt_usuario','descricao'=>'Botão menu superior usuário'],
        ['nome'=>'bt_visualizar_acolhido','descricao'=>'Botão sub-menu Visualizar acolhido cadastrados'],
        ['nome'=>'bt_visualizar_objeto','descricao'=>'Botão sub-menu Visualizar objetos cadastrados'],
        ['nome'=>'bt_visualizar_padrinho','descricao'=>'Botão sub-menu Visualizar padrinhos cadastrados'],
        ['nome'=>'bt_visualizar_papel','descricao'=>'Botão sub-menu Visualizar papeis cadastrados'],
        ['nome'=>'bt_visualizar_termo','descricao'=>'Botão sub-menu Visualizar termos cadastrados'],
        ['nome'=>'bt_visualizar_usuario','descricao'=>'Botão sub-menu Visualizar usuários cadastrados']
            ));
        }
    }
 
}

