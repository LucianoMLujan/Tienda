<h1>Detalle del pedido.</h1>

<?php if(isset($pedido)) : ?>

    <?php if (isset($_SESSION['admin'])) :?>
        <h3>Cambiar estado del pedido.</h3>
        <form action="<?=base_url?>pedido/cambiarEstado" method="post">
            <input type="hidden" name="pedido_id" value="<?=$pedido->id?>" />
            <select name="estado" id="estado">
                <option value="confirmado"<?=$pedido->estado == "confirm" ? 'selected' : '' ?>>Pendiente.</option>
                <option value="preparacion"<?=$pedido->estado == "preparacion" ? 'selected' : '' ?>>En preparación.</option>
                <option value="preparado"<?=$pedido->estado == "preparado" ? 'selected' : '' ?>>Preparado para enviar.</option>
                <option value="enviado"<?=$pedido->estado == "enviado" ? 'selected' : '' ?>>Enviado.</option>
            </select>
            <input type="submit" value="Cambiar estado" />
        </form>
        <br/>
    <?php endif; ?>

    <h3>Datos del envio:</h3>
    Provincia:<?=$pedido->provincia?>
    <br/>
    Ciudad:<?=$pedido->localidad?>
    <br/>
    Dirección:<?=$pedido->direccion?>
    <br/><br/>
    
    <h3>Datos del pedido:</h3>
    Estado del pedido:<?=Utils::showStatus($pedido->estado)?>
    <br/>
    Número de pedido:<?=$pedido->id?>
    <br/>
    Total a pagar:<?=$pedido->coste?> $
    <br/>
    Productos:
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Unidades</th>
            <th>Precio</th>
        </tr>
        <?php while($producto = $productos->fetch_object()) : ?>
            <tr>
                <td>
                    <?php if($producto->imagen != null) : ?>
                        <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="Producto" class="img-carrito" />
                    <?php else: ?>
                        <img src="<?=base_url?>assets/img/camiseta.png" alt="Producto" class="img-carrito" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
                </td>
                <td>
                    <?=$producto->unidades?>
                </td>
                <td>
                    <?=$producto->precio?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>