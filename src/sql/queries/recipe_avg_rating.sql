-- Get the average rating for each recipe along with the recipe name
SELECT r.recipe_id, r.name AS recipe_name, AVG(ra.score) AS avg_rating
FROM Recipes r
JOIN Ratings ra ON r.recipe_id = ra.recipe_id
GROUP BY r.recipe_id
ORDER BY avg_rating DESC;