  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div class="panel panel-success">
        <div class="panel-body">
             @foreach($mvas as $mva)
                {!! Form::open(['url'=>'updatemva', 'method'=>'Post']) !!}
                <h3>Editando TABELA DE MVA</h3>
                <div class="form-group col-md-12">
                    <label class="col-md-6 control-label">CEST</label>
                    <div class="col-md-12">
                        {!! Form::number('cest', $mva->cest, array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-6 control-label">NCM</label>
                    <div class="col-md-12">
                        {!! Form::number('ncm', $mva->ncm, array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-6 control-label">Descrição</label>
                    <div class="col-md-12">
                        {!! Form::text('descricao', $mva->descricao, array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-12 control-label">MVA Op Interna</label>
                    <div class="col-md-12">
                        {!! Form::text('mva_op_interna', $mva->mva_op_interna, array('class'=>'form-control')) !!}
                    </div>
                    <label class="col-md-12 control-label">Alicota Interna</label>
                    <div class="col-md-12">
                        {!! Form::text('alicota_interna', $mva->alicota_interna, array('class'=>'form-control')) !!}
                    </div>
                     <label class="col-md-6 control-label">Alicota 7%</label>
                    <div class="col-md-12">
                       {!! Form::text('alicota_7', $mva->alicota_7, array('class'=>'form-control')) !!}
                    </div>
                     <label class="col-md-6 control-label">Alicota 12%</label>
                    <div class="col-md-12">
                       {!! Form::text('alicota_12', $mva->alicota_12, array('class'=>'form-control')) !!}
                    </div>
                     <label class="col-md-6 control-label">Alicota 4%</label>
                    <div class="col-md-12">
                       {!! Form::text('alicota_4', $mva->alicota_4, array('class'=>'form-control')) !!}
                    </div>
                </div>
                 <br>  
                 {{ Form::hidden('id', $mva->id ) }}            
                <hr style="color: #228B22; background-color: #228B22; height: 2px;">
                <div class="form-group">
                    <div class="col-md-12" align="center">
                        {!! Form::submit('Cadastrar', array('class' =>'btn btn-success')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                @endforeach
        </div>
    </div>
</div>