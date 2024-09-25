
/* all ingredients of a recipe */
SELECT r.recipe_id, r.name AS recipe_name,
     i.ingredient_id, i.name AS ingredient_name
FROM Recipes r
JOIN Ingredients i ON r.recipe_id = i.recipe_id
WHERE r.recipe_id = [RECIPE_ID];  


/* optional*/

/* another query if this is too simple*/

/* finding all recepies that uses a spesific ingredient*/

SELECT r.recipe_id, r.name AS recipe_name, c.name AS category_name
FROM Recipes r
JOIN Recipe_Ingredients ri ON r.recipe_id = ri.recipe_id
JOIN Ingredients i ON ri.ingredient_id = i.ingredient_id
JOIN Categories c ON r.recipe_id = c.recipe_id
/*WHERE i.name = '[INGREDIENT_NAME]';*/


/* all reviews of a user */
SELECT rev.review_id, rev.review_text, r.name AS recipe_name
FROM Reviews rev
JOIN Recipes r ON rev.recipe_id = r.recipe_id
/*WHERE rev.user_id = [USER_ID];*/

/*OR*/


/* optional*/


/* most active chefs(most recepies owned) */


SELECT u.user_id, u.username, COUNT(r.recipe_id) AS recipe_count
FROM Users u
JOIN Recipes r ON u.user_id = r.user_id
GROUP BY u.user_id
ORDER BY recipe_count DESC; /*order by the number of recepies*/



/* recepies that belong into multiple categories*/
/*group by*/

SELECT r.recipe_id, r.name AS recipe_name, 
       COUNT(c.category_id) AS category_count
FROM Recipes r
JOIN Categories c ON r.recipe_id = c.recipe_id
GROUP BY r.recipe_id
HAVING COUNT(c.category_id) > 1
ORDER BY category_count DESC;



/* additional queries if needed */

/*most rewiewed recepie on each category*/

/* using group by */


SELECT c.name AS category_name, r.recipe_id, r.name AS recipe_name, 
       COUNT(rev.review_id) AS review_count
FROM Categories c
JOIN Recipes r ON c.recipe_id = r.recipe_id
JOIN Reviews rev ON r.recipe_id = rev.recipe_id
GROUP BY c.category_id, r.recipe_id
HAVING COUNT(rev.review_id) = (
    SELECT MAX(review_count)
    FROM (SELECT r2.recipe_id, COUNT(rev2.review_id) AS review_count
          FROM Recipes r2
          JOIN Reviews rev2 ON r2.recipe_id = rev2.recipe_id
          GROUP BY r2.recipe_id) AS reviews_per_recipe
)
ORDER BY review_count DESC;

/* OR */
/* TOP RATED RECEPIE OF EACH CATEGORY */

/*group by(optional)*/
/* used GPT */

SELECT c.name AS category_name, r.recipe_id, r.name AS recipe_name, 
       AVG(ra.score) AS avg_rating
FROM Categories c
JOIN Recipes r ON c.recipe_id = r.recipe_id
JOIN Ratings ra ON r.recipe_id = ra.recipe_id
GROUP BY c.category_id, r.recipe_id
HAVING AVG(ra.score) = (
    SELECT MAX(avg_rating)
    FROM (
        SELECT r2.recipe_id, AVG(ra2.score) AS avg_rating
        FROM Recipes r2
        JOIN Ratings ra2 ON r2.recipe_id = ra2.recipe_id
        GROUP BY r2.recipe_id
    ) AS avg_ratings_per_recipe
)
ORDER BY avg_rating DESC;

/* maybe we add achievements */

/* i used GPT for these */

/*user rewiewed one query in every category */

/* getting started(if users submit their first recepie) */

SELECT u.user_id, 
       u.username
FROM Users u
JOIN Recipes r ON u.user_id = r.user_id
GROUP BY u.user_id
/*Check if user has submitted exactly one recipe*/
HAVING COUNT(r.recipe_id) = 1;

/* their first rewiew */

]SELECT u.user_id, 
       u.username
FROM Users u
JOIN Reviews rev ON u.user_id = rev.user_id
GROUP BY u.user_id
/* Check if user has written exactly one review*/
HAVING COUNT(rev.review_id) = 1;

/* user rewiews one recepie in all categories */

SELECT u.user_id, 
       u.username, 
       COUNT(DISTINCT c.category_id) AS category_count
FROM Users u
JOIN Reviews rev ON u.user_id = rev.user_id
JOIN Recipes r ON rev.recipe_id = r.recipe_id
JOIN Categories c ON r.recipe_id = c.recipe_id
GROUP BY u.user_id
HAVING COUNT(DISTINCT c.category_id) = (
    SELECT COUNT(*) 
    FROM Categories
)
ORDER BY category_count DESC;

/*recepie collector(favorites 50 recepie)*/

SELECT u.user_id, 
       u.username, 
       COUNT(f.recipe_id) AS favorite_count
FROM Users u
JOIN Favorites f ON u.user_id = f.user_id
GROUP BY u.user_id
HAVING COUNT(f.recipe_id) > 50
ORDER BY favorite_count DESC;

