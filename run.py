from app import create_app, db

app = create_app()


def setup_database() -> None:
    """Crea tutte le tabelle se non esistono."""
    with app.app_context():
        db.create_all()


if __name__ == "__main__":
    setup_database()
    app.run(debug=True)
