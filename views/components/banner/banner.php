<?php
$name=null;
if(isset($_GET['route'])){
    switch ($_GET['route']) {
        case "servicios-de-paginas-web-cancun":
            $name='Servicios';
            break;
        case "precios-de-paginas-web-cancun":
            $name='Precios';
            break;
        case "nosotros-desenamos-paginas-web-cancun":
            $name='Nuestros';
            break;
        default:
            $name='Contactenos';
    }
}

?>
<div class="banner">
    <div class="contenido-banner contenedor">
        <h1 style="color:white"><?=$name;?></h1>
    </div>
</div>