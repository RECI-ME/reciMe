-- Show all ratings given by a specific user along with the recipe names
SELECT Users.username, Recipes.name, Ratings.score
FROM Ratings
INNER JOIN Users ON Ratings.user_id = Users.user_id
INNER JOIN Recipes ON Ratings.recipe_id = Recipes.recipe_id
GROUP BY Recipes.name
