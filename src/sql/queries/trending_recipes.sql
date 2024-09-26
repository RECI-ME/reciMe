-- List all trending recipes along with their creators
SELECT r.name AS recipe_name, u.username
FROM Recipes r
JOIN Users u ON r.user_id = u.user_id
WHERE r.trending = TRUE;
