<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guias_turisticos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los guías de la base de datos
$sql = "SELECT id, nombre, colonia, municipio, foto FROM guias";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Generar las cards con los datos de la base de datos
    while($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="' . $row['foto'] . '" alt="' . $row['nombre'] . '">';
        echo '<h3>' . $row['nombre'] . '</h3>';
        echo '<p>' . $row['colonia'] . ', ' . $row['municipio'] . '</p>';
        echo '<a href="edit_guide.php?id=' . $row['id'] . '" class="btn">Modificar</a>';
        echo '<a href="delete_guide.php?id=' . $row['id'] . '" class="btn btn-delete">Eliminar</a>';
        echo '</div>';
    }
} else {
    echo "No hay guías registrados.";
}

$conn->close();
?>
