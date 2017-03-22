<!--Todo esto esto es obra mia hecha en la asignatura de DIW
Me ha parecido adecuado para utilizarlo en esta práctica-->
<?php ob_start(); ?>

<form method='POST' action=''>
	
	
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		      <input id="username" type="text" value='<?php if(!empty($username)){echo $username; }; ?>' class="form-control" name="username" placeholder="Nombre de usuario">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
		      <input id="password1" type="password" class="form-control" name="password" placeholder="Contraseña">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='form-group'><br>
		<div class='row>'>
			<div class='col-sm-6'>
				<input id='enviar' class='btn-block btn btn-success' type='submit' name='logbtn' value='Login'><br><br>
			</div>
		</div>
	</div>
	<br><br>
	<?php if(!empty($respuesta)){
			echo "<br><br><div class='jumbotron'>";
			echo "<ul class='list-group'>";
			foreach($respuesta as $error){
				echo "<li class='list-group-item list-group-item-danger'>".$error."</li>";
			}
			echo "</ul></div>";
		} ?>
</form>


<!--Una vez cargado el documento iniciamos los eventListeners de los campos del formulario-->

<?php $content = ob_get_clean();
require("view/template.php");
?>