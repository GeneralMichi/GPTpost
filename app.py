from flask import Flask, request, jsonify
from tensorflow.keras.preprocessing.sequence import pad_sequences
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.models import model_from_json
import numpy as np
import h5py

app = Flask(__name__)

def custom_load_model(filepath):
    with h5py.File(filepath, 'r') as f:
        model_config = f.attrs.get('model_config').decode('utf-8')
        model_config = model_config.replace('"time_major": false,', '')
        model = model_from_json(model_config)

        model.load_weights(filepath)
    return model

model = custom_load_model('assets/modelo/modelo_entrenado_final2.h5')
max_sequence_len = 100  # Ajusta esto según tu modelo

tokenizer = Tokenizer()
with open('tokens.txt', 'r') as file:
    tokens = file.readlines()
for i, token in enumerate(tokens):
    tokenizer.word_index[token.strip()] = i + 1

@app.route('/predict', methods=['POST'])
def predict():
    data = request.json
    seed_text = data['seed_text']
    next_words = data['next_words']

    for _ in range(next_words):
        token_list = tokenizer.texts_to_sequences([seed_text])[0]
        token_list = pad_sequences([token_list], maxlen=max_sequence_len-1, padding='pre')
        predicted = np.argmax(model.predict(token_list, verbose=0), axis=-1)
        output_word = ""
        for word, index in tokenizer.word_index.items():
            if index == predicted:
                output_word = word
                break
        seed_text += " " + output_word

    return jsonify({'result': seed_text})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
