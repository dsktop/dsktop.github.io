<?php 
require '../cnx.php';
if($_POST['eliminarSeleccion']){
    if($_POST['check1']){
        foreach($_POST['check1'] as $id_borrar){
            $sqlDelete = "DELETE FROM `books` WHERE `id_books` = '$id_borrar';";
            $psDelete = $cnx->prepare($sqlDelete);
            $psDelete->execute(array());
            if($psDelete->rowCount()){
                header("Location:../home/index.php");
            }
        }
    }else{
        header("Location:../home/index.php");
    }   
}
?>