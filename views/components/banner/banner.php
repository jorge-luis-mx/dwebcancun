<?php
$name=null;
if(isset($_GET['controller'])){
    switch ($_GET['controller']) {
        case 'servicios':
            $name='Servicios';
            break;
        case 'nosotros':
            $name='Nosotros';
            break;
        case 'portafolio':
            $name='Nuestros Portafolio';
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