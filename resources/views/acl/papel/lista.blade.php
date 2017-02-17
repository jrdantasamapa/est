<div class="panel panel-success">

  <div class="panel-body">
    <h3>Lista de Papeis Cadastrados<hr></h3>
    <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-3">Nome do Papel</th>
          <th class="ls-nowrap col-xs-6">Descrição do Papel</th>
          <th class="ls-nowrap col-xs-3">Ações</th>
        </tr>
      </thead>
      <tbody>
       @foreach($roles as $role)
       <tr>
         <td>{!! $role->nome !!}</td>
         <td>{!! $role->descricao !!}</td>
         <td>
         @can('bt_visualizar_papel')
           <a href="viewpapel{{$role->id}}"><i class="btn-sm btn-success fa fa-eye" ata-toggle="tooltip" data-placement="top" title="Visualizar Papel" aria-hidden="true"></i></a>
         @endcan
         @can('bt_editar_papel')
           <a href="editepapel{{$role->id}}"><i class="btn-sm btn-primary fa fa-pencil-square-o" ata-toggle="tooltip" data-placement="top" title="Editar Papel" aria-hidden="true"></i></a>
         @endcan
         @can('bt_Deletar_papel') 
           <a href="deletarpapel{{$role->id}}"><i class="btn-sm btn-danger fa fa-trash" ata-togglobjpapeldata-placement="top" title="Deletar Papel" aria-hidden="true"></i></a>
         @endcan
         @can('bt_objeto_papel')
           <a href="registerobjpapel{{$role->id}}"><i class="btn-sm btn-warning fa fa-flag" ata-toggle="tooltip" data-placement="top" title="Atribuir Objeto" aria-hidden="true"></i></a>
         @endcan
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
      <div class="row" align="center">
        {!! $roles->render() !!}
      </div>
 </div>
</div>