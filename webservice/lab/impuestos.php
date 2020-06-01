<?php

/*
	autor: mario ernesto herrera flores
	detalle: el formulario creado para consumir los servicios de web service y ademas interpretacion de
			datos recuperados

*/

	if(isset($_POST["producto"])){
		date_default_timezone_set("America/El_Salvador");
		require_once("nusoap/lib/nusoap.php");
		$wsdl="http://localhost/webservice/lab/iva.php?wsdl";
		$client=new nusoap_client($wsdl,"wsdl");//''
		$err=$client->getError();
		if($err){
			echo "<h1>error de conexion</h1>";
			exit(0);
		}
		$parametros=array("codigo"=>$_POST["codigo"],
							"producto"=>$_POST["producto"],
							"precio"=>$_POST["precio"]);
		$result=$client->call('iva',$parametros);
		print_r($result);
		
			echo "<h1>codigo:{$result['codigo']}</h1>";
			echo "<h1>producto:{$result['producto']}</h1>";
			echo "<h1>precio:{$result['precio']}</h1>";
			echo "<h1>iva:{$result['iva']}</h1>";
			echo "<h1>total:{$result['total']}</h1>";
		
	}else{
?>


<!DOCTYPE html>
<html>
<head>
	<title>calculo de iva para producto</title>
</head>
<body>
<table>
	<tr><form method="POST">
		<td> codigo del producto: <input type="number" name="codigo"><br></td></tr>
		<tr><td></td><td> nombre del producto: <input type="text" name="producto"></td><br></tr>
		<tr><td></td><td></td><td> precio del producto: <input type="number" name="precio"><br></td></tr>

		<tr><td></td><td></td><td></td><td><input type="submit" name="enviar"><br></td></tr>
		
		
	</form>
</table>
</body>
</html>

<?php
}
?>