<?php

require_once 'models/Categoria.php';
require_once 'models/Producto.php';

class CategoriaController {

    public function index() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function guardar() {
        Utils::isAdmin();

        if(isset($_POST) && isset($_POST['nombre'])) {
            //Guardar en la bd
            $categoria = new Categoria();
            $categoria->setDescripcion($_POST['nombre']);
            $categoria->save();
        }

        
        header("Location:".base_url."categoria/index");
    }

    public function verCategoria() {
        if(isset($_GET['id'])) {

            //Obtener categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria = $categoria->getById($id);

            //Obtener productos
            $producto = new Producto();
            $productos = $producto->getByCategoryId($id);
        }

        require_once 'views/categoria/ver.php';
        
    }

}