@section('header')
@extends('layouts.diasegomes')
@endsection
@section('content')
@include('templates.menu')
@if($url == 'lista')
	@include('mva.lista')
@elseif($url == 'view')
    @include('mva.view')
@elseif($url == 'edit')
	@include('mva.edit')
@elseif($url == 'create')
	@include('mva.inserir')
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