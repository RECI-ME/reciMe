-- Show all reviews along with the associated recipe namess
SELECT rev.review_id, rev.review_text, r.name AS recipe_name
FROM Reviews rev
JOIN Recipes r ON rev.recipe_id = r.recipe_id;