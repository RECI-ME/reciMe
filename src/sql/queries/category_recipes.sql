-- Count the number of recipes in each category and list their names
SELECT c.category,
       COUNT(r.recipe_id) AS recipe_count,
       GROUP_CONCAT(r.name SEPARATOR '\n') AS recipe_names
FROM Recipes r
JOIN Categories c ON r.category = c.name
GROUP BY c.category;