<?php
    require_once("./Conexion.php");

    class ProductoDAO{
   
        public $id;
        public $titulo;
        public $descripcion;
        public $precio;
        public $stock;
        

        public function __construct($id, $titulo, $descripcion, $precio, $stock) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->stock = $stock;
        }

        // obteniedno todos los productos
        public function getAllProducts(){

            try {
                
                $instancia = new Connection('localhost', 'root', '', 'php-test');
    
                $conexion = $instancia->conectar();
                $query = $conexion->prepare("SELECT * FROM productos");
                $query->execute();
                $productos = $query->fetchAll(PDO::FETCH_ASSOC);
                
                print_r(json_encode($productos));
                
                // desconectar la conexion
                $desconectar = $instancia->desconectar();
                
            } catch (PDOException $e) {
                echo "Algo ha salido mal: {$e}";
            }
        }
        

        
    }

?>