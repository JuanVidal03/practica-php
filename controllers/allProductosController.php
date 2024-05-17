<?php

    include('../models/productosDAO.php');

    $productoDAO = new ProductoDAO();
    $productos = $productoDAO->getAllProducts();
    print_r(json_encode($productos));

?>