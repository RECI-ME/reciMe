-- Count how many marked reviews each user has created
SELECT u.user_id, u.username, COUNT(r.marked_review_id) AS reviews_count
FROM Users u
JOIN MarkedReviews r ON u.user_id = r.user_id
GROUP BY u.user_id
ORDER BY reviews_count DESC;
