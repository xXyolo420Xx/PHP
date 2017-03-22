<?php
class Connection extends PDO{
	public static $db = null;
	public function __construct($host, $database, $user, $pass){
		try{
			parent::__construct("mysql:host=$host;dbname=$database;", $user, $pass);
			parent::exec('set names utf8');
			parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	public static function getDb(){
		if(self::$db == null){
			require("model/ddbb.php");
			self::$db = new self($host, $database, $user, $pass);
		}
		return self::$db;
	}

	public function getTable($table){
		try{
			$prep = self::getDb()->prepare("SELECT * FROM $table");
			$prep->execute();
			while($row = $prep->fetch()){
				$result[] = $row;
			}
			if(!empty($result)){
				return $result;
			}
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	public function regUser($nombre, $apellidos, $email, $telefono, $username, $pass, $lastlogin){
		try{
			$prep = self::getDb()->prepare("INSERT INTO users (username, hash, email, lastlogin, telefono, nombre, apellidos) VALUES (?,?,?,?,?,?,?)");
			$prep->bindParam(1, $username);
			$prep->bindParam(2, $pass);
			$prep->bindParam(3, $email);
			$prep->bindParam(4, $lastlogin);
			$prep->bindParam(5, $telefono);
			$prep->bindParam(6, $nombre);
			$prep->bindParam(7, $apellidos);
			$prep->execute();
			return true;
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
			return false;
		}
	}
	public function getUser($user){
		try{
			$prep = self::getDb()->prepare("SELECT hash FROM users WHERE username = ?");
			$prep->bindParam(1, $user);
			$prep->execute();
			$hash = $prep->fetch();
			return $hash['hash'];
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	public function upload($modelo, $pagina, $compra, $precio, $descripcion, $categoria){
		try{
		$prep = self::getDb()->prepare("INSERT INTO $categoria (modelo, pagina, compra, precio, descripcion) VALUES (?, ?, ?, ?, ?)");
		$prep->bindParam(1, $modelo);
		$prep->bindParam(2, $pagina);
		$prep->bindParam(3, $compra);
		$prep->bindParam(4, $precio);
		$prep->bindParam(5, $descripcion);
		$prep->execute();

		return true;
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
			return false;
		}
	}
	public function getLastLogin($user){
		try{
			$prep = self::getDb()->prepare("SELECT lastlogin FROM users WHERE username = ?");
			$prep->bindParam(1, $user);
			$prep->execute();
			$lastlogin = $prep->fetch();
			return $lastlogin['lastlogin'];
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
	public function setLastLogin($user, $time){
		try{
			$prep = self::getDb()->prepare("UPDATE users SET lastlogin = ? WHERE username = ?");
			$prep->bindParam(1, $time);
			$prep->bindParam(2, $user);
			$prep->execute();
		}catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}

}?>