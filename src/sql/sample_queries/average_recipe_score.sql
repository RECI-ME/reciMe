SELECT rating_id, AVG(score) FROM Ratings
INNER JOIN Recipes
ON recipe_id = Recipes.recipe_id
GROUP BY recipe_id
