<?php 
    require_once 'models/metaModel.php';
    require_once 'config/route.php';

    //invocamos las metas
    $Allmeta= new Metas();
    $metas=$Allmeta->getMetas();
    //invocamos nuestra ruta 
    $routes = new Route();
    $arrayRuta=$routes->route();
    
    $metaDinamic=null;
    if(!isset($_GET['controller'])){
        $metaDinamic=$metas[0]['title'];
    }
    if(isset($_GET['controller'])){
        if (in_array($_GET['controller'], $arrayRuta)) {
            foreach ($metas as $key => $value) {
               if ($_GET['controller']==$value['name']) {
                $metaDinamic=$value['title'];
               }
            }
        }else{
            $metaDinamic=$metas[0]['title'];
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$metaDinamic?></title>
    <meta name="description" content=""/>
    <meta name="keywords" content="palabra clave 1, palabra clave 2, palabra clave 3"/>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url?>assets/build/css/app.css">
</head>
<body>