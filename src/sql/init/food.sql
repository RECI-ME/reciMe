CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Recipes (
    recipe_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    category INT NOT NULL,
    user_id INT,
    trending BOOLEAN,
    FOREIGN KEY (category)
        REFERENCES Categories(category_id)
        ON DELETE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES Users(user_id)
        ON DELETE CASCADE
);