<div class="panel panel-success">

  <div class="panel-body">
    <h3>Lista de Objetos Cadastrados<hr></h3>
    <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-3">Nome do Objeto</th>
          <th class="ls-nowrap col-xs-6">Descrição do Objeto</th>
          <th class="ls-nowrap col-xs-3">Ações</th>
        </tr>
      </thead>
      <tbody>
       @foreach($permissions as $permission)
       <tr>
         <td>{!! $permission->nome !!}</td>
         <td>{!! $permission->descricao !!}</td>
         <td>
         @can('bt_visualizar_objeto')
           <a href="viewobjeto{{$permission->id}}"><i class="btn-sm btn-success fa fa-eye" ata-toggle="tooltip" data-placement="top" title="Visualizar Objetol" aria-hidden="true"></i></a>
         @endcan
         @can('bt_editar_obejto')
           <a href="editeobjeto{{$permission->id}}"><i class="btn-sm btn-primary fa fa-pencil-square-o" ata-toggle="tooltip" data-placement="top" title="Editar Objeto" aria-hidden="true"></i></a>
         @endcan
         @can('bt_Deletar_obejto') 
           <a href="deletarobjeto{{$permission->id}}"><i class="btn-sm btn-danger fa fa-trash" ata-togglobjpapeldata-placement="top" title="Deletar Objeto" aria-hidden="true"></i></a>
         @endcan
         </td>
       </tr>
       @endforeach
     </tbody>
   </table>
      <div class="row" align="center">
        {!! $permissions->render() !!}
      </div>
  </div>
</div>