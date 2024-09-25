SELECT c.name AS category_name,
COUNT(r.recipe_id) AS recipe_count,
GROUP_CONCAT(r.name SEPARATOR '\n') AS recipe_names
FROM Recipes r
JOIN Categories c ON r.recipe_id = c.recipe_id
WHERE c.name = 'Category'
GROUP BY c.name;