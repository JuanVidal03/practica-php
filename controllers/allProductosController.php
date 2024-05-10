<?php

    include('../models/productosDAO.php');
    $productoDAO = new ProductoDAO();
    $productos = $productoDAO->getAllProducts();
    die();

    return json_encode($productos);

?>