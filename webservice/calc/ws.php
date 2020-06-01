<?php
date_default_timezone_set("America/El_Salvador");
require_once("nusoap/lib/nusoap.php");

$server=new nusoap_server;
$server->configureWSDL('server','urn:server');//->wsdl
$server->wsdl->schemaTargetNamespace='urn:server'; //para identificar cada nombre de webservice si se tienen muchos  ->wsdl

$server->register('hola',
		array('usuario'=>'xsd:string'),
		array('return'=>'xsd:string'),
		'urn:server',
		'urn:server#holaServer',
		'rpc',
		'encoded',
		'funcion hola mundo');

$server->wsdl->addComplexType(

	'Persona',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'id_user'=>array('name'=>'id_user','type'=>'xsd:int'),
		'fullname'=>array('name'=>'fullname','type'=>'xsd:string'),
		'email'=>array('name'=>'email','type'=>'xsd:string'),
		'msg'=>array('name'=>'msg','type'=>'xsd:string'),
		'level'=>array('name'=>'level','type'=>'xsd:int'))


);

$server->register(
			'login',
			array('username'=>'xsd:string','password'=>'xsd:string'),
			array('return'=>'tns:Persona'),
			'urn:server',
			'urn:server#loginserver',
			'rpc',
			'encoded',
			'Funcion para la validad usuario y password'
			);

function hola($usuario){
	return "bienvenido $usuario";
}

function login($username,$password){
	if(($username=="admin") && ($password=="catolica")){
		$valor=array(
			'id_user'=>1,
			'fullname'=>"rogelio flores",
			'email'=>"rogelio@gmail.com",
			'msg'=>"usuario correcto",
			'level'=>1);
	} else{
		$valor=array(
			'id_user'=>0,
			'fullname'=>"",
			'email'=>"",
			'msg'=>"",
			'level'=>0);
	}
	return $valor;
}


$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
//$server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));

?>