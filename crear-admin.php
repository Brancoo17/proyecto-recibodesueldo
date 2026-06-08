<?php

require 'vendor/autoload.php';

// Conectar a la BD (ajustá con tus datos)
include 'includes/database.php';

$nombre   = 'Admin';
$apellido = 'Branco';
$email    = 'admin@empresa.com';
$password = password_hash('admin1234', PASSWORD_BCRYPT);

$query = "INSERT INTO administradores (nombre, apellido, email, password) 
          VALUES ('{$nombre}', '{$apellido}', '{$email}', '{$password}')";

$db->query($query);

echo "Administrador creado correctamente.";