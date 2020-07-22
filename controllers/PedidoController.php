<?php

require_once 'models/Pedido.php';

class PedidoController {

    public function index() {
        require_once 'views/pedido/index.php';
    }

    public function guardar() {
        if(isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if($provincia && $ciudad && $direccion) {
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($ciudad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();
                //Guardar linea pedido
                $saveLinea = $pedido->saveLinea();

                if($save && $saveLinea) {
                    $_SESSION['pedido'] = 'complete'; 
                }else{
                    $_SESSION['pedido'] = 'failed';
                }
            }else{
                $_SESSION['pedido'] = 'failed';
            }

            header("Location:".base_url."pedido/confirmado");
        }else{
            header("Location:".base_url);
        }
    }

    public function confirmado() {

        if(isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido = $pedido->getLastByUser($identity->id);

            $pedidoProductos = new Pedido();
            $productos = $pedidoProductos->getProductosByPedido($pedido->id);

        }
        

        require_once 'views/pedido/confirmado.php';
    }

    public function misPedidos() {
        Utils::isLogged();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        //Obtener los pedidos del usuario
        $pedidos = $pedido->getAllByUser($usuario_id);

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle() {
        Utils::isLogged();

        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            //Obtener pedidos
            $pedido = new Pedido();
            $pedido = $pedido->getById($id);

            //Obtener productos
            $pedidos_productos = new Pedido();
            $productos = $pedidos_productos->getProductosByPedido($id); 

            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:".base_url."pedido/misPedidos");
        }

    }

    public function gestion() {
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function cambiarEstado() {
        Utils::isAdmin();
        if (isset($_POST)) {
            if(isset($_POST['pedido_id']) && isset($_POST['estado'])) {
                //Obtengo los datos
                $id = $_POST['pedido_id'];
                $estado = $_POST['estado'];

                //Actualizar del pedido
                $pedido = new Pedido();
                $pedido->setId($id);
                $pedido->setEstado($estado);
                $pedido->updateStatus();

                header("Location:".base_url.'pedido/detalle&id='.$id);
            }
        }else{
            header("Location:".base_url);
        }
    }

}