INSERT INTO Users (since TIMESTAMP DEFAULT CURRENT_TIMESTAMP, username, email, password) 
VALUES 
(CURRENT_TIMESTAMP, 'chefjohn', 'john@example.com', 'password123'),
(CURRENT_TIMESTAMP, 'marychef', 'mary@example.com', 'password456'),
(CURRENT_TIMESTAMP, 'gordonramsay', 'gordon@example.com', 'chefking'),
(CURRENT_TIMESTAMP, 'jamieoliver', 'jamie@example.com', 'healthychef');


INSERT INTO Categories (name) 
VALUES 
('Dessert'),
('Main Course'),
('Appetizer'),
('Beverage');


INSERT INTO Recipes (name, user_id, category_id, description) 
VALUES 
('Chocolate Cake', 1, 1, 'Rich chocolate cake with frosting'),
('Grilled Salmon', 2, 2, 'Grilled salmon with lemon and herbs'),
('Apple Pie', 3, 1, 'Delicious traditional apple pie'),
('Caesar Salad', 4, 3, 'Healthy Caesar Salad with homemade dressing'),
('Mojito', 1, 4, 'Refreshing mint and lime cocktail');


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
(1, 5, 'Amazing chocolate cake! Best I have ever made!'),
(2, 4, 'Tasty, but needed more seasoning.'),
(3, 5, 'Classic apple pie, my go-to recipe.'),
(4, 3, 'Caesar salad was good, but dressing was a bit bland.'),
(5, 5, 'Perfect Mojito, refreshing and delicious!');
