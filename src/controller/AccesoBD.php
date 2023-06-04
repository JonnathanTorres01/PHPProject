<?php

namespace App\controller;
use Psr\Container\ContainerInterface;
use PDO;


class AccesoBD{


protected $container;


public function __construct(ContainerInterface $c){

$this->container = $c;


}


private function generarParam($datos){

$cad = "(";
foreach($datos as $campo => $valor){

$cad .= ":$campo,";

}

$cad = trim($cad,',');
$cad .= ")";

return $cad;
}


public function crearBD($datos, $recurso){

$params = $this->generarParam($datos);
$sql = "SELECT nuevo$recurso$params";

//var_dump($sql);


$d = [];

foreach($datos as $clave =>$valor){
$d[$clave] = $valor;
}

$con = $this->container->get('bd');
$query = $con->prepare($sql);
$query->execute($d);
$res = $query->fetch(PDO::FETCH_NUM);
$query = null;
$con = null;

//return $res[0];

return $res;

}


public function editarBD($datos,$recurso,$id){

$params = $this->generarParam($datos);
$params = substr($params,0,1) . ":id," . substr($params,1);
$sql = "SELECT editar$recurso$params";
$d['id'] = $id;

foreach($datos as $clave => $valor){

    $d[$clave] = $valor;

}

$con = $this->container->get('bd');
$query = $con->prepare($sql);
$query->execute($d);
$res = $query->fetch(PDO::FETCH_NUM);
$query = null;
$con = null;
return $res[0];

}


}