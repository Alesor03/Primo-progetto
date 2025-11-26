from flask import Blueprint, render_template

main_bp = Blueprint("main", __name__)


@main_bp.route("/")
def index():
    """Homepage basilare dell'applicazione."""
    return render_template("index.html")
