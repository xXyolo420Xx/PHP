<?php ob_start() ?>
	
	<div class='page-header'>
		<h2>Lista de <?php echo $cosa ?> recomendados:</h2>
	</div>
	<div>
		<?php foreach($array as $item){ ?>
		<h3 class="bg-info"><a href=<?php echo $item['pagina']; ?>><?php echo $item['modelo']; ?></a></h3>
		<a href=<?php echo $item['compra']; ?> >
			<h4 class='list-group-item-heading'>Comprar por <?php echo $item['precio']; ?></h4>
			<p class='list-group-item-text'><?php echo $item['descripcion']; } ?></p>
		</a><br>
	</div>
	
	<div>
		<a href="?pag=insert" class="btn btn-success btn-lg">
      <span class="glyphicon glyphicon-cloud-upload"></span> Añadir producto</a>
	</div>

<?php $content = ob_get_clean();
require("view/template.php");
?>