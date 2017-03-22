<?php
function conversor(){
	echo "<h2>Conversor</h2>";
	echo "<form method='POST' action=''>";
	echo "<input type='text' name='cantidad' placeholder='Cantidad'> ";
	echo "<select name='moneda'>";
	foreach($GLOBALS['bitcoin'] as $key=>$value){
		echo "<option value = $key>$key</option>";
	}
	echo "<select> ";
	echo "<input type='submit' name='convertir' value='convertir'>";
	echo "</form>";
}

?>
