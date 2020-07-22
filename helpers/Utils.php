<?php

class Utils {
    
    public static function deleteSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isAdmin() {
        if(!isset($_SESSION['admin'])) {
            header("Location:". base_url);
        }else{
            return true;
        }
    }

    public static function isLogged() {
        if(!isset($_SESSION['identity'])) {
            header("Location:". base_url);
        }else{
            return true;
        }
    }

    public static function showCategorias() {
        require_once 'models/Categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        return $categorias;
    }

    public static function statsCarrito() {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if(isset($_SESSION['carrito'])) {
            //$stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['count'] += $producto['unidades']; 
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }

        }

        return $stats;
    }

    public static function showStatus($status) {
        $value = 'Pendiente';

        if($status == 'confirmado') {
            $value = 'Pendiente.';
        }elseif($status == 'preparacion'){
            $value = 'En preparación.';
        }elseif ($status == 'preparado') {
            $value = 'Preparado para enviar.';
        }elseif ($status == 'enviado') {
            $value = 'Enviado.';
        }

        return $value;
    }

}