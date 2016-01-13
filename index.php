<?php

//incluir el archivo principal
include("Slim/Slim.php");

//registran la instancia de slim
\Slim\Slim::registerAutoloader();
//aplicacion 
$app = new \Slim\Slim();

//routing 
//accediendo VIA URL
//http:///www.google.com/
//localhost/apirest/index.php/ => "Hola mundo ...."
$app->get(
    '/',function() use ($app){
    	
    	//consultas a la base de datos 
    	// peticiones a otro rest 
    	// etcetera
    	$datos = array(
    					"nombre" => "pepe", 
    					"edad" => "23"
    					);

    	//json 
        echo json_encode($datos);
    }
)->setParams(array($app));

$app->get(
    '/usuario/:nombre',function($nombre) use ($app){
    	$id = $nombre;
    	//almaceno el ID
    	//conexion con base de datos
    	//el proceso
    	// retorno un JSON
        echo "hola bienvenido " . $nombre;
    }
);

//inicializamos la aplicacion(API)
$app->run();

