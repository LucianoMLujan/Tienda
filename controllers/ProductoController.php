<?php

require_once 'models/Producto.php';

class ProductoController {

    public function index() {
        //Renderizar vista
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        require_once 'views/producto/destacados.php';
    }

    public function ver() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto();
            $prod = $producto->getById($id);

            require_once 'views/producto/ver.php';
        }
    }

    public function gestion() {
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function guardar() {
        Utils::isAdmin();
        if(isset($_POST)) {
            $nombre = $_POST['nombre'] ? $_POST['nombre'] : false;
            $descripcion = $_POST['descripcion'] ? $_POST['descripcion'] : false;
            $precio = $_POST['precio'] ? $_POST['precio'] : false;
            $stock = $_POST['stock'] ? $_POST['stock'] : false;
            $categoria = $_POST['categoria'] ? $_POST['categoria'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                if(isset($_FILES['imagen'])) {
                    //Guardar la imagen
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {

                        if(!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                        $producto->setImagen($filename);
                    }
                }
                
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->update();
                }else{
                    $save = $producto->save();
                }
                

                if ($save) {
                    $_SESSION['producto'] = "complete";
                }else{
                    $_SESSION['producto'] = "failed"; 
                }
            }else{
                $_SESSION['producto'] = "failed";
            }
        }else{
            $_SESSION['producto'] = "failed";
        }

        header("Location:".base_url."producto/gestion");
    }

    public function editar() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar = true;

            $producto = new Producto();
            $prod = $producto->getById($id);

            require_once 'views/producto/crear.php';

        }else{
            header("Location:".base_url."producto/gestion");
        }
    }

    public function eliminar() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url."producto/gestion");
    }

}