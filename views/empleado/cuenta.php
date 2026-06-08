<?php
/** @var Model\Empleado $empleado */
/** @var array $alertas */
?>

<div class="dashboard-empleado">
    <!-- BARRA SUPERIOR -->
    <header class="header-empleado">
        <div class="header-logo">
            <h1>Recibos WEB <span>/ <?php echo s($empleado->empresa); ?></span></h1>
        </div>
        <div class="header-usuario">
            <p>Hola, <strong><?php echo s($empleado->nombre . ' ' . $empleado->apellido); ?></strong></p>
            <a href="/logout" class="boton-cerrar">Cerrar Sesión</a>
        </div>
    </header>

    <main class="contenido-empleado">
        <!-- Volver al panel -->
        <div class="enlace-volver">
            <a href="/empleado" class="boton-volver">← Volver al Panel</a>
        </div>

        <div class="grid-cuenta">
            <!-- COLUMNA 1: Datos Personales (Solo Lectura) -->
            <div class="tarjeta-datos">
                <h2>Mis Datos Personales</h2>
                <div class="tarjeta-cuerpo">
                    <p class="instruccion-datos">Estos datos son registrados por el departamento de recursos humanos y no pueden ser editados.</p>
                    
                    <div class="campo-lectura">
                        <span class="etiqueta">Nombre Completo:</span>
                        <span class="valor"><?php echo s($empleado->nombre . ' ' . $empleado->apellido); ?></span>
                    </div>

                    <div class="campo-lectura">
                        <span class="etiqueta">DNI:</span>
                        <span class="valor"><?php echo s($empleado->dni); ?></span>
                    </div>

                    <div class="campo-lectura">
                        <span class="etiqueta">CUIL:</span>
                        <span class="valor"><?php echo s($empleado->cuil); ?></span>
                    </div>

                    <div class="campo-lectura">
                        <span class="etiqueta">Empresa:</span>
                        <span class="valor"><?php echo s($empleado->empresa); ?></span>
                    </div>
                </div>
            </div>

            <!-- COLUMNA 2: Cambiar Contraseña (Formulario) -->
            <div class="tarjeta-contrasena">
                <h2>Seguridad</h2>
                <div class="tarjeta-cuerpo">
                    <h3>Actualizar Contraseña</h3>
                    <p class="instruccion-datos">Ingresa tu nueva contraseña y confírmala para actualizar tus credenciales de acceso.</p>

                    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

                    <form method="POST" action="/empleado/cuenta" class="formulario-cuenta">
                        <div class="campo">
                            <label for="password">Nueva Contraseña:</label>

                            <div class="campo-password">
                                <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres">
                                <button type="button" class="toggle-password" data-target="password"></button>
                            </div>
                            
                        </div>

                        <div class="campo">
                            <label for="password_confirm">Confirmar Contraseña:</label>

                            <div class="campo-password">
                                <input type="password" id="password_confirm" name="password_confirm" placeholder="Repite tu nueva contraseña">
                                <button type="button" class="toggle-password" data-target="password_confirm"></button>
                            </div>
                            
                        </div>

                        <input type="submit" value="Guardar Nueva Contraseña" class="boton">
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>