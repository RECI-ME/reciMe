SELECT * FROM Recipes
INNER JOIN Reviews
ON Recipes.recipe_id = Reviews.recipe_id
WHERE Recipes.user_id = 1;
