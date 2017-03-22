<?php

class Conexion extends PDO{
	private static $db = null;
	public function __construct($host="localhost", $dbname="ahorcado", $user="sime", $pass="1234"){
		try{
			parent::__construct('mysql:host='.$host.';dbname='.$dbname, $user , $pass);
			parent::exec('set names utf8');
			parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	public static function getDb(){
		if (self::$db == null) {
	  	  self::$db = new self();
	    }
        return self::$db;
	}
	function getPalabras($diff){
		try{
			$prep = self::getDb()->prepare("SELECT * FROM palabras WHERE level = ?");
			$prep->bindParam(1, $diff);
			$prep->execute();
			while($row = $prep->fetch()){
				$palabra[$row['palabra']] = $row['descripcion'];
			}
			return $palabra;
		}catch(PDOException $e){
			echo "Error: ".$e.getMessage();
		}
	}
	function entrarUser($user, $pass){
		try{
			$prep = self::getDb()->prepare("SELECT * FROM usuarios WHERE username = ?");
			$prep->bindParam(1, $user);
			$prep->execute();
			while($row = $prep->fetch()){
				$hash = $row['password'];
			}
			if(!empty($hash)){
				if(password_verify($pass, $hash)){
					return true;
				}else{
					return false;
				}
			}
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	function regUser($user, $password, $nombre, $apellidos, $email, $fecha){
		try{
			$deffpass = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO usuarios (username, password, nombre, apellidos, email, fecha_alta) VALUES (?, ?, ?, ?, ?, ?)";
			$prep = self::getDb()->prepare($sql);
			$prep->bindParam(1, $user);
			$prep->bindParam(2, $deffpass);
			$prep->bindParam(3, $nombre);
			$prep->bindParam(4, $apellidos);
			$prep->bindParam(5, $email);
			$prep->bindParam(6, $fecha);
			$prep->execute();
			return true;
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage()."<br><br>";
		}
	}
	function addWins($user){
		try{
			$prep = self::getDb()->prepare("SELECT * FROM usuarios WHERE username = ?");
			$prep->bindParam(1,$user);
			$prep->execute();
			while($res = $prep->fetch()){
				$wins = $res['partidas_ganadas'];
			}
			$wins++;
			$prep = self::getDb()->prepare("UPDATE usuarios SET partidas_ganadas = ? WHERE username = ?");
			$prep->bindParam(1, $wins);
			$prep->bindParam(2, $user);
			$prep->execute();
		}catch(PDOException $e){
			echo "Error: ".$e.getMessage();
	}

	}
	function checkPremium($user){
		try{
			$prep = self::getDb()->prepare("SELECT * FROM usuarios WHERE username = ?");
			$prep->bindParam(1,$user);
			$prep->execute();
			while($res = $prep->fetch()){
				$prem = $res['premium'];
			}
			return $prem;
		}catch(PDOException $e){
			echo "Error: ".$e.getMessage();
		}
	}
	function getWins($user){
		try{
			$prep = self::getDb()->prepare("SELECT * FROM usuarios WHERE username = ?");
			$prep->bindParam(1, $user);
			$prep->execute();
			while($row = $prep->fetch()){
				$wins = $row['partidas_ganadas'];
			}
			return $wins;
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	function makePremium($user){
		try{
		$prep = self::getDb()->prepare("UPDATE usuarios SET premium = TRUE WHERE username = ?");
		$prep->bindParam(1, $user);
		$prep->execute();
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	function appendWord($word,$desc){
		try{
			$length = strlen($word);
			$prep = self::getDb()->prepare("INSERT INTO palabras (palabra, descripcion, level) VALUES (?, ?, ?)");
			if($length>=3 && $length <=5){
				$lvl = 3;
			}elseif($length>=6 && $length<=8){
				$lvl = 2;
			}elseif($length>8){
				$lvl = 1;
			}
			$prep->bindParam(1, $word);
			$prep->bindParam(2, $desc);
			$prep->bindParam(3, $lvl);
			$prep->execute();
		}catch(PDOException $e){
			echo "Error: ".$e.getMessage();
		}
	}
	function lose($user){
		try{
		$prep = self::getDb()->prepare("UPDATE usuarios SET partidas_ganadas = 0 WHERE username = ?");
		$prep->bindParam(1, $user);
		$prep->execute();
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	function resetGuest(){
		try{
		$prep = self::getDb()->prepare("UPDATE usuarios SET partidas_restantes = 3 WHERE username = 'invitado'");
		$prep->execute();
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	function canPlay(){
		try{
		$prep = self::getDb()->prepare("SELECT * FROM usuarios WHERE username = 'invitado'");
		$prep->execute();
		while($row = $prep->fetch()){
			$res = $row['partidas_restantes'];
		}
		if($res>0){
			return true;
		}else{
			return false;
		}
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}

	function partidaInvitado(){
		try{
		$prep = self::getDb()->prepare("SELECT * FROM usuarios WHERE username = 'invitado'");
		$prep->execute();
		while($row = $prep->fetch()){
			$res = $row['partidas_restantes'];
		}
		$res--;
		$prep = self::getDb()->prepare("UPDATE usuarios SET partidas_restantes = ? WHERE username = 'invitado'");
		$prep->bindParam(1, $res);
		$prep->execute();
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
}

?>
