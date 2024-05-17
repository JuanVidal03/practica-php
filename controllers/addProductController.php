<?php

    include("../models/productosDAO.php");
    $productoDAO = new ProductoDAO();
    // $addProduct = $productoDAO->addProduct($_GET['titulo'], $_GET['descripcion'], $_GET['precio'], $_GET['stock']);
    $productoDAO->addProduct($_GET['titulo'], $_GET['descripcion'], $_GET['precio'], $_GET['stock']);

?>