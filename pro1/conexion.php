

<?php
session_start();




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemacafeteria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["contraseña"];

$sql = "SELECT identidad,usuario, contra, nombre, nivel FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($identidad, $usuario, $contraseña_almacenada, $nombre, $nivel);
    $stmt->fetch();

    // Verificación de contraseña 
    if ($contraseña === $contraseña_almacenada) {
        $_SESSION["identidad"] = $identidad;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nivel"] = $nivel;
        $_SESSION["nombre"] = $nombre;



        // 1 = admin  ;  2 = encargado ; 3 = usuario

        if ($nivel === 1) {
            header("Location: index_encargado.php");
        } elseif ($nivel === 2) {
            header("Location: index_encargado.php");
        } else {
            header("Location: index_comida.php");
        }

        exit();
    } else {

        echo "<script>alert('Contraseña o Usuario incorrectos'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Contraseña o Usuario incorrectos'); window.location.href='login.php';</script>";
}

$stmt->close();
$conn->close();
