<?php

namespace App\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use PDO;


class Producto extends AccesoBD{


const RECURSO = "Producto";


public function crear(Request $request, Response $response, $args){

// (:id, :codigo, :nombre, :caracteristicas, :cantidad, :precio)

$body = json_decode($request -> getBody());

//var_dump($body);

$res = $this->crearBD($body, self::RECURSO);

//password_hash($body ->id, PASSWORD_BCRYPT, ['cost' => 10]);

// Aqui se puede crear un usuario con los datos que trae la funcion


//var_dump($res);

$status = $res === 0 ? 404 : 201;

/*
$status = $res;

if($status==null){

$status = 201;

}else {
    $status = 404;
}
*/

/*
$status = match($res[0]){
'0'=> 201,
'1' => 409,
'2'=> 500,
}; 
*/

return $response->withStatus($status);

}


public function editar(Request $request, Response $response, $args){

// (:id, :codigo, :nombre, :caracteristicas, :cantidad, :precio)

$id = $args['id'];

$body = json_decode($request -> getBody(),1);
$res = $this->editarBD($body, self::RECURSO, $id);

$status = match($res[0]){
    '0',0 => 404,
    '1',1 => 200,
    '2',2 =>409
};

return $response->withStatus($status);

}

}




