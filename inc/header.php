<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Link rel="stylesheet" href="style.css" />
    <title>Sistema de gestion de libros</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62cb099bac.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--Barra de navegacion-->
    <div id="nav-bar">
        <div id="nav-bar-content" style="margin-left:22rem; display: inline-flex;">
            <div class="pestañas" style="margin-top: 1.3rem; margin-left: 1.5rem;">
                <a href="<?php echo $ruta, 'home/index.php'?>" id="Productos-navbar">Inicio</a>
                <a href="#" style="color: #a9a6a6; visibility: hidden;" id="Dashboard-navbar">Dashboard</a>
                <a href="#" style="color: #a9a6a6; visibility: hidden;" id="Categorias-navbar">Categorias</a>
            </div>
            <div class="añadirproducto-navbar" style="margin-top: 1rem;">
                <a href="<?php echo $ruta, 'CRUD\añadirLibro.php'?>" id="añadirproducto-btn">+ Añadir Producto</a>
            </div>
            <div class="notificacion" style="margin-top: 0.7rem; margin-left: 34rem;">
                <img src="..\img\campana.PNG" style="visibility: hidden;" alt="no se encontro elemento">
            </div>
            <div class="perfil" style="margin-top: 0.7rem; margin-left: 5rem; display: inline-flex;">
                <a>Perfil</a>
                <ul class="nav">
                    <li><img src="..\img\perfil.PNG" alt="no se encontro elemento">
                        <ul>
                            <li> <a href="<?php echo $ruta ,'login.php'?>">Cerrar Sesión</a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>