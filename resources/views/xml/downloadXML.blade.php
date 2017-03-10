<div class="col-md-2"></div>
<div class="panel panel-success col-md-8">
    <div class="panel-body">
        {!! Form::open(['url'=>'xmlchave', 'method'=>'Post', 'files'=>true]) !!}
            <h3>Consulta de NFe pela Chave</h3>
            <div class="col-md-12"> <hr style="color: #228B22; background-color: #228B22; height: 1px;"></div>
            <div class="form-group col-md-12">
                <img src="{{$captcha}}">
            <div class="col-md-5">
            {!! Form::text('captcha', '', array('class'=>'form-control'))!!}
            </div>
        <br>
            <div class="col-md-12">
                Digite a Chave
                {!! Form::text('chave', '', array('class'=>'form-control'))!!}
            </div>
            <div class="col-md-12">
                Senha:
                <input id="password inputPassword" type="password" class="form-control" name="senha" placeholder="Informe sua senha">
            </div>
            <div class="col-md-12">
                CNPJ:
                {!! Form::text('cnpj', '', array('class'=>'form-control'))!!}
            </div>
            </div> 
        <div class="form-group">
        <div class="col-md-12" align="center">
        {!! Form::submit('Consultar', array('class' =>'btn btn-success')) !!}
        </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="col-md-2"></div>
