<?php
/** @var Model\Empleado $empleado */
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

    <!-- CUERPO DE LA SECCIÓN -->
    <main class="contenido-empleado">
        <div class="grid-secciones">
            
            <!-- SECCIÓN 1: Recibos de Sueldo -->
            <div class="seccion-tarjeta">
                <h2>Recibos de Sueldo</h2>
                <a href="/recibos" class="tarjeta-enlace">
                    <div class="tarjeta-cuerpo">
                        <div class="tarjeta-icono">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-svg">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <line x1="10" y1="9" x2="8" y2="9"></line>
                            </svg>
                        </div>
                        <div class="tarjeta-texto">
                            <h3>Mis Recibos</h3>
                            <p>Visualiza tus recibos de sueldo digitales, fírmalos electrónicamente y descárgalos en PDF.</p>
                            <span class="tarjeta-accion">Ingresar →</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- SECCIÓN 2: Mi Cuenta -->
            <div class="seccion-tarjeta">
                <h2>Mi Cuenta</h2>
                <a href="/empleado/cuenta" class="tarjeta-enlace">
                    <div class="tarjeta-cuerpo">
                        <div class="tarjeta-icono">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-svg">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div class="tarjeta-texto">
                            <h3>Perfil & Configuración</h3>
                            <p>Consulta tus datos personales, CUIL y actualiza la contraseña de tu cuenta.</p>
                            <span class="tarjeta-accion">Gestionar →</span>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </main>
</div>
