<?php

namespace Controllers;

use Model\Recibo;
use Model\Administrador;
use MVC\Router;

class AdminController {

    // Verificar sesión de admin en cada método
    private static function verificarSesion(): void {
        if(!isset($_SESSION)) session_start();
        if (!isset($_SESSION['admin'])) {
            header('Location: /admin/login');
            exit;
        }
    }

    public static function index(Router $router): void {
        self::verificarSesion();
        $router->render('admin/index', []);
    }

    public static function subirRecibos(Router $router): void {
        self::verificarSesion();
        $alertas = [];
        $router->render('admin/subir_recibos', ['alertas' => $alertas]);
    }

    public static function procesarRecibos(Router $router): void {
        self::verificarSesion();

        $alertas  = [];
        $exitosos = 0;
        $errores  = [];

        $periodo = trim($_POST['periodo'] ?? '');

        // Validar formato YYYY-MM
        if (!preg_match('/^\d{4}-\d{2}$/', $periodo)) {
            Administrador::setAlerta('error', 'El período tiene formato inválido. Debe ser YYYY-MM.');
            $router->render('admin/subir_recibos', ['alertas' => Administrador::getAlertas()]);
            return;
        }

        $archivos = $_FILES['recibos'] ?? null;

        if (!$archivos || empty($archivos['name'][0])) {
            Administrador::setAlerta('error', 'No se seleccionó ningún archivo.');
            $router->render('admin/subir_recibos', ['alertas' => Administrador::getAlertas()]);
            return;
        }

        // Crear carpeta destino si no existe
        // Los PDFs viven FUERA de public/ por seguridad
        $destino = __DIR__ . "/../storage/recibos/{$periodo}/";
        if (!is_dir($destino)) {
            mkdir($destino, 0755, true);
        }

        $total = count($archivos['name']);

        for ($i = 0; $i < $total; $i++) {
            $nombreOriginal = basename($archivos['name'][$i]); // Ej: 30123456.pdf
            $tmpPath        = $archivos['tmp_name'][$i];
            $uploadError    = $archivos['error'][$i];

            // Error de subida del sistema
            if ($uploadError !== UPLOAD_ERR_OK) {
                $errores[] = "$nombreOriginal: error al subir el archivo.";
                continue;
            }

            // Validar extensión PDF
            $ext = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
            if ($ext !== 'pdf') {
                $errores[] = "$nombreOriginal: no es un PDF, se omitió.";
                continue;
            }

            // El nombre sin extensión debe ser un DNI numérico (7 u 8 dígitos)
            $dni = trim(pathinfo($nombreOriginal, PATHINFO_FILENAME));
            if (!preg_match('/^\d{7,8}$/', $dni)) {
                $errores[] = "$nombreOriginal: el nombre no corresponde a un DNI válido.";
                continue;
            }

            // Mover a storage/
            $rutaDestino = $destino . $nombreOriginal;
            if (!move_uploaded_file($tmpPath, $rutaDestino)) {
                $errores[] = "$nombreOriginal: no se pudo guardar en el servidor.";
                continue;
            }

            // Registrar en la BD
            // Si ya existe el registro para ese DNI y período, solo sobreescribimos el archivo (ya fue reemplazado arriba)
            if (!Recibo::existePeriodo($dni, $periodo)) {
                $recibo = new Recibo();
                $recibo->dni = $dni;
                $recibo->periodo = $periodo;
                $recibo->archivo = "recibos/{$periodo}/{$nombreOriginal}";
                $recibo->fecha_carga = date('Y-m-d H:i:s'); // ← Fecha y hora actual
                $recibo->guardar();
            }

            $exitosos++;
        }

        // Armar alertas de resultado
        if ($exitosos > 0) {
            $alertas['exito'][] = "{$exitosos} recibo/s cargado/s correctamente para el período {$periodo}.";
        }
        foreach ($errores as $err) {
            $alertas['error'][] = $err;
        }

        $router->render('admin/subir_recibos', ['alertas' => $alertas]);
    }
}