<?php

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'config/route.php';
require_once 'views/layout/tag.php';
require_once 'views/components/header/header.php';

//invocamos nuestra ruta 
$routes = new Route();
$arrayRuta=$routes->route();

//sin url==(dominio.com)
if(!isset($_GET['controller'])){
	$nombre_controlador = controller_default;
	$controlador = new $nombre_controlador();
	$controlador->index();
}
//con url o rutas
if(isset($_GET['controller'])){

	if (in_array($_GET['controller'], $arrayRuta)) {
		
		$urlDinamica=$_GET['controller']=='inicio'?'index':$_GET['controller'];
		$nombre_controlador = $_GET['controller'].'Controller';
		
		$controlador = new $nombre_controlador();
		$controlador->$urlDinamica();
	}else{
		show_error();
	}
}


function show_error(){
	$nombre_controlador = controller_default;
	$controlador = new $nombre_controlador();
	$controlador->index();
}

require_once 'views/components/footer/footer.php';