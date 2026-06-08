<?php

namespace Controllers;

use Model\Recibo;
use MVC\Router;

class ReciboController {

    private static function verificarSesion(): void {
        session_start();
        if (!isset($_SESSION['empleado'])) {
            header('Location: /login');
            exit;
        }
    }

    public static function index(Router $router): void {
        self::verificarSesion();

        $dni     = $_SESSION['empleado']['dni'];
        $recibos = Recibo::obtenerPorDni($dni);

        $router->render('recibos/index', ['recibos' => $recibos]);
    }

    // Sirve el PDF tras verificar que pertenece al empleado logueado
    public static function descargar(Router $router): void {
        self::verificarSesion();

        $id     = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $recibo = Recibo::find($id);

        // Verificar que el recibo existe y pertenece a este empleado
        if (!$recibo || $recibo->dni !== $_SESSION['empleado']['dni']) {
            http_response_code(403);
            echo "Acceso denegado.";
            exit;
        }

        $ruta = __DIR__ . "/../storage/" . $recibo->archivo;

        if (!file_exists($ruta)) {
            http_response_code(404);
            echo "El archivo no existe en el servidor.";
            exit;
        }

        // Servir el PDF directamente en el navegador
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="recibo-' . $recibo->periodo . '.pdf"');
        header('Content-Length: ' . filesize($ruta));
        readfile($ruta);
        exit;
    }
}