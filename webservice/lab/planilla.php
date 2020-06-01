<?php 
/*
	autor: mario ernesto herrera flores
	detalle: el formulario creado para consumir los servicios de web service y ademas interpretacion de
			datos recuperados

*/


	if(isset($_POST["nombre"])){
		date_default_timezone_set("America/El_Salvador");
		require_once("nusoap/lib/nusoap.php");
		$wsdl="http://localhost/webservice/lab/recursoshumanos.php?wsdl";
		$client=new nusoap_client($wsdl,"wsdl");
		$err=$client->getError();
		if($err){
			echo "<h1>error de conexion</h1>";
			exit(0);
		}
		$parametros=array("nombre"=>$_POST["nombre"],
							"cargo"=>$_POST["cargo"],
							"sueldo"=>$_POST["sueldo"],
							"años"=>$_POST["años"],
							"giro"=>$_POST["giro"]);
		$result=$client->call("Calculo",$parametros);
		echo $client->getError();
		print_r($result);

	}else{
?>


<!DOCTYPE html>
<html>
<head>
	<title>planilla de pago por renuncia voluntaria</title>
</head>
<body>
<table>
	<form method="POST">
	<tr><td>	Ingrese nombre del empleado<input type="text" name="nombre"><br></td>
		<td>Ingrese el cargo:<input type="text" name="cargo"><br></td>
		<td>Ingrese el sueldo:<input type="number" name="sueldo"><br>	</td>
		<td>Ingrese los años de trabajo:<input type="number" name="años"><br></td>
		<td>Ingrese giro de la empresa:<select name="giro">
									<option>comercio</option>
									<option>industria</option>
									<option>maquila</option>
									</select><br></td>
									<td><input type="hidden" name="monto" value="0"></td>
		<td><input type="submit" name="enviar"></td>
	</form>
	</tr>
</table>
</body>
</html>

<?php
}
?>