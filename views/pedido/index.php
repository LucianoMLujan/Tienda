<?php if(isset($_SESSION['identity'])) : ?>
    <h1>Hacer pedido.</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver los productos seleccionados.</a>
    </p>
    <br/>
    <h3>Datos del envio:</h3>
    <form action="<?=base_url?>pedido/guardar" method="post">

        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" required/>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" required/>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" required/>

        <input type="submit" value="Confirmar pedido.">
    </form>

<?php else: ?>
    <h1>Necesitas estar identificado.</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>