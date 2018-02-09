<div class="panel panel-success">

  <div class="panel-body">
    <h3>Lista de MVA Cadastrados<hr></h3>
    <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-1">CEST</th>
          <th class="ls-nowrap col-xs-1">NCM</th>
          <th class="ls-nowrap col-xs-4">Descrição</th>
          <th class="ls-nowrap col-xs-1">MVA op Interna</th>
          <th class="ls-nowrap col-xs-1">Alicota Interna</th>
          <th class="ls-nowrap col-xs-1">Alicota 7%</th>
          <th class="ls-nowrap col-xs-1">Alicota 12%</th>
          <th class="ls-nowrap col-xs-1">Alicota 4%</th>
          <th class="ls-nowrap col-xs-1">Ação</th>
        </tr>
      </thead>
      <tbody>
       @foreach($mvas as $mva)
       <tr>
         <td>{!! $mva->cest !!}</td>
         <td>{!! $mva->ncm !!}</td>
         <td>{!! $mva->descricao !!}</td>
         <td>{!! $mva->mva_op_interna !!}</td>
         <td>{!! $mva->alicota_interna !!}</td>
         <td>{!! $mva->alicota_7 !!}</td>
         <td>{!! $mva->alicota_12 !!}</td>
         <td>{!! $mva->alicota_4 !!}</td>
         <td>
         @can('bt_visualizar_mva')
           <a href="viewmva{{$mva->id}}"><i class="btn-sm fa fa-eye" ata-toggle="tooltip" data-placement="top" title="Visualizar MVA" aria-hidden="true"></i></a>
         @endcan
         @can('bt_editar_mva')
           <a href="editemva{{$mva->id}}"><i class="btn-sm fa fa-pencil-square-o" ata-toggle="tooltip" data-placement="top" title="Editar MVA" aria-hidden="true"></i></a>
         @endcan
         @can('bt_Deletar_mva') 
           <a href="deletarmva{{$mva->id}}"><i class="btn-sm fa fa-trash" ata-toggle="tooltip" data-placement="top" title="Deletar MVA" aria-hidden="true"></i></a>
         @endcan
        </td>
       </tr>
       @endforeach
     </tbody>
   </table>
   <div class="row" align="center">
        {!! $mvas->render() !!}
      </div>
 </div>
</div>