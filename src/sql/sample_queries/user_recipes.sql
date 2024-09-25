SELECT * FROM Users
LEFT JOIN Recipes
ON Users.user_id = Recipes.user_id
WHERE Users.user_id = 1;
