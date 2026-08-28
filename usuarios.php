<?php
include("conexion.php");

$sql = "SELECT * FROM usuarios ORDER BY id_usu DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Usuarios registrados</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f5f5f5;
    margin:40px;
}

h1{
    text-align:center;
    color:#333;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

th{
    background:#0077cc;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:nth-child(even){
    background:#f8f8f8;
}

tr:hover{
    background:#eef6ff;
}

.estado{
    color:green;
    font-weight:bold;
}

.inactivo{
    color:red;
    font-weight:bold;
}

</style>

</head>
<body>

<h1>Usuarios Registrados</h1>

<table>

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Empresa</th>
    <th>Fecha Registro</th>
    <th>Última Actualización</th>
    <th>Estado</th>
</tr>

<?php

if($resultado->num_rows > 0){

    while($fila = $resultado->fetch_assoc()){

        echo "<tr>";

        echo "<td>".$fila["id_usu"]."</td>";
        echo "<td>".$fila["nombre_com"]."</td>";
        echo "<td>".$fila["correo"]."</td>";
        echo "<td>".$fila["empresa"]."</td>";
        echo "<td>".$fila["fecha_registro"]."</td>";
        echo "<td>".$fila["fecha_actualizacion"]."</td>";

        if($fila["activo"]){
            echo "<td class='estado'>Activo</td>";
        }else{
            echo "<td class='inactivo'>Inactivo</td>";
        }

        echo "</tr>";
    }

}else{

    echo "<tr>";
    echo "<td colspan='7'>No hay usuarios registrados.</td>";
    echo "</tr>";

}

$conn->close();

?>

</table>

</body>
</html>