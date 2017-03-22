<?php
function login(){
	echo "<html>
	<head>
		<meta charset='UTF8'>
	</head>

	<body>
		<h2>Login</h2>
		<form method='POST' action=''>
			<input type='text' name='userlogin' placeholder='Usuario'><br><br>
			<input type='password' name='passwordlogin' placeholder='Contraseña'><br><br>
			<input type='submit' name='entrar' value='Entrar'><br><br>
			<input type='submit' name='guest' value='Jugar como invitado'><br><br>
			<input type='submit' name='register' value='Registrarse'>
		</form>
	</body>
	</html>";
}

function checkLogin(){
	if(conexion::getDb()->entrarUser($_REQUEST['userlogin'], $_REQUEST['passwordlogin'])){
		$j = new Juego();
		$j->setJugador();
		$_SESSION['j'] = $j;
		$_SESSION['j']->setDiff();
	}else{
		echo "Usuario o contraseña incorrecto!";
	}
}
?>