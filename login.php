<?php
session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User authenticated successfully
        $_SESSION['username'] = $username;
        header("Location: contactanos.html"); // Redirect to welcome page
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
