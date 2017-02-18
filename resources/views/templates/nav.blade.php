<nav class="navbar navbar-light navbar-fixed" style="background-color: #FFFFFF;">
    <div class="navbar-header" style="background-color: #FFFFFF;">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('/logost.png')}}">
        </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->

        <!-- Right Side Of Navbar-->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            @else
               <a href="#">
                    <i class=" fa fa-btn fa-user fa-3x" ata-toggle="tooltip" data-placement="top" title="{{ Auth::user()->name }}" aria-hidden="true"></i>
                </a>
                 <a href="alterar">
                    <i class="fa fa-key fa-3x" ata-toggle="tooltip" data-placement="top" title="Alterar Senhas" aria-hidden="true"></i>
                </a>
                <a href="{{ url('/logout') }}">
                    <i class="fa fa-sign-out fa-3x" ata-toggle="tooltip" data-placement="top" title="Sair do Sistema" aria-hidden="true"></i>
                </a>
               
            @endif
        </ul>
    </div>
  </nav>

<br>
<br>
