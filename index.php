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
require_once 'controllers/ErrorController.php';
require_once 'controllers/PaginaController.php';



if(!isset($_GET['route'])){

	$controller = controller_default;
	$objController = new $controller();
	$objController->inicio();
}
if(isset($_GET['route'])){

	switch ($_GET['route']) {
		case "paginas-web-cancun":

			$controller='paginaCancunController';
			$controllerMetod='paginaCancun';

			$objController = new $controller();
			$objController->$controllerMetod();
			break;

		case "servicios-de-paginas-web-cancun":

			$controller='serviciosController';
			$controllerMetod='servicios';
			$objController = new $controller();
			$objController->$controllerMetod();

			break;
		case "precios-de-paginas-web-cancun":

			$controller='preciosController';
			$controllerMetod='precios';
			$objController = new $controller();
			$objController->$controllerMetod();
			 break;
		case "nosotros":

			$controller='nosotrosController';
			$controllerMetod='nosotros';
			$objController = new $controller();
			$objController->$controllerMetod();
			break;
		case "contacto":

			$controller='contactoController';
			$controllerMetod='contacto';
			$objController = new $controller();
			$objController->$controllerMetod();
			break;

		case "404":

				$controller='errorController';
				$controllerMetod='error';
				$objController = new $controller();
				$objController->$controllerMetod();
		break;

		default:
			$controller='paginaController';
			$controllerMetod='pagina';
			$objController = new $controller();
			$objController->$controllerMetod();
  	}



}

require_once 'views/components/footer/footer.php';