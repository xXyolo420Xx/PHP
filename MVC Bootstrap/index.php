<?php
session_start();
if(empty($_COOKIE['sessionexpire'])){
	unset($_SESSION);
	session_destroy();
	session_start();
}
if(!empty($_SESSION['user'])){
	setcookie("sessionexpire","sessionexpire", time()+1800);
}
require("controller/controller.php");
require('model/connection.php');
$paginas = array("info", "atomizadores", "mods", "pilas", "cargadores", "login", "register", "logout", "insert");
$pagina = null;

if(isset($_GET['pag'])){
	if(in_array($_GET['pag'], $paginas)){
		$pagina = $_GET['pag'];
	}else{
		$pagina = "info";
	}
}else{
	$pagina = "info";
}

if (isset($_POST['regbtn'])){
	$pagina = "checkReg";
}

if(isset($_POST['logbtn'])){
	$pagina = "checkLog";
}

if(isset($_POST['subir'])){
	$pagina = "checkSubida";
}
$con = new Controller();
switch ($pagina){
	case 'info':
		$con->info($pagina);
	break;
	case 'login':
		require("view/login.php");
	break;
	case 'checkLog':
		$con->checkLogin();
	break;
	case 'register':
		require("view/register.php");
	break;
	case 'checkReg':
		$con->checkReg();
	break;
	case 'logout':
		$con->logout();
	break;
	case 'insert':
		$con->insert();
	break;
	case "checkSubida":
		$con->subida();
	break;
	default:
		$con->lista($pagina);
}


?>