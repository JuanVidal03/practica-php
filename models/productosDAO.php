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
            
                return $productos;

                $instancia->desconectar();
                
            } catch (PDOException $e) {
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

                return "Producto eliminado con exito!";
                # print_r(json_encode("Producto eliminado con exito!"));

            } catch(PDOException $e){
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
                return "Producto agregado con exito!";

            } catch (PDOException $e) {
                echo "Error al agregar producto: {$e->getMessage()}";
            }
        }

    }
?>