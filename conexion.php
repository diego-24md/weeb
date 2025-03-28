<?php
// Configuración de la conexión
$servidor = "localhost";
$usuario = "root";
$clave = "";
$base_datos = "registro";

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $clave, $base_datos);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a UTF-8
mysqli_set_charset($conexion, "utf8");

?>
