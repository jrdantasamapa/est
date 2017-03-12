<div class="panel panel-success">
  <div class="panel-body">
    <h3>Lista de Emprestimos<hr></h3>
    <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-2">Nome</th>
          <th class="ls-nowrap col-xs-2">Valor</th>
          <th class="ls-nowrap col-xs-2">Taxa</th>
          <th class="ls-nowrap col-xs-2">Saldo</th>
          <th class="ls-nowrap col-xs-2">Data Pg</th>
          <th class="ls-nowrap col-xs-2">Ações</th>
        </tr>
      </thead>
      <tbody>
       @foreach($empestimos as $emprstimo)
       <tr>
         <td>{!! $emprestimo->nome !!}</td>
         <td>{!! $emprestimo->valor !!}</td>
         <td>{!! $emprestimo->taxa !!}</td>
         <td>{!! $emprestimo->saldo !!}</td>
         <td>{!! $emprestimo->dt_pg !!}</td>
         <td>
         @can('bt_visualizar_ncm')
           <a href="viewemprestimo{{$emprestimo->id}}"><i class="btn-sm btn-success fa fa-eye" ata-toggle="tooltip" data-placement="top" title="Visualizar Emprestimo" aria-hidden="true"></i></a>
         @endcan
         @can('bt_Deletar_ncm') 
           <a href="deletaremprestimo{{$emprestimo->id}}"><i class="btn-sm btn-danger fa fa-trash" ata-toggle="tooltip" data-placement="top" title="Deletar Emprestimo" aria-hidden="true"></i></a>
         @endcan
        </td>
       </tr>
       @endforeach
     </tbody>
   </table>
   <div class="row" align="center">
        {!! $emprestimo->render() !!}
      </div>
 </div>
</div>