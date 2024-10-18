<!DOCTYPE html>
<html>
    <head>
        <title>ReciMe | Edit Recipe</title>
        <link rel="icon" type="image/png" href="../../../assets/recimelogo.png">

        <link rel="stylesheet" href="../global.css">
    </head>

    <body>
        <form action="../../server/post_recipe.php" method="post">
            <input type="hidden" name="user_id" value="1" />

            <label for="recipe">Recipe</label>
            <select name="recipe" > 
                <?php
                    $env = parse_ini_file("../../../env.ini");
                    $user_id = 1;

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

                    $recipes_result = $conn->query("SELECT name FROM Recipes WHERE Recipes.user_id = " . $user_id);

                    if ($recipes_result->num_rows == 0) {
                        echo "couldn't get user recipes from server!";
                    }

                    while ($row = $recipes_result->fetch_assoc()) {
                        echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                    }


                    $conn->close();
                ?>
            </select>

            <label for="name">Name</label>
            <input name="name" type="text" />

            <label for="category">Category</label>
            <select name="category" > 
                <?php
                    $env = parse_ini_file("../../../env.ini");

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

                    $categories_result = $conn->query("SELECT name FROM Categories");

                    if ($categories_result->num_rows == 0) {
                        echo "couldn't get categories from server!";
                    }

                    while ($row = $categories_result->fetch_assoc()) {
                        echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                    }


                    $conn->close();
                ?>
            </select>
            
            
            <button type="submit">Post</button>
        </form>
    </body>
</html>
