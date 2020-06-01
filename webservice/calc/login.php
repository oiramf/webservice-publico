<?php
	if(isset($_POST["username"])){
		date_default_timezone_set("America/El_Salvador");
		require_once("nusoap/lib/nusoap.php");
		$wsdl="http://localhost/webservice/calc/ws.php?wsdl";
		$client=new nusoap_client($wsdl,"wsdl");//''
		$err=$client->getError();
		if($err){
			echo "<h1>error de conexion</h1>";
			exit(0);
		}
		$parametros=array("username"=>$_POST["username"],
							"password"=>$_POST["password"]);
		$result=$client->call('login',$parametros);
		//print_r($result);
		if($result["id_user"]==0){
			echo "<h1>{$result['msg']}</h1>";
		}else{
			echo "<h1>Id:{$result['id_user']}</h1>";
			echo "<h1>nombre completo:{$result['fullname']}</h1>";
			echo "<h1>Email:{$result['email']}</h1>";
			echo "<h1>nivel:{$result['level']}</h1>";
		}
	}else{
?>


<!DOCTYPE html>
<html>
<head>
	<title>ejemplo de login con webservice</title>
</head>
<body>

	<form method="POST">
		<tr><td> nombre de usuario: <input type="text" name="username"><br></td></tr>
		<tr><td></td><td> password:<input type="password" name="password"><br></td></tr>
		
		<input type="submit" name="enviar">
	</form>

</body>
</html>

<?php
}
?>