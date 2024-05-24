<?php

    include("../models/productosDAO.php");
    $productoDAO = new ProductoDAO();
    $updateProduct = $productoDAO->updateProduct($_GET['id'], $_GET['titulo'], $_GET['descripcion'], $_GET['precio'], $_GET['stock']);
    print_r(json_encode($updateProduct));

?>