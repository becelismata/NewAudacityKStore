<?php
$hostname = 'localhost';
$database = 'audacity';
$username = 'root';
$password = '12345';

// Crear conexión
$conn = new mysqli($hostname, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener la biografía de Taylor Swift
$sql = "SELECT Descripcion, Imagen_URL FROM Biografia WHERE Artista = 'Taylor Swift'";
echo "Consulta SQL: " . $sql . "<br>";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados
    while ($row = $result->fetch_assoc()) {
        echo "<div class='contenedor'>";
        echo "<div class='etiqueta'>Biografía</div>";
        echo "<div class='contenido'>";
        echo "<p>" . $row["Descripcion"] . "</p>";
        echo "<img src='" . $row["Imagen_URL"] . "' width='100%'>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No se encontró la biografía de Taylor Swift";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
