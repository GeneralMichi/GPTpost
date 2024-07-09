const express = require('express');
const bodyParser = require('body-parser');
const axios = require('axios');

const app = express();
const port = 3000;
const apiKey = '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';

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(express.static('public')); // Sirve archivos estáticos de la carpeta 'public'

// Ruta para recibir datos del formulario
app.post('/submit', async (req, res) => {
    const { companyName, sector, products, hasSlogan, minimalistDesign, hasColorInMind, color } = req.body;

    try {
        // Llamada a la API de OpenAI GPT-4
        const gptResponse = await axios.post('https://api.openai.com/v1/completions', {
            model: 'gpt-3.5-turbo',
            prompt: 'Create a business description for a company named ${companyName} in the ${sector} sector that offers ${products}.',
            max_tokens: 100
        }, {
            headers: {
                'Authorization': `Bearer ${apiKey}`
            }
        });

        const gptResult = gptResponse.data.choices[0].text;

        // Llamada a la API de OpenAI DALL-E
        const dallEResponse = await axios.post('https://api.openai.com/v1/images/generations', {
            prompt: 'Create a ${minimalistDesign === 'Sí' ? 'minimalist' : ''} logo for a company named ${companyName} in the ${sector} sector. ${hasColorInMind === 'Sí' ? `Use the color ${color}.` : ''}',
            n: 1,
            size: '1024x1024'
        }, {
            headers: {
                'Authorization': `Bearer ${apiKey}`
            }
        });

        const dallEResult = dallEResponse.data.data[0].url;

        // Redirigir a la página de resultados con los datos recibidos
        res.redirect(`/results.html?gpt=${encodeURIComponent(gptResult)}&dalle=${encodeURIComponent(dallEResult)}`);
    } catch (error) {
        console.error('Error al llamar a la API de OpenAI:', error);
        res.status(500).send('Error al procesar la solicitud');
    }
});

// Iniciar el servidor
app.listen(port, () => {
    console.log(`Servidor ejecutándose en http://localhost:${port}`);
});
