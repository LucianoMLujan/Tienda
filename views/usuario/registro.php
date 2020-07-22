<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
    <strong class="alert-green">Registro completado correctamente.</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>    
    <strong class="alert-red">Error al guardar, verifique los datos.</strong>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>

<form action="<?=base_url?>usuario/guardar" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required />

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" required />

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required />

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />

    <input type="submit" value="Registrarse" />

</form>