<?php
header('Content-Type: application/json');
include('db.php'); // Adjust the path if necessary

// Enable error reporting for development (remove or comment out in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

if (isset($_GET['recipe_id'])) {
    $recipe_id = intval($_GET['recipe_id']);
} else {
    $response['error'] = 'No recipe specified.';
    echo json_encode($response);
    exit();
}

try {
    // Since there's no date column, we select only review_text and username
    $reviewQuery = "SELECT r.review_text, u.username 
                    FROM Reviews r 
                    JOIN Users u ON r.user_id = u.user_id 
                    WHERE r.recipe_id = ?";
    $stmt = $db->prepare($reviewQuery);
    $stmt->execute([$recipe_id]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response['reviews'] = [];

    if ($reviews) {
        foreach ($reviews as $review) {
            $response['reviews'][] = [
                'username' => htmlspecialchars($review['username']),
                'review_text' => nl2br(htmlspecialchars($review['review_text']))
            ];
        }
    }

    // Output the JSON response
    echo json_encode($response);
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
    echo json_encode($response);
}
?>
