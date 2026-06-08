<h1 class="nombre-pagina">Mis Recibos de Sueldo</h1>

<?php if (empty($recibos)): ?>
    <p>Todavía no tenés recibos disponibles.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Período</th>
                <th>Fecha de carga</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recibos as $recibo): ?>
            <tr>
                <td><?= htmlspecialchars($recibo->periodo) ?></td>
                <td><?= htmlspecialchars($recibo->fecha_carga) ?></td>
                <td>
                    <a href="/recibos/descargar?id=<?= $recibo->id ?>" target="_blank">
                        Ver PDF
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>