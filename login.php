<?php
include("conexion.php");

$correo = $_POST['correo'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM usuarios
WHERE correo = ?
AND activo = 1";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $correo);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows == 1){

    $usuario = $resultado->fetch_assoc();

    if(password_verify($pass, $usuario['pass'])){

        session_start();

        $_SESSION['id'] = $usuario['id_usu'];
        $_SESSION['nombre'] = $usuario['nombre_com'];

        header("Location: panel.php");

    }else{
        echo "Contraseña incorrecta.";
    }

}else{
    echo "Usuario no encontrado.";
}

$stmt->close();
$conn->close();
?>