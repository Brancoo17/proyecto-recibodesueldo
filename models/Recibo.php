<?php

namespace Model;

class Recibo extends ActiveRecord {

    protected static $tabla = 'recibos';
    protected static $columnasDB = ['id', 'dni', 'periodo', 'archivo', 'fecha_carga'];

    public ?int $id;
    public string $dni;
    public string $periodo;
    public string $archivo;
    public string $fecha_carga;

    public function __construct($args = []) {
        $this->id          = $args['id']          ?? null;
        $this->dni         = $args['dni']          ?? '';
        $this->periodo     = $args['periodo']      ?? '';
        $this->archivo     = $args['archivo']      ?? '';
        $this->fecha_carga = $args['fecha_carga']  ?? '';
    }

    // Todos los recibos de un empleado, ordenados por período desc
    public static function obtenerPorDni(string $dni): array {
        $dni   = self::$db->escape_string($dni);
        $query = "SELECT * FROM " . static::$tabla . " WHERE dni = '{$dni}' ORDER BY periodo DESC";
        return self::consultarSQL($query);
    }

    // Verificar si ya existe el recibo para ese DNI y período
    public static function existePeriodo(string $dni, string $periodo): bool {
        $dni     = self::$db->escape_string($dni);
        $periodo = self::$db->escape_string($periodo);
        $query   = "SELECT id FROM " . static::$tabla . " WHERE dni = '{$dni}' AND periodo = '{$periodo}' LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado->num_rows > 0;
    }
}