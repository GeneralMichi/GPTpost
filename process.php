<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $_POST['companyName'];
    $sector = $_POST['sector'];
    $products = $_POST['products'];
    $hasSlogan = $_POST['hasSlogan'];
    $minimalistDesign = $_POST['minimalistDesign'];
    $hasColorInMind = $_POST['hasColorInMind'];
    $color = isset($_POST['color']) ? $_POST['color'] : '';

    $apiKey = "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";

    // Función para manejar las llamadas a la API
    function call_openai_api($url, $data, $apiKey) {
        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/json\r\n" .
                             "Authorization: Bearer $apiKey\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
                'ignore_errors' => true
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === FALSE) {
            // Manejo de errores en caso de que la solicitud falle
            global $http_response_header;
            error_log("Error HTTP: " . implode(", ", $http_response_header));
            return NULL;
        }

        $result = json_decode($response, true);

        if (isset($result['error'])) {
            error_log("Error en la respuesta de OpenAI: " . json_encode($result['error']));
            return NULL;
        }

        return $result;
    }

    // Llamada a la API de OpenAI GPT-4
    $gptPrompt = "Create a business description for a company named $companyName in the $sector sector that offers $products.";
    $gptData = array(
        "model" => "text-davinci-003",  // Cambiado a un modelo conocido
        "prompt" => $gptPrompt,
        "max_tokens" => 100
    );

    $gptResult = call_openai_api('https://api.openai.com/v1/completions', $gptData, $apiKey);

    if ($gptResult === NULL || !isset($gptResult['choices'][0]['text'])) {
        // Redirigir de vuelta al formulario con mensaje de error y datos ingresados
        $errorMessage = urlencode('Error al procesar la solicitud de GPT-4. Verifica los registros para más detalles.');
        header("Location: prompts.php?error=$errorMessage&companyName=" . urlencode($companyName) . "&sector=" . urlencode($sector) . "&products=" . urlencode($products) . "&hasSlogan=" . urlencode($hasSlogan) . "&minimalistDesign=" . urlencode($minimalistDesign) . "&hasColorInMind=" . urlencode($hasColorInMind) . "&color=" . urlencode($color));
        exit();
    }

    $gptResultText = $gptResult['choices'][0]['text'];

    // Llamada a la API de OpenAI DALL-E
    $dallePrompt = "Create a " . ($minimalistDesign == 'Sí' ? 'minimalist' : '') . " logo for a company named $companyName in the $sector sector." . ($hasColorInMind == 'Sí' ? " Use the color $color." : '');
    $dalleData = array(
        "prompt" => $dallePrompt,
        "n" => 1,
        "size" => "1024x1024"
    );

    $dalleResult = call_openai_api('https://api.openai.com/v1/images/generations', $dalleData, $apiKey);

    if ($dalleResult === NULL || !isset($dalleResult['data'][0]['url'])) {
        // Redirigir de vuelta al formulario con mensaje de error y datos ingresados
        $errorMessage = urlencode('Error al procesar la solicitud de DALL-E. Verifica los registros para más detalles.');
        header("Location: prompts.php?error=$errorMessage&companyName=" . urlencode($companyName) . "&sector=" . urlencode($sector) . "&products=" . urlencode($products) . "&hasSlogan=" . urlencode($hasSlogan) . "&minimalistDesign=" . urlencode($minimalistDesign) . "&hasColorInMind=" . urlencode($hasColorInMind) . "&color=" . urlencode($color));
        exit();
    }

    // Obtener la URL de la imagen
    $dalleImageUrl = $dalleResult['data'][0]['url'];

    // Redirigir a la página de resultados con los datos recibidos
    header("Location: results.php?gpt=" . urlencode($gptResultText) . "&dalle=" . urlencode($dalleImageUrl));
    exit();
}
?>
