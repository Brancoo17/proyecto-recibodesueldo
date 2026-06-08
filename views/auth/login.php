<?php /** @var Model\Empleado $auth */ ?>

<h1 class="nombre-pagina">Iniciar Sesión</h1>
<p class="descripcion-pagina">Inicia Sesión con tu cuenta</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/" method="POST" class="formulario">

    <div class="campo">
        <label for="dni">DNI:</label>
        <input type="number" id="dni" placeholder="Ingresa tu DNI" name="dni" value="<?php echo s($auth->dni); ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>

        <div class="campo-password">
            <input type="password" id="password" placeholder="Ingresa tu contraseña" name="password">
            <button type="button" class="toggle-password" data-target="password"></button>
        </div>
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿No tienes una cuenta? Crear una</a>
    <a href="/admin-login">Ingresar como administrador</a>
</div>