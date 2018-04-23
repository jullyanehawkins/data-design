INSERT INTO profile(profileId,profileActivationToken, profileEmail, profileHash, profileName)
VALUES(UNHEX(REPLACE("f6d46fac-c4a0-49c6-bc70-fb0fbeeacb6b", "-", "")), "012345", "jullyanejgf@gmail.com", "67890", "jully");

UPDATE profile
SET profileName = "Jullyane"
WHERE profileName = "jully";

DELETE FROM profile
WHERE profileEmail = "jullyanejgf@gmail.com";

INSERT INTO movie(movieId, movieName, movieDirector, movieGenre, movieLength)
VALUES(UNHEX(REPLACE("690319b4-1111-48f1-a3c8-0003198c94db", "-", "")), "Reservoir Dogs", "Quentin Tarantino", "Thriller", "1h39m");

UPDATE movie
SET movieGenre = "Crime"
WHERE movieGenre = "Thriller";

DELETE FROM movie
WHERE movieId = UNHEX("f6d46facc4a049c6bc70fb0fbeeacb6b");