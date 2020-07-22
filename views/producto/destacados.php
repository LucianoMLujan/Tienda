<h1>Algúnos de nuestros productos.</h1>

<?php while($prod = $productos->fetch_object()) : ?>
    <div class="product">
        <a href="<?=base_url?>producto/ver&id=<?=$prod->id?>">
            <?php if($prod->imagen != null) : ?>
                <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" alt="Fondo">
            <?php else: ?>
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Fondo">
            <?php endif; ?>
            <h2><?=$prod->nombre?></h2>
        </a>
        <p><?=$prod->precio?></p>
        <a href="<?=base_url?>carrito/agregar&id=<?=$prod->id?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>

