<?php

    include("../DB/Conexion.php");

    class ProductoDAO{
   
        public $id;
        public $titulo;
        public $descripcion;
        public $precio;
        public $stock;

        // constructor
        public function __construct($id=null, $titulo=null, $descripcion=null, $precio=null, $stock=null) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->stock = $stock;
        }


        // obteniendo todos los productos
        public function getAllProducts(){
            try {

                $instancia = new Connection('localhost', 'root', '', 'php_test');
                $conexion = $instancia->conectar();
                $query = $conexion->prepare("SELECT * FROM productos");
                $query->execute();
                $productos = $query->fetchAll(PDO::FETCH_ASSOC);
                
                http_response_code(200);
                return $productos;

                $instancia->desconectar();
                
            } catch (PDOException $e) {
                http_response_code(500);
                echo "Algo ha salido mal: {$e}";
            }
        }

        // eliminar un producto
        public function deleteProduct(int $id){
            try {

                $instancia = new Connection('localhost','root', '', 'php_test');
                $conexion = $instancia->conectar();
                $query = $conexion->prepare("DELETE FROM productos WHERE id = $id");
                $query->execute();

                if ($query->rowCount() > 0) {
                    http_response_code(200);
                    return "Producto eliminado exitosamente!";
                } else {
                    http_response_code(400);
                    return "Ningun campo se ha sido eliminado.";
                }

                $instancia->desconectar();

            } catch(PDOException $e){
                http_response_code(500);
                echo "Error al eliminar producto: {$e->getMessage()}";
            }
        }

        // agregar producto
        public function addProduct(string $titulo, string $descripcion, float $precio, int $stock){
            try {

                $instancia = new Connection('localhost', 'root', '', 'php_test');
                $conexion = $instancia->conectar();
                $query = $conexion->prepare("INSERT INTO productos(titulo, descripcion, precio, stock) VALUES ('$titulo', '$descripcion', $precio, $stock)");
                $query->execute();

                http_response_code(200);
                return "Producto agregado con exito!";
                $instancia->desconectar();

            } catch (PDOException $e) {
                echo "Error al agregar producto: {$e->getMessage()}";
            }
        }

        // obteniendo producto por id
        public function productById(int $id){
            try {
                
                $instancia = new Connection('localhost', 'root', '', 'php_test');
                $conexion = $instancia->conectar();
                $query = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
                $query->bindParam(1, $id);
                $query->execute();
                $producto = $query->fetch(PDO::FETCH_ASSOC);

                if ($producto) {
                    http_response_code(200);
                    return $producto;
                } else {
                    http_response_code(400);
                    return 'El producto con id: '.$id.' no existe.';
                }

                $instancia->desconectar();

            } catch (PDOException $e) {
                http_response_code(500);
                echo "Error al encontrar el producto: {$e->getMessage()}";
            }
        }

        // actualizar producto
        public function updateProduct(int $id, string $titulo, string $descripcion, float $precio, int $stock){
            try {

                $instancia = new Connection('localhost', 'root', '', 'php_test');
                $conexion = $instancia->conectar();
                $query = $conexion->prepare("UPDATE productos SET titulo=?, descripcion=?, precio=?, stock=? WHERE id = ?");
                $query->bindParam(1, $titulo);
                $query->bindParam(2, $descripcion);
                $query->bindParam(3, $precio);
                $query->bindParam(4, $stock);
                $query->bindParam(5, $id);

                $query->execute(); 

                if ($query->rowCount() > 0) {
                    http_response_code(200);
                    return "Producto actualizado exitosamente";
                } else {
                    http_response_code(400);
                    return "Ningun campo se ha sido actualizado";
                }

                $instancia->desconectar();

            } catch (PDOException $e) {
                http_response_code(500);
                echo "Error al actualizar producto: {$e->getMessage()}";
            }
        }

    }
?>