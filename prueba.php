<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Texto</title>
    <!-- Aquí puedes incluir tus hojas de estilo CSS -->
</head>
<body>
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
</body>
</html>
