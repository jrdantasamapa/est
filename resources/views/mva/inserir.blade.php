  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-success">
        <div class="panel-body">
             {!! Form::open(['url'=>'inserirmva', 'method'=>'Post']) !!}
                <h3>Cadastrando MVA </h3>
                <div class="form-group col-md-12">
                    <label class="col-md-6 control-label">CEST</label>
                    <div class="col-md-12">
                        {!! Form::number('cest', '', array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-6 control-label">NCM</label>
                    <div class="col-md-12">
                        {!! Form::number('ncm', '', array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-6 control-label">Descrição</label>
                    <div class="col-md-12">
                        {!! Form::text('descricao', '', array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-6 control-label">MVA Op Interna</label>
                    <div class="col-md-12">
                        {!! Form::number('mva_op_interna', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">Alicota Interna</label>
                    <div class="col-md-12">
                        {!! Form::number('alicota_interna', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">Alicota 7%</label>
                    <div class="col-md-12">
                        {!! Form::number('alicota_7', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">Alicota 12%</label>
                    <div class="col-md-12">
                        {!! Form::number('alicota_12', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
                    </div>
                    <label class="col-md-6 control-label">Alicota 4%</label>
                    <div class="col-md-12">
                        {!! Form::number('alicota_4', '', array('class'=>'form-control', 'step'=>'0.10')) !!}
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