<?php
    include("conexion.php"); // Conectar a la base de datos

    // Consultar los comentarios
    $consulta = "SELECT nombre, calificacion, comentario FROM comentarios ORDER BY id DESC";
    $resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Comentarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Estilos para los comentarios */
.comentario {
    background-color: #1c1c1c;
    border-left: 5px solid gold; /* Borde dorado a la izquierda */
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    box-shadow: 0px 2px 8px rgba(255, 215, 0, 0.3); /* Sombra dorada */
    transition: transform 0.3s ease-in-out;
}

.comentario:hover {
    transform: scale(1.02); /* Pequeño efecto de zoom al pasar el mouse */
}

.comentario strong {
    font-size: 1.2em;
    color: #ffffff; /* Amarillo dorado para destacar el nombre */
}

.comentario p {
    margin: 5px 0;
    font-size: 1em;
    color: #ddd; /* Color gris claro */
}

/* Estrellas de calificación */
.stars {
    color: gold;
    font-size: 1.2em;
    margin-bottom: 5px;
}

/* Sección de comentarios */
.comments-container h2 {
    color: gold; /* Título dorado */
    text-align: center;
}
</style>
<body>
    <div class="container">
        <center><h2>FORMULARIO DE COMENTARIOS</h2></center>
        <form method="post" action="registrar.php" id="commentForm">
            <label for="name">Nombre:</label>
            <center><input type="text" id="name" name="name" required></center>

            <label for="correo">Correo Electrónico:</label>
            <center><input type="email" id="correo" name="correo" required></center>

            <label for="conociste">¿Cómo nos conociste?</label>
            <center>
                <select id="conociste" name="conociste" required>
                    <option value="">Selecciona una opción</option>
                    <option value="redes">Redes Sociales</option>
                    <option value="amigo">Recomendación de un amigo</option>
                    <option value="publicidad">Publicidad</option>
                    <option value="evento">Asistí a un evento</option>
                    <option value="otro">Otro</option>
                </select>
            </center>

            <center>
                <label>Califica nuestros servicios:</label>
                <div class="rating">
                    <label data-value="5" onmouseover="highlightStars(this)" onmouseout="resetStars()" onclick="setRating(5)">★</label>
                    <label data-value="4" onmouseover="highlightStars(this)" onmouseout="resetStars()" onclick="setRating(4)">★</label>
                    <label data-value="3" onmouseover="highlightStars(this)" onmouseout="resetStars()" onclick="setRating(3)">★</label>
                    <label data-value="2" onmouseover="highlightStars(this)" onmouseout="resetStars()" onclick="setRating(2)">★</label>
                    <label data-value="1" onmouseover="highlightStars(this)" onmouseout="resetStars()" onclick="setRating(1)">★</label>
                </div>
                <input type="hidden" name="rate" id="rate">
            </center>

            <label for="comment">Comentario:</label>
            <textarea style="border: 1px solid #fff; border-radius: 4px;" id="comment" name="comment" required></textarea>

            <button type="submit" name="register">Enviar Comentario</button>
        </form>
    </div>

    <div class="container">
    <center><h2>Comentarios Recientes</h2></center>
    <?php
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<div class='comentario'>";
                echo "<strong>" . htmlspecialchars($fila['nombre']) . "</strong><br>";
                
                // Mostrar estrellas en base a la calificación
                echo "<div class='stars'>";
                for ($i = 0; $i < $fila['calificacion']; $i++) {
                    echo "★"; // Estrella dorada
                }
                for ($i = $fila['calificacion']; $i < 5; $i++) {
                    echo "☆"; // Estrella vacía
                }
                echo "</div>";

                echo "<p>" . htmlspecialchars($fila['comentario']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay comentarios aún.</p>";
        }
    ?>
    </div>


    <script>
        let selectedRating = 0;

        function highlightStars(star) {
            let labels = document.querySelectorAll('.rating label');
            labels.forEach(label => {
                label.style.color = (label.dataset.value <= star.dataset.value) ? 'goldenrod' : 'gray';
            });
        }

        function resetStars() {
            let labels = document.querySelectorAll('.rating label');
            labels.forEach(label => {
                label.style.color = (label.dataset.value <= selectedRating) ? 'goldenrod' : 'gray';
            });
        }

        function setRating(value) {
            selectedRating = value;
            document.getElementById("rate").value = value;
            resetStars(); // Asegurar que la selección permanezca después del click
        }
    </script>
</body>
</html>
