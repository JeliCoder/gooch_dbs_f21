/* 
  Lab 02: MariaDB Tutorial
  CSC 362 Database Systems
  Eli Gooch
*/

DROP DATABASE IF EXISTS movie_ratings;

CREATE DATABASE movie_ratings;

USE movie_ratings;

-- Create and fill Movies table

CREATE TABLE Movies
(
    PRIMARY KEY (MovieID),
    MovieID INT AUTO_INCREMENT,
    movie_name VARCHAR(200) NOT NULL,
    ReleaseDate DATETIME NOT NULL,
    Genre VARCHAR(50) NOT NULL
);

INSERT INTO Movies(movie_name, ReleaseDate, Genre) 
VALUES  ('The Hunt for Red October', '1990-03-02', 'Action, Adventure, Thriller'),
        ('Lady Bird', '2017-12-01', 'Comedy, Drama'),
        ('Inception', '2010-08-16', 'Action, Adventure, Sci-Fi');

-- Create and fill Consumers table

CREATE TABLE Consumers
(
    ConsumerID INT NOT NULL AUTO_INCREMENT,
    consumer_first_name VARCHAR(15) NOT NULL,
    consumer_last_name VARCHAR(15) NOT NULL,
    Address VARCHAR(50) NOT NULL,
    City VARCHAR(25) NOT NULL,
    State VARCHAR(2) NOT NULL,
    Zip INT NOT NULL,
    PRIMARY KEY(ConsumerID)
);

INSERT INTO Consumers(consumer_first_name, consumer_last_name, Address, City, State, Zip)

VALUES
('Toru', 'Okada', '800 Glenridge Ave', 'Hobart', 'IN', 46342),
('Kumiko', 'Okada', '864 NW Bohemia St', 'Vincentown', 'NJ', 08088),
('Noboru', 'Wataya', '342 Joy Ridge St', 'Hermitage', 'TN', 37076),
('May', 'Kasahara', '5 Kent Rd', 'East Haven', 'CT', 06512);

-- Create and fill Ratings table

CREATE TABLE Ratings
(

    MovieID INT,
    ConsumerID INT,
    WhenRated DATETIME,
    ratings INT,

    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID),

    FOREIGN KEY (ConsumerID) REFERENCES Consumers(ConsumerID)
);

INSERT INTO Ratings(MovieID, ConsumerID, WhenRated, ratings)

VALUES
(1, 1, '2010-09-02 10:54:19', 4),
(1, 3,'2012-08-05 15:00:01', 3),
(1, 4,'2016-10-02 23:58:12', 1),
(2, 3, '2017-03-27 00:12:48', 2),
(2, 4,'2018-08-02 00:54:42', 4);



-- Show all the tables (before JOIN) to make sure they are filled in correctly
SELECT 'Movies';
SELECT * FROM Movies;
SELECT 'Consumers';
SELECT * FROM Consumers;
SELECT 'Ratings';
SELECT * FROM Ratings;

/* Generate a report */
SELECT consumer_first_name, consumer_last_name, movie_name, ratings
FROM Movies
NATURAL JOIN Ratings
NATURAL JOIN Consumers;









-- Step 6







DROP DATABASE IF EXISTS movie_ratings;

CREATE DATABASE movie_ratings;

USE movie_ratings; 
 
CREATE TABLE Movies
(
 
MovieID INT NOT NULL,
movie_name VARCHAR(200) NOT NULL,
ReleaseDate DATETIME NOT NULL,
Genre VARCHAR(50) NOT NULL,
PRIMARY KEY(MovieID)
 
);
 
INSERT INTO Movies (MovieID, movie_name, ReleaseDate, Genre) 
 
VALUES
(1,'The Hunt for Red October', '1990-03-02', 'Action, Adventure, Thriller'),
(2,'Lady Bird', '2017-12-01', 'Comedy, Drama'),
(3,'Inception', '2010-08-16', 'Action, Adventure, Sci-Fi');
 
CREATE TABLE Consumers
(
 
ConsumerID INT NOT NULL,
consumer_first_name VARCHAR(15) NOT NULL,
consumer_last_name VARCHAR(15) NOT NULL,
Address VARCHAR(50) NOT NULL,
City VARCHAR(25) NOT NULL,
State VARCHAR(2) NOT NULL,
Zip INT NOT NULL,
PRIMARY KEY(ConsumerID)
 
);
 
INSERT INTO Consumers (ConsumerID,consumer_first_name, consumer_last_name,Address, City, State, Zip)
 
VALUES
(1,'Toru','Okada','800 Glenridge Ave','Hobart','IN',46342),
(2,'Kumiko','Okada','864 NW Bohemia St','Vincentown','NJ',08088),
(3,'Noboru','Wataya','342 Joy Ridge St','Hermitage','TN',37076),
(4,'May','Kasahara','5 Kent Rd','East Haven','CT', 06512); 
 
 
CREATE TABLE Ratings
(
 
    MovieID INT,
    ConsumerID INT,
    WhenRated DATETIME,
    NumStars INT,
    FOREIGN KEY (ConsumerID) REFERENCES Consumers(ConsumerID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID)
 
);
 
INSERT INTO Ratings (MovieID, ConsumerID, WhenRated, NumStars)
 
VALUES
(1, 1, '2010-09-02 10:54:19', 4),
(1, 3,'2012-08-05 15:00:01', 3),
(1,4,'2016-10-02 23:58:12', 1),
(2, 3, '2017-03-27 00:12:48', 2),
(2, 4,'2018-08-02 00:54:42', 4);
 

-- Show all the tables to make sure they are filled in correctly
SELECT 'Movies';
SELECT * FROM Movies;
SELECT 'Consumers';
SELECT * FROM Consumers;
SELECT 'Ratings';
SELECT * FROM Ratings;


/* Generate a report */
SELECT "Joined Tables";
SELECT consumer_first_name, consumer_last_name, movie_name, NumStars
 FROM Movies 
 NATURAL JOIN Ratings
 NATURAL JOIN Consumers;



