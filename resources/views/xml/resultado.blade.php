@section('header')
@extends('layouts.diasegomes')
@endsection
@section('content')
<br>
<div class="panel panel-success" align="center">
@include('templates.menu')
  <div class="panel-body" align="center">
    <h3>CÁLCULO DE SUBSTITUIÇÃO TRIBUTÁRIA<hr></h3>
	<div class="panel-heading panel-danger" align="left">
	@foreach($cabecalhos as $key => $cabecalho)
	<label>DADOS EMITENTE</label>
	<div>{{ $cabecalho['emitente']}}</div>
	<label>DADOS DESTINATARIO</label>
	<div>{{$cabecalho['destinatario']}}</div>
	
	@endforeach
	</div>
	

	@foreach($resultadoItens as $key => $resultadoIten)
	<div class="panel-group" id="{{$resultadoIten[0]}}">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#{{$resultadoIten[0]}}" href="#collapse1">
					Item </a>
				</h4>
			</div>
		<div id="collapse1" class="panel-collapse collapse in">
			<div class="panel-body">

			{{$resultadoIten[valorProduto]}}, $valorPis, $valorCofins, $bc1, $valorSuframa, $bc2, $valorIpi, $valorOutras, $valorFrete, $valorDescIncod, $bc3, $valorMva, $baseCalc, $alicotaInterna, $valorSub, $alicotaInterna, $valorIcms, $valorST


				</div>
			</div>
		</div>

	</div> 
    
 </div>
</div>
@endsection