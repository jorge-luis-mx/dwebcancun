<?php 

    require_once 'config/db.php';
    require_once 'models/metaModel.php';
    require_once 'config/route.php';

    $objCon = new Config();
    $objmetas = new Metas($objCon);
    $metas=$objmetas->get_metas();

    //invocamos nuestra ruta 
    $routes = new Route();
    $arrayRuta=$routes->route();

    $metaTitle=null;
    $metaDescription=null;
        
    if(!isset($_GET['route'])){

        $metaTitle=$metas[0]['title'];
        $metaDescription=$metas[0]['description'];
    }
    if(isset($_GET['route'])){
        foreach ($metas as $key => $value) {
            if ($_GET['route']==$value['name']) {
             $metaTitle=$value['title'];
             $metaDescription=$value['description'];
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$metaTitle?></title>
    <meta name="description" content="<?=$metaDescription?>"/>

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.devscun.com/">
    <meta property="og:title" content="DevsCUN | Desarrollo y Diseño de Páginas Web">
    <meta property="og:description" content="Cotiza y adquiere una página web personalizada para tu negocio. Diseñamos y construimos páginas web responsivas, optimizadas y con proceso de pago.">
    <meta property="og:image" content="https://www.devscun.com/assets/img/logo-devscun.png">

    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url?>assets/img/favicon.ico" /> 
    <link rel="stylesheet" href="<?=base_url?>assets/build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9Y3JXMPHFH"></script>
</head>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-9Y3JXMPHFH');
</script>
<body>