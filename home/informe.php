<?php
error_reporting(0);
require '../cnx.php';
$ruta = "../";
$suma = 0;
$sqlSelect = "SELECT * FROM `books`;";
$ps = $cnx->prepare($sqlSelect);
$ps->execute();
$resLibro = $ps->fetchAll();
    
$sqlSelectCat = "SELECT * FROM `categorias`;";
$ps = $cnx->prepare($sqlSelectCat);
$ps->execute();
$resCategoria = $ps->fetchAll();

$sqlSelectL = "SELECT c.id_cat, c.name_cat, l.stock_book, l.id_cat FROM `categorias` c INNER JOIN `books` l ON c.id_cat = l.id_cat;";
$psSelectL = $cnx->prepare($sqlSelectL);
$psSelectL->execute();
$res = $psSelectL->fetchAll();
//echo $psSelectL;
include("../inc/header.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <Link rel="stylesheet" href="style.css"/>
        <title>Sistema de gestion de libros</title>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/62cb099bac.js" crossorigin="anonymous"></script>
    </head>
<body>
<?php foreach($resLibro as $libro){ 
    $cantidad = $libro['stock_book'];
    $suma = $suma + $cantidad;
    $cantidadVendido = $libro['vendidos_book'];
    $sumabooks += $cantidadVendido;
    include("../inc/header.php"); 
 } 
 ?>
<!--Body Center, Aqui va el contenido-->
<div id="body-content2" style="color: black;">
    <div id="body-center">
        <div id="body-header-title" style=" margin-left: 0rem; margin-top: 2rem; margin-bottom: 3rem;">
            <p>Informe de inventario</p>
            <a href="informePDF.php" class="btns-header btn-generar-pdf" id="btn-generar-pdf">Descargar PDF</a>
        </div>
        <div id="texto-informe" style="margin-bottom: 2rem;">
            <form>  
                <table id="tabla-inv" cellspacing="0" cellpadding="10">
                <tr>
                    <td style="font-size:19px; color: #afafaf;">Resumen:</td></tr>
                    <tr>
                        <td style="font-weight: bold;">Total Libros disponibles:</td>
                        <td><?php echo $suma?></td>
                    </tr>
                    
                    <tr>
                   
                    <tr id="tr">
                        
                            <td style="font-weight: bold;">Categorias:</td>
                            
                            <td id="td"><p><?php foreach($resCategoria as $cat){ ?><?php echo $cat['name_cat']?>, <?php } ?></p></td>
                            
                        
                    </tr>

                    <tr id="tr">
                        
                            <td style="font-weight: bold;">Autores Totales:</td>
                            
                            <td id="td"><p><?php foreach($resLibro as $libro){ ?><?php echo $libro['autor_book']?>,  <?php } ?></p></td>
                            
                        
                    </tr>
                    
                        
                    
                    
                        
                    <tr>
                        <td style="font-weight: bold;">Total libros vendidos:</td>
                        <td><?php echo $sumabooks ?></td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Profit:</td>
                        <td style=" color: #04db7e;">+12%</td>
                    </tr>
                    <!-- Aqui esta las categorias disponibles-->
                    <tr>
                        <tr><td style="font-size:19px; color: #afafaf;">Categorias disponibles</td></tr>
                        <?php foreach($res as $cat){ ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo $cat['name_cat']?></td>
                            <td><?php echo $cat['stock_book']?></td>
                        </tr>
                        <?php } ?>
                    </tr>

                    <tr>
                        <tr><td style="font-size:19px; color: #afafaf;">Nombres de Libros Disponible.</td></tr>
                        <?php foreach($resLibro as $libroDisponible){ ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo $libroDisponible['name_book']?></td>
                            <td style="font-weight: bold;"><?php echo $libroDisponible['stock_book']?></td>       
                        </tr>
                        <?php } ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Body Center end-->

<?php include("../inc/footer.php"); ?>
    
</body>
</html>



