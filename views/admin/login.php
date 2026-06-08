<h1 class="nombre-pagina">Iniciar Sesión</h1>
<p class="descripcion-pagina">Inicia Sesión como Administrador</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/admin/login" method="POST" class="formulario">

    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Ingresa tu Email" name="email">
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
    <a href="/">Ingresar como empleado</a>
</div>