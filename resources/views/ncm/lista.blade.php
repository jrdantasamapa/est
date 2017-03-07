<div class="panel panel-success">

  <div class="panel-body">
    <h3>Lista de NCM Cadastrados<hr></h3>
    <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-2">NCM</th>
          <th class="ls-nowrap col-xs-2">MVA</th>
          <th class="ls-nowrap col-xs-2">Alicota Interna</th>
          <th class="ls-nowrap col-xs-2">Redução</th>
          <th class="ls-nowrap col-xs-2">Pis/Cofins</th>
          <th class="ls-nowrap col-xs-2">Ações</th>
        </tr>
      </thead>
      <tbody>
       @foreach($ncms as $ncm)
       <tr>
         <td>{!! $ncm->NCM !!}</td>
         <td>{!! $ncm->MVA !!}</td>
         <td>{!! $ncm->al_interna !!}</td>
         <td>{!! $ncm->reducao !!}</td>
         <td>{!! $ncm->piscofins !!}</td>
         <td>
         @can('bt_visualizar_ncm')
           <a href="viewncm{{$ncm->id}}"><i class="btn-sm btn-success fa fa-eye" ata-toggle="tooltip" data-placement="top" title="Visualizar NCM" aria-hidden="true"></i></a>
         @endcan
         @can('bt_editar_ncm')
           <a href="editencm{{$ncm->id}}"><i class="btn-sm btn-primary fa fa-pencil-square-o" ata-toggle="tooltip" data-placement="top" title="Editar NCM" aria-hidden="true"></i></a>
         @endcan
         @can('bt_Deletar_ncm') 
           <a href="deletarncm{{$ncm->id}}"><i class="btn-sm btn-danger fa fa-trash" ata-toggle="tooltip" data-placement="top" title="Deletar NCm" aria-hidden="true"></i></a>
         @endcan
        </td>
       </tr>
       @endforeach
     </tbody>
   </table>
   <div class="row" align="center">
        {!! $ncms->render() !!}
      </div>
 </div>
</div>