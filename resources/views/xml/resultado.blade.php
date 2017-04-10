<script>
$(document).ready(function(){
  //Escondendo campos quando carregar página
   $('#ctl00_ContentPlaceHolder1_divBotoesConsulta, #menu').hide();
});
</script>
<div align="right">
	<div class="btn-group">
	<a href="/" class="btn btn-primary" role="button">Menu Principal</a>
	<a href="#" class="btn btn-primary" role="button">Gera XML</a>
	<a href="#" class="btn btn-primary" role="button">Gravar</a>
	<a href="chave" class="btn btn-primary" role="button">Nova Consulta</a>
	</div>
	<div class="col-md-12"> <hr style="color: #228B22; background-color: #228B22; height: 2px;"></div>
</div>
<div class="panel panel-success col-md-12">
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
			<td class="fixo-prod-serv-numero">
				<span>Detalhamento </span>
			</td>
		</tr>
	</table>
	<table class="toggable box" style="background-color:#ECECEC">
		<tr>
			<td> 
				<span>Código</span> 
			</td>
			<td> 
				<span>Descrição</span> 
			</td>
			<td> 
				<span>Valor</span> 
			</td>
			<td> 
				<span>MVA</span> 
			</td>
			<td> 
				<span>Credito ICMS</span> 
			</td>
			<td> 
				<span>Débito ICMS</span> 
			</td>
		</tr>
	</table>
      <?php
      	echo($resultado);
      ?>
 </div>