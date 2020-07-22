<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
</head>
<body>
    <div id="container">
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo" />
                <a href="<?=base_url?>">
                    Tienda
                </a>
            </div>
        </header>

        <!-- MENU -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href="<?=base_url?>categoria/verCategoria&id=<?=$cat->id?>"><?=$cat->descripcion?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>

        <div id="content">