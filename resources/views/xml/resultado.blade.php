<script>
$(document).ready(function(){
  //Escondendo campos quando carregar página
   $('#ctl00_ContentPlaceHolder1_divBotoesConsulta, #menu').hide();
});
</script>
<div align="right">
	<div class="btn-group">
	<a href="/" class="btn btn-primary" role="button">Menu Principal</a>
	<a href="chave" class="btn btn-primary" role="button">Nova Consulta</a>
	</div>
	<div class="col-md-12"> <hr style="color: #228B22; background-color: #228B22; height: 2px;"></div>
</div>
<<<<<<< HEAD

	<div class="GeralXslt panel panel-info col-md-12">
		<div class="panel-heading">
			<fieldset>
			<legend>RESULTADO DE CALCULO DE SUBSTITUIÇÃO TRIBUTÁRIA</legend>
			<table class="box">
			<tbody>
			<tr>
			<td>
				<label>Nfe nª</label>
				<span>0675</span>
			</td>
			<td>
				<label>Valor Total</label>
				<span>R$ 333333</span>
			</td>
			<td>
				<label>Descontos</label>
				<span>R$ 3.10</span>
			</td>
			<td>
				<label>Valor Tributável</label>
				<span>R$ 3.10</span>
			</td>
			<td>
				<label>Crédito ICMS</label>
				<span>R$ 3.10</span>
			</td>
			<td>
				<label>Débito ICMS</label>
				<span>R$ 3.10</span>
			</td>
			<td>
				<label>Valor ST</label>
				<span>R$ 3.10</span>
			</td>
			</tr>
			</tbody>
			</table>
			</fieldset>
		
		<table class="toggle box">
		<tr class="highlighted">
		<td>
		<span>Detalhamento</span>
		</td>
		</tr>
		</table>
		<table class="toggable box table-striped col-md-12" style="background-color:#ECECEC; font-size: 12px;" align="center">
		<thead  align="center">
		</thead>
		<tbody align="center">
		@for ($i=0; $i < $nitem; $i++)
			<tr>
				<td>
					{{ $dados['item'][$i] }}
				</td>
				<td align="left">
					{{ $dados['descricao'][$i] }}
				</td>
				<td>
				 {{ $dados['unidade'][$i] }}
				</td>
				<td>
					{{ $dados['quantidade'][$i] }}
				</td>
				<td>
					{{ $dados['valor'][$i] }}
				</td>
			</tr>
		@endfor     
		</tbody>
		</table>
		<a href="#" class="btn btn-info" role="button">Imprimir</a>
</div>
<div class="GeralXslt panel-body col-md-12">
<h3 align="center">Dados da NFe</h3>
      <?php
      	echo($resultado);
      ?>
</div>
</div>
=======
<div class="panel panel-success col-md-12">
      <?php
      	echo($resultado);
      ?>
      	<div class="GeralXslt">
		<h1></h1>
		<fieldset>
			<legend>RESULTADO DE CALCULO DE SUBSTITUIÇÃO TRIBUTÁRIA</legend>
			<table class="box">
				<tbody>
					<tr>
						<td>
							<label>Nfe nª</label>
							<span>0675</span>
						</td>
						<td>
							<label>Valor Total</label>
							<span>R$ 333333</span>
						</td>
						<td>
							<label>Descontos</label>
							<span>R$ 3.10</span>
						</td>
						<td>
							<label>Valor Tributável</label>
							<span>R$ 3.10</span>
						</td>
						<td>
							<label>Crédito ICMS</label>
							<span>R$ 3.10</span>
						</td>
						<td>
							<label>Débito ICMS</label>
							<span>R$ 3.10</span>
						</td>
						<td>
							<label>Valor ST</label>
							<span>R$ 3.10</span>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</div>
	<table class="toggle box">
		<tr class="highlighted">
			<td>
				<span>Detalhamento</span>
			</td>
		</tr>
	</table>
  <table class="toggable box" style="background-color:#ECECEC">
    <thead>
      <tr>
        <th>Nº Item</th>
        <th>Operação</th>
        <th>Descrição</th>
        <th>Valor</th>
        <th>MVA</th>
        <th>Cred. ICMS</th>
        <th>Deb. ICMS</th>
        <th>Vl. Sub. Trib</th>
      </tr>
    </thead>
    <tbody>
      @foreach($desc as $descricao)
      <tr>
			<td></td>
			<td></td>
			<td>
				{{ $descricao->nodeValue }}
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td> 
     </tr>
 		@endforeach	     
    </tbody>
  </table>

	<a href="#" class="btn btn-info" role="button">Imprimir</a>
 </div>
>>>>>>> 3ece211dfb086583ad12ded47d0028d0af9e3885
