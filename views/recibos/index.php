<?php
/** @var array $recibos */
/** @var Model\Empleado $empleado */
?>

<div class="dashboard-empleado">
    <!-- BARRA SUPERIOR -->
    <header class="header-empleado">
        <div class="header-logo">
            <h1>Recibos WEB <span>/ <?php echo s($empleado->empresa); ?></span></h1>
        </div>
        <div class="header-usuario recibos">
            <p>Hola, <strong><?php echo s($empleado->nombre . ' ' . $empleado->apellido); ?></strong></p>
            <a href="/logout" class="boton-cerrar">Cerrar Sesión</a>
        </div>
    </header>

    <main class="contenido-empleado">
        <!-- Volver al panel -->
        <div class="enlace-volver">
            <a href="/empleado" class="boton-volver">← Volver al Panel</a>
        </div>

        <div class="tarjeta-recibos">
            <h2>Mis Recibos de Sueldo</h2>
            
            <?php if (empty($recibos)): ?>
                <div class="recibos-vacio">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-vacio">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                    <p>Todavía no tienes recibos de sueldo cargados en el sistema.</p>
                </div>
            <?php else: ?>
                <div class="tabla-contenedor">
                    <table class="tabla-recibos">
                        <thead>
                            <tr>
                                <th>Período</th>
                                <th>Fecha de Carga</th>
                                <th class="text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recibos as $recibo): ?>
                            <tr>
                                <td class="periodo-nombre" data-label="Período">
                                    <span class="icono-documento">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </span>
                                    <?php 
                                        // Formatear período YYYY-MM a "Mes Año" (ej. 2026-06 a "Junio 2026")
                                        $partes = explode('-', $recibo->periodo);
                                        $meses = [
                                            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
                                            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
                                            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
                                        ];
                                        $periodoFormateado = isset($partes[1]) ? $meses[$partes[1]] . ' ' . $partes[0] : $recibo->periodo;
                                        echo s($periodoFormateado); 
                                    ?>
                                </td>
                                <td class="fecha-carga" data-label="Fecha de Carga">
                                    <?php 
                                        // Formatear fecha
                                        echo s(date('d/m/Y', strtotime($recibo->fecha_carga))); 
                                    ?>
                                </td>
                                <td class="text-right" data-label="Acción">
                                    <a href="/recibos/descargar?id=<?php echo $recibo->id; ?>" target="_blank" class="boton-ver-pdf">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-btn">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Ver PDF
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>