<?php
session_start();
include 'php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['usuario_id'];
    // Agrega la lógica para eliminar el usuario basado en $usuario_id
    $sql = "DELETE FROM usuarios WHERE id_usuarios='$usuario_id'";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error eliminando usuario: " . mysqli_error($conexion);
    }
    // Redirige a admin.php después de la eliminación
    header("Location: admin.php");
}
?>
