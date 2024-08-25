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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM guias WHERE id=$id";
    $result = $conn->query($sql);
    $guide = $result->fetch_assoc();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];

    // Subir nueva foto si se ha seleccionado
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $foto = $target_file;
        } else {
            echo "Error al subir la imagen.";
            $foto = $guide['foto'];
        }
    } else {
        $foto = $guide['foto'];
    }

    $sql = "UPDATE guias SET nombre='$nombre', colonia='$colonia', municipio='$municipio', foto='$foto' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: guias.php?success=2");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Guía Turístico</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Modificar Guía Turístico</h1>
    </header>

    <main>
        <form action="edit_guide.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $guide['id']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $guide['nombre']; ?>" required>

            <label for="colonia">Colonia:</label>
            <input type="text" id="colonia" name="colonia" value="<?php echo $guide['colonia']; ?>" required>

            <label for="municipio">Municipio:</label>
            <input type="text" id="municipio" name="municipio" value="<?php echo $guide['municipio']; ?>" required>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*">

            <button type="submit">Actualizar Guía</button>
        </form>
    </main>
</body>
</html>
