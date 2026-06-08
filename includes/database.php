<?php

$db = mysqli_connect('localhost', 'root', 'root', 'recibodesueldo');

$db->query("SET time_zone = '-03:00'");

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
