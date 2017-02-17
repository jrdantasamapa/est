<div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel-body">
            @foreach($permissions as $permission)
                {!! Form::open(['url'=>'updateobjeto$permission->id', 'method'=>'Post']) !!}
                <h3>Editando Objeto: {{ $permission->nome }}</h3>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nome</label>
                    <div class="col-md-6">
                        {!! Form::text('nome', $permission->nome, array('class'=>'form-control')) !!}
                    </div>
                </div>
<br>
                <div class="form-group">
                    <label class="col-md-4 control-label">Descrição</label>
                    <div class="col-md-6">
                        {!! Form::text('descricao', $permission->descricao, array('class'=>'form-control')) !!}
                </div>
                </div>
                    {{ Form::hidden('id', $permission->id ) }}   
<br>              
                <hr style="color: #228B22; background-color: #228B22; height: 2px;">
                <div class="form-group">
                    <div class="col-md-12" align="center">
                        {!! Form::submit('Alterar', array('class' =>'btn btn-success')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endforeach
        </div>
    </div>
</div>

 
