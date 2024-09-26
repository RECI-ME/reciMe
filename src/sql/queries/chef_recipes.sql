-- List all chefs and their respective recipes, indicating certified chefs
SELECT 
    IF(cc.certified_chef_id IS NOT NULL, CONCAT(u.username, ' (Certified)'), u.username) AS chef_name,
    r.name AS recipe_name
FROM Chefs c
JOIN Users u ON c.user_id = u.user_id
JOIN Recipes r ON r.user_id = u.user_id
LEFT JOIN CertifiedChefs cc ON c.chef_id = cc.chef_id;