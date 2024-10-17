<?php
include('reciMe/src/php/Reviews_n_Delete/db.php');
//  database connection

// Fetch all recipes along with the username of the user who posted them
try {
    $query = $db->prepare('SELECT r.*, u.username FROM Recipes r JOIN Users u ON r.user_id = u.user_id');
    $query->execute();
    $recipes = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Error fetching recipes: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ReciMe | Home</title>
        <!-- Adjusted the path to the favicon -->
        <link rel="icon" type="image/png" href="../../../assets/recimelogo.png">

        <!-- Adjusted paths to CSS files -->
        <link rel="stylesheet" href="../global.css">
        <link rel="stylesheet" href="index.css">
        <script src="index.js" defer></script>        
    </head>

    <body>
        <div id="dashboard_blanket" class="hide"></div>
        <div id="dashboard" class="hide">
            <div class="cursor" id="profile_header">
                <!-- Adjusted the path to the avatar image -->
                <img src="../../../assets/default_avatar_cream.png" alt="Avatar" width="30px"  />
                <p>my username</p>
            </div>
            <hr>
            <div id="dashboard_menu">
                <a href="">
                    <div>
                        <img src="../../../assets/search_icon.png" alt="Search Icon" width="30px"/>
                        <p>Search</p>
                    </div>
                </a>
                <a href="">
                    <div>
                        <img src="../../../assets/my_recipes_icon.png" alt="My Recipes Icon" width="30px"/>
                        <p>My Recipes</p>
                    </div>
                </a>
                <a href="">
                    <div>
                        <img src="../../../assets/favorites.png" alt="Favorites Icon" width="30px"/>
                        <p>Favorites</p>
                    </div>
                </a>
            </div>
            <footer id="imprint">
                <a href="../../../imprint/imprint.html">Legal Information</a>
            </footer>
        </div>

        <div id="center_logo">
            <img class="cursor" id="logo" src="../../../assets/logo_horizontal.png" alt="ReciMe Logo" width="500px" />
        </div>
        <div id="banner">
            <div class="cursor" id="profile">
                <img class="avatar" src="../../../assets/default_avatar_cream.png" alt="Avatar" width="30px"  />
                <p class="username">my username</p>
            </div>
        </div>

        <div id="feed">
            <?php foreach ($recipes as $recipe): ?>
            <div class="recipe">
                <div class="cursor chef">
                    <img class="avatar" src="../../../assets/default_avatar.png" alt="Avatar" width="30px"  />
                    <p class="username"><?php echo htmlspecialchars($recipe['username']); ?></p>
                    <img class="chef_hat" src="../../../assets/chef_hat.png" alt="Chef Hat" width="30px" />
                </div>
                <div class="images">
                    <!-- Display the recipe image if available -->
                    <?php if (!empty($recipe['image_path'])): ?>
                        <!-- Adjust the path to the recipe image -->
                        <img class="recipe_showcase" src="<?php echo htmlspecialchars($recipe['image_path']); ?>" alt="Recipe Image" />
                    <?php else: ?>
                        <img class="recipe_showcase" src="" alt="" />
                    <?php endif; ?>
                </div>
                <div class="reactions">
                    <button class="cursor">
                        <img src="../../../assets/like_icon.png" alt="Like Icon" width="30px" height="30px" />
                    </button>
                    <!-- Review Button with dynamic recipe ID -->
                    <button class="cursor review-button" data-recipe-id="<?php echo $recipe['recipe_id']; ?>">
                        <img src="../../../assets/review_icon.png" alt="Review Icon" width="30px" height="30px" />
                    </button>
                    <!-- Delete Button with dynamic recipe ID -->
                    <button class="cursor" onclick="deleteRecipe(<?php echo $recipe['recipe_id']; ?>)">
                        <img src="../../../assets/mark_icon.png" alt="Mark Icon" width="30px" height="30px" />
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

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
        
        <!-- JavaScript code is in index.js -->
    </body>
</html>
