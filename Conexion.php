<?php

    class Connection{
        // atributos para la conexion con la base de datos
        private $host;
        private $db_name;
        private $user;
        private $password;

        private $conexion;

        public function __construct($host, $user, $password, $db_name) {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->db_name = $db_name;
        }

        // inciar la conexion con la base de datos
        public function conectar(){
            try {

                $this->conexion = new PDO("mysql:host={$this->host}; dbname={$this->db_name}", $this->user, $this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $this->conexion;

            } catch (PDOException $e) {
                echo "Error de conexion: ".$e->getMessage();
            }
        }

        // desconectar
        public function desconectar() {
            try {
              $this->conexion = null;
            } catch (PDOException $e) {
              echo "Error al desconectar: " . $e->getMessage();
            }
        }

    }

?>