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
       </tr>
       @endforeach
     </tbody>
   </table>
   <div class="row" align="center">
        {!! $ncms->render() !!}
      </div>
 </div>
</div>