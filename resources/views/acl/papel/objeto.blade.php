       <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-success">
    <div class="panel-body">
    @foreach($papels as $papel)
        <dir><h3><b>{{ $papel->nome }}</b></h3></dir>
        <hr style="color: #228B22; background-color: #228B22; height: 2px;">
        <dir><h5><b>Atribuir Objetos:</b></h5></dir>
        <div class="col-md-12">
            {!! Form::open(['url'=> 'inserirobjpapel', 'method'=>'post']) !!}
                <select class="form-control" name="permission_id">
                    @foreach($roles as $role)
                       @if(!$roleusers->contains($role))
                            <option value="{{$role->id}}">{{$role->nome}} - {{$role->descricao}}</option>
                      @endif
                    @endforeach
                </select>
                {{ Form::hidden('role_id', $papel->id ) }}
            {!! Form::submit('Selecinar', array('class' =>'btn btn-success')) !!}
            {!! Form::close() !!}
   
    <hr style="color: #228B22; background-color: #228B22; height: 2px;">
    </div>
    <dir><h5><b>Objetos Atribuidos:</b></h5></dir>
        <table class="table ls-table">
      <thead>
        <tr>
          <th class="ls-nowrap col-xs-4">Objetos</th>
          <th class="ls-nowrap col-xs-3">descrição</th>
          <th class="ls-nowrap col-xs-3">Ações</th>
        </tr>
      </thead>
      <tbody>
          @foreach($roleusers as $roleuser)
       <tr>
         <td>{!! $roleuser->nome !!}</td>
         <td>{!! $roleuser->descricao !!}</td>
         <td>
         @can('bt_Deletar_objeto_papel') 
             <a href="delobjpapel{{$papel->id}},{{$roleuser->id}}"><i class="btn-sm btn-danger fa fa-trash" ata-toggle="tooltip" data-placement="top" title="Deletar Objeto" aria-hidden="true"></i></a>
         @endcan
         </td>
       </tr>
       @endforeach
         
     </tbody>
   </table>
   @endforeach
  </div>

    </div>
    </div>