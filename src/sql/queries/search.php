<?php
include '../init/db_connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve search parameters from URL
    $searchTerm = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';
    $minRating = isset($_GET['rating']) ? (int)$_GET['rating'] : 0; // Get the minimum rating from the URL

    // SQL query to search for recipes, ingredients, reviews, and users
    $sql = "
        SELECT r.*, AVG(rt.score) as average_rating, u.username 
        FROM Recipes r
        LEFT JOIN Ingredients i ON r.id = i.recipe_id
        LEFT JOIN Reviews rev ON r.id = rev.recipe_id
        LEFT JOIN Ratings rt ON r.id = rt.recipe_id
        LEFT JOIN Users u ON r.user_id = u.id
        WHERE (r.name LIKE '%$searchTerm%' 
            OR i.name LIKE '%$searchTerm%' 
            OR rev.review_text LIKE '%$searchTerm%' 
            OR u.username LIKE '%$searchTerm%') 
        GROUP BY r.id
        HAVING average_rating >= $minRating"; // Filter by minimum rating

    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        // Fetch all results as an associative array
        $recipes = [];
        while ($row = $result->fetch_assoc()) {
            $recipes[] = $row;
        }
        // Output results as JSON
        echo json_encode($recipes);
    } else {
        echo json_encode([]); // No results found
    }
}

$conn->close();
?>
