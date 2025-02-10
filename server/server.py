from flask import Flask, jsonify, request, render_template
from flask_cors import CORS
import json
import pickle
import numpy as np
import os
import joblib  # For loading scaler if needed

app = Flask(__name__)
CORS(app)


# Function to dynamically load city-specific model and columns
def load_city_data(city):
    if not city:
        print("❌ Error: City name is missing!")
        return None, None

    city = city.lower()  # Fixes NameError by ensuring 'city' is always defined
    columns_file = f'artifacts/{city}_columns.json'
    model_file = f'artifacts/{city}_model.pickle'

    if not os.path.exists(columns_file) or not os.path.exists(model_file):
        print(f"❌ Error: Missing data files for {city}")
        return None, None

    with open(columns_file, 'r') as f:
        columns_data = json.load(f)['data_columns']

    with open(model_file, 'rb') as f:
        model = pickle.load(f)

    return model, columns_data


@app.route('/')
def home():
    return render_template('app.html')


@app.route('/get_localities')
def get_localities():
    city = request.args.get('city', 'ahmedabad').lower()  # Ensure city is defined
    _, columns_data = load_city_data(city)

    if columns_data:
        localities = [col.split('_')[1] for col in columns_data if col.startswith('locality_')]
        return jsonify({'localities': localities})
    else:
        return jsonify({'error': f'No data found for city: {city}', 'localities': []})


@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json(force=True)  # ✅ Ensures JSON is parsed even if Content-Type is incorrect
        print("📩 Received Data:", data)  # Debugging log

        if not data:
            return jsonify({'error': 'No data received', 'status': 'error'}), 400

        city = data.get('city', 'ahmedabad').lower()
        model, columns_data = load_city_data(city)

        if model is None or columns_data is None:
            return jsonify({'error': f'Model or data not found for {city}', 'status': 'error'}), 400

        # Construct feature vector
        features = np.zeros(len(columns_data))
        features[0] = int(data['bhk'])
        features[1] = float(data['area'])

        locality = f"locality_{data['locality'].lower()}"

        # Reset all locality values first
        for col in columns_data:
            if col.startswith("locality_"):
                features[columns_data.index(col)] = 0  # Reset other localities

        # Activate the selected locality
        if locality in columns_data:
            features[columns_data.index(locality)] = 1
            print(f"✅ Activated Locality: {locality}")
        else:
            print(f"❌ Locality '{locality}' Not Found in Columns!")

        print(f"🏙 Selected Locality: {data['locality']}")
        print(f"🛠 Mapped Column Name: {locality}")
        print(f"Available Columns: {columns_data}")

        prop_type = f"property_type_{data['property_type'].lower()}"  # Keep spaces

        # Reset all property types first
        for col in columns_data:
            if col.startswith("property_type_"):
                features[columns_data.index(col)] = 0  # Reset other property types

        # Set the correct property type
        if prop_type in columns_data:
            features[columns_data.index(prop_type)] = 1
            print(f"✅ Activated Property Type: {prop_type}")
        else:
            print(f"❌ Property Type '{prop_type}' Not Found in Columns!")

        print(f"🏠 Selected Property Type: {data['property_type']}")
        print(f"🛠 Mapped Column Name: {prop_type}")
        print(f"Available Columns: {columns_data}")
        # Prediction
        import pandas as pd  # Ensure pandas is imported

        # Convert features to a DataFrame with proper column names
        features_df = pd.DataFrame([features], columns=columns_data)

        # Make the prediction
        prediction = model.predict(features_df)[0]

        print("🔮 Prediction:", prediction)

        return jsonify({'prediction': float(format(prediction, ".2f")), 'status': 'success'})

    except Exception as e:
        print("❌ Error:", str(e))
        return jsonify({'error': str(e), 'status': 'error'}), 500


if __name__ == '__main__':
    app.run(debug=True)


