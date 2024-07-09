<?php

    session_start();

    include 'conexion_be.php';

    $email = $_POST['email'];
    $contrasena = $_POST['password'];
    $contrasena = hash('sha512', $contrasena);

    $validacion_loging = mysqli_query($conexion, "SELECT * FROM usuarios 
                        WHERE email = '$email' AND contrasena = '$contrasena'");

    $filas = mysqli_fetch_array($validacion_loging);

    if(($filas['id_rol']==1) and mysqli_num_rows($validacion_loging) > 0){
        $_SESSION['usuario'] = $email;
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['rol'] = $row['rol'];
        header("location: ../admin.php"); 
    } else 
    if(($filas['id_rol']==2) and mysqli_num_rows($validacion_loging) > 0) {
        $_SESSION['usuario'] = $email;
        header("location: ../profile.php");
    }else{
        echo '
            <script>
                alert("El correo o la contraseña no existe, verifique los datos introducidos");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

?>