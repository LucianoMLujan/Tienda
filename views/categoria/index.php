<h1>Gestionar categorias</h1>

<a href="<?= base_url?>categoria/crear" class="button button-small">Nueva Categoria</a>

<table>
    <tr>
        <th>ID</th>
        <th>DESCRIPCIÓN</th>
    </tr>
    <?php while($cat = $categorias->fetch_object()) : ?>
        <tr>
            <td><?= $cat->id ?></td>
            <td><?= $cat->descripcion ?></td>
        </tr>
    <?php endwhile; ?>
</table>