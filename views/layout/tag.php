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
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url?>assets/img/icon-devscun.png" /> 
    <link rel="stylesheet" href="<?=base_url?>assets/build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
       
</head>
<body>