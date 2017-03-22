<!--Todo esto esto es obra mia hecha en la asignatura de DIW
Me ha parecido adecuado para utilizarlo en esta práctica-->
<?php ob_start(); ?>

<form method='POST' action=''>
<div class='container'>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
		      <input value='<?php if(!empty($modelo)){echo $modelo;} ?>' type="text" class="form-control" name="modelo" placeholder="Modelo">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
		      <input type="text" value='<?php if(!empty($pagina)){echo $pagina;} ?>' class="form-control" name="pagina" placeholder="Página">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span>
		      <input type="text" class="form-control" value='<?php if(!empty($compra)){echo $compra;} ?>' name="compra" placeholder="Página para comprar">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
		<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
		      <input type="text" value='<?php if(!empty($precio)){echo $precio;} ?>' class="form-control" name="precio" placeholder="Precio">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
		<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
		       <textarea class="form-control" rows="5" placeholder="Descripción" name='descripcion'><?php if(!empty($descripcion)){echo $descripcion; } ?></textarea>
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'><br>
		      <label for="subir">Selecciona la categoria</label>
			      <select class="form-control" name="categoria">
			      <option value='error'>Selecciona una categoria...</option>
			        <option value='atomizadores'>Atomizadores</option>
			        <option value='mods'>Mods</option>
			        <option value='pilas'>Pilas</option>
			        <option value='cargadores'>Cargadores</option>
			      </select>
		    </div>
	    </div><br>
	    <div class='col-sm-6'></div>
	</div>
	<div class='form-group'><br>
		<div class='row>'>
			<div class='col-sm-6'>
				<input class='btn-block btn btn-success' type='submit' name='subir' value='Subir'><br><br>
			</div>
		</div>
	</div>
		<?php if(!empty($respuesta)){
			echo "<br><br><div class='jumbotron'>";
			echo "<ul class='list-group'>";
			foreach($respuesta as $error){
				echo "<li class='list-group-item list-group-item-danger'>".$error."</li>";
			}
			echo "</ul></div>";
		} ?>
</div>
</form>
<?php $content = ob_get_clean();
require("view/template.php");
?>