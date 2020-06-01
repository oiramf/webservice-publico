<?php
	if(isset($_POST["usuario"])){
		date_default_timezone_set("America/El_Salvador");
		require_once("nusoap/lib/nusoap.php");
		$wsdl="http://localhost/webservice/calc/ws.php?wsdl";
		$client=new nusoap_client($wsdl,"wsdl");
		$err=$client->getError();
		if($err){
			echo "<h1>error de conexion</h1>";
			exit(0);
		}
		$parametros=array("usuario"=>$_POST["usuario"]);
		$result=$client->call("hola",$parametros);
		echo $client->getError();
		print_r($result);
	}else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>hola mundo web service</title>
</head>
<body>

	<form method="POST">
		digite su nombre: <input type="text" name="usuario"><br>
		<input type="submit" name="enviar">
	</form>

</body>
</html>
<?php
}
?>