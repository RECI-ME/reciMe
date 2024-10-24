<!DOCTYPE html>
<html>
    <head>
        <title>ReciMe | Edit Recipe</title>
        <link rel="icon" type="image/png" href="../../../assets/recimelogo.png">

        <link rel="stylesheet" href="../global.css">
        <link rel="stylesheet" href="./index.css">
    </head>

    <body>
        <a href="../home/index.html">Back To Homepage</a>
        <a href="../post_recipe/index.php">Post Recipes</a>

         <div id="center_form">
         <form action="../../server/post_recipe.php" method="post">
            <?php
                $user_id = $_COOKIE["user_id"];
                if (!isset($user_id)) {
                    echo "user not logged in";
                } else {
                    echo `<input type="hidden" name="user_id" value="$user_id" />`
                }
                    $env = parse_ini_file("../../../env.ini");

                    $recipe_id = $_POST["recipe_id"];

                    if ($env == false) {
                        echo "server conn error!";
                    }

                    $conn = new mysqli(
                        $env["DB_SERVER"], 
                        $env["DB_USERNAME"], 
                        $env["DB_PASSWORD"],
                        $env["DB"]
                    );

                    if ($conn->connect_error) {
                        echo "server conn error!";
                    }

                    $recipe_result = $conn->query(
                        "SELECT name, description, image, category 
                        FROM Recipes 
                        WHERE Recipes.recipe_id = $recipe_id");

                    if ($recipe_result->num_rows == 0) {
                        echo "couldn't get recipe from server!";
                    }

                    $categories_result = $conn->query(
                        "SELECT * FROM Categories"
                    );

                    if ($categories_result->num_rows == 0) {
                        echo "couldn't get available categories";
                    }

                    while ($row = $recipe_result->fetch_assoc()) {
                        $recipe_name = $row["name"];
                        $recipe_image = $row["image"];
                        $recipe_desc = $row["description"];
                        $recipe_category = $row["category"];

                        echo `
                            <input type="hidden" name="recipe_id" value="$recipe_id" />
                            <label for="name">Name</label>
                            <input type="text" name="name" value='$name' />
                            <label for="image">Image</label>
                            <input type="file" name="image" />
                            <label for="description">Description</label>
                            <textarea name="description"></textarea>
                            <label for="category">Category</label>
                            <select name="category">
                        `;

                        while ($categories = $categories_result->fetch_assoc()) {
                            $category_name = $categories["name"];
                            $category_id   = $categories["category_id"];

                            $selected = ($category_id == $recipe_category)
                                ? "selected "
                                : "";

                            echo `<option value="$category_id" $selected>$category_name</option>`;
                        }

                        echo "</select>";
                    }


                    $conn->close();
                ?>
                <button type="submit">Post</button>
            </form>
        </div>
    </body>
</html>
