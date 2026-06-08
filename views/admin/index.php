<div class="dashboard-admin">
    <!-- BARRA SUPERIOR -->
    <header class="header-admin">
        <div class="header-logo">
            <h1>Recibos WEB <span>/ Panel Admin</span></h1>
        </div>
        <div class="header-usuario">
            <p>Hola, <strong><?php echo s($_SESSION['admin']['nombre'] ?? 'Administrador'); ?></strong></p>
            <a href="/admin/logout" class="boton-cerrar">Cerrar Sesión</a>
        </div>
    </header>

    <!-- CUERPO DEL PANEL -->
    <main class="contenido-admin">
        <div class="grid-admin">
            
            <!-- TARJETA: Subir Recibos -->
            <a href="/admin/recibos/subir" class="tarjeta-admin-link">
                <div class="tarjeta-cuerpo">
                    <div class="tarjeta-icono">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-svg">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                    </div>
                    <div class="tarjeta-texto">
                        <h3>Subir Recibos de Sueldo</h3>
                        <p>Carga de forma masiva los recibos de sueldo de los empleados en formato PDF seleccionando una carpeta local.</p>
                        <span class="tarjeta-accion">Ingresar →</span>
                    </div>
                </div>
            </a>
            
        </div>
    </main>
</div>