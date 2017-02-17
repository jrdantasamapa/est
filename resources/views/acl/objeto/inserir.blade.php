  <div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel-body">
             {!! Form::open(['url'=>'inserirobjeto', 'method'=>'Post']) !!}
                <h3>Inserindo Objeto </h3>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nome do Objeto</label>
                    <div class="col-md-6">
                        {!! Form::text('nome', '', array('class'=>'form-control')) !!}
                    </div>
                </div>
<br>
                <div class="form-group">
                    <label class="col-md-4 control-label">Descrição do Objeto</label>
                    <div class="col-md-6">
                        {!! Form::text('descricao', '', array('class'=>'form-control')) !!}
                </div>
                </div>
                 <br>              
                <hr style="color: #228B22; background-color: #228B22; height: 2px;">
                <div class="form-group">
                    <div class="col-md-12" align="center">
                        {!! Form::submit('Cadastrar', array('class' =>'btn btn-success')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>