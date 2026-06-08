<form action="/admin/recibos/subir" method="POST" enctype="multipart/form-data">

    <div class="campo">
        <label for="periodo">Período:</label>
        <input type="month" id="periodo" name="periodo" required>
    </div>

    <div class="campo">
        <label for="recibos">Seleccionar carpeta con recibos:</label>
        <!--
            webkitdirectory: permite seleccionar una carpeta entera
            El navegador sube todos los archivos que contiene
        -->
        <input
            type="file"
            id="recibos"
            name="recibos[]"
            webkitdirectory
            accept=".pdf"
            required
        >
        <p class="descripcion">
            Seleccioná la carpeta. Cada PDF debe llamarse con el DNI del empleado.
            <br>Ejemplo: <strong>30123456.pdf</strong>
        </p>
    </div>

    <input type="submit" value="Subir Recibos">
</form>