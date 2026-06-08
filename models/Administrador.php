<?php

namespace Model;

class Administrador extends ActiveRecord {

    protected static $tabla = 'administradores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password'];

    public ?int $id;
    public string $nombre;
    public string $apellido;
    public string $email;
    public string $password;

    public function __construct($args = []) {
        $this->id       = $args['id']       ?? null;
        $this->nombre   = $args['nombre']   ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email    = $args['email']    ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alertas;
    }

    public function verificarPassword(string $password): bool {
        return password_verify($password, $this->password);
    }

    public function hashPassword(): void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}