<!DOCTYPE html>
<html ng-app="eST">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-ST</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/logo.ico')}}">
  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/font-awesome.min.css')}}">
  <!-- Styles -->
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/sweetalert.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.theme.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/jquery-ui.structure.min.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/fullcalendar.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('/css/fullcalendar.print.css')}}">
  <script src="{{asset('./js/jquery.min.js')}}"></script>

   

 
  <style>
    body {
      background-color: #CDC9C9;
     /*  font-size: 100%; */
    }
    img {
      max-width: 100%;
    }
    @media screen and (max-width: 1024px) {
   /*estilos*/
    }

  </style>
</head>
<body>
  <header class="header">
    @yield('header')
  </header>
  <div class="container">
    @yield('content')
  </div>

  @section('scripts')
  <script type="text/javascript" src="{{asset('/js/sweetalert.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/bootstrap-datetimepicker.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/fullcalendar.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/jquery-1.10.2.js')}}"></script>
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

