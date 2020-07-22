<?php

require_once 'models/Producto.php';

class CarritoController {

    public function index() {
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        }else{
            $carrito = array();
        }

        require_once 'views/carrito/index.php';
    }

    public function agregar() {

        if(isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        }else{
            header("Location:".base_url);
        }

        if(isset($_SESSION['carrito'])) {
            $contador = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $contador++;
                }
            }
        }

        if(!isset($contador) || $contador == 0) {
            //Conseguir producto
            $producto = new Producto();
            $producto = $producto->getById($producto_id);

            //Añadir al carrito
            if(is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header("Location:".base_url."carrito/index");
    }

    public function remover() {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location:".base_url."carrito/index");
    }

    public function eliminar() {
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/index");
    }

    public function up() {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location:".base_url."carrito/index");
    }

    public function down() {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location:".base_url."carrito/index");
    }

}