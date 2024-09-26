SELECT Recipes.name AS recipe_name, Users.username
FROM Recipes
JOIN Users ON Recipes.user_id = Users.id
WHERE Users.user_id = 1 ;