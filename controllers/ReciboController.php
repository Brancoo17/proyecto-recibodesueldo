<?php

namespace Controllers;

use Model\Recibo;
use MVC\Router;
use Model\Empleado;

class ReciboController {

    private static function verificarSesion(): void {
        if(!isset($_SESSION['login'])) {
            header('Location: /');
            exit;
        }
    }

    public static function index(Router $router): void {
        self::verificarSesion();

        // Obtener datos del empleado desde la BD usando el ID de sesión
        /** @var Empleado|null $empleado */
        $empleado = Empleado::find($_SESSION['id']);

        // Usar el DNI del objeto empleado directamente
        $recibos = Recibo::obtenerPorDni($empleado->dni);

        $router->render('recibos/index', [
            'recibos' => $recibos,
            'empleado' => $empleado
        ]);
    }

    // Sirve el PDF tras verificar que pertenece al empleado logueado
    public static function descargar(Router $router): void {
        self::verificarSesion();

        /** @var Empleado|null $empleado */
        $empleado = Empleado::find($_SESSION['id']);

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        /** @var Recibo|null $recibo */
        $recibo = Recibo::find($id);

        // Verificar que el recibo existe y pertenece a este empleado
        if (!$recibo || $recibo->dni !== $empleado->dni) {
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