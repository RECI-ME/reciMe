-- List all ingredients for each recipe
SELECT r.recipe_id, r.name AS recipe_name, i.ingredient_id, i.name AS ingredient_name
FROM Recipes r
JOIN Ingredients i ON r.recipe_id = i.recipe_id;