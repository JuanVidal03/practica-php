<?php

    include("../models/productosDAO.php");
    $productosDAO = new ProductoDAO();
    $eliminarProduto = $productosDAO->deleteProduct($_REQUEST['id']);
    
?>