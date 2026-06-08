<?php

namespace Controllers;

use Model\Empleado;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {

        $alertas = [];

        // Comprobar si viene de crear cuenta
        if(isset($_GET['resultado']) && $_GET['resultado'] === '1') {
            Empleado::setAlerta('exito', 'Cuenta creada correctamente');
        }

        $auth = new Empleado;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $auth = new Empleado($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                // Verificar que el usuario exista
                /** @var Empleado|null $empleado */
                $empleado = Empleado::where('dni', $auth->dni);

                if($empleado) {
                    // Verificar el password
                    $verificado = $empleado->verificarPassword($auth->password);
                    
                    if($verificado) {
                        // Autenticar al usuario
                        session_start();

                        $_SESSION['id'] = $empleado->id;
                        $_SESSION['nombre'] = $empleado->nombre . " " . $empleado->apellido;
                        $_SESSION['dni'] = $empleado->dni;
                        $_SESSION['login'] = true;

                        // Redireccionar al usuario
                        header('Location: /empleado');
                    } else {
                        Empleado::setAlerta('error', 'Contraseña incorrecta');
                    }
                } else {
                    Empleado::setAlerta('error', 'Empleado no encontrado');
                    $auth->dni = '';
                }
            }
        }

        $alertas = Empleado::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function crear(Router $router) {

        $empleado = new Empleado;

        // Alertas vacías
        $alertas = [];

        // POST - Crear cuenta
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $empleado->sincronizar($_POST);

            // Validar que no haya campos vacios
            $alertas = $empleado->validarNuevaCuenta();

            // Validar que los passwords coincidan
            $password2 = $_POST['password2'] ?? '';
            if($empleado->password !== $password2) {
                $alertas['error'][] = 'Los passwords no coinciden';
            }

            // Revisar que no haya alertas
            if(empty($alertas)) {
                // Verificar que el empleado no esté registrado
                $resultado = $empleado->existeEmpleado();

                if($resultado->num_rows){
                    $alertas = Empleado::getAlertas();
                } else {
                    // Hashear el password
                    $empleado->hashPassword();

                    // Crear el Usuario
                    $resultado = $empleado->guardar();

                    if($resultado) {
                        header('Location: /?resultado=1');
                    }
                    
                }
                
            } 
        }

        $router->render('auth/crear-cuenta', [
            'empleado' => $empleado,
            'alertas' => $alertas
        ]);
    }
}