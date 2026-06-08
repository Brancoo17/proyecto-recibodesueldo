<?php

namespace Model;

class Empleado extends ActiveRecord {

    // Base de datos
    protected static $tabla = 'empleados';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'dni', 'cuil', 'password', 'empresa',];

    // Atributos
    public ?int $id;
    public string $nombre;
    public string $apellido;
    public string $dni;
    public string $cuil;
    public string $password;
    public string $empresa;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->dni = $args['dni'] ?? '';
        $this->cuil = $args['cuil'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->empresa = $args['empresa'] ?? '';
    }

    public function validarLogin() {
        if (!$this->dni) {
            self::$alertas['error'][] = 'El DNI es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function verificarPassword(string $password) {
        return password_verify($password, $this->password);
    }

    // Validación del formulario para nueva cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->dni) {
            self::$alertas['error'][] = 'El DNI es obligatorio';
        }
        if(!$this->cuil) {
            self::$alertas['error'][] = 'El CUIL es obligatorio';
        }
        if(!$this->empresa) {
            self::$alertas['error'][] = 'La empresa es obligatoria';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Validar Password
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Revisa si el usuario ya existe
    public function existeEmpleado() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE dni = '" . $this->dni . "' LIMIT 1";

        $resultado = self::$db->query($query);
        
        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El empleado ya está registrado';
        }

        return $resultado;
    }

    // Hashear el password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
}