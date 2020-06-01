<?php
 date_default_timezone_set("America/El_Salvador");


require_once("nusoap/lib/nusoap.php");

$wsdl="http://www.dneonline.com/calculator.asmx?WSDL";
$client=new nusoap_client($wsdl,"wsdl");
$err=$client->getError();
if ($err){
	echo "error de conexion con webservice - $err";
	exit(0);
}
$parametros=array('intA'=>10,'intB'=>25);
$suma=$client->call('Add',$parametros);
//print_r($suma);
echo "La suma de 10 + 25 es:".$suma["AddResult"]."<br>";

$resta=$client->call('Subtract',$parametros);
//print_r($suma);
echo "La resta de 10 + 25 es:".$resta["SubtractResult"];

