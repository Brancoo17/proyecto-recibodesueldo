<?php
/** @var Model\Empleado $empleado */
?>

<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el formulario para crear una cuenta</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($empleado->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($empleado->apellido); ?>">
    </div>

    <div class="campo">
        <label for="dni">DNI:</label>
        <input type="number" id="dni" name="dni" placeholder="Tu DNI" value="<?php echo s($empleado->dni); ?>">
    </div>

    <div class="campo">
        <label for="cuil">CUIL:</label>
        <input type="number" id="cuil" name="cuil" placeholder="Tu CUIL" value="<?php echo s($empleado->cuil); ?>">
    </div>

    <div class="campo">
        <label for="empresa">Empresa:</label>
        <select name="empresa" id="empresa">
            <option value="" disabled selected>---Seleccione una empresa---</option>
            <option value="Transal SRL">Transal SRL</option>
            <option value="Ale Hnos.">Ale Hnos.</option>
            <option value="Empresa 3">Empresa 3</option>
        </select>
    </div>

    <div class="campo">
        <label for="password">Password:</label>

        <div class="campo-password">
            <input type="password" id="password" name="password" placeholder="Tu Password">
            <button type="button" class="toggle-password" data-target="password"></button>
        </div>
    </div>

    <div class="campo">
        <label for="password2">Confirmar Password:</label>

        <div class="campo-password">
            <input type="password" id="password2" name="password2" placeholder="Confirmar Password">
            <button type="button" class="toggle-password" data-target="password2"></button>
        </div>
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/admin-login">Ingresar como administrador</a>
</div>