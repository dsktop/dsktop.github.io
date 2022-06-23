<?php
error_reporting(0);
require '../cnx.php';
$ruta = '../';
$codBook = $_POST['codBook'] ? $_POST['codBook'] : $_GET['codBook'];
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
        $sqlUpdate = "UPDATE `books` SET `id_cat` = ?, `name_book` = ?, `autor_book` = ?, `edit_book` = ?, `stock_book` = ?, `file_book` = ? WHERE `id_books` = ?;";
        $psUpdate = $cnx->prepare($sqlUpdate);
        $psUpdate->execute(array($categoria_book, $name_book, $autor_book, $editorial_book, $stock_book, $rutaImg, $codBook));
        if ($psUpdate->rowCount()) {
            $msgGeneral = "Modificacion correcta";
        } else {
            $msgGeneral = "Modificacion incorrecta";
        }
    } else {
        $msgGeneral = 'Faltan campos necesarios';
        
    }
}

$sqlSelect = "SELECT * FROM `categorias`;";
$ps = $cnx->prepare($sqlSelect);
$ps->execute();
$resCategoria = $ps->fetchAll();

$sqlInner = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat WHERE id_books = $codBook;";
$psInner = $cnx->prepare($sqlInner);
$psInner->execute();
$resLibroMod = $psInner->fetchAll();

include("../inc/header.php");
?>


<!--Body Center, Aqui va el contenido-->
<div id="body-content" style="color: black;">

    <div id="body-center">
        <div id="body-header-static" style=" margin-left: 5rem; margin-top: 2rem; margin-bottom: 3rem;">
            <p>Modificar Libro</p>
        </div>

        <form action="modificar.php" method="POST" enctype="multipart/form-data">
            <?php foreach ($resLibroMod as $libro) { ?>

                <div id="vista-previa-container" style="display: inline-flex;height: 30rem;">
                    <div id="input-añadir-libro">
                        <p>Nombre</p>
                        <input type="text" name="name_book" id="name_book" value="<?php echo $libro['name_book'] ?>">
                        <p>Autor</p>
                        <input type="text" name="autor_book" id="autor_book" value="<?php echo $libro['autor_book'] ?>">
                        <p>Editorial</p>
                        <input type="text" name="editorial_book" id="editorial_book" value="<?php echo $libro['edit_book'] ?>">
                        <p>Categoria</p>
                        <select id="selectM" name="categoria_book">
                            <option class="optionM" value="<?php echo $libro['id_cat'] ?>" selected><?php echo $libro['name_cat'] ?></option>
                            <?php foreach ($resCategoria as $cat) { ?>
                                <option class="optionM" value="<?php echo $cat['id_cat'] ?>"><?php echo $cat['name_cat'] ?></option>
                            <?php } ?>
                        </select>
                        <p>Stock</p>
                        <input type="number" name="stock_book" id="stock_book" value="<?php echo $libro['stock_book'] ?>">
                        <input type="hidden" name="codBook" id="codBook" value="<?php echo $libro['id_books'] ?>">
                        <input type="hidden" name="enviado" id="enviado" value="1">
                        <div id="btns-under-input-aña">
                            <button type="button" style="border: #7c7c7c solid 2px; margin-right: 2rem;"><a href="../home/index.php" style="color: #686767;">CANCELAR</a></button>
                            <a href=""><button id="aplicar">APLICAR</button></a>
                            <p style="margin-top:1rem;"><?php echo $msgGeneral; ?></p>
                    </div>
                    </div>
                    <div id="vista-previa">
                        <p style="margin-left: 1rem; margin-top: 1rem; position: absolute">VISTA PREVIA</p>
                        <img id="caratula" src="<?php echo $libro['file_book']; ?>">
                    </div>
                </div>
                <div id="btn-under-vista-previa" style="margin-left: 61rem; display: inline-flex;">
                    <p>Portada / Caratula</p>
                    <button type="button" id="btn-subir-aña">
                        <label for="file_button">SUBIR</label>
                        <input type="file" id="file_button" name="imagen" class="inputfile">
                    </button>
                </div>
            </form>
            <?php }?>
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