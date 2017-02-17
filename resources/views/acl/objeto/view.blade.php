<div class="panel panel-success">
  <div class="panel-body">
      <div class="panel panel-success">
      <div class="panel-heading"><h3>FICHA DE OBEJTO</h3></div>
      <div class="panel-body">
          @foreach($permissions as $permission)
          <h3><label>Nome do Objeto: <i>{{ $permission->nome}}</i></label></h3>
          <h3><label>Descrição do Objeto: <i>{{ $permission->descricao}}</i></label></h3>
           @endforeach
          <hr style="color: #228B22; background-color: #228B22; height: 2px;">
          <div class="panel-heading"><h4>PAPEIS VICULADOS AO OBJETO:</h4></div>
          <table class="table ls-table">
            <thead>
              <tr>
                <th class="ls-nowrap col-xs-2">Papel</th>
                <th class="ls-nowrap col-xs-4">Descrição do Papel</th>
              </tr>
            </thead>    
            <tbody>
            @foreach($roles as $role)
              <tr>
                <td>{!! $role->nome !!}</td>
                <td>{!! $role->descricao !!}</td>
              </tr>
            @endforeach
           
            </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
