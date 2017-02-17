<div class="panel panel-success">
  <div class="panel-body">
      <div class="panel panel-success">
      <div class="panel-heading"><h3>FICHA DE PAPEL</h3></div>
      <div class="panel-body">
          @foreach($roles as $role)
          <h3><label>Nome do Papel: <i>{{ $role->nome}}</i></label></h3>
           @endforeach
          <hr style="color: #228B22; background-color: #228B22; height: 2px;">
          <div class="panel-heading"><h4>OBJETOS DO PAPEL:</h4></div>
          <table class="table ls-table">
            <thead>
              <tr>
                <th class="ls-nowrap col-xs-2">Objeto</th>
                <th class="ls-nowrap col-xs-4">Descrição do Objeto</th>
              </tr>
            </thead>    
            <tbody>
            @foreach($objetos as $objeto)
              <tr>
                <td>{!! $objeto->nome !!}</td>
                <td>{!! $objeto->descricao !!}</td>
              </tr>
            @endforeach
           
            </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
