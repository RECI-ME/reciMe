DROP TABLE IF EXISTS AppUser, Chef, Category, Recipe, Review, UserLikesRecipe, Cuisine;

CREATE TABLE AppUser (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE Chef (
    chef_id INT PRIMARY KEY AUTO_INCREMENT,
    chef_specialty VARCHAR(100),
    user_id INT UNIQUE,
    FOREIGN KEY (user_id) REFERENCES AppUser(user_id)
);

CREATE TABLE Category (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Cuisine (
    cuisine_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);
CREATE TABLE Recipe (
    recipe_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    user_id INT,
    category_id INT,
    cuisine_id INT,
    FOREIGN KEY (user_id) REFERENCES AppUser(user_id),
    FOREIGN KEY (category_id) REFERENCES Category(category_id),
    FOREIGN KEY (cuisine_id) REFERENCES Cuisine(cuisine_id)
);

CREATE TABLE Review (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    recipe_id INT,
    review_text TEXT,
    FOREIGN KEY (user_id) REFERENCES AppUser(user_id),
    FOREIGN KEY (recipe_id) REFERENCES Recipe(recipe_id)
);

CREATE TABLE UserLikesRecipe (
    user_id INT,
    recipe_id INT,
    PRIMARY KEY (user_id, recipe_id),
    FOREIGN KEY (user_id) REFERENCES AppUser(user_id),
    FOREIGN KEY (recipe_id) REFERENCES Recipe(recipe_id)
);

SHOW TABLES;
