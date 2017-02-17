<div align="right">
<div class="btn-group">
	@can('menu_cadastros')
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp; Cadastros
		<span class="caret"></span></button>
  		<ul class="dropdown-menu">
			@can('submenu_Usuarios')
			<li><a href="register"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Usuários</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_Papeis')
			<li><a href="registerpapel"><i class="fa fa-object-group" aria-hidden="true"></i>&nbsp; Papeis</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_Objeto')
			<li><a href="registerobjeto"><i class="fa fa-object-ungroup" aria-hidden="true"></i>&nbsp; Objeto</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_NCm')
			<li><a href="ncm"><i class="fa fa-industry" aria-hidden="true"></i>&nbsp; NCM</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_import_xml')
			<li><a href="xml"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Importar XML</a></li>
			<li role="separator" class="divider"></li>
			@endcan   
		</ul>
	@endcan
</div>
<div class="btn-group">
	@can('menu_impostos')
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;Impostos
		<span class="caret"></span></button>
  		<ul class="dropdown-menu">
			@can('submenu_st')
			<li><a href="calcularst"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Calcular ST</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_consulta_ST')
			<li><a href="consultaxml"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Consultar XML-ST</a></li>
			<li role="separator" class="divider"></li>
			@endcan
		</ul>
	@endcan
</div>
<div class="btn-group">
	@can('menu_listagem')
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Listagem
		<span class="caret"></span></button>
  		<ul class="dropdown-menu">
			@can('submenu_lista_usuarios')
			<li><a href="listausuario"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Listar Usuários</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_lista_papeis')
			<li><a href="listapapel"><i class="fa fa-cube" aria-hidden="true"></i>&nbsp; Listar Papeis</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_lista_objetos')
			<li><a href="listaobjeto"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp; Listar Objetos</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_lista_ncm')
			<li><a href="listancm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Listar NCM</a></li>
			<li role="separator" class="divider"></li>
			@endcan
		</ul>
	@endcan
</div>
</div>
<div class="col-md-12"> <hr style="color: #228B22; background-color: #228B22; height: 2px;"></div>


