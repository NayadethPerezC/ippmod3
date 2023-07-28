<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <h2>Iniciar Sesión</h2>
            <input type="text" name="username", placeholder="Nombre de Usuario" required>
            <input type="password" name="password", placeholder="Contraseña" required>
            <button type="submit" name="login">Iniciar Sesión</button>
        </form>
    </div>

</body>
</html>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

//conexion con bd

$conn = new mysqli($servername, $username, $password, $dbname);

// comprobar si hay error

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


//Ininicar sesion para almacenar informacion del usuario
session_start();

//verificar si se envio formulario de inicio sesion

if(isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = md5($_POST['password']); 

//consulta SQL para buscar al usuario

$sql = "SELECT * FROM users WHERE username = ? AND password= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

//si se encuentra el usuario se verifica si coinciden los datos

if($result->num_rows > 0){
    $_SESSION['username'] = $username;
    header('Location: news.php');
} else {
    echo "Nombre de usuario o contraseña incorrecta";
}
//cerramos la consulta y la conexion con la base de datos

$stmt->close();
$conn->close();
}
?>