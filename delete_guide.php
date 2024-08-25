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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM guias WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: guias.php?success=3");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
