<?php
require('login.php');
require('registro.php');
require('conexion.php');
require('juego.php');

session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST' || isset($_REQUEST['login'])){
	login();
}elseif(isset($_REQUEST['register'])){
	registro();
}elseif(isset($_REQUEST['entrar'])){
	checkLogin();
}elseif(isset($_REQUEST['guest'])){
	if(!isset($_COOKIE['guest'])){
		conexion::getDb()->resetGuest();
		setcookie("guest","3", time()+86400);
		$j = new Juego();
		$j->setJugador(1);
		$_SESSION['j'] = $j;
		$_SESSION['j']->setDiff();
	}else{
		if(conexion::getDb()->canPlay()){
		$j = new Juego();
		$j->setJugador(1);
		$_SESSION['j'] = $j;
		$_SESSION['j']->setDiff();
		}else{
			echo "Has alcanzado el numero máximo de partidas por dia como invitado, debes registrarte si quieres seguir jugando, o esperar a mañana";
			echo "<br><form method='POST' action=''><input type='submit' name='login' value='Volver'><br><br></form>";
		}
	}
}elseif(isset($_REQUEST['reguser'])){
	checkRegistro();
}elseif(isset($_REQUEST['1']) || isset($_REQUEST['2']) || isset($_REQUEST['3'])){
	$_SESSION['j']->setNivel();
}elseif(isset($_REQUEST['replay'])){
	$jugador = $_SESSION['j']->jugador;
	unset($_SESSION);
	session_destroy();
	session_start();
	$j = new Juego();
	$j->jugador = $jugador;
	$_SESSION['j'] = $j;
	$_SESSION['j']->setDiff();
}elseif(isset($_REQUEST['newword'])){
	$_SESSION['j']->insertNewWord();
}elseif(isset($_REQUEST['appendword'])){
	$_SESSION['j']->checkNewWord();
}elseif(isset($_REQUEST['exit'])){
	unset($_SESSION);
	session_destroy();
	session_start();
	login();
}else{
	$_SESSION['j']->checkLetra();

	$_SESSION['j']->juga();
}

?>