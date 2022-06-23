<?php
error_reporting(0);
require '../cnx.php';
$ruta = '../';
if ($_POST['enviado']) {
    $name_book = $_POST['name_book'];
    $autor_book = $_POST['autor_book'];
    $categoria_book = $_POST['categoria_book'];
    $editorial_book = $_POST['editorial_book'];
    $stock_book = $_POST['stock_book'];

    
    $nombreImagen = $_FILES['imagen']['name'];
    $archivo =$_FILES['imagen']['tmp_name'];
    $rutaImg = '../img/upload';
    $rutaImg = $rutaImg."/".$nombreImagen;

    move_uploaded_file($archivo, $rutaImg);




    $msgGeneral = "";
    $validacion = True;


    if (!$name_book) {
        $validacion = False;
    }
    if (!$categoria_book) {
        $validacion = False;
    }
    if ($validacion) {
        $sqlInsert = "INSERT INTO `books`(`id_cat`, `id_user`, `name_book`, `autor_book`, `edit_book`, `stock_book`, `file_book`) VALUES (?,?,?,?,?,?,?);";
        $psInsert = $cnx->prepare($sqlInsert);
        $psInsert->execute(array($categoria_book, 1, $name_book, $autor_book, $editorial_book, $stock_book, $rutaImg));
        if ($psInsert->rowCount()) {
            $msgGeneral = 'Se agrego correctamente';
        }
    } else {
        $msgGeneral = 'Todos los campos son necesarios';
        // echo $msgGeneral;
    }
}
$sqlSelect = "SELECT * FROM `categorias`;";
$ps = $cnx->prepare($sqlSelect);
$ps->execute();
$resCategoria = $ps->fetchAll();
include("../inc/header.php");
?>
<!--Body Center, Aqui va el contenido-->
<div id="body-content" style="color: black;">
    <div id="body-center">
        <div id="body-header-static" style=" margin-left: 5rem; margin-top: 2rem; margin-bottom: 3rem;">
            <p>Añadir Libro</p>
        </div>
        <form action="añadirLibro.php" method="POST" enctype="multipart/form-data">
            <div id="vista-previa-container" style="display: inline-flex; height: 30rem">
                <div id="input-añadir-libro">
                    <p>Nombre</p>
                    <input type="text" name="name_book" id="name_book">
                    <p>Autor</p>
                    <input type="text" name="autor_book" id="autor_book">
                    <p>Editorial</p>
                    <input type="text" name="editorial_book" id="editorial_book">
                    <p>Categoria</p>
                    <select id="selectM" id="categoria_book" name="categoria_book">
                        <option class="optionM" value="" selected>Seleccionar Categoria</option>
                        <?php foreach ($resCategoria as $cat) { ?>
                            <option class="optionM" value="<?php echo $cat['id_cat'] ?>"><?php echo $cat['name_cat'] ?></option>
                        <?php } ?>
                    </select>
                    <p>Stock</p>
                    <input type="number" name="stock_book" id="stock_book">
                    <input type="hidden" name="enviado" id="enviado" value="1">
                    <div id="btns-under-input-aña">
                        <a href="../home/index.php" style="color: #686767;"><button type="button" id="cancelar" style="border: #7c7c7c solid 2px; margin-right: 2rem;">CANCELAR</button></a>
                        <a href=""><button id="aplicar">APLICAR</button></a>
                        <p style="margin-top:1rem;"><?php echo $msgGeneral; ?></p>
                    </div>
                </div>
                <div id="vista-previa">
                    <p style="margin-left: 1rem; margin-top: 1rem; position: absolute">VISTA PREVIA</p>
                </div>
            </div>
            <div id="btn-under-vista-previa" style="margin-left: 61rem; display: inline-flex;">
                <p>Portada / Caratula</p>
                <button type="button" id="btn-subir-aña">
                    <label for="file_button">SUBIR</label>
                    <input type="file" id="file_button" name="imagen" class="inputfile"">
                </button>
            </div>
            
        </form>
    </div>
</div>

<!--Body Center end-->

<?php include("../inc/footer.php"); ?>
<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
z-index: -1;}
</style>