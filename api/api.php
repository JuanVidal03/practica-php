<?php

    // DAO para manejar los productos
    include("../models/productosDAO.php");
    $productoDAO = new ProductoDAO();

    // tipo de data que puede recibir
    header("Content-Type: application/json");
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, DELETE"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
    // obteniendo el metodo de la peticion
    $method = $_SERVER["REQUEST_METHOD"];

    // validando el metodo para ejecutar su funcion
    switch ($method) {
        case 'GET':

            $productos = $productoDAO->getAllProducts();
            echo json_encode($productos);
            break;

        case 'POST':
            // obteniendo data
            $data = json_decode(file_get_contents('php://input', true));
            $producto = $productoDAO->addProduct($data->titulo, $data->descripcion, $data->precio, $data->stock);
            echo $producto;
            break;

        case 'PUT':
            // obteniendo data
            $data = json_decode(file_get_contents('php://input', true));
            $updateProduct = $productoDAO->updateProduct($data->id, $data->titulo, $data->descripcion, $data->precio, $data->stock);
            echo $updateProduct;
            break;

        case 'DELETE':
            // verificando si hay un id en el path y extrayendolo
            $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
            $buscarId = explode('/', $path);
            $id = $buscarId != '/' ? end($buscarId) : null;
            // eliminando el producto
            $deleteProduct = $productoDAO->deleteProduct($id);
            echo $deleteProduct;
            break;
        
        default:
            echo 'Metodo no disponible :(';
            break;
    }

?>