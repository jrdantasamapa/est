<div class="panel panel-success">
  <div class="panel-body">
      <div class="panel panel-success">
      <div class="panel-heading"><h3>FICHA CADASTRAL NCM</h3></div>
      <div class="panel-body">
          @foreach($ncms as $ncm)
          <h3><label>NCM: <i>{{ $ncm->NCM }}</i></label></h3>
          <h3><label>MVA: <i>{{ $ncm->MVA }}</i></label></h3>
          <h3><label>Alicota Interna: <i>{{ $ncm->al_interna }}</i></label></h3>
          <h3><label>Redução: <i>{{ $ncm->reducao }}</i></label></h3>
           @endforeach
          <hr style="color: #228B22; background-color: #228B22; height: 2px;">
          
        </div>
    </div>
  </div>
</div>