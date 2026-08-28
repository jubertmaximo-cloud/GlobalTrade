<?php
include("conexion.php");

$nombre = $_POST['nombre_com'];
$correo = $_POST['correo'];
$empresa = $_POST['empresa'];
$pass = $_POST['pass'];
$confirmar = $_POST['confirmar'];

if($pass != $confirmar){
    die("Las contraseñas no coinciden.");
}

$passHash = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios(nombre_com, correo, empresa, pass)
VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssss", $nombre, $correo, $empresa, $passHash);

if($stmt->execute()){

    header("Location: mys.html");
    exit();

}else{

    if($stmt->errno == 1062){
        echo "El correo ya está registrado.";
    }else{
        echo "Error: " . $stmt->error;
    }

}

$stmt->close();
$conn->close();
?>