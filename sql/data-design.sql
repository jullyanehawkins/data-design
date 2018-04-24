ALTER DATABASE jhawkins20 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS ratings;
DROP TABLE IF EXISTS movie;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profileHash	CHAR(128) NOT NULL,
	profileName VARCHAR(32),
	UNIQUE (profileId),
	UNIQUE (profileActivationToken),
	UNIQUE(profileEmail),
	PRIMARY KEY(profileId)
);

CREATE TABLE movie (
	movieId BINARY(16) NOT NULL,
	movieName VARCHAR(32),
	movieDirector VARCHAR(32),
	movieGenre VARCHAR(32),
	movieLength TINYINT(1),
	UNIQUE(movieId),
	PRIMARY KEY(movieId)
);

CREATE TABLE ratings (
	ratingsProfileId BINARY(16) NOT NULL,
	ratingsMovieId BINARY(16) NOT NULL,
	ratingsDate DATETIME(6) NOT NULL,
	INDEX(ratingsProfileId),
	INDEX(ratingsMovieId),
	FOREIGN KEY(ratingsProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(ratingsMovieId) REFERENCES movie(movieId),
	PRIMARY KEY(ratingsProfileId, ratingsMovieId)
);