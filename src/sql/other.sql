CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    recipe_id INT,
    review_text TEXT,
    FOREIGN KEY (user_id) 
        REFERENCES Users(user_id)
        ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) 
        REFERENCES Recipes(recipe_id)
        ON DELETE CASCADE
);

CREATE TABLE Favorites (
    favorite_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    recipe_id INT,
    FOREIGN KEY (user_id) 
        REFERENCES Users(user_id)
        ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) 
        REFERENCES Recipes(recipe_id)
        ON DELETE CASCADE
);

CREATE TABLE Ratings (
    rating_id INT PRIMARY KEY AUTO_INCREMENT,
    score INT NOT NULL,
    recipe_id INT,
    user_id INT,
    FOREIGN KEY (recipe_id)
        REFERENCES Recipes(recipe_id)
        ON DELETE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES Users(user_id)
        ON DELETE CASCADE
);

CREATE TABLE MarkedReviews (
    marked_review_id INT PRIMARY KEY AUTO_INCREMENT,
    review_id INT,
    user_id INT NOT NULL,
    FOREIGN KEY (review_id)
        REFERENCES Reviews(review_id)
        ON DELETE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES Users(user_id)
        ON DELETE CASCADE
);

