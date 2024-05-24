# Practica de PHP - SENA
En esta practica se elabora un proyecto backend de una tienda de producto, haciendo conexion con una base de datos MySQL, siguiendo las practicas del model MVC.

## Instalacion
Para poder correr este proyecto se tiene que contar con las herramientas MySQL y php. Una opcion muy popular es usar el gestor de paquetes XAMPP/LAMPP

### Descripcion del proyecto
En este proyecto se busca realizar un software desarrollado tanto con el MVC y generando una API para poder consumirla desde cualquier tecnologia de frontend, ya sea React, Angular, Vue, entre otras tecnologias.

### Estructura del proyecto
+ **models:** Se encuentra la clase ProductoDAO y sus respectivos metodos para poder desarrollar el CRUD.
+ **DB:** En el archivo 'Conexion.php' se encuentra la conexion con la base de datos
+ **controllers:** Esta es la parte en donde se modulariza la logica del backend para luego poder consumirlo desde el archivo JavaScript.