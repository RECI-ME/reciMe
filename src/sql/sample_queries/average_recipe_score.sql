SELECT rating_id, AVG(score) FROM Ratings
INNER JOIN Recipes
ON Ratings.rating_id = Recipes.recipe_id
GROUP BY Recipes.recipe_id;
