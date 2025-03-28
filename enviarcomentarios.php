<?php
include("conexion.php");

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['rate']) && !empty($_POST['comment'])) {
        // Limpiar y proteger los datos
        $nombre = mysqli_real_escape_string($conexion, $_POST['name']);
        $calificacion = (int) $_POST['rate']; // Convertir a entero
        $comentario = mysqli_real_escape_string($conexion, $_POST['comment']);

        // Insertar en la base de datos
        $sql = "INSERT INTO datos (nombre, calificacion, comentario) VALUES ('$nombre', '$calificacion', '$comentario')";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo "Comentario enviado con éxito.";
        } else {
            echo "Error al enviar el comentario: " . mysqli_error($conexion);
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso denegado.";
}
?>
