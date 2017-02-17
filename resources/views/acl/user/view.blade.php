<div class="panel panel-success">
  <div class="panel-body">
      <div class="panel panel-success">
      <div class="panel-heading"><h3>FICHA DE USUÁRIO</h3></div>
      <div class="panel-body">
          @foreach($usuarios as $usuario)
          <h3><label>Nome do Usuário: <i>{{ $usuario->name}}</i></label></h3>
          <h3><label>e-mail: <i>{{ $usuario->email}} </i></label></h3>
          
          <hr style="color: #228B22; background-color: #228B22; height: 2px;">
          <div class="panel-heading"><h4>PAPEIS DO USUÁRIO:</h4></div>
          <table class="table ls-table">
            <thead>
              <tr>
                <th class="ls-nowrap col-xs-2">Papel</th>
                <th class="ls-nowrap col-xs-4">Descrição do Papel</th>
                <th class="ls-nowrap col-xs-6">Objetos</th>
              </tr>
            </thead>    
            <tbody>
            @foreach($roles as $role)
              <tr>
                <td>{!! $role->nome !!}</td>
                <td>{!! $role->descricao !!}</td>
                <td>
                <?php
                  $permissions = $role->permission;
                  ?>
                @foreach($permissions as $permission)
                       {!! $permission->nome."->(".$permission->descricao.")" !!}
                 @endforeach
                </td>  
              </tr>
            @endforeach
            @endforeach
     
            </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
