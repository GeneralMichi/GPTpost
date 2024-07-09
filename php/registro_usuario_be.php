<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre'];
    $email = $_POST['email'];
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];
    $contrasena = hash('sha512', $contrasena);

    $register_query = "INSERT INTO usuarios(nombre_completo, email, usuario, contrasena, id_rol) 
              VALUES('$nombre_completo', '$email', '$usuario', '$contrasena', '2')";

    $verificacion_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    $verificacion_email = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");

    if(mysqli_num_rows($verificacion_usuario) > 0){
        echo '
            <script>
                alert("El usuario ya existe, intenta con otro usuario");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }
    
    if(mysqli_num_rows($verificacion_email) > 0){
        echo '
            <script>
                alert("El correo ya existe, intenta con otro correo");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion, $register_query);

    if ($ejecutar) {
        # code...
        echo '
            <script>
                alert("Usuario registrado correctamente \n Inicia sesion por favor");
                window.location = "../login.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Usuario no registrado, intentelo otra vez");
                window.location = "../login.php";
            </script>
        ';
    }

    mysqli_close($conexion);

?>
