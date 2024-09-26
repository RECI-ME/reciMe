-- Count how many recipes each user has created
SELECT u.user_id, u.username, COUNT(r.recipe_id) AS recipe_count
FROM Users u
JOIN Recipes r ON u.user_id = r.user_id
GROUP BY u.user_id
ORDER BY recipe_count DESC;