<h1>Crear Categoria</h1>

<form action="<?=base_url?>categoria/guardar" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required/>

    <input type="submit" value="Guardar" />
</form>