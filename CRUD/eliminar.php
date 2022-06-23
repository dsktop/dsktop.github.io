<?php 
require '../cnx.php';
$idEliminado = $_POST['id-eliminado'] ? $_POST['id-eliminado']: $_GET['id-eliminado'];

if ($idEliminado) {
    
    $sqlDelete = "DELETE FROM `books` WHERE `id_books` = ?;";
    $psDelete = $cnx->prepare($sqlDelete);
    $psDelete->execute(array($idEliminado));
    if($psDelete->rowCount()){
        header("Location:../home/index.php");
    }
}
?>