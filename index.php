<?php

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'views/layout/tag.php';
require_once 'views/components/header/header.php';
//controllers
require_once 'controllers/InicioController.php';
require_once 'controllers/ServiciosController.php';
require_once 'controllers/PreciosController.php';
require_once 'controllers/PortafolioController.php';
require_once 'controllers/NosotrosController.php';
require_once 'controllers/ContactoController.php';
require_once 'controllers/EmailController.php';
require_once 'controllers/ErrorController.php';
require_once 'controllers/PaginaController.php';
require_once 'controllers/PaginaCancunController.php';



if(!isset($_GET['route'])){

	$controller = controller_default;
	$objController = new $controller();
	$objController->inicio();
}
if(isset($_GET['route'])){

	switch ($_GET['route']) {
		case "paginas-web-cancun":


			$objController = new paginaCancunController;
			$objController->paginaCancun();
			break;

		case "servicios-de-paginas-web-cancun":


			$objController = new serviciosController;
			$objController->servicios();

			break;
		case "precios-de-paginas-web-cancun":


			$objController = new preciosController;
			$objController->precios();
			 break;
		case "portafolio":


			$objController = new portafolioController;
			$objController->portafolio();
			break;

		case "blog":


			$objController = new blogController;
			$objController->blog();
			break;

		case "nosotros":


			$objController = new nosotrosController;
			$objController->nosotros();
			break;
		case "contacto":


			$objController = new contactoController;
			$objController->contacto();
			break;

		case "404":


			$objController = new errorController;
			$objController->error();
		break;

		default:

			$objController = new paginaController;
			$objController->pagina();
  	}



}

require_once 'views/components/footer/footer.php';