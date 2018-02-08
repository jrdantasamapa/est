<div class="panel panel-success">
    <div class="panel-body">
          {!! Form::open(['url'=>'pegaVlitem', 'method'=>'Post', 'files'=>true]) !!}
            <h3>Consulta XML - Calculo de ST</h3>
            <div class="form-group col-md-12">
                <label class="col-md-6 control-label">Selecione o Arquivo Calcular</label>
                    <div class="col-md-7">  
                        {!! Form::file('xml',array("id" => "filex", 'class'=>'form-control')) !!}
                    </div> 
			<div class="form-group">
                <div class="col-md-12" align="center">
                    {!! Form::submit('Calcular Arquivo', array('class' =>'btn btn-success')) !!}
                </div>
            </div>
            {!! Form::close() !!}
    	</div>
</div>
</div>
