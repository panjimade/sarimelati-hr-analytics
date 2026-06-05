from flask import Flask, request, jsonify
import pandas as pd
from sklearn.ensemble import RandomForestClassifier

app = Flask(__name__)

FEATURES = [
    "rata_rata_kpi",
    "jumlah_tidak_hadir",
    "total_telat",
    "rata_rata_telat",
    "jumlah_hari_hadir"
]


def get_risk_category(score):
    if score >= 70:
        return "Tinggi"
    elif score >= 40:
        return "Sedang"
    return "Rendah"


def get_prediction_label(score):
    if score >= 50:
        return "Berisiko Resign"
    return "Bertahan"


@app.route("/health", methods=["GET"])
def health():
    return jsonify({
        "status": "ok",
        "message": "Python Random Forest API is running"
    })


@app.route("/predict-turnover", methods=["POST"])
def predict_turnover():
    data = request.get_json(silent=True)

    if not data or "employees" not in data:
        return jsonify({
            "status": "error",
            "message": "Payload employees tidak ditemukan."
        }), 400

    employees = data["employees"]

    if len(employees) == 0:
        return jsonify({
            "status": "error",
            "message": "Data employees kosong."
        }), 400

    df = pd.DataFrame(employees)

    required_columns = [
        "employee_id",
        "employee_code",
        "nama",
        "status_keluar",
    ] + FEATURES

    missing_columns = [col for col in required_columns if col not in df.columns]

    if missing_columns:
        return jsonify({
            "status": "error",
            "message": "Kolom data tidak lengkap.",
            "missing_columns": missing_columns
        }), 400

    for feature in FEATURES:
        df[feature] = pd.to_numeric(df[feature], errors="coerce").fillna(0)

    df["status_keluar"] = pd.to_numeric(
        df["status_keluar"],
        errors="coerce"
    ).fillna(0).astype(int)

    if df["status_keluar"].nunique() < 2:
        return jsonify({
            "status": "error",
            "message": "Training Random Forest membutuhkan minimal 2 kelas target: 0 dan 1."
        }), 400

    X = df[FEATURES]
    y = df["status_keluar"]

    model = RandomForestClassifier(
        n_estimators=100,
        random_state=42,
        class_weight="balanced"
    )

    model.fit(X, y)

    probabilities = model.predict_proba(X)
    classes = list(model.classes_)

    if 1 in classes:
        resign_index = classes.index(1)
    else:
        resign_index = 0

    prediction_results = []

    for idx, row in df.iterrows():
        resign_probability = float(probabilities[idx][resign_index] * 100)

        prediction_results.append({
            "employee_id": int(row["employee_id"]),
            "employee_code": row["employee_code"],
            "nama": row["nama"],
            "rata_rata_kpi": round(float(row["rata_rata_kpi"]), 2),
            "jumlah_tidak_hadir": int(row["jumlah_tidak_hadir"]),
            "total_telat": int(row["total_telat"]),
            "rata_rata_telat": round(float(row["rata_rata_telat"]), 2),
            "jumlah_hari_hadir": int(row["jumlah_hari_hadir"]),
            "skor_prediksi": round(resign_probability, 2),
            "kategori_risiko": get_risk_category(resign_probability),
            "hasil_prediksi": get_prediction_label(resign_probability),
        })

    training_accuracy = round(float(model.score(X, y) * 100), 2)

    return jsonify({
        "status": "success",
        "model": "RandomForestClassifier",
        "training_accuracy": training_accuracy,
        "total_data": len(prediction_results),
        "predictions": prediction_results
    })


if __name__ == "__main__":
    app.run(host="127.0.0.1", port=5000, debug=True)