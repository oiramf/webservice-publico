<?php

/*
	autor: mario ernesto herrera flores
	detalle: es el consumo de webservice donde llegan los datos 
	y son transferidos por lenguaje podria decirce universal para 
	realizar distintas funciones como en este ejemplo el calculo de impuestos a productos.
	
*/


date_default_timezone_set("America/El_Salvador");
require_once("nusoap/lib/nusoap.php");

$server=new nusoap_server;
$server->configureWSDL('server','urn:server');//->wsdl
$server->wsdl->schemaTargetNamespace='urn:server'; //para identificar cada nombre de webservice si se tienen muchos  ->wsdl



$server->wsdl->addComplexType(

	'Iva',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'codigo'=>array('name'=>'codigo','type'=>'xsd:int'),
		'producto'=>array('name'=>'producto','type'=>'xsd:string'),
		'precio'=>array('name'=>'email','type'=>'xsd:double'),
		'iva'=>array('name'=>'iva','type'=>'xsd:double'),
		'total'=>array('name'=>'total','type'=>'xsd:double'))


);

$server->register(
			'Iva',
			array('codigo'=>'xsd:int','producto'=>'xsd:string','precio'=>'xsd:double'),
			array('return'=>'tns:Iva'),
			'urn:server',
			'urn:server#loginserver',
			'rpc',
			'encoded',
			'calculo de iva para un producto'
			);



function Iva($codigo,$producto,$precio){
	$this->codigo=$codigo;
	$this->producto=$producto;
	$this->precio=$precio;
	$iva= $precio*0.13;
	$total= $precio*1.13;
		$valor=array(
			'codigo'=>1,
			'producto'=>$producto,
			'precio'=>$precio,
			'iva'=>$iva,
			'total'=>$total);
	
	
	return $valor;
}


$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
//$server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));

?>