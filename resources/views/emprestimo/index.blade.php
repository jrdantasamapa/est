@extends('layouts.app')
@section('header')
@include('templates.nav')
@endsection
@section('content')
@if($url == 'lista')
	@include('emprestimo.lista')
@elseif($url == 'view')
    @include('emprestimo.view')
@elseif($url == 'edit')
	@include('emprestimo.edit')
@elseif($url == 'create')
	@include('emprestimo.inserir')
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