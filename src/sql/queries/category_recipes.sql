-- Count the number of recipes in each category and list their names
SELECT r.category, r.name, COUNT(r.recipe_id) AS recipe_count
FROM Recipes r
GROUP BY r.category;
