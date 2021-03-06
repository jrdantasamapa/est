@section('header')
@extends('layouts.diasegomes')
@endsection
@section('content')
@include('templates.menu')
@if($url == 'lista')
    @include('xml.lista')
@elseif($url == 'view')
    @include('xml.view')
@elseif($url == 'edit')
    @include('xml.edit')
@elseif($url == 'create')
    @include('xml.inserir')
@elseif($url == 'consultaxml')
    @include('xml.consultaxml')
@elseif($url == 'consultapis')
    @include('xml.consultapis')
@elseif($url == 'chave')
    @include('xml.downloadXML')
@elseif($url == 'resultado')
    @include('xml.resultado')
@endif
@endsection

@section('scripts')
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