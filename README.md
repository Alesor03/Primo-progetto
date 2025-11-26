# Primo-progetto

Struttura iniziale per un portale di gestione di un torneo di calcio basato su Flask.

## Requisiti
- Python 3.10+
- Flask
- Flask-SQLAlchemy

## Installazione e avvio
1. Creare ed attivare un ambiente virtuale.
2. Installare le dipendenze principali:
   ```bash
   pip install flask flask-sqlalchemy
   ```
3. Avviare l'applicazione:
   ```bash
   python run.py
   ```
   Il comando crea automaticamente il database SQLite `tournament.db` se non esiste.

La homepage è raggiungibile su `http://localhost:5000/`.
