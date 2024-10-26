<?php
include('../../server/db.php'); // Include database connection
include('../../server/session.php'); // Check login status


checkSession(); 


$logged_in_user_id = $_SESSION['user_id'];

// Get 'recipe_id' from GET parameter
if (isset($_GET['recipe_id'])) {
    $recipe_id = intval($_GET['recipe_id']);
} else {
    die('No recipe specified.');
}

// Fetch recipe details
try {
    $query = $db->prepare('SELECT r.*, u.username FROM Recipes r JOIN Users u ON r.user_id = u.user_id WHERE r.recipe_id = ?');
    $query->execute([$recipe_id]);
    $recipe = $query->fetch(PDO::FETCH_ASSOC);

    if (!$recipe) {
        die('Recipe not found.');
    }

    // Fetch ingredients
    $ingredientQuery = $db->prepare('SELECT name FROM Ingredients WHERE recipe_id = ?');
    $ingredientQuery->execute([$recipe_id]);
    $ingredients = $ingredientQuery->fetchAll(PDO::FETCH_COLUMN);

} catch (Exception $e) {
    die('Error fetching recipe details: ' . $e->getMessage());
}

// Check if logged-in user is the author
$is_author = ($logged_in_user_id == $recipe['user_id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($recipe['name']); ?> | ReciMe</title>
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="view_recipe.css"> 
    <script src="index.js" defer></script> <!-- Include index.js for modal functionality -->
</head>
<body>
    <div class="recipe-detail">
        <h1><?php echo htmlspecialchars($recipe['name']); ?></h1>
        <p>By <?php echo htmlspecialchars($recipe['username']); ?></p>
        <!-- Only show edit button if the logged-in user is the author -->
        <?php if ($is_author): ?>
            <a href="edit_recipe.php?recipe_id=<?php echo $recipe['recipe_id']; ?>">Edit Recipe</a>
        <?php endif; ?>
        <h2>Category: <?php echo htmlspecialchars($recipe['category']); ?></h2>
        <h2>Ingredients:</h2>
        <ul>
            <?php foreach ($ingredients as $ingredient): ?>
                <li><?php echo htmlspecialchars($ingredient); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Display the recipe image if available -->
        <div class="recipe-image">
            <?php if (!empty($recipe['image_path'])): ?>
                <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" alt="Recipe Image" />
            <?php else: ?>
                <img src="../../../assets/default_recipe_image.png" alt="Default Recipe Image" />
            <?php endif; ?>
        </div>

        <h2>Comments:</h2>
        <!-- Show Comments Button -->
        <button class="cursor review-button" data-recipe-id="<?php echo $recipe['recipe_id']; ?>">Show Comments</button>

        <!-- Modal for displaying reviews -->
        <div id="reviewModal" class="modal hide">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Reviews</h2>
                <div id="reviews-container">
                    <!-- Reviews will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
