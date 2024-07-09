<?php

    session_start();
    include 'php/conexion_be.php';

    if (!isset($_SESSION['usuario'])) {
      # code...
      echo '
        <script>
            alert("Por favor, debes iniciar sesión");
            window.location = "login.php";
        </script>
      ';
      //header("location: login.php");
      session_destroy();
      die();      
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPTpost</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/prompts.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .formulario {
            background-color: #e75e8d;
            opacity: 0.7;
            border-radius: 0.5rem;
            width: 600px;
            max-width: 100%;
            margin: auto;
            margin-top: 30px;
            padding: 20px;
            box-shadow: 0 0 20px 4px rgba(34, 2, 12, 0.8);
            position: relative;
        }
        .form button {
            align-items: center;
            padding: 10px 40px;
            border: 3px solid #0000000b;
            font-size: 14px;
            background: transparent;
            font-weight: 600;
            cursor: pointer;
            color: rgb(0, 0, 0);
            outline: none;
            transition: all 300ms;
        }
        .form button:hover {
            background: #0000006f;
            color: #e75e8d;
        }
        .result {
            text-align: center;
            padding-top: 10px;
            color: #ffffff;
            opacity: 0.8; 
        }
        .form__title {
            text-align: center;
            padding-top: 10px;
            color: #ffffff;
            opacity: 0.8;
        }
        .formulario_input, .formulario_label, .formulario_submit {
            display: block;
            width: 100%;
            font-size: 1.3em;
        }
        .formulario_input {
            padding: 15px;
            background: rgba(255, 255, 255, .5);
            border: 0.3rem solid rgba(71, 5, 48, 0.5);
            margin-bottom: 20px;
        }
        .formulario_input:focus {
            outline: 2px solid rgba(40, 3, 42, 0.5);
        }
        .formulario_label {
            margin-bottom: 5px;
            color: #3e4142;
            transition: all 0.5s;
        }
        .hidden {
            display: none;
        }
        .form-group {
            margin-bottom: 20px;
        }
        pre {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
            text-align: left;
            color: #333;
        }
    </style>
</head>
<body>
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="index.html" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <ul class="nav">
                        <li><a href="index.html" class="active">Inicio</a></li>
                        <li><a href="prompts.php">Prompts</a></li>
                        <li><a href="eslogan.php">Eslogan</a></li>
                        <li><a href="login.php" class="active">Login <img src="assets/images/profile.png" alt=""></a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content">
                <div class="form" id="prompt">
                    <h1 class="form__title">Introduzca lo que se le pida <br></h1>
                    <div id="error-message" class="alert alert-danger hidden"></div>
                    <form id="questionnaire-form" class="formulario" method="POST" action="">
                    <h5>Eslogan

                        <div class="form-group">
                            <form method="post">
                                <label for="products" class="formulario_label">Productos o Servicios</label>
                                <input type="text" class="formulario_input" id="products" name="products" required>
                                <button type="submit">Generar</button>
                            </form>
                        </div>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $products = escapeshellarg($_POST['products']);
                            
                            // Introducir un retraso de 15 segundos
                            sleep(15);
                            
                            // Ejecutar el script de Python con el argumento y mostrar el resultado
                            $output = shell_exec("python IA/textGenerator.py $products");
                            echo "<pre>$output</pre>";
                        }
                        ?>
                        </h5>
                    </form>
                    <div id="result" class="result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
