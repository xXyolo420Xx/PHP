<!--Todo esto esto es obra mia hecha en la asignatura de DIW
Me ha parecido adecuado para utilizarlo en esta práctica-->
<?php ob_start(); ?>

<form method='POST' action=''>
	<div class='row'>
	    <div class="col-sm-6">
		    <div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		      <input id="nombre" type="text" value="<?php if(!empty($nombre)){echo $nombre ;} ?>" class="form-control" name="nombre" placeholder="Nombre">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
    </div>
    <div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		      <input id="apellidos" value="<?php if(!empty($apellidos)){echo $apellidos ;} ?>" type="text" class="form-control" name="apellidos" placeholder="Apellidos">
	       </div>
	    </div>
	    <div class='col-sm-6'></div>
    </div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
		      <input id="email" type="text" value="<?php if(!empty($email)){echo $email ;} ?>" class="form-control" name="email" placeholder="Correo electrónico">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
		      <input id="telefono" type="text" value="<?php if(!empty($telefono)){echo $telefono ;} ?>" class="form-control" name="telefono" placeholder="Numero de teléfono">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		      <input id="username" type="text" value="<?php if(!empty($username)){echo $username ;} ?>" class="form-control" name="username" placeholder="Nombre de usuario">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
		      <input id="password1" type="password" class="form-control" name="password1" placeholder="Contraseña">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='row'>
	    <div class="col-sm-6">
			<div class='input-group'>
		      <span class="input-group-addon"><i class="glyphicon glyphicon-eye-close"></i></span>
		      <input id="password2" type="password" class="form-control" name="password2" placeholder="Repite la contraseña">
		    </div>
	    </div>
	    <div class='col-sm-6'></div>
	</div>
	<div class='form-group'><br>
		<div class='row>'>
			<div class='col-sm-6'>
				<input id='enviar' class='btn-block btn btn-success' type='submit' name='regbtn' value='Registrarse'><br><br>
			</div>
		</div>
	</div><br><br>
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
<script>$(document).ready(function(){
	setBlurs();
	});
	</script>

<?php $content = ob_get_clean();
require("view/template.php");
?>