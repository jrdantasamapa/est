<div class="panel panel-success">

  <div class="panel-body">
    <h3>Lista de Usuarios Cadastrados<hr></h3>
    <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-4">Nome</th>
          <th class="ls-nowrap col-xs-3">e-mail</th>
          <th class="ls-nowrap col-xs-3">Ações</th>
        </tr>
      </thead>
      <tbody>
       @foreach($usuarios as $usuario)
       <tr>
         <td>{!! $usuario->name !!}</td>
         <td>{!! $usuario->email !!}</td>
         <td>
         @can('bt_visualizar_usuario')
           <a href="viewusuario{{$usuario->id}}"><i class="btn-sm btn-success fa fa-eye" ata-toggle="tooltip" data-placement="top" title="Visualizar Usuario" aria-hidden="true"></i></a>
         @endcan
         @can('bt_editar_usuario')
           <a href="editeusuario{{$usuario->id}}"><i class="btn-sm btn-primary fa fa-pencil-square-o" ata-toggle="tooltip" data-placement="top" title="Editar Usuario" aria-hidden="true"></i></a>
         @endcan
         @can('bt_Deletar_usuario') 
           <a href="deletarusuario{{$usuario->id}}"><i class="btn-sm btn-danger fa fa-trash" ata-toggle="tooltip" data-placement="top" title="Deletar Usuario" aria-hidden="true"></i></a>
           
         @endcan
         @can('bt_papel_usuario')
           <a href="registerpapelusuario{{$usuario->id}}"><i class="btn-sm btn-warning fa fa-flag" ata-toggle="tooltip" data-placement="top" title="Atribuir Papel" aria-hidden="true"></i></a>
         @endcan
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
   <div class="row" align="center">
        {!! $usuarios->render() !!}
      </div>
 </div>
</div>