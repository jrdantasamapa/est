@section('header')
@extends('layouts.diasegomes')
@endsection
@section('content')
@include('templates.menu')
@if($url == 'lista')
	@include('acl.user.lista')
@elseif($url == 'view')
    @include('acl.user.view')
@elseif($url == 'edit')
	@include('acl.user.edit')
@elseif($url == 'create')
	@include('acl.user.inserir')
@elseif($url == 'inserirpapel')
	@include('acl.user.papeis')
@elseif($url == 'senha')
    @include('acl.user.alt_senha')
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