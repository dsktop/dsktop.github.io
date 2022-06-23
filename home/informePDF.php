<?php
	error_reporting(0);
	require '../cnx.php';
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

?>

<?php
ob_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <Link rel="stylesheet" href="style.css"/>
        <title>Inventario PDF</title>
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
	 	} 
 	?>

<div id="body-content2" style="color: black;">
        <div>
            <p>EN ESTE PRESENTE PDF SE MUESTRA EL STOCK DISPONIBLE.</p>
                <table id="tabla-inv" cellspacing="0" cellpadding="10">
                <tr><td style="font-size:19px; color: #afafaf;">Resumen:</td></tr>
                    <tr>
                        <td style="font-weight: bold;">Total Libros disponibles:</td>
                        <td><?php echo $suma?></td>
                    </tr>
                    
                    <tr>
                    <td style="font-weight: bold;">Categorias:</td>
                        <?php foreach($resCategoria as $cat){ ?>
                        <td><?php echo $cat['name_cat']?>,</td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Autores Totales:</td>
                        <?php foreach($resLibro as $libro){ ?>
                        <td><?php echo $libro['autor_book']?>,</td>
                        <?php } ?>
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
                        <td style="font-size:19px; color: #afafaf;">Categorias disponibles</td>
                        <?php foreach($res as $cat){ ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo $cat['name_cat']?></td>
                            <td><?php echo $cat['stock_book']?></td>
                        </tr>
                        <?php } ?>
                    </tr>

                    <tr>
                        <td style="font-size:19px; color: #afafaf;">Nombres de Libros Disponible.</td>
                        <?php foreach($resLibro as $libroDisponible){ ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo $libroDisponible['name_book']?></td>       
                        </tr>
                        <?php } ?>
                    </tr>
               </table>
        </div>
</div>
</body>
</html>

<?php
$html= ob_get_clean();

require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("inventario_.pdf", array("Attachment" => true));
?>