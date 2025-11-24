from flask import Flask
from flask_sqlalchemy import SQLAlchemy

# Inizializzazione dell'oggetto SQLAlchemy a livello di package
# per consentire l'utilizzo nei moduli dei modelli e delle view.
db = SQLAlchemy()


def create_app():
    """Factory per creare e configurare l'app Flask."""
    app = Flask(
        __name__,
        template_folder="../templates",
        static_folder="../static",
    )

    # Configurazione di base dell'applicazione e del database SQLite
    app.config.from_mapping(
        SQLALCHEMY_DATABASE_URI="sqlite:///tournament.db",
        SQLALCHEMY_TRACK_MODIFICATIONS=False,
    )

    db.init_app(app)

    # Import locale per registrare modelli e blueprint
    from app import models  # noqa: F401
    from app.routes import main_bp

    app.register_blueprint(main_bp)

    return app
