<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-success">
               <div class="panel-heading">Resetar Senha " {{ Auth::user()->name }} "</div>
                <div class="panel-body">
                {!! Form::open(['url'=> 'updatesenha', 'method'=>'post']) !!}
                  
                   <div class="form-group col-md-12"> 
                        <label class="col-md-4 control-label">Senha Atual</label>
                         <input id="password" type="password" class="form-control" name="senhaatual">
                   </div>
                   <div class="form-group col-md-12"> 
                        <label class="col-md-4 control-label">Nova Senha</label>
                         <input id="password" type="password" class="form-control" name="password">
                   </div>
                   <div class="form-group col-md-12"> 
                        <label class="col-md-4 control-label">Confirmação</label>
                        <input id="password" type="password" class="form-control" name="confirma">
                   </div>
                   <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-btn fa-refresh"></i> Resetar Senha
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>

