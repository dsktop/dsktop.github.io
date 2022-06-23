<?php 
require '../cnx.php';
$idVendido = $_POST['id-vendido'] ? $_POST['id-vendido']: $_GET['id-vendido'];

$sqlSelect = "SELECT * FROM books WHERE id_books = $idVendido;";
$psSelect = $cnx->prepare($sqlSelect);
$psSelect->execute(); 
$resLibro = $psSelect->fetchAll();

foreach ($resLibro as $libro){
    header("location: ../home/index.php");

if ($idVendido) {
    if($libro['stock_book']){
        $sqlUpdate = "UPDATE `books` SET `vendidos_book` = ? WHERE `id_books` = ?;";
        $psUpdate = $cnx->prepare($sqlUpdate);
        $psUpdate->execute(array($libro['vendidos_book']+1, $idVendido));

        $sqlUpdateStock = "UPDATE `books` SET `stock_book` = ? WHERE `id_books` = ?;";
        $psUpdateStock = $cnx->prepare($sqlUpdateStock);
        $psUpdateStock->execute(array($libro['stock_book']-1, $idVendido));
    }
    if ($psUpdate->rowCount()) {
        echo "modificacion correcta";
        header("location: ../home/index.php");
    } else {
        echo "modificacion incorrecta";
    }
    
} 
}
