<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body> 
    <div class="container">
        <form action="register.php" method="post">
                <h1>Regístrate</h1>
                <input type="text" name="username" placeholder="Nombre de Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit" name="register">Registrar</button>
            </form>
        </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "test";

//Se crea conexion con bd

$conn = new mysqli($servername, $username, $password, $dbname);

// comprobar si hay error

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//verificar si se envio formulario de inicio sesion

if(isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>