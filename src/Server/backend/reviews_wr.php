<?php
include('db.php'); // Include database connection

// Simulate logged-in user (since login is not implemented yet)
$logged_in_user_id = 1; // For testing purposes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['recipe_id']) && isset($_POST['review_text'])) {
        $recipe_id = intval($_POST['recipe_id']);
        $review_text = trim($_POST['review_text']);

        if ($review_text == '') {
            die('Comment cannot be empty.');
        }

        try {
            $insertQuery = $db->prepare('INSERT INTO Reviews (recipe_id, user_id, review_text) VALUES (?, ?, ?)');
            $insertQuery->execute([$recipe_id, $logged_in_user_id, $review_text]);

            // Redirect back to the recipe page
            header('Location: view_recipe.php?recipe_id=' . $recipe_id);
            exit();

        } catch (Exception $e) {
            die('Error adding comment: ' . $e->getMessage());
        }
    } else {
        die('Invalid form submission.');
    }
} else {
    die('Invalid request method.');
}
?>
