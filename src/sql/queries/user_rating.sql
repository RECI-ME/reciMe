-- Show all ratings given by a specific user along with the recipe names
SELECT u.username, r.name AS recipe_name, ra.score
FROM Ratings ra
JOIN Users u ON ra.user_id = u.user_id
JOIN Recipes r ON ra.recipe_id = r.recipe_id
-- WHERE u.username = 'specific_username';  -- Replace 'specific_username' as needed
