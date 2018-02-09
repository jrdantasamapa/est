<!DOCTYPE html>
<html ng-app="eST">
<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="rgb(205, 50, 54)">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: DIAS &amp; GOMES - Contabilidade e Consultoria Empresarial ::</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/logo.ico')}}">
  <link href="{{asset('/css/estilo.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('/css/lightbox.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|PT+Sans+Narrow" rel="stylesheet">
   <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.theme.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.structure.min.css')}}">
   <script src="{{asset('/js/jquery.min.js')}}"></script>
   <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/bootstrap.min.css')}}">
   <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/sweetalert.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.theme.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.structure.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/fullcalendar.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/fullcalendar.print.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/data-grid.css')}}">
  








<script type="text/javascript">
$(document).on("scroll",function(){
    if($(document).scrollTop()>200){ //QUANDO O SCROLL PASSAR DOS 100px DO TOPO
        $("#menu").removeClass("large").addClass("small"); //ALTERAR O TAMANHO
    } else{
        $("#menu").removeClass("small").addClass("large"); //VOLTA PARA O TAMANHO ORIGINAL
    }
});
</script>

</head>

<body>
<header class="header">
<div id="total">
    <div class="container between topo">
        <div class="logo">
            <a href="http://diasegomes.com/index.php"><img src="imagens/logost.png" width="100%" height="auto"></a>
        </div>
        
        <!---->

        <div class="redes">
            <a href="https://www.facebook.com/diasegomescontabilidade/" target="_blank" class="fa fa-facebook sociais" aria-hidden="true"></a>
            <a href="https://www.instagram.com/diasegomescontabilidade/" target="_blank" class="fa fa-instagram sociais" aria-hidden="true"></a>
            <a href="/webmail" target="_blank" class="fa fa-envelope-o envelope sociais" aria-hidden="true"></a>
            <a href="https://diasegomes.sabesim.com/" target="_blank" class="sociais" style="background: rgb(255, 255, 255);"><img src="imagens/sabesim.png"></a>
        </div>
        
       
    </div>
    
    <!---->
    
    <nav id="menu" class="large">
        <ul class="mainmenu">
            <li><a href="http://diasegomes.com/index.php">Home</a></li>
            <li><a>Institucional</a>
                <ul class="submenu">
                    <li><a href="http://diasegomes.com/institucional.php"><i class="fa fa-external-link" aria-hidden="true"></i> Institucional</a></li>
                    <li><a href="http://diasegomes.com/missao.php"><i class="fa fa-external-link" aria-hidden="true"></i> Missão/Visão/Valores</a></li>
                    <li><a href="http://diasegomes.com/estrutura.php"><i class="fa fa-external-link" aria-hidden="true"></i> Estrutura</a></li>
                    <li><a href="http://diasegomes.com/equipe.php"><i class="fa fa-external-link" aria-hidden="true"></i> Equipe</a></li>
                </ul>
            </li>
            <li><a>Serviços</a>
                <ul class="submenu">
                    <li><a href="http://diasegomes.com/servicos.php"><i class="fa fa-external-link" aria-hidden="true"></i> Nossos Serviços</a></li>
                    <li><a href="http://diasegomes.com/publico.php"><i class="fa fa-external-link" aria-hidden="true"></i> Público alvo: A quem se destina?</a></li>
                </ul>
            </li>
            <li><a href="http://diasegomes.com/consultas.php">Consultas</a></li>
            <li><a>Informativos DG</a>
                <ul class="submenu">
                    <li><a onclick="popup();"><i class="fa fa-external-link" aria-hidden="true"></i> Informativos</a></li>
                    <li><a href=""><i class="fa fa-external-link" aria-hidden="true"></i> DG Responde</a></li>
                </ul>
            </li>
            <li><a href="http://diasegomes.com/contato.php">Contato</a>
<!--
                <ul class="submenu">
                    <li><a><i class="fa fa-external-link" aria-hidden="true"></i> Fale Conosco</a></li>
                    <li><a href=""><i class="fa fa-external-link" aria-hidden="true"></i> Cotação de Serviços</a></li>
                    <li><a href=""><i class="fa fa-external-link" aria-hidden="true"></i> Dúvidas frequentes</a></li>
                </ul>
-->
            </li>
        </ul>
    <select><option value="http://diasegomes.com/index.php">Home</option><option>Institucional</option><option value="http://diasegomes.com/institucional.php"> Institucional</option><option value="http://diasegomes.com/missao.php"> Missão/Visão/Valores</option><option value="estrutura.php"> Estrutura</option><option value="http://diasegomes.com/equipe.php"> Equipe</option><option>Serviços</option><option value="http://diasegomes.com/servicos.php"> Nossos Serviços</option><option value="http://diasegomes.com/publico.php"> Público alvo: A quem se destina?</option><option value="http://diasegomes.com/consultas.php">Consultas</option><option>Informativos DG</option><option> Informativos</option><option value=""> DG Responde</option><option value="http://diasegomes.com/contato.php">Contato</option></select>
    </nav>
    
    <script type="text/javascript">
       $(function(){
        // Create the dropdown base
        $("<select />").appendTo("#menu");

        // Create default option "Go to..."
        $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Menu Principal..."
        }).appendTo(".menu select");

        // Populate dropdown with menu items
        $("#menu li a").each(function() {
         var el = $(this);
         $("<option />", {
          "value"   : el.attr("href"),
          "text"    : el.text()
         }).appendTo("#menu select");
        });

        $("#menu select").change(function() {
         window.location = $(this).find("option:selected").val();
        });
       });
    </script>
</div>


  </header>
<br>
 <div class="container">
    @yield('content')
  </div>
  @section('scripts')
  <script src="{{asset('/js/jquery.min.js')}}"></script>
  <script src="{{asset('/js/data-grid.js')}}"></script>
 <!-- <script src="http://www.sitecontabil.com.br/jquery/jquery.js" type="text/javascript"></script> -->
<script src="http://www.sitecontabil.com.br/jquery/cycle2.js" type="text/javascript"></script>
<script src="http://diasegomes.com/js/script.js" type="text/javascript"></script>
<script src="http://diasegomes.com/lightbox/js/lightbox.min.js" language="javascript"></script>
<!-- Start of HubSpot Embed Code -->

  <script type="text/javascript" src="{{asset('/js/sweetalert.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/bootstrap-datetimepicker.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/fullcalendar.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/jquery-2.2.2.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/jquery-ui.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/datepicker-pt-BR.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/jquery.maskedinput.min.js')}}"></script>
 
  @show
<script type="text/javascript">
$(function() {
    $( "#datepicker3" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
  $(function() {
    $( "#datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd 00:00:00',
      changeMonth: true,
      changeYear: true
    });
  });
  $(function() {
    $( "#datepicker1" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
  $(function() {
    $( "#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
   

  $("#Telefone").mask("(99) 9999-9999");
  $("#Telefone1").mask("(99) 9999-9999");
  $("#Celular").mask("(99) 99999-9999");
  $("#Cpf").mask("999.999.999-99");
  
  
  </script>

  <footer>
    @yield('footer')
  </footer>

</body>

</html>
 