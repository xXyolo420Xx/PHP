<?php
function registro(){
	echo "<html>
	<head>
		<meta charset='UTF8'>
	</head>

	<body>
		<h2>Alta de nuevo usuario</h2>
		<form method='POST' action=''>
			<input type='text' name='nomus' placeholder='Usuario'><br><br>
			<input type='text' name='nombre_user' placeholder='Nombre'><br><br>
			<input type='text' name='apellidos_user' placeholder='Apellidos'><br><br>
			<input type='email' name='email_user' placeholder='Correo electrónico'><br><br>
			<input type='password' name='pass1' placeholder='Contraseña'><br><br>
			<input type='password' name='pass2' placeholder='Repite la contraseña'><br><br>
			<input type='submit' name='reguser' value='Registrarse'><br><br>
			<input type='submit' name='login' value='Volver'><br><br>
		</form>
	</body>
	</html>";
}

function checkRegistro(){
	if(empty($_REQUEST['nomus'])){
		echo "Introduce un nombre de usuario!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}elseif($_REQUEST['pass1'] !== $_REQUEST['pass2']){
		echo "Las contraseñas no coinciden!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}elseif(strlen($_REQUEST['nomus'])<4){
		echo "Escoge un nombre de usuario de al menos 4 carácteres!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}elseif(strlen($_REQUEST['pass1'])<6){
		echo "Escoge un contraseña de usuario de al menos 6 carácteres!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}elseif(strlen($_REQUEST['nombre_user'])<3){
		echo "Pon un nombre válido!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}elseif(strlen($_REQUEST['apellidos_user'])<4){
		echo "Pon un apellido de verdad!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}elseif(strlen($_REQUEST['email_user'])<5){
		echo "Ese email no es válido!";
		echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
	}else{
		if(conexion::getDb()->regUser($_REQUEST['nomus'], $_REQUEST['pass1'], $_REQUEST['nombre_user'], $_REQUEST['apellidos_user'], $_REQUEST['email_user'], date('Y-m-d'))){
			echo "Usuario registrado con éxito!";
			login();
		}else{
			echo "El usuario ya existe!";
			echo "<br><br><form method='POST' action=''><input type='submit' name='register' value='Volver'><br><br></form>";
		}
	}
}
?>
