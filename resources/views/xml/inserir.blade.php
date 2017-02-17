<div class="panel panel-success">
        <div class="panel-body">
              {!! Form::open(['url'=>'inserirxml', 'method'=>'Post', 'files'=>true]) !!}
                <h3>Importando XML </h3>
                <div class="form-group col-md-12">
                    <label class="col-md-6 control-label">Selecione o Arquivo para Importar</label>
                                <div class="col-md-7">  
                            {!! Form::file('xml',array('class'=>'form-control')) !!}
                        </div> 
                           
                <hr style="color: #228B22; background-color: #228B22; height: 2px;">
                <div class="form-group">
                    <div class="col-md-12" align="center">
                        {!! Form::submit('Importar Arquivo', array('class' =>'btn btn-success')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>