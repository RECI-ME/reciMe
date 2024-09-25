SELECT u.username, 
GROUP_CONCAT(r.name SEPARATOR '\n') AS favorite_recipes
FROM Favorites f
JOIN Users u ON f.user_id = u.user_id
JOIN Recipes r ON f.recipe_id = r.recipe_id
GROUP BY u.username;
