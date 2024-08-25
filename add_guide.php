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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];

    // Subir la imagen
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto = $target_file;
    } else {
        echo "Error al subir la imagen.";
        $foto = '';
    }

    $sql = "INSERT INTO guias (nombre, colonia, municipio, foto) VALUES ('$nombre', '$colonia', '$municipio', '$foto')";

    if ($conn->query($sql) === TRUE) {
        header("Location: guias.php?success=1");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
