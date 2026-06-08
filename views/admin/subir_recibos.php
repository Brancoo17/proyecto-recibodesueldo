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

    <!-- CUERPO -->
    <main class="contenido-admin">
        <!-- Volver al panel -->
        <div class="enlace-volver">
            <a href="/admin" class="boton-volver">← Volver al Panel</a>
        </div>

        <div class="seccion-subir">
            <h2>Subir Recibos de Sueldo</h2>
            <p class="descripcion">
                Selecciona el período correspondiente y la carpeta local que contiene los archivos PDF de los recibos.
                El nombre de cada archivo PDF debe coincidir con el DNI del empleado (ejemplo: <strong>30123456.pdf</strong>).
            </p>

            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            <form action="/admin/recibos/subir" method="POST" enctype="multipart/form-data" class="formulario">

                <div class="campo">
                    <label for="periodo">Período:</label>
                    <input type="month" id="periodo" name="periodo" required>
                </div>

                <div class="campo">
                    <label for="recibos">Seleccionar Carpeta de Recibos:</label>
                    <input
                        type="file"
                        id="recibos"
                        name="recibos[]"
                        webkitdirectory
                        directory
                        multiple
                        accept=".pdf"
                        required
                    >
                </div>

                <input type="submit" value="Subir Carpeta de Recibos" class="boton">
            </form>
        </div>
    </main>
</div>