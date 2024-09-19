DROP TABLE IF EXISTS 
    Recipes, 
    Categories, 
    Ingredients;


CREATE TABLE Recipes (
    recipe_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    user_id INT,
    trending BOOLEAN,
    FOREIGN KEY (user_id)
        REFERENCES Users(user_id),
        ON DELETE CASCADE
);

CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    recipe_id INT,
    FOREIGN KEY (recipe_id)
        REFERENCES Recipes(recipe_id)
        ON DELETE CASCADE
);

CREATE TABLE Ingredients (
    ingredient_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    recipe_id INT,
    FOREIGN KEY (recipe_id)
        REFERENCES Recipes(recipe_id)
        ON DELETE CASCADE
);


