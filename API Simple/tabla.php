<?php
function tabla(){

	echo "<table border=1>";
	echo "<h1>PRECIO BITCOIN EN TIEMPO REAL</h1>";
	echo "<tr><th>Moneda</th><th>Precio hace 15min</th><th>Precio ahora</th><th>Precio compra</th><th>Precio venta</th><th>Simbolo</th></tr>";
	foreach($GLOBALS['bitcoin'] as $key=>$value){
		echo "<tr>";
		echo "<td>$key</td>";
		foreach($value as $value2){
			echo "<td>$value2</td>";
		}
		echo "</tr>";
	}

	echo "</table><br>";
}
?>