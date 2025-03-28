<?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['name']) && !empty($_POST['correo']) && !empty($_POST['conociste']) && !empty($_POST['rate']) && !empty($_POST['comment'])) {
            
            // Evitar inyección SQL
            $nombre = mysqli_real_escape_string($conexion, $_POST['name']);
            $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
            $conociste = mysqli_real_escape_string($conexion, $_POST['conociste']);
            $calificacion = (int) $_POST['rate']; // Convertir a número
            $comentario = mysqli_real_escape_string($conexion, $_POST['comment']);

            // Insertar datos en la base de datos
            $sql = "INSERT INTO comentarios (nombre, correo, conociste, calificacion, comentario) VALUES ('$nombre', '$correo', '$conociste', '$calificacion', '$comentario')";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo "<script>alert('Comentario enviado con éxito.'); window.location.href='comentarios.php';</script>";
            } else {
                echo "<script>alert('Error al enviar el comentario: " . mysqli_error($conexion) . "'); window.location.href='comentarios.php';</script>";
            }
        } else {
            echo "<script>alert('Todos los campos son obligatorios.'); window.location.href='comentarios.php';</script>";
        }
    }
?>
