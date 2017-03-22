<?php ob_start() ?>
	
	<div class='page-header'>
		<h2><?php echo $respuesta ?></h2>
	</div>
	<div>
		<?php echo $pag ?>
	</div>
<?php $content = ob_get_clean();
require("view/template.php");
?>