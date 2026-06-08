<?php

namespace Controllers;

use Model\Administrador;
use MVC\Router;

class LoginAdminController {

    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = new Administrador($_POST);
            $alertas = $admin->validarLogin();

            if (empty($alertas['error'])) {
                // Buscar por email
                $adminDB = Administrador::where('email', $admin->email);

                if (!$adminDB || !$adminDB->verificarPassword($admin->password)) {
                    Administrador::setAlerta('error', 'Email o contraseña incorrectos');
                    $alertas = Administrador::getAlertas();
                } else {
                    // Crear sesión del admin
                    session_start();
                    $_SESSION['admin'] = [
                        'id'     => $adminDB->id,
                        'nombre' => $adminDB->nombre,
                        'email'  => $adminDB->email,
                    ];
                    header('Location: /admin');
                    exit;
                }
            }
        }

        $router->render('/admin/login', ['alertas' => $alertas]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}