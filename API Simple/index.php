<html>
<head >
	<meta charset="UTF8">
	<title>CONVERSION BTC</title>
</head>

<body background=''>

<?php
require("tabla.php");
require("conversor.php");
$btc = file_get_contents("https://blockchain.info/es/ticker");
$GLOBALS['bitcoin'] = json_decode($btc, true);

tabla();
conversor();

if(isset($_REQUEST['convertir']) && !empty($_REQUEST['cantidad'])){
	if(@$res = file_get_contents("https://blockchain.info/tobtc?currency=$_REQUEST[moneda]&value=$_REQUEST[cantidad]")){
	echo "<b>$_REQUEST[cantidad] $_REQUEST[moneda] = ";
	echo $res." BTC</b>";
	}else{
		echo "<br><b>Se ha producido un error, recuerda utilizar un punto (.) para los decimales.</b><br>";
	}

}

echo "<br><br><br><a href='https://www.queesbitcoin.info/'>Pulsa</a> para obtener mas información sobre los bitcoins"

?>

</body>
</html>