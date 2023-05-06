<?php
$name=null;
if(isset($_GET['route'])){
    switch ($_GET['route']) {
        case "paginas-web-cancun":
            $name='Páginas Web en Cancún';
            break;
        case "servicios-de-paginas-web-cancun":
            $name='Servicios';
            break;
        case "precios-de-paginas-web-cancun":
            $name='Precios';
            break;
        case "nosotros":
            $name='Nosotros';
            break;
        case "portafolio":
            $name='Portafolio';
            break;
            case "blog":
            $name='Blog';
            break;
        case "contacto":
            $name='Contacto';
            break;
        default:
            $name='Hemos perdido esta pagina';
    }
}

?>
<div class="banner">
    <div class="contenido-banner contenedor">
        <h1><?=$name;?></h1>
    </div>
</div>