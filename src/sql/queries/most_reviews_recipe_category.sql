-- Find the recipe with the most reviews in each category
SELECT r.category, r.recipe_id, r.name AS recipe_name, 
       COUNT(rev.review_id) AS review_count
FROM Recipes r
JOIN Reviews rev ON r.recipe_id = rev.recipe_id
GROUP BY r.category, r.recipe_id
HAVING COUNT(rev.review_id) = (
    SELECT MAX(review_count)
    FROM (SELECT r2.recipe_id, COUNT(rev2.review_id) AS review_count
          FROM Recipes r2
          JOIN Reviews rev2 ON r2.recipe_id = rev2.recipe_id
          GROUP BY r2.recipe_id) AS reviews_per_recipe
)
ORDER BY review_count DESC;
