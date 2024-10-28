-- Get all marked reviews along with the user who marked them
SELECT mr.marked_review_id, rev.review_text, u.username
FROM MarkedReviews mr
JOIN Reviews rev ON mr.review_id = rev.review_id
JOIN Users u ON mr.user_id = u.user_id;
