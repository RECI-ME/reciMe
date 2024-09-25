INSERT INTO Users (since , username, email, password) 
VALUES 
(CURRENT_TIMESTAMP, 'chefjohn', 'john@example.com', 'password123'),
(CURRENT_TIMESTAMP, 'marychef', 'mary@example.com', 'password456'),
(CURRENT_TIMESTAMP, 'gordonramsay', 'gordon@example.com', 'chefking'),
(CURRENT_TIMESTAMP, 'jamieoliver', 'jamie@example.com', 'healthychef');


INSERT INTO Recipes (name, user_id) 
VALUES 
('Chocolate Cake', 1),
('Grilled Salmon', 2),
('Apple Pie', 3),
('Caesar Salad', 4),
('Mojito', 1);


INSERT INTO Ingredients (recipe_id, name) 
VALUES 
(1, 'Chocolate'),
(1, 'Flour'),
(1, 'Sugar'),
(2, 'Salmon'),
(2, 'Lemon'),
(2, 'Olive Oil'),
(3, 'Apples'),
(3, 'Cinnamon'),
(4, 'Romaine Lettuce'),
(4, 'Parmesan Cheese'),
(5, 'Mint Leaves'),
(5, 'Lime');

-- Populating reviews table
INSERT INTO Reviews (recipe_id, user_id, review_text) 
VALUES 
(1, 1, 'Amazing chocolate cake! Best I have ever made!'),
(2, 3, 'Tasty, but needed more seasoning.'),
(3, 1, 'Classic apple pie, my go-to recipe.'),
(2, 3, 'Caesar salad was good, but dressing was a bit bland.'),
(1, 2, 'Perfect Mojito, refreshing and delicious!');


INSERT INTO Ratings (recipe_id, user_id, score) 
VALUES 
(1, 1, 10),
(2, 3, 9),
(3, 1, 8),
(2, 3, 5),
(1, 2, 7);
