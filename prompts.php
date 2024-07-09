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
                        <div class="form-group">
                            <label for="companyName" class="formulario_label">Nombre de la Empresa</label>
                            <input type="text" class="formulario_input" id="companyName" name="companyName" required>
                        </div>
                        <div class="form-group">
                            <label for="sector" class="formulario_label">Sector</label>
                            <select class="formulario_input" id="sector" name="sector" required>
                                <option>---Seleccione una opción</option>
                                <option value="Tecnología e Informática">Tecnología e Informática</option>
                                <option value="Salud y Bienestar">Salud y Bienestar</option>
                                <option value="Educación y Formación">Educación y Formación</option>
                                <option value="Alimentación y Bebidas">Alimentación y Bebidas</option>
                                <option value="Moda y Belleza">Moda y Belleza</option>
                                <option value="Entretenimiento y Medios">Entretenimiento y Medios</option>
                                <option value="Finanzas y Seguros">Finanzas y Seguros</option>
                                <option value="Bienes Raíces y Estructuras">Bienes Raíces y Estructuras</option>
                                <option value="Retail y Comercio Electrónico">Retail y Comercio Electrónico</option>
                                <option value="Automotriz y Transporte">Automotriz y Transporte</option>
                                <option value="Energía y Medio Ambiente">Energía y Medio Ambiente</option>
                                <option value="Turismo y Hospitalidad">Turismo y Hospitalidad</option>
                                <option value="Manufactura e Industria">Manufactura e Industria</option>
                                <option value="Consultoría y Servicios Profesionales">Consultoría y Servicios Profesionales</option>
                                <option value="Telecomunicaciones">Telecomunicaciones</option>
                                <option value="Deportes y Recreación">Deportes y Recreación</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="products" class="formulario_label">Productos o Servicios</label>
                            <input type="text" class="formulario_input" id="products" name="products" required>
                        </div>
                        <div class="form-group">
                            <label for="minimalistDesign" class="formulario_label">¿Desea un diseño minimalista?</label>
                            <select class="formulario_input" id="minimalistDesign" name="minimalistDesign" required>
                                <option>---Seleccione una opción</option>
                                <option value="Sí">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hasColorInMind" class="formulario_label">¿Tiene en mente algún color para el diseño del logotipo?</label>
                            <select class="formulario_input" id="hasColorInMind" name="hasColorInMind" onchange="toggleColorInput()" required>
                                <option>---Seleccione una opción</option>
                                <option value="Sí">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group hidden" id="colorInputGroup">
                            <label for="color" class="formulario_label">Ingrese el color</label>
                            <input type="text" class="formulario_input" id="color" name="color">
                        </div>
                        <button type="submit" class="formulario_submit">Enviar</button>
                    </form>
                    <div id="result" class="result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="adContainer" class="container hidden">
    <div class="row">
        <div class="col-lg-12">
            <div class="result-box">
                <h1>Te presentamos tu anuncio</h1>
                <h5>Anuncio</h5>
                <h5 id="adText"></h5>
                <h4>Logotipo</h4>
                <img id="adImage" src="" alt="Generated Image" style="width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

<script>
    function toggleColorInput() {
        var hasColorInMind = document.getElementById('hasColorInMind').value;
        var colorInputGroup = document.getElementById('colorInputGroup');
        if (hasColorInMind === 'Sí') {
            colorInputGroup.classList.remove('hidden');
        } else {
            colorInputGroup.classList.add('hidden');
        }
    }

    document.getElementById('questionnaire-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const companyName = document.getElementById('companyName').value;
        const sector = document.getElementById('sector').value;
        const products = document.getElementById('products').value;
        const minimalistDesign = document.getElementById('minimalistDesign').value;
        const hasColorInMind = document.getElementById('hasColorInMind').value;
        const color = document.getElementById('color').value;
        const apiKey = "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";

        try {
            // Llamada a la API de OpenAI GPT-4
            const gptResponse = await fetch('https://api.openai.com/v1/chat/completions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${apiKey}`
                },
                body: JSON.stringify({
                    model: "gpt-3.5-turbo",
                    messages: [{
                        role: "user",
                        content: `Crea un anuncio publicitario para la empresa llamada ${companyName} del sector ${sector} la cual ofrece ${products}.`
                    }],
                    max_tokens: 200
                })
            });

            if (!gptResponse.ok) {
                throw new Error(`Error en la solicitud GPT-4: ${gptResponse.statusText}`);
            }

            const gptResult = await gptResponse.json();
            const gptResultText = gptResult.choices[0].message.content;

            // Llamada a la API de OpenAI DALL-E
            const dallePrompt = `Crea un logotipo ${minimalistDesign === 'Sí' ? 'minimalista' : ''} para una compañía llamada "${companyName}" que pertenece al sector de ${sector}. 
            ${hasColorInMind === 'Sí' ? `Por favor, usa el color ${color} en el diseño.` : 'No hay preferencia de color.'} 
            El logotipo debe ser profesional, moderno y representar los valores y la identidad de la compañía. No debe incluir ningún texto, palabras o letras, solo gráficos abstractos o símbolos.`;

            const dalleResponse = await fetch('https://api.openai.com/v1/images/generations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${apiKey}`
                },
                body: JSON.stringify({
                    model: "dall-e-3",
                    prompt: dallePrompt,
                    n: 1,
                    size: "1024x1024"
                })
            });

            if (!dalleResponse.ok) {
                throw new Error(`Error en la solicitud DALL-E: ${dalleResponse.statusText}`);
            }

            const dalleResult = await dalleResponse.json();
            const dalleImageUrl = dalleResult.data[0].url;

            // Mostrar el anuncio y la imagen en la página
            document.getElementById('adText').innerText = gptResultText;
            document.getElementById('adImage').src = dalleImageUrl;
            document.getElementById('adContainer').classList.remove('hidden');

        } catch (error) {
            document.getElementById('error-message').classList.remove('hidden');
            document.getElementById('error-message').innerText = 'Error al procesar la solicitud. Por favor, intente nuevamente.';
            console.error('Error:', error);
        }
    });
</script>

</body>
</html>
