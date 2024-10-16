-- Find the recipe with the highest average rating and its associated chef
SELECT r.name AS recipe_name, AVG(ra.score) AS avg_rating, u.username AS chef_name
FROM Recipes r
JOIN Ratings ra ON r.recipe_id = ra.recipe_id
JOIN Users u ON r.user_id = u.user_id
GROUP BY r.recipe_id
ORDER BY avg_rating DESC
LIMIT 1;
