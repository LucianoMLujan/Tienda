<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>Pedido confirmado.</h1>
    <p>Tu pedido ha sido guardado con exito, una vez que realices el pago, el pedido será procesado y enviado.</p>
    <br/>
    
    <?php if(isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>
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

<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>El pedido no se ha podido confirmar.</h1>
<?php endif; ?>