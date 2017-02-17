@extends('layouts.app')
@section('header')
@include('templates.nav')
@endsection
@section('content')
@include('templates.menu')

@if($url == 'lista')
	@include('acl.papel.lista')
@elseif($url == 'view')
    @include('acl.papel.view')
@elseif($url == 'edit')
	@include('acl.papel.edit')
@elseif($url == 'create')
	@include('acl.papel.inserir')
@elseif($url == 'inserirobj')
	@include('acl.papel.objeto')
@elseif($url == 'ficha')
	@include('acl.papel.ficha')
@endif
@endsection

@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
  $('#selectOculto').hide();
  $('#TextareaOculto').hide();
  
  $('.dtfinal').change(function() {
    if ($('#datepicker').val() >= $('#datepicker1').val()){
      alert('Data Final menor que data Inicial');
    }else{
      if($('#select').val() == '1')
        alert('Selecione um acolhido');
    }

    if ($('#mySelect').val() == '2') {

    } else {

    }
  });
});
</script>
@parent
@if (notify()->ready())
<script type="text/javascript">
  swal({
    title:"{!! notify()->message() !!}",
    text: "{!! notify()->option('text') !!}",
    type: "{!! notify()->type() !!}",
    @if(notify()->option('timer'))
    timer: "{!! notify()->option('timer') !!}",
    showConfirmButton: false
    @endif
});
</script>
@endif
@stop