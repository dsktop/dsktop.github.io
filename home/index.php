<?php
error_reporting(0);
require '../cnx.php';
$ruta = '../';
$sqlBuscar = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat";
if ($_POST['buscar_id']) {
    $buscarId = $_POST['buscar_id'];
    $sqlBuscar = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat WHERE id_books = $buscarId;";
    $psBuscar = $cnx->prepare($sqlBuscar);
    $psBuscar->execute();
    $resBuscar = $psBuscar->fetchAll();
}
if ($_POST['aplicar']) {
    $buscarAutor = $_POST['buscar_autor'];
    $buscarEdit = $_POST['buscar_edit'];
    $buscarCat = $_POST['buscar_cat'];
    $sqlBuscar = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat ";

    if ($_POST['buscar_name']) {
        $sqlBuscar .= "WHERE name_book LIKE '%" . $_POST['buscar_name'] . "%' ";
        if ($_POST['buscar_autor']) {
            $sqlBuscar .= " AND autor_book = '$buscarAutor' ";
        }
        if ($_POST['buscar_edit']) {
            $sqlBuscar .= " AND edit_book = '$buscarEdit' ";
        }
        if ($_POST['buscar_cat']) {
            $sqlBuscar .= " AND books.id_cat = '$buscarCat' ";
        }
    } else {
        if ($_POST['buscar_autor']) {
            $sqlBuscar .= " WHERE autor_book = '$buscarAutor' ";
        }
        if ($_POST['buscar_edit']) {
            $sqlBuscar .= " AND edit_book = '$buscarEdit' ";
        }
        if ($_POST['buscar_cat']) {
            $sqlBuscar .= " AND books.id_cat = '$buscarCat' ";
        }
    }
    $psBuscar = $cnx->prepare($sqlBuscar);
    $psBuscar->execute();
    $resBuscar = $psBuscar->fetchAll();
}
$psBuscar = $cnx->prepare($sqlBuscar);
$psBuscar->execute();
$resBuscar = $psBuscar->fetchAll();

$sqlInner = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat;";
$psInner = $cnx->prepare($sqlInner);
$psInner->execute();
$resLibro = $psInner->fetchAll();

$sqlSelect = "SELECT * FROM `categorias`;";
$ps = $cnx->prepare($sqlSelect);
$ps->execute();
$resCategoria = $ps->fetchAll();
include("../inc/header.php");
?>


<!--Body Center, Aqui va el contenido-->

<div id="body-content" style="color: black;">
    <div id="btns-header" style="margin-left: 57rem; margin-top: 2rem; display:inline-flex;">
        <form action="../CRUD/eliminarSeleccion.php" method="POST">
            <a href=""><button type="submit" id="btn-eliminarS" class="btns-header btn-eli" name="eliminarSeleccion" value="1">Eliminar Selección</button></a>
            <a href="informe.php" style="text-decoration: none; color: black;"><button type="button" id="btn-generar" class="btns-header" style="border: #cccccc solid 2px;">Generar informe</button></a>
    </div>
    <div id="body-center">
        <div style=" margin-left: 2rem; margin-top: 2rem; ">

            <table id="body-header-static" cellspacing="0" cellpadding="15">
                <tr id="header-t" style="color:#7e7e7e; font-size:17px;">
                    <td style="padding-right:3rem; width: 20px; height: 20px;"><input style="width: 20px; height: 20px;" type="checkbox" onClick="toggle(this)" name="check0" id="checkbox0"></td>
                    <td>id</td>
                    <td style="padding-right:4rem;">Nombre</td>
                    <td style="padding-right:4rem;">Editorial</td>
                    <td>Categorias</td>
                    <td>Stock</td>
                    <td>Vendidos</td>
                </tr>
                <tbody>
                    <?php foreach ($resBuscar as $buscar) { ?>
                        <tr id="body-header-static1" style="color:black; font-weight: bold; font-size:17px; height: 5.4rem;">
                            <td class="td-inv"><input style="width: 20px; height: 20px;" type="checkbox" name="check1[]" value="<?php echo $buscar['id_books'] ?>"></td>
                            <td class="td-inv" style="text-align: center;"><?php echo $buscar['id_books'] ?></td>
                            <td class="td-inv"><?php echo $buscar['name_book'] ?></td>
                            <td class="td-inv"><?php echo $buscar['edit_book'] ?></td>
                            <td class="td-inv" style="text-align: center;"><?php echo $buscar['name_cat'] ?></td>
                            <td class="td-inv" style="text-align: center;"><?php echo $buscar['stock_book'] ?></td>
                            <td class="td-inv" style="text-align: center;"><?php if (!$buscar['vendidos_book']) {
                                                                                echo 0;
                                                                            } else {
                                                                                echo $buscar['vendidos_book'];
                                                                            } ?></td>
                            <td><a href="..\CRUD\vendido.php?id-vendido=<?php echo $buscar['id_books']; ?>&x=" style="text-decoration: none; color: white;"><button type="button" name="id-vendido" id="btn-vendido" style="border:none;" class="btns-center" value="<?php echo $buscar['id_books'] ?>">Vendido!</button></a></td>
                            <td><a href="..\CRUD\modificar.php?codBook=<?php echo $buscar['id_books']; ?>&x=" style="text-decoration: none; color: black; "><button type="button" id="btn-modificar" class="btns-center">Modificar</button></a></td>
                            <td><a href="..\CRUD\eliminar.php?id-eliminado=<?php echo $buscar['id_books']; ?>&x=" style="text-decoration: none; color: white;"><button type="button" name="id-eliminado" id="btn-eliminar" class="btns-center">Eliminar</button></a></td>
                        </tr>
                </tbody>
            <?php } ?>
            </table>
            </form>
        </div>
    </div>

</div>
</div>
<!--Body Center end-->

<?php include("../inc/footer.php"); ?>
<script>
    window.onload = function() {
        let productos = document.getElementById('Productos-navbar');
        let dash = document.getElementById('Dashboard-navbar');
        let categorias = document.getElementById('Categorias-navbar');
        productos.style.borderBottom = '#ff2163 solid 3px';
        productos.style.fontWeight = 'bold';

        productos.addEventListener('click', function() {
            productos.style.borderBottom = '#ff2163 solid 3px';
            productos.style.fontWeight = 'bold';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        // dash.addEventListener('click', function() {
        //     productos.style.borderBottom = 'none';
        //     productos.style.fontWeight = 'normal';
        //     // dash.style.borderBottom = '#ff2163 solid 3px';
        //     // dash.style.fontWeight = 'bold';
        //     categorias.style.borderBottom = 'none';
        //     categorias.style.fontWeight = 'normal';
        // })

        // categorias.addEventListener('click', function() {
        //     productos.style.borderBottom = 'none';
        //     productos.style.fontWeight = 'normal';
        //     dash.style.borderBottom = 'none';
        //     dash.style.fontWeight = 'normal';
        //     // categorias.style.borderBottom = '#ff2163 solid 3px';
        //     // categorias.style.fontWeight = 'bold';
        // })
    }

    function toggle(source) {
        checkboxes = document.getElementsByName('check1[]');
        var btn2 = document.getElementsByClassName('btn-eli')[0]
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;



        }


    }

    document.querySelector("#clean").addEventListener("click", function() {
        document.querySelector("#select").value = "value1";
        document.querySelector(".select1").value = "value1";
        document.querySelector(".select2").value = "value1";
        document.querySelector(".select3").value = "value1";
    })
</script>
<!-- <script>
    var btn = document.getElementsByClassName('btn-eli')[0]
    var check = document.querySelector("#checkbox0");
    check.addEventListener("click", function() {


        while(check.checked == false){
            
            
            if(check.checked == true){
                btn.classList.toggle('night');
                break;
            }
            if(check.checked == false){
                continue;
            }
        }
       
        // if(check.checked == true){
        //     btn.classList.toggle('night');
            
        // }
        // else(check.checked == false) {
        //     btn.classList.toggle('night21');
        //     break;
        // }
        
    })
</script> -->

<!-- <script>
        function checar() {
        
        var btn2 = document.getElementsByClassName('btn-eli')[0]
        
        checkboxes = document.getElementsByName('check1');
        
        for (var i = 0; i < checkboxes.length; i++) {
            // if(checkboxes[i].checked == true){
            //     btn2.classList.toggle('night2');
            //     break;
            // }
            // else{
            //     btn2.classList.toggle('night21');
            // }
            
            
            
        }
        // checkboxes.addEventListener("click", function() {
           
            
        // })
            
        }


        


        

        

   
</script>  -->