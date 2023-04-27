# Bu araç @keyiflerolsun tarafından | @KekikAkademi için yazılmıştır.

from flask         import Flask
from flask_restful import Resource, Api
from flask_cors    import CORS

app = Flask(__name__)
api = Api(app)
CORS(app, resources={r"/*": {"origins": "*"}}, expose_headers=["Content-Disposition"])

class Urun(Resource):
    def get(self):
        return {
            "Urunler": ["Python", "PHP", "VueJS", "Docker", "docker-compose"]
        }

api.add_resource(Urun, "/")

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)