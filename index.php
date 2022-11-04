<?php

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'views/layout/tag.php';
require_once 'views/components/header/header.php';
require_once 'controllers/InicioController.php';
require_once 'controllers/ServiciosController.php';
require_once 'controllers/PreciosController.php';
require_once 'controllers/NosotrosController.php';
require_once 'controllers/ContactoController.php';
require_once 'controllers/EmailController.php';



if(!isset($_GET['route'])){
	$controller = controller_default;
	$objController = new $controller();
	$objController->inicio();
}
if(isset($_GET['route'])){

	switch ($_GET['route']) {
		case "servicios-de-paginas-web-cancun":

			$controller='serviciosController';
			$controllerMetod='servicios';

			break;
		case "precios-de-paginas-web-cancun":
			$controller='preciosController';
			$controllerMetod='precios';
			 break;
		case "nosotros-desenamos-paginas-web-cancun":

			$controller='nosotrosController';
			$controllerMetod='nosotros';
			break;
		case "contacto-de-diseno-paginas-web-cancun":

			$controller='contactoController';
			$controllerMetod='contacto';
			break;

		default:
			$controller='inicioController';
			$controllerMetod='inicio';
  	}

	$objController = new $controller();
	$objController->$controllerMetod();

}

require_once 'views/components/footer/footer.php';