<?php

    include("../models/productosDAO.php");
    $productosDAO = new ProductoDAO();
    $producto = $productosDAO->productById($_GET['id']);
    print_r(json_encode($producto));

?>