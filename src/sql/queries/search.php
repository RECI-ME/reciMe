<?php
include '../init/db_connection.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve and sanitize search parameters from URL
    $searchTerm = isset($_GET['query']) ? $_GET['query'] : '';
    $minRating = isset($_GET['rating']) ? (int)$_GET['rating'] : 0; // Get the minimum rating from the URL

    try {
        // SQL query to search for recipes, ingredients, reviews, and users
        $sql = "
            SELECT r.*, AVG(rt.score) as average_rating, u.username 
            FROM Recipes r
            LEFT JOIN Ingredients i ON r.id = i.recipe_id
            LEFT JOIN Reviews rev ON r.id = rev.recipe_id
            LEFT JOIN Ratings rt ON r.id = rt.recipe_id
            LEFT JOIN Users u ON r.user_id = u.id
            WHERE (r.name LIKE :searchTerm 
                OR i.name LIKE :searchTerm 
                OR rev.review_text LIKE :searchTerm 
                OR u.username LIKE :searchTerm) 
            GROUP BY r.id
            HAVING average_rating >= :minRating";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        $searchPattern = '%' . $searchTerm . '%';
        $stmt->bindParam(':searchTerm', $searchPattern);
        $stmt->bindParam(':minRating', $minRating, PDO::PARAM_INT);

        // Execute query
        $stmt->execute();

        // Fetch all results
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output results as JSON
        echo json_encode($recipes);
        
    } catch (Exception $e) {
        handleError("An error occurred during the search process: " . $e->getMessage());
    }
}

$conn = null;
?>
