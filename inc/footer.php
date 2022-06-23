    <?php
    error_reporting(0);
    $sqlInner = "SELECT * FROM books INNER JOIN categorias ON books.id_cat = categorias.id_cat;";
    $psInner = $cnx->prepare($sqlInner);
    $psInner->execute();
    $resLibro = $psInner->fetchAll();

    ?>
    <!--Barra Lateral-->
    <div id="barra-lateral-container">
        <div id="side-bar-content">
            <p style="color: #a9b0bb;">FILTRAR PRODUCTOS</p>
            <form action="<?php echo $ruta, 'home/index.php' ?>" method="POST">
                <div id="search" style="margin-top: 1rem;">
                    <input id="buscar-inventario" type="number" placeholder="Buscar por ID" name="buscar_id" value="<?php echo $_POST['buscar_id'] ?>">
                    <button id="btn-search" name="buscarId"><img src="..\img\lupa.PNG" alt=""></button>
                </div>
            </form>

            <form action="<?php echo $ruta, 'home/index.php' ?>" method="POST">
                <div class="desplegables" id="id">
                    <p>Nombre</p>
                    <input placeholder="Todos" type="text" id="select2" name="buscar_name" value="<?php echo $_POST['buscar_name'] ?>">
                </div>
                <div class="desplegables" id="nombre">
                    <p>Autor</p>
                    <select id="select" class="select1" name="buscar_autor">
                        <option class="option" value="" selected> Todos</option>
                        <?php foreach ($resLibro as $libro) { ?>
                            <option class="option" value="<?php echo $libro['autor_book'] ?>"><?php echo $libro['autor_book'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="desplegables" id="grupo">
                    <p>Editorial</p>
                    <select id="select" class="select2" name="buscar_edit">
                        <option class="option" value="" selected> Todos</option>
                        <?php foreach ($resLibro as $libro) { ?>
                            <option class="option" value="<?php echo $libro['edit_book'] ?>"> <?php echo $libro['edit_book'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="desplegables" id="categoria">
                    <p>Categoria</p>
                    <select id="select" class="select3" name="buscar_cat">
                        <option class="option" value="" selected> Todos</option>
                        <?php foreach ($resCategoria as $cat) { ?>
                            <option class="option" value="<?php echo $cat['id_cat'] ?>"><?php echo $cat['name_cat'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="asendente-desendente" style="margin-top: 2rem;">
                    <!-- <input type="radio" id="asendente" name="orden" value="AS"> -->
                    <label for="asendente"></label><br>
                    <!-- <input type="radio" id="desendente" name="orden" value="DE"> -->
                    <label for="desendente"></label><br>
                </div>
                <div id="botones-sidebar">
                    <input style="cursor: pointer;" type="button" id="clean" value="Limpiar Filtros">
                    <input style="cursor: pointer;" type="submit" id="apply" value="Aplicar" name="aplicar">
                </div>
            </form>

            <div id="img-logo">
                <img style="width: 5rem; margin-top: 10rem;" src="..\img\libronegro.PNG" alt="">
            </div>
        </div>
    </div>
    <!--Barra Lateral end-->
    <style>
        #select2 {
            margin-top: 0.7rem;
            width: 98%;
            height: 2.3rem;
            border-radius: 10px;
            background: white;
            color: black;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 16px;
            border: none;
        }
    </style>
    </body>

    </html>