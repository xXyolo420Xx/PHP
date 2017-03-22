<?php
class Controller{
	public function info(){
		require('view/inicio.php');
	}
	public function lista($cosa){
		$array = Connection::getTable($cosa);
		require('view/template2.php');
	}
	public function checkLogin(){
		$username = $_POST['username'];
		$password = $_POST['password'];

		//Comprobamos que este correcta la password
		$hash = Connection::getUser($username);
		if(password_verify($password, $hash)){
			$lastlogin = Connection::getLastLogin($username);
			$newlogin ="Último login el dia. ".date("d/m/Y")." a las ".date('H:i:s'); 
			Connection::setLastLogin($username, $newlogin);
			$_SESSION['user'] = $username;
			$_SESSION['lastlogin'] = $lastlogin;
			setcookie("sessionexpire","sessionexpire",time()+1800);
			$respuesta = "Bienvenido/a $_SESSION[user]";
			$pag = "<a href='?pag=info'>Volver al inicio</a>";
			require("view/resultado.php");
		}else{
			$respuesta[] = "Nombre de usuario o contraseña incorrecta";
			require("view/login.php");
		}
		
	}
	public function logout(){
		$_SESSION['user'] = null;
		unset($_SESSION);
		session_destroy();
		setcookie("sessionexpire","sessionexpire", time()-20);
		unset($_COOKIE);

		if(@$_SESSION['user'] == null){
			$respuesta = "Sesión cerrada con éxito";
		}
		$pag = "<a href='?pag=info'>Volver al inicio</a>";
		require("view/resultado.php");
	}
	public function insert(){
		if(empty($_SESSION['user'])){
			$respuesta = "Necesitas estar registrado para poder insertar nuevos productos.";
			$pag = "<a href='?pag=register'>Registrarse</a>";
			require('view/resultado.php');
		}else{
			require("view/insert.php");
		}
	}
	public function subida(){
		$modelo = strip_tags($_POST['modelo']);
		$pagina = strip_tags($_POST['pagina']);
		$compra = strip_tags($_POST['compra']);
		$precio = strip_tags($_POST['precio']);
		$descripcion = strip_tags($_POST['descripcion']);
		$categoria = strip_tags($_POST['categoria']);

		$respuesta = array();

		if(strlen($modelo)<2){
			$respuesta[] = "El nombre del modelo no es válido.<br>";
		}
		if(strlen($pagina)<5){
			$respuesta[] = "La url de la página no es válida.<br>";
		}
		if(strlen($compra)<5){
			$respuesta[] = "La url de la página de compra no es válida.<br>";
		}
		if(strlen($precio)<1){
			$respuesta[] = "El precio introducido no es válido.<br>";
		}
		if(strlen($descripcion)<20){
			$respuesta[] = "Inserta una descripción decente.<br>";
		}
		if($categoria == 'error'){
			$respuesta[] = "Olvidastes poner la categoría.<br>";
		}

		//Si todo esta correcto:
		if(empty($respuesta)){
			if(Connection::upload($modelo, $pagina, $compra, $precio, $descripcion, $categoria)){
				$respuesta = "Producto añadido con éxito.";
				$pag = "<a href='?pag=$categoria'>Ver producto añadido</a>";
				require("view/resultado.php");
			}else{
				$respuesta [] = "Se ha producido un error subiendo el nuevo producto";
			}
		}else{
			require("view/insert.php");
		}
		

	}
	public function checkReg(){
		$nombre = strip_tags($_POST['nombre']);
		$apellidos = strip_tags($_POST['apellidos']);
		$email = strip_tags($_POST['email']);
		$telefono = strip_tags($_POST['telefono']);
		$username = strip_tags($_POST['username']);
		$pass1 = strip_tags($_POST['password1']);
		$pass2 = strip_tags($_POST['password2']);
		$lastlogin = "Último login el dia. ".date("d/m/Y")." a las ".date('H:i:s'); 
		$respuesta = array();

		//Comprobamos los campos del formulario
		if($pass1 !== $pass2){
			$respuesta[] = "Las contraseñas no coinciden.<br>";
		}
		if(strlen($pass1)<6 || strlen($pass2)<6){
			$respuesta[] = "La contraseña debe ser de al menos 6 caracteres.<br>";
		}
		if(strlen($username)<2){
			$respuesta[] = "El nombre de usuario debe tener al menos 2 caracteres. Ejemplo: 'Ed'<br>";
		}
		if(strlen($apellidos)<5){
			$respuesta[] = "Pon tus apellidos<br>";
		}
		if(substr_count($email, "@") != 1 || substr_count($email, ".")<1){
			$respuesta[] = "El formato de email no es válido.<br>";
		}
		if(strlen($telefono)<9){
			$respuesta[] = "El teléfono no es válido<br>";
		}

		//Comprobamos que el usuario no este ya registrado
		$array = Connection::getTable('users');
		if(!empty($array)){
			foreach($array as $user){
				if ($user['username'] == $username){
					$respuesta[] = "El nombre de usuario ya esta en uso.<br>";
					$pag = "<a href='?pag=register'>Volver</a>";
				}
				if($user['email'] == $email){
					$respuesta[] = "Este email ya esta registrado!";
					$pag = "<a href='?pag=register'>Volver</a>";
				}
			}
		}

		//Si esta todo correcto creamos el hash de la contraseña y registramos el usuario en la ddbb
		$hash = password_hash($pass1, PASSWORD_DEFAULT);
		if(empty($respuesta)){
			if(Connection::regUser($nombre, $apellidos, $email, $telefono, $username, $hash, $lastlogin)){
				$respuesta = $username.' te has registrado con éxito!';
				$pag = "<a href='?pag=login'>Login</a>";
				require('view/resultado.php');
			}else{
				$respuesta[] = 'Error registrando el usuario en la BBDD';
			}
		}else{
			require("view/register.php");
		}


	}
}

?>