<?php 

namespace Controllers;

use MVC\Router;
use Model\Empleado;

class EmpleadoController {
    public static function index(Router $router) {
        if(!isset($_SESSION)) session_start();

        isAuth();

        // Obtener el empleado de la base de datos
        /** @var Empleado|null $empleado */
        $empleado = Empleado::find($_SESSION['id']);

        $router->render('empleado/index', [
            'empleado' => $empleado
        ]);
    }

    public static function recibos(Router $router) {

        $router->render('empleado/recibos');
    }

    public static function cuenta(Router $router) {
        if(!isset($_SESSION)) session_start();
        isAuth();

        $alertas = [];

        // Obtener el empleado de la base de datos
        /** @var Empleado|null $empleado */
        $empleado = Empleado::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sincronizar con el post de la contraseña nueva
            $empleado->password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            // Validar contraseña
            $alertas = $empleado->validarPassword();

            if($empleado->password !== $password_confirm) {
                Empleado::setAlerta('error', 'Las contraseñas no coinciden');
                $alertas = Empleado::getAlertas();
            }

            if(empty($alertas)) {
                // Hashear el nuevo password
                $empleado->hashPassword();
                
                // Guardar en la base de datos
                $resultado = $empleado->guardar();

                if($resultado) {
                    Empleado::setAlerta('exito', 'Contraseña actualizada correctamente');
                } else {
                    Empleado::setAlerta('error', 'Hubo un error al actualizar la contraseña');
                }
                $alertas = Empleado::getAlertas();
            }
        }

        // Limpiar el password para no enviarlo en texto plano al input
        $empleado->password = '';

        $router->render('empleado/cuenta', [
            'empleado' => $empleado,
            'alertas' => $alertas
        ]);
    }
}