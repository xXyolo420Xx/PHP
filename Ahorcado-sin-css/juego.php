<?php

class Juego{
	public $jugador;
	public $palabras;
	public $palabra;
	public $descripcion;
	public $letras_usadas = array();
	public $letras_tabla = array();
	public $letras_adivinadas = array();
	public $intentos;
	public $nivel;
	public $splitpalabra = array();

	function setJugador($guest=0){
		if($guest){
			$this->jugador = "invitado";
		}else{
		$this->jugador = $_REQUEST['userlogin'];
		}
	}

	function setDiff(){
		echo "<h2>Elige un nivel de dificultad</h2><br>";
		echo "<form method='POST'>
			<input type='submit' action='' name='3' value='Fácil'>
			<input type='submit' action='' name='2' value='Normal'>
			<input type='submit' action='' name='1' value='Difícil'>
			</form><br>";
		$this->insertSalir();
	}
	function setNivel(){
		if(isset($_REQUEST['1'])){
			$this->nivel = 1;
		}elseif(isset($_REQUEST['2'])){
			$this->nivel = 2;
		}elseif(isset($_REQUEST['3'])){
			$this->nivel = 3;
		}
		$this->juga();
	}

	function juga(){
		if(empty($this->palabra)){
			$this->setGame();
		}elseif($this->intentos<=0){
			echo "<img src=img/0.png><br><br>";
			echo "<h1>Has perdido</h1><br><br>";
			if($this->jugador == "invitado"){
				conexion::getDb()->partidaInvitado();
				if(conexion::getDb()->canPlay()){
					$this->repite();
				}else{
					echo "Has alcanzado el numero máximo de partidas por dia como invitado, debes registrarte si quieres seguir jugando, o esperar a mañana";
					$this->insertSalir();
				}
			}else{
				conexion::getDb()->lose($this->jugador);
				$this->repite();
			}
		}elseif(count($this->letras_adivinadas) == count($this->splitpalabra)){
			echo "<img src='img/win.jpg'>";
			echo "<h1>Has ganado!</h1>";
			if($this->jugador == "invitado"){
				conexion::getDb()->partidaInvitado();
				if(conexion::getDb()->canPlay()){
					$this->repite();
					$this->insertSalir();
				}else{
					echo "Has alcanzado el numero máximo de partidas por dia como invitado, debes registrarte si quieres seguir jugando, o esperar a mañana";
					$this->insertSalir();
				}
			}else{
				if($this->nivel == 1 || $this->nivel ==2){
					conexion::getDb()->addWins($this->jugador);
				}
				if(conexion::getDb()->getWins($this->jugador)==3 && conexion::getDb()->checkPremium($this->jugador) == false){
					if(conexion::getDb()->makePremium($this->jugador)){
						$this->newWord();
					}
					echo "Has sido ascendido a jugador premium, ahora podrás subir palabras para que los demás las adivinen!<br><br>";
				}if(conexion::getDb()->checkPremium($this->jugador)){
					"Recuerda que eres jugador premium y puedes subir nuevas palabras!<br><br>";
					$this->newWord();
				}
				$this->repite();
				$this->insertSalir();
				}
			
		}else{
		$this->letras_tabla = $this->setLetras();
		$this->insertLetras();
		$this->insertPalabra();
		$this->insertImagen();
		$this->repite();
		$this->insertSalir();
		}
	}
	function setGame(){
		$this->palabras = conexion::getDb()->getPalabras($this->nivel);
		$arrayrandom = array_rand($this->palabras);
		$this->palabra = strtoupper($arrayrandom);
		$this->descripcion = $this->palabras[$arrayrandom];
		switch($this->nivel){
			case 1:
			$this->intentos = 10;
			break;
			case 2:
			$this->intentos = 6;
			break;
			case 3:
			$this->intentos = 4;
		}
		$this->splitpalabra = str_split(strtoupper($arrayrandom));
		$this->juga();
	}
	function setLetras(){
		$abecedario = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$letras = array();
		for($i=0;$i<27;$i++){
			$letra = $abecedario[$i];
			if(in_array($letra, $this->letras_usadas)){
			$letras[$letra] = "<input type='submit' style='padding:7px 7px' name='$letra' value='$letra' disabled>";
			}else{
			$letras[$letra] = "<input type='submit' style='padding:7px 7px' name='$letra' value='$letra'>";
			}
		}
		return $letras;
	}
	function insertLetras(){
		echo "<form method='POST' action=''><table>";
		$i=0;
		foreach($this->letras_tabla as $key=>$value){
			if($i == 0){
				echo "<tr>";
			}
			if($i == 9 || $i == 18){
				echo "</tr><tr>";
			}
			echo "<td style='padding:5px 5px'>".$this->letras_tabla[$key]."</td>";
			if($i == 26){
				echo "</tr>";
			}
			$i++;
		}
		echo "</table></form>";
	}
	function insertPalabra(){
			echo "<br><br>";
			echo "<h4>Pista: $this->descripcion</h4>";
			echo "<br><br>";
			echo "<table border=1><tr>";
			for($i=0;$i<strlen($this->palabra);$i++){
					echo "<td width=30 height=30>".@$this->letras_adivinadas[$i]."</td>";
			}
			echo "</tr></table><br>";
			echo "<h3>$this->intentos intentos restantes</h3>";
	}

	function checkLetra(){
		$right = false;
		foreach($this->letras_tabla as $key=>$value){
			if(isset($_REQUEST[$key])){
				$this->letras_usadas[] = $key;
				for($i=0;$i<count($this->splitpalabra);$i++){
					if($key == $this->splitpalabra[$i]){
						$this->letras_adivinadas[$i] = $key;
						$right = true;
					}
				}
				if(!$right){
					$this->intentos--;
				}
			}
		}
	}


	function insertImagen(){
		echo "<br><br>";
		echo "<img src=img/".$this->intentos.".png>";
	}
	function repite(){
		echo "<br><form method='POST' action=''><input type='submit' name='replay' value='Reiniciar'></form>";
	}
	function newWord(){
		echo "<form method='POST' action=''><input type='submit' name='newword' value='Insertar nueva palabra'></form>";
	}
	function insertNewWord(){
		echo "<form method='POST' action=''>
		<input type='text' name='word' placeholder='Palabra'><br><br>
		<input type='text' name='descrip' placeholder='Descripcion'><br><br>
		<input type='submit' name='appendword' value='insertar!'>
		</form>";
	}
	function checkNewWord(){
		$word = $this->sinTildes($_REQUEST['word']);
		$word = $this->sinEspacios($word);
		
		$desc = $_REQUEST['descrip'];
		if(strlen($word)<3){
			echo "La palabra no puede tener menos de 3 letras!";
			$this->repite();
			$this->newWord();
			$this->insertSalir();
		}elseif(strlen($desc)<5){
			echo "Inserta una mejor descripción!";
			$this->repite();
			$this->newWord();
			$this->insertSalir();
		}else{
			conexion::getDb()->appendWord($word, $desc);
				echo "Palabra añadida a la base de datos!";
				$this->repite();
				$this->insertSalir();
		}
	}
	function insertSalir(){
		echo "<form method='POST' action=''><input type='submit' name='exit' value='Cerrar sesión'></form>";
	}
	function sinTildes($frase) {
	$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","à","è","ì","ò","ù","À","È","Ì","Ò","Ù");
	$permitidas= array ("a","e","i","o","u","A","E","I","O","U","a","e","i","o","u","A","E","I","O","U");
	$texto = str_replace($no_permitidas, $permitidas ,$frase);
	return $texto;
	}
	function sinEspacios($frase) {
	$texto = trim(preg_replace('/ +/', ' ', $frase));
	return $texto;
	}
}