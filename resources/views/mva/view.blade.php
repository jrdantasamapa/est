<div class="panel panel-success" align="center">
  <div class="panel-body">
      <div class="panel panel-success">
      <div class="panel-heading"><h3>FICHA CADASTRAL MVA</h3> </div>

      <div class="panel-body">

          @foreach($mvas as $mva)
          <h3><label>CEST: <i>{{ $mva->cest }}</i></label></h3>
          <h3><label>NCM: <i>{{ $mva->ncm }}</i></label></h3>
          <h3><label>Descrição: <i>{{ $mva->descricao }}</i></label></h3>
          <h3><label>MVA Op Interna: <i>{{ $mva->mva_op_interna }}</i></label></h3>
          <h3><label>Alicota Interna: <i>{{ $mva->alicota_interna }}</i></label></h3>
          <h3><label>Alicota 7%: <i>{{ $mva->alicota_7 }}</i></label></h3>
          <h3><label>Alicota 12%: <i>{{ $mva->alicota_12 }}</i></label></h3>
          <h3><label>Alicota 4%: <i>{{ $mva->alicota_4 }}</i></label></h3>
           @endforeach
          <hr style="color: #228B22; background-color: #228B22; height: 2px;">
          
        </div>
        <a href="listamva">

                       <i class="fa fa-arrow-circle-left fa-2x" ata-toggle="tooltip" data-placement="top" title="Retornar a Listagem de MVA" aria-hidden="true"></i>
                </a>
    </div>

  </div>
</div>