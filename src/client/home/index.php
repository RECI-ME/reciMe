<?php
include('../../server/db.php'); 
include('../../server/session.php');

// Check if user is logged in using the session cookie
checkSession(); 

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
        
        <link rel="icon" type="image/png" href="../../../assets/recimelogo.png">

        <!-- Adjusted paths to CSS files -->
        <link rel="stylesheet" href="../global.css">
        <link rel="stylesheet" href="./index.css">
      
        <script src="./index.js" defer></script>
        <script>
            let liked = false;

            function toggleLike(event) {
                const likeIcon = event.currentTarget.querySelector("img");
                if (liked) {
                    likeIcon.src = "../../../assets/like_icon.png";
                } else {
                    likeIcon.src = "../../../assets/like_icon_filled.png";
                }
                liked = !liked;
            }
        </script>        
    </head>

    <body>
        <div id="dashboard_blanket" class="hide"></div>
        <div id="dashboard" class="hide">
            <div class="cursor" id="profile_header">
                <!-- Display the logged-in username from session -->
                <img src="../../../assets/default_avatar_cream.png" alt="Avatar" width="30px"  />
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <hr>
            <div id="dashboard_menu">
                <a href="">
                    <div>
                        <img src="../../../assets/search_icon.png" alt="Search Icon" width="30px"/>
                        <p>Search</p>
                    </div>
                </a>
                <a href="../post_recipe/index.php">
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
            <div id="login"> 
                <a href="../login/index.html" id="loginButton">Login</a>
            </div>
            <div class="cursor" id="profile">
                <img class="avatar" src="../../../assets/default_avatar_cream.png" alt="Avatar" width="30px"  />
                <p class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
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
                <div class="recipe-name">
                    <a href="../View_Recipe/view_recipe.php?recipe_id=<?php echo $recipe['recipe_id']; ?>">
                        <?php echo htmlspecialchars($recipe['name']); ?>
                    </a>
                </div>
                <div class="images">
                    <!-- Display the recipe image if available -->
                    <?php if (!empty($recipe['image_path'])): ?>
                        <a href="../View_Recipe/view_recipe.php?recipe_id=<?php echo $recipe['recipe_id']; ?>">
                            <img class="recipe_showcase" src="<?php echo '../../../' . htmlspecialchars($recipe['image_path']); ?>" alt="Recipe Image" />
                        </a>
                    <?php else: ?>
                        <a href="../View_Recipe/view_recipe.php?recipe_id=<?php echo $recipe['recipe_id']; ?>">
                            <img class="recipe_showcase" src="../../../assets/default_recipe_image.png" alt="Default Recipe Image" />
                        </a>
                    <?php endif; ?>
                </div>
                <div class="reactions">
                    <button class="cursor" onclick="toggleLike(event)">
                        <img src="../../../assets/like_icon.png" alt="Like Icon" width="30px" height="30px" />
                    </button>
                    <!-- Review Button with dynamic recipe ID -->
                    <button class="cursor review-button" data-recipe-id="<?php echo $recipe['recipe_id']; ?>">
                        <img src="../../../assets/review_icon.png" alt="Review Icon" width="30px" height="30px" />
                    </button>
                    <button class="cursor" >
                        <img src="../../../assets/mark_icon.png" alt="Report Icon" width="30px" height="30px" />
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div id="cookieConsent">
           <p>This website uses cookies to ensure you get the best experience. 
              <button id="acceptCookies">Accept</button>
              <!-- Nobody can reject our cookies -->
          </p>
        </div>
   </body>
</html>
