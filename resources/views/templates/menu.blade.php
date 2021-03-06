

<nav class="navbar navbar-center navbar-fixed"">
  <!--  <div class="navbar-header" style="background-color: #FFFFFF;">

         Collapsed Hamburger 
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>-->
        <!-- Branding Image 
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('/logost.png')}}">
        </a>
    </div>-->
    <div class="btn-group">
	@can('menu_cadastros')
		<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp; Cadastros
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
			@can('submenu_certificado')
			<li><a href="#"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Instalar Certificado A1</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_mva')
			<li><a href="mva"><i class="fa fa-industry" aria-hidden="true"></i>&nbsp; Memoria de Calculo - MVA</a></li>
			<li role="separator" class="divider"></li>
			@endcan
		<!--	@can('submenu_import_xml')
			<li><a href="xml"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Importar XML</a></li>
			<li role="separator" class="divider"></li>
			@endcan -->   
		</ul>
	@endcan
</div>
<div class="btn-group">
	@can('menu_impostos')
		<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;Impostos
		<span class="caret"></span></button>
  		<ul class="dropdown-menu">
		<!--	@can('submenu_st')
			<li><a href="calcularst"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Calcular ST</a></li>
			<li role="separator" class="divider"></li>
			@endcan -->
			@can('submenu_consulta_ST')
			<li><a href="consultaxml"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Consultar XML-ST</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_consulta_PIS')
			<li><a href="consultapis"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Consultar XML-PIS/COFINS</a></li>
			<li role="separator" class="divider"></li>
			@endcan
		</ul>
	@endcan
</div>
<div class="btn-group">
	@can('menu_listagem')
		<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Listagem
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
			@can('submenu_lista_nmva')
			<li><a href="listamva"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Listar MVA</a></li>
			<li role="separator" class="divider"></li>
			@endcan
		</ul>
	@endcan
</div>
<div class="btn-group">
	@can('menu_consultaxml')
		<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp;Consultar XML
		<span class="caret"></span></button>
  		<ul class="dropdown-menu">
		<!--	@can('submenu_consultaxml_barras')
			<li><a href="barras"><i class="fa fa-barcode" aria-hidden="true"></i>&nbsp; Codigo de Barras</a></li>
			<li role="separator" class="divider"></li>
			@endcan
			@can('submenu_consultaxml_numero')
			<li><a href="numero"><i class="fa fa-th-list" aria-hidden="true"></i>&nbsp; Numero NFe</a></li>
			<li role="separator" class="divider"></li>
			@endcan -->
			@can('submenu_consultaxml_chave')
			<li><a href="chave"><i class="fa fa-barcode" aria-hidden="true"></i>&nbsp; Chave de Acesso</a></li>
			<li role="separator" class="divider"></li>
			@endcan
		<!--	@can('submenu_consultaxml_cnpj')
			<li><a href="cnpj"><i class="fa fa-retweet" aria-hidden="true"></i>&nbsp; Por CNPJ</a></li>
			<li role="separator" class="divider"></li>
			@endcan -->
		</ul>
	@endcan
</div>
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->

        <!-- Right Side Of Navbar-->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            @else
            	<a href="/">
                    <i class=" fa fa-btn fa-home fa-2x" ata-toggle="tooltip" data-placement="top" title="Home" aria-hidden="true"></i>
                </a>
               <a href="#">
                    <i class=" fa fa-btn fa-user fa-2x" ata-toggle="tooltip" data-placement="top" title="{{ Auth::user()->name }}" aria-hidden="true"></i>
                </a>
                 <a href="alterar">
                    <i class="fa fa-key fa-2x" ata-toggle="tooltip" data-placement="top" title="Alterar Senhas" aria-hidden="true"></i>
                </a>
                <a href="{{ url('/logout') }}">
                    <i class="fa fa-sign-out fa-2x" ata-toggle="tooltip" data-placement="top" title="Sair do Sistema" aria-hidden="true"></i>
                </a>
               
            @endif
        </ul>
    </div>
  </nav>





