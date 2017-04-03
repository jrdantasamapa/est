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
      <?php
      	echo($resultado);
      ?>
 </div>