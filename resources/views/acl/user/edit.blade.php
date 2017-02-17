    <div class="col-md-12">
            <div class="panel panel-success">
                   <div class="panel-body">
                   @foreach($usuarios as $usuario)
                    <form class="form-horizontal" role="form" method="POST" action="updateusuario{{$usuario->id}}">
                        {{ csrf_field() }}
                        
                        <h3>Editando Usuario {{ $usuario->name }}</h3>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            
                            <div class="col-md-6">
                                <input id="name" value="{{$usuario->name}}" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" value="{{$usuario->email}}" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                                          
                        <hr style="color: #228B22; background-color: #228B22; height: 2px;">
                            {{ Form::hidden('id', $usuario->id ) }}
                            @endforeach
                         <div class="form-group">
                        
                            <div class="col-md-12" align="center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-user fa-2x"> Alterar</i>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
  </div>
 </div>
