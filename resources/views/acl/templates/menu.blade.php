<div class="panel panel-success">
	<div class="panel-heading">
	@can('bt_cadastro_usuario')
	   <a href="{{ url('/register') }}" class="btn btn-success">Cadastrar Usuario</a>
	@endcan
	@can('bt_cadastro_papel')
	   <a href="{{ url('/registerpapel') }}" class="btn btn-success">Cadastrar Papel</a>
	@endcan 
	@can('bt_cadastro_objeto')
	   <a href="{{ url('/registerobjeto') }}" class="btn btn-success">Cadastrar Objeto</a>
	@endcan
	@can('bt_lista_usuario')
	   <a href="{{ url('/listausuario') }}" class="btn btn-success">Lista de Usuarios</a>
	@endcan
	@can('bt_lista_papel')
	   <a href="{{ url('/listapapel') }}" class="btn btn-success">Lista de Papeis</a>
	@endcan
	@can('bt_lista_objeto')
	   <a href="{{ url('/listaobjeto') }}" class="btn btn-success">Lista de Objetos</a>
	@endcan
	</div>
</div>
