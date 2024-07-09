<?php
session_start();
include 'php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['usuario_id'];
    // Agrega la lógica para editar el usuario basado en $usuario_id
    // Redirige a admin.php después de la edición
    header("Location: admin.php");
}
?>
