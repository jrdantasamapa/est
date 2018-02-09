@section('header')
@extends('layouts.diasegomes')
@endsection
 <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-success">
        <div class="panel-body">
             {!! Form::open(['url'=>'inserirncm', 'method'=>'Post']) !!}
                <h3>Cadastrando NCM </h3>
                <div class="form-group col-md-12">
                    <label class="col-md-6 control-label">NCM</label>
                    <div class="col-md-12">
                        {!! Form::number('NCM', '', array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-6 control-label">MVA</label>
                    <div class="col-md-12">
                        {!! Form::number('MVA', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">Alicota Interna</label>
                    <div class="col-md-12">
                        {!! Form::number('al_interna', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">Redução</label>
                    <div class="col-md-12">
                        {!! Form::number('reducao', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">PIS/COFINS</label>
                    <div class="col-md-12">
                        {!! Form::select('piscofins', array('Sim'=>'Sim','Não'=>'Não'),'', array('class'=>'form-control')) !!}
                    </div>
                </div>
                  {{ Form::hidden('status', '1' ) }}
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