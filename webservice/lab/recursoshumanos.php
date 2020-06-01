<?php
/*
	autor: mario ernesto herrera flores
	detalle: es el consumo de webservice donde llegan los datos 
			y son transferidos por lenguaje podria decirce universal para 
			realizar distintas funciones como en este ejemplo un calculo de liquidacion a un empleado.
	fuente de calculos sacado de :https://enfoquejuridico.org/2015/01/09/prestacion-economica-por-renuncia-voluntaria-buscando-nuevos-horizontes-parte-ii/
	
*/


date_default_timezone_set("America/El_Salvador");
require_once("nusoap/lib/nusoap.php");

$server=new nusoap_server;
$server->configureWSDL('server','urn:server');//->wsdl
$server->wsdl->schemaTargetNamespace='urn:server'; //para identificar cada nombre de webservice si se tienen muchos  ->wsdl

$server->wsdl->addComplexType(
		'Empleado',
		'complexType',
		'struct',
		'all',
		'',
		array(
			'nombre'=>array('name'=>'nombre','type'=>'xsd:string'),
			'cargo'=>array('name'=>'cargo','type'=>'xsd:string'),
			'sueldo'=>array('name'=>'sueldo','type'=>'xsd:double'),
			'años'=>array('name'=>'años','type'=>'xsd:int'),
			'giro'=>array('name'=>'años','type'=>'xsd:string'),
			'monto'=>array('name'=>'monto','type'=>'xsd:double'))
);
$server->register(
			'Calculo',
			array('nombre'=>'xsd:string',
				'cargo'=>'xsd:string',
				'sueldo'=>'xsd:double',
				'años'=>'xsd:int',
				'giro'=>'xsd:string',
				'monto'=>'xsd:double',),
			array('return'=>'tns:Empleado'),
			'urn:server',
			'urn:server#loginserver',
			'rpc',
			'encoded',
			'Funcion para calcular monto por renuncia voluntaria'
			);

function Calculo($nombre,$cargo,$sueldo,$años,$giro,$monto){
	 $salario=0;
	 $doble=0;
	 $this->nombre=$nombre;
	 $this->cargo=$cargo;
	 $this->sueldo=$sueldo;
	 $this->años=$años;
	 $this->giro=$giro;
	 $this->monto=$monto;

		if($giro=="comercio"){
			$salario=251.7;
			$doble=$salario*2;
			if ($sueldo >= $doble) {
				$doble=16.78;
				$monto=($doble * 15)*$años;

				$valor=array(
				'nombre'=>$nombre,
				'cargo'=>$cargo,
				'sueldo'=>$sueldo,
				'años'=>$años,
				'giro'=>$giro,
				'monto'=>$monto);
			}else{
				$monto= ($sueldo/2)* $años;
				$valor=array(
				'nombre'=>$nombre,
				'cargo'=>$cargo,
				'sueldo'=>$sueldo,
				'años'=>$años,
				'giro'=>$giro,
				'monto'=>$monto);
			}
			return $valor;
		}
		if($giro=="industria"){
			$salario=246.6;
			$doble=$salario*2;
			if ($sueldo >= $doble) {
				$doble=16.44;
				$monto=($doble * 15)*$años;

				$valor=array(
				'nombre'=>$nombre,
				'cargo'=>$cargo,
				'sueldo'=>$sueldo,
				'años'=>$años,
				'giro'=>$giro,
				'monto'=>$monto);
			}else{
				$monto= ($salario/2)* $años;
				$valor=array(
				'nombre'=>$nombre,
				'cargo'=>$cargo,
				'sueldo'=>$sueldo,
				'años'=>$años,
				'giro'=>$giro,
				'monto'=>$monto);
			}
			return $valor;
		}

		if($giro=="maquila"){
			$salario=210.9;
			$doble=$salario*2;
			if ($sueldo >= $doble) {
				$doble=14.06;
				$monto=($doble * 15)*$años;

				$valor=array(
				'nombre'=>$nombre,
				'cargo'=>$cargo,
				'sueldo'=>$sueldo,
				'años'=>$años,
				'giro'=>$giro,
				'monto'=>$monto);
			}else{
				$monto= ($salario/2)* $años;
				$valor=array(
				'nombre'=>$nombre,
				'cargo'=>$cargo,
				'sueldo'=>$sueldo,
				'años'=>$años,
				'giro'=>$giro,
				'monto'=>$monto);
			}
			return $valor;
		}

}


$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
//$server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));
?>