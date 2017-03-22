<?php ob_start() ?>
	
	<div class='page-header'>
		<h2>¿Que son los vapeadores?</h2>
	</div>
	<h4>Los vapeadores son mas conocidos por el nombre de cigarrillos electrónicos.</h4>
	<h4>Son aparatos electrónicos que producen vapor para inhalar y producir sensaciones de eufória y felicidad.</h4>

	<div>
	<h3 class="bg-info">Esta formado por:</h3>
		<a href="?pag=atomizadores">
			<h4 class='list-group-item-heading'>Atomizador</h4>
			<p class='list-group-item-text'>Es el núcleo del vapeador donde se produce el vapor</p>
		</a><br>
		<a href="?pag=mods">
			<h4 class='list-group-item-heading'>Mod</h4>
			<p class='list-group-item-text'>Es la parte encargada de regular y transmitir la electricidad para que el atomizador funcione</p>
		</a>
	</div>
	<div class='list-group'>
	<h3 class="bg-info">Ademas necesita:</h3>
		<a href="?pag=pilas">
			<h4 class='list-group-item-heading'>Pilas</h4>
			<p class='list-group-item-text'>Para dar corriente al mod</p>
		</a><br>
		<a href="?pag=cargadores">
			<h4 class='list-group-item-heading'>Cargador</h4>
			<p class='list-group-item-text'>Para poder cargar las pilas</p>
		</a>
	</div>

<?php $content = ob_get_clean();
require("view/template.php");
?>