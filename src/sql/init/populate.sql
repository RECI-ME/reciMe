INSERT INTO Users (since , username, email, password) 
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

INSERT INTO Recipes (name, category, user_id) 
VALUES 
('Chocolate Cake',1, 1),
('Grilled Salmon',2, 2),
('Apple Pie', 1, 3),
('Caesar Salad',3, 4),
('Mojito', 4,1);

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


INSERT INTO Favorites (user_id, recipe_id)
VALUES
(1, 2),
(2, 1),
(3, 3),
(1, 5),
(4, 4);


INSERT INTO Chefs (since, user_id)
VALUES
(CURRENT_TIMESTAMP, 1),  -- chefjohn
(CURRENT_TIMESTAMP, 2),  -- marychef
(CURRENT_TIMESTAMP, 3);  -- gordonramsay
 
-- Insert certified chefs (linking chefs to certification)
INSERT INTO CertifiedChefs (since, chef_id)
VALUES
(CURRENT_TIMESTAMP, 1),  -- chefjohn certified
(CURRENT_TIMESTAMP, 2);  -- marychef certified
 
-- Insert marked reviews (only valid user IDs)
INSERT INTO MarkedReviews (review_id, user_id)
VALUES
(1, 1),  -- User 1 marks their own review
(2, 3);  -- User 3 marks their own review