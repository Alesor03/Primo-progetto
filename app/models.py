from datetime import datetime

from app import db


class Team(db.Model):
    __tablename__ = "teams"

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(120), unique=True, nullable=False)
    captain_name = db.Column(db.String(120), nullable=False)
    captain_email = db.Column(db.String(255), unique=True, nullable=False)
    creation_date = db.Column(db.DateTime, default=datetime.utcnow)

    players = db.relationship("Player", back_populates="team", cascade="all, delete-orphan")
    home_matches = db.relationship(
        "Match",
        foreign_keys="Match.home_team_id",
        back_populates="home_team",
        cascade="all, delete-orphan",
    )
    away_matches = db.relationship(
        "Match",
        foreign_keys="Match.away_team_id",
        back_populates="away_team",
        cascade="all, delete-orphan",
    )

    def __repr__(self) -> str:  # pragma: no cover - rappresentazione semplice
        return f"<Team {self.name}>"


class Player(db.Model):
    __tablename__ = "players"

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(120), nullable=False)
    team_id = db.Column(db.Integer, db.ForeignKey("teams.id"))
    goals = db.Column(db.Integer, default=0)

    team = db.relationship("Team", back_populates="players")

    def __repr__(self) -> str:  # pragma: no cover - rappresentazione semplice
        return f"<Player {self.name}>"


class Match(db.Model):
    __tablename__ = "matches"

    id = db.Column(db.Integer, primary_key=True)
    home_team_id = db.Column(db.Integer, db.ForeignKey("teams.id"))
    away_team_id = db.Column(db.Integer, db.ForeignKey("teams.id"))
    match_date = db.Column(db.DateTime)
    home_team_score = db.Column(db.Integer, default=0)
    away_team_score = db.Column(db.Integer, default=0)
    status = db.Column(db.String(50), default="Scheduled")

    home_team = db.relationship("Team", foreign_keys=[home_team_id], back_populates="home_matches")
    away_team = db.relationship("Team", foreign_keys=[away_team_id], back_populates="away_matches")

    def __repr__(self) -> str:  # pragma: no cover - rappresentazione semplice
        return f"<Match {self.home_team_id} vs {self.away_team_id}>"
