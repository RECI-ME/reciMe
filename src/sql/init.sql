CREATE DATABASE RECIME;

DROP TABLE IF EXISTS 
    Users, 
    Chefs, 
    MichelinChefs,
    Categories, 
    Recipes, 
    Reviews, 
    Favorites, 
    Ratings, 
    MarkedReviews,
    Ingredients;


CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    since TIMESTAMP NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE Chefs (
    chef_id INT PRIMARY KEY AUTO_INCREMENT,
    since TIMESTAMP NOT NULL,
    user_id INT UNIQUE,
    FOREIGN KEY (user_id) 
        REFERENCES Users(user_id)
        ON DROP CASCADE,
);

CREATE TABLE CertifiedChefs (
    certified_chef_id INT PRIMARY KEY AUTO_INCREMENT,
    since TIMESTAMP NOT NULL,
    chef_specialty VARCHAR(100),
    chief_id INT,
    FOREIGN KEY (chef_id) 
        REFERENCES Chefs(user_id)
        ON DROP CASCADE,
);

CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    recipe_id INT,
    FOREIGN KEY (recipe_id)
        REFERENCES Recipes(recipe_id)
        ON DELETE CASCADE,
);

CREATE TABLE Recipes (
    recipe_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    user_id INT,
    trending BOOLEAN,
    FOREIGN KEY (user_id),
        REFERENCES Users(user_id),
        ON DELETE CASCADE,
);

CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    recipe_id INT,
    review_text TEXT,
    FOREIGN KEY (user_id) 
        REFERENCES Users(user_id)
        ON DROP CASCADE,
    FOREIGN KEY (recipe_id) 
        REFERENCES Recipes(recipe_id)
        ON DROP CASCADE,
);

CREATE TABLE Favorites (
    favorite_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    recipe_id INT,
    FOREIGN KEY (user_id) 
        REFERENCES Users(user_id)
        ON DROP CASCADE,
    FOREIGN KEY (recipe_id) 
        REFERENCES Recipes(recipe_id)
        ON DROP CASCADE,
);

CREATE TABLE Ratings (
    rating_id INT PRIMARY KEY AUTO_INCREMENT,
    score INT NOT NULL,
    recipe_id INT,
    FOREIGN KEY (recipe_id)
        REFERENCES Recipes(recipe_id)
        ON DROP CASCADE,
);

CREATE TABLE MarkedReviews (
    marked_review_id INT PRIMARY KEY AUTO_INCREMENT,
    review_id INT,
    user_id INT NOT NULL,
    FOREIGN KEY (review_id)
        REFERENCES Reviews(review_id)
        ON DROP CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES Users(user_id)
        ON DROP CASCADE,
);

CREATE TABLE Ingredients (
    ingredient_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    recipe_id INT,
    FOREIGN KEY (recipe_id)
        REFERENCES Recipes(recipe_id)
        ON DROP CASCADE,
);


SHOW TABLES;
