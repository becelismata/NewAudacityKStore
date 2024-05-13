<?php
$hostname = 'localhost';
$database = 'audacitykstore';
$username = 'root';
$password = '';

// Crear conexión
$conn = new mysqli($hostname, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener la biografía de EXO
$sql_biografia = "SELECT Descripcion, Imagen_URL FROM Biografia WHERE Artista = 'EXO'";
$result_biografia = $conn->query($sql_biografia);

// Inicializa las variables de la biografía
$biografia = "";
$imagen_url = "";

// Verificar si hay resultados de la biografía
if ($result_biografia->num_rows > 0) {
    // Obtener los datos de la biografía
    $row_biografia = $result_biografia->fetch_assoc();
    $biografia = $row_biografia["Descripcion"];
    $imagen_url = $row_biografia["Imagen_URL"];
} else {
    $biografia = "No se encontró la biografía de EXO";
}

// Consulta SQL para obtener la discografía de EXO ordenada por año ascendente
$sql_discografia = "SELECT * FROM Discografia WHERE Artista = 'EXO' ORDER BY Year ASC";
$result_discografia = $conn->query($sql_discografia);

// Consulta SQL para obtener la música de EXO
$sql_musica = "SELECT Spotify FROM Musica WHERE Artista = 'EXO'";
$result_musica = $conn->query($sql_musica);

// Consulta SQL para obtener los elementos multimedia de EXO
$sql_multimedia = "SELECT URL FROM Multimedia WHERE Artista = 'EXO'";
$result_multimedia = $conn->query($sql_multimedia);

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ESTILOARTISTA.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>EXO</title>
</head>
<body>
    <header>
        <h1>EXO</h1>
    </header>

    <div class="acordeon-cuerpo">
        <div class="acordeon">
            <hr>
            <input type="checkbox" id="acordeon1">
            <label for="acordeon1">
                <div class="contenedor">
                    <div class="etiqueta">Productos</div>
                    <div class="contenido">
                        <div class="slider-container">
                            <div class="slide">
                                <a href="https://store.taylorswift.com/collections/the-tortured-poets-department-homepage/products/the-tortured-poets-department-cd-bonus-track-the-manuscript" target="_blank"><img src="7.png" width="100%"></a>
                            </div>
                            <div class="slide">
                                <a href="https://udiscover.mx/collections/taylor-swift/products/1989-taylors-version-cd" target="_blank"><img src="8.png" width="100%"></a>
                            </div>
                            <div class="slide">
                                <a href="https://udiscover.mx/collections/taylor-swift/products/taylor-swift-the-eras-tour-live-photo-stars-t-shirt" target="_blank"><img src="9.png" width="100%"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </label>
            <div class="contenedor">
                <div class="etiqueta">Biografía</div>
                <div class="contenido">
                    <?php echo "<p>$biografia</p>"; ?>
                    <?php echo "<img src='$imagen_url' width='100%'>"; ?>
                </div>
            </div>
            <div class="contenedor">
                <div class="etiqueta">Discografía</div>
                <div class="contenido">
                    <table>
                        <thead>
                            <tr>
                                <th>Álbum</th>
                                <th>Año</th>
                                <th>Portada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result_discografia && $result_discografia->num_rows > 0) {
                                // Mostrar los resultados de la discografía
                                while ($row_discografia = $result_discografia->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row_discografia["Album"] . "</td>";
                                    echo "<td>" . $row_discografia["Year"] . "</td>";
                                    echo "<td><img src='" . $row_discografia["Portada"] . "' width='110'></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No se encontraron álbumes en la discografía de EXO</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="contenedor">
                <div class="etiqueta">Música</div>
                <div class="contenido">
                    <?php
                    if ($result_musica && $result_musica->num_rows > 0) {
                        // Mostrar los enlaces de Spotify
                        echo "<ul>";
                        while ($row_musica = $result_musica->fetch_assoc()) {
                            echo "<li><a href='" . $row_musica["Spotify"] . "' target='_blank'>" . $row_musica["Spotify"] . "</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "No se encontraron enlaces de Spotify para EXO";
                    }
                    ?>
                </div>
            </div>
            <div class="contenedor">
                <div class="etiqueta">Multimedia</div>
                <div class="contenido">
                    <?php
                    if ($result_multimedia && $result_multimedia->num_rows > 0) {
                        // Mostrar los elementos multimedia
                        echo "<ul>";
                        while ($row_multimedia = $result_multimedia->fetch_assoc()) {
                            echo "<li><a href='" . $row_multimedia["URL"] . "' target='_blank'>" . $row_multimedia["URL"] . "</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "No se encontraron elementos multimedia para EXO";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <input id="button" type="button" value="Pagina Principal" onclick="window.location.href='../index.html'">
    <script src="app.js" type="text/javascript"></script>
</body>
</html>
<?php

